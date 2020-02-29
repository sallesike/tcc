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
		<div class="card">
			<div class="card-header">
				Cadastro de Escolas
				<i class="fa fa-graduation-cap"></i>
			</div>
		 	<div class="card-body">
		 		@if(isset($school))
		 		<form method="post" id="school" action="{{route('school.update', $school->id)}}">
			 		@csrf
			 		@method('PATCH')
		 		@else
				<form method="post" id="school" action="{{route('school.store')}}">
					@csrf
				@endIf
					<div class="form-group row">						
						<label class="col-md-4 col-form-label text-md-right">Nome</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" id="name" value="{{$school->name ?? old('name')}}" autofocus>
						</div>						
					</div>
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
</div>
@endsection