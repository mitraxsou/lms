<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Notifications\ReviewContent;
use App;


class ReviewController extends Controller
{
    public function create()
    {
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

         $course1 = DB::table('subtopics')->whereIn(
            'content_id',$arr
         )->get();
       
       return view('admin.review.reviewshow', compact('course1'));
    }
    public function review($id,$id1)
    {
        
         $course1 = DB::table('content')->where(
            'content_id',$id1
         )->first();
         $subtopic=DB::table('subtopics')->where(
            'sub_tid',$id
         )->first();
         $topic= DB::table('topic')->where(
            'course_id',$subtopic->course_id
         )->get();
         $coursearr=DB::table('subtopics')->where(
            'course_id',$subtopic->course_id
         )->get();
         $course= $courses = DB::table('courses')->join('course_structure','courses.id','=','course_structure.course_id')->select('courses.id','courses.name','courses.description','course_structure.fixedstructure','course_structure.tempstructure')
         ->where(
            'course_structure.course_id',$subtopic->course_id
         )->first();

        //dd($course1);
       return view('admin.review.contenthierarchy', compact('course1','subtopic','topic','coursearr','course'));
    }
    public function content($id1)
    {
        
         $course1 = DB::table('content')->join('subtopics','subtopics.content_id','=','content.content_id')->select('subtopics.sub_tid','subtopics.name','subtopics.description','content.content','content.content_id')->where(
            'content.content_id',$id1
         )->first();
         return view('admin.review.contentshow', compact('course1'));
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
        return redirect('admin/mycourse/'.request('course_id').'/'.request('tid'))->with(compact('course','indexes'));
    }
    public function reviewstructure()
    {
        $course=DB::table('course_structure')
            ->where('review_status','=','Reviewing')
            ->get();
        $courses = DB::table('courses')->join('course_structure','courses.id','=','course_structure.course_id')->select('courses.id','courses.name','courses.description','courses.cfilename','course_structure.tempstructure')->where('course_structure.review_status', 'Reviewing')->get();
           
        /*$courses=DB::table('courses')
            ->whereIn('id',$course->course_id)
            ->get();*/
         //dd($courses);
         return view('admin.review.structureshow', compact('course','courses'));
          
    }
    public function comment(Request $request)
    {

          $updte = DB::table('course_structure')->where([
                    ['course_id', '=', request('id')]
         ])->update(['feedback' => request('feedback'),'review_status'=>'Edit Required']);
        alert()->success('Feedback Sent Successfully');
          return redirect('/admin/reviewstr');
    }

    public function structuresuccess($id)
    {
        $temp=DB::table('course_structure')->where('course_id', $id)->first();
        //dd($temp->tempstructure);
          $updte = DB::table('course_structure')->where([
                    ['course_id', '=', $id]
         ])->update(['fixedstructure' => $temp->tempstructure ,'review_status'=>'Okay']);
         //dd($updte);
        alert()->success('Reviewed Successfully');
          return redirect('/admin/reviewstr');
    }
}
