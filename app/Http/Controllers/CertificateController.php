<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificate;
use App\Subscription;
use App\User;
use App\Event;
use App\Http\Requests\UserRequest;

class CertificateController extends Controller
{
	public $certificate;
    public $Subscription;
    public $user;

    public function __construct(Certificate $certificate, Subscription $subscription, User $user, Event $event)
    {
      $this->certificate    = $certificate;		
      $this->subscription   = $subscription;
      $this->user           = $user;
      $this->event          = $event;
    }

  public function store(Request $request)
  {    
    $exist_certificate = $this->certificate->where('user_id', $request['user_id'])->where('tb_event_id', $request['event_id'])->count();    	
    if($exist_certificate > 0)
    {
        return 'exist';
    }

    do
    {
      $numeric = rand('100000', '999999');
      $exist = $this->certificate->where('code_certificate', $numeric)->first();
    }while($exist != null);
    $insert	= $this->certificate->create(['harnessing' => $request['harnessing'],
      'user_id' => $request['user_id'],
      'code_certificate' => $numeric,
      'tb_event_id'	=> $request['event_id'],
      'subscription_id'	=> $request['subscription_id']
    ]);
    if($insert)
    {
        $this->subscription->where('id', $request['subscription_id'])->update(['status' => 'a']);
        return 'sucess';
    }
    else
    {
       return "Houve um erro ao salvar";
    }
  }

    public function destroy(Request $request)
    {   
        $certificate    = $this->certificate;
        $subscription   = $this->subscription;
        $certificate = $certificate->find($request['certificate']);
        if ($certificate)
        {
            $subscription->where('id', $certificate->subscription_id)->update(['status' => 'i']);
        }
        $certificate->delete();
        return redirect()->back()->with('success', 'Certificado removido com sucesso');
    }

    public function screen_find_certicate()    
    {
        return view('lista_certificados');
    }

    public function certificateByCpf(UserRequest $request)
    {
        $cpf = $request['cpf'];
        $user = $this->user;
        $certificate = $this->certificate;
        $user_id = $user->where('cpf', $cpf)->pluck('id');
        if($user_id == null)
        {
            return redirect()->back()->with('not-found', 'Cpf não encontrado!');
        }
        $student = $user->find($user_id)->first();
        $arrayCertificate = $certificate->where('user_id', $user_id)->get();
        return view('lista_certificados_estudante', compact('arrayCertificate', 'student'));
    }

    public function myCertificate($id)
    {
        $student = $this->user->find($id);
        $arrayCertificate = $this->certificate->where('user_id', $student->id)->get();
        return view('lista_certificados_estudante', compact('arrayCertificate', 'student'));
    }

    public function show($id)
    {        
        $certificate = $this->certificate->find($id);
        $event = $this->event->find($certificate->tb_event_id);
        $instructor = $event->instructor;        
        if (!$certificate)
        {
            return;
        }
        return \PDF::loadView('certificate', compact('certificate', 'instructor'))->setPaper('a4', 'landscape')->stream(kebab_case($certificate->user->name ."-". $certificate->event->name.".pdf"));
    }

    public function validate_certificate($code)
    {
        $certificate = $this->certificate->where('code_certificate', $code)->first();
        if (!$certificate)
        {
            return "Codigo invalido!";
        }

        return \PDF::loadView('certificate', compact('certificate'))->setPaper('a4', 'landscape')->stream($certificate->user->name ."-". $certificate->event->name.".pdf");
    }
}