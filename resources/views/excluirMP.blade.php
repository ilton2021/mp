<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Movimentação de Pessoal - Validação</title>
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
	  <form action="{{\Request::route('deleteMP')}}" method="post">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
          @foreach($mps as $mp)
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td colspan="2"><center><strong><h3><br>Movimentação de Pessoal</h3></strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			  <td hidden><input hidden class="form-control" type="text" id="mp_id" name="mp_id" value="" readonly="true" /></td>
			</tr>
			<tr>
			  <td width="400px">Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
			  <td>Local de Trabalho:
			    <input class="form-control" readonly="true" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome ?>" />
			  </td>
			  <td>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo $mp->solicitante; ?>" /></td>
			</tr>
			<tr>
			  <td> Número do MP: <input class="form-control" readonly="true" type="text" id="numeroMP" name="numeroMP" value="<?php echo $mp->numeroMP; ?>" /> </td>
			  <td colspan="1">Departamento: <input class="form-control" readonly="true" type="text" id="departamento" name="departamento" value="<?php echo $mp->departamento; ?>" required /></td>
			  <td>Gestor Imediato: 
			    <input type="text" class="form-control" readonly="true" id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->gestor_imediato; ?>" />
			</tr>
			<tr>
			  <td colspan="1">Nome: <input readonly="true" class="form-control" type="text" id="nome" name="nome" required="true" value="<?php echo $mp->nome; ?>" /></td>
			  <td> Matrícula: <input class="form-control" readonly="true" type="text" id="matricula" name="matricula" value="<?php echo $mp->matricula; ?>" /> </td>
			  <td>Data de Emissão: <input class="form-control" type="text" id="data_emissao" name="data_emissao" value="<?php echo date('d-m-Y', strtotime($mp->data_emissao)); ?>" readonly="true" /></td>
			</tr>
		   </table>
		  </center>
		  
		  <br>	 
		  <center>
			<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
			  <tr>
			   <td width="800px;" colspan="2"><center><strong><h4>Tipos de Movimentação</h4></strong></center></td>
		 	   <td >Data Prevista: <input class="form-control" readonly="true" type="text" id="data_prevista" name="data_prevista" required value="<?php echo date('d-m-Y', strtotime($mp->data_prevista)); ?>" /></td>
			  </tr>	
			</table>
		  </center>
		  @endforeach

		  <table hidden>
			  <tr>
				<td> <input hidden type="text" id="acao" name="acao" value="excluir_mp" class="form-control" /> </td>
				<td> <input hidden type="text" id="user_id" name="user_id" value="<?php echo Auth::user()->id; ?>" class="form-control" /> </td>
			  </tr>
		  </table>	
		
		  <center> <br><br>
		  <table class="table" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td>
			  <a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
			</td> 
			<td align='center'><b> Deseja Realmente Excluir esta MP, todas as Validações serão excluídas! </b></td>
			<td align="right"> 
			 <input type="submit" class="btn btn-danger btn-sm" style="margin-top: 10px;" value="Excluir" id="Salvar" name="Salvar" /> 
			</td>
		   </tr>
		  </table>
		  </center>
   </form>
</body>