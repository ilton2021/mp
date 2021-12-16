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
		<form action="{{route('updateMPAdmissaoHCP', array($idMP, $idA))}}" method="post">
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
			   <option id="gestor_id" name="gestor_id" value="61">{{ 'LUCIANA VENÂNCIO' }}</option>
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
		  
		  @if(!empty($admissaoHCP))
	 	  @foreach($admissaoHCP as $admHCP)	 
		   <?php $salarios = 0; ?> <?php $outras_verbas = 0; ?>
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		    <tr>
			 <td rowspan="8" width="150"><center><h5>Admissão HCP</h5><input type="checkbox" disabled id="tipo_mov5" name="tipo_mov5" checked /></center>
			 </td> 
			</tr>
			<tr> 
			 @foreach($admissaoSalUnd as $admSal)		
			  @if($admSal->unidade_id == 2) <?php $salarios += $admSal->salario; ?> <?php $outras_verbas += $admSal->outras_verbas; ?>
			   <td width="370">			 
			    HMR: <br>
				 Salário <br>
				  <input class="form-control" required placeholder="Salário HMR" type="number" step="00.01" id="salario_2" name="salario_2" value="<?php echo $admSal->salario; ?>" />
				 Outras Verbas
				  <input class="form-control" required placeholder="Outr. Verbas" type="number" step="00.01" id="outras_verbas_2" name="outras_verbas_2" value="<?php echo $admSal->outras_verbas; ?>" />
				 Centro de Custo: 
				  <select id="centro_custo_2" name="centro_custo_2" class="form-control">
				    <option id="centro_custo_2" name="centro_custo_2">{{ $admSal->centro_custo }}</option>
				  </select>
				 Cargo:
				  <select class="form-control" id="cargo_2" name="cargo_2">
					<option id="cargo_2" name="cargo_2">{{ $admSal->cargo }}</option>	  
				  </select>
			   </td>
			  @endif	
			  @if($admSal->unidade_id == 3)	<?php $salarios += $admSal->salario; ?> <?php $outras_verbas += $admSal->outras_verbas; ?>
			   <td width="370">
				Belo Jardim: <br> 
				 Salário <br>
				  <input class="form-control" required placeholder="Salário BELO" type="number" step="00.01" id="salario_3" name="salario_3" value="<?php echo $admSal->salario; ?>" />
				 Outras Verbas
				  <input class="form-control" required placeholder="Outr. Verbas" type="number" step="00.01" id="outras_verbas_3" name="outras_verbas_3" value="<?php echo $admSal->outras_verbas; ?>" />
				 Centro de Custo: 
				  <select id="centro_custo_3" name="centro_custo_3" class="form-control">
				 	<option id="centro_custo_3" name="centro_custo_3">{{ $admSal->centro_custo }}</option>
				  </select>
				 Cargo:
				  <select class="form-control" id="cargo_3" name="cargo_3">
				 	<option id="cargo_3" name="cargo_3">{{ $admSal->cargo }}</option>	  
				  </select>
			   </td>
			  @endif	
			  @if($admSal->unidade_id == 4) <?php $salarios += $admSal->salario; ?> <?php $outras_verbas += $admSal->outras_verbas; ?>
			   <td width="370">
				Arcoverde: <br>
				 Salário <br>
				  <input class="form-control" required placeholder="Salário ARCO" type="number" step="00.01" id="salario_4" name="salario_4" value="<?php echo $admSal->salario; ?>" />
				 Outras Verbas
				  <input class="form-control" required placeholder="Outr. Verbas" type="number" step="00.01" id="outras_verbas_4" name="outras_verbas_4" value="<?php echo $admSal->outras_verbas; ?>" />
				 Centro de Custo: 
				  <select id="centro_custo_4" name="centro_custo_4" class="form-control">
					<option id="centro_custo_4" name="centro_custo_4">{{ $admSal->centro_custo }}</option>	  
				  </select>
				 Cargo:
				  <select class="form-control" id="cargo_4" name="cargo_4">
				  	<option id="cargo_4" name="cargo_4">{{ $admSal->cargo }}</option>	
				  </select>
			   </td>
			  @endif 
			  @if($admSal->unidade_id == 5) <?php $salarios += $admSal->salario; ?> <?php $outras_verbas += $admSal->outras_verbas; ?>
			   <td width="370">
				Arruda: <br>
				 Salário <br>
				  <input class="form-control" required placeholder="Salário Arruda" type="number" step="00.01" id="salario_5" name="salario_5" value="<?php echo $admSal->salario; ?>" />
				 Outras Verbas
				  <input class="form-control" required placeholder="Outr. Verbas" type="number" step="00.01" id="outras_verbas_5" name="outras_verbas_5" value="<?php echo $admSal->outras_verbas; ?>" />
				 Centro de Custo: 
				  <select id="centro_custo_5" name="centro_custo_5" class="form-control">
				 	<option id="centro_custo_5" name="centro_custo_5">{{ $admSal->centro_custo }}</option>
				  </select>
				 Cargo:
				  <select class="form-control" id="cargo_5" name="cargo_5">
				   	<option id="cargo_5" name="cargo_5">{{ $admSal->cargo }}</option>	
				  </select>
			   </td>  
			  @endif
			  @if($admSal->unidade_id == 6)	<?php $salarios += $admSal->salario; ?> <?php $outras_verbas += $admSal->outras_verbas; ?>
			   <td width="370">
				Caruaru: <br>
				 Salário <br>
				  <input class="form-control" required placeholder="Salário Caruaru" type="number" step="00.01" id="salario_6" name="salario_6" value="<?php echo $admSal->salario; ?>" />
				 Outras Verbas
				  <input class="form-control" required placeholder="Outr. Verbas" type="number" step="00.01" id="outras_verbas_6" name="outras_verbas_6" value="<?php echo $admSal->outras_verbas; ?>" />
				 Centro de Custo: 
				  <select id="centro_custo_6" name="centro_custo_6" class="form-control">
				 	<option id="centro_custo_6" name="centro_custo_6">{{ $admSal->centro_custo }}</option>
				  </select>
				 Cargo:
				  <select class="form-control" id="cargo_6" name="cargo_6">
				  	<option id="cargo_6" name="cargo_6">{{ $admSal->cargo }}</option>	  
				  </select>
			   </td>  
			  @endif
			  @if($admSal->unidade_id == 7)	<?php $salarios += $admSal->salario; ?> <?php $outras_verbas += $admSal->outras_verbas; ?>
			   <td width="370">
				HSS: <br>
				 Salário <br>
				  <input class="form-control" required placeholder="Salário HSS" type="number" step="00.01" id="salario_7" name="salario_7" value="<?php echo $admSal->salario; ?>" />
				 Outras Verbas
				  <input class="form-control" required placeholder="Outr. Verbas" type="number" step="00.01" id="outras_verbas_7" name="outras_verbas_7" value="<?php echo $admSal->outras_verbas; ?>" />
				 Centro de Custo: 
				  <select id="centro_custo_7" name="centro_custo_7" class="form-control">
				  	<option id="centro_custo_7" name="centro_custo_7">{{ $admSal->centro_custo }}</option>
				  </select>
				 Cargo:
				  <select class="form-control" id="cargo_7" name="cargo_7">
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
			 <select class="form-control" id="jornadahcp" name="jornadahcp" required style="width: 200px;">
				 <option id="jornadahcp" name="jornadahcp" value="">Selecione...</option>
				 @if($admissaoHCP[0]->jornada == "diarista")
				 <option id="jornadahcp" name="jornadahcp" value="diarista" selected>Diarista</option>
				 <option id="jornadahcp" name="jornadahcp" value="plantao_par">Plantão Par</option>
				 <option id="jornadahcp" name="jornadahcp" value="plantao_impar">Plantão Ímpar</option>
				 <option id="jornadahcp" name="jornadahcp" value="outra">Outra</option>
				 @elseif($admissaoHCP[0]->jornada == "plantao_par")
				 <option id="jornadahcp" name="jornadahcp" value="diarista">Diarista</option>
				 <option id="jornadahcp" name="jornadahcp" value="plantao_par" selected>Plantão Par</option>
				 <option id="jornadahcp" name="jornadahcp" value="plantao_impar">Plantão Ímpar</option>
				 <option id="jornadahcp" name="jornadahcp" value="outra">Outra</option>
				 @elseif($admissaoHCP[0]->jornada == "plantao_impar")
				 <option id="jornadahcp" name="jornadahcp" value="diarista">Diarista</option>
				 <option id="jornadahcp" name="jornadahcp" value="plantao_par">Plantão Par</option>
				 <option id="jornadahcp" name="jornadahcp" value="plantao_impar" selected>Plantão Ímpar</option>
				 <option id="jornadahcp" name="jornadahcp" value="outra">Outra</option>
				 @elseif($admissaoHCP[0]->jornada == "outra")
				 <option id="jornadahcp" name="jornadahcp" value="diarista">Diarista</option>
				 <option id="jornadahcp" name="jornadahcp" value="plantao_par">Plantão Par</option>
				 <option id="jornadahcp" name="jornadahcp" value="plantao_impar">Plantão Ímpar</option>
				 <option id="jornadahcp" name="jornadahcp" value="outra" selected>Outra</option>
				 @endif
			   </select>
			 </td>	  
			</tr>
			<tr>
			 <td colspan="6">Tipo: <br> 
			 @if($admissaoHCP[0]->tipo == "efetivo")
			 <input checked type="checkbox" id="tipohcp" name="tipohcp" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="rpa" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input type="text" id="periodo_contratohcp" name="periodo_contratohcp" style="width: 200px" value="<?php echo $admissaoHCP[0]->periodo_contrato; ?>" /> 
			 @elseif($admissaoHCP[0]->tipo == "estagiario")
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="efetivo" class="checkgroup" /> Efetivo 
			 <input checked type="checkbox" id="tipohcp" name="tipohcp" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="rpa" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input type="text" id="periodo_contratohcp" name="periodo_contratohcp" style="width: 200px" value="<?php echo $admissaoHCP[0]->periodo_contrato; ?>" /> 
			 @elseif($admissaoHCP[0]->tipo == "temporario")
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="estagiario" class="checkgroup" /> Estagiário 
			 <input checked type="checkbox" id="tipohcp" name="tipohcp" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="rpa" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input type="text" id="periodo_contratohcp" name="periodo_contratohcp" style="width: 200px" value="<?php echo $admissaoHCP[0]->periodo_contrato; ?>" /> 
			 @elseif($admissaoHCP[0]->tipo == "aprendiz")
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="temporario" class="checkgroup" /> Temporário 
			 <input checked type="checkbox" id="tipohcp" name="tipohcp" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="rpa" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input type="text" id="periodo_contratohcp" name="periodo_contratohcp" style="width: 200px" value="<?php echo $admissaoHCP[0]->periodo_contrato; ?>" /> 
			 @elseif($admissaoHCP[0]->tipo == "rpa")
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipohcp" name="tipohcp" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input checked type="checkbox" id="tipohcp" name="tipohcp" value="rpa" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input type="text" id="periodo_contratohcp" name="periodo_contratohcp" style="width: 200px" value="<?php echo $admissaoHCP[0]->periodo_contrato; ?>" /> 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="6">Motivo: <br> 
			 @if($admissaoHCP[0]->motivo == "aumento_quadro")
			 <input checked type="checkbox" id="motivohcp" name="motivohcp" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivohcp" name="motivohcp" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivohcp" name="motivohcp" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivohcp" name="motivohcp" value="substituicao_definitiva" onclick="desabilitarSubst2('sim')" /> Substituição definitiva a: 
			 <input type="text" style="width: 200px;" id="motivo6hcp" name="motivo6hcp" value="<?php echo $admissaoHCP[0]->motivo2; ?>" /> 
			 @elseif($admissaoHCP[0]->motivo == "substituicao_temporaria")
			 <input type="checkbox" id="motivohcp" name="motivohcp" value="aumento_quadro" /> Aumento de Quadro 
			 <input checked type="checkbox" id="motivohcp" name="motivohcp" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivohcp" name="motivohcp" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivohcp" name="motivohcp" value="substituicao_definitiva" onclick="desabilitarSubst2('sim')" /> Substituição definitiva a: 
			 <input type="text" style="width: 200px;" id="motivo6hcp" name="motivo6hcp" value="<?php echo $admissaoHCP[0]->motivo2; ?>" /> 
			 @elseif($admissaoHCP[0]->motivo == "segundo_vinculo")
			 <input type="checkbox" id="motivohcp" name="motivohcp" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivohcp" name="motivohcp" value="substituicao_temporaria" /> Substituição temporária 
			 <input checked type="checkbox" id="motivohcp" name="motivohcp" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivohcp" name="motivohcp" value="substituicao_definitiva" onclick="desabilitarSubst2('sim')" /> Substituição definitiva a: 
			 <input type="text" style="width: 200px;" id="motivo6hcp" name="motivo6hcp" value="<?php echo $admissaoHCP[0]->motivo2; ?>" /> 
			 @elseif($admissaoHCP[0]->motivo == "substituicao_definitiva")
			 <input type="checkbox" id="motivohcp" name="motivohcp" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivohcp" name="motivohcp" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivohcp" name="motivohcp" value="segundo_vinculo" /> Segundo Vínculo 
			 <input checked type="checkbox" id="motivohcp" name="motivohcp" value="substituicao_definitiva" onclick="desabilitarSubst2('sim')" /> Substituição definitiva a: 
			 <input type="text" style="width: 220px;" id="motivo6hcp" name="motivo6hcp" value="<?php echo $admissaoHCP[0]->motivo2; ?>" /> 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="6">Possibilidade de Contratação de Deficiente:<br> 
			 @if($admissaoHCP[0]->possibilidade_contratacao == "sim")
			 <input checked type="checkbox" id="possibilidade_contratacaohcp" name="possibilidade_contratacao" value="sim" /> Sim 
			 <input type="checkbox" id="possibilidade_contratacaohcp_2" name="possibilidade_contratacao" value="nao" /> Não
			 @elseif($admissaoHCP[0]->possibilidade_contratacao == "nao")
			 <input type="checkbox" id="possibilidade_contratacaohcp" name="possibilidade_contratacao" value="sim" /> Sim 
			 <input checked type="checkbox" id="possibilidade_contratacaohcp_2" name="possibilidade_contratacao" value="nao" /> Não
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="6">Necessidade de conta de e-mail:<br> 
			 @if($admissaoHCP[0]->necessidade_email == "sim")
			 <input checked type="checkbox" id="necessidade_emailhcp" name="necessidade_email" value="sim" /> Sim 
			 <input type="checkbox" id="necessidade_email2hcp_2" name="necessidade_email" value="nao" /> Não
			 @elseif($admissaoHCP[0]->necessidade_email == "nao")
			 <input type="checkbox" id="necessidade_emailhcp" name="necessidade_email" value="sim" /> Sim 
			 <input checked type="checkbox" id="necessidade_email2hcp_2" name="necessidade_email" value="nao" /> Não
			 @endif
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