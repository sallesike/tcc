<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Certificate;
use App\Event;
use Illuminate\Support\Facades\Gate;

class SubscriptionController extends Controller
{
	public $subscription;
	public $certificate;
	public $event;

	public function __construct(Subscription $subscription, Certificate $certificate, Event $event)
	{
		$this->subscription = $subscription;
		$this->certificate 	= $certificate;
		$this->event 		= $event;
	}

	public function index ()
	{
		if(Gate::allows('eAdmin'))
		{
			$arraySubscription = $this->subscription->all();
			return view('consulta_inscricao', compact('arraySubscription'));
		}
		if(Gate::denies('eAdmin'))
		{
			return view('erro-403');
		}
	}

	public function store(Request $request)
	{
		$data = $request->all();
		$data['status'] = 'i';
		$subscription = $this->subscription->create($data);
		if($subscription)
		{
			return redirect()->route('subscription.confirm')->with('success', "Inscrição realizada com sucesso!");
		}
	}

	public function show($id)
    {   
    	if(Gate::allows('eAdmin'))
		{
	        $arraySubscription = $this->subscription->where('tb_event_id', $id)->where('status', 'i')->get();
	        $nameEvent = $this->event->find($id);
	        return view('mostra_inscricao', compact('arraySubscription', 'nameEvent'));
	    }
	    if(Gate::denies('eAdmin'))
		{
			return view('erro-403');
		}
    }

    public function finish($id)
    {
    	if(Gate::allows('eAdmin'))
		{
	    	$arrayCertificate = $this->certificate->where('tb_event_id', $id)->get();
	    	$event = $this->subscription->where('tb_event_id', $id)->first(); 
	    	/*$arraySubscription = $this->subscription->where('tb_event_id', $id)->where('status', 'a')->get();
	        
	        $i = 0;
	        foreach($arraySubscription as $i => $subscription)
	        {
	        	$certificate[$i] = $this->certificate->where('subscription_id', $subscription->id)->where('tb_event_id', $event->id);
	        }
	        dd($certificate);*/
	        return view('inscricao_certificado', compact('arrayCertificate', 'event'));
	    }
	    if(Gate::denies('eAdmin'))
		{
			return view('erro-403');
		}
    }

    public function confirm()
    {
    	return view('confirmacao_inscricao');
    }

    public function subscribers($id)
    {
    	if(Gate::allows('eAdmin'))
		{
	        $users = $this->subscription->where('tb_event_id', $id)->where('status', 'i')->get();
	        $event = $this->event->where('id', $id)->first();   

	        return \PDF::loadView('lista_inscritos_pdf', compact('users', 'event'))->setPaper('a4')->stream(kebab_case("lista-". $event->name.".pdf"));	        
	    }
	    if(Gate::denies('eAdmin'))
		{
			return view('erro-403');
		}

    }
}