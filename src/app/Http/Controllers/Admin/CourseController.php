<?php

namespace App\Http\Controllers\Admin;

use App\Course;

use Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminauth');
    }

    public function index()
    {
        $courses= Course::all();
        $index=DB::table('courses')->join('publish_course','courses.id','=','publish_course.course_id')->select(
            'publish_course.publish_status','courses.id','courses.name','courses.description')
            ->where('publish_course.publish_status','=', 'Published')->get();


        return view('admin.course.viewonly.course' , compact('courses','index'));
    }

    public function show($id)
    {
    	$course = Course::find($id);
        $indexes = DB::table('topic')->where('course_id', $id)->orderBy('tid')->get();
        return view('admin.course.viewonly.topic' , compact('course','indexes'));
        
    }
    public function create()
    {
        $var=Auth::guard('admin')->user()->id;
        //echo $var;
        return view('admin.course.createcourse');
    }

    public function store(FileRequest $request)
    {
        $course = new Course;

        $course->id=request('id');
        $course->name=request('name');
        $course->description=request('description');
        //$course->cfilename=request('cfile');
        $var=Auth::guard('admin')->user()->id;

        $imageName = $course->name.'.'. $request->file('cfile')->getClientOriginalExtension();

        $path=$request->file('cfile')->move(base_path().'/public/images/catalog',$imageName);
        $course->cfilename='/images/catalog/'.$imageName;
        $course->save();
        
        DB::table('admin_course')->insert(['course_id' =>request('id'),'admin_id'=>$var,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);

        return redirect('/admin/course')->with('message','Course Added !');
    }

    public function edit($id)
    {
        $course = Course::find($id);
        $adm=Auth::guard('admin')->user();
        foreach($course->admins as $cor)
        {
            if($adm->id == $cor->pivot->admin_id)
            {
                return view('admin.course.editcourse',compact('course'));
            }
            else
            {
                abort(403,'Not Authorized');
            }
        }
    }

    public function update(Request $request,Course $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required'
        ]);

        $course=Course::find($id);
        $course->name=request('name');
        $course->description=request('description');
        $course->updated_at=Carbon::now();

        $adm=Auth::guard('admin')->user();
        foreach($course->admins as $cor)
        {
            if($adm->id == $cor->pivot->admin_id)
            {
                $course->save();
                return redirect('/admin/mycourse')->with('success','Course updated successfully.');
            }
            else{
                abort(403,'Not Authorized');
            }
        }
    }

    public function destroy($id)
    {
        
    }
}
