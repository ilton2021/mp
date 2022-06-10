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
  <link rel="stylesheet" href="{{ asset('css/appCadastros.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-2 mb-5 rounded fixed-top">
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
            <div class="card b-0">
				
                <fieldset class="show">
                    <div class="form-card">
					<form action="{{\Request::route('destroyGestor')}}" method="post">
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table table-bordered">
						 <tr>
							<td colspan="2">
							@if ($errors->any())
							  <div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							  </div>
							@endif
							</td>
						 </tr>
						 <tr>
						    <td colspan="2"><h5 class="sub-heading">Excluir Gestor:</h5></td>
						 </tr>
						 <tr>
							<td> Nome: </td>
							<td>
								<input class="form-control" style="width: 400px" type="text" id="nome" name="nome" readonly="true" value="<?php echo $gestor[0]->nome; ?>" />
							</td>
						 </tr>
						 <tr>
							<td> E-mail: </td>
							<td> 
							  <input class="form-control" style="width: 400px" type="text" id="email" name="email" readonly="true" value="<?php echo $gestor[0]->email; ?>" /> 
							</td>
						 </tr>
						 <tr>
						   <td> CPF: </td>
						   <td>
						     <input class="form-control" style="width: 400px" type="text" id="cpf" name="cpf" readonly value="<?php echo $gestor[0]->cpf; ?>" />
						   </td>
						 </tr>
						 <tr>
						   <td> Cargo: </td>
						   <td>
						     <input class="form-control" style="width: 400px" type="text" id="cargo" name="cargo" readonly value="<?php echo $gestor[0]->cargo; ?>" />
						   </td>
						 </tr>
						 <tr>
						   <td> Função: </td>
						   <td> 
						     <input class="form-control" style="width: 400px" type="text" id="funcao" name="funcao" readonly="true" value="<?php echo $gestor[0]->funcao; ?>" />
						   </td>
						 </tr>
						 <tr>
							<td colspan="3"><br><b><p align="left"> Deseja Realmente Excluir este Gestor?? </p></b></td>
						 </tr>
						 <tr>
						  <td colspan="2" align="right"> <a href="{{ route('cadastroGestor') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
						  	   <input type="submit" class="btn btn-danger btn-sm" style="margin-top: 10px;" value="EXCLUIR" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
						<table>
						<tr>
						  <td> <input hidden type="text" id="acao" name="acao" value="excluir_gestor" class="form-control" /> </td>
						  <td> <input hidden type="text" id="user_id" name="user_id" value="<?php echo Auth::user()->id; ?>" class="form-control" /> </td>
						</tr>
						</table>
					</form>
                    </div>
                </fieldset> 
             </div>
        </div>
    </div>
</div>
</body>
</HTML>