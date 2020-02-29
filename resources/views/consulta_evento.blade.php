@extends('template.template')
@section('content')
@if(session('success'))
<div class="alert alert-success mt-2">
	{{ session('success') }}
</div>
@endIf
<div class="card mt-3">
	<div class="card-header">
		<h4>Lista de Eventos</h4>
	</div>
	<div class="card card-body">
		<table width="100%" class="table-list table table-striped table-striped display responsive nowrap" id="tb_event">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Data</th>
					<th>Endereco</th>	
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@foreach($events as $event)	
				<tr>
					<td>{{$event->name}}</td>
					<td>{{$event->date->format('d/m/Y')}}</td>
					<td>{{$event->address}}</td>
					<td>
						<a href="{{route('event.edit', $event->id)}}">
							<span class="btn btn-info" title="Editar">Editar</span>
						</a>	
						<a href="{{route('event.show', $event->id)}}">
							<span class="btn btn-primary" title="Ver">VER</span>
						</a>				
					</td>
				</tr>
				@endForeach
			</tbody>
		</table>
	</div>
</div>
@endSection