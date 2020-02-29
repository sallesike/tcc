<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_school extends Model
{
    protected $table = 'user_school';
    protected $fillable = ['id', 'user_id', 'school_id'];

    public function school()
	{
		return $this->belongsTo(school::Class);
	}

	public function user()
	{
		return $this->belongsTo(User::Class);
	}
}
