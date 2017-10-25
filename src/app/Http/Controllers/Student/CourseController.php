<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use DB;
use Storage;
use DateTime;
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
    	 $cours=DB::table('courses')->where('id', $id)->first();
        $topic=DB::table('topic')->where('course_id', $id)->get();
        $subtopic = DB::table('subtopics')->where('course_id', $id)->get();
        $user = Auth::guard()->user();

        //dd($user);
        $course = Course::find($cours->id);
        //dd($user->courses->contains($course));
        //dd($topic);
        return view('student.topic', compact('topic','subtopic','course','user'));
    }

    // Detailed view of subtopic

    public function viewsubtopic($cid, $tid)
    {
        $course = Course::find($cid);
        $topic = DB::table('topic')->where([['tid', $tid],['course_id',$cid]])->first();
        $subtopic = DB::table('subtopics')->where([['tid', $tid],['course_id',$cid]])->get();

        dd($topic);
        return view('student.subtopic', compact('topic', 'subtopic','course'));
    }

    // View content of the system
    public function viewcontent($cid , $tid , $stid)
    {
        $course =  Course::find($cid);
         $topic = DB::table('topic')->where([['tid', $tid],['course_id',$cid]])->first();
        $subtopic = DB::table('subtopics')->where([
                 ['sub_tid', '=', $stid],
                 ['tid', '=', $tid],
                 ['course_id', '=', $cid]
         ])->first();

/*    ********  for finding the previous and next subtopic in the course ********/
// to find the previous course termed as pichla 
        $pichla = 0;
        for($j=1;$j<100;$j++)
        {
            $prev = DB::table('subtopics')->where([
                 ['sub_tid', '=', ($stid-$j)],
                 ['tid', '=', $tid],
                 ['course_id', '=', $cid]
         ])->first();
            
            if(count($prev)>0)
            {
                $pichla = $prev;
                break;
            }
            else{
                $pichla = [];
            }

        }
// to find the next subtopic in the course if not exists return 0

        $agla = 0;
        for($i=1;$i<100;$i++)
        {
            $next = DB::table('subtopics')->where([
                     ['sub_tid', '=', ($stid+$i)],
                     ['tid', '=', $tid],
                     ['course_id', '=', $cid]
             ])->first();

            if(count($next)>0)
            {
                $agla = $next;
                break;
            }
            else
                $agla = [];
        }

        $ntopic=0;

        if(count($agla)>0)
        {

        }
        else{
            $ntopic = DB::table('subtopics')->where([
                ['sub_tid','=',1],
                ['tid','=', ($tid+1)],
                ['course_id','=',$cid]
            ])->first();
        }
        //dd($ntopic);

        $cont = DB::table('content')->where('content_id' , $subtopic->content_id)->first();

        $s3=Storage::disk('s3');

        $kp = env('CLOUDFRONT_KEY_PAIRID');
        $cloudfront=\Aws\CloudFront\CloudFrontClient::factory([
            'region'=>env('AWS_REGION'),
            'version'=>'2017-03-25'
        ]);
        $cf_url=env('CLOUDFRONT_URL');
        $cf_expiry= new DateTime('+2 minutes');
        $video= $cloudfront->getSignedUrl([
            'url'=>"{$cf_url}/{$cont->content}",
            'expires'=>$cf_expiry->getTimestamp(),
            'private_key' =>base_path('/pk-APKAJZNXFGELO6O2EZMQ.pem'),
            'key_pair_id' =>'APKAJZNXFGELO6O2EZMQ'
            ]);


        /* ***** For checking the progress of the course we need to see the progress table where the status of subtopic is provided. ******/
        $uid=Auth::guard()->user()->id;

        $progress = DB::table('progress')->where([
            ['user_id','=',$uid],
            ['course_id','=',$cid],
            ['tid','=', $tid],
            ['sub_tid','=',$stid]
        ])->first();

        //dd($progress);
        if($progress->status == 'incomplete')
        {
            DB::table('progress')->where([['user_id',$uid],['course_id',$cid],['tid',$tid],['sub_tid',$stid]])->update(['status'=>'inprogress','updated_at'=>Carbon::now()]);
        }

        return view('student.contentshow', compact('subtopic','topic','course','cont', 'video','pichla', 'agla','ntopic','progress'));
    }

    public function read($id)
    {
    	 $course=DB::table('courses')->where('id', $id)->first();
        $subtopic=DB::table('subtopics')->where('course_id', $id)->get();
        
    	$coursesarr = DB::table('subtopics')->join('content','content.content_id','=','subtopics.content_id')->select('content.content_type','content.content')->where('subtopics.content_id', $id)->get();

        return view('student.subtopic', compact('subtopic','course'));
    }

}
