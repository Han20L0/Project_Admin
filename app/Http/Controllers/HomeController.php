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
            'name'         => 'required|string|min:3|max:20|unique:users,name',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['email']     = $request->email;
        $data['name']      = $request->name;
        $data['password']  = Hash::make($request->password);

        User::create($data);

        return redirect()->route('index');
    }
    public function edit(Request $request,$id){
        $data= User::find($id);

        return view('edit', compact('data'));
    }
    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'name'         => 'required|string|min:3|max:20|unique:users,name',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'string|min:8|confirmed|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['email']     = $request->email;
        $data['name']      = $request->name;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);

        return redirect()->route('index');
    }
}
