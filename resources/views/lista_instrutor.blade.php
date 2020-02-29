@extends('template.template')
@section('content')
@if(session('success'))
<div class="alert alert-success mt-2">
	{{ session('success') }}
</div>
@endIf
<div class="mt-3 card">
	<div class="card card-header">
		<h4>Lista de Instrutores</h4>
	</div>
	<div class="card card-body">
		<table width="100%" class="table-list table table-striped display responsive nowrap" id="school">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Assinatura</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@foreach($arrayInstructor as $instructor)	
				<tr>
					<td>{{$instructor->name}}</td>
					<td><img src="{{url('signature/'. $instructor->signature)}}"></td>
					<td>
						<a href="{{route('instructor.edit', $instructor->id)}}">
							<span class="btn btn-info" title="Editar">Editar <i class="fa fa-edit"></i></span> 
						</a>					
					</td>
				</tr>
				@endForeach
			</tbody>
		</table>
	</div>
</div>
@endSection
