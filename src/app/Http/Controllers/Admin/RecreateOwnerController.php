<?php

namespace App\Http\Controllers\Admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RecreateOwnerController extends Controller
{
    //
     public function index()
    {
        

         $index = DB::table('admin_course')->join('courses','courses.id','=','admin_course.course_id')->select('courses.id','courses.feedback','courses.name','courses.description')->where(
            'admin_course.admin_id',0
         )->get();
        $index1 = DB::table('admins')->join('role_admin','admins.id','=','role_admin.admin_id')->select('admins.id','admins.first_name','admins.last_name','admins.email')->where(
            'role_admin.role_id',2
         )->get();
       return view('admin.recreate', compact('index','index1'));
    }
     public function reassign(Request $request)
    {

        $updte = DB::table('admin_course')->where([
                 ['course_id' ,'=', request('course_id')]
         ])->update(['admin_id' => request('admin_id'),'updated_at'=>Carbon::now()]);
         alert()->success('Owner Assigned');
        return redirect('/admin/recreate');
     	//dd(request('course_id').'*'.request('admin_id'));
     }
}
