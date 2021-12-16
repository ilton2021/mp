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
		<form action="{{route('updateMPDemissao', array($idMP, $idA))}}" method="post">
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
			  <td width="200">Local de Trabalho: <input class="form-control" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly="true" required /></td>
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
			   <td  colspan="2"><center><strong><h4>Tipos de Movimentação</h4></strong></center></td>
			  </tr>
			  <tr>  
			   <td width="800px;"> <center><br><b>IMPACTO FINANCEIRO:</b>
				   <?php if($mp->impacto_financeiro == "sim"){  ?>
				   SIM: <input type="checkbox" checked id="sim_impacto" name="sim_impacto" value="sim" />
				   NÃO: <input type="checkbox" id="nao_impacto" name="nao_impacto" value="nao" />  
				   <?php } else if($mp->impacto_financeiro == "nao"){ ?>
				   SIM: <input type="checkbox" id="sim_impacto" name="sim_impacto" value="sim" />
				   NÃO: <input type="checkbox" checked id="nao_impacto" name="nao_impacto" value="nao" /> 
				   <?php } ?>
				</center>
				</td>
		 	   <td>Data Prevista: <input class="form-control" type="date" id="data_prevista" name="data_prevista" required value="<?php echo $mp->data_prevista; ?>" /></td>
			  </tr>	
			</table>
		  </center>
		  @endforeach
		  
		 @if(!empty($demissao))		
		  @foreach($demissao as $dem)	 
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="135"><center><h5>Demissão</h5> <input checked type="checkbox" id="tipo_mov2" name="tipo_mov2" disabled="true" /></center></td>
			<td width="800">Tipo de desligamento: 
			@if($dem->tipo_desligamento == "termino_contrato")
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="morte" /> Morte 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  </td>
		    @elseif($dem->tipo_desligamento == "extincao_antecipada")
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="morte" /> Morte 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  </td>
		    @elseif($dem->tipo_desligamento == "sem_justa_causa")
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="morte" /> Morte 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  </td>
		    @elseif($dem->tipo_desligamento == "aposentadoria")
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="morte" /> Morte 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  </td>
		    @elseif($dem->tipo_desligamento == "com_justa_causa")
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="morte" /> Morte 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  </td>
		    @elseif($dem->tipo_desligamento == "morte")
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="morte" /> Morte 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  </td>
		    @elseif($dem->tipo_desligamento == "pedido_demissao")
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="morte" /> Morte 
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  </td>
		    @endif
			<td width="200">Aviso Prévio: <br><br> 
			@if($dem->aviso_previo == "trabalhado")
			<input type="checkbox" checked id="aviso_previo" name="aviso_previo" value="trabalhado" /> Trabalhado 
			<br><br> <input type="checkbox" id="aviso_previo" name="aviso_previo" value="indenizado" /> Indenizado 
			<br><br> <input type="checkbox" id="aviso_previo" name="aviso_previo" value="dispensado" /> Dispensado </td>
		    @elseif($dem->aviso_previo == "indenizado")
			<input type="checkbox" id="aviso_previo" name="aviso_previo" value="trabalhado" /> Trabalhado 
			<br><br> <input type="checkbox" checked id="aviso_previo" name="aviso_previo" value="indenizado" /> Indenizado 
			<br><br> <input type="checkbox" id="aviso_previo" name="aviso_previo" value="dispensado" /> Dispensado </td>
		    @elseif($dem->aviso_previo == "dispensado")
			<input type="checkbox" id="aviso_previo" name="aviso_previo" value="trabalhado" /> Trabalhado 
			<br><br> <input type="checkbox" id="aviso_previo" name="aviso_previo" value="indenizado" /> Indenizado 
			<br><br> <input type="checkbox" checked id="aviso_previo" name="aviso_previo" value="dispensado" /> Dispensado </td>
		    @endif
			<td width="50">Último dia Trabalhado: <br> <input class="form-control" type="date" id="ultimo_dia" name="ultimo_dia" value="<?php echo $dem->ultimo_dia; ?>" required /> 
			<br> Custo da Recisão: <input required class="form-control" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="custo_recisao" name="custo_recisao" value="<?php echo $dem->custo_recisao; ?>" />
			<br> Salário Bruto: <input required class="form-control" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_bruto" name="salario_bruto" value="<?php echo $dem->salario_bruto; ?>" /></td>
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