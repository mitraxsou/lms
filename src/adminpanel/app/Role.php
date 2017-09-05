<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable= [
    	'name', 'display_name', 'description',
    ];

    public function permissions()
    {
    	return $this->belongsToMany('App\Permission','permission_role','role_id','permission_id');
    }

    public function admins()
    {
    	return $this->belongsToMany('App\Admin','role_admin','role_id','admin_id')->withTimestamps();
    }
}
