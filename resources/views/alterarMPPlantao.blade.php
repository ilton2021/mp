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
	<script type="text/javascript">
		function multiplicar(){
			m1 = Number(document.getElementById("valor_plantao").value);
			m2 = Number(document.getElementById("quantidade_plantao").value);
			r = Number(m1*m2);
			document.getElementById("valor_pago_plantao").value = r;
		}
	</script>
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
		<form action="{{route('updateMPPlantao', array($idMP, $idA))}}" method="post">
		 <input type="hidden" name="_token" value="{{ csrf_token() }}"> 	
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td colspan="2"><center><strong><h3><br>Validar - Movimentação de Pessoal</h3></strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			</tr>
			@foreach($mps as $mp)
			<tr>
			  <td width="350px" hidden>Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->id; ?>" title="{{ $unidade[0]->id }}" readonly="true" /></td>
			  <td width="350px">Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" title="{{ $unidade[0]->nome }}" readonly="true" /></td>
			  <td width="200">Local de Trabalho: <input class="form-control" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->id; ?>" title="{{ $unidade[0]->nome }}" readonly="true" required /></td>
			  <td width="200">Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo $mp->solicitante; ?>" title="{{ $mp->solicitante }}" /></td>
			</tr>
			<tr>
			  <td>Nome: <input class="form-control" type="text" id="nome" name="nome" value="<?php echo $mp->nome; ?>" title="{{ $mp->nome }}" required /></td>
			  <td>Matrícula: <input class="form-control" type="text" id="matricula" name="matricula" value="<?php echo $mp->matricula; ?>" title="{{ $mp->numeroMP }}" /></td>
			  <td>Gestor Imediato: 
			  <select id="gestor_id" name="gestor_id" class="form-control" readonly="true" disabled="true">
			   <option id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->id ?>" title="{{ $gestor[0]->nome }}">{{ $gestor[0]->nome }}</option>
			  </select>
			</tr>
			<tr>
			  <td>Departamento: <input class="form-control" type="text" id="departamento"  name="departamento" value="<?php echo $mp->departamento; ?>" title="{{ $mp->departamento }}" required /></td>
			  <td>Número MP: <input class="form-control" type="text" id="numeroMP"  name="numeroMP" value="<?php echo $mp->numeroMP; ?>" readonly="true" title="{{ $mp->departamento }}" required /></td>
			  <td>Data de Emissão: <input class="form-control" type="date" id="data_emissao" name="data_emissao" readonly="true" value="<?php echo $mp->data_emissao; ?>" title="{{ $mp->data_emissao }}" required /></td>
			</tr>
		   </table>
		  </center>
		  
		  <br>	 
		  <center>
			<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
			  <tr>
			   <td width="800px;" colspan="2"><center><strong><h4>Tipos de Movimentação</h4></strong></center></td>
		 	   <td >Data Prevista: <input class="form-control" type="date" id="data_prevista" name="data_prevista" value="<?php echo $mp->data_prevista; ?>" required  title="{{ $mp->data_prevista }}" /></td>
			  </tr>	
			</table>
		  </center>
		  @endforeach
		  
		  @if(!empty($plantao))
	 	  @foreach($plantao as $plantao)	 
		   <center>
			<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
			<tr>
				<td width="130" rowspan="5"><center><h5>Plantão Extra</h5> 
				<input type="checkbox" disabled="true" checked id="tipo_mov4" name="tipo_mov4" />
				</center>
				<td colspan="2">Departamento 
				<select class="form-control" id="setor_plantao" name="setor_plantao">
				 @foreach($setores as $setor)
				 @if($setor->nome == $plantao->setor_plantao)
				  <option id="setor_plantao" name="setor_plantao" value="<?php echo $plantao->setor_plantao; ?>" selected>{{ $plantao->setor_plantao }}</option>
				 @else
				  <option id="setor_plantao" name="setor_plantao" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>
				 @endif
				 @endforeach
				</select>
				</td>
				<td colspan="1">Cargo: 
				<select class="form-control" id="cargo_plantao" name="cargo_plantao">
				 @foreach($cargos as $cargo)
				 @if($cargo->nome == $plantao->cargo_plantao)
				  <option id="cargo_plantao" name="cargo_plantao" value="<?php echo $plantao->cargo_plantao; ?>" selected>{{ $plantao->cargo_plantao }}</option>	
				 @else
				  <option id="cargo_plantao" name="cargo_plantao" value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>	
				 @endif
				 @endforeach
				</select>
				</td>
			</tr>
			<tr>
				<td width=" ">Motivo:
				 <input class="form-control" style="width: 250px;" type="text" id="motivo_plantao" name="motivo_plantao" title="<?php echo $plantao->motivo_plantao; ?>" value="<?php echo $plantao->motivo_plantao; ?>" />
				</td>
				<td width="50">Substituto:
				 <input class="form-control" style="width: 250px;" type="text" id="substituto" name="substituto" title="<?php echo $plantao->substituto; ?>" value="<?php echo $plantao->substituto; ?>" />
				</td>
				<td>Novo Centro de Custo: 
				<select name="centro_custo_plantao" id="centro_custo_plantao" class="form-control">	
				 @foreach($centro_custos as $cc)
				 @if($cc->nome == $plantao->centro_custo_plantao)
				  <option id="centro_custo_plantao" name="centro_custo_plantao" value="<?php echo $plantao->centro_custo_plantao; ?>" selected>{{ $plantao->centro_custo_plantao }}</option>
			  	 @else
				  <option id="centro_custo_plantao" name="centro_custo_plantao" value="<?php echo $cc->nome; ?>">{{ $cc->nome }}</option>	
				 @endif
				 @endforeach
				</select>	   
				</td>
			</tr>
			<tr>
				<td width="50"><b>Quantidade de Plantões:</b>
				 <input class="form-control" style="width: 250px;" type="text" onChange="multiplicar();" id="quantidade_plantao" name="quantidade_plantao" value="<?php echo $plantao->quantidade_plantao; ?>" />
				</td>
				<td><b>Valor do Plantão: </b>
				 <input class="form-control" id="valor_plantao" name="valor_plantao" onChange="multiplicar();" value="<?php echo $plantao->valor_plantao; ?>" />
				</td>
				<td width="300"><b>Valor a ser Pago: </b>
				 <input class="form-control" id="valor_pago_plantao" name="valor_pago_plantao" value="<?php echo $plantao->valor_pago_plantao; ?>" />	
				</td>
			</tr>
			</table>
			</center>
		  @endforeach
		 @endif
		 <br>
		 <br>
		  <center>		
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="40"><strong><h5>Justificativa/Observações:</h5></strong></td>
			<td><textarea required type="text" id="descricao" name="descricao" class="form-control" rows="10" cols="60"> {{ $justificativa[0]->descricao }} </textarea></td>
		   </tr>
		  </table>
		  </center>
		 
		  <center>
		  <table class="table table" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td align="left"> 
			 <a href="{{route('validarMP', $idMP)}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
			</td> 
			<td align="right"> 
			 <input type="submit" class="btn btn-success btn-sm" value="Alterar" id="Salvar" name="Salvar" /> 
			</td>
		   </tr>
		  </table>
		  </center>
   </form>
</body>