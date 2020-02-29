@extends('template.template')
@section('content')
<div class="row justify-content-center">
	<div class="col-md-8 mt-3 p-3">
		@if(isset($errors) && count($errors) > 0 )
		@foreach($errors->all() as $error)
		<div class="alert alert-danger">
			<p>{{$error}}</p>
		</div>
		@endForeach
		@endif	
		@if(session('success'))
		<div class="alert alert-primary mt-2">
			{{ session('success') }}
		</div>
		@endIf
		@if(session('error'))
		<div class="alert alert-danger mt-2">
			{{ session('error') }}
		</div>
		@endIf
		<div class="card">
			<div class="card-header">
				Cadastro de instrutor 
				<i class="fa fa-chalkboard-teacher"></i>
			</div>
			<div class="card-body">
				@if(isset($instructor))
				<form method="post" id="instructor" action="{{route('instructor.update', $instructor->id)}}" enctype="multipart/form-data">
					@csrf
					@method('PATCH')
					@else
					<form method="post" id="instructor" action="{{route('instructor.store')}}" enctype="multipart/form-data">
						@csrf
						@endIf
						<div class="form-group row">						
							<label class="col-md-4 col-form-label text-md-right">Nome</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" id="name" value="{{$instructor->name ?? old('name')}}" autofocus>
							</div>						
						</div>
						<div class="form-group row">						
							<label class="col-md-4 col-form-label text-md-right" for="asignature">Assinatura</label>
							<div class="col-md-6">
								<input type="file" class="form-control-file" name="signature" id="signature" value="">
							</div>						
						</div>
						@if(isset($instructor))
						<div class="row">
							<img src="{{url('signature/'. $instructor->signature)}}" class="img-fluid mx-auto d-block">
						</div>
						@endIf
						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4 mt-2">
								<button type="submit" class="btn btn-primary">
									Cadastrar
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	@endSection