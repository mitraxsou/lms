<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Role;
use App\Permission;

class RoleController extends Controller
{
    function __construct()
    {
        //$this->middleware('role:super')->only('create');
    }
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

    //Show the form for editing the specified role
    public function edit($id)
    {
    	$role= Role::find($id);
    	$permission=Permission::get();
    	$role_permission=DB::table('permissions')->join('permission_role','id','=','permission_role.permission_id')->select('permissions.id','permissions.name','permissions.display_name')->where('permission_role.role_id','=',$id)->get();
    	//echo($role_permission);

    	return view('admin.roles.editrole',compact('role','permission','role_permission'));
    }

    //update the specified role in storage

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
    		'display_name'=>'required',
    		'description'=>'required',
    		'permissions'=>'required',
    	]);

    	$role=Role::find($id);
    	$role->display_name=request('display_name');
    	$role->description=request('description');
    	$role->save();

    	DB::table('permission_role')->where('permission_role.role_id',$id)->delete();

    	foreach (request('permissions') as $value) {
            //echo $value;
            $role->attachPermission($value);
        }

        return redirect('/admin/roles')->with('success','Role updated successfully.');
    }


    //Remove a specified role

    public function destroy($id)
    {
        $role = Role::find($id);

        if(count($role)>1)
        {
            $owners = $role->admins;
            if(count($owners)>1)
            {
                foreach ($owners as $own) {
                    $own->detachRole($role);
                }
            }
            DB::table('roles')->where('id','=',$id)->delete();
            return redirect('/admin/roles')->with('success','Role successfully deleted');
        }
        else{
            return redirect('/admin/roles')->with('failure','Role does not exists');
        }

    }
}
