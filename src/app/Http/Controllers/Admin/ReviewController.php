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
    public function review($id)
    {
        
         $course1 = DB::table('content')->where(
            'content_id',$id
         )->first();
        //dd($course1);
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
        $course=DB::table('topic')
            ->where('review_status','=','Reviewing')
            ->groupBy('course_id')
            ->pluck('course_id');
           
        $courses=DB::table('courses')
            ->whereIn('id',$course)
            ->get();
         //dd($courses);
         return view('admin.review.structureshow', compact('courses'));
          
    }
}
