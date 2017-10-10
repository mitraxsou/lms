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
}
