<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table 	= 'instructor';
    protected $fillable = ['name', 'signature'];

    public function event()
    {
    	return $this->hasMany(Event::class);
    }

}
