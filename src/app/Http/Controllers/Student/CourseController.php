<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use DB;
use Auth;
use Carbon\Carbon;


class CourseController extends Controller
{
    //
    /*public function __construct()
    {
        $this->middleware('guest');
    }
*/
    public function create($id)
    {
        $course=DB::table('courses')->where('id', $id)->first();
        $var=Auth::guard()->user()->id;
       // dd($var);
        $student = DB::table('users')->where('id', $var)->first();
        return view('student.reg', compact('course','student'));
    }
     public function store(Request $request)
    {
        
       
        DB::table('user_course_enroll')->insert(['course_id' =>request('cid'),'enrolled'=>1,'user_id'=>request('sid'),'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
        alert()->success('Registered Successfully');
        return redirect('/home');
    }
    public function view($id)
    {
    	 $course=DB::table('courses')->where('id', $id)->first();
        $topic=DB::table('topic')->where('course_id', $id)->get();
        
        return view('student.topic', compact('topic','course'));
    }
    public function read($id)
    {
    	 $course=DB::table('courses')->where('id', $id)->first();
        $subtopic=DB::table('subtopics')->where('course_id', $id)->get();
        
    	$coursesarr = DB::table('subtopics')->join('content','content.content_id','=','subtopics.content_id')->select('content.content_type','content.content')->where('subtopics.content_id', $id)->get();

        return view('student.subtopic', compact('subtopic','course'));
    }

}
