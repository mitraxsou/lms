<?php

namespace App;
use DB;
use Auth;


class Counter
{
    
    public function lesson()
    {
        
         $auth=Auth::guard('admin')->user()->id;
       
        $courses=[];
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
       $course=$i;
        return $course;
        
    }
    public function lessonPublish()
    {
        $course = DB::table('publish_course')->where([
            ['publish_status', '=', 'Not Published']
         ])->count();
        return $course;
        
    }
    public function comment()
    {
       $auth=Auth::guard('admin')->user()->id;
       $course=0;
        
        $category1=DB::table('admin_course')
            ->where('admin_id','=',$auth)
            ->pluck('course_id');

         $temp = DB::table('courses')->join('feedback', 'feedback.fid', '=', 'courses.feedback')
            ->where('read',0)
            ->whereIn('courses.id',$category1)->get();
        
             
        // foreach ($temp as $category)
        // {
               
        // $temp = DB::table('course')
        //             ->join('course_category', 'course_category.course_id', '=', 'course_structure.course_id')
        //             ->where([
        //             ['review_status', '=', 'Reviewing'],
        //             ['course_category.category_id','=',$category->category_id]
        //             ])

        //             ->count(DB::raw('DISTINCT course_structure.course_id'));

        // $course+=$temp;
        // }
            return $temp;
        
    }
    public function commentreview()
    {
       $auth=Auth::guard('admin')->user()->id;
       $course=[];
        $i=0;
        $category1=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->pluck('category_id');

         $temp = DB::table('courses')
            ->join('feedback', 'feedback.fid', '=', 'courses.feedback')
            ->join('course_category', 'courses.id', '=', 'course_category.course_id')
            ->join('subtopics', 'subtopics.course_id', '=', 'courses.id')
            ->where('subtopics.review_status','Reviewing')
            ->whereIn('course_category.category_id',$category1)->get();
        
        $temp1 = DB::table('publish_course')
            ->join('feedback', 'feedback.fid', '=', 'publish_course.feedback')
            ->join('course_category', 'publish_course.course_id', '=', 'course_category.course_id')
            ->join('courses', 'courses.id', '=', 'publish_course.course_id')
            ->where('read',0)
            ->whereIn('course_category.category_id',$category1)->get();
            
        foreach($temp as $t)
        {
            $course[$i]=$t;
            $i++;
        }

        foreach($temp1 as $t)
        {
            $course[$i]=$t;
            $i++;
        }
             
        
            return $course;
        
        
    }
    public function commentpublish()
    {
       $auth=Auth::guard('admin')->user()->id;
       $course=0;
       $temp = DB::table('publish_course')
            ->join('feedback', 'feedback.fid', '=', 'publish_course.feedback')
            ->join('courses', 'courses.id', '=', 'publish_course.course_id')
            ->where('read',0)
            ->get();
        return $temp;
        
    }
    public function lessonSuperPublish()
    {
        $course = DB::table('publish_course')->where([
            ['publish_status', '=', 'Super Reviewed']
         ])->count();
        return $course;
        
    }
    public function del()
    {
        $course = DB::table('subtopics')->where([
            ['review_status', '=', 'Request']
         ])->count();
        return $course;
        
    }
    public function lessonstr()
    {
        $auth=Auth::guard('admin')->user()->id;
       $course=0;
        $courses=[];
        $category1=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->get();
        foreach ($category1 as $category)
        {
               
        $temp = DB::table('course_structure')
                    ->join('course_category', 'course_category.course_id', '=', 'course_structure.course_id')
                    ->where([
                    ['review_status', '=', 'Reviewing'],
                    ['course_category.category_id','=',$category->category_id]
                    ])

                    ->count(DB::raw('DISTINCT course_structure.course_id'));

        $course+=$temp;
        }
        //dd($course);
        return $course;
        
    }
    public function lessonreassign()
    {
        $course = DB::table('admin_course')->where([
            ['admin_id', '=', 0]
         ])->count();
        return $course;
        
    }
    public function mycourse()
    {
        $auth=Auth::guard('admin')->user()->id;
       
        $courses=[];
        /*
        $category=DB::table('admin_category')
            ->where('admin_id','=',$auth)
            ->first();*/

        $coursesarr = DB::table('courses')->join('admin_course','id','=','admin_course.course_id')->select('courses.id','courses.name','courses.description')->where([['admin_id', $auth]])->orderBy('id')->get();
        
        if(count($coursesarr)>0)
        {
            foreach ($coursesarr as $course) {
            
            $course2 = DB::table('subtopics')->where([
                ['course_id', '=', $course->id],
                ['review_status','=','Edit Required']
             ])->count();
            $course1 = DB::table('subtopics')->where([
                ['course_id', '=', $course->id],
                ['review_status','=','Correct']
             ])->count();
           if($course2>0  or $course1>0)
           {
            return 1;
           }
           else{
            return 0;
           }
         }
     }
    }

    public function published()
    {
        $count=0;
         $auth=Auth::guard('admin')->user()->id;
         $coursesarr = DB::table('courses')->join('admin_course','id','=','admin_course.course_id')->select('courses.id','courses.name','courses.description')->where([['admin_id', $auth]])->orderBy('id')->get();
        if(count($coursesarr)>0)
        {
                foreach ($coursesarr as $course) {
                 
                $count =$count+ DB::table('publish_course')->where([
                    ['publish_status', '=', 'Published'],
                    ['course_id', '=', $course->id]
                 ])->count();
               
            }
        }
        return $count;
         
        
    }

    public function unpublished()
    {
         $count=0;
        $auth=Auth::guard('admin')->user()->id;
         $coursesarr = DB::table('courses')->join('admin_course','id','=','admin_course.course_id')->select('courses.id','courses.name','courses.description')->where([['admin_id', $auth]])->orderBy('id')->get();
        if(count($coursesarr)>0)
        {
                foreach ($coursesarr as $course) {
                 
                $count =$count+ DB::table('publish_course')->where([
                    ['publish_status', '=', 'Edit'],
                    ['course_id', '=', $course->id]
                 ])->count();
               
            }
        }
         return $count;
        
    }
}
