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
			function ativarDesc(valor){
				var x = document.getElementById('pesq2'); 
				var y = x.options[x.selectedIndex].text;
				if(y != "Selecione..."){
					document.getElementById('pesq').disabled = false;
				} else {
					document.getElementById('pesq').disabled = true;
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
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
                <fieldset class="show">
                    <div class="form-card">
				    <form action="{{\Request::route('deleteVaga')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						@foreach($vagas as $vaga)
						<center>
						<table class="table table-bordered" cellspacing="0"> 
							<tr>
							<td colspan="2"><center><strong><h3><br>Solicitação de Vagas</h3></strong></center></td>
							<td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
							<td hidden><input hidden class="form-control" type="text" id="vaga_id" name="vaga_id" value="" readonly="true" /></td>
							</tr>
							<tr>
							<td width="400px">Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
							<td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
							<td>Local de Trabalho:
								<input class="form-control" readonly="true" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome ?>" />
							</td>
							<td>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo $vaga->solicitante; ?>" /></td>
							</tr>
							<tr>
							<td> Nome da Vaga: <input class="form-control" readonly="true" type="text" id="vaga" name="vaga" value="<?php echo $vaga->vaga; ?>" /> </td>
							<td colspan="1">Departamento: <input class="form-control" readonly="true" type="text" id="departamento" name="departamento" value="<?php echo $vaga->area; ?>" required /></td>
							<td>Gestor Imediato: 
								<input type="text" class="form-control" readonly="true" id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->gestor_imediato; ?>" />
							</tr>
							<tr>
							<td colspan="1">Cargo: <input readonly="true" class="form-control" type="text" id="nome" name="nome" required="true" value="<?php echo $vaga->cargo; ?>" /></td>
							<td> Edital Disponível: <input class="form-control" readonly="true" type="text" id="matricula" name="matricula" value="<?php echo $vaga->edital_disponivel; ?>" /> </td>
							<td>Data de Emissão: <input class="form-control" type="text" id="data_emissao" name="data_emissao" value="<?php echo date('d-m-Y', strtotime($vaga->data_emissao)); ?>" readonly="true" /></td>
							</tr>
						</table>
						</center>
						
						<br>	 
						<center>
							<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
							<tr>
							<td width="800px;" colspan="2"><center><strong><h4>Tipos de Movimentação</h4></strong></center></td>
							<td >Data Prevista: <input class="form-control" readonly="true" type="text" id="data_prevista" name="data_prevista" required value="<?php echo date('d-m-Y', strtotime($vaga->data_prevista)); ?>" /></td>
							</tr>	
							</table>
						</center>
						@endforeach
					<table hidden>
						<tr>
							<td> <input hidden type="text" id="acao" name="acao" value="excluir_vaga" class="form-control" /> </td>
							<td> <input hidden type="text" id="user_id" name="user_id" value="<?php echo Auth::user()->id; ?>" class="form-control" /> </td>
						</tr>
					</table>
					<br>	 
					<center> <br><br>
					<table class="table table-sm" style="height: 10px" cellspacing="0">
					  <tr>
						<td>
					 	  <a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						</td> 
						<td align='center'><b> Deseja Realmente Excluir esta Vaga, todas as Validações serão excluídas! </b></td>
						<td align="right"> 
					  	  <input type="submit" class="btn btn-danger btn-sm" style="margin-top: 10px;" value="Excluir" id="Salvar" name="Salvar" /> 
						</td>
					  </tr>
					</table>
					</center>
					</form>
                    </div>
                </fieldset> 
             </div>
        </div>
    </div>
</div>
</body>
</HTML>