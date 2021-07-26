<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Programa Degrau - RH</title>
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style-dashboard.css')}}">
  <link href="{{ asset('js/utils.js') }}" rel="stylesheet">
  <link href="{{ asset('js/bootstrap.js') }}" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
	  <br>
		  <input type="hidden" name="_token" value="{{ csrf_token() }}">
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td width="800"><center><strong><br>APROVAR INSCRIÇÃO - PROGRAMA DEGRAU!!! </strong></center></td>
			  <td hidden><input hidden type="text" id="mp_id" name="vaga_interna_id" value="<?php echo $pd[0]->id; ?>" class="form-control" /></td>
			  <td hidden><input hidden type="text" id="ativo" name="ativo" value="<?php echo 1; ?>" class="form-control" /></td>
			  <td hidden><input hidden type="text" id="gestor_anterior" name="gestor_anterior" value="<?php echo $gestores[0]->id; ?>" class="form-control" /></td>
			</tr>
			</table>
		  </center>

		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td hidden><input hidden type="text" id="mp_id" name="vaga_interna_id" value="<?php echo $pd[0]->id; ?>" class="form-control" /></td>
			  <td hidden><input hidden type="text" id="ativo" name="ativo" value="<?php echo 1; ?>" class="form-control" /></td>
			  <td hidden><input hidden type="text" id="gestor_anterior" name="gestor_anterior" value="<?php echo $gestores[0]->id; ?>" class="form-control" /></td>
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
			 <input type="submit" class="btn btn-success btn-sm" value="APROVAR" id="Salvar" name="Salvar" />
			</td>
		   </tr>
		  </table>
		  </center>
   </form>
</body>