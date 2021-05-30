<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function postLogin(Request $req){
        if (Auth::attempt($req->only('email','password'))) {
            return redirect( action('WebController@dashboard') );
        }

        return redirect()->action('AuthController@login')->with('toast_error','Username or Password Mismatch!');
    }
    
    public function logout(){
        Auth::logout();
        return redirect( action('AuthController@login') );
    }

}
