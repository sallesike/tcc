<!DOCTYPE html>
<html lang="pt=Br">
<head>
	<meta charset="utf-8">	
	<link rel="shortcut icon" href="{{ asset('images/livro.png') }}">
	<meta name="viewport" content="width-device-width, initial-scale = 1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{url('assets/site/css/style.css')}}">
	<link rel="stylesheet" href="{{ asset('css/dataTables.min.css')}}">
	<link rel="stylesheet" href="{{ asset('css/system.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.toast.css')}}">
	<script src="https://kit.fontawesome.com/9182a657d0.js" crossorigin="anonymous"></script>
	
	<title>Sistema de Gestão de Eventos</title>
</head>
<body>
	<div class="container-fluid">		
		<div class="row mt-2 background-primary bg-primary border border-info rounded shadow">			
			<div class="col-4 col-md-3 col-sm-4 col-xl-3 mt-xl-2 mt-sm-4">
				<img src="{{url('assets/site/img/logo.png')}}" class="img-fluid">
			</div>
			<div class="col-5 col-sm-8 mt-sm-5 d-block d-lg-none text-center text-light">
				<h3>Gestão de Certificados</h3>
				<i class="fa fa-book-open"></i>
			</div>
			<div class="col-sm-7 col-md-6 mt-md mt-lg-3 d-none d-lg-block text-center text-light">
				<p class="display-4">Gestão de Certificados</p>
			</div>
			<div class="row col-12">
				<nav class="navbar navbar-expand-lg navbar-dark bg-primary mx-auto">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarColor01">
						<ul class="navbar-nav mr-auto">
							@if(!auth()->user())
							<li class="nav-item">
								<a class="nav-link" href="{{route('certificate.screen_find_certicate')}}">Certificado</a>
							</li>
							@endIf
							@if(auth()->user())
							<li class="nav-item">
								<a class="nav-link" href="{{route('user.perfil')}}">Perfil</a>
							</li>
							@endIf
							@if(auth()->user())
							<li class="nav-item">
								<a class="nav-link" href="{{route('certificate.myCertificate', auth()->user()->id)}}">Meus Certificados</a>
							</li>
							@endIf
						</li>
						@can('eAdmin')
						<div class="dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Cadastros
							</a>

							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="{{route('event.create')}}">Eventos</a>
								<a class="dropdown-item" href="{{route('school.create')}}">Escolas</a>
								<a class="dropdown-item" href="{{route('instructor.create')}}">Instrutor</a>
							</div>
						</div>
						<div class="dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Visualizar
							</a>

							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="{{route('event.index')}}">Eventos</a>
								<a class="dropdown-item" href="{{route('event.finish')}}">Certificados emitidos</a>							
								<a class="dropdown-item" href="{{route('school.index')}}">Escolas</a>
								<a class="dropdown-item" href="{{route('instructor.index')}}">Instrutor</a>
								<a class="dropdown-item" href="{{route('subscription.index')}}">Inscrições</a>
								<a class="dropdown-item" href="{{route('user.index')}}">Usuarios</a>
							</div>
						</div>
						@endcan
						@can('eUser')
						<li class="nav-item">
							<a class="nav-link" href="{{route('event.select')}}">Eventos</a>
						</li>
						@endcan
						@guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
						@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">Registrar-se</a>
						</li>
						@endif
						@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>
					@endguest
				</ul>
			</div>
		</nav>
	</div>
</div>		
<div class="row bg1 border-info rounded shadow"></div>	
<section class="container mb-5">
	@yield('content')
</section>		
</div>
<footer class="sticky-footer bg-white mt-5 mb-4">

</footer>

<script src="{{ asset('js/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/validationJquery.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/validation.js') }}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery.mask.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/sistema.js') }}"></script>
<script src="{{ asset('js/dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.toast.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
</body>
</html>