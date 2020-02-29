<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = "certificate";
    protected $fillable = ['id', 'harnessing', 'code_certificate','subscription_id', 'tb_event_id', 'user_id'];

    public function subscription()
	{
		return $this->hasOne(subscription::Class);
	}

	public function event()
	{
		return $this->belongsTo(event::Class, 'tb_event_id');
	}

	public function user()
	{
		return $this->belongsTo(User::Class);
	}	
}