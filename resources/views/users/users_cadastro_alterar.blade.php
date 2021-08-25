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
			<h5  style="font-size: 18px;">ALTERAR USUÁRIO:</h5>
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
		  <form action="{{\Request::route('alterarUsuario', $users[0]->id)}}" method="post">
		  <input type="hidden" name="_token" value="{{ csrf_token() }}">
			<table class="table table-sm" style="margin-left: 200px;"> 
					<tr>
						<td>Nome:</td>
						<td> <input type="text" id="name" name="name" class="form-control" value="<?php echo $users[0]->name; ?>" /> </td>
					</tr>
					<tr>
						<td>E-mail:</td>
						<td> <input type="text" id="email" name="email" class="form-control" value="<?php echo $users[0]->email ?>" /> </td>
					</tr>
					<tr>
						<td>Função:</td>
						<td> 
						   <select id="funcao" name="funcao" class="form-control"> 
						     @if($users[0]->funcao == "Gestor" || $users[0]->funcao == "Gestor Imediato")
						   	  <option id="funcao" name="funcao" value="Gestor" selected>Gestor</option>
							  <option id="funcao" name="funcao" value="RH">RH</option>
							  <option id="funcao" name="funcao" value="DP">DP</option>
							  <option id="funcao" name="funcao" value="Diretoria Técnica">Diretoria Técnica</option>
							  <option id="funcao" name="funcao" value="Diretoria">Diretoria</option>
							  <option id="funcao" name="funcao" value="Superintendencia">Superintendência</option>
						     @elseif($users[0]->funcao == "RH")
							  <option id="funcao" name="funcao" value="Gestor">Gestor</option>
							  <option id="funcao" name="funcao" value="RH" selected>RH</option>
							  <option id="funcao" name="funcao" value="DP">DP</option>
							  <option id="funcao" name="funcao" value="Diretoria Técnica">Diretoria Técnica</option>
							  <option id="funcao" name="funcao" value="Diretoria">Diretoria</option>
							  <option id="funcao" name="funcao" value="Superintendencia">Superintendência</option>
							  @elseif($users[0]->funcao == "DP")
							  <option id="funcao" name="funcao" value="Gestor">Gestor</option>
							  <option id="funcao" name="funcao" value="RH">RH</option>
							  <option id="funcao" name="funcao" value="DP" selected>DP</option>
							  <option id="funcao" name="funcao" value="Diretoria Técnica">Diretoria Técnica</option>
							  <option id="funcao" name="funcao" value="Diretoria">Diretoria</option>
							  <option id="funcao" name="funcao" value="Superintendencia">Superintendência</option>
							 @elseif($users[0]->funcao == "Diretoria Técnica") 
							  <option id="funcao" name="funcao" value="Gestor">Gestor</option>
							  <option id="funcao" name="funcao" value="RH">RH</option>
							  <option id="funcao" name="funcao" value="DP">DP</option>
							  <option id="funcao" name="funcao" value="Diretoria Técnica" selected>Diretoria Técnica</option>
							  <option id="funcao" name="funcao" value="Diretoria">Diretoria</option>
							  <option id="funcao" name="funcao" value="Superintendencia">Superintendência</option>
							 @elseif($users[0]->funcao == "Diretoria") 
							  <option id="funcao" name="funcao" value="Gestor">Gestor</option>
							  <option id="funcao" name="funcao" value="RH">RH</option>
							  <option id="funcao" name="funcao" value="DP">DP</option>
							  <option id="funcao" name="funcao" value="Diretoria Técnica">Diretoria Técnica</option>
							  <option id="funcao" name="funcao" value="Diretoria" selected>Diretoria</option>
							  <option id="funcao" name="funcao" value="Superintendencia">Superintendência</option>
							 @elseif($users[0]->funcao == "Superintendencia")
							  <option id="funcao" name="funcao" value="Gestor">Gestor</option>
							  <option id="funcao" name="funcao" value="RH">RH</option>
							  <option id="funcao" name="funcao" value="DP">DP</option>
							  <option id="funcao" name="funcao" value="Diretoria Técnica">Diretoria Técnica</option>
							  <option id="funcao" name="funcao" value="Diretoria">Diretoria</option>
							  <option id="funcao" name="funcao" value="Superintendencia" selected>Superintendência</option>
							 @endif 
						   </select>
						</td>
					</tr>
					<tr>
					  <td>Senha:</td>
					  <td> <a class="btn btn-sm btn-info" href="{{ route('alterarSenhaUsuario', $users[0]->id) }}">Alterar Senha</a> </td>
					</tr>
					<tr>
					  <td>Unidades de Visualização:</td>
					  <td>
					   <?php $q1 = $users[0]->unidade; $r1 = "1"; $s1 = str_contains($q1, $r1); ?>
                       <?php $q2 = $users[0]->unidade; $r2 = "2"; $s2 = str_contains($q2, $r2); ?>
                       <?php $q3 = $users[0]->unidade; $r3 = "3"; $s3 = str_contains($q3, $r3); ?>
                       <?php $q4 = $users[0]->unidade; $r4 = "4"; $s4 = str_contains($q4, $r4); ?>
                       <?php $q5 = $users[0]->unidade; $r5 = "5"; $s5 = str_contains($q5, $r5); ?>
                       <?php $q6 = $users[0]->unidade; $r6 = "6"; $s6 = str_contains($q6, $r6); ?>
                       <?php $q7 = $users[0]->unidade; $r7 = "7"; $s7 = str_contains($q7, $r7); ?>
                       <?php $q8 = $users[0]->unidade; $r8 = "8"; $s8 = str_contains($q8, $r8); ?>  
					   @if($s1 == true)
					   <input type='checkbox' id="unidade_1" name="unidade_1" checked /> HCPGESTÃO &nbsp;&nbsp;&nbsp;
					   @else
					   <input type='checkbox' id="unidade_1" name="unidade_1" /> HCPGESTÃO &nbsp;&nbsp;&nbsp;
					   @endif
					   @if($s2 == true)
					   <input type='checkbox' id="unidade_2" name="unidade_2" checked /> HMR &nbsp;&nbsp;
					   @else
					   <input type='checkbox' id="unidade_2" name="unidade_2" /> HMR &nbsp;&nbsp;	
					   @endif
					   @if($s3 == true)
					   <input type='checkbox' id="unidade_3" name="unidade_3" checked /> UPAE BELO JARDIM &nbsp;
					   @else
					   <input type='checkbox' id="unidade_3" name="unidade_3" /> UPAE BELO JARDIM &nbsp;
					   @endif
					   @if($s4 == true)
					   <input type='checkbox' id="unidade_4" name="unidade_4" checked /> UPAE ARCOVERDE <BR>
					   @else
					   <input type='checkbox' id="unidade_4" name="unidade_4" /> UPAE ARCOVERDE <BR>
					   @endif
					   @if($s5 == true)
					   <input type='checkbox' id="unidade_5" name="unidade_5" checked /> UPAE ARRUDA &nbsp;&nbsp;
					   @else
					   <input type='checkbox' id="unidade_5" name="unidade_5" /> UPAE ARRUDA &nbsp;&nbsp;
					   @endif
					   @if($s6 == true)
					   <input type='checkbox' id="unidade_6" name="unidade_6" checked /> UPAE CARUARU &nbsp;&nbsp;&nbsp;
					   @else
					   <input type='checkbox' id="unidade_6" name="unidade_6" /> UPAE CARUARU &nbsp;&nbsp;&nbsp;
					   @endif
					   @if($s7 == true)
					   <input type='checkbox' id="unidade_7" name="unidade_7" checked /> HSS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   @else
					   <input type='checkbox' id="unidade_7" name="unidade_7" /> HSS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   @endif
					   @if($s8 == true)
					   <input type='checkbox' id="unidade_8" name="unidade_8" checked /> HCA
					   @else
					   <input type='checkbox' id="unidade_8" name="unidade_8" /> HCA
					   @endif
					  </td>
					</tr>
					<tr>
					  <td>Unidades de Cadastro:</td>
					  <td>
					   <?php $q1 = $users[0]->unidade_abertura; $r1 = "1"; $s1 = str_contains($q1, $r1); ?>
                       <?php $q2 = $users[0]->unidade_abertura; $r2 = "2"; $s2 = str_contains($q2, $r2); ?>
                       <?php $q3 = $users[0]->unidade_abertura; $r3 = "3"; $s3 = str_contains($q3, $r3); ?>
                       <?php $q4 = $users[0]->unidade_abertura; $r4 = "4"; $s4 = str_contains($q4, $r4); ?>
                       <?php $q5 = $users[0]->unidade_abertura; $r5 = "5"; $s5 = str_contains($q5, $r5); ?>
                       <?php $q6 = $users[0]->unidade_abertura; $r6 = "6"; $s6 = str_contains($q6, $r6); ?>
                       <?php $q7 = $users[0]->unidade_abertura; $r7 = "7"; $s7 = str_contains($q7, $r7); ?>
                       <?php $q8 = $users[0]->unidade_abertura; $r8 = "8"; $s8 = str_contains($q8, $r8); ?>  
					   @if($s1 == true)
					   <input type='checkbox' id="unidade_abertura_1" name="unidade_abertura_1" checked /> HCPGESTÃO &nbsp;&nbsp;&nbsp;
					   @else
					   <input type='checkbox' id="unidade_abertura_1" name="unidade_abertura_1" /> HCPGESTÃO &nbsp;&nbsp;&nbsp;
					   @endif
					   @if($s2 == true)
					   <input type='checkbox' id="unidade_abertura_2" name="unidade_abertura_2" checked /> HMR &nbsp;&nbsp;
					   @else
					   <input type='checkbox' id="unidade_abertura_2" name="unidade_abertura_2" /> HMR &nbsp;&nbsp;	
					   @endif
					   @if($s3 == true)
					   <input type='checkbox' id="unidade_abertura_3" name="unidade_abertura_3" checked /> UPAE BELO JARDIM &nbsp;
					   @else
					   <input type='checkbox' id="unidade_abertura_3" name="unidade_abertura_3" /> UPAE BELO JARDIM &nbsp;
					   @endif
					   @if($s4 == true)
					   <input type='checkbox' id="unidade_abertura_4" name="unidade_abertura_4" checked /> UPAE ARCOVERDE <BR>
					   @else
					   <input type='checkbox' id="unidade_abertura_4" name="unidade_abertura_4" /> UPAE ARCOVERDE <BR>
					   @endif
					   @if($s5 == true)
					   <input type='checkbox' id="unidade_abertura_5" name="unidade_abertura_5" checked /> UPAE ARRUDA &nbsp;&nbsp;
					   @else
					   <input type='checkbox' id="unidade_abertura_5" name="unidade_abertura_5" /> UPAE ARRUDA &nbsp;&nbsp;
					   @endif
					   @if($s6 == true)
					   <input type='checkbox' id="unidade_abertura_6" name="unidade_abertura_6" checked /> UPAE CARUARU &nbsp;&nbsp;&nbsp;
					   @else
					   <input type='checkbox' id="unidade_abertura_6" name="unidade_abertura_6" /> UPAE CARUARU &nbsp;&nbsp;&nbsp;
					   @endif
					   @if($s7 == true)
					   <input type='checkbox' id="unidade_abertura_7" name="unidade_abertura_7" checked /> HSS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   @else
					   <input type='checkbox' id="unidade_abertura_7" name="unidade_abertura_7" /> HSS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   @endif
					   @if($s8 == true)
					   <input type='checkbox' id="unidade_abertura_8" name="unidade_abertura_8" checked /> HCA
					   @else
					   <input type='checkbox' id="unidade_abertura_8" name="unidade_abertura_8" /> HCA
					   @endif
					  </td>
					</tr>
					<tr>
                      <td colspan="2"> <br> 
					    <p align="right"><a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/homeMP/cadastro_usuario') }}"> Voltar <i class="fas fa-undo-alt"></i> </a>
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