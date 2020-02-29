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
		<div class="card">
			<div class="card-header">
				Cadastro de Eventos
				<i class="fa fa-calendar-alt"></i>
			</div>
		 	<div class="card-body">
		 		@if(isset($event))
				<form method="post" id="event" action="{{route('event.update', $event->id)}}">
						@csrf
						@method('PATCH')    					
		 		@else
				<form method="post" id="event" action="{{route('event.store')}}">
					 @csrf
				@endif					
					<div class="form-group row">
						<label class="col-md-4 col-form-label text-md-right">Nome</label>
						<div class="col-md-6">							
						<input type="text" class="form-control" autofocus name="name" id="name" value="{{$event->name ?? old('name')}}">
						</div>						
					</div>
					<div class="form-group row">						
						<label class="col-md-4 col-form-label text-md-right">Data</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="date" id="date" value="{{$date ?? old('date')}}">
						</div>						
					</div>
					<div class="form-group row">						
						<label class="col-md-4 col-form-label text-md-right">Endereço</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="address" id="address" value="{{$event->address ?? old('address')}}">
						</div>						
					</div>
					<div class="form-group row">						
						<label class="col-md-4 col-form-label text-md-right">Carga Horária</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="workload" id="workload" value="{{$event->workload ?? old('workload')}}">
						</div>						
					</div>
					<div class="form-group row">						
						<label class="col-md-4 col-form-label text-md-right">Carga Horária minima</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="min_workload" id="min_workload" value="{{$event->min_workload ?? old('min_workload')}}">
						</div>						
					</div>
					<div class="form-group row">						
						<label class="col-md-4 col-form-label text-md-right">Escolher instrutor do evento</label>
						<div class="col-md-6">
							<input type="button" class="btn btn-secondary" id="choose-signature" value="Assinatura" data-target="#modal-signature" data-toggle="modal">	
							<i class="fa fa-signature"></i>						
						</div>						
					</div>
					@if(isset($event))
					<div class="form-group row justify-content-md-center">
						<img src="{{url('signature/'. $event->instructor->signature)}}" class="img-fluid">
					</div>
					@endIf
					@if(isset($event))
					<div class="form-group row">
						<label class="col-md-4 col-form-label text-md-right">Status</label>
						<div class="col-md-6">
							<select name="status" id="status" class="form-control">
								@foreach ($arrayStatus as $status)
								<option value="{{$status}}"
								@if(isset($event) && $event->status == $status)
									selected
								@endIf

								>{{$status}}</option>
								@endForeach
							</select>
						</div>
					</div>
					@endIf					
					<input type="hidden" name="instructor_id" id="instructor-id" value="{{$event->instructor->id ?? '' }}">
					<div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button class="btn btn-primary">
                                Cadastrar
                            </button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--Modal-->
<div class="modal fade" id="modal-signature" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Selecione o instrutor e a assinatura para esse evento.</h5> 	        
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>	          
	        </button>
	      </div>
	      <div class="modal-body">
	      	@foreach($arrayInstructor as $instructor)
	      	<ul>
	      		<li>{{$instructor->name}}</li>	      
	      		<img src="{{url('signature/' . $instructor->signature)}}">
	      		<input type="radio" class="form-check-input ml-4" name="signature" value="{{$instructor->id}}">
	      	</ul>
	      	@endForeach
	      </div>
	      <input type="hidden" id="certificate" name="certificate">
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="send-signature" data-dismiss="modal">Enviar</button>
	      </div>
	    </div>
	  </div>
	</form>
</div>
@endsection