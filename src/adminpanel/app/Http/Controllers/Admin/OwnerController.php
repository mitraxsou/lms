<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin;
use App\Role;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::orderBy('last_name','ASC')->paginate(5);
        return view('admin.owner.owner',['admins'=>$admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        return view('admin.owner.createowner',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request() ,[
            
            'email' => 'required|email|unique:admins',
            'fname' => 'required|max:50',
            'lname' => 'required|max:50' ,
            'password' => 'required|min:6',
            'roles' => 'required'
            ]);
        
        $admin = new Admin;
        $admin->first_name = request('fname');
        $admin->last_name = request('lname');
        $admin->email = request('email');
        $admin->password = bcrypt(request('password'));

        $admin->save();

        foreach (request('roles') as $value) {
            echo $value;
            $admin->attachRole($value);
        }

        return redirect('/admin/owners')->with('success','Owner created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::find($id);
        return view('admin.owner.ownerdetails',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin=Admin::find($id);
        $roles=Role::all();
        $admRoles = $admin->roles->get();

        return view('admin.owner.edit', compact('admin','roles','admRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
    }
}
