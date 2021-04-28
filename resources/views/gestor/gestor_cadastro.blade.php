<!DOCTYPE html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}">    <head>        <meta charset="utf-8">        <meta name="viewport" content="width=device-width, initial-scale=1">        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">        <title>MP RH</title>		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">        <link rel="stylesheet" href="{{asset('css/style.css')}}">        <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>        <style>		.navbar .dropdown-menu .form-control {			width: 300px;		}        </style>    </head><body><nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-5 rounded fixed-top">  	    <img src="{{asset('img/Imagem1.png')}}"  height="50" class="d-inline-block align-top" alt="">			<span class="navbar-brand mb-0 h1" style="margin-left:10px;margin-top:5px ;color: rgb(103, 101, 103) !important">				<h4 class="d-none d-sm-block">Movimentação de Pessoal - RH</h4>			</span>		<div class="collapse navbar-collapse" id="navbarSupportedContent">                    <ul class="navbar-nav mr-auto">                    </ul>                    <ul class="navbar-nav ml-auto">                        @guest                            <li class="nav-item">                                <a class="nav-link" href="{{ route('telaLogin') }}">{{ __('Logar') }}</a>                            </li>                            @if (Route::has('register'))                                <li class="nav-item">                                    <a class="nav-link" href="{{ route('telaRegistro') }}">{{ __('Cadastrar Usuário') }}</a>                                </li>                            @endif                        @else                            <li class="nav-item dropdown">                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>                                    {{ Auth::user()->name }} <span class="caret"></span>                                </a>                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">                                    <a class="dropdown-item" href="{{ route('telaReset') }}"                                       onclick="event.preventDefault();                                                     document.getElementById('logout-form1').submit();">                                        {{ __('Trocar Senha') }}                                    </a>                                    <form id="logout-form1" action="{{ route('telaReset') }}" method="GET" style="display: none;">                                                                            </form>																		<a class="dropdown-item" href="{{ route('logout') }}"                                       onclick="event.preventDefault();                                                     document.getElementById('logout-form2').submit();">                                        {{ __('Sair') }}                                    </a>                                    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">                                        @csrf                                    </form>                                </div>                            </li>                        @endguest                    </ul>                </div>    </nav><div class="container-fluid">	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">		<div class="col-md-12 text-center">			<h5  style="font-size: 18px;">CADASTRO GESTOR:</h5>		</div>	</div>		@if (Session::has('mensagem'))		@if ($text == true)		<div class="container">	     <div class="alert alert-success {{ Session::get ('mensagem')['class'] }} ">		      {{ Session::get ('mensagem')['msg'] }}		 </div>		</div>		@endif	@endif	<div class="row" style="margin-top: 25px;">		<div class="col-md-12">			<p align="right">			 <a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/home') }}"> Voltar <i class="fas fa-undo-alt"></i> </a> &nbsp;			 <a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{route('gestorNovo')}}"> Novo <i class="fas fa-check"></i> </a>			</p>			<form method="POST" action="{{ route('pesquisarGestor') }}">			<input type="hidden" name="_token" value="{{ csrf_token() }}">			<table align="center">			 <tr>			 <td>				<input type="text" style="width: 500px" id="pesq" name="pesq" class="form-control" value="" />			 </td>			 <td>&nbsp;&nbsp;&nbsp;</td>			 <td>			 <select id="id" name="id" class="form-control">			   <option id="id" name="id" value="1">Nome</option>			   <option id="id" name="id" value="2">E-mail</option>			   <option id="id" name="id" value="3">Função</option>			   <option id="id" name="id" value="4">Unidade</option>			 </select>			 </td>			 <td>&nbsp;&nbsp;&nbsp;</td>			 <td width="100px"> <input type="submit" class="btn btn-info btn-sm" value="Pesquisar" id="Pesquisar" name="Pesquisar" /> </td>			 </tr>			</table>			</form>			<table class="table table-sm " id="my_table">				<thead class="bg-success">					<tr>						<th scope="col" width="500px">Nome</th>						<th scope="col">E-mail</th>						<th scope="col">Função</th>						<th scope="col">Unidade</th>						<th scope="col"><center>Alterar</center></th>						<th scope="col"><center>Excluir</center></th>					</tr>				</thead>				<tbody>					@foreach($gestores as $gestor)					<tr>						<td style="font-size: 15px;">{{$gestor->nome}}</td>						<td style="font-size: 15px;">{{$gestor->email}}</td>						<td style="font-size: 15px;">{{$gestor->funcao}}</td>						@foreach($unidades as $unidade)						 @if($gestor->unidade_id == $unidade->id)						  <td style="font-size: 15px;">{{$unidade->nome}}</th>					     @endif						@endforeach						<td><center><a class="btn btn-info btn-sm" href="{{route('gestorAlterar', $gestor->id)}}" ><i class="fas fa-edit"></i></center></td>						<td><center><a class="btn btn-danger btn-sm" href="{{route('gestorExcluir', $gestor->id)}}" ><i class="fas fa-times-circle"></i></center></td>					</tr>					@endforeach				</tbody>			</table>		</div>	</div> </div></div></div></body>