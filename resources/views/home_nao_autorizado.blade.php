<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Movimentação de Pessoal</title>
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style-dashboard.css')}}">
  <link href="{{ asset('js/utils.js') }}" rel="stylesheet">
  <link href="{{ asset('js/bootstrap.js') }}" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	  <br>
		  <form method="POST" action="{{ route('storeNAutMP', $mp[0]->id) }}">
		  <input type="hidden" name="_token" value="{{ csrf_token() }}">
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td width="800"><center><strong><br>Não Autorizar MP!!! </strong></center></td>
			  <td><center><img width="200" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			  <td hidden><input hidden type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" class="form-control" ></td>
			  <td hidden><input hidden type="text" id="mp_id" name="mp_id" value="<?php echo $mp[0]->id; ?>" class="form-control" /></td>
			  <td hidden><input hidden type="text" id="ativo" name="ativo" value="<?php echo 1; ?>" class="form-control" /></td>
			  <td hidden><input hidden type="text" id="gestor_anterior" name="gestor_anterior" value="<?php echo $gestores[0]->id; ?>" class="form-control" /></td>
			</tr>
			</table>
		  </center>
		  
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td>Solicitante: </td>
			<td hidden> <input hidden type="text" id="gestor_id" name="gestor_id" class="form-control" value="<?php echo $gestores[0]->id; ?>" readonly="true" />  </td>
			<td> <input type="text" id="gestor_id_" name="gestor_id_" class="form-control" value="<?php echo $gestores[0]->nome; ?>" readonly="true" />  </td>
		   </tr>
		   <tr> 
		    <td>Justificativa:</td>
			<td><textarea id="motivo" name="motivo" required class="form-control" rows="6"></textarea></td>
		   </tr>
		   <tr>
		    <td><b>VOLTAR MP PARA O SOLICITANTE:</b></td>
			<td> <input type="checkbox" id="voltarMP" name="voltarMP" /></td>
		   </tr>
		   <tr>
		   <td colspan="2"> Marque o checkbox para voltar esta MP ao Solicitante. <br><br>
		    Para <b>Não Autorizar</b> esta <b>MP</b> <b> não marque o checkbox. </b>
		   </td>
		   </tr>
		  </table>
		  </center>	
		  
		  <center>
		  <table border="0" class="table table" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td>
			<p align="left"> <a href="javascript:history.back();" class="btn btn-warning">Voltar</a>
			</td>
			<td align="right">
			 <input type="submit" class="btn btn-danger btn-sm" value="NÃO AUTORIZAR" id="Salvar" name="Salvar" />
			</td>
		   </tr>
		  </table>
		  </center>
   </form>
</body>