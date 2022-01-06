<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
        <title>Solicitação de Vagas - RH</title>
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
				<h4 class="d-none d-sm-block">Solicitação de Vagas - RH</h4>
			</span>
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
	<form action="{{\Request::route('inativandoVagas')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		 @foreach($vagas as $vaga)
		  <center>
		   <table class="table table-bordered" style="width: 1200px;" cellspacing="0"> 
			<tr>
			  <td colspan="3"><center><strong><h5><br>Solicitação de Vaga</h5></strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			  <td hidden><input hidden class="form-control" type="text" id="vaga_id" name="vaga_id" value="" readonly="true" /></td>
			</tr>
			<tr>
			  <td width="400px">Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" title="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
			  <td width="400px">Local de Trabalho:
			    <input class="form-control" readonly="true" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome ?>" title="<?php echo $unidade[0]->nome ?>" />
			  </td>
			  <td colspan="2">Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo $vaga->solicitante; ?>" title="<?php echo $vaga->solicitante; ?>" /></td>
			</tr>
			<tr>
			  <td> Número da Vaga: <input class="form-control" readonly="true" type="text" id="numeroVaga" name="numeroVaga" value="<?php echo $vaga->numeroVaga; ?>" title="<?php echo $vaga->numeroVaga; ?>" /> </td>
			  <td colspan="1">Departamento: <input class="form-control" readonly="true" type="text" id="departamento" name="departamento" value="<?php echo $vaga->departamento; ?>" title="<?php echo $vaga->departamento; ?>" required /></td>
			  <td colspan="2">Gestor Imediato: 
			    <input type="text" class="form-control" readonly="true" id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->gestor_imediato; ?>" title="<?php echo $gestor[0]->gestor_imediato; ?>" />
			</tr>
			<tr>
			  <td colspan="1">Nome: <input readonly="true" class="form-control" type="text" id="nome" name="nome" required="true" value="<?php echo $vaga->vaga; ?>" title="<?php echo $vaga->vaga; ?>" /></td>
			  <td> Matrícula: <input class="form-control" readonly="true" type="text" id="matricula" name="matricula" value="<?php echo $vaga->matricula; ?>" title="<?php echo $vaga->matricula; ?>" /> </td>
			  <td width="200px">Data de Emissão: <input class="form-control" type="text" id="data_emissao" name="data_emissao" value="<?php echo date('d-m-Y', strtotime($vaga->data_emissao)); ?>" title="<?php echo date('d-m-Y', strtotime($vaga->data_emissao)); ?>" readonly="true" /></td>
			  <td width="200px">Data Prevista: <input class="form-control" readonly="true" type="text" id="data_prevista" name="data_prevista" required value="<?php echo date('d-m-Y', strtotime($vaga->data_prevista)); ?>" title="<?php echo date('d-m-Y', strtotime($vaga->data_prevista)); ?>" /></td>
			</tr>
		   </table>
		  </center>
		  @endforeach

		  <table hidden>
			  <tr>
				<td> <input hidden type="text" id="acao" name="acao" value="inativar_vaga" class="form-control" /> </td>
				<td> <input hidden type="text" id="user_id" name="user_id" value="<?php echo Auth::user()->id; ?>" class="form-control" /> </td>
			  </tr>
		  </table>

		  <center> <br><br>
		  <table class="table" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td>
			  <a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
			</td> 
			<td align='center'><b> Deseja Realmente Inativar esta Vaga?! </b></td>
			<td align="right"> 
			 <input type="submit" class="btn btn-info btn-sm" style="margin-top: 10px;" value="Inativar" id="Salvar" name="Salvar" /> 
			</td>
		   </tr>
		  </table>
		  </center>
		</form>
		</div>
    </div>
</div>
</body>