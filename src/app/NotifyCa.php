<?php

namespace App;
use DB;
use Auth;


class NotifyCa
{
    
    public function edit($id)
    {
        $auth=Auth::guard('admin')->user()->id;
       
        $courses=[];
        /*
        $category=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->first();*/

        $coursesarr = DB::table('courses')->join('admin_course','id','=','admin_course.course_id')->select('courses.id','courses.name','courses.description')->where([['admin_id', $auth],['admin_course.course_id',$id]])->orderBy('id')->get();
        if(count($coursesarr)>0)
        {
             $updte = DB::table('course_structure')->where([
                    ['course_id', '=', $id],
                    ['review_status','=','Edit Required']
         ])->count();
             if($updte>0)
             {
                return $updte;
             }
             else{
            $course = DB::table('subtopics')->where([
                ['course_id', '=', $id],
                ['review_status','=','Edit Required']
             ])->count();
            return $course;
            }
           // dd($id);
         }
    }
    public function correct($id)
    {
        $auth=Auth::guard('admin')->user()->id;
       
        $courses=[];
        /*
        $category=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->first();*/

        $coursesarr = DB::table('courses')->join('admin_course','id','=','admin_course.course_id')->select('courses.id','courses.name','courses.description')->where([['admin_id', $auth],['admin_course.course_id',$id]])->orderBy('id')->get();
        if(count($coursesarr)>0)
        {
            $course = DB::table('subtopics')->where([
                ['course_id', '=', $id],
                ['review_status','=','Correct']
             ])->count();
            return $course;
           // dd($id);
         }
    }

    public function quiz($id)
    {
        $auth=Auth::guard('admin')->user()->id;
       
        $courses=[];
        /*
        $category=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->first();*/

        $coursesarr = DB::table('courses')->join('admin_course','id','=','admin_course.course_id')->select('courses.id','courses.name','courses.description')->where([['admin_id', $auth],['admin_course.course_id',$id]])->orderBy('id')->get();
        if(count($coursesarr)>0)
        {
            $course = DB::table('quiz')->where([
                ['review_status','=','Edit'],
                ['course_id','=',$id]
             ])->count();
            return $course;
           // dd($id);
         }
    }
    public function quiztopic($id,$id1)
    {
        $auth=Auth::guard('admin')->user()->id;
       
        $courses=[];
        /*
        $category=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->first();*/

        $coursesarr = DB::table('courses')->join('admin_course','id','=','admin_course.course_id')->select('courses.id','courses.name','courses.description')->where([['admin_id', $auth],['admin_course.course_id',$id]])->orderBy('id')->get();
        if(count($coursesarr)>0)
        {
            $course = DB::table('quiz')->where([
                ['review_status','=','Edit'],
                  ['tid','=',$id1],
                ['course_id','=',$id]
             ])->count();
            return $course;
           // dd($id);
         }
    }
     public function edittopic($id,$id1)
    {
        $auth=Auth::guard('admin')->user()->id;
       
        $courses=[];
        /*
        $category=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->first();*/

        $coursesarr = DB::table('courses')->join('admin_course','id','=','admin_course.course_id')->select('courses.id','courses.name','courses.description')->where([['admin_id', $auth],['admin_course.course_id',$id]])->orderBy('id')->get();
        if(count($coursesarr)>0)
        {
            $course = DB::table('subtopics')->where([
                ['course_id', '=', $id],
                ['tid','=',$id1],
                ['review_status','=','Edit Required']
             ])->count();
            return $course;
           // dd($id);
         }
    }
    public function correcttopic($id,$id1)
    {
        $auth=Auth::guard('admin')->user()->id;
       
        $courses=[];
        /*
        $category=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->first();*/

        $coursesarr = DB::table('courses')->join('admin_course','id','=','admin_course.course_id')->select('courses.id','courses.name','courses.description')->where([['admin_id', $auth],['admin_course.course_id',$id]])->orderBy('id')->get();
        if(count($coursesarr)>0)
        {
            $course = DB::table('subtopics')->where([
                ['course_id', '=', $id],
                ['tid','=',$id1],
                ['review_status','=','Correct']
             ])->count();
            return $course;
           // dd($id);
         }
    }
    public function feedback($id)
    {
        $auth=Auth::guard('admin')->user()->id;
       
        $courses=[];
        /*
        $category=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->first();*/

        $coursesarr = DB::table('courses')->join('admin_course','id','=','admin_course.course_id')->select('courses.id','courses.name','courses.description')->where([['admin_id', $auth],['admin_course.course_id',$id]])->orderBy('id')->get();
        if(count($coursesarr)>0)
        {
            $course = DB::table('courses')->join('feedback','feedback','=','feedback.fid')->where('courses.id',$id)->count();
            return $course;
           // dd($id);
         }
    }
     public function status($id,$id1,$id2)
    {
        $auth=Auth::guard('admin')->user()->id;
       
        $courses=[];
        /*
        $category=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->first();*/
        $status="";

        $coursesarr = DB::table('courses')->join('admin_course','id','=','admin_course.course_id')->select('courses.id','courses.name','courses.description')->where([['admin_id', $auth],['admin_course.course_id',$id]])->orderBy('id')->get();
        if(count($coursesarr)>0)
        {
            $course = DB::table('quiz')->where([
                ['sub_tid','=',$id2],
                  ['tid','=',$id1],
                ['course_id','=',$id]
             ])->first();
            if($course!=null){

            return $course->review_status;
            
            }
        else{
                $course="Not Created";
            }
            return $status;
           // dd($id);
         }
    }
}
