@extends('template.template')
@section('content')
<div class="row justify-content-center">
	<div class="col-md-12 mt-3 p-3">	

		<div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000">
  			<div role="alert" aria-live="assertive" aria-atomic="true">teste</div>
		</div>
	</div>
</div>
@if(session('success'))
<div class="alert alert-success mt-2">
	{{ session('success') }}
</div>
@endIf
<div class="card">		
	<div class="card card-header">		
		<div class="col-5">
			<h3>{{$nameEvent->name ?? ""}}</h3>
		</div>
		<div class="col-3">
			<a target="_blank" href="{{route('subscription.subscribers', $nameEvent->id)}}"  class="btn btn-primary btn-block" title="Imprime lista de inscritos">imprimir <i class="fa fa-print"></i></a>			
		</div>
	</div>
	<div class="card card-body">
		<table class="table-list table table-striped tableEditable" id="tb-certificate">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Carga Horaria</th>
					<th>Ação</th>
				</tr>
					<!--Alerta de sucesso-->
					<div class="alert alert-success" id="success-alert">
			  			<button type="button" class="close" data-dismiss="alert">x</button>
			  			<strong>Sucesso!! </strong> Carga horária salva.
					</div>
					<!--Alerta campo em branco-->
					<div class="alert alert-danger" id="error-alert">
			  			<button type="button" class="close" data-dismiss="alert">x</button>
			  			<strong>Erro!</strong> O campo está em branco.
					</div>
			</thead>
			<tbody>				
				@foreach($arraySubscription as $subscription)	
				<tr>					
					<td>{{$subscription->user->name}}</td>
					<td class="editable">	
						<input type="text" class="harnessing">				
						<input type="hidden" class="user_id" value="{{$subscription->user->id}}">
						<input type="hidden" class="event_id" value="{{$subscription->event->id}}">
						<input type="hidden" class="subscription_id" value="{{$subscription->id}}">
					</td>
					<td><input type="button" class="save_certificate btn btn-dark" value="Salvar"></td>
				</tr>
				@endForeach
				</tbody>						
		</table>	
	</div>	
</div>
@endSection


<!-- Modal -->
<div class="modal fade" id="modal-set-100" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tem certeza disso?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Ao aceitar essa ação, todos os participantes desse eventos terão a carga horária
        definada como 100% de frequência.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
        <button type="button" id="set-100" data-dismiss="modal" class="btn btn-primary">Sim</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Finalizar evento-->
<div class="modal fade" id="finish" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tem certeza disso?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Essa ação finalizará esse evento e o/os aluno que possuir aproveitamento satisfatório
        poderá gerar seu certicado. Aproveitamento em branco será considerado 0, você poderá
        mudar isso mais tarde.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
        <button type="button" id="set-100" data-dismiss="modal" class="btn btn-primary">Sim</button>
      </div>
    </div>
  </div>
</div>





