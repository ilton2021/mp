<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>MP RH</title>
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
	    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
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
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">     
            
            </div>
            <div class="col-sm-4">
            </div>
        </div>
    </div>
	
    <div class="container">
     <div class="row">
        <div class="col align-self-start">
          @if(Auth::user()->funcao == "Administrador")
          <button style="color:#FFFFFF; margin-bottom:0px;" class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            CADASTRAR
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('cadastroUnidade') }}">Unidade</a>
            <a class="dropdown-item" href="{{ route('cadastroGestor') }}">Gestor</a>
            <a class="dropdown-item" href="{{ route('cadastroCargo') }}">Cargo</a>
            <a class="dropdown-item" href="{{ route('cadastroCentrocusto') }}">Centro de Custo</a>
            <a class="dropdown-item" href="{{ route('cadastroUsuario') }}">Usuário</a>  
          </div>
          <a href="{{ route('excluirMPs') }}" class="btn-danger btn">EXCLUIR MPS</a>
          @else
          <a href="{{ route('excluirMPs') }}" class="btn-danger btn">EXCLUIR MPS</a>
          @endif
          <a href="{{ url('/duvidas') }}" class="btn btn-success btn" style="color: #FFFFFF;"> DÚVIDAS </a>
          <a href="{{ url('/home') }}" class="btn btn-warning btn" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
         </div>
       </div>
    </div>
    <br><br>
    <div class="container">
    <div class="row justify-content">
      <div class="col-12"> <Center>
        <span><h3 style="color:#65b345; margin-bottom:0px;"><u>Escolha uma opção:</u></h3></span> </Center>
      </div>
    </div> <br><br>
    <div class="row">
        <div class="col align-self-start">
          <img id="img-unity" src="{{asset('img/mp.png')}}" class="rounded-sm" alt="...">
          <a style="margin-left: 50px;" href="{{ route('index2') }}" class="btn btn-outline-success">CADASTRAR NOVA MP</a>
          <span class="font-weight-bold"></span>
        </div>
        <div class="col align-self-end" style="margin-top: 20px;">
         <img id="img-unity" src="{{asset('img/mpVisualizar.png')}}" class="rounded-sm" alt="...">
       	 <a style="margin-left: 70px;" href="{{ route('visualizarMPs') }}" class="btn btn-outline-info">VISUALIZAR MP'S</a>
	   </div>
        <div class="col align-self-center">
          @foreach($mps as $mp)
            @if($mp->gestor_id == Auth::user()->id && $mp->concluida == 0 || ($mp->gestor_id == 61 && Auth::user()->id == 104) || ($mp->gestor_id == 62 && Auth::user()->id == 61))
        	  <img id="img-unity" src="{{asset('img/mpVisualizar.png')}}" class="rounded-sm" alt="...">
			  <a style="margin-left: 80px;" href="{{ route('indexValida') }}" class="btn btn-outline-dark">VALIDAR MP</a>
            @break
            @endif
          @endforeach
       </div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>