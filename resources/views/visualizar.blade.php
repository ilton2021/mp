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
	<script>
		function voltar(){
			header('location:javascript://history.go(-1)');
		}
		
		$(document).ready(function(){
		   $('.money').mask('000.000.000.000.000,00', {reverse: true});
		  
		  $(".money").change(function(){
			$("#value").html($(this).val().replace(/\D/g,''))
		  })
		  
		});
		window.onload = function() {
		var imprimir = document.querySelector("#imprimir");
		    imprimir.onclick = function() {
		    	
		    	imprimir.style.display = 'none';
		    	window.print();
                var time = window.setTimeout(function() {
		    		imprimir.style.display = 'block';
		    	}, 1000);
		    }
		}
	</script>
<body>
	  @if (Session::has('mensagem'))
		@if ($text == 1)
		   <div class="container">
			  <div class="alert alert-danger {{ Session::get ('mensagem')['class'] }} ">
				 {{ Session::get ('mensagem')['msg'] }}
			  </div>
		   </div>
		@endif
	  @endif 	
	      <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			 @if($mps[0]->concluida == 1)
			  <td colspan="2"><center><strong><h3>Concluído - Movimentação de Pessoal</h3></strong></center></td>
		     @else
			  <td colspan="2"><center><strong><h3>Visualizar - Movimentação de Pessoal</h3></strong></center></td>
		     @endif
			  <td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			</tr>
			@foreach($mps as $mp)
			<tr>
			  <td>Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly="true" /></td>
			  <td>Local de Trabalho: <input class="form-control" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly="true" required /></td>
			  <td>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo $mp->solicitante; ?>" title="{{ $mp->solicitante }}" /></td>
			</tr>
			<tr>
			  <td>Nome: <input class="form-control" type="text" id="nome" name="nome" value="<?php echo $mp->nome; ?>" title="{{ $mp->nome }}" required readonly="true" /></td>
			  <td>Matrícula: <input class="form-control" type="text" id="matricula" name="matricula" value="<?php echo $mp->matricula; ?>" title="{{ $mp->numeroMP }}" required readonly="true" /></td>
			  <td>Gestor Imediato: 
			  <select id="gestor_id" name="gestor_id" class="form-control" readonly="true" disabled="true">
			  @if(!empty($gestores))
			   @foreach($gestores as $gestor)
		        @if($mp->gestor_id == $gestor->id)
			      <option id="gestor_id" name="gesto-r_id" value="<?php echo $gestor->id ?>" title="{{ $gestor->nome }}">{{ $gestor->nome }}</option>
			    @endif
			   @endforeach
			  @endif
			  </select>
			</tr>
			<tr>
			  <td>Número MP: <input class="form-control" type="text" id="numeroMP" name="numeroMP" value="<?php echo $mp->numeroMP; ?>" title="{{ $mp->numeroMP }}" required readonly="true" /></td>
			  <td colspan="1">Departamento: <input class="form-control" type="text" id="departamento" readonly="true" name="departamento" value="<?php echo $mp->departamento; ?>" title="{{ $mp->departamento }}" required /></td>
			  <td>Data de Emissão: <input class="form-control" type="date" id="data_emissao" name="data_emissao" readonly="true" value="<?php echo $mp->data_emissao; ?>" title="{{ $mp->data_emissao }}" required /></td>
			</tr>
		   </table>
		  </center>
		  
		  <center>
			<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
			  <tr>
			   <td width="800px;" colspan="2"><center><strong><h4>Tipos de Movimentação</h4></strong></center></td>
		 	   <td >Data Prevista: <input class="form-control" type="date" id="data_prevista" name="data_prevista" value="<?php echo $mp->data_prevista; ?>" required readonly="true" title="{{ $mp->data_prevista }}" /></td>
			  </tr>	
			</table>
		  </center>
		  @endforeach

		  @if(!empty($admissao))
		  @foreach($admissao as $adm)	
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		    </tr>
		    <tr>
			 <td rowspan="5" width="150">
			 <center><h5>Admissão</h5> <input type="checkbox" id="tipo_mov1" name="tipo_mov1" checked readonly="true" disabled="true" /></center>
			 </td>
			 <td colspan="1" width="1050">Cargo: 
					<input class="form-control" type="text" id="cargo" name="cargo" value="<?php echo $adm->cargo; ?>" readonly="true" />
			 </td>
			 <td width="370">
			 Remuneração Total:
			 <input class="form-control" type="text" id="salario" name="salario" value="<?php echo "R$ ".number_format($adm->salario + $adm->outras_verbas, 2,',','.'); ?>" readonly="true" />
			 Salário: 
			 <input class="form-control" type="text" id="salario" name="salario" value="<?php echo "R$ ".number_format($adm->salario, 2,',','.'); ?>" readonly="true" />
			 Outras Verbas:
			 <input class="form-control" type="text" id="outras_verbas" name="outras_verbas" value="<?php echo "R$ ".number_format($adm->outras_verbas, 2,',','.'); ?>" readonly="true" />
			 </td>
			 <td width="200">Horário de Trabalho: <br><input class="form-control" type="text" id="horario_trabalho" name="horario_trabalho" value="<?php echo $adm->horario_trabalho; ?>" readonly="true" /></td>
			</tr>
			<tr>
			 <td colspan="1" width="1050">Escala de Trabalho: <br><br> 
			 @if($adm->escala_trabalho == "segxsex")
			 <input type="checkbox" checked id="escala_trabalho" name="escala_trabalho" value="segxsex" disabled="true" /> Segunda a Sexta <br>
		     @elseif($adm->escala_trabalho == "12x36")
			 <input type="checkbox" checked id="escala_trabalho" name="escala_trabalho" value="12x36" disabled="true" /> 12x36 <br>
			 @elseif($adm->escala_trabalho == "12x60")
			 <input type="checkbox" checked id="escala_trabalho" name="escala_trabalho" value="12x60" disabled="true" /> 12x60 <br>
			 @elseif($adm->escala_trabalho == "outra")
			 <input type="checkbox" checked id="escala_trabalho" name="escala_trabalho" value="outra" disabled="true" /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho2" name="escala_trabalho2" value="" /> 
			 @endif
			 </td> 
			 <td width="370">Centro de Custo: <input class="form-control" type="text" id="centro_custo" name="centro_custo" value="<?php echo $adm->centro_custo; ?>" readonly="true" /></td>
			 <td width="450">Jornada:
			 @if($adm->jornada == "diarista")
			 <input class="form-control" type="text" id="jornada" name="jornada" value="<?php echo "Diarista"; ?>" readonly="true" />
			 @elseif($adm->jornada == "plantao_par")
			 <input class="form-control" type="text" id="jornada" name="jornada" value="<?php echo "Plantão Par"; ?>" readonly="true" />
			 @elseif($adm->jornada == "plantao_impar")
			 <input class="form-control" type="text" id="jornada" name="jornada" value="<?php echo "Plantão Ímpar"; ?>" readonly="true" />
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
			 <td colspan="3">Motivo: <br> 
			 @if($adm->motivo == "aumento_quadro")
			 <input type="checkbox" checked id="motivo" name="motivo" value="aumento_quadro" disabled="true" /> Aumento de Quadro 
			 @elseif($adm->motivo == "substituicao_temporaria")
			 <input type="checkbox" checked id="motivo" name="motivo" value="substituicao_temporaria" disabled="true" /> Substituição temporária 
			 @elseif($adm->motivo == "segundo_vinculo")
			 <input type="checkbox" checked id="motivo" name="motivo" value="segundo_vinculo" disabled="true" /> Segundo Vínculo
		     @elseif($adm->motivo == "substituicao_definitiva")
			 <input type="checkbox" checked id="motivo" name="motivo" value="substituicao_definitiva" disabled="true" /> Substituição definitiva a: 
			 <input type="text" style="width: 320px;" id="motivo2" name="motivo2" value="<?php echo $adm->motivo2; ?>" disabled="true" /> </td>
			 @endif
			</tr>
			<tr>
			 <td>Possibilidade de Contratação de Deficiente:<br> 
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
		  
		 @if(!empty($demissao))		
		  @foreach($demissao as $dem)	 
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="135"><center><h5>Demissão</h5> <input checked type="checkbox" id="tipo_mov2" name="tipo_mov2" disabled="true" /></center>
			<td width="800">Tipo de desligamento: 
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
			<br><br> <input type="checkbox" checked id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao" disabled="true" /> Pedido de Demissão  </td>
		    @endif
			<td width="200">Aviso Prévio: <br><br> 
			@if($dem->aviso_previo == "trabalhado")
			<input type="checkbox" checked id="aviso_previo" name="aviso_previo" value="trabalhado" disabled="true" /> Trabalhado 
			 @elseif($dem->aviso_previo == "indenizado")
			<input type="checkbox" checked id="aviso_previo" name="aviso_previo" value="indenizado" disabled="true" /> Indenizado 
			@elseif($dem->aviso_previo == "dispensado")
			<input type="checkbox" checked id="aviso_previo" name="aviso_previo" value="dispensado" disabled="true" /> Dispensado </td>
		    @endif
			<td width="50">Último dia Trabalhado: <br> <input class="form-control" type="date" id="ultimo_dia" name="ultimo_dia" value="<?php echo $dem->ultimo_dia; ?>" disabled="true" /> 
			<br><br> Custo da Recisão: <input type="text" class="form-control" id="custo_recisao" name="custo_recisao" value="<?php echo "R$ ".number_format($dem->custo_recisao, 2,',','.'); ?>" disabled="true" /> </td>
		   </tr>
		  </table>
		  </center>
		  @endforeach
		 @endif		
		 
		 @if(!empty($alteracaoF))
	 	  @foreach($alteracaoF as $altF)	 
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="130" rowspan="5"><center><h5>Alteração Funcional</h5> <input type="checkbox" id="tipo_mov3" name="tipo_mov3" checked disabled="true" /></center>
			<td width="500">Transferência proposta: Indique a Unidade 
			  <select id="unidade_id" name="unidade_id" class="form-control" disabled="true">
			  @foreach($unidades as $unidade)
			    <option id="unidade_id2" name="unidade_id2">{{ $unidade->nome }}</option>
			  @endforeach
			  </select>
			<td colspan="2">Departamento Proposto <input class="form-control" type="text" id="setor" name="setor" value="<?php echo $altF->setor; ?>" disabled="true" /></td>
		   </tr>
		   <tr>
		    <td colspan="1">Cargo Atual: <input class="form-control" type="text" id="cargo_atual" name="cargo_atual" value="<?php echo $altF->cargo_atual; ?>" disabled="true" /></td>
			<td colspan="1" width="200">Cargo Proposto: <input class="form-control" type="text" id="cargo_novo" name="cargo_novo" value="<?php echo $altF->cargo_novo; ?>" disabled="true" /></td>
			<td width="50">Novo Horário de Trabalho <input class="form-control" style="width: 250px;" type="text" id="horario_novo" name="horario_novo" value="<?php echo $altF->horario_novo; ?>" disabled="true" /></td>
		   </tr>
		   <tr>
		    <td>Salário Atual: <input class="form-control" type="text" id="salario_atual" name="salario_atual" value="<?php echo "R$ ".number_format($altF->salario_atual, 2,',','.'); ?>" disabled="true" /></td>
			<td width="300">Salário Proposto: <input class="form-control" type="text" id="salario_novo" name="salario_novo" value="<?php echo "R$ ".number_format($altF->salario_novo, 2,',','.'); ?>" disabled="true" /></td>
			<td>Novo Centro de Custo: <input class="form-control" type="text" id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $altF->centro_custo_novo; ?>" disabled="true" /></td>
		   </tr>
		   <tr>
			<td colspan="3">Motivo: <br><br> 
			@if($altF->motivo == "promocao")
			<input type="checkbox" checked id="motivo" name="motivo" value="promocao" disabled="true" /> Promoção 
		    @elseif($altF->motivo == "merito")
			<input type="checkbox" checked id="motivo" name="motivo" value="merito" disabled="true" /> Mérito 
			@elseif($altF->motivo == "mudanca_setor_area")
			<input type="checkbox" checked id="motivo" name="motivo" value="mudanca_setor_area" disabled="true" /> Mudança de Setor/Área 
			@elseif($altF->motivo == "transferencia_outra_unidade")
			<input type="checkbox" checked id="motivo" name="motivo" value="transferencia_outra_unidade" disabled="true" /> Transferência para outra unidade 
			@elseif($altF->motivo == "substituicao_temporaria")
			<input type="checkbox" checked id="motivo" name="motivo" value="substituicao_temporaria" disabled="true" /> Substituição Temporária 
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
		 
		  <center>		
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="40"><strong><h5>Justificativa/Observações:</h5></strong></td>
			<td><textarea type="text" id="descricao" name="descricao" class="form-control" required rows="4" cols="60" value="<?php echo $justificativa[0]->descricao; ?>" readonly="true">{{ $justificativa[0]->descricao }}</textarea></td>
		   </tr>
		  </table>
		  </center>
		  
		  <center>	
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="100" colspan="6"><strong>Aprovações (Carimbo e Assinatura):</strong></td>
		   </tr>
		   <tr>
		    @if(!empty($data_aprovacao))
			  <td>Solicitante </td>
			  <td width="270"><?php if($solicitante == ""){ echo ""; } else { echo $solicitante; } ?></td>
			  <td><input readonly="true" type="text" id="data_aprovacao" name="data_aprovacao" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_aprovacao))); ?>" /></td>
			  <td>
			    <p align="justify"> {{ $justificativa[0]->descricao }} </p>
			  </td>
			@else
			  <td>Solicitante </td>
			  <td></td>
		      <td><input readonly="true" type="date" id="data_aprovacao" name="data_aprovacao" class="form-control" value="" /></td>	
			  <td></td>
			@endif
		   </tr> 
		   <tr>
		   @if(!empty($data_gestor_imediato))
			<td>Gestor Imediato</td> 
			<td><?php if($gestorData == ""){ echo ""; } else { echo $gestorData[0]->nome; } ?></td>
			<td><input readonly="true" type="text" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_gestor_imediato))); ?>" /></td>
		    <td> 
			@foreach($aprovacao as $ap) 
			  @if($ap->mp_id == $mps[0]->id && $gestorDataId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			</td>
		   @else
			<td>Gestor Imediato</td>
		    <td></td>
			<td><input readonly="true" type="date" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control" value="" /></td>   
		    <td>
			@if(!empty($gestorDataId))
			@foreach($aprovacao as $ap) 
			  @if($ap->mp_id == $mps[0]->id && $gestorDataId[0]->id == $ap->gestor_anterior)
				<p align="justify">{{ $ap->motivo }}</p>
			  @endif
			@endforeach
			@endif
			</td>
		   @endif	
		   </tr>
		   <tr>
		   @if(!empty($data_rec_humanos))
			<td>Rec. Humanos</td>
			<td><?php if($rh == ""){ echo ""; } else { echo $rh[0]->nome; } ?></td>
			<td><input readonly="true" type="text" id="data_rec_humanos" name="data_rec_humanos" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_rec_humanos))); ?>" /></td>
			<td> 
			@foreach($aprovacao as $ap) 
			  @if($ap->mp_id == $mps[0]->id && $rhId[0]->id == $ap->gestor_anterior)
				 <p align="justify">{{ $ap->motivo }}</p>
			  @endif
			@endforeach
			</td>
		   @else
			<td>Rec. Humanos</td>
			<td></td>
			<td><input readonly="true" type="date" id="data_rec_humanos" name="data_rec_humanos" class="form-control" value="" /></td>   
			<td>
			@if(!empty($rhId))
			@foreach($aprovacao as $ap) 
			  @if($ap->mp_id == $mps[0]->id && $rhId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			@endif
			</td>
		   @endif	
		   </tr>
		   <tr>
		   @if(!empty($data_diretoria_tecnica))
			<td>Diretoria Técnica</td>
			<td><?php if($diretoriaT == ""){ echo ""; } else { echo $diretoriaT[0]->nome; } ?></td>
			<td><input readonly="true" type="text" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_diretoria_tecnica))); ?>" /></td>
			<td>
			@foreach($aprovacao as $ap) 
			  @if($ap->mp_id == $mps[0]->id && $diretoriaTId[0]->id == $ap->gestor_anterior)
				 <p align="justify">{{ $ap->motivo }}</p>
			  @endif
			@endforeach
			</td>
		   @else
		   	<td>Diretoria Técnica</td>
		   	<td></td>
		   	<td><input readonly="true" type="date" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control" value="" /></td>   
			<td>
			@if(!empty($diretoriaTId))
			@foreach($aprovacao as $ap) 
			  @if($ap->mp_id == $mps[0]->id && $diretoriaTId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			@endif
			</td>
		   @endif	
		   </tr>
		   <tr>
		   @if(!empty($data_diretoria))
			<td>Diretoria</td>
			<td><?php if($diretoria == ""){ echo ""; } else { echo $diretoria[0]->nome; } ?></td>
			<td><input readonly="true" type="text" id="data_diretoria" name="data_diretoria" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_diretoria))); ?>" /></td>
			<td>
			@foreach($aprovacao as $ap) 
			  @if($ap->mp_id == $mps[0]->id && $diretoriaId[0]->id == $ap->gestor_anterior)
		       <p align="justify">{{ $ap->motivo }}</p>
			  @endif
			@endforeach
			</td>
		   @else
		    <td>Diretoria</td>
			<td></td>
			<td><input readonly="true" type="date" id="data_diretoria" name="data_diretoria" class="form-control" value="" /></td>   
			<td>
			@if(!empty($diretoriaId))
			@foreach($aprovacao as $ap) 
			  @if($ap->mp_id == $mps[0]->id && $diretoriaId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			@endif
			</td>
		   @endif
		   </tr>
		   <tr>
		   @if(!empty($data_superintendencia))
			<td>Superintendência</td>
			<td><?php if($super == ""){ echo "FILIPE BITU"; } else { echo "FILIPE BITU"; } ?></td>
			<td><input readonly="true" type="text" id="data_superintendencia" name="data_superintendencia" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_superintendencia))); ?>" /></td>
			<td>
			@if(!empty($superId))	
			@foreach($aprovacao as $ap) 
			  @if($ap->mp_id == $mps[0]->id && $superId[0]->id == $ap->gestor_anterior)
				 <p align="justify">{{ $ap->motivo }}</p>
			  @endif
			@endforeach
			@endif
			</td>
		   @else
		    <td>Superintendência</td>
		    <td></td>
		    <td><input readonly="true" type="date" id="data_superintendencia" name="data_superintendencia" class="form-control" value="" /></td>   
			<td>
			@if(!empty($superId))
			@foreach($aprovacao as $ap) <?php var_dump($superId[0]->id); exit(); ?>
			  @if($ap->mp_id == $mps[0]->id && $superId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			@endif
			</td>
		   @endif
		   </tr>
		   </table>
		  </center>
		  
		  <input hidden class="form-control" type="hidden" id="mp_id" name="mp_id" value="" readonly="true" />
		  
		  <center>
		  <table class="table table-bordered"  style="width: 100px;" cellspacing="0">
		   <tr>
		    <td align="center"> 
			 <a id="imprimir" name="imprimir" type="button" class="btn btn-info btn-sm" style="color: #FFFFFF;"> Imprimir <i class="fas fa-box"></i> </a>  
			</td> 
		   </tr>
		  </table>
		  </center>
		  
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td align="right"> 
			 <a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
			</td> 
		   </tr>
		  </table>
		  </center>
   </form>
</body>