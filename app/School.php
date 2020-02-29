<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'school';
    protected $fillable = ['name'];

     public function user_school()
	{
		return $this->hasMany(user_school::Class);
	}
}
