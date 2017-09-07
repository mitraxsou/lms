<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admin extends Authenticatable
{
	use EntrustUserTrait;

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
   		return $this->belongsToMany('App\Course');
   }

   public function roles()
   {
   		return $this->belongsToMany('App\Role','role_admin', 'admin_id', 'role_id')->withTimestamps();
   }
}