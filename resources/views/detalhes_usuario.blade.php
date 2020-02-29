@extends('template.template')
@Section('content')
<div class="card mt-3">
	<div class="card-header">
		<label>Dados do usuario.</label>
	</div>
	<div class="mt-2 mx-3 my-3 card-body col-12 col-sm-10 mx-auto">
		<div class="form-group mt-2">
			<label class="col-sm-5">Nome:</label>
			<label>{{$user->name}}</label>
			<hr>
		</div>
		<div class="form-group">
			<label class="col-sm-5">Email:</label>
			<label>{{$user->email}}</label>
			<hr>
		</div>
		<div class="form-group ">
			<label class="col-sm-5">CPF:</label>
			<label>{{$user->cpf}}</label>
			<hr>
		</div>
		<div class="form-group">
			<label class="col-sm-5">Data Nascimento:</label>
			<label>{{date("d/m/Y", strtotime($user->birthday))}}</label>	
			<hr>
		</div>
		<div class="form-group ">
			<label class="col-sm-5">Status:</label>		
			<label>{{$user->status}}</label>		
		</div>
	</div>
</div>
@endSection