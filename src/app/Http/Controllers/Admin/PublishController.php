<?php

namespace App\Http\Controllers\Admin;
use DB;
use App;
use App\Mail\PublishMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublishController extends Controller
{
    //
    public function publish($id)
    {
        
       /*DB::table('publish_course')->insert([
       	'course_id'=>$id,
       	'publish_status'=>'Not Published'
       	]);*/
         $mailbody = DB::table('courses')->where([
                     ['id' ,'=', $id]
             ])->first();
        $temp = DB::table('subtopics')->
              where('course_id', '=', $id)
              ->where(function($query)
              {
                   $query->where('review_status', '=', 'Edit Required')
                        ->orWhere('review_status', '=', 'Not Reviewed');
              })->count();
        $temp1 = DB::table('subtopics')->
              where([['course_id', '=', $id],['review_status', '=', 'Correct']])
              ->count();
       
       if($temp>0)
       {
        return redirect()->back()->with('alert', 'You have few contents not reviewed yet, please review and then publish '.$mailbody->name.'!');
       }
       elseif ($temp1>0){

            DB::table('publish_course')->insert([
            'course_id'=>$id,
            'publish_status'=>'Not Published'
            ]);

            $user=App\Admin::where('id',1)->first();
           

           \Mail::to($user)->send(new PublishMail($mailbody));
           alert()->success('Successfully sent for publishing!')->persistent("Close this");
           return redirect('/admin/mycourse');
       }
       elseif($temp1==0 && $temp==0){
       
        return redirect()->back()->with('alert', 'Add some ontent to your course '.$mailbody->name.'!');
       }
      
    }
    public function create()
    {
        $course1= DB::table('publish_course')->where([
       	'publish_status'=>'Not Published'
       	])->pluck('course_id');
       //	dd($course1);
        $courses= DB::table('courses')->whereIn(
       	'id',$course1
       	)->get();
        $publish=true;
        return view('admin.course.viewonly.course', compact('courses','publish'));
    }
    public function feedbackcorrect(Request $request)
    {
        $id=request('course_id');
        $updte = DB::table('publish_course')->where([
                 ['course_id' ,'=', $id]
         ])->update(['publish_status' => 'Published',
                    'feedback'=>'Okay']);

         //create();
         $course1= DB::table('publish_course')->where([
        'publish_status'=>'Not Published'
        ])->pluck('course_id');
       /*// dd($course1);
        $courses= DB::table('courses')->whereIn(
        'id',$course1
        )->get();
        $publish=true;*/
        alert()->success('Course Corected');
        return redirect('/admin/publishcourse');
        //return view('admin.course.viewonly.course', compact('courses','publish'));
       //return view('admin.review.contentshow', compact('course1'));
    }
    public function feedbackedit(Request $request)
    {
       $this->validate(request(),[
            'feedback' => 'required',
            'course_id' => 'required'
            
            ]);
        $id=request('course_id');
       //s dd($id);
        $updte = DB::table('publish_course')->where([
                 ['course_id' ,'=', $id]
         ])->update(['publish_status' => 'Edit',
                    'feedback'=>request('feedback')]);

         //create();
         $course1= DB::table('publish_course')->where([
        'publish_status'=>'Not Published'
        ])->pluck('course_id');
       // dd($course1);
       /* $courses= DB::table('courses')->whereIn(
        'id',$course1
        )->get();
        $publish=true;*/
        alert()->info('Feedback sent');
      return redirect('/admin/publishcourse');
      //return view('admin.course.viewonly.course', compact('courses','publish'));
    }

    public function unpublish(Request $request)
    {
      $this->validate(request(),[
            'feedback' => 'required',
            'course_id' => 'required'
            
            ]);
      $id=request('course_id');

        $updte = DB::table('publish_course')->where([
                 ['course_id' ,'=', $id]
         ])->update(['publish_status' => 'Edit',
                    'feedback'=>request('feedback')]);

         //create();
         $course1= DB::table('publish_course')->where([
        'publish_status'=>'Not Published'
        ])->pluck('course_id');
          $mailbody = DB::table('courses')->where([
                     ['id' ,'=', $id]
             ])->first();
         $user = DB::table('admins')->join('admin_course','id','=','admin_course.admin_id')->select('admins.id','admins.first_name','admins.email')->where('admin_course.course_id', $id)->first();
         \Mail::to($user)->send(new UnPublishMail($mailbody));
         alert()->info('Course Unpublihed');
        return redirect('/admin/course');
    }
}
