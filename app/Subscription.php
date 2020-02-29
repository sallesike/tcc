<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
	protected $table = 'subscription';
	protected $fillable = ['id', 'status', 'user_id', 'tb_event_id'];

	public function user()
	{
		return $this->belongsTo(User::Class);
	}

	public function event()
	{
		//Eloquent presume-se automaticamente que o modelo tenha uma chave estrangeira event_id
		//Se você deseja substituir esta convenção, pode passar um segundo argumento para o belongsTo
		return $this->belongsTo(event::Class, 'tb_event_id');
	}

	public function certificate()
	{
		return $this->hasOne(certificate::Class);
	}
}
