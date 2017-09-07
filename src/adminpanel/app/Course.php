<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    //
        protected $fillable = [
        'name', 'description','cfilename'
    ];

    public function admins()
    {
    	return $this->belongsToMany(Admin::class);
    }

    public function users()
    {
    	return $this->belongsToMany('App\User', 'user_course_enroll','course_id', 'user_id')->withTimestamps();
    }

    public function categories()
    {
    	return $this->belongsToMany('App\Category', 'course_category', 'course_id', 'category_id')->withTimestamps();
    }
}
