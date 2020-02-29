@extends('template.template')
@section('content')
<div class="row justify-content-center">
	<div class="col-md-12 mt-3 p-3">	
		@if(isset($errors) && count($errors) > 0 )
		@foreach($errors->all() as $error)
		<div class="alert alert-danger">
			<p>{{$error}}</p>
		</div>
		@endForeach
		@endif
		@if(session('not-found'))
		<div class="alert alert-danger">
			<p>{{session('not-found')}}</p>
		</div>
		@endIf
		<div class="card">
			<div class="card-header">				
				<h4>Digite seu cpf para listar seus certicados.</h4>				
			</div>
			<div class="card card-body">
				<form method="POST" action="{{route('certificate.ByCpf')}}" id="find_certificate">
					@csrf
					<div class="form-group row">
						<label class="col-md-4 col-form-label text-md-right" for="cpf">CPF</label>
						<div class="col-md-3">
							<input type="text" name="cpf" id="cpf" class="form-control" autofocus>
						</div>
						<div class="col-sm-4 col-md-1 mt-1 mt-sm-0 px-sm-0">
							<button class="btn btn-primary">Buscar</button>
						</div>
					</div>				
				</form>
			</div>
		</div>
	</div>
</div>
@endSection