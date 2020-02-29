<!DOCTYPE html>
<html>
<head>
	<title>Lista Inscritos</title>
	<link rel="shortcut icon" href="{{ asset('/images/livro.png') }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('css/system.css')}}">
</head>
<body>
	<div>
		<div class="row">
			<h2>{{$event->name ." ".Carbon\Carbon::parse($event->date)->format('d-m-Y')}}</h2>
		</div>
		<div class="row">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Nome Participante</th>
						<th>Assinatura</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{$user->user->name}}</td>
						<td></td>
					</tr>
					@endForeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="fundo"></div>


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>