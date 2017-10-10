<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Mail\RejectMail;
use App\Http\Controllers\Controller;
use DB;
use Storage;
use DateTime;
use Auth;
use App\Course;
use App\Admin;
use App\Notifications\ReviewContent;
use App;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function create()
    {
         $auth=Auth::guard('admin')->user()->id;
       
        $course1=[];
        $category1=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->get();
         
        $arr=[];
        $i=0;
         $course = DB::table('notifications')->where([
            ['read', '=', 0]
         ])->pluck('data');
         
         $data=(array)json_decode($course);
        // dd(count($data));
        while($i<count($data)) {
                $temp=(array)json_decode($course[$i]);
                $arr[$i]=$temp["content"];
                
                $i++;

        }
        $temp = DB::table('subtopics')
                 ->join('course_category', 'course_category.course_id', '=', 'subtopics.course_id')
                 ->whereIn(
                    'content_id',$arr)
                 ->get();
        $i=0;
        foreach ($temp as $key ) {
            # code...
        
        foreach ($category1 as $category)
            {
                 
                // dd($temp);
                 if($key->category_id==$category->category_id)
                    {
                        $course1[$i]=$key;
                       $i++;
             }
            }
        }
       //dd($course1);
           // dd($course1);
       return view('admin.review.reviewshow', compact('course1'));
    }
    public function rejectcourse($id)
    {

         $mailbody = DB::table('courses')->where([
                     ['id' ,'=', $id]
             ])->first();
        $admin_id= DB::table('admin_course')->where([
                 ['course_id' ,'=', $id]
         ])->first();
        $updte2 = DB::table('admin_course')->where([
                 ['course_id' ,'=', $id]
         ])->update(['admin_id' => 0]);

        $updte1 = DB::table('subtopics')->where([
                 ['course_id' ,'=', $id],
                 ['review_status','=','Reviewing']
         ])->get();
        //dd($updte1);
        foreach ($updte1 as $key) {
            $data= $data="{\"content\":[\"$key->content_id\"]}";

             $updte = DB::table('notifications')->where([
                     ['data' ,'=', $data]
             ])->update(['read' => '1']);
             $updte1 = DB::table('content')->where([
                 ['content_id' ,'=', $key->content_id]
         ])->update(['feedback' => 'Course Rejected']);
             $updte1 = DB::table('subtopics')->where([
                 ['content_id' ,'=', $key->content_id]
         ])->update(['review_status' => 'Edit Required']);
        }
//Mail to course owner and super admin
        
         $user=App\Admin::where('id',$admin_id->admin_id)->first();
                   

           \Mail::to($user)->send(new RejectMail($mailbody));
            $user1=App\Admin::where('id',1)->first();
            \Mail::to($user1)->send(new RejectMail($mailbody));
        alert()->info('Course Rejected');
        return redirect('/admin/reviewcourse');
    }

// Content send for the reveiw
    
    public function review($cid,$tid,$sid,$id1)
    {
         $auth=Auth::guard('admin')->user()->id;
       
        $flag=false;
        $category1=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->get();
         $course_category=DB::table('course_category')
            ->where('course_id','=',$cid)
            ->first();
        foreach ($category1 as $category) {
            # code...
        
        if($course_category->category_id==$category->category_id)
        {
            $flag=true;
         $course1 = DB::table('content')->where(
            'content_id',$id1
         )->first();
         $subtopic=DB::table('subtopics')->where([
            ['sub_tid',$sid],
            ['course_id',$cid],
            ['tid',$tid]
         ])->first();
         $topic= DB::table('topic')->where(
            'course_id',$subtopic->course_id
         )->get();
         $coursearr=DB::table('subtopics')->where(
            'course_id',$subtopic->course_id
         )->get();
         $course= $courses = DB::table('courses')->join('course_structure','courses.id','=','course_structure.course_id')->select('courses.id','courses.feedback','courses.name','courses.description','course_structure.fixedstructure','course_structure.tempstructure','course_structure.demo_content')
         ->where(
            'course_structure.course_id',$subtopic->course_id
         )->first();
         $feedback = DB::table('feedback')->where('fid', $course->feedback)->get();
        //dd($course1);-
       return view('admin.review.contenthierarchy', compact('course1','subtopic','topic','coursearr','course','feedback'));
        }
    }
    if($flag==false)
         

               return view('admin.review.notfoundcategory');
               // alert()->info('No courses found for your catgory');
                    

    }

 //Content   
    public function content($id1)
    {
        
         $auth=Auth::guard('admin')->user()->id;
       
        
        $category1=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->get();
        foreach ($category1 as $category) {
            # code...
         $course1 = DB::table('content')->join('subtopics','subtopics.content_id','=','content.content_id')->select('subtopics.sub_tid','subtopics.tid','subtopics.course_id','subtopics.name','subtopics.description','content.content','content.content_id','content.content_type')->where(
            'content.content_id',$id1
         )->first();
         $s3=Storage::disk('s3');

        $kp = env('CLOUDFRONT_KEY_PAIRID');
        $cloudfront=\Aws\CloudFront\CloudFrontClient::factory([
            'region'=>env('AWS_REGION'),
            'version'=>'2017-03-25'
        ]);
        $cf_url=env('CLOUDFRONT_URL');
        $cf_expiry= new DateTime('+2 minutes');
        $video= $cloudfront->getSignedUrl([
            'url'=>"{$cf_url}/{$course1->content}",
            'expires'=>$cf_expiry->getTimestamp(),
            'private_key' =>base_path('/pk-APKAJZNXFGELO6O2EZMQ.pem'),
            'key_pair_id' =>'APKAJZNXFGELO6O2EZMQ'
            ]);
           
         $course = DB::table('subtopics')
         ->join('course_category', 'course_category.course_id', '=', 'subtopics.course_id')
         ->where([['course_category.category_id','=',$category->category_id],
            ['subtopics.content_id','=',$id1]
            ])
         ->first();

         //dd($course);
         if(count($course)>0){
        
         return view('admin.review.contentshow', compact('course1','video'));
            }
        else{
         return view('admin.review.notfoundcategory');
        }

        }

         
         /*$course1 = DB::table('content')->join('subtopics','subtopics.content_id','=','content.content_id')->select('subtopics.sub_tid','subtopics.tid','subtopics.course_id','subtopics.name','subtopics.description','content.content','content.content_id','content.content_type')->where(
            'content.content_id',$id1
         )->first();*/
         //dd($course1);
        
         return view('admin.review.contentshow', compact('course1','video'));

    }
    public function feedback(Request $request)
    {
        $this->validate(request(),[
            'feedback' => 'required',
            
            ]);
        $id=request('content_id');
        $updte = DB::table('subtopics')->where([
                 ['content_id' ,'=', $id]
         ])->update(['review_status' => 'Edit Required']);
        $updte1 = DB::table('content')->where([
                 ['content_id' ,'=', $id]
         ])->update(['feedback' => request('feedback')]);
            $data="{\"content\":[\"$id\"]}";
        $updte = DB::table('notifications')->where([
                 ['data' ,'=', $data]
         ])->update(['read' => '1']);
         $course1 = DB::table('content')->where(
            'content_id',$id
         )->first();
         //create();
         alert()->info('Feedback taken');
         return redirect('/admin/reviewcourse');
       //return view('admin.review.contentshow', compact('course1'));
    }
    public function correct($id)
    {
        
        $updte = DB::table('subtopics')->where([
                 ['content_id' ,'=', $id]
         ])->update(['review_status' => 'Correct']);
        $updte1 = DB::table('content')->where([
                 ['content_id' ,'=', $id]
         ])->update(['feedback' => 'Correct']);
            $data="{\"content\":[\"$id\"]}";
        $updte = DB::table('notifications')->where([
                 ['data' ,'=', $data]
         ])->update(['read' => '1']);
         $course1 = DB::table('content')->where(
            'content_id',$id
         )->first();
        //dd($course1);
          alert()->success('Content Corrected');
       return redirect('/admin/reviewcourse');
    }
     public function editstore(Request $request)
    {

       // dd(request('descriptionsummer'));
        $updte1 = DB::table('content')->where([
                 ['content_id' ,'=', request('content_id')]
         ])->update(['content' => request('descriptionsummer')]);
            $data="{\"content\":[\"request('content_id')\"]}";
        $updte = DB::table('notifications')->where([
                 ['data' ,'=', $data]
         ])->update(['read' => '0']);

         //subtopic update 
        $indexes = DB::table('subtopics')->where([
                 ['tid', '=',  request('tid')],
                 ['course_id', '=', request('course_id')]
         ])->get();
          $updte = DB::table('subtopics')->where([
                    ['sub_tid', '=', request('sub_tid')],
                 ['tid', '=', request('tid')],
                 ['course_id', '=', request('course_id')]
         ])->update(['review_status' => 'Not Reviewed']);
       // return view('editsummer');
           alert()->success('Updated Successfully');
        return redirect('admin/mycourse/'.request('course_id'))->with(compact('course','indexes'));
    }
    public function reviewstructure()
    {
        $auth=Auth::guard('admin')->user()->id;
       
        $courses=[];
        $category1=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->get();
         
        $course=DB::table('course_structure')
            ->where('review_status','=','Reviewing')
            ->get();
        $tempcourses = DB::table('courses')->join('course_structure','courses.id','=','course_structure.course_id')->select('courses.id','courses.name','courses.description','course_structure.demo_content','course_structure.tempstructure','course_structure.review_status')->where('course_structure.review_status','=' ,'Reviewing')->get();
        $i=0;
        foreach ($tempcourses as $key)
        {
          //  dd($key->id);
             $course_category=DB::table('course_category')
            ->where('course_id','=',$key->id)
            ->first();
           // dd($course_category);
            foreach ($category1 as $category)
            {
         
                 if($course_category->category_id==$category->category_id)
                 {
                    $courses[$i]=$key;
                    $i++;
                 }
            }
        }
        //dd(count($courses));
       
            if(count($courses)>0)
            {
                $status=true;
                return view('admin.review.reviewshow', compact('course','courses','status'));
            }
            else{

               return view('admin.review.notfoundcategory');
               // alert()->info('No courses found for your catgory');
                
            }
          
    }
    public function detailreviewstructure($id)
    {
        $auth=Auth::guard('admin')->user()->id;
       
        
        $flag=false;
        $category1=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->get();
         $course_category=DB::table('course_category')
            ->where('course_id','=',$id)
            ->first();
           foreach ($category1 as $category)
            {
         
            if($course_category->category_id==$category->category_id)
            {
                $flag=true;
                $course=DB::table('course_structure')
                ->where('course_id','=',$id)
                ->first();
                $feedback = DB::table('feedback')->where('fid', $course->feedback)->get();
                $courses = DB::table('courses')->join('course_structure','courses.id','=','course_structure.course_id')->select('courses.id','courses.name','courses.description','course_structure.demo_content','course_structure.tempstructure','course_structure.review_status')->where('course_structure.course_id', $id)->get();
                return view('admin.review.structureshow', compact('course','courses','feedback'));

                }
            }
            
         
        
         if($flag==false){
             return view('admin.review.notfoundcategory');
         } 
    }
    public function comment(Request $request)
    {
          $var=Auth::guard('admin')->user()->id;
          
          $course = Admin::find($var);
          $name=$course->first_name.' '.$course->last_name;

        

          $updte = DB::table('course_structure')->where([
                    ['course_id', '=', request('id')]
         ])->update(['review_status'=>'Edit Required']);
        $id= DB::table('course_structure')->where([
                    ['course_id', '=', request('id')]
         ])->first();
        DB::table('feedback')->insert(['fid' =>$id->feedback,'comment'=>request('feedback'),'commenter'=>$name,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
        alert()->success('Feedback Sent Successfully');
          return redirect('/admin/reviewstr');
    }
       public function commentstr(Request $request)
    {

         /* $updte = DB::table('course_structure')->where([
                    ['course_id', '=', request('id')]
         ])->update(['feedback' => request('feedback')]);*/
          /*$id= DB::table('course')->where([
                    ['id', '=', request('id')]
         ])->first();
        DB::table('feedback')->insert(['fid' =>$id->feedback,'comment'=>request('feedback'),'commenter'=>$name,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);*/

          $var=Auth::guard('admin')->user()->id;
          
          $course = Admin::find($var);
          $name=$course->first_name.' '.$course->last_name;

           DB::table('feedback')->insert(['fid' =>request('fid'),'comment'=>request('comment'),'commenter'=>$name,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
          alert()->success('Comment sent !');
      
          return redirect('/admin/review/'.request('cid').'/'.request('tid').'/'.request('sid').'/'.request('contentid'));
    }

    public function structuresuccess($id)
    {
        $temp=DB::table('course_structure')->where('course_id', $id)->first();
        //dd($temp->tempstructure);
          $updte = DB::table('course_structure')->where([
                    ['course_id', '=', $id]
         ])->update(['fixedstructure' => $temp->tempstructure ,'review_status'=>'Okay','feedback'=>null]);
         //dd($updte);
        alert()->success('Reviewed Successfully');
          return redirect('/admin/reviewstr');
    }
}
