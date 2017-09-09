<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Admin;

use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;
use Storage;

class ContentController extends Controller
{
    public function changeContent($cid,$tid,$stid)
    {
    	$course1 = DB::table('subtopics')->where([
                 ['sub_tid', '=', $stid],
                 ['tid', '=', $tid],
                 ['course_id', '=', $cid]
         ])->first();
         //dd($course1->name);
         $course=  DB::table('content')->where([
                 ['content_id', '=', $course1->content_id],
         ])->first();

         return view('admin.course.content.changecontenttype',compact('course','course1'));
    }
    public function viewcontent($id)
    {
        $course1 = DB::table('subtopics')->where([
                 ['content_id', '=', $id]
         ])->first();
         //dd($course1->name);
         $course=  DB::table('content')->where([
                 ['content_id', '=', $id],
         ])->first();

         return view('admin.review.viewcontent',compact('course','course1'));
    }

    public function deleteContent($contid)
    {
    	
         //dd($course1->name);
         $course=  DB::table('content')->where([
                 ['content_id', '=', $contid],
         ])->first();

         $course1 = DB::table('subtopics')->where([
         		['content_id','=',$contid],
         	])->first();
         //dd($course1);

         if($course->content_type!="video")
         {
         	DB::table('content')->where([
                 ['content_id', '=', $course->content_id],
         ])->update(['content'=>"",'content_type'=>""]);
            return redirect('/admin/mycourse/contentselection/'.$course1->course_id.'/'.$course1->tid.'/'.$course1->sub_tid);
         }
         else
         {
         	$s3=Storage::disk('s3');
	        $s3->exists($course->content);
	        try{
	            $s3->delete($course->content);
	            DB::table('content')->where([
	                 ['content_id', '=', $course->content_id],
	         ])->update(['content'=>"",'content_type'=>""]);
	        }
	        catch(S3Exception $se)
	        {
	            return redirect()->back()->with('failure','Some exception occured');
	        }
	        return redirect('/admin/mycourse/contentselection/'.$course1->course_id.'/'.$course1->tid.'/'.$course1->sub_tid);
	     }
	 }

	  public function storeContent(Request $request)
	    {
	      	$this->validate(request(),[
            'contid' => 'required',
            ]);
            $course=DB::table('subtopics')->where([
         		['content_id','=',request('contid')],
         	])->first();
         	//dd($course);

            if(request('summernote')!="")
        	{
        		$this->validate(request(),[
        			'summernote'=>'required',
        		]);
            	$content=request('summernote');
            	$contentType="others";

            	DB::table('content')->where([
                 ['content_id', '=', request('contid')],
         		])->update(['content'=>$content ,'content_type'=>$contentType]);

         		$course=DB::table('subtopics')->where([
         			['content_id','=',request('contid')],
         			])->first();

         		return redirect('/admin/mycourse/'.$course->course_id.'/'.$course->tid.'/'.$course->sub_tid);
        	}
        	else if(request('title')!="")
        	{
        		$cor=Course::find($course->course_id);
        		$c_name=$cor->name;
       			$topic = DB::table('topic')->where([['tid', $course->tid],['course_id',$course->course_id]])->first();
        		$t_name=$topic->name;
        
        		$st_name=$course->name;

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

		        DB::table('content')->where([
                 ['content_id', '=', request('contid')],
         		])->update(['content'=>$content ,'content_type'=>$contentType]);

         		return redirect('/admin/mycourse/'.$course->course_id.'/'.$course->tid.'/'.$course->sub_tid);

         		fclose($source);
        	}

	    }
}
