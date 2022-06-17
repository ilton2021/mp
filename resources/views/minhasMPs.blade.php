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
				if(y == "NÚMERO MP") {
					document.getElementById('pesq').disabled = false;
					document.getElementById('pesq').hidden   = false;
					document.getElementById('status').hidden = true;
				} else if(y == "FUNCIONÁRIO"){
					document.getElementById('pesq').disabled = false;
					document.getElementById('pesq').hidden   = false;
					document.getElementById('status').hidden = true;
				} else if(y == "ADMISSÃO"){
					document.getElementById('pesq').disabled = true;
					document.getElementById('pesq').hidden   = true;
					document.getElementById('status').hidden = true;
				} else if(y == "DEMISSÃO"){
					document.getElementById('pesq').disabled = true;
					document.getElementById('pesq').hidden   = true;
					document.getElementById('status').hidden = true;
				} else if(y == "ALTERAÇÃO FUNCIONAL") {
					document.getElementById('pesq').disabled = true;
					document.getElementById('pesq').hidden   = true;
					document.getElementById('status').hidden = true;
				} else if(y == "STATUS"){
					document.getElementById('pesq').disabled = true;
					document.getElementById('pesq').hidden   = true;
					document.getElementById('status').hidden = false;
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
                 <div class="alert alert-danger alert-sm">
                  <ul>
                    @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                 </div>
                @endif
                <fieldset class="show">
                    <div class="form-card">
					<form action="{{ route('pesquisaHistMPs') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table class="table table-sm" style="height: 10px"> 
					<tr>
						<td>Escolha uma Opção:</td>
						<td> 
							<select class="form-control form-control-sm" id="pesq2" name="pesq2" onchange="data('sim')">
							<option id="pesq2" name="pesq2" value="">Selecione...</option>
							<option id="pesq2" name="pesq2" value="numeroMP">NÚMERO MP</option>	 
							<option id="pesq2" name="pesq2" value="nome">FUNCIONÁRIO</option> 
							<option id="pesq2" name="pesq2" value="admissao">ADMISSÃO</option>
							<option id="pesq2" name="pesq2" value="admissaoRPA">ADMISSÃO RPA</option>
							<option id="pesq2" name="pesq2" value="alteracao">ALTERAÇÃO FUNCIONAL</option>
							<option id="pesq2" name="pesq2" value="demissao">DEMISSÃO</option>
							<option id="pesq2" name="pesq2" value="status">STATUS</option>
							</select>	
						</td> 
						<td> <input class="form-control form-control-sm" type="text" id="pesq" name="pesq" disabled required> </td>
						<td id="status" hidden> 
							<select id="status" name="status" class="form-control form-control-sm"> 
								<option id="status" name="status" value="0">{{ 'NO FLUXO' }}</option>
								<option id="status" name="status" value="1">{{ 'APROVADO' }}</option>
								<option id="status" name="status" value="2">{{ 'REPROVADO' }}</option>
							</select>
						</td>
						<td> <input type="submit" class="btn btn-info btn-sm" value="PESQUISAR" id="Salvar" name="Salvar" /> </td>
					</table>
					</form>
					<center>
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table class="table table-sm">
						<tr>
							<thead>
							<tr>
							<td colspan="6"><center><font color="blue" size="2"><b>HISTÓRICO DE MP'S :</b></font><b><font size="3"> (Para visualizar a MP clique no Status da MP)</font></b><center></td>
							</tr>
							<tr>
							<td><center><font size="2"><b>NÚMERO DA MP</b></font></center></td>
							<td><center><font size="2"><b>DATA EMISSÃO</b></font></center></td>
							<td><center><font size="2"><b>DATA PREVISTA</b></font></center></td>
							<td><center><font size="2"><b>TIPO</b></font></center></td>  
							<td><center><font size="2"><b>STATUS</b></font></center></td>
							</tr>
							</thead>
							@if($qtd > 0)
							@foreach($mps as $mp)
							<tbody>
							<tr>  
							<td><center><b><font size="2">{{ $mp->numeroMP }}</font></b></center></td>
							<td><center><b><font size="2">{{ date('d/m/Y', strtotime($mp->data_emissao)) }}</font></b></center></td>
							<td><center><b><font size="2">{{ date('d/m/Y', strtotime($mp->data_prevista)) }}</font></b></center></td>
							@if($qtdAdm > 0)
							 @foreach($admissao as $adm)
							  @if($adm->mp_id == $mp->id)
							  <td><b><center><font size="2">ADMISSÃO</font></center></b></td>  
							  @endif
							 @endforeach
							@endif
							@if($qtdDem > 0)
							 @foreach($demissao as $dem)
							  @if($dem->mp_id == $mp->id)
							  <td><b><center><font size="2">DEMISSÃO</font></center></b></td>  
							  @endif
							 @endforeach
							@endif
							@if($qtdAlt > 0)
							 @foreach($alteracao as $alt)
							  @if($alt->mp_id == $mp->id)
							  <td><b><center><font size="2">ALTERAÇÃO FUNCIONAL</font></center></b></td>  
							  @endif
							 @endforeach
							@endif
							@if($qtdAdmRPA > 0)
							 @foreach($admissaoRPA as $admRPA)
							  @if($admRPA->mp_id == $mp->id)
							  <td><b><center><font size="2">ADMISSÃO RPA</font></center></b></td>  
							  @endif
							 @endforeach
							@endif
							<td><center>
								@if($mp->concluida == 0)
								<a href="{{ route('visualizarMP', $mp->id) }}"><font color="blue" size="2"><b>{{ 'NO FLUXO' }}</b></font></a>
								@elseif($mp->concluida == 1 && $mp->aprovada == 1)
								<a href="{{ route('visualizarMP', $mp->id) }}"><font color="green" size="2"><b>{{ 'APROVADA' }}</b></font></a>
								@elseif($mp->concluida == 1 && $mp->aprovada == 0)
								<a href="{{ route('visualizarMP', $mp->id) }}"><font color="red" size="2"><b>{{ 'REPROVADA' }}</b></font></a>
								@endif
							</center></td>
							<td><center></center></td>
							</tr>
							</tbody>
							@endforeach
							@endif
						</td>
						</tr>
					</table>
					<table  style="margin-top: -10px" border="0">
							<tr>
							 <td style="width: 800px"> {{ $mps->appends(['pesq2' => isset($pesq2) ? $pesq2 : '','pesq' => isset($pesq) ? $pesq : '','status' => isset($status) ? $status : ''])->links() }} </td>
							 <td> <a href="{{url('home/visualizarMPS')}}" id="VOLTAR" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF; margin-top: -10px"> VOLTAR <i class="fas fa-undo-alt"></i> </a> </td>
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