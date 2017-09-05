<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Course;

class CourseController extends Controller
{
    //

    public function __construct()
    {
    	$this->middleware('auth');
    }
    
    public function show(Course $course)
    {
       // $this->authorize('view', $course);
    	$cour = Course::find($course);

        $details = DB::table('course_details')->where('course_id','=',$cour->id)->get();
   	   return view('course.index', compact('course','cour','details'));
        
    } 

    public function index()
    {
    	$courses= Course::all();
    	return view('admin.course' , compact('courses'));
    }
}
