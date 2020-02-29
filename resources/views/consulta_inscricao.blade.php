@extends('template.template')
@section('content')
@if(session('success'))
<div class="alert alert-success mt-2">
	{{ session('success') }}
</div>
@endIf
<div class="card mt-3">
	<div class="card card-header">
		<h4>Lista de Inscrições</h4>
	</div>
	<div class="card card-body">
		<table width="100%" class="table-list table table-striped display responsive nowrap" id="school">	
			<thead>
				<tr>
					<th>Nome</th>
					<th>Curso</th>
				</tr>
			</thead>
			<tbody>
				@foreach($arraySubscription as $subscription)	
				<tr>			
					<td>{{$subscription->user->name}}</td>
					<td>{{$subscription->event->name}}</td>
				</tr>
				@endForeach
			</tbody>
		</table>
	</div>
</div>
@endSection