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
    
    public function admins()
    {
    	return $this->belongsToMany('App\Admin','admin_category','category_id','admin_id')->withTimestamps();
    }

    public function childCategories()
    {
    	return $this->hasMany('App\Category','parent_id');
    }
}
