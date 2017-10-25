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
    	DB::table('progress')->where([['user_id',$uid],['course_id',$cid],['tid',$tid],['sub_tid',$stid]])->update(['status'=>'complete','updated_at'=>Carbon::now()]);

    	alert()->success('Completed Successfully !');

    	return  redirect('course/'.$cid.'/'.$tid.'/'.$stid)->with('success','Module completed Successfully');
    }	
}
