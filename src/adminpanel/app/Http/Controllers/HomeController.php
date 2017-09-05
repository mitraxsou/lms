<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Course;
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
        $batches = $user->batches()->get();
        $cour = [];
        foreach ($user->courses as $course)
        { 
            $temp = Course::find($course->pivot->course_id);
            //Add values into the the array $cour which will have the info about courses
            $cour = array_prepend($cour, $temp);
        }
        foreach ($user->batches as $batch) 
        {
            $bat = Batch::find($batch->pivot->batch_id);
        }
        

        return view('home', compact('user','cour','bat'));
    }
}
