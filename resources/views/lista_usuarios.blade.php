@extends('template.template')
@section('content')
@if(session('success'))
<div class="alert alert-success mt-2">
	{{ session('success') }}
</div>
@endIf
<div class="mt-3 card">
	<div class="card card-header">
		<h4>Lista de usuarios <i class="fa fa-users"></i></h4>
	</div>
	<div class="card card-body">
		<table width="100%" class="table-list table table-striped display responsive nowrap" id="school">
			<thead>
				<tr>
					<th>Nome</th>
					<th>CPF</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)	
				<tr>
					<td>{{$user->name}}</td>
					<td>{{$user->cpf}}</td>
					<td>
						<a href="{{route('user.show', $user->id)}}" alt='visualizar' class="btn btn-primary">Ver <i class="fa fa-eye"></i></a>
						@if($user->status != 'Admin')
						<a href="{{route('user.show', $user->id)}}" alt='visualizar' class="btn btn-info" data-target="#modal_admin" data-toggle="modal" data-whateverid="{{$user->id}}" data-whatevername="{{$user->name}}">Admin <i class="fa fa-user-cog"></i></a>
						@endif
					</td>
				</tr>
				@endForeach
			</tbody>
		</table>
	</div>
</div>

<!--Modal-->
<div class="modal fade" id="modal_admin" tabindex="-1" role="dialog" aria-hidden="true">
	<form method="post" action="{{route('user.make_admin')}}">
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
	      	Ao Executar essa Ação estará dando poderes de administrador para o usuario
	      	<span id="user-name"></span>.
	      </div>
	      <input type="hidden" id="user" name="user">
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
	        <button type="submit" class="btn btn-primary">Sim</button>
	      </div>
	    </div>
	  </div>
	</form>
</div>
@endSection
