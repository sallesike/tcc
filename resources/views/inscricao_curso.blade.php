@extends('template.template')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8 mt-3 p-3">
		<div class="card">
			<div class="card-header">
				Cadastro de Escolas
			</div>
		 	<div class="card-body">
			<form>
			{!! csrf_field() !!}
			<div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Nome Completo:</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="name" id="name">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Cpf:</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="cpf" id="cpf">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Data de Nascimento:</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="birthday" id="birthday">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Cursos abertos:</label>
					<div class="col-md-6">
					<select class="form-control" id="Cursos">
					      	<option>Selecione um curso.</option>
					      	<option>Português</option>
					     	<option>Matematica</option>
					      	<option>História</option>
					      	<option>Geografia</option>
					    </select>
				    </div>
			    </div>
			    <div class="form-group">
			    	<button class="btn btn-primary">Inscrever-se</button>
			    </div>
			</div>
			</form>	
			</div>
		</div>
	</div>
</div>

@endsection