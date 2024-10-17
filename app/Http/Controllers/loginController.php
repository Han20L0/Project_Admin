<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login_proces(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)){
            return redirect()->route('index');
        }else{
            return redirect()->route('login')->with('failed','email atau password salah');
        }
    }
}
