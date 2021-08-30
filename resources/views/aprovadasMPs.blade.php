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
		<script type="text/javascript">
			function data(valor) {
				var x = document.getElementById('pesq2'); 
				var y = x.options[x.selectedIndex].text; 
				if(y == "Selecione...") {
					document.getElementById('pesq').disabled = true;
				} else if(y == "DATA") {
					document.getElementById('linha').hidden       = false;
					document.getElementById('data_inicio').hidden = false;
					document.getElementById('data_fim').hidden    = false;
					document.getElementById('txtInicio').hidden   = false;
					document.getElementById('txtFim').hidden 	  = false;
					document.getElementById('pesq').disabled = true;
				} else {
					document.getElementById('linha').hidden		  = true;
					document.getElementById('data_inicio').hidden = true;
					document.getElementById('data_fim').hidden    = true;
					document.getElementById('txtInicio').hidden   = true;
					document.getElementById('txtFim').hidden      = true;
					document.getElementById('pesq').disabled = false;
				}
			}
		</script>
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
	@if ($errors->any())
		<div class="alert alert-danger">
		  <ul>
		    @foreach ($errors->all() as $error)
		      <li>{{ $error }}</li>
			@endforeach
		  </ul>
		</div>
	@endif
	<p style="margin-left: 1170px"> <a href="{{url('home/visualizarMPS')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a></p>
	<center>
	<form action="{{ route('pesquisaMPsAp') }}" method="POST">
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
			<select class="form-control" id="pesq2" name="pesq2" onchange="data('sim')">
			  <option id="pesq2" name="pesq2" value="">Selecione...</option>
			  <option id="pesq2" name="pesq2" value="admissao">ADMISSÃO</option>
			  <option id="pesq2" name="pesq2" value="alteracao">ALTERAÇÃO FUNCIONAL</option>
			  <option id="pesq2" name="pesq2" value="demissao">DEMISSÃO</option>
			  <option id="pesq2" name="pesq2" value="nome">FUNCIONÁRIO</option>
			  <option id="pesq2" name="pesq2" value="numeroMP">NÚMERO MP</option>	
			  <option id="pesq2" name="pesq2" value="rpa">RPA</option>
			  <option id="pesq2" name="pesq2" value="solicitante">SOLICITANTE</option>
			  <option id="pesq2" name="pesq2" value="data">DATA</option>
			</select>	
		</td> 
		<td> <input class="form-control" type="text" id="pesq" name="pesq" disabled="true" > </td>
		<td> <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Pesquisar" id="Salvar" name="Salvar" /> </td>
	 </tr>
	 <tr hidden id="linha">
	 <td id="txtInicio" hidden><p align="center"> Data Início: </p></td>
	 <td> <input hidden type="date" id="data_inicio" name="data_inicio" class="form-control" /> </td>
	 <td id="txtFim" hidden><p align="center"> Data Fim: </p></td>
	 <td> <input hidden type="date" id="data_fim" name="data_fim" class="form-control" /> </td>
	 </tr>
	</table>
	</form>
    <table class="table table-bordeared" style="WIDTH: 1000px; border-style:solid; border-color:green;">
		 <tr>
		    <thead>
			  <tr>
			   <td colspan="4"><center><font color="green"><b>MP'S APROVADAS:</b></font><center></td>
			  </tr>
			  <tr>
			   <td><center>NOME DA MP</center></td>
			   <td><center>SOLICITANTE</center></td>
			   <td><center>MENSAGEM</center></td>
			   <td><center>Visualizar</center></td>
			   @if(Auth::user()->funcao == "DP" || Auth::user()->funcao == "RH")
			   <td><center>RH3</center></td>
			   @endif
			  </tr>
			 </thead>
			 <?php $b = 0; ?>
			 @foreach($mps as $mp)
			 <tbody>
			  <tr>  
			   <td><center>{{ $mp->numeroMP }}</center></td>
			   <td><center>{{ $mp->solicitante }}</center></td>   
			   <td>
			   <?php $qtd = sizeof($aprovacao); ?>
			   <?php for($i = 0; $i < $qtd; $i++) { ?>
			   <?php  if($aprovacao[$i]->mp_id == $mp->id && $aprovacao[$i]->ativo == 1) { ?>
			     <center><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal<?php echo $aprovacao[$i]->id; ?>" > 
			     Status
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $aprovacao[$i]->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"><b><center>Status:</center></b></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'> </div>
							 <div class='panel-body'>
							   @foreach($gestores as $g)
							    @if($g->id == $aprovacao[$i]->gestor_anterior)
							      <p align="justify">{{ 'Validação Final: ' }}<b>{{ $g->nome }}</b></a>
							    @endif
							   @endforeach	
							 	 <p align="justify">{{ 'Situação:' }}<b><font color="blue">{{ ' APROVADO' }}</font></b></a>		
							  	 <p align="justify">{{ 'Mensagem: ' }} <b> {{ $aprovacao[$i]->motivo }}</b></a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			   <?php  } ?>
			   <?php } ?>
			   </td>
			   <td><center><a href="{{ route('visualizarMP', $mp->id) }}" class="btn-info btn">Visualizar</a></center></td>
			   @if(Auth::user()->funcao == "DP" || Auth::user()->funcao == "RH")
			   <td> 
			    @if($mp->acessorh3 == 0)
				  <center><a href="{{ route('acessoRH3', $mp->id) }}" class="btn-dark btn" title="Esta MP já foi cadastrada no RH3?">RH3</a></center>
				@else
				  <center><a href="{{ route('acessoRH3Desabilita', $mp->id) }}" title="<?php echo $mp->usuario_acessorh3; ?> Já cadastrou esta MP no RH3!" class="btn-warning btn">{{ $mp->usuario_acessorh3 }}</a></center>
				@endif
			   </td>
			   @endif
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