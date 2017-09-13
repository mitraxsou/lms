<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admin extends Authenticatable
{
	use EntrustUserTrait;
  use Notifiable;
  protected $table='admins';
  //Mass assignable attributes
  protected $fillable = [
      'name', 'email', 'password',
  ];

  //hidden attributes
   protected $hidden = [
       'password', 'remember_token',
   ];

   public function courses()
   {
   		return $this->belongsToMany('App\Course','admin_course','admin_id','course_id')->withTimestamps();
   }

   public function roles()
   {
   		return $this->belongsToMany('App\Role','role_admin', 'admin_id', 'role_id')->withTimestamps();
   }

   // public function owns($related)
   // {
   //    return $this->id == $related->admin_id;
   // }

   public function categories()
   {
      return $this->belongsToMany('App\Category','admin_category','admin_id','category_id')->withTimestamps();
   }
}