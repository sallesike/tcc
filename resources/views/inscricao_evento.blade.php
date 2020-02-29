@extends('template.template')
@section('content')
@if(session('success'))
<div class="alert alert-success mt-2">
	{{ session('success') }}
</div>
@endIf
<div class="card mt-3">
	<div class="card card-header">
		<h4>Eventos com inscrições abertas.</h4>
	</div>
	<div class="card card-body">
		<table width="100%" class="table-list table table-striped display responsive nowrap" id="tb_event">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Data</th>
					<th>Local</th>	
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@foreach($events as $event)	
				<tr>
					<td>{{$event->name}}</td>
					<td>{{$event->date->format('d/m/Y')}}</td>
					<td>{{$event->address}}</td>
					<td>
						<button class="btn btn-link" data-target="#accept-subscription" data-toggle="modal" data-whatevername="{{$event->name}}" data-whateverid="{{$event->id}}" data-whateverdate="{{$event->date->format('d/m/Y')}}"> <i class="fa fa-arrow-circle-right"></i>Inscrever-se</button>								
					</td>
				</tr>
				@endForeach
			</tbody>
		</table>
	</div>
</div>

<!--Modal-->
<div class="modal fade" id="accept-subscription" tabindex="-1" role="dialog" aria-hidden="true">
	<form method="post" action="{{route('subscription.store')}}">
		@csrf
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Tem certeza disso?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       Confirma a inscrição para o evento <span id="name-event"></span>, no dia <span id="date-event"></span>.
	      </div>
	      <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
	      <input type="hidden" id="tb_event_id" name="tb_event_id">
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
	        <button type="submit" class="btn btn-primary">Sim</button>
	      </div>
	    </div>
	  </div>
	</form>
</div>
@endSection