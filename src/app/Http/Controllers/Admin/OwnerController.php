<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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
        Log::alert('A new user created by name :' .$admin->first_name.' '.$admin->last_name);
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
        Log::info('Showing details of :' .$admin->first_name);
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
        $role_admin=DB::table('roles')->join('role_admin','id','=','role_admin.role_id')->select('roles.id','roles.name','roles.display_name')->where('role_admin.admin_id','=',$id)->get();

        return view('admin.owner.editowner', compact('admin','roles','role_admin'));
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
        $this->validate($request, [
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required',
            'roles'=>'required',
        ]);

        $admin=Admin::find($id);
        $admin->first_name=request('fname');
        $admin->last_name=request('lname');
        $admin->email=request('email');
        $admin->save();

        DB::table('role_admin')->where('role_admin.admin_id',$id)->delete();

        foreach (request('roles') as $value) {
            $admin->attachRole($value);
        }

        return redirect('/admin/owners')->with('success','Admin updated successfully.');
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

    public function assignCategory()
    {
        
    }
}
