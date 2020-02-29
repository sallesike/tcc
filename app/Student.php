<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
    protected $fillable = ['id', 'cpf', 'birthday'];
    protected $dates = ['birthday'];

    public function student_school()
	{
		return $this->hasMany(student_school::Class);
	}

    public function subscription()
	{
		return $this->hasMany(subscription::Class);
	}
}
