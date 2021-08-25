<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Movimentação de Pessoal - RH</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<body>
	  <br>
	  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
		   <tr>
		    <td width="500"><center><h4><b> Movimentação de Pessoal </b></h4></center></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td width="500"><center><h4><b>Solicitação de Abertura de Vaga</b></h4></center></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td width="800"><center><h4><b>Solicitação de Inscrição <br>Programa Degrau</b></h4></center></td>
		   </tr>
		   <tr>
		    <td><p align="justify"><center><b>Formulário de Movimentação de Pessoal (MP)</b></center></p>
			<center><img src="{{ asset('/img/foto.jpeg') }}" width="350" height="350" /></center>
			</td>
			<td></td>
			<td><p align="justify"><center><b>Formulário de Solicitação de Abertura de Vagas</b></center></p>
			<center><img src="{{ asset('/img/foto2.jpeg') }}" width="350" height="350" /></center>
			<td></td>
			<td><p align="justify"><center><b>Formulário de Solicitação de Inscrição</b></center></p>
			<center><img src="{{ asset('/img/programaDegrau.png') }}" width="350" height="350" /></center>
			</td>
		   </tr>
		   <tr>
		    <td><center> <a href="{{ route('inicioMP') }}" id="Selecionar" name="Selecionar" type="button" class="btn btn-info btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Selecionar </a> </center></td>
			<td>&nbsp;</td>
			<td><center> <a href="{{ route('inicioVaga') }}" id="Selecionar" name="Selecionar" type="button" class="btn btn-info btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Selecionar </a> </center></td>
			<td>&nbsp;</td>
			<td><center> <a href="{{ route('inicioDegrau') }}" id="Selecionar" name="Selecionar" type="button" class="btn btn-info btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Selecionar </a> </center></td>
		   </tr>
		   
		 </table>
</body>