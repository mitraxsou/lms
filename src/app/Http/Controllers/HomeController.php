<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Course;
use App\Category;
use App\User;
use App\Batch;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $courses = $user->courses()->get();
     //   $batches = $user->batches()->get();
        $cour = [];
        $var=[];
        $i=0;
        foreach ($user->courses as $course)
        { 
            $cour= DB::table('courses')->join('publish_course','publish_course.course_id','=','courses.id')->select('courses.id','courses.description','courses.name')->where([
                ['publish_course.publish_status', '=','Published'],
                ['courses.id','=',$course->pivot->course_id]
                ])->get();
            //dd($course->pivot->course_id);
            //dd($temp);
          //  $temp = Course::where([['id','=',$course->pivot->course_id],[]]);
            //Add values into the the array $cour which will have the info about courses
            $var[$i]=$course->pivot->course_id;
            $i++;
            
           // $cour = array_prepend($cour, $temp);
          //  dd($cour);
        }
        
        $courses;
        $j=0;
        $cats = Category::all()->whereNotIn('parent_id',0);
        //dd($cats); 
        foreach($cats as $cat)
        {
            foreach ($cat->courses as $course) {
                $courses[$j]= DB::table('courses')->join('publish_course','publish_course.course_id','=','courses.id')->select('courses.id','courses.description','courses.name')->where([
                ['publish_course.publish_status', '=','Published'],
                ['courses.id','=',$course->pivot->course_id]
                ])->get();

               // dd($course);
                $j++;
            }
        }
        

       $index=  DB::table('courses')->join('publish_course','publish_course.course_id','=','courses.id')->select('courses.id','courses.description','courses.name')
                ->where([
                ['publish_course.publish_status', '=','Published']
                ])->whereNotIn('courses.id', $var)
                ->get();

            $k=0;

        foreach($cour as $co)
        {
            $progress[$k] = DB::table('progress')->where([
                ['user_id' ,'=',$user->id],
                ['course_id','=',$co->id],
                ['status','=','inprogress']
            ])->first();

            $k++;
        }
        //dd($progress);

        if($progress[0]==null){
            $progress = null;
            //dd($progress);
        }
        return view('home', compact('user','cour','courses','index','cats','progress'));
    }
    
}
