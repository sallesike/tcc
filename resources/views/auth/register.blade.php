@extends('template.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">
                    Cadastro
                    <i class="fa fa-id-card"></i>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">CPF</label>
                            <div class="col-md-6">                          
                                <input type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf" id="cpf" value="{{$user->cpf ?? old('cpf')}}">   

                                @error('cpf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror        
                            </div>                       
                        </div>                     
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Data de Nascimento</label>
                            <div class="col-md-6">                          
                                <input type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" id="birthday" value="{{$user->birthday ?? old('birthday')}}">

                                @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>                      
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                        @can('eAdmin')
                        <div class="form-group row">
                          <label class="col-md-4 col-form-label text-md-right">Tipo de Usuario</label>
                          <div class="form-check ml-3 mt-2">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="status" value="Admin" checked="">
                              Administrador
                          </label>
                      </div>
                      <div class="form-check ml-3 mt-2">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="status" value="Comum">
                              Comum
                          </label>
                        </div>
                        @endcan
                        
                  </div>                  
                  <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4 mb-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            Salvar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection
