<?php

namespace App;
use DB;



class Counter
{
    
    public function lesson()
    {
        $course = DB::table('notifications')->where([
            ['read', '=', 0]
         ])->count();
        return $course;
        
    }
    public function lessonPublish()
    {
        $course = DB::table('publish_course')->where([
            ['publish_status', '=', 'Not Published']
         ])->count();
        return $course;
        
    }
}
