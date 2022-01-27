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
	<script type="text/javascript">
		function selects() {
			var ele = document.getElementsByClassName('unidade');
			for (var i = 0; i < ele.length; i++) {
				if (ele[i].type == 'checkbox')
					ele[i].checked = true;
			}
		}

		function deSelect() {
			var ele = document.getElementsByClassName('unidade');
			for (var i = 0; i < ele.length; i++) {
				if (ele[i].type == 'checkbox')
					ele[i].checked = false;

			}
		}

		function selects_und_cad() {
			var ele = document.getElementsByClassName('unidade_cad');
			for (var i = 0; i < ele.length; i++) {
				if (ele[i].type == 'checkbox')
					ele[i].checked = true;
			}
		}

		function deSelect_und_cad() {
			var ele = document.getElementsByClassName('unidade_cad');
			for (var i = 0; i < ele.length; i++) {
				if (ele[i].type == 'checkbox')
					ele[i].checked = false;

			}
		}
	</script>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-5 rounded fixed-top">
		<img src="{{asset('img/Imagem1.png')}}" height="50" class="d-inline-block align-top" alt="">
		<span class="navbar-brand mb-0 h1" style="margin-left:10px;margin-top:5px ;color: rgb(103, 101, 103) !important">
			<h4 class="d-none d-sm-block">Movimentação de Pessoal - RH</h4>
		</span>
	</nav>
	<div class="container-fluid">
		<div class="row" style="margin-bottom: 0px; margin-top: 0px;">
			<div class="col-md-12 text-center">
				<h5 style="font-size: 18px;">CADASTRO USUÁRIO:</h5>
			</div>
		</div>
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<center>
					<li>{{ $error }}</li>
				</center>
				@endforeach
			</ul>
		</div>
		@endif
		<div class="row" style="margin-top: 10px;">
			<div class="col-md-8">
				<form action="{{\Request::route('store')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table class="table table-sm" style="margin-left: 200px;">
						<tr>
							<td>Nome:</td>
							<td> <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" /> </td>
						</tr>
						<tr>
							<td>E-mail:</td>
							<td> <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" /> </td>
						</tr>
						<tr>
							<td>Função:</td>
							<td>
								<select id="funcao" name="funcao" class="form-control">
									<option id="funcao" name="funcao" value="Gestor">Gestor</option>
									<option id="funcao" name="funcao" value="DP">DP</option>
									<option id="funcao" name="funcao" value="RH">RH</option>
									<option id="funcao" name="funcao" value="Diretoria Técnica">Diretoria Técnica</option>
									<option id="funcao" name="funcao" value="Diretoria">Diretoria</option>
									<option id="funcao" name="funcao" value="Superintendencia">Superintendência</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Senha:</td>
							<td> <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}" /> </td>
						</tr>
						<tr>
							<td>Confirmar Senha:</td>
							<td> <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" value="{{ old('password') }}" /> </td>
						</tr>
						<tr>
							<td>Unidades de Visualização:</td>
							<td>
								<li style="list-style: none;">
									<input style="font-size: 12px;" class="btn btn-primary" type="button" onclick='selects()' value="Marcar todos" />
									<input style="font-size: 12px;" class="btn btn-danger" type="button" onclick='deSelect()' value="Desmarcar todos" />
								</li>
								<li style="list-style: none;">
									@foreach($unidades as $unidade)
									<input type='checkbox' id="unidade[]" class="unidade" name="unidade[]" value="<?php echo $unidade->id; ?>" /> {{$unidade->sigla}} &nbsp;&nbsp;</input>
									@endforeach
								</li>
							</td>
						</tr>
						<tr>
							<td>Unidades de Cadastro:</td>
							<td>
								<li style="list-style: none;">
									<input style="font-size: 12px;" class="btn btn-primary" type="button" onclick='selects_und_cad()' value="Marcar todos" />
									<input style="font-size: 12px;" class="btn btn-danger" type="button" onclick='deSelect_und_cad()' value="Desmarcar todos" />
								</li>
								<li style="list-style: none;">
									@foreach($unidades as $unidade)
									<input type='checkbox' id="unidade_abertura[]" class="unidade_cad" name="unidade_abertura[]" value="<?php echo $unidade->id; ?>" />{{$unidade->sigla}}&nbsp;&nbsp;</input>
									@endforeach
								</li>
							</td>
						</tr>
						<tr>
							<td> <input hidden type="text" id="acao" name="acao" value="cadastrar_novo_usuario" class="form-control" /> </td>
							<td> <input hidden type="text" id="user_id" name="user_id" value="<?php echo Auth::user()->id; ?>" class="form-control" /> </td>
						</tr>
						<tr>
							<td colspan="2"> <br>
								<p align="right"><a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/homeMP') }}"> Voltar <i class="fas fa-undo-alt"></i> </a>
									<input type="submit" class="btn btn-success btn-sm" value="Salvar" id="Salvar" name="Salvar" />
								</p>
							</td>
						</tr>
					</table>
					</center>
				</form>
			</div>
		</div>
	</div>
	</div>
	</div>
</body>