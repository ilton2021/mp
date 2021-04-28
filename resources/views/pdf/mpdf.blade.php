<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Movimentação de Pessoal</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script type="text/javascript">
		function desabilitar(valor) {
		  var status = document.getElementById('justificativa').disabled;
		  
		  if (status == true) {
			document.getElementById('justificativa').disabled = false;
		  } else {
			document.getElementById('justificativa').disabled = true;   
		  }
		}
		
		function desabilitar2(valor) {
		  var status = document.getElementById('justificativa2').disabled;
		  
		  if (status == true) {
			document.getElementById('justificativa2').disabled = false;
		  } else {
			document.getElementById('justificativa2').disabled = true;   
		  }
		}
  </script>
<body>
	  <form method="POST" action="{{\Request::route('salvarMP'), $mps[0]->id}}">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
	      <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			@foreach($mps as $mp)
			<tr>
			  @if($mp->tipo_mp == 0)
			  <td colspan="2"><center><strong><h3><br>Movimentação de Pessoal - ORDINÁRIO</h3></strong></center></td>	 
			  @else
			  <td colspan="2"><center><strong><h3><br>Movimentação de Pessoal - NÃO ORDINÁRIO</h3></strong></center></td>	  	  
			  @endif
		      <td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			</tr>
			<tr>
			  <td>Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly="true" /></td>
			  <td>Local de Trabalho: <input class="form-control" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly="true" required /></td>
			  <td>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo $mp->solicitante; ?>" title="{{ $mp->solicitante }}" /></td>
			</tr>
			<tr>
			  <td>Nome: <input class="form-control" type="text" id="nome" name="nome" value="<?php echo $mp->nome; ?>" title="{{ $mp->nome }}" required readonly="true" /></td>
			  <td>Matrícula: <input class="form-control" type="text" id="matricula" name="matricula" value="<?php echo $mp->matricula; ?>" title="{{ $mp->matricula }}" required readonly="true" /></td>
			  <td>Gestor Imediato: 
			  <input type="text" class="form-control" id="gestor" name="gestor" value="<?php echo $gestor[0]['nome']; ?>"></input>
			</tr>
			<tr>
			  <td>Número MP: <input class="form-control" type="text" id="numeroMP" name="numeroMP" value="<?php echo $mp->numeroMP; ?>" title="{{ $mp->numeroMP }}" required readonly="true" /></td>
			  <td colspan="1">Departamento: <input class="form-control" type="text" id="departamento" readonly="true" name="departamento" value="<?php echo $mp->departamento; ?>" title="{{ $mp->departamento }}" required /></td>
			  <td>Data de Emissão: <input class="form-control" type="text" id="data_emissao" name="data_emissao" readonly="true" value="<?php echo date('d-m-Y', strtotime($mp->data_emissao)); ?>" title="{{ $mp->data_emissao }}" required /></td>
			</tr>
		   </table>
		  </center>
		  
		  <center>
			<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
			  <tr>
			   <td width="800px;" colspan="2"><center><strong><h4>Tipos de Movimentação</h4></strong></center></td>
		 	   <td>Data Prevista: <input class="form-control" type="text" id="data_prevista" name="data_prevista" value="<?php echo date('d-m-Y', strtotime($mp->data_prevista)); ?>" required readonly="true" title="{{ $mp->data_prevista }}" /></td>
			  </tr>	
			</table>
		  </center>
		  @endforeach

		  @if(!empty($admissao))
		  @foreach($admissao as $adm)	
		  <center>
		   <table class="table table-bordered" style="width: 1500px;" cellspacing="0">
		    </tr>
		    <tr>
			 <td rowspan="5">
			 <center><h5>Admissão</h5> <input type="checkbox" id="tipo_mov1" name="tipo_mov1" checked readonly="true" disabled="true" /></center>
			 </td> 
			 <td colspan="2" style="width: 500px">Cargo: <input class="form-control" type="text" style="width:200px" id="cargo" name="cargo" value="<?php echo $adm->cargo; ?>" readonly="true" /></td>
			 <td style="width: 250px">Salário: <input class="form-control" type="text" id="salario" style="width:180px" name="salario" value="<?php echo "R$ " .number_format($adm->salario, 2, ',','.'); ?>" readonly="true" /></td>
			 <td>Horário de Trabalho: <br><input class="form-control" type="text" style="width:160px" id="horario_trabalho" name="horario_trabalho" value="<?php echo $adm->horario_trabalho; ?>" readonly="true" /></td>
			</tr>
			<tr>
			 <td></td>
			 <td colspan="2" style="width: 500px">Escala de Trabalho: <br>
			 @if($adm->escala_trabalho == "segxsex")
			 <input type="checkbox" checked id="escala_trabalho" name="escala_trabalho" value="" disabled="true" /> {{ 'Segunda a Sexta' }}<br>
		     @elseif($adm->escala_trabalho == "12x36")
			 <input type="checkbox" checked id="escala_trabalho" name="escala_trabalho" value="" disabled="true" /> {{ '12x36' }}<br>
			 @elseif($adm->escala_trabalho == "12x60")
			 <input type="checkbox" checked id="escala_trabalho" name="escala_trabalho" value="" disabled="true" /> {{ '12x60' }}  <br>
			 @elseif($adm->escala_trabalho == "outra")
			 <input type="checkbox" checked id="escala_trabalho" name="escala_trabalho" value="" disabled="true" />  {{ 'Outra' }}
			 <input type="text" style="width: 108px;" id="escala_trabalho2" name="escala_trabalho2" value="" /> 
			 @endif
			 </td> 
			 <td colspan="1" style="250px;">Centro de Custo: <input class="form-control" style="width:200px" type="text" id="centro_custo" name="centro_custo" value="<?php echo $adm->centro_custo; ?>" readonly="true" /></td>
			 <td>Jornada:
			 @if($adm->jornada == "diarista")
			 <input class="form-control" style="width:120px" type="text" id="jornada" name="jornada" value="<?php echo "Diarista"; ?>" readonly="true" />
			 @elseif($adm->jornada == "plantao_par")
			 <input class="form-control" style="width:120px" type="text" id="jornada" name="jornada" value="<?php echo "Plantão Par"; ?>" readonly="true" />
			 @elseif($adm->jornada == "plantao_impar")
			 <input class="form-control" style="width:120px" type="text" id="jornada" name="jornada" value="<?php echo "Plantão Ímpar"; ?>" readonly="true" />
			 @endif
			 <br>Turno: <br> 
			 @if($adm->turno == "dia")
			 <input type="checkbox" checked id="turno" name="turno" value="dia" disabled="true" /> Dia 
			 @elseif($adm->turno == "noite")
			 <input type="checkbox" checked id="turno" name="turno" value="noite" disabled="true" /> Noite
		     @endif
			 </td>
			</tr>
			<tr>
			 <td></td>
			 <td colspan="2">Tipo: <br> 
			 @if($adm->tipo == "efetivo")
			 <input type="checkbox" checked id="tipo" name="tipo" value="efetivo" disabled="true" /> Efetivo 
			 @elseif($adm->tipo == "estagiario")
			 <input type="checkbox" checked id="tipo" name="tipo" value="estagiario" disabled="true" /> Estagiário 
			 @elseif($adm->tipo == "temporario")
			 <input type="checkbox" checked id="tipo" name="tipo" value="temporario" disabled="true" /> Temporário  
			 @elseif($adm->tipo == "aprendiz")
			 <input type="checkbox" checked id="tipo" name="tipo" value="aprendiz" disabled="true" /> Aprendiz 
			 @elseif($adm->tipo == "rpa")
			 <input type="checkbox" checked id="tipo" name="tipo" value="rpa" disabled="true" /> RPA </td>
		     @endif
			 @if($adm->tipo == "rpa")
			 <td>Período do Contrato RPA: <input class="form-control" type="text" id="periodo_contrato" name="periodo_contrato" value="<?php echo $adm->periodo_contrato; ?>" readonly="true" /></td>
			 @endif
			</tr>
			<tr>
			 <td></td>
			 <td colspan="3">Motivo: <br> 
			 @if($adm->motivo == "aumento_quadro")
			 <input type="checkbox" checked id="motivo" name="motivo" value="aumento_quadro" disabled="true" /> Aumento de Quadro 
			 @elseif($adm->motivo == "substituicao_temporaria")
			 <input type="checkbox" checked id="motivo" name="motivo" value="substituicao_temporaria" disabled="true" /> Substituição temporária 
			 @elseif($adm->motivo == "segundo_vinculo")
			 <input type="checkbox" checked id="motivo" name="motivo" value="segundo_vinculo" disabled="true" /> Segundo Vínculo 
		     @elseif($adm->motivo == "substituicao_definitiva")
			 <input type="checkbox" checked id="motivo" name="motivo" value="substituicao_definitiva" disabled="true" /> Substituição definitiva a: 
			 <input type="text" style="width: 220px;" id="motivo2" name="motivo2" value="<?php echo $adm->motivo2; ?>" disabled="true" /> </td>
			 @endif
			</tr>
			<tr>
			 <td></td>
			 <td colspan="3">Possibilidade de Contratação de Deficiente:<br> 
			 @if($adm->possibilidade_contratacao == 'sim') 
			  <input type="checkbox" readonly="true" checked id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" disabled="true" /> Sim
			 @else
			  <input type="checkbox" readonly="true" checked id="possibilidade_contratacao" name="possibilidade_contratacao" value="nao" disabled="true" /> Não
			 @endif 
			 </td>
			 <td colspan="2">Necessidade de conta de e-mail:<br> 
			 @if($adm->necessidade_email == "sim")
			 <input type="checkbox" checked id="necessidade_email" name="necessidade_email" value="sim" disabled="true" /> Sim 
		     @else
			 <input type="checkbox" checked id="necessidade_email" name="necessidade_email" value="nao" disabled="true" /> Não</td>
		     @endif
			</tr>
		   </table>
		  </center>
		  @endforeach	 
		  @endif
		  <br>
		
		 @if(!empty($demissao))		
		  @foreach($demissao as $dem)	 
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td ><center><h5>Demissão</h5> <input checked type="checkbox" id="tipo_mov2" name="tipo_mov2" disabled="true" /></center>
			<td >Tipo de desligamento: 
			@if($dem->tipo_desligamento == "termino_contrato")
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" disabled="true" /> Término de Contrato 
			@elseif($dem->tipo_desligamento == "extincao_antecipada")
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada" disabled="true" /> Extinção Antecipada do Contrato 
			@elseif($dem->tipo_desligamento == "sem_justa_causa")
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa" disabled="true" /> Dispensa sem justa causa 
			@elseif($dem->tipo_desligamento == "aposentadoria")
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria" disabled="true" /> Aposentadoria 
			@elseif($dem->tipo_desligamento == "com_justa_causa")
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa" disabled="true" /> Dispensa com justa causa 
			@elseif($dem->tipo_desligamento == "morte")
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="morte" disabled="true" /> Morte 
			@elseif($dem->tipo_desligamento == "pedido_demissao")
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao" disabled="true" /> Pedido de Demissão  
		    @endif
			</td>
			<td>Aviso Prévio: <br><br> 
			@if($dem->aviso_previo == "trabalhado")
			<input type="checkbox" checked id="aviso_previo" name="aviso_previo" value="trabalhado" disabled="true" /> Trabalhado 
			 @elseif($dem->aviso_previo == "indenizado")
			<input type="checkbox" checked id="aviso_previo" name="aviso_previo" value="indenizado" disabled="true" /> Indenizado 
			 @elseif($dem->aviso_previo == "dispensado")
			<input type="checkbox" checked id="aviso_previo" name="aviso_previo" value="dispensado" disabled="true" /> Dispensado 
		    @endif
			</td>
			<td>Último dia Trabalhado: <br> <input class="form-control" type="text" id="ultimo_dia" name="ultimo_dia" value="<?php echo date('d-m-Y', strtotime($dem->ultimo_dia)); ?>" disabled="true" /> 
			<br><br> Custo da Recisão: <input type="text" class="form-control" id="custo_recisao" name="custo_recisao" value="<?php echo $dem->custo_recisao; ?>" disabled="true" /> </td>
		   </tr>
		  </table>
		  </center>
		  @endforeach
		 @endif		
		 <br>
		
		 @if(!empty($alteracaoF))
	 	  @foreach($alteracaoF as $altF)	 
		  <center>
		  <table class="table table-bordered" style="width: 1400px;" cellspacing="0">
		   <tr>
			<td width="130" rowspan="5"><center><h5>Alteração Funcional</h5> <input type="checkbox" id="tipo_mov3" name="tipo_mov3" checked disabled="true" /></center>
			<td colspan="2" style="width: 250px">Indique a Unidade 
			  @if($altF->unidade_id == 1)
				<input type="text" class="form-control" id="unidade" name="unidade" disabled="true" style="width: 300px;" value="<?php echo 'HCP Gestão' ?>" /> 
			  @elseif($altF->unidade_id == 2)
			    <input type="text" class="form-control" id="unidade" name="unidade" disabled="true" style="width: 300px;" value="<?php echo 'Hospital da Mulher do Recife' ?>" />
			  @elseif($altF->unidade_id == 3)
			    <input type="text" class="form-control" id="unidade" name="unidade" disabled="true" style="width: 300px;" value="<?php echo 'UPAE Belo Jardim' ?>" />
			  @elseif($altF->unidade_id == 4)
			    <input type="text" class="form-control" id="unidade" name="unidade" disabled="true" style="width: 300px;" value="<?php echo 'UPAE Arcoverde' ?>" />
			  @elseif($altF->unidade_id == 5)
			    <input type="text" class="form-control" id="unidade" name="unidade" disabled="true" style="width: 300px;" value="<?php echo 'UPAE Arruda' ?>" />
			  @elseif($altF->unidade_id == 6)
			    <input type="text" class="form-control" id="unidade" name="unidade" disabled="true" style="width: 300px;" value="<?php echo 'UPAE Caruaru' ?>" />
			  @elseif($altF->unidade_id == 7)
			    <input type="text" class="form-control" id="unidade" name="unidade" disabled="true" style="width: 300px;" value="<?php echo 'Hospital São Sebastião' ?>" />
			  @elseif($altF->unidade_id == 8)
			    <input type="text" class="form-control" id="unidade" name="unidade" disabled="true" style="width: 300px;" value="<?php echo 'Hospital Provisório do Recife I' ?>" />
			  @endif
			<td colspan="2" style="width: 250px">Departamento Proposto <input class="form-control" type="text" id="setor" name="setor" value="<?php echo $altF->setor; ?>" disabled="true" /></td>
		   </tr>
		   <tr>
		    <td></td>
		    <td colspan="2">Cargo Atual: <input class="form-control" type="text" id="cargo_atual" name="cargo_atual" value="<?php echo $altF->cargo_atual; ?>" disabled="true" /></td>
			<td colspan="1" >Cargo Proposto: <input class="form-control" type="text" id="cargo_novo" name="cargo_novo" value="<?php echo $altF->cargo_novo; ?>" disabled="true" /></td>
			<td>Novo Horário de Trabalho <input class="form-control" style="width: 100px;" type="text" id="horario_novo" name="horario_novo" value="<?php echo $altF->horario_novo; ?>" disabled="true" /></td>
		   </tr>
		   <tr>
		    <td></td>
		    <td>Salário Atual: <input class="form-control" type="text" id="salario_atual" name="salario_atual" value="<?php echo $altF->salario_atual; ?>" disabled="true" /></td>
			<td>Salário Proposto: <input class="form-control" type="text" id="salario_novo" name="salario_novo" value="<?php echo $altF->salario_novo; ?>" disabled="true" /></td>
			<td colspan="2">Novo Centro de Custo: <input class="form-control" type="text" id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $altF->centro_custo_novo; ?>" disabled="true" /></td>
		   </tr>
		   <tr>
		    <td></td>
			<td colspan="4">Motivo: <br><br> 
			@if($altF->motivo == "promocao")
			<input type="checkbox" checked id="motivo" name="motivo" value="promocao" disabled="true" /> Promoção 
		    @elseif($altF->motivo == "merito")
			<input type="checkbox" checked id="motivo" name="motivo" value="merito" disabled="true" /> Mérito 
			@elseif($altF->motivo == "mudanca_setor_area")
			<input type="checkbox" checked id="motivo" name="motivo" value="mudanca_setor_area" disabled="true" /> Mudança de Setor/Área 
			@elseif($altF->motivo == "transferencia_outra_unidade")
			<input type="checkbox" checked id="motivo" name="motivo" value="transferencia_outra_unidade" disabled="true" /> Transferência para outra unidade 
			@elseif($altF->motivo == "enquadramento")
			<input type="checkbox" checked id="motivo" name="motivo" value="enquadramento" disabled="true" /> Enquadramento 
			@elseif($altF->motivo == "mudanca_horaria")
			<input type="checkbox" checked id="motivo" name="motivo" value="mudanca_horaria" disabled="true" /> Mudança de Horário  
			@elseif($altF->motivo == "substituicao_demissao_voluntaria")
			<input type="checkbox" checked id="motivo" name="motivo" value="substituicao_demissao_voluntaria" disabled="true" /> Substituição por demissão voluntária <br><br> 
			@elseif($altF->motivo == "recrutamento_interno")
			<input type="checkbox" checked id="motivo" name="motivo" value="recrutamento_interno" disabled="true" /> Recrutamento Interno  
			@elseif($altF->motivo == "aumento_quadro")
			<input type="checkbox" checked id="motivo" name="motivo" value="aumento_quadro" disabled="true" /> Aumento de Quadro 
			@elseif($altF->motivo == "substituicao_demissao_forcada")
			<input type="checkbox" checked id="motivo" name="motivo" value="substituicao_demissao_forcada" disabled="true" /> Substituição por demissão forçada  </td>
		    @endif
		   </tr>
		  </table>
		  </center>
		  @endforeach 
		 @endif		
		 
		  <br>
		  <center>		
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="40"><strong><h5>Justificativa/Observações:</h5></strong></td>
			<td><input type="text" class="form-control" id="justificativa" name="justificativa" value="<?php echo $justificativa[0]['descricao']; ?>"></input></td>
		   </tr>
		  </table>
		  </center>
		  
		  <br>
		  <center>	
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="100" colspan="6"><strong>Aprovações (Carimbo e Assinatura):</strong></td>
		   </tr>
		   <tr>
			 <td>Solicitante </td>
			 <td></td>
		     <td>{{ date('d-m-Y', strtotime('now')) }}</td>	
			 <td></td>
		   </tr> 
		   <tr>
			 <td>Gestor Imediato</td> 
			 <td></td>
			 <td><input readonly="true" type="text" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control" value="" /></td>
		     <td></td>
		   </tr>
		   <tr>
			 <td>Rec. Humanos</td>
			 <td></td>
			 <td><input readonly="true" type="text" id="data_rec_humanos" name="data_rec_humanos" class="form-control" value="" /></td>
			 <td></td>
		   </td>
		   </tr>
		   <tr>
		     <td>Diretoria Técnica</td>
			 <td></td>
			 <td><input readonly="true" type="text" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control" value="" /></td>
			 <td></td>
		   </tr>
		   <tr>
		     <td>Diretoria</td>
			 <td></td>
			 <td><input readonly="true" type="text" id="data_diretoria" name="data_diretoria" class="form-control" value="" /></td>
			 <td></td>
		   </tr>
		   <tr>
		     <td>Superintendência</td>
			 <td></td>
			 <td><input readonly="true" type="text" id="data_superintendencia" name="data_superintendencia" class="form-control" value="" /></td>
			 <td></td>
		   </tr>
		   </table>
		  </center>
   </form>
</body>
   