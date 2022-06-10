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
					document.getElementById('pesq').hidden = true;
				} else {
					document.getElementById('linha').hidden		  = true;
					document.getElementById('data_inicio').hidden = true;
					document.getElementById('data_fim').hidden    = true;
					document.getElementById('pesq').hidden = false;
					document.getElementById('pesq').disabled = false;
				}
			}
		</script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-2 mb-2 rounded fixed-top">
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
					<form action="{{ route('pesquisaMPsAp') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table class="table table-sm" style="height: 10px"> 
					<tr>
						<td align="right"> Unidade: </td>
						<td> 
						<select class="form-control form-control-sm" id="unidade_id" name="unidade_id" required>
							<option id="unidade_id" name="unidade_id" value="">Selecione...</option>
							@foreach($unidades as $unidade)
							 <option id="unidade_id" name="unidade_id" value="<?php echo $unidade->id; ?>">{{ $unidade->sigla }}</option>
							@endforeach
						</select>
						</td>
						<td align="right"> 
						<select class="form-control form-control-sm" id="pesq2" name="pesq2" onchange="data('sim')">
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
						<td> <input class="form-control form-control-sm" type="text" id="pesq" name="pesq" disabled> </td>
						<td id="linha"> <input hidden type="date" id="data_inicio" name="data_inicio" class="form-control form-control-sm" /> </td>
						<td id="linha"> <input hidden type="date" id="data_fim" name="data_fim" class="form-control form-control-sm" /> </td>
						<td> <input type="submit" class="btn btn-success btn-sm" value="PESQUISAR" id="Salvar" name="Salvar" /> </td>
					</tr>
					</table>
					</form>
						<table class="table table-sm">
						<tr>
							<thead>
							<tr>
							<td colspan="4"><center><font color="green"><b>MP'S APROVADAS:</b></font><center></td>
							</tr>
							<tr>
							<td><center>NOME DA MP</center></td>
							<td><center>SOLICITANTE</center></td>   
							<td><center>VISUALIZAR</center></td>
							@if(Auth::user()->funcao == "DP" || Auth::user()->funcao == "RH")
							 <td><center>RH3</center></td>
							@endif
							</tr>
							</thead> <?php $b = 0; ?>
							@foreach($mps as $mp)
							<tbody>
							<tr>
								<td><center><font size="3">{{ $mp->numeroMP }}</font></center></td>
								<td><center><font size="3">{{ $mp->solicitante }}</font></center></td>   
								<td><center><a href="{{ route('visualizarMP', $mp->id) }}" class="btn-info btn btn-sm">VISUALIZAR</center></a></td>
								@if(Auth::user()->funcao == "DP" || Auth::user()->funcao == "RH")
								<td> 
									@if($mp->acessorh3 == 0)
									<center><a href="{{ route('acessoRH3', $mp->id) }}" class="btn-dark btn btn-sm" title="Esta MP já foi cadastrada no RH3?">RH3</a></center>
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
						<table  style="margin-top: -10px" border="0">
							<tr>
							 <td style="width: 800px"> {{ $mps->appends(['unidade_id' => isset($unidade_id) ? $unidade_id : '','pesq2' => isset($pesq2) ? $pesq2 : '','pesq' => isset($pesq) ? $pesq : '','data_inicio' => isset($data_inicio) ? $data_inicio : '','data_fim' => isset($data_fim) ? $data_fim : ''])->links() }} </td>
							 <td> <a href="{{url('home/visualizarMPS')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF; margin-top: -10px"> VOLTAR <i class="fas fa-undo-alt"></i> </a> </td>
							</tr> 
						</table>
                    </div>
                </fieldset> 
             </div>
        </div>
    </div>
</div>
</body>
</HTML>