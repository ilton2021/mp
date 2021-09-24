<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Abertura de Vaga - RH</title>
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
				<h4 class="d-none d-sm-block">Abertura de Vaga - RH</h4>
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
	
	<p style="margin-left: 1170px"> <a href="{{url('homeVaga/visualizarVagas')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a></p>
	<center>
	<form action="{{ route('pesquisaVagas') }}" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<table class="table table-bordeared" style="WIDTH: 1000px; border-style:solid;"> 
	 <tr>
		<td align="right"> <p style="margin-top: 10px;"> Unidade: </p> </td>
		<td> 
		 <select class="form-control" id="unidade_id" name="unidade_id">
		     <option id="unidade_id" name="unidade_id" value="0">Selecione...</option>
			 <option id="unidade_id" name="unidade_id" value="1">HCP GESTÃO</option>
			 <option id="unidade_id" name="unidade_id" value="2">HMR</option>
			 <option id="unidade_id" name="unidade_id" value="3">UPAE BELO JARDIM</option>
			 <option id="unidade_id" name="unidade_id" value="4">UPAE ARCOVERDE</option>
			 <option id="unidade_id" name="unidade_id" value="5">UPAE ARRUDA</option>
			 <option id="unidade_id" name="unidade_id" value="6">UPAE CARUARU</option>
			 <option id="unidade_id" name="unidade_id" value="7">HSS</option>
			 <option id="unidade_id" name="unidade_id" value="8">HPR</option>
		 </select>
		</td>
		<td align="right"> 
			<select class="form-control" id="pesq2" name="pesq2">
			  <option id="pesq2" name="pesq2" value="">Selecione...</option>
			  <option id="pesq2" name="pesq2" value="vaga">NOME DA VAGA</option>
			  <option id="pesq2" name="pesq2" value="numeroVaga">NÚMERO DA VAGA</option>
			  <option id="pesq2" name="pesq2" value="solicitante">SOLICITANTE</option>
			</select>	
		</td> 
		<td> <input class="form-control" type="text" id="pesq" name="pesq"> </td>
		<td> <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Pesquisar" id="Salvar" name="Salvar" /> </td>
	 </tr>
	</table>
	</form>
    <table class="table table-bordeared" style="WIDTH: 1200px; border-style:solid; border-color:#0000ff;">
		 <tr>
		    <thead>
			  <tr>
			   <td colspan="3"><center><font color="blue"><b>VAGAS CRIADAS:</b></font><center></td>
			  </tr>
			  <tr>
			   <td><center>NOME DA VAGA</center></td>
			   <td><center>NÚMERO DA VAGA</center></td>
			   <td><center>SOLICITANTE</center></td>   
		       <td><center>VISUALIZAR</center></td>
			  </tr>
			 </thead>
			 <?php $a = 0; ?>
			 @foreach($vagas as $vaga)
			    <tbody>
			     <tr>
			      <td><center>{{ $vaga->vaga }}</center></td>
				  <td><center>{{ $vaga->numeroVaga }}</center></td>
			      <td><center>{{ $vaga->solicitante }}</center></td>   
			      <td><center><a href="{{ route('visualizarVaga', $vaga->id) }}" class="btn-info btn">Visualizar</center></a></td>
			     </tr>
			    </tbody>
			 @endforeach
		  </td>
		 </tr>
		 </table>
	    </center>
	</footer>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    </body>
</html>