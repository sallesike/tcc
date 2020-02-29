<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table 	= 'tb_event';
    protected $fillable = ['name', 'date', 'address', 'status', 'instructor_id', 'workload', 'min_workload'];
    protected $dates 	= ['date'];

    public function subscription()
    {
    	return $this->hasMany(subscription::Class);
    }

    /*public function event()
    {
    	return $this->hasMany(event::Class);
    }*/

    public function school()
    {
    	return $this->hasMany();
    }

    public function instructor()
    {
        return $this->belongsTo(instructor::Class);
    }


}