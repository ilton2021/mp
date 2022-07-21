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
		function selects_und() {
			var ele = document.getElementsByClassName('unidade');
			for (var i = 0; i < ele.length; i++) {
				if (ele[i].type == 'checkbox')
					ele[i].checked = true;
			}
		}

		function deSelect_und() {
			var ele = document.getElementsByClassName('unidade');
			for (var i = 0; i < ele.length; i++) {
				if (ele[i].type == 'checkbox')
					ele[i].checked = false;
			}
		}
  </script>
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
					<form action="{{\Request::route('storeRPACargo')}}" method="post">
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table class="table table-bordered">
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
						    <td colspan="2" height="20px"><h5 class="sub-heading">NOVO CARGO RPA:</h5></td>
						 </tr>
						 <tr>
							<td> NOME: </td>
							<td>
							 <input class="form-control" style="width: 400px" type="text" id="cargo" name="cargo" required value="{{ old('cargo') }}" />
							</td>
						 </tr>
						 <tr>
							<td>TIPO:</td>
							<td>
							  <select id="tipo" name="tipo" class="form-control" style="width: 400px">
							    <option id="tipo" name="tipo" value="">Selecione...</option>
								<option id="tipo" name="tipo" value="D">DIA</option>
								<option id="tipo" name="tipo" value="N">NOITE</option>
								<option id="tipo" name="tipo" value="FDS - D">FIM DE SEMANA - DIA</option>
								<option id="tipo" name="tipo" value="FDS - N">FIM DE SEMANA - NOITE</option>
							  </select>
							</td>
						 </tr>
						 <tr>
                            <td> HMR (VALOR): </td>
                            <td>
                             <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" style="width: 400px" type="number" id="HMR" name="HMR" required value="{{ old('HMR') }}" />
                            </td>
                         </tr>
                         <tr>
                            <td> BELO JARDIM (VALOR): </td>
                            <td>
                             <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" style="width: 400px" type="number" id="BeloJardim" name="BeloJardim" required value="{{ old('BeloJardim') }}" />
                            </td>
                         </tr>
                         <tr>
                            <td> ARCOVERDE (VALOR): </td>
                            <td>
                             <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" style="width: 400px" type="number" id="Arcoverde" name="Arcoverde" required value="{{ old('Arcoverde') }}" />
                            </td>
                         </tr>
                         <tr>
                            <td> ARRUDA (VALOR): </td>
                            <td>
                             <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" style="width: 400px" type="number" id="Arruda" name="Arruda" required value="{{ old('Arruda') }}" />
                            </td>
                         </tr>
                         <tr>
                            <td> CARUARU (VALOR): </td>
                            <td>
                             <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" style="width: 400px" type="number" id="Caruaru" name="Caruaru" required value="{{ old('Caruaru') }}" />
                            </td>
                         </tr>
                         <tr>
                            <td> HSS (VALOR): </td>
                            <td>
                             <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" style="width: 400px" type="number" id="HSS" name="HSS" required value="{{ old('HSS') }}" />
                            </td>
                         </tr>
                         <tr>
                            <td> HPR (VALOR): </td>
                            <td>
                             <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" style="width: 400px" type="number" id="HPR" name="HPR" required value="{{ old('HPR') }}" />
                            </td>
                         </tr>
                         <tr>
                            <td> IGARASSU (VALOR): </td>
                            <td>
                             <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" style="width: 400px" type="number" id="Igarassu" name="Igarassu" required value="{{ old('Igarassu') }}'" />
                            </td>
                         </tr>
						 <tr>
							<td colspan="2" align="right"> <a href="{{ route('cadastroRPACargo') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-bottom:30px;margin-top: 5px;color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
							 <input type="submit" class="btn btn-success btn-sm" style="margin-bottom:30px;margin-top: 5px;" value="SALVAR" id="Salvar" name="Salvar" /> 
                            </td>
						 </tr>
						</table>
						<table>
						 <tr>
						    <td> <input hidden type="text" id="acao" name="acao" value="cadastrar_novo_cargo_rpa" class="form-control" /> </td>
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