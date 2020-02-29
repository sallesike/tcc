@extends('template.template')
@section('content')
<div class="mt-3 card">
	<div class="card card-header">		
		Meu Perfil	<i class="fa fa-users"></i>
	</div>
	<div class="card card-body">
		<div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">Nome</label>
			<div class="col-md-6">							
				<input type="text" disabled class="form-control" name="name" id="name" value="{{$name}}">
			</div>						
		</div>	
		<div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">CPF</label>
			<div class="col-md-6">							
				<input type="text" disabled class="form-control" name="cpf" id="cpf" value="{{$cpf}}">
			</div>						
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">Data de Nascimento</label>
			<div class="col-md-6">							
				<input type="text" disabled class="form-control" name="birthday" id="birthday" value="{{date('d/m/Y', strtotime($birthday))}}">
			</div>						
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">Email</label>
			<div class="col-md-6">							
				<input type="text" disabled class="form-control" name="email" id="email" value="{{$email}}">
			</div>						
		</div>
	</div>
</div>

@endSection
