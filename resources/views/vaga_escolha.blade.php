<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Abertura de Vaga - RH</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
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
	  <br><br><br>
	  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
		   <tr>
		    <td width="400"><center><h4> VAGA - FLUXO ORDINÁRIO: </h4></center></td>
		   </tr>
		   <tr>
		    <td><p align="justify"><center><b>Formulário de Solicitação de Abertura de Vagas para aprovação de uso padrão.</b></center></p></td>
		   </tr>
		   <tr>
		    <td><center> <a href="{{ route('cadastrarVaga', array($id,0)) }}" id="Selecionar" name="Selecionar" type="button" class="btn btn-info btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Selecionar </a> </center></td>
		   </tr>
		 </table>
		 <br><br>
		 <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
		  <tr>
			<td width="300"><center><h4> VAGA - FLUXO NÃO ORDINÁRIO: </h4></center></td>
		  </tr>
		  <tr>
		    <td><p align="justify"><center><b>Formulário de Solicitação de Abertura de Vagas para mudanças urgentes e prioritárias, esta será tratada como exceção e terá como fluxo de movimentação reduzido. </b></center></p></td>
		  </tr>
		  <tr>
		    <td><center> <a href="{{ route('cadastrarVaga', array($id, 1)) }}" id="Selecionar" name="Selecionar" type="button" class="btn btn-info btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Selecionar </a> </center></td>
		  </tr>
		 </table>
		 <br><br>
		 <tr>
		  <td align="right" colspan="4"> 
			<a href="{{url('/home/unidade')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
	      </td>
		 </tr>
      </center> 
</body>