<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Course;
use App;
use DateTime;
use Storage;
use Carbon\Carbon; 
use App\Notifications\ReviewContent;


class SubTopicController extends Controller
{
    //
    public function create($cid,$tid)
    {
        $course=Course::find($cid);
        $topic = DB::table('topic')->where([['tid', $tid],['course_id',$cid]])->first();
        return view('admin.course.subtopic.createsubtopic', compact('course','topic'));
    }

    public function edit($cid, $tid, $stid)
    {
        $indexes = DB::table('subtopics')->where([['tid', $tid],['course_id',$cid],['sub_tid',$stid]])->get();
        //dd($indexes);
        
        return view('admin.course.subtopic.editsubtopic',compact('indexes'));
    }

    public function update(Request $request, $cid,$tid,$stid)
    {
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required'
        ]);
      
         DB::table('subtopics')->where([['Sub_tid',$stid],['tid', $tid],['course_id',$cid]])->update(['name'=>request('name'),'description'=>request('description'),'updated_at'=>Carbon::now()]);
        alert()->success('Content updated successfully');
        return redirect('/admin/mycourse/'.$cid);//->with('sweetalert','Subtopic updated successfully.');
    }

    public function contentshow($id,$id1,$id2)
    {/*
        $cont = DB::table('subtopics')->where([['course_id',$cid],['tid',$tid],['sub_tid', $stid]])->first();
        $course=Course::find($cid);
        $topic = DB::table('topic')->where([['tid', $tid],['course_id',$cid]])->first();
        return view('admin.course.viewonly.viewcontent', compact('course','topic','cont'));*/
         $course1 = DB::table('subtopics')->where([
                 ['sub_tid', '=', $id2],
                 ['tid', '=', $id1],
                 ['course_id', '=', $id]
         ])->first();
         //dd($course1->content_id);
         $course=  DB::table('content')->where([
                 ['content_id', '=', $course1->content_id],
         ])->first();
        return view('admin.course.viewonly.viewcontent', compact('course','course1'));
    }
       public function store(Request $request)
    {
        

        $this->validate(request(),[
            
            'tid'=> 'required',
            'cid'=> 'required',
            'name' => 'required',
            'description'=>'required',
            ]);
         
        $course=Course::find(request('cid'));
        $c_name=$course->name;
        $topic = DB::table('topic')->where([['tid', request('tid')],['course_id',request('cid')]])->first();
        $t_name=$topic->name;
        
        $st_name=request('name');


        if(request('summernote')!="")
        {
            $content=request('summernote');
            $contentType="others";
        }

        else if(request('title')!="")
        {
           $this->validate(request(),[
            'title'=>'required',
            'video'=>'required|max:1004800',
            ]);
            ini_set('memory_limit','256M');
           $imageName = request('title').'.'. $request->file('video')->getClientOriginalExtension();
            $path=$c_name.'/'.$t_name.'/'.$st_name.'/'.$imageName;
            $s3=Storage::disk('s3');
            $source=fopen($request->file('video'), 'r+');
            $s3->put($path,$source,'public');

           
            $content=$path;
            $contentType="video";
        }
        else{
            $this->validate(request(),[
            
            'summernote'=>'required',
            ]);
        }
                
         $nextId = DB::table('subtopics')->where([['course_id',request('cid')],
            ['tid',request('tid')]
            ])->max('sub_tid')+1;
        $current = abs( crc32( uniqid() ) ); //1551585806

        
         DB::table('subtopics')->insert([
            'tid'=>request('tid'),
            'course_id'=>request('cid'),
            'sub_tid'=>$nextId,
            'name'=>request('name'),
            'description'=>request('description'),
            //'stfilename'=>request('description'),
            'content_id'=>$current,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
            
            ]);
        DB::table('content')->insert([
            'content_id'=>$current,
            'content'=>$content,
            'content_type'=>$contentType
            ]);

            alert()->success('Successful!!You will find your subtopic in this list.')->persistent("Close this");
          return redirect('/admin/mycourse/'.request('cid'));
    }

    public function destroy($cid, $tid, $stid)
    {
        $course1 = DB::table('subtopics')->where([
                 ['sub_tid', '=', $stid],
                 ['tid', '=', $tid],
                 ['course_id', '=', $cid]
         ])->first();

        $cont = DB::table('content')->where([
                 ['content_id', '=', $course1->content_id],
         ])->first();

        if($cont->content_type=="video")
        {
            $s3=Storage::disk('s3');
            $s3->exists($cont->content);
            try
            {
                $s3->delete($cont->content);
            }
            catch(S3Exception $se)
            {
                return redirect()->back()->with('failure','Some exception occured');
            }
        }


        DB::table('content')->where([
                 ['content_id', '=', $course1->content_id],
         ])->delete();

        DB::table('subtopics')->where([
                 ['sub_tid', '=', $stid],
                 ['tid', '=', $tid],
                 ['course_id', '=', $cid]
         ])->delete();
        alert()->success('Content deleted successfully');
        return redirect('/admin/mycourse/'.$cid);
    }
    
    public function editcontent($id,$id1,$id2)
    {
         $course1 = DB::table('subtopics')->where([
                 ['sub_tid', '=', $id2],
                 ['tid', '=', $id1],
                 ['course_id', '=', $id]
         ])->first();
         //dd($course1->content_id);
         $course=  DB::table('content')->where([
                 ['content_id', '=', $course1->content_id],
         ])->first();

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
            
        return view('admin.course.content.editcontent', compact('course','course1','video'));
    }

    public function editmaking($id,$id1,$id2)
    {
         $course1 = DB::table('subtopics')->where([
                 ['sub_tid', '=', $id2],
                 ['tid', '=', $id1],
                 ['course_id', '=', $id]
         ])->first();
         //dd($course1->content_id);
         $course=  DB::table('content')->where([
                 ['content_id', '=', $course1->content_id],
         ])->first();
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
        // alert()->message('Sweet Alert with message.');
        return view('admin.course.editmaking', compact('course','course1','video'));
    }

    public function editcontentmaking(Request $request)
    {

       // dd(request('descriptionsummer'));
        $updte1 = DB::table('content')->where([
                 ['content_id' ,'=', request('content_id')]
         ])->update(['content' => request('descriptionsummer')]);
       
        $indexes = DB::table('subtopics')->where([
                 ['tid', '=',  request('tid')],
                 ['course_id', '=', request('course_id')]
         ])->get();
        
       // return view('editsummer');
        alert()->success('Edit done Successfully');
        return redirect('admin/mycourse/'.request('course_id'))->with(compact('course','indexes'));
    }

    public function reviewcontent($id,$id1,$id2)
    {

         $course1 = DB::table('subtopics')->where([
                 ['sub_tid', '=', $id2],
                 ['tid', '=', $id1],
                 ['course_id', '=', $id]
         ])->pluck('content_id');
         /*************For sending to page********/
         $course = DB::table('topic')->where([
                 ['tid', '=', $id1],
                 ['course_id', '=', $id]
         ])->first();
         
         //subtopic update 
        $indexes = DB::table('subtopics')->where([
                 ['tid', '=', $id1],
                 ['course_id', '=', $id]
         ])->get();
        /**************Ends here****************/
        $user=App\Admin::where('id',1)->first();
        $user->notify(new ReviewContent($course1));
          $updte = DB::table('subtopics')->where([
                 ['sub_tid', '=', $id2],
                 ['tid', '=', $id1],
                 ['course_id', '=', $id]
         ])->update(['review_status' => 'Reviewing']);
       // return view('editsummer');
        /*return redirect('admin/mycourse/'.$id.$id1)->with(compact('course','indexes'));*/
        alert()->success('Content Sent for Reviewing!!');
         return redirect('admin/mycourse/'.$id)->with(compact('course','indexes'));
    }
    
    public function removeVideo($cid, $tid, $stid)
    {
        $course1 = DB::table('subtopics')->where([
                 ['sub_tid', '=', $stid],
                 ['tid', '=', $tid],
                 ['course_id', '=', $cid]
         ])->first();
         //dd($course1->content_id);
         $course=  DB::table('content')->where([
                 ['content_id', '=', $course1->content_id],
         ])->first();
        $s3=Storage::disk('s3');
        $s3->exists($course->content);
        try{
            $s3->delete($course->content);
            DB::table('content')->where([
                 ['content_id', '=', $course1->content_id],
         ])->update(['content'=>""]);
        }
        catch(S3Exception $se)
        {
            return redirect()->back()->with('failure','Some exception occured');
        }
        return redirect()->back()->with('success','file deletion successfully');
    }
}
