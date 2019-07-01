<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     protected $table="departments";
     protected $fillable = [
        'department_name',
    ];
    public function users()
    {
        return $this->hasMany('App\User','department_id','id');
    }
}
