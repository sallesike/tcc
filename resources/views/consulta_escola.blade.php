@extends('template.template')
@section('content')
@if(session('success'))
<div class="alert alert-success mt-2">
	{{ session('success') }}
</div>
@endIf

<table class="table-list table table-striped" id="school">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		@foreach($arraySchool as $school)	
		<tr>
			<td>{{$school->name}}</td>
			<td>
				<a href="{{route('school.edit', $school->id)}}">
					<span class="btn btn-info" title="Editar">Editar</span>
				</a>					
			</td>
		</tr>
		@endForeach
	</tbody>
</table>
@endSection