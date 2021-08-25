<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Movimentação de Pessoal - Alterar</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script type="text/javascript">	

    function desabilitarRPA(valor) {
		  var status = document.getElementById('periodo_contrato').disabled;
		  if (status == true) {
			document.getElementById('periodo_contrato').disabled = false;
			document.getElementById('table_gratificacao').style.display = 'block';
		  }else {
			document.getElementById('periodo_contrato').disabled = true;  
			document.getElementById('table_gratificacao').style.display = 'none';
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
		<form action="{{route('updateMPAdmissao', array($idMP, $idA))}}" method="post">
		 <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
	     <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td colspan="2"><center><strong><h3><br>Alterar - Movimentação de Pessoal</h3></strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			</tr>
			@foreach($mps as $mp)
			<tr>
			  <td width="350">Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" title="{{ $unidade[0]->id }}" readonly="true" /></td>
			  <td width="200">Local de Trabalho: <input class="form-control" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly="true" required /></td>
			  <td width="100">Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo $mp->solicitante; ?>" title="{{ $mp->solicitante }}" /></td>
			</tr>
			<tr>
			  <td>Nome: <input class="form-control" type="text" id="nome" name="nome" value="<?php echo $mp->nome; ?>" title="{{ $mp->nome }}" required maxlength="200" /></td>
			  <td>Matrícula: <input class="form-control" type="text" id="matricula" name="matricula" value="<?php echo $mp->matricula; ?>" title="{{ $mp->numeroMP }}" /></td>
			  <td>Gestor Imediato: 
			  <select id="gestor_id" name="gestor_id" class="form-control" readonly="true" disabled="true">
			   <option id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->id ?>" title="{{ $gestor[0]->nome }}">{{ $gestor[0]->nome }}</option>
			  </select>
			</tr>
			<tr>
			  <td colspan="1">Departamento: <input class="form-control" type="text" id="departamento" name="departamento" value="<?php echo $mp->departamento; ?>" title="{{ $mp->departamento }}" required /></td>
			  <td colspan="1">Número MP: <input class="form-control" type="text" id="numeroMP" name="numeroMP" value="<?php echo $mp->numeroMP; ?>" title="{{ $mp->numeroMP }}" required /></td>
			  <td>Data de Emissão: <input class="form-control" type="date" id="data_emissao" name="data_emissao" readonly="true" value="<?php echo $mp->data_emissao; ?>" title="{{ $mp->data_emissao }}" required /></td>
			</tr>
		   </table>
		  </center>
		  
		  <br>	 
		  <center>
			<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
			  <tr>
			   <td width="800px;" colspan="2"><center><strong><h4>Tipos de Movimentação</h4></strong></center></td>
		 	   <td>Data Prevista: <input class="form-control" type="date" id="data_prevista" name="data_prevista" value="<?php echo $mp->data_prevista; ?>" required title="{{ $mp->data_prevista }}" /></td>
			  </tr>	
			</table>
		  </center>
		  @endforeach
		
		 @if(!empty($admissao))
		  @foreach($admissao as $adm)	
		  <br>	 
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		    </tr>
		    <tr>
			 <td rowspan="5" width="150">
			 <center><h5>Admissão</h5> <input type="checkbox" id="tipo_mov1" name="tipo_mov1" checked readonly="true" disabled="true" /></center>
			 </td>
			 <td colspan="1" width="1050">Cargo: 
			   <input readonly="true" class="form-control" type="text" id="cargo" name="cargo" value="<?php echo $adm->cargo; ?>" />
			   <select class="form-control" id="cargo" name="cargo">
				  @if(!empty($cargos))	
					@foreach($cargos as $cargo)
						@if($cargo->nome == $adm->cargo)
						<option id="cargo" name="cargo" value="<?php echo $cargo->nome; ?>" selected>{{ $cargo->nome }}</option>	
					    @else 
						<option id="cargo" name="cargo" value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>		
						@endif
					@endforeach
				  @endif
			   </select>
			 </td>
			 <td width="370">
			 Remuneração Total: 
			 <input disabled="true" required class="form-control" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario" name="salario" value="<?php echo $adm->salario + $adm->outras_verbas; ?>" />
			 Salário: 
			 <input required class="form-control" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario" name="salario" value="<?php echo $adm->salario; ?>" />
			 Outras Verbas: 
			 <input class="form-control" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="outras_verbas" name="outras_verbas" value="<?php echo $adm->outras_verbas; ?>" />
			 @if($adm->tipo == 'rpa')
			 <?php $q1 = $adm->gratificacoes; $r1 = "1"; $s1 = str_contains($q1, $r1); ?>
             <?php $r2 = "2"; $s2 = str_contains($q1, $r2); ?> <?php $r3 = "3"; $s3 = str_contains($q1, $r3); ?>
             <?php $r4 = "4"; $s4 = str_contains($q1, $r4); ?> <?php $r5 = "5"; $s5 = str_contains($q1, $r5); ?>
			 <?php $r6 = "6"; $s6 = str_contains($q1, $r6); ?>
             <table class="table-sm" id="table_gratificacao" class="style.display = 'none'">
			 <tr><td>
			 @if($s1 == true)
			  <input type='checkbox' id="g_1" name="g_1" checked value="1" /> GRATIFICAÇÃO <br>
			 @else
			  <input type='checkbox' id="g_1" name="g_1" value="1" /> GRATIFICAÇÃO <br>
			 @endif
			 @if($s2 == true)
			  <input type='checkbox' id="g_2" name="g_2" checked value="2" /> INSALUBRIDADE <br>
			 @else
			  <input type='checkbox' id="g_2" name="g_2" value="2" /> INSALUBRIDADE <br>
			 @endif
			 @if($s3 == true)
			  <input type='checkbox' id="g_3" name="g_3" checked value="3" /> PERICULOSIDADE <br>
			 @else
			  <input type='checkbox' id="g_3" name="g_3" value="3" /> PERICULOSIDADE <br>
			 @endif
			 @if($s4 == true)
			  <input type='checkbox' id="g_4" name="g_4" checked value="4" /> VA <br>
			 @else
			  <input type='checkbox' id="g_4" name="g_4" value="4" /> VA <br>
			 @endif
			 @if($s5 == true)
			  <input type='checkbox' id="g_5" name="g_5" checked value="5" /> VT <br>
			 @else
			  <input type='checkbox' id="g_5" name="g_5" value="5" /> VT <br>
			 @endif
			 @if($s6 == true)
			  <input type='checkbox' id="g_6" name="g_6" checked value="6" title="NENHUMA DAS RESPOSTAS" /> N. D. R
			 @else
			  <input type='checkbox' id="g_6" name="g_6" value="6" title="NENHUMA DAS RESPOSTAS" /> Nenhuma Das Respostas
			 @endif
			 </td></tr>
			 </table>
			 @endif
			 </td>
			 <td width="200">Horário de Trabalho: <br>
			  <input class="form-control" readonly="true" type="text" id="horario_trabalho" name="horario_trabalho" value="<?php echo $adm->horario_trabalho; ?>" />
			  <select class="form-control" id="horario_trabalho" name="horario_trabalho">
				  @if($adm->horario_trabalho == "07:00 as 16:00")
				  <option id="horario_trabalho" name="horario_trabalho" selected value="07:00 as 16:00">07h às 16h</option>
			      <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif($adm->horario_trabalho == "08:00 as 17:00")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" selected value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif($adm->horario_trabalho == "09:00 as 19:00")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" selected value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif($adm->horario_trabalho == "19:00 as 07:00")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" selected value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @else
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @endif
			  </select>
			  Outro:
			  <input class="form-control" type="text" id="horario_trabalho2" name="horario_trabalho2" />
			 </td>
			</tr>
			<tr>
			 <td colspan="1" width="1050">Escala de Trabalho: <br><br> 
			 @if($adm->escala_trabalho == "segxsex")
			 <input type="checkbox" checked id="escala_trabalho" name="escala_trabalho" value="segxsex"  /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="12x36"  /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="12x60"  /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="outra"  /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho2" name="escala_trabalho2" value="" /> 
		     @elseif($adm->escala_trabalho == "12x36")
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex"  /> Segunda a Sexta <br>
			 <input type="checkbox" checked id="escala_trabalho" name="escala_trabalho" value="12x36"  /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="12x60"  /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="outra"  /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho2" name="escala_trabalho2" value="" /> 
			 @elseif($adm->escala_trabalho == "12x60")
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex"  /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="12x36"  /> 12x36 <br>
			 <input type="checkbox" checked id="escala_trabalho" name="escala_trabalho" value="12x60"  /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="outra"  /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho2" name="escala_trabalho2" value="" /> 
			 @elseif($adm->escala_trabalho == "outra")
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex"  /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="12x36"  /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="12x60"  /> 12x60 <br>
			 <input type="checkbox" checked id="escala_trabalho" name="escala_trabalho" value="outra"  /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho2" name="escala_trabalho2" value="" /> 
			 @endif
			 </td> 
			 <td width="370">Centro de Custo: 
			   <input class="form-control" readonly="true" type="text" id="centro_custo" name="centro_custo" value="<?php echo $adm->centro_custo; ?>" />
			   <select id="centro_custo" name="centro_custo" class="form-control">
			    @if(!empty($centro_custos))
				 @foreach($centro_custos as $c_c)
			      @if($c_c->nome == $adm->centro_custo)
				   <option id="centro_custo" name="centro_custo" selected value="<?php echo $c_c->nome; ?>">{{ $c_c->nome }}</option>
			      @else
				   <option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>">{{ $c_c->nome }}</option>	  
				  @endif
				 @endforeach
				@endif
			   </select>
			 </td>
			 <td width="450">Jornada:
			  <input readonly="true" class="form-control" type="text" id="jornada" name="jornada" value="<?php echo $adm->jornada; ?>" />
			  <select class="form-control" id="jornada" name="jornada">
				  @if($adm->jornada == "diarista")
				  <option id="jornada" name="jornada" selected value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  @elseif($adm->jornada == "plantao_par")
				  <option id="jornada" name="jornada" value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" selected value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  @elseif($adm->jornada == "plantao_impar")
				  <option id="jornada" name="jornada" value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" selected value="plantao_impar">Plantão Ímpar</option>
				  @endif
			  </select>
			 <br>Turno: <br> 
			 @if($adm->turno == "dia")
			 <input type="checkbox" checked id="turno" name="turno" value="dia"  /> Dia 
			 <input type="checkbox" id="turno" name="turno" value="noite"  /> Noite
		     @elseif($adm->turno == "noite")
			 <input type="checkbox" id="turno" name="turno" value="dia"  /> Dia 
			 <input type="checkbox" checked id="turno" name="turno" value="noite"  /> Noite
		     @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Tipo: <br> 
			 @if($adm->tipo == "efetivo")
			 <input type="checkbox" checked id="tipo" name="tipo" value="efetivo" /> Efetivo 
			 <input type="checkbox" id="tipo" name="tipo" value="estagiario"  /> Estagiário 
			 <input type="checkbox" id="tipo" name="tipo" value="temporario"  /> Temporário  
			 <input type="checkbox" id="tipo" name="tipo" value="aprendiz"  /> Aprendiz 
			 <input type="checkbox" id="tipo" name="tipo" value="rpa"  /> RPA - (Período do Contrato RPA):
			 <input type="text" id="periodo_contrato" name="periodo_contrato" value="<?php echo $adm->periodo_contrato; ?>" /></td>
		     @elseif($adm->tipo == "estagiario")
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" /> Efetivo 
			 <input type="checkbox" checked id="tipo" name="tipo" value="estagiario"  /> Estagiário 
			 <input type="checkbox" id="tipo" name="tipo" value="temporario"  /> Temporário  
			 <input type="checkbox" id="tipo" name="tipo" value="aprendiz"  /> Aprendiz 
			 <input type="checkbox" id="tipo" name="tipo" value="rpa"  /> RPA - (Período do Contrato RPA): 
			 <input type="text" id="periodo_contrato" name="periodo_contrato" value="<?php echo $adm->periodo_contrato; ?>" /></td>
		     @elseif($adm->tipo == "temporario")
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" /> Efetivo 
			 <input type="checkbox" id="tipo" name="tipo" value="estagiario"  /> Estagiário 
			 <input type="checkbox" checked id="tipo" name="tipo" value="temporario"  /> Temporário  
			 <input type="checkbox" id="tipo" name="tipo" value="aprendiz"  /> Aprendiz 
			 <input type="checkbox" id="tipo" name="tipo" value="rpa"  /> RPA - (Período do Contrato RPA):
			 <input type="text" id="periodo_contrato" name="periodo_contrato" value="<?php echo $adm->periodo_contrato; ?>" /></td>
		     @elseif($adm->tipo == "aprendiz")
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" /> Efetivo 
			 <input type="checkbox" id="tipo" name="tipo" value="estagiario"  /> Estagiário 
			 <input type="checkbox" id="tipo" name="tipo" value="temporario"  /> Temporário  
			 <input type="checkbox" checked id="tipo" name="tipo" value="aprendiz"  /> Aprendiz 
			 <input type="checkbox" id="tipo" name="tipo" value="rpa"  /> RPA - (Período do Contrato RPA):
			 <input type="text" id="periodo_contrato" name="periodo_contrato" value="<?php echo $adm->periodo_contrato; ?>" /></td>
		     @elseif($adm->tipo == "rpa")
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" /> Efetivo 
			 <input type="checkbox" id="tipo" name="tipo" value="estagiario"  /> Estagiário 
			 <input type="checkbox" id="tipo" name="tipo" value="temporario"  /> Temporário  
			 <input type="checkbox" id="tipo" name="tipo" value="aprendiz"  /> Aprendiz 
			 <input type="checkbox" checked id="tipo" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" /> RPA - (Período do Contrato RPA): 
			 <input type="text" id="periodo_contrato" name="periodo_contrato" value="<?php echo $adm->periodo_contrato; ?>" /></td>
		     @endif
			</tr>
			<tr>
			 <td colspan="3">Motivo: <br> 
			 @if($adm->motivo == "aumento_quadro")
			 <input type="checkbox" checked id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
		     <input type="checkbox" id="motivo" name="motivo" value="substituicao_definitiva" /> Substituição definitiva a: 
			 <input type="text" style="width: 220px;" id="motivo6" name="motivo6" />
			 @elseif($adm->motivo == "substituicao_temporaria")
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" checked id="motivo" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
		     <input type="checkbox" id="motivo" name="motivo" value="substituicao_definitiva" /> Substituição definitiva a: 
			 <input type="text" style="width: 220px;" id="motivo6" name="motivo6" />
			 @elseif($adm->motivo == "segundo_vinculo")
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" checked id="motivo" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
		     <input type="checkbox" id="motivo" name="motivo" value="substituicao_definitiva" /> Substituição definitiva a: 
			 <input type="text" style="width: 220px;" id="motivo6" name="motivo6" />
			 @elseif($adm->motivo == "substituicao_definitiva")
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
		     <input type="checkbox" checked id="motivo" name="motivo" value="substituicao_definitiva" /> Substituição definitiva a: 
			 <input type="text" style="width: 220px;" id="motivo2" name="motivo2" value="<?php echo $adm->motivo2; ?>" /> </td>
			 @endif
			</tr>
			<tr>
			 <td>Possibilidade de Contratação de Deficiente:<br> 
			 @if($adm->possibilidade_contratacao == 'sim') 
			  <input type="checkbox" readonly="true" checked id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" /> Sim
			  <input type="checkbox" readonly="true" id="possibilidade_contratacao" name="possibilidade_contratacao" value="nao" /> Não
			 @else
			  <input type="checkbox" readonly="true" id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" /> Sim
			  <input type="checkbox" readonly="true" checked id="possibilidade_contratacao" name="possibilidade_contratacao" value="nao" /> Não
			 @endif 
			 </td>
			 <td colspan="2">Necessidade de conta de e-mail:<br> 
			 @if($adm->necessidade_email == "sim")
			 <input type="checkbox" checked id="necessidade_email" name="necessidade_email" value="sim" /> Sim 
		     <input type="checkbox" id="necessidade_email" name="necessidade_email" value="nao" /> Não</td>
			 @else
			 <input type="checkbox" id="necessidade_email" name="necessidade_email" value="sim" /> Sim 
			 <input type="checkbox" checked id="necessidade_email" name="necessidade_email" value="nao" /> Não</td>
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
			<td><textarea required type="text" id="descricao" name="descricao" class="form-control" rows="10" cols="60"> {{ $justificativa[0]->descricao }} </textarea></td>
		   </tr>
		  </table>
		  </center>
		 
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
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