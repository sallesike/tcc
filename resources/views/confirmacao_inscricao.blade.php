@extends('template.template')
@section('content')
<div class="card mt-3">
	<div class="card card-body">
	@if(session('success'))
		<div class="alert alert-success mt-2">
			{{ session('success') }}
		</div>
		<a class="btn btn-info" href="{{route('event.select')}}">Nova inscrição</a>
	@endif
	</div>
</div>
@endSection
