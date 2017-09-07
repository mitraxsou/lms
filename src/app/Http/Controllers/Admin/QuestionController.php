<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionController extends Controller
{
   public function index($qid)
   {
      $ques = DB::table('questions')->where('quiz_id','=',$qid)->get();
      $quiz = DB::table('quiz')->where('quiz_id','=',$qid)->first();
      return view('admin.question.question',compact('ques','quiz'));
   }

   public function show()
   {

   }

   public function create($qid)
   {
   		$quiz = DB::table('quiz')->where('quiz_id',$qid)->first();
   		if(count($quiz)>0)
   		{
   			$subtopic = DB::table('subtopics')->where([['sub_tid',$quiz->sub_tid],['tid',$quiz->tid],['course_id',$quiz->course_id]])->first();
   			$rand=mt_rand(10000000,99999999);
   			return view('admin.question.createquestion',compact('quiz','subtopic','rand'));
   		}
   		else
   		{
   			return view('admin.question.createquestion',compact('quiz'));
   		}
   }

   public function store(Request $request)
   {
   		//dd($request);
   		$this->validate(request(),[
   			'ques_id'=>'required|unique:questions',
   			'quiz_id'=>'required',
   			'level'=>'required',
   		]);

   		

   		if(request('question1')!="")
   		{
   			$this->validate(request(),[
   				'qtype1'=>'required',
   				'statement1'=>'required',
   				'question1'=>'required',
   				'a1'=>'required',
   				'b1'=>'required',
   				'correct1'=>'required',
   			]);

   		DB::table('questions')->insert(['ques_id'=>request('ques_id'),'quiz_id'=>request('quiz_id'),'level'=>request('level'),'statement'=>request('statement1'),'question'=>request('question1'),'ques_type'=>request('qtype1'),'a'=>request('a1'),'b'=>request('b1'),'correct'=>request('correct1'),'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);

   		}

   		if(request('question2')!="")
   		{
   			$this->validate(request(),[
   				'statement2'=>'required',
   				'question2'=>'required',
   				'a2'=>'required',
   				'b2'=>'required',
   				'c2'=>'required',
   				'd2'=>'required',
   				'correct2'=>'required',
   			]);

            DB::table('questions')->insert(['ques_id'=>request('ques_id'),'quiz_id'=>request('quiz_id'),'level'=>request('level'),'statement'=>request('statement2'),'question'=>request('question2'),'ques_type'=>request('qtype2'),'a'=>request('a2'),'b'=>request('b2'),'c'=>request('c2'),'d'=>request('d2'),'correct'=>request('correct2'),'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
   		}

   		if(request('question3')!="")
   		{
   			$this->validate(request(),[
   				'statement3'=>'required',
   				'question3'=>'required',
   				'a3'=>'required',
   				'b3'=>'required',
   				'c3'=>'required',
   				'd3'=>'required',
   				'correct3'=>'required',
   			]);
            $x="";
            foreach (request('correct3') as $value) {
               if($x=="")
               {
                  $x = $value;
               }
               else
               {
                  $x = $x.','.$value;
               }
            }
            echo $x;

            DB::table('questions')->insert(['ques_id'=>request('ques_id'),'quiz_id'=>request('quiz_id'),'level'=>request('level'),'statement'=>request('statement3'),'question'=>request('question3'),'ques_type'=>request('qtype3'),'a'=>request('a3'),'b'=>request('b3'),'c'=>request('c3'),'d'=>request('d3'),'correct'=>$x,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
   		}

   		if(request('question4')!="")
   		{
   			$this->validate(request(),[
   				'statement4'=>'required',
   				'question4'=>'required',
   				'a4'=>'required',
   				'b4'=>'required',
   				'c4'=>'required',
   				'd4'=>'required',
   				'e4'=>'required',
   				'f4'=>'required',
   				'g4'=>'required',
   				'h4'=>'required',
   				'correct4'=>'required',
   			]);
   		}
         $quiz_id = request('quiz_id');
         $var = DB::table('quiz')->where('quiz_id','=',$quiz_id)->first();
         $cid = $var->course_id;
         $tid = $var->tid;
         $stid = $var->sub_tid;

         return redirect('/admin/quiz/'.$quiz_id.'/questions');
   }
}
