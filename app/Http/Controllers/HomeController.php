<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Storage;
use Validator;

class HomeController extends Controller
{
    public function dashboard(){
        return view("dashboard");
    }
    public function index(){
        $data = User::get();

        return view('index',compact('data'));
    }
    public function create(){
        return view('create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'photo'        => 'required|mimes:png,jpg,jpeg|max:2048',
            'name'         => 'required|string|min:3|max:20|unique:users,name',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $photo = $request->file('photo');
        $filename = date('y-m-d') . $photo->getClientOriginalName();
        $path = 'userPhoto/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($photo));

        $data['email']     = $request->email;
        $data['name']      = $request->name;
        $data['password']  = Hash::make($request->password);
        $data['image']     = $filename;

        User::create($data);

        return redirect()->route('admin.index');
    }
    public function edit(Request $request,$id){
        $data= User::find($id);

        return view('edit', compact('data'));
    }
    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'name'         => 'required|string|min:3|max:20|unique:users,name',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'string|min:8|nullable',
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

        return redirect()->route('admin.index');
    }
    public function delete(Request $request,$id)  {
        $data = User::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('admin.index');
    }
}
