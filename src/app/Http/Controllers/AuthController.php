<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;


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
        $register = $request->only(['username', 'email', 'password']);

        
        Register::create($register);

        if($request->input('back') == 'back'){
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
                'password' => $request['password'],
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
