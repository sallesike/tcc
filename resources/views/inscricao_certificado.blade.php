@extends('template.template')
@section('content')
<div class="row justify-content-center">
	<div class="col-md-12 mt-3 p-3">	

		@if(session('success'))
		<div class="alert alert-success mt-2" id="delete-certificate">
			{{ session('success') }}
		</div>
		@endIf
		<div class="card">		
			<div class="card card-header">		
				<h4>{{$event->event->name ?? ""}}</h4>
				<!--<div class="col-md-2" data-toggle="modal" data-target="#modal-set-100">
					<button class="btn btn-primary btn-block" data-placement="top" data-toggle="tooltip" title="define 100% de carga horária a todos">100%</button>
				</div>
				<div class="mt-2 col-md-2" data-toggle="modal" data-target="#finish">
					<button class="btn btn-success btn-block">Finalizar evento</button>
				</div>-->		
			</div>
			<div class="card card-body">
				<table width="100%" class="table-list table table-striped tableEditable display responsive nowrap" id="tb-certificate">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Aproveitamento</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>				
						@foreach($arrayCertificate as $certificate)	
							<tr>					
								<td>{{$certificate->user->name}}</td>
								<td>{{$certificate['harnessing']}}</td>
								<td><input type="button" class="drop_certificate btn btn-danger" data-target="#cancel_certificate" data-toggle="modal" value="Excluir" data-whatever="{{$certificate->id}}"></td>
							</tr>
						@endForeach
						</tbody>						
				</table>	
			</div>	
		</div>
	</div>
</div>

<!--Modal-->
<div class="modal fade" id="cancel_certificate" tabindex="-1" role="dialog" aria-hidden="true">
	<form method="post" action="{{route('certificate.destroy')}}">
		@csrf
		{{ method_field('DELETE') }}
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Tem certeza disso?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Ao excluir um certificado o mesmo perderá sua validade e deixará de existir
	        no nosso banco de dados. Após essa ação será possivel cadastrar uma nova carga
	        hóraria e um novo certificado será gerado para essas inscrição. Tem certeza que 
	        deseja excluir esse certificado?
	      </div>
	      <input type="hidden" id="certificate" name="certificate">
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
	        <button type="submit" class="btn btn-primary">Sim</button>
	      </div>
	    </div>
	  </div>
	</form>
</div>

@endSection
