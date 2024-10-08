<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
}
