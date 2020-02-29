@extends('template.template')
@section('content')
<div class="row justify-content-center">
	<div class="col-md-8 mt-3 p-3">
		@if(isset($errors) && count($errors) > 0 )
	<div class="alert alert-danger">
		@foreach($errors->all() as $error)
		<p>{{$error}}</p>
		@endForeach
	</div>
		@endIf
		@if(session('sucess'))
			<div class="alert alert-primary mt-2">
			{{ session('success') }}
			</div>
		@endIf
		<div class="card">
			<div class="card-header">
				Cadastro de Estudante
			</div>			
			<div class="card-body">				
				<form method="post" action="{{route('user.store')}}">
					<input type="hidden" value="0" name="user_id" id="user_id">
					@csrf					
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">CPF</label>
					<div class="col-md-6">							
						<input type="text" class="form-control" name="cpf" id="cpf" value="{{$user->cpf ?? old('cpf')}}">			
					</div>
					<span id="error-cpf"></span>						
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Nome</label>
					<div class="col-md-6">							
						<input type="text" disabled class="form-control" name="name" id="name" value="{{$user->name ?? old('name')}}">
					</div>						
				</div>						
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Data de Nascimento</label>
					<div class="col-md-6">							
						<input type="text" disabled class="form-control" name="birthday" id="birthday" value="{{$user->birthday ?? old('birthday')}}">
					</div>						
				</div>

				<input type="hidden" name="event" id="event" value="{{$id}}">
				<div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Cadastrar
                            </button>
                        </div>
                    </div>	
				</form>
			</div>
		</div>
	</div>
@endsection