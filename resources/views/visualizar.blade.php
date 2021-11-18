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
		  @if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
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
			 	 @if($gestor->id == 30)
				  <?php $dataI = date('d-m-Y', strtotime($data_rec_humanos)); ?> 
				  <?php $dataF = date('d-m-Y', strtotime('02-09-2021')); ?>
				  <?php $dataFJana = date('d-m-Y', strtotime('22-10-2021'));?>
				  <?php if(strtotime($dataI) < strtotime($dataF)){  ?>
				    <option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id ?>" title="{{ $gestor->nome }}">{{'RAFAELA CARAZZAI' }}</option>
				  <?php } else if(strtotime($dataI) < strtotime($dataFJana)) {  ?>
				    <option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id ?>" title="{{ $gestor->nome }}">{{ 'JANAINA GLAYCE PEREIRA LIMA' }}</option>
				  <?php } else {  ?>
					<option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id ?>" title="{{ $gestor->nome }}">{{ 'ANA AMÉRICA OLIVEIRA DE ARRUDA' }}</option>
				  <?php } ?>
				 @else
			      <option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id ?>" title="{{ $gestor->nome }}">{{ $gestor->nome }}</option>
				 @endif
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
			  <tr><td width="800px;" colspan="2"><center><strong><h4>Tipos de Movimentação</h4></strong></center></td></tr>
			  <tr>
			  <td width="800px;"> <center><br><b>IMPACTO FINANCEIRO:</b>
				  @if($mp->impacto_financeiro == "sim")
			   	   SIM: <input type="checkbox" id="sim_impacto" name="sim_impacto" disabled checked onclick="desabilitarTipos1('sim')" /> 
				  @elseif($mp->impacto_financeiro == "nao")
				   NÃO: <input type="checkbox" id="nao_impacto" name="nao_impacto" disabled checked onclick="desabilitarTipos1('sim')" /> 
				  @endif
			  </center></td>	  
		 	   <td>Data Prevista: <input class="form-control" type="date" id="data_prevista" name="data_prevista" value="<?php echo $mp->data_prevista; ?>" required readonly="true" title="{{ $mp->data_prevista }}" /></td>
			  </tr>	
			</table>
		  </center>
		  @endforeach

		  @if(!empty($admissaoHCP))
		  @foreach($admissaoHCP as $admHCP)
		  <?php $salarios = 0; ?> <?php $outras_verbas = 0; ?>
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		    <tr>
			 <td rowspan="7" width="150"><center><h5>Admissão HCP</h5><input type="checkbox" disabled id="tipo_mov5" name="tipo_mov5" checked /></center>
			 </td> 
			</tr>
			<tr> 
			 @foreach($admissaoSalUnd as $admSal)		
			  @if($admSal->unidade_id == 2) <?php $salarios += $admSal->salario; ?> <?php $outras_verbas += $admSal->outras_verbas; ?>
			   <td width="370">			 
			    HMR: 
				 Salário <br>
				  <input class="form-control" placeholder="Salário HMR" type="text" disabled id="salario_2" name="salario_2" value="<?php echo "R$ ".number_format($admSal->salario, 2,',','.'); ?>" />
				 Outras Verbas
				  <input class="form-control" placeholder="Outr. Verbas" type="text" disabled id="outras_verbas_2" name="outras_verbas_2" value="<?php echo "R$ ".number_format($admSal->outras_verbas, 2,',','.'); ?>" />
				 Centro de Custo: 
				  <select id="centro_custo_2" name="centro_custo_2" class="form-control" readonly>
				    <option id="centro_custo_2" name="centro_custo_2">{{ $admSal->centro_custo }}</option>
				  </select>
				 Cargo:
				  <select class="form-control" id="cargo_2" name="cargo_2" readonly>
					<option id="cargo_2" name="cargo_2">{{ $admSal->cargo }}</option>	  
				  </select>
			   </td>
			  @endif	
			  @if($admSal->unidade_id == 3)	<?php $salarios += $admSal->salario; ?> <?php $outras_verbas += $admSal->outras_verbas; ?>
			   <td width="370">
				Belo Jardim: 
				 Salário <br>
				  <input class="form-control" placeholder="Salário BELO" type="text" disabled id="salario_3" name="salario_3" value="<?php echo "R$ ".number_format($admSal->salario, 2,',','.'); ?>" />
				 Outras Verbas
				  <input class="form-control" placeholder="Outr. Verbas" type="text" disabled id="outras_verbas_3" name="outras_verbas_3" value="<?php echo "R$ ".number_format($admSal->outras_verbas, 2,',','.'); ?>" />
				 Centro de Custo: 
				  <select id="centro_custo_3" name="centro_custo_3" class="form-control" readonly>
				 	<option id="centro_custo_3" name="centro_custo_3">{{ $admSal->centro_custo }}</option>
				  </select>
				 Cargo:
				  <select class="form-control" id="cargo_3" name="cargo_3" readonly>
				 	<option id="cargo_3" name="cargo_3">{{ $admSal->cargo }}</option>	  
				  </select>
			   </td>
			  @endif	
			  @if($admSal->unidade_id == 4) <?php $salarios += $admSal->salario; ?> <?php $outras_verbas += $admSal->outras_verbas; ?>
			   <td width="370">
				Arcoverde:
				 Salário <br>
				  <input class="form-control" required placeholder="Salário ARCO" type="text" disabled id="salario_4" name="salario_4" value="<?php echo "R$ ".number_format($admSal->salario, 2,',','.'); ?>" />
				 Outras Verbas
				  <input class="form-control" required placeholder="Outr. Verbas" type="text" disabled id="outras_verbas_4" name="outras_verbas_4" value="<?php echo "R$ ".number_format($admSal->outras_verbas, 2,',','.'); ?>" />
				 Centro de Custo: 
				  <select id="centro_custo_4" name="centro_custo_4" class="form-control" readonly>
					<option id="centro_custo_4" name="centro_custo_4">{{ $admSal->centro_custo }}</option>	  
				  </select>
				 Cargo:
				  <select class="form-control" id="cargo_4" name="cargo_4" readonly>
				  	<option id="cargo_4" name="cargo_4">{{ $admSal->cargo }}</option>	
				  </select>
			   </td>
			  @endif 
			  @if($admSal->unidade_id == 5) <?php $salarios += $admSal->salario; ?> <?php $outras_verbas += $admSal->outras_verbas; ?>
			   <td width="370">
				Arruda: 
				 Salário <br>
				  <input class="form-control" required placeholder="Salário Arruda" type="text" disabled id="salario_5" name="salario_5" value="<?php echo "R$ ".number_format($admSal->salario, 2,',','.'); ?>" />
				 Outras Verbas
				  <input class="form-control" required placeholder="Outr. Verbas" type="text" disabled id="outras_verbas_5" name="outras_verbas_5" value="<?php echo "R$ ".number_format($admSal->outras_verbas, 2,',','.'); ?>" />
				 Centro de Custo: 
				  <select id="centro_custo_5" name="centro_custo_5" class="form-control" readonly>
				 	<option id="centro_custo_5" name="centro_custo_5">{{ $admSal->centro_custo }}</option>
				  </select>
				 Cargo:
				  <select class="form-control" id="cargo_5" name="cargo_5" readonly>
				   	<option id="cargo_5" name="cargo_5">{{ $admSal->cargo }}</option>	
				  </select>
			   </td>  
			  @endif
			  @if($admSal->unidade_id == 6)	<?php $salarios += $admSal->salario; ?> <?php $outras_verbas += $admSal->outras_verbas; ?>
			   <td width="370">
				Caruaru: 
				 Salário <br>
				  <input class="form-control" placeholder="Salário Caruaru" type="text" disabled id="salario_6" name="salario_6" value="<?php echo "R$ ".number_format($admSal->salario, 2,',','.'); ?>" />
				 Outras Verbas
				  <input class="form-control" placeholder="Outr. Verbas" type="text" disabled id="outras_verbas_6" name="outras_verbas_6" value="<?php echo "R$ ".number_format($admSal->outras_verbas, 2,',','.'); ?>" />
				 Centro de Custo: 
				  <select id="centro_custo_6" name="centro_custo_6" class="form-control" readonly>
				 	<option id="centro_custo_6" name="centro_custo_6">{{ $admSal->centro_custo }}</option>
				  </select>
				 Cargo:
				  <select class="form-control" id="cargo_6" name="cargo_6" readonly>
				  	<option id="cargo_6" name="cargo_6">{{ $admSal->cargo }}</option>	  
				  </select>
			   </td>  
			  @endif
			  @if($admSal->unidade_id == 7)	<?php $salarios += $admSal->salario; ?> <?php $outras_verbas += $admSal->outras_verbas; ?>
			   <td width="370">
				HSS: 
				 Salário <br>
				  <input class="form-control" placeholder="Salário HSS" type="text" disabled id="salario_7" name="salario_7" value="<?php echo "R$ ".number_format($admSal->salario, 2,',','.'); ?>" />
				 Outras Verbas
				  <input class="form-control" placeholder="Outr. Verbas" type="text" disabled id="outras_verbas_7" name="outras_verbas_7" value="<?php echo "R$ ".number_format($admSal->outras_verbas, 2,',','.'); ?>" />
				 Centro de Custo: 
				  <select id="centro_custo_7" name="centro_custo_7" class="form-control" readonly>
				  	<option id="centro_custo_7" name="centro_custo_7">{{ $admSal->centro_custo }}</option>
				  </select>
				 Cargo:
				  <select class="form-control" id="cargo_7" name="cargo_7" readonly>
				  	<option id="cargo_7" name="cargo_7">{{ $admSal->cargo }}</option>	  
				  </select>
			   </td>			
			  @endif
			@endforeach	
			</tr>
			<tr>
			 <td colspan="6"><b>Soma Total de Salários e Outras Verbas: </b>
			  <input class="form-control" style="width: 200px;" readonly="true" placeholder="ex: 2500 ou 2580,21" type="text" id="total" name="total" value="<?php echo "R$ ".number_format($salarios + $outras_verbas, 2,',','.'); ?>" />	
			 </td>	
			</tr>
			<tr>
			 <td colspan="6">Jornada:
				@if($admissaoHCP[0]->jornada == "diarista")	
			  	<input type="text" id="jornada" name="jornada" style="width: 200px;" class="form-control" readonly value="Diarista" />
				@elseif($admissaoHCP[0]->jornada == "plantao_par")	
				<input type="text" id="jornada" name="jornada" style="width: 200px;" class="form-control" readonly value="Plantão Par" />
				@elseif($admissaoHCP[0]->jornada == "plantao_impar")	
				<input type="text" id="jornada" name="jornada" style="width: 200px;" class="form-control" readonly value="Plantão Ímpar" />
				@elseif($admissaoHCP[0]->jornada == "outra")	
				<input type="text" id="jornada" name="jornada" style="width: 200px;" class="form-control" readonly value="Outra" />
				@endif
			 </td>	  
			</tr>
			<tr>
			 <td colspan="6">Tipo: <br> 
			 @if($admissaoHCP[0]->tipo == "efetivo")
			 <input checked type="checkbox" id="tipohcp_1" disabled name="tipohcp" value="efetivo" class="checkgroup" /> Efetivo 
			 @elseif($admissaoHCP[0]->tipo == "estagiario")
			 <input checked type="checkbox" id="tipohcp_2" disabled name="tipohcp" value="estagiario" class="checkgroup" /> Estagiário 
			 @elseif($admissaoHCP[0]->tipo == "temporario")
			 <input checked type="checkbox" id="tipohcp_3" disabled name="tipohcp" value="temporario" class="checkgroup" /> Temporário 
			 @elseif($admissaoHCP[0]->tipo == "aprendiz")
			 <input checked type="checkbox" id="tipohcp_4" disabled name="tipohcp" value="aprendiz" class="checkgroup" /> Aprendiz 
			 @elseif($admissaoHCP[0]->tipo == "rpa")
			 <input checked type="checkbox" id="tipohcp_5" disabled name="tipohcp" value="rpa" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input type="text" id="periodo_contratohcp" disabled name="periodo_contratohcp" style="width: 200px" value="<?php echo $admissaoHCP[0]->periodo_contrato; ?>" /> 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="6">Motivo: <br> 
			 @if($admissaoHCP[0]->motivo == "aumento_quadro")
			 <input checked type="checkbox" disabled id="motivohcp_1" name="motivohcp" value="aumento_quadro" /> Aumento de Quadro 
			 @elseif($admissaoHCP[0]->motivo == "substituicao_temporaria")
			 <input checked type="checkbox" disabled id="motivohcp_2" name="motivohcp" value="substituicao_temporaria" /> Substituição temporária 
			 @elseif($admissaoHCP[0]->motivo == "segundo_vinculo")
			 <input checked type="checkbox" disabled id="motivohcp_3" name="motivohcp" value="segundo_vinculo" /> Segundo Vínculo 
			 @elseif($admissaoHCP[0]->motivo == "substituicao_definitiva")
			 <input checked type="checkbox" disabled id="motivohcp_4" name="motivohcp" value="substituicao_definitiva" onclick="desabilitarSubst2('sim')" /> Substituição definitiva a: 
			 <input type="text" style="width: 220px;" id="motivo6hcp" name="motivo6hcp" disabled value="<?php echo $admissaoHCP[0]->motivo2; ?>" /> 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="6">Possibilidade de Contratação de Deficiente:<br> 
			 @if($admissaoHCP[0]->possibilidade_contratacao == "sim")
			 <input checked type="checkbox" disabled id="possibilidade_contratacaohcp" name="possibilidade_contratacao" value="sim" /> Sim 
			 @elseif($admissaoHCP[0]->possibilidade_contratacao == "nao")
			 <input checked type="checkbox" disabled id="possibilidade_contratacaohcp_2" name="possibilidade_contratacao" value="nao" /> Não
			 @endif
			 </td>
			</tr>
			<tr> 
			 <td colspan="6">Necessidade de conta de e-mail:<br> 
			 @if($admissaoHCP[0]->necessidade_email == "sim")
			 <input checked type="checkbox" disabled id="necessidade_emailhcp" name="necessidade_email" value="sim" /> Sim 
			 @elseif($admissaoHCP[0]->necessidade_email == "nao")
			 <input checked type="checkbox" disabled id="necessidade_email2hcp_2" name="necessidade_email" value="nao" /> Não
			 @endif
			 </td>
			</tr>
		   </table>
		  </center>

		  @endforeach
		  @endif

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
			 @if(!empty($adm))
			 <?php $q1 = $adm->gratificacoes; $r1 = "1"; $s1 = str_contains($q1, $r1); ?>
             <?php $r2 = "2"; $s2 = str_contains($q1, $r2); ?> <?php $r3 = "3"; $s3 = str_contains($q1, $r3); ?>
             <?php $r4 = "4"; $s4 = str_contains($q1, $r4); ?> <?php $r5 = "5"; $s5 = str_contains($q1, $r5); ?>
			 <?php $r6 = "0"; $s6 = str_contains($q1, $r6); ?>
             @if($s1 == true)
			  <input type='checkbox' id="g_1" name="g_1" disabled="true" checked /> GRATIFICAÇÃO <br>
			 @endif
			 @if($s2 == true)
			  <input type='checkbox' id="g_2" name="g_2" disabled="true" checked /> INSALUBRIDADE <br>
			 @endif
			 @if($s3 == true)
			  <input type='checkbox' id="g_3" name="g_3" disabled="true" checked /> PERICULOSIDADE <br>
			 @endif
			 @if($s4 == true)
			  <input type='checkbox' id="g_4" name="g_4" disabled="true" checked /> VA <br>
			 @endif
			 @if($s5 == true)
			  <input type='checkbox' id="g_5" name="g_5" disabled="true" checked /> VT <br>
			 @endif
			 @if($s6 == true)
			  <input type='checkbox' id="g_6" name="g_6" disabled="true" checked /> NENHUMA DAS RESPOSTAS
			 @endif
			 @endif
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
			 @if($adm->periodo_contrato != "")
			 <td>Período do Contrato RPA: <input class="form-control" type="text" id="periodo_contrato" name="periodo_contrato" value="<?php echo $adm->periodo_contrato; ?>" readonly="true" /></td>
			 @elseif($adm->periodo_inicio != "")
			 <td>
				Período Início RPA: <input class="form-control" type="text" id="periodo_inicio" name="periodo_inicio" value="<?php echo $adm->periodo_inicio; ?>" readonly="true" />
				Período Fim RPA: <input class="form-control" type="text" id="periodo_fim" name="periodo_fim" value="<?php echo $adm->periodo_fim; ?>" readonly="true" />
			 </td>
			 @endif
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

		 @if(!empty($plantao))
	 	  @foreach($plantao as $plantao)	 
		   <center>
			<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
			<tr>
				<td width="130" rowspan="5"><center><h5>Outros</h5></center>
				<td colspan="2">Departamento 
				<select readonly class="form-control" id="setor_plantao" name="setor_plantao">
				  <option id="setor_plantao" name="setor_plantao" value="<?php echo $plantao->setor_plantao ?>">{{ $plantao->setor_plantao }}</option>
				</select>
				</td>
				<td colspan="1">Cargo: 
				<select readonly class="form-control" id="cargo_plantao" name="cargo_plantao">
				  <option id="cargo_plantao" name="cargo_plantao" value="<?php echo $plantao->cargo_plantao; ?>">{{ $plantao->cargo_plantao }}</option>
				</select>
				</td>
			</tr>
			<tr>
				<td width="">Motivo:
				  <input readonly="true" class="form-control" style="width: 250px;" type="text" id="motivo_plantao" name="motivo_plantao" value="<?php echo $plantao->motivo_plantao; ?>" />
				</td>
				<td width="50">Substituto:
				  <input readonly="true" class="form-control" style="width: 250px;" type="text" id="substituto" name="substituto" value="<?php echo $plantao->substituto; ?>" />
				</td>
				<td>Novo Centro de Custo: 
				<select readonly required name="centro_custo_plantao" id="centro_custo_plantao" class="form-control">	
					<option id="centro_custo_plantao" name="centro_custo_plantao" value="<?php echo $plantao->centro_custo_plantao; ?>">{{ $plantao->centro_custo_plantao }}</option>
				</select>
				</td>
			</tr>
			<tr>
				<td width="50"><b>Quantidade de Plantões:</b>
				 <input readonly="true" class="form-control" style="width: 250px;" type="text" id="quantidade_plantao" name="quantidade_plantao" value="<?php echo $plantao->quantidade_plantao; ?>" />
				</td>
				<td><b>Valor do Plantão: </b>
				 <input readonly="true" class="form-control" id="valor_plantao" name="valor_plantao" value="<?php echo $plantao->valor_plantao; ?>" />
				</td>
				<td width="300"><b>Valor a ser Pago: </b>
				 <input class="form-control" readonly="true" id="valor_pago_plantao" name="valor_pago_plantao" value="<?php echo $plantao->valor_pago_plantao; ?>" />	
				</td>
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
			  <td width="150">Solicitante </td>
			  <td width="400"><?php if($solicitante == ""){ echo ""; } else { echo $solicitante; } ?></td>
			  <td width="5"><input readonly="true" type="text" id="data_aprovacao" name="data_aprovacao" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_aprovacao))); ?>" /></td>
			  <td width="400">
			    <p align="justify"> {{ $justificativa[0]->descricao }} </p>
			  </td>
			@else
			  <td style="witdh: 300px">Solicitante </td>
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
			<?php $dataI = date('d-m-Y', strtotime($data_rec_humanos)); ?> 
			<?php $dataF = date('d-m-Y', strtotime('02-09-2021')); ?>
			<?php $dataFJana = date('d-m-Y', strtotime('22-10-2021'));?>
			<?php if(strtotime($dataI) < strtotime($dataF)){  ?>
			<td><?php if($rh == ""){ echo ""; } else { echo 'RAFAELA CARAZZAI'; } ?></td>	
			<?php } else if(strtotime($dataI) < strtotime($dataFJana)) {  ?>
			<td><?php if($rh == ""){ echo ""; } else { echo 'JANAINA GLAYCE PEREIRA LIMA'; } ?></td>	
			<?php } else {  ?>
			<td><?php if($rh == ""){ echo ""; } else { echo 'ANA AMÉRICA OLIVEIRA DE ARRUDA'; } ?></td>	
			<?php } ?>
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
		   @if($mps[0]->unidade_id == 2)
		   <tr>
		   @if(!empty($data_diretoria_financeira))
			<td>Diretoria Financeira</td>
			<td><?php if($diretoriaF == ""){ echo ""; } else { echo $diretoriaF[0]->nome; } ?></td>
			<td><input readonly="true" type="text" id="data_diretoria_financeira" name="data_diretoria_financeira" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_diretoria_financeira))); ?>" /></td>
			<td>
			@foreach($aprovacao as $ap) 
			  @if($ap->mp_id == $mps[0]->id && $diretoriaFId[0]->id == $ap->gestor_anterior)
				 <p align="justify">{{ $ap->motivo }}</p>
			  @endif
			@endforeach
			</td>
		   @else
		   	<td>Diretoria Financeira</td>
		   	<td></td>
		   	<td><input readonly="true" type="date" id="data_diretoria_financeira" name="data_diretoria_financeira" class="form-control" value="" /></td>   
			<td>
			@if(!empty($diretoriaFId))
			@foreach($aprovacao as $ap) 
			  @if($ap->mp_id == $mps[0]->id && $diretoriaFId[0]->id == $ap->gestor_anterior)
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
		   @endif
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