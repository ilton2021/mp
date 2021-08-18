<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
        <title>MP RH</title>
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
        <style>
		.navbar .dropdown-menu .form-control {
			width: 300px;
		}
        </style>
    </head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-5 rounded fixed-top">
  	    <img src="{{asset('img/Imagem1.png')}}"  height="50" class="d-inline-block align-top" alt="">
			<span class="navbar-brand mb-0 h1" style="margin-left:10px;margin-top:5px ;color: rgb(103, 101, 103) !important">
				<h4 class="d-none d-sm-block">Movimentação de Pessoal - RH</h4>
			</span>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('telaLogin') }}">{{ __('Logar') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('telaRegistro') }}">{{ __('Cadastrar Usuário') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('telaReset') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form1').submit();">
                                        {{ __('Trocar Senha') }}
                                    </a>

                                    <form id="logout-form1" action="{{ route('telaReset') }}" method="GET" style="display: none;">
                                        
                                    </form>
									
									<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form2').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
    </nav>
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;">CADASTRO USUÁRIO:</h5>
		</div>
	</div>	
	@if ($errors->any())
		<div class="alert alert-danger">
		  <ul>
		    @foreach ($errors->all() as $error)
		      <li>{{ $error }}</li>
			@endforeach
		  </ul>
		</div>
	@endif
	<div class="row" style="margin-top: 25px;">
		<div class="col-md-8">
		  <form action="{{\Request::route('store')}}" method="post" >
		  <input type="hidden" name="_token" value="{{ csrf_token() }}">
			<table class="table table-sm" style="margin-left: 200px;"> 
					<tr>
						<td>Nome:</td>
						<td> <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" /> </td>
					</tr>
					<tr>
						<td>E-mail:</td>
						<td> <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" /> </td>
					</tr>
					<tr>
						<td>Função:</td>
						<td> 
						   <select id="funcao" name="funcao" class="form-control"> 
						   	  <option id="funcao" name="funcao" value="Gestor">Gestor</option>
							  <option id="funcao" name="funcao" value="RH">RH</option>
							  <option id="funcao" name="funcao" value="Diretoria Técnica">Diretoria Técnica</option>
							  <option id="funcao" name="funcao" value="Diretoria">Diretoria</option>
							  <option id="funcao" name="funcao" value="Superintendencia">Superintendência</option>
						   </select>
						</td>
					</tr>
					<tr>
					  <td>Senha:</td>
					  <td> <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}" /> </td>
					</tr>
					<tr>
					  <td>Confirmar Senha:</td>
					  <td> <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" value="{{ old('password') }}" /> </td>	
					</tr>
					<tr>
					  <td>Unidades de visualização:</td>
					  <td>  
					   <input type='checkbox' id="unidade_1" name="unidade_1" /> HCPGESTÃO &nbsp;&nbsp;&nbsp;
					   <input type='checkbox' id="unidade_2" name="unidade_2" /> HMR &nbsp;&nbsp;
					   <input type='checkbox' id="unidade_3" name="unidade_3" /> UPAE BELO JARDIM &nbsp;
					   <input type='checkbox' id="unidade_4" name="unidade_4" /> UPAE ARCOVERDE <BR>
					   <input type='checkbox' id="unidade_5" name="unidade_5" /> UPAE ARRUDA &nbsp;&nbsp;
					   <input type='checkbox' id="unidade_6" name="unidade_6" /> UPAE CARUARU &nbsp;&nbsp;&nbsp;
					   <input type='checkbox' id="unidade_7" name="unidade_7" /> HSS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   <input type='checkbox' id="unidade_8" name="unidade_8" /> HCA
					  </td>
					</tr>
					<tr>
                      <td colspan="2"> <br> 
					    <p align="right"><a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/homeMP') }}"> Voltar <i class="fas fa-undo-alt"></i> </a>
						<input type="submit" class="btn btn-success btn-sm" value="Salvar" id="Salvar" name="Salvar" /></p>
					  </td>
					</tr> 
			</table> </center>
		  </form>	
		</div>
	</div> 
</div>
</div>
</div>
</body>