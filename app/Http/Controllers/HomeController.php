<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;

class HomeController extends Controller
{
    public function dashboard(){
        return view("dashboard");
    }
    public function index(){
        $datauser = User::get();

        return view('index',compact('datauser'));
    }
    public function create(){
        return view('create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        if ($validator->fails())return redirect()->back()->withInput()->withError($validator);

        $data['email']     = $request->email;
        $data['name']      = $request->name;
        $data['password']  = Hash::make($request->password);

        User::create($data);

        return redirect()->route('index')->with('success','');
    }
}
