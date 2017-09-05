<?php

namespace App\Http\Controllers\Admin;

use App\Course;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    //
    public function index()
    {
    	$courses= Course::all();
    	return view('admin.course.course' , compact('courses'));
    }

    public function show($id)
    {
    	$course = Course::find($id);
        $indexes = DB::table('topic')->where('course_id', $id)->get();
    	return view('admin.course.topic' , compact('course','indexes'));
    }
    public function create()
    {
        return view('admin.course.createcourse');
    }

    public function store(FileRequest $request)
    {
        $course = new Course;

        $course->id=request('id');
        $course->name=request('name');
        $course->description=request('description');
        //$course->cfilename=request('cfile');
        

        $imageName = $course->name.'.'. $request->file('cfile')->getClientOriginalExtension();

        $path=$request->file('cfile')->move(base_path().'/public/images/catalog',$imageName);
        $course->cfilename='/images/catalog/'.$imageName;
        $course->save();
        return redirect('/admin/course')->with('message','Course Added !');
    }
    public function destroy($id)
    {
        
    }
}
