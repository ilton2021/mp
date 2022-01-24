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
    </head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-5 rounded fixed-top">
  	    <img src="{{asset('img/Imagem1.png')}}"  height="50" class="d-inline-block align-top" alt="">
			<span class="navbar-brand mb-0 h1" style="margin-left:10px;margin-top:5px ;color: rgb(103, 101, 103) !important">
				<h4 class="d-none d-sm-block">Movimentação de Pessoal - RH</h4>
			</span>		
</nav>
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;">CADASTRO USUÁRIO:</h5>
		</div>
	</div>	
	@if ($errors->any())
		<div class="alert alert-danger">
		  <ul>
		    @foreach ($errors->all() as $error)
		      <li>{{ $error }}</li>
			@endforeach
		  </ul>
		</div>
	@endif
	<div class="row" style="margin-top: 25px;">
		<div class="col-md-8">
		  <form action="{{\Request::route('store')}}" method="post" >
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
					   <input type='checkbox' id="unidade_1" name="unidade_1" /> HCPGESTÃO &nbsp;&nbsp;&nbsp;
					   <input type='checkbox' id="unidade_2" name="unidade_2" /> HMR &nbsp;&nbsp;
					   <input type='checkbox' id="unidade_3" name="unidade_3" /> UPAE BELO JARDIM &nbsp;
					   <input type='checkbox' id="unidade_4" name="unidade_4" /> UPAE ARCOVERDE <BR>
					   <input type='checkbox' id="unidade_5" name="unidade_5" /> UPAE ARRUDA &nbsp;&nbsp;
					   <input type='checkbox' id="unidade_6" name="unidade_6" /> UPAE CARUARU &nbsp;&nbsp;&nbsp;
					   <input type='checkbox' id="unidade_7" name="unidade_7" /> HSS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   <input type='checkbox' id="unidade_8" name="unidade_8" /> HCA &nbsp;&nbsp;&nbsp;
					   <input type='checkbox' id="unidade_9" name="unidade_9" /> UPAE IGARASSU
					  </td>
					</tr>
					<tr>
					  <td>Unidades de Cadastro:</td>
					  <td>  
					   <input type='checkbox' id="unidade_abertura_1" name="unidade_abertura_1" /> HCPGESTÃO &nbsp;&nbsp;&nbsp;
					   <input type='checkbox' id="unidade_abertura_2" name="unidade_abertura_2" /> HMR &nbsp;&nbsp;
					   <input type='checkbox' id="unidade_abertura_3" name="unidade_abertura_3" /> UPAE BELO JARDIM &nbsp;
					   <input type='checkbox' id="unidade_abertura_4" name="unidade_abertura_4" /> UPAE ARCOVERDE <BR>
					   <input type='checkbox' id="unidade_abertura_5" name="unidade_abertura_5" /> UPAE ARRUDA &nbsp;&nbsp;
					   <input type='checkbox' id="unidade_abertura_6" name="unidade_abertura_6" /> UPAE CARUARU &nbsp;&nbsp;&nbsp;
					   <input type='checkbox' id="unidade_abertura_7" name="unidade_abertura_7" /> HSS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   <input type='checkbox' id="unidade_abertura_8" name="unidade_abertura_8" /> HCA &nbsp;&nbsp;&nbsp;
					   <input type='checkbox' id="unidade_abertura_9" name="unidade_abertura_9" /> UPAE IGARASSU
					  </td>
					</tr>
					<tr>
						<td> <input hidden type="text" id="acao" name="acao" value="cadastrar_novo_usuario" class="form-control" /> </td>
						<td> <input hidden type="text" id="user_id" name="user_id" value="<?php echo Auth::user()->id; ?>" class="form-control" /> </td>
					</tr>
					<tr>
                      <td colspan="2"> <br> 
					    <p align="right"><a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/homeMP') }}"> Voltar <i class="fas fa-undo-alt"></i> </a>
						<input type="submit" class="btn btn-success btn-sm" value="Salvar" id="Salvar" name="Salvar" /></p>
					  </td>
					</tr> 
			</table> </center>
		  </form>	
		</div>
	</div> 
</div>
</div>
</div>
</body>