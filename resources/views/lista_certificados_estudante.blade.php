@extends('template.template')
@section('content')
<div class="row justify-content-center">
	<div class="col-md-12 mt-3 p-3">	
		<div class="card">
			<div class="card card-header">
				<h4>Certificados disponiveis.
					@if($student)
					{{$student->name}}
					@endIf
				</h4>
			</div>
			<div class="card card-body">
				<table width="100%" class="table-list table table-striped display responsive nowrap">
					<thead>
						<tr>
							<th>Evento</th>
							<th>Data</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>
						@foreach($arrayCertificate as $certificate)
						<tr>
							<td>{{$certificate->event->name}}</td>
							<td>{{$certificate->event->date->format('d/m/Y')}}</td>
							<td>
								<a target="_blank" href="{{route('certificate.show', $certificate->id)}}">Imprimir <i class="fa fa-print"></i></a>
							</td>
						</tr>
						@endForeach					
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endSection