@extends('template.template')

@section('content')
	<div class="p-3 mt-3 ">
		<h1>Consulta de certificados.</h1>
		<div class="col-12 mt-5">Você poderá buscar seus certificados através do CPF, basta digitar o número.</div>
		<div class="col-12">
			<hr>
			<span>CPF:</span>
			<input type="text" name="cpf" id="cpf">
			<button class="btn btn-primary">Buscar</button>
			<hr>
		</div>
	</div>
@endsection