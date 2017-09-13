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
    	$courses=DB::table('courses')->join('publish_course','courses.id','=','publish_course.course_id')->select(
            'publish_course.publish_status','courses.id','courses.name','courses.description')
            ->where('publish_course.publish_status','=', 'Published')->get();

        $index=DB::table('courses')->join('publish_course','courses.id','=','publish_course.course_id')->select(
            'publish_course.publish_status','courses.id','courses.name','courses.description')
            ->where('publish_course.publish_status','=', 'Published')->get();


    	return view('admin.course.viewonly.course' , compact('courses','index'));
    }

    public function show($id)
    {
    	$course = Course::find($id);
        $arr=[];
        $indexes = DB::table('topic')->where('course_id', $id)->orderBy('tid')->get();
         $indexes_sub = DB::table('subtopics')->where([['course_id', $id]
                                                            ])->get();
        //$indexes=DB::table('subtopics')->join('topic','topic.tid','=','subtopics.tid')->select(
        //    'subtopics.sub_tid','subtopics.name','subtopics.content_id','topic.description','topic.name','topic.tid')
        //    ->where('topic.course_id', $id)->get();
        $i=0;$j=0;
          foreach ($indexes as $key1) {
               foreach ($indexes_sub as $key) {
            if($key->tid==$key1->tid)
            {
                $arr[$i]=$key;
            }
             

            //if($key->tid==1)
            //{
            //    dd($key);
              # code...
            //}
          }
        //  dd($arr);
                //
              # code...
          }
         
    # code...
          
          
           // dd($indexes_sub);
        return view('admin.course.viewonly.topic' , compact('course','indexes','indexes_sub'));
        
    }
    public function create()
    {
        $var=Auth::guard('admin')->user()->id;
        //echo $var;
        return view('admin.course.createcourse');
    }

    public function store(Request $request)
    {
        $course = new Course;

        
        $course->name=request('name');
        $course->description=request('description');
      
        $var=Auth::guard('admin')->user()->id;

        $course->save();
       
        $nextId = DB::table('courses')->max('id');
        DB::table('admin_course')->insert(['course_id' =>$nextId,'admin_id'=>$var,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
        $current = abs( crc32( uniqid() ) ); 
        DB::table('course_structure')->insert(['course_id' =>$nextId,'fixedstructure'=>null,'tempstructure'=>null,'feedback'=>$current]);
        return redirect('/admin/mycourse')->with('message','Course Added !');
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
       // dd(request('cid'));
        $course->updated_at=Carbon::now();
        $adminCourse=DB::table('admin_course')->where('course_id', request('cid'))->first();
        $adm=Auth::guard('admin')->user();
        /*foreach($adminCourse as $cor)
        {
         */   
            if($adm->id == $adminCourse->admin_id)
            {
                DB::table('courses')->where([['id',request('cid')]])->update(['name'=>request('name'),'description'=>request('description'),'updated_at'=>Carbon::now()]);
                alert()->success('Updated Successfully');
                return redirect('/admin/mycourse')->with('success','Course updated successfully.');
            }
            else{
                abort(403,'Not Authorized');
            }
       // }
    }

    public function destroy($id)
    {
        
    }
}
