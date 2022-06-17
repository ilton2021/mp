<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Movimentação de Pessoal - Validação</title>
  <link rel="stylesheet" href="{{ asset('css/app2.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
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
  <div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-7">
            <div class="card2 b-0">

                <fieldset class="show">
                    <div class="form-card2">
                        <h5 class="sub-heading"><br><br>Escolha uma opção:</h5>

                        <div class="row px-1 radio2-group">
                            <div class="card2-block radio">
							 <a href="{{ route('index2') }}">
                                <div class="image2-icon">
                                    <img class="icon2 icon1" src="{{asset('img/mp.png')}}">
                                </div>
                                <p class="sub-desc"><center>CADASTRAR NOVA MP</center></p> 
							 </a>
                            </div>
                            
                            <div class="card2-block radio">
							 <a href="{{ route('visualizarMPs') }}">
                                <div class="image2-icon">
                                    <img class="icon2 icon1" src="{{asset('img/mpVisualizar.png')}}">
                                </div>
                                <p class="sub-desc"><center>VISUALIZAR MP'S</center></p>
							 </a>
                            </div>

                            @foreach($mps as $mp)
                             @if($mp->gestor_id == Auth::user()->id && $mp->concluida == 0 || ($mp->gestor_id == 61 && Auth::user()->id == 104) || ($mp->gestor_id == 62 && Auth::user()->id == 61))
                             <div class="card2-block radio">
							  <a href="{{ route('indexValida') }}">
                                <div class="image2-icon">
                                    <img class="icon2 icon1" src="{{asset('img/mpVisualizar.png')}}">
                                </div>
                                <p class="sub-desc"><center>VALIDAR MP</center></p>
                                </a>
                             </div>
                             @break
                             @endif
                            @endforeach
                            
                        </div>
                    </div>
                </fieldset> <br>
                <div class="container">
                 <div class="row">
                  <div class="col align-self-start">
                    @if(Auth::user()->funcao == "Administrador")
                    <button style="color:#FFFFFF; margin-bottom:0px;" class="btn btn-info dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        CADASTRAR
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('cadastroUnidade') }}">Unidade</a>
                        <a class="dropdown-item" href="{{ route('cadastroGestor') }}">Gestor</a>
                        <a class="dropdown-item" href="{{ route('cadastroCargo') }}">Cargo</a>
                        <a class="dropdown-item" href="{{ route('cadastroRPACargo') }}">Cargos RPA</a>
                        <a class="dropdown-item" href="{{ route('cadastroCentrocusto') }}">Centro de Custo</a>
                        <a class="dropdown-item" href="{{ route('cadastroUsuario') }}">Usuário</a>  
                    </div>
                    <a href="{{ route('excluirMPs') }}" class="btn-danger btn btn-sm">EXCLUIR MPS</a>
                    @elseif(Auth::user()->id == 30)
                    <a href="{{ route('cadastroRPACargo') }}" class="btn btn-info btn btn-sm" style="color: #FFFFFF;"> CARGOS RPA </a>
                    <a href="{{ route('excluirMPs') }}" class="btn-danger btn btn-sm">EXCLUIR MPS</a>
                    @elseif(Auth::user()->id == 218)
                    <a href="{{ route('cadastroRPACargo') }}" class="btn btn-info btn btn-sm" style="color: #FFFFFF;"> CARGOS RPA </a>
                    @else
                    <a href="{{ route('excluirMPs') }}" class="btn-danger btn btn-sm">EXCLUIR MPS</a>
                    @endif
                    <a href="{{ url('/duvidas') }}" class="btn btn-success btn btn-sm" style="color: #FFFFFF;"> DÚVIDAS </a>
                    <a href="{{ url('/home') }}" class="btn btn-warning btn btn-sm" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
                  </div>
                 </div>
                </div>
             </div>
        </div>
    </div>
</div>
</body>
</HTML>