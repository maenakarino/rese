<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Shop;
use App\Models\User;  // Import the User model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;  // Import Hash for password hashing

class AuthController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        $user = Auth::user();
        $backRoute = '/';

        return view('index', compact('shops'));
    }

    public function store(RegisterRequest $request)
    {
        $register = $request->only(['name', 'email', 'password']);
        
        // Hashing the password before storing it
        $register['password'] = Hash::make($register['password']);

        User::create($register);  // Assuming you meant to use the User model

        if ($request->input('back') == 'back') {
            return redirect('/')->withInput();
        }

        return view('thanks');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect("login");
    }

    public function postRegister(RegisterRequest $request)
    {
        try {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),  // Ensure password is hashed
            ]);
            return redirect('thanks')->with('result', '会員登録が完了しました');
        } catch (\Throwable $th) {
            return redirect('register')->with('result', 'エラーが発生しました');
        }
    }

    public function postLogin(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect('/');
        } else {
            return redirect('login')->with('result', 'メールアドレスまたはパスワードが間違っております');
        }
    }

    public function getRegister()
    {
        return view('register');
    }
}