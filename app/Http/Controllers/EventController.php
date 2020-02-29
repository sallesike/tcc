<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Event;
use App\Subscription;
use App\Instructor;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class EventController extends Controller
{
	public $event;
    public $Subscription;

	public function __construct(Event $event, Carbon $carbon, Subscription $subscription, Instructor $instructor)
	{
		$this->event = $event;
        $this->carbon = $carbon;
        $this->subscription = $subscription;
        $this->instructor = $instructor;
	}

    public function create()
    {
        if(Gate::allows('eAdmin'))
        {   
           $arrayInstructor = $this->instructor->all();
    	   return view('evento', compact('arrayInstructor'));
        }
        if(Gate::denies('eAdmin'))
        {
            return view('erro-403');
        }
    }

    public function store(EventRequest $request)
    {    	     
        $date = Carbon::createFromFormat(('d/m/Y'), $request['date'])->toDate();       
    	$insert = $this->event->create(['name' => $request['name'], 'date' => $date, 'address' => $request['address'], 'status' => 'Aberto', 'instructor_id' => $request['instructor_id'],'workload' => $request['workload'],'min_workload' => $request['min_workload']]);
    	
    	if($insert)
    	{
    		return redirect()->route('event.index')->with('success', 'Evento salvo com sucesso!');
    	}else
        {
            return "Houve um erro ao salvar.";
        }
    }

    public function index()
    {
        if(Gate::allows('eAdmin'))
        {
            $events = $this->event->all();
            return view('consulta_evento', compact('events'));
        }

        if(Gate::denies('eAdmin'))
        {
            return view('erro-403');
        }
    }

    public function edit($id)
    {
        if(Gate::allows('eAdmin'))
        {   
            $event = $this->event->find($id);
            $date = $event['date']->format('d/m/Y');
            $arrayStatus = ['Aberto', 'Em Andamento', 'Finalizado', 'Cancelado'];
            $arrayInstructor = $this->instructor->all();
            return view('evento', compact('event', 'arrayStatus', 'date', 'arrayInstructor'));
        }
        if(Gate::denies('eAdmin'))
        {
            return view('erro-403');
        }
    }

    public function update(EventRequest $request, $id) 
    {
        $data = $request->all();
        $data['date'] = Carbon::createFromFormat(('d/m/Y'), $data['date'])->toDate();
        $event = $this->event->find($id);
        $update = $event->update($data);

   
        if($update)
        {
            return redirect()->route('event.index')->with('success', 'Evento salvo com sucesso!');
        }
        else
        {
            return "Houve um erro ao salvar.";
        }
    }

    public function finish()
    {
         $events = $this->event->all();
        return view('eventos_finalizados', compact('events'));
    }    

    public function select_event()
    {
        $subscription = $this->subscription->where('user_id', auth()->user()->id)->get(['tb_event_id']);
        if($subscription)
        {   
            $events = $this->event->where('status', 'Aberto')->whereNotIn('id', $subscription)->get();
            return view('inscricao_evento', compact('events'));
        }
        $events = $this->event->where('status', 'Aberto')->get();
        return view('inscricao_evento', compact('events'));
    }
}
