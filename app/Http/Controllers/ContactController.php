<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }
    public function UserLogout(){
        Auth::logout();
        return Redirect()->route('login')->with('success','User Logout');
    }


}
