<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
     protected $table="permissions";
     protected $fillable = [
        'permission_name',
    ];
    public function users()
    {
        return $this->hasMany('App\User','permission_id','id');
    }
}
