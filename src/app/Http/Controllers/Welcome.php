<?php

namespace App\Http\Controllers;
use DB;
use App\Course;
use Illuminate\Http\Request;

class Welcome extends Controller
{
    //
    public function show(){
    	$course=DB::table('courses')->join('publish_course','publish_course.course_id','=','courses.id')->select('courses.id','courses.description','courses.name','courses.cfilename')->where([
                ['publish_course.publish_status', '=','Published'],
                ])->get();
    	return view('welcome', compact('course'));
    }
}
