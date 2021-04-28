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
	
	<p style="margin-left: 1170px"> <a href="{{url('home/visualizarMPS')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a></p>
	<center>
	<form action="{{ route('pesquisaMPsRe') }}" method="POST">
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
			  <option id="pesq2" name="pesq2" value="admissao">ADMISSÃO</option>
			  <option id="pesq2" name="pesq2" value="alteracao">ALTERAÇÃO FUNCIONAL</option>
			  <option id="pesq2" name="pesq2" value="demissao">DEMISSÃO</option>
			  <option id="pesq2" name="pesq2" value="funcionario">FUNCIONÁRIO</option>
			  <option id="pesq2" name="pesq2" value="numero">NÚMERO MP</option>	
			  <option id="pesq2" name="pesq2" value="rpa">RPA</option>
			  <option id="pesq2" name="pesq2" value="solicitante">SOLICITANTE</option>
			</select>	
		</td> 
		<td> <input class="form-control" type="text" id="pesq" name="pesq"> </td>
		<td> <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Pesquisar" id="Salvar" name="Salvar" /> </td>
	 </tr>
	</table>
	</form>
    <table class="table table-bordeared" style="WIDTH: 1000px; border-style:solid; border-color:red;">
		 <tr>
		    <thead>
			  <tr>
			   <td colspan="4"><center><font color="red"><b>MP'S REPROVADAS:</b></font><center></td>
			  </tr>
			  <tr>
			   <td><center>NOME DA MP</center></td>
			   <td><center>SOLICITANTE</center></td>
			   <td><center>MENSAGEM</center></td>
			   <td><center>Visualizar</center></td>
			  </tr>
			 </thead>
			 <?php $b = 0; ?>
			 @foreach($mps as $mp)
			 @if(($mp->solicitante == Auth::user()->name && Auth::user()->funcao != "RH") && ($mp->concluida == 1 && $mp->aprovada == 0))
			 <?php $b = 1; ?>
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
							   @if($mp->aprovada == 1)
								 <p align="justify">{{ 'Situação:' }}<b><font color="blue">{{ ' APROVADO' }}</font></b></a>		
							   @else
								 <p align="justify">{{ 'Situação:' }}<b><font color="red">{{ ' REPROVADO' }}</font></b></a>		 
							   @endif
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
			   <td><center><a href="{{ route('visualizarMP', $mp->id) }}" class="btn-info btn">Visualizar</center></a></td>
			  </tr>
			 </tbody>
			 @elseif((Auth::user()->id == 30 || Auth::user()->id == 72 || Auth::user()->id == 32 || Auth::user()->id == 23 || Auth::user()->id == 74 || Auth::user()->id == 62) && ($mp->concluida == 1 && $mp->aprovada == 0))
			 <?php $b = 1; ?>
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
							   @if($mp->aprovada == 1)
								 <p align="justify">{{ 'Situação:' }}<b><font color="blue">{{ ' APROVADO' }}</font></b></a>		
							   @else
								 <p align="justify">{{ 'Situação:' }}<b><font color="red">{{ ' REPROVADO' }}</font></b></a>		 
							   @endif
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
			   <td><center><a href="{{ route('visualizarMP', $mp->id) }}" class="btn-info btn">Visualizar</center></a></td>
			  </tr>
			 </tbody>
			 @elseif((($mp->unidade_id == 3 && Auth::user()->id == 95) || ($mp->unidade_id == 7 && Auth::user()->id == 40) || 
					($mp->unidade_id == 6 && Auth::user()->id == 87)   || ($mp->unidade_id == 4 && Auth::user()->id == 86) || 
					($mp->unidade_id == 6 && Auth::user()->id == 133)  || ($mp->unidade_id == 3 && Auth::user()->id == 5)  ||
					($mp->unidade_id == 4 && Auth::user()->id == 1)    || ($mp->unidade_id == 5 && Auth::user()->id == 34) ||
					($mp->unidade_id == 6 && Auth::user()->id == 48)   || ($mp->unidade_id == 2 && Auth::user()->id == 59) ||
					($mp->unidade_id == 2 && Auth::user()->id == 65)   || ($mp->unidade_id == 7 && Auth::user()->id == 60) ||
					($mp->unidade_id == 8 && Auth::user()->id == 61)   ||
					($mp->unidade_id == 8 && Auth::user()->id == 73)) && ($mp->concluida == 1 && $mp->aprovada == 0))
			 <?php $b = 1; ?>
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
							   @if($mp->aprovada == 1)
								 <p align="justify">{{ 'Situação:' }}<b><font color="blue">{{ ' APROVADO' }}</font></b></a>		
							   @else
								 <p align="justify">{{ 'Situação:' }}<b><font color="red">{{ ' REPROVADO' }}</font></b></a>		 
							   @endif
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
			   <td><center><a href="{{ route('visualizarMP', $mp->id) }}" class="btn-info btn">Visualizar</center></a></td>
			  </tr>
			 </tbody>
			 @endif
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