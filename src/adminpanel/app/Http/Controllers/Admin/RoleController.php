<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Role;
use App\Permission;

class RoleController extends Controller
{
	//Display all the roles

    public function index()
    {
    	$roles = Role::all();
    	return view('admin.roles.index',compact('roles'));
    }

    //Show the form of creating new role

    public function create()
    {
    	$permissions = Permission::all();
    	return view('admin.roles.createrole',compact('permissions'));
    }

    //Store a newly created roles in storage 
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'name'=>'required|unique:roles',
    		'display_name'=>'required',
    		'description'=>'required',
    		'permissions'=>'required',
    	]);

    	$role= new Role();
    	$role->name=request('name');
    	$role->display_name=request('display_name');
    	$role->description=request('description');
    	$role->save();

    	foreach (request('permissions') as $value) {
            echo $value;
            $role->attachPermission($value);
        }

        return redirect('/admin/roles')->with('success','Role successfully created.');
    }

    //Display a specified role

    public function show($id)
    {
    	$role= Role::find($id);
    	return view('admin.roles.roledetails',compact('role'));
    }

    //Remove a specified role

    public function destroy($id)
    {

    }
}
