<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $register = $request->only(['username', 'email', 'password']);

        
        Register::create($register);

        if($request->input('back') == 'back'){
            return redirect('/')->withInput();
        }
        return view('thanks');
    }
}
