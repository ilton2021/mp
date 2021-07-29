<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Programa Degrau - RH</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	  <br>
	  	  <form action="{{route('storeVincularInscricao', $inscricao[0]->vaga_interna_id)}}" method="post">
		  <input type="hidden" name="_token" value="{{ csrf_token() }}">
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td width="800"><center><strong><br>VINCULAR CANDIDATO / VAGA - PROGRAMA DEGRAU!!! </strong></center></td>
			  <td hidden><input hidden type="text" id="ativo" name="ativo" value="1" class="form-control" /></td>
			</tr>
		   </table>
		  </center>

		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td> Vaga: </td>
			  <td><input readonly="true" type="text" id="vaga_interna" name="vaga_interna" value="<?php echo $inscricao[0]->vaga; ?>" class="form-control" /></td>
			</tr>
			<tr> <td> &nbsp; </td> </tr>
			<tr>
			  <td> Funcionário / Solicitante: </td>
			  <td>
			   <select class="form-control" id="nome_funcionario" name="nome_funcionario">
				@foreach($inscricao as $ins)
					@if($ins->concluida == 1 && $ins->aprovada == 1)
						<option id="nome_funcionario" name="nome_funcionario" value="<?php echo $ins->nome_funcionario; ?>">{{ $ins->nome_funcionario.' / '.$ins->Nome }}</option>
					@endif
				@endforeach
			   </select>
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
			 <input type="submit" class="btn btn-success btn-sm" value="VÍNCULAR" id="Salvar" name="Salvar" />
			</td>
		   </tr>
		  </table>
		  </center>
   </form>
</body>