<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class StudentController extends Controller
{
    //
    public function index()
    {
    	$users = User::all();

    	return view('admin.student', compact('users'));
    }

    public function show($id)
    {
    	$user = User::find($id);

    	return view('admin.studentdetails', compact('user'));
    }

    public function store(Request $request)
    {
       // dd(request()->all());
        //create a new student / User using the request data

        $this->validate(request() ,[
            
            'email' => 'required|email|unique:users',
            'name' => 'required|', 
            'password' => 'required|min:6',

            ]);

        $user = new User;

        $user->email= request('email');
        $user->name = request('name');
        $user->password= bcrypt(request('password'));
        //save it to DB

        $user->save();
        //the redirect to success
        return redirect('/admin/student');

    }
}
