<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function index($cid,$tid)
    {
    	$course = Course::find($cid);
    	$topic = DB::table('topic')->where([['tid',$tid],['course_id',$cid]])->first();
    	$subtopics = DB::table('subtopics')->where([['tid', $tid],['course_id',$cid]])->orderBy('sub_tid')->get();
    	$quizzes = DB::table('quiz')->where([['tid', $tid],['course_id',$cid]])->orderBy('sub_tid')->get();
    	return view('admin.quiz.quiz',compact('course','topic','subtopics','$quizzes'));
    }

    public function show($cid,$tid,$stid)
    {
    	$quizzes = DB::table('quiz')->where([['tid', $tid],['course_id',$cid],['sub_tid',$stid]])->first();
    	$questions;

    	if(count($quizzes)>0)
    	{
    		$quiz_id = $quizzes->quiz_id;
    		$questions = DB::table('questions')->where('quiz_id',$quiz_id)->get();
            $easy = DB::table('questions')->where([['quiz_id',$quiz_id],['level','=','easy']])->get();
            $moderate = DB::table('questions')->where([['quiz_id',$quiz_id],['level','=','moderate']])->get();
            $difficult = DB::table('questions')->where([['quiz_id',$quiz_id],['level','=','difficult']])->get();

    		return view('admin.quiz.showquiz',compact('quizzes','questions','cid','tid','stid','easy','moderate','difficult'));
            
    	}
    	else
    	{
    		return view('admin.quiz.showquiz',compact('quizzes','questions','cid','tid','stid'));
    	}
    	
    }

    public function create($cid,$tid,$stid)
    {
    	$course = Course::find($cid);
    	$topic = DB::table('topic')->where([['tid', $tid],['course_id',$cid]])->first();
        $subtopic = DB::table('subtopics')->where([['tid', $tid],['course_id',$cid],['sub_tid',$stid]])->first();
        $x = mt_rand(100000,999999);
        return view('admin.quiz.createquiz',compact('x','course','topic','subtopic'));
    }

    public function store(Request $request)
    {
    	$this->validate(request(),[
    		'quiz_id'=>'required|unique:quiz',
    		'cid'=>'required',
    		'tid'=>'required',
    		'stid'=>'required'
    	]);
    	$course = request('cid');
    	$topic = request('tid');
    	$stid = request('stid');

    	DB::table('quiz')->insert(['quiz_id'=>request('quiz_id'),'tid'=>request('tid'),'sub_tid'=>request('stid'),'course_id'=>request('cid'),'created_at'=>Carbon::now(),'updated_at'=>Carbon::now(),'review_status' => 'Not Reviewed']
        );
        return redirect('/admin/'.$course.'/'.$topic.'/'.$stid.'/showquiz');
    }

    public function reviewquiz($qid)
    {
        $quizzes = DB::table('quiz')->where('quiz_id',$qid)->first();
        
        DB::table('quiz')->where('quiz_id','=',$qid)->update(['review_status' => 'Reviewing']);
        if(count($quizzes)>0)
        {
            
            $questions = DB::table('questions')->where('quiz_id',$qid)->get();
            $easy = DB::table('questions')->where([['quiz_id',$qid],['level','=','easy']])->get();
            $moderate = DB::table('questions')->where([['quiz_id',$qid],['level','=','moderate']])->get();
            $difficult = DB::table('questions')->where([['quiz_id',$qid],['level','=','difficult']])->get();

            alert()->success('Content Sent for Reviewing!!');
            return redirect('admin/'.$quizzes->course_id.'/'.$quizzes->tid.'/'.$quizzes->sub_tid.'/showquiz')->with(compact('quizzes','questions','easy','moderate','difficult'));
            
        } 
        
    }
    public function reviewquizedit(Request $request)
    {
       // $quizzes = DB::table('quiz')->where('quiz_id',$qid)->first();
        //dd(request('feedback'));
        DB::table('quiz')->where('quiz_id','=',request('qid'))
        ->update(['review_status' => 'Edit','feedback' => request('feedback')]);
        alert()->info('Feedback taken');
     return redirect('/admin/reviewquiz');   
        
    }

    public function reviewquizcorrect($id)
    {
        //$quizzes = DB::table('quiz')->where('quiz_id',$id)->first();
        
        DB::table('quiz')->where('quiz_id','=',$id)
        ->update(['review_status' => 'Correct','feedback' => 'Okay']);
        alert()->info('Quiz Corrected');
     return redirect('/admin/reviewquiz');   
        
    }
    public function viewquiz($qid)
    {
         $quizzes = DB::table('quiz')->where('quiz_id',$qid)->first();
        
    //    DB::table('quiz')->where('quiz_id','=',$qid)->update(['review_status' => 'Reviewing']);
        if(count($quizzes)>0)
        {
            
            $questions = DB::table('questions')->where('quiz_id',$qid)->get();
            $easy = DB::table('questions')->where([['quiz_id',$qid],['level','=','easy']])->get();
            $moderate = DB::table('questions')->where([['quiz_id',$qid],['level','=','moderate']])->get();
            $difficult = DB::table('questions')->where([['quiz_id',$qid],['level','=','difficult']])->get();

           dd($quizzes); 
        } 
        
        
      
    }
    public function displayquiz()
    {
        $auth=Auth::guard('admin')->user()->id;
       
        $course1=[];
        $i=0;
        $category1=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->pluck('category_id');
         $quiz = DB::table('quiz')
         ->join('course_category','course_category.course_id','=','quiz.course_id')
         ->where([['review_status','Reviewing']])
         ->whereIn('course_category.category_id',$category1)
         ->get();
         return view('admin.review.showquiz',compact('quiz'));
         //dd($quiz);
         /*if(count($quiz)>0)
        {
         foreach ($quiz as $quizzes) {
                
                    $quiz_id = $quizzes->quiz_id;
                    $questions = DB::table('questions')->where('quiz_id',$quiz_id)->get();
                    $course1[$i]=$questions;
                    $i++;
                    
             }
             return view('admin.review.showquiz',compact('$course1'));
         }
        else
        {
            return view('admin.quiz.showquiz',compact('quizzes','questions','cid','tid','stid'));
        }*/
    }
    public function displayquizdetails($id)
    {
        $auth=Auth::guard('admin')->user()->id;
       
        $course1=[];
        $i=0;
        $category1=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->pluck('category_id');
         $quiz = DB::table('quiz')
         ->join('course_category','course_category.course_id','=','quiz.course_id')
         ->where([['review_status','Reviewing'],['quiz.quiz_id',$id]])
         ->whereIn('course_category.category_id',$category1)
         ->get();
         if(count($quiz)>0)
        {
        $questions = DB::table('questions')->where('quiz_id',$id)->get();
         $status=$id;
        return view('admin.review.showquiz',compact('questions','status'));
        }
        else
        {

        }
    }

}
