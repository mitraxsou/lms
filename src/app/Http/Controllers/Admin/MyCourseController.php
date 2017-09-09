<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use DateTime;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Course;
use Carbon\Carbon;

class MyCourseController extends Controller
{
    public function index()
    {
        $courses=[];
        $j=0;$i=0;
    	$auth=Auth::guard('admin')->user()->id;
       //  Alert::message('Robots are working!');
    	$coursesarr = DB::table('courses')->join('admin_course','id','=','admin_course.course_id')->select('courses.id','courses.name','courses.description','courses.cfilename')->where('admin_id', $auth)->orderBy('id')->get();
        $courses1=DB::table('courses')->pluck('id');

         $publish=DB::table('publish_course')->join('courses','course_id','=','courses.id')
         ->join('admin_course','publish_course.course_id','=','admin_course.course_id')
         ->select(
            'publish_course.publish_status','publish_course.feedback','publish_course.course_id','courses.name','courses.description')->where('admin_id', $auth)->orderBy('publish_course.course_id')->get();


         foreach ($coursesarr as $course) {
           
            foreach ($publish as $pb) {
                if($pb->course_id==$course->id)
                {
                    $j++;
                }
                # code...
            }
            if($j==0)
            {
                $courses[$i]=$course;
                $i++;
             # code...
            }
            else{
                 $j=0;
            }
         }
        //dd($courses);
     
    	return view('admin.course.course' , compact('courses','publish'))->with('sweetalert', 'List has been created!');;
    }
    public function publishedit($id)
    {
       
        $updte = DB::table('publish_course')->where([
                 ['course_id' ,'=', $id]
         ])->delete();

         
     alert()->info('Course open again to edit');
      return redirect('/admin/mycourse/'.$id);
    }
    public function show($id)
    {
        $index=DB::table('course_structure')->where('course_id', $id)->first();
        $course = Course::find($id);
        $adm=Auth::guard('admin')->user();
        if($index->review_status=='Okay')
        {
                foreach($course->admins as $cor)
                {
                    if($adm->id == $cor->pivot->admin_id)
                    {
                        $indexes = DB::table('topic')->where('course_id', $id)->orderBy('tid')->get();
                        $indexes_sub = DB::table('subtopics')->where([['course_id', $id]
                                                                    ])->get();
            	       return view('admin.course.topic.topic' , compact('course','indexes','indexes_sub','index'));
                    }
                    else
                    {
                        abort(403,'Not Authorized');
                    }
                }
        }
        else{
             return view('admin.course.topic.topic' , compact('course','index'));
        }
    
    }
    
    public function reviewstructure(Request $request)
    {

          $updte = DB::table('course_structure')->where([
                 ['course_id', '=', request('cid')]
         ])->update(['review_status' => 'Reviewing',
                    'tempstructure'=> request('summernote'),
                    'demo_content'=>request('summernote1') 
                    ]);
          alert()->success('Sent for Reviewing!');
          $status=true;
          return redirect('/admin/mycourse/'.request('cid'))->with(compact('status'));;
    }

    public function showSubTopic($cid,$tid)
    {
        $course=Course::find($cid);
        $topic = DB::table('topic')->where([['tid', $tid],['course_id',$cid]])->get();
        $indexes = DB::table('subtopics')->where([['tid', $tid],['course_id',$cid]])->orderBy('sub_tid')->get();
        //dd($topic,$course,$indexes);
        $adm=Auth::guard('admin')->user();
        foreach($course->admins as $cor)
        {                                 
            if($adm->id == $cor->pivot->admin_id)
            {
                return view('admin.course.subtopic.subtopic' , compact('course','topic','indexes'));
            }
            else{
                abort(403,'Not Authorized');
            }
        }
    }

     public function contentshow($cid,$tid,$stid)
    {
      $courseAdmin=Course::find($cid);
         $course1 = DB::table('subtopics')->where([
                 ['sub_tid', '=', $stid],
                 ['tid', '=', $tid],
                 ['course_id', '=', $cid]
         ])->first();
         //dd($course1->content_id);
         $course=  DB::table('content')->where([
                 ['content_id', '=', $course1->content_id],
         ])->first();
        
        $adm=Auth::guard('admin')->user();

        $s3=Storage::disk('s3');

        $kp = env('CLOUDFRONT_KEY_PAIRID');
        $cloudfront=\Aws\CloudFront\CloudFrontClient::factory([
            'region'=>env('AWS_REGION'),
            'version'=>'2017-03-25'
        ]);
        $cf_url=env('CLOUDFRONT_URL');
        $cf_expiry= new DateTime('+2 minutes');
        $video= $cloudfront->getSignedUrl([
            'url'=>"{$cf_url}/{$course->content}",
            'expires'=>$cf_expiry->getTimestamp(),
            'private_key' =>base_path('/pk-APKAJZNXFGELO6O2EZMQ.pem'),
            'key_pair_id' =>'APKAJZNXFGELO6O2EZMQ'
            ]);
        foreach($courseAdmin->admins as $cor)
        {
            if($adm->id == $cor->pivot->admin_id)
            {
                return view('admin.course.content.viewcontent', compact('course','course1','video'));
            }
            else{
                abort(403,'Not Authorized');
            }
        }
    }
}
