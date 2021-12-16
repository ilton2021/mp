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
	<div class="row" style="margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">CADASTRAR GESTOR:</h3>
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
		<div class="col-md-2 col-sm-0"></div>
		<div class="col-md-8 col-sm-12 text-center">
		 <div class="accordion" id="accordionExample">
                <div class="card">
                    <a class="card-header bg-success text-decoration-none text-white bg-success" type="button" data-toggle="collapse" data-target="#PESSOAL" aria-expanded="true" aria-controls="PESSOAL">
                        Gestor: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					 <form action="{{\Request::route('storeGestor')}}" method="post">
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table-sm" style="line-height: 1.5;" >
						 <tr>
							<td> Nome: </td>
							<td>
								<input class="form-control" type="text" id="nome" name="nome" required value="" />
							</td>
						 </tr>
						 <tr>
							<td> E-mail: </td>
							<td> 
							  <input class="form-control" style="width: 400px" type="text" id="email" name="email" required value="" /> 
							</td>
						 </tr>
						 <tr>
						   <td> CPF: </td>
						   <td>
						     <input class="form-control" style="width: 400px" type="text" id="cpf" name="cpf" required value="" />
						   </td>
						 </tr>
						 <tr>
						   <td> Cargo: </td>
						   <td>
						     <input class="form-control" style="width: 400px" type="text" id="cargo" name="cargo" required value="" />
						   </td>
						 </tr>
						 <tr>
						   <td> Gestor Imediato: </td>
						   <td>
						     <input class="form-control" style="width: 400px" type="text" id="gestor_imediato" name="gestor_imediato" required value="" />
						   </td>
						 </tr>
						 <tr>
						  <td> Gestor: </td>
						  <td>
						    <select class="form-control" id="gestor_sim" name="gestor_sim">
							  <option id="gestor_sim" name="gestor_sim" value="0">Gestor</option>
							  <option id="gestor_sim" name="gestor_sim" value="1">Gestor Imediato</option>
							</select>
 						  </td>
						 </tr>
						 <tr>
						   <td> Função: </td>
						   <td> 
						     <select class="form-control" id="funcao" name="funcao">
							  <option id="funcao" name="funcao" value="Gestor">Gestor</option>
							  <option id="funcao" name="funcao" value="RH">RH</option>
							  <option id="funcao" name="funcao" value="Diretoria Tecnica">Diretoria Técnica</option>
							  <option id="funcao" name="funcao" value="Diretoria">Diretoria</option>
							  <option id="funcao" name="funcao" value="Superintendencia">Superintendência</option>
							 </select>
						   </td>
						 </tr>
						 <tr>
						  <td> Unidade: </td>
						  <td>
						  <select class="form-control" id="unidade_id" name="unidade_id">
							@foreach($unidades as $unidade)
							 <option id="unidade_id" name="unidade_id" value="<?php echo $unidade->id; ?>">{{ $unidade->nome }}</option>
							@endforeach
						  </select>
						  </td>
						 </tr>
						</table>
						<table>
						<tr>
						  <td> <input hidden type="text" id="acao" name="acao" value="cadastrar_novo_gestor" class="form-control" /> </td>
						  <td> <input hidden type="text" id="user_id" name="user_id" value="<?php echo Auth::user()->id; ?>" class="form-control" /> </td>
						</tr>
						</table>
						<table>
						 <tr>
						  <td> <br /> <a href="{{ route('cadastroGestor') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a> </td>
						  <td> <br /> <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
						</form>
		</div>
    </div>
</div>
</body>