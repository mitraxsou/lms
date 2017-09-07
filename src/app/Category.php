<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable= [
    	'name', 'description',
    ];

    public function courses()
    {
    	return $this->belongsToMany('App\Course' , 'course_category', 'category_id', 'course_id')->withTimestamps();
    }
}
