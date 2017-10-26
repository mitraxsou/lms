<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\User;
use Carbon\Carbon;

class ProgressController extends Controller
{
    public function markComplete($cid, $tid, $stid)
    {
    	$user =  User::find(Auth::id());
    	$uid = $user->id;
    	/*DB::table('progress')->where([['user_id',$uid],['course_id',$cid],['tid',$tid],['sub_tid',$stid]])->update(['status'=>'complete','updated_at'=>Carbon::now()]);*/

    	$quizzes=DB::table('quiz')->where([['course_id',$cid],['tid',$tid],['sub_tid',$stid],['review_status','Correct']])->first();
    	if(count($quizzes)>0)
    	//dd($quizzes);
    	{
    	$questions = DB::table('questions')->where('quiz_id',$quizzes->quiz_id)->inRandomOrder()->take(5)->get();
    	}
    	alert()->success('Completed Successfully !');
    	 return view('student.showquizstudent',compact('quizzes','questions','cid','tid','stid'));
    //	return  redirect('course/'.$cid.'/'.$tid.'/'.$stid)->with('success','Module completed Successfully');
    }
    public function quiz(Request $request)
    {
    	$user =  User::find(Auth::id());
    	$uid = $user->id;
    	$ans=[];
    	$i=0;
    	$count=0;
    	//dd(request('71596362'));
    	//dd(request('id'));
    	$questions = DB::table('questions')->where('quiz_id',request('id'))->get();
    	foreach ($questions as $ques) {
    		$ans[$i]=request($ques->ques_id);
    		$answer = DB::table('questions')->where('ques_id',$ques->ques_id)->pluck('correct');
    		//dd($answer[0]);
    		if(request($ques->ques_id)== $answer[0])
    		{
    			$count++;
    		}
    		//$i++;
    	}
    	//dd($count);
    	if($count>=2)
    	{
    			$incorrect='Passed';
                DB::table('progress')->where([['user_id',$uid],['course_id',request('cid')],['tid',request('tid')],['sub_tid',request('stid')]])->update(['status'=>'complete','updated_at'=>Carbon::now()]);
    		alert()->success('Completed Successfully !');
    		return redirect('/course/'.request('cid').'/'.request('tid').'/'.request('stid'))->with('incorrect', 'Passed');
    	}
    	else{
    		$incorrect='Failed';
    		alert()->info('Incorrect !');
 				return redirect('/course/'.request('cid').'/'.request('tid').'/'.request('stid'))->with('incorrect', 'Failed');
    	}
    	
    }	
}
