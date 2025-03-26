<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('login')->with('failed','email atau password salah');
        }
    }
    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('login')->with('success','kamu berhasil logout');
    }
    public function register(Request $request){
        return view('auth.register');
    }
    public function register_proces(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $data['email']     = $request->email;
        $data['name']      = $request->name;
        $data['password']  = Hash::make($request->password);

        User::create($data);

        $datalogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($datalogin)){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('login')->with('failed','email atau password salah');
        }
    }
}
