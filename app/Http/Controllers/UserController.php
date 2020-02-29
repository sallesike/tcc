<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Event;
use App\Subscription;
use App\Http\Requests\UserRequest;
use App\Http\Requests\SubscriptionRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public $user;
	public $event;
	public $subscription;

	public function __construct(User $user, Event $event, Subscription $subscription)
	{
		$this->user 	= $user;
        $this->event 	= $event;
        $this->subscription = $subscription;
	}

	public function create($id)
	{
		//$arrayEvent = $this->event->all();
		return view('estudante', compact('id'));
	}

	public function store(UserRequest $request)
	{
		$subscription 						= $this->subscription;
		$user 							= $this->user;
		$exists = $subscription->where('user_id', $request['user_id'])->where('tb_event_id', $request['event'])->exists();
		if($exists)
		{			
			return redirect()->back()->with('error-subscription', 'Esse evento ja foi cadastrado para esse estudante, selecione outro evento');
		}
		if ($request['user_id'])
		{
			$subscription->status 			= 'i'; // i = inscrito, a = apto a receber certificado
			$subscription->user_id		= $request['user_id'];
			$event = $this->event->where('id', $request['event'])->first(); 
			$subscription->tb_event_id 		= $event->id;
			$subscription->save();	
			return redirect()->back()->with('sucess', 'Inscrição realizada com sucesso');
		}
		else
		{
			$user->name 					= $request['name'];
			$user->cpf 					= $request['cpf'];
			$user->birthday				= Carbon::createFromFormat(('d/m/Y'), $request['birthday'])->toDate();
			$user->save();		
			$subscription->status 			= 'i'; // i = inscrito, a = apto a receber certificado
			$subscription->user_id		= $user->id; //id do estudante salvo a cima.
			$event = $this->event->where('id', $request['event'])->first(); 
			$subscription->tb_event_id 		= $event->id;
			$subscription->save();		
			return redirect()->back()->with('sucess', 'Inscrição realizada com sucesso');
		}
	}

	public function findByCpf(Request $request)
	{
		$user = $this->user->where('cpf', $request['cpf'])->first();
		if(isset($user)){
			return json_encode($user);
		}
		else
		{
			return json_encode(false);
		}
	}

	public function index()
	{
		$users = $this->user->all();
		return view('lista_usuarios', compact('users'));
	}

	public function show($id)
	{
		$user = $this->user->find($id);
		return view('detalhes_usuario', compact('user'));
	}

	public function edit()
	{
		$name 		= auth()->user()->name;
		$cpf 		= auth()->user()->cpf;
		$birthday	= auth()->user()->birthday;
		$email		= auth()->user()->email;

		return view('perfil', compact('name','cpf', 'birthday', 'email'));
	}

	public function make_admin(Request $request)
	{
		$user = $this->user->find($request['user']);

		if (isset($user)) {
			$user->update(['status' => 'Admin']);
			return redirect()->route('event.index')->with('success', 'Agora o usuario ' . $user->name . 'é um adminstrador');
		}
		else
		{
			return redirect()->route('event.index')->with('error', 'Houve um erro.');	
		}
	}

}
