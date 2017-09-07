<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

    //class needed for login and logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;

    //Auth facades
use Auth;

class LoginController extends Controller
{
    
    //where to redirect admin after login

    protected $redirectTo = '/adminhome';

    //Trait
    use AuthenticatesUsers;

    //custom guard for admin
    protected function guard()
    {
    	return Auth::guard('admin');
    }

    //show  admin login form
    public function showLoginForm()
    {
    	return view('admin.auth.login');
    }
    // public function logout()
    // {
    //     return view ('admin.auth.login');
    // }
}
