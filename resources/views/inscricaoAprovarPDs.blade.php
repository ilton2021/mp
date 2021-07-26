<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Programa Degrau - Validação</title>
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
	  <form action="{{\Request::route('storeInscricaoPD', $pd[0]->id)}}" method="post">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td colspan="2"><center><strong><h3><br>Programa Degrau - INSCRIÇÃO</h3></strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			  <td hidden><input hidden class="form-control" type="text" id="concluida" name="concluida" value="0" readonly="true" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="aprovada" name="aprovada" value="0" readonly="true" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="vaga_interna_id" name="vaga_interna_id" value="" readonly="true" /></td>
			</tr>
			<tr>
			  <td width="400px">Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
			  <td>Local de Trabalho:
			    <input type="text" readonly="true" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome; ?>" class="form-control"></option>
			  </td>
			  <td hidden>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo Auth::user()->id; ?>" /></td>
			  @foreach($gestores as $gestor)
			   @if($gestor->id == $inscricao[0]->solicitante)
			    <td>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante_" name="solicitante_" required value="<?php echo $gestor->nome; ?>" /></td>
			   @endif
			  @endforeach	
			</tr>
			<tr>
			  <td colspan="1">Vaga: <input class="form-control" type="text" id="vaga" name="vaga" readonly="true" value="<?php echo $pd[0]->vaga; ?>" /></td>
			  <td>Código da Vaga: <input class="form-control" type="text" id="codigo_vaga" name="codigo_vaga" value="<?php echo $pd[0]->codigo_vaga; ?>" readonly="true" /> </td>
			  <td hidden><input readonly="true" class="form-control" type="text" id="gestor_id" name="gestor_id" required value="73" /></td>
			  <td>Gestor Imediato: <input readonly="true" class="form-control" type="text" id="gestor" name="gestor" required value="CAMILA FERNANDES" /></td>
			</tr>
			<tr>
			  <td>Departamento Atual: 
			    <input type="text" class="form-control" id="departamento" name="departamento" value="<?php echo $pd[0]->departamento; ?>" readonly="true">
			  </td>
			  <td>Data de Emissão da Vaga: <input class="form-control" type="text" id="data_emissao" name="data_emissao" value="<?php echo date('d-m-Y', strtotime('now')); ?>" readonly="true" /></td>
			  <td>Data Prevista: <input class="form-control" type="text" id="data_prevista" name="data_prevista" readonly="true" value="<?php echo date('d-m-Y', strtotime($pd[0]->data_prevista)); ?>" /></td>
			</tr>
		   </table>
		  </center>
					  
		  <br>
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspancing="0">
			<tr>
			  <td colspan="2"> <b>Funcionário:</b> </td>
			</tr>
			<tr>
			  <td style="width: 800px;"> Nome: </td>
			  <td> Matrícula: </td>
			</tr>
			<tr>
			  <td> <input readonly="true" type="text" name="nome_funcionario" id="nome_funcionario" class="form-control" value="<?php echo $inscricao[0]->nome_funcionario; ?>" /> </td>
			  <td> <input readonly="true" type="text" name="matricula_funcionario" id="matricula_funcionario" class="form-control" value="<?php echo $inscricao[0]->matricula_funcionario; ?>" /> </td>
			</tr>
		  </table>	
		  </center>

		  <br>
			
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		    </tr>
		    <tr>
			 <td rowspan="5" width="150"><center><h5><b>Abertura de Vaga</b></h5> </center></td>
			 <td colspan="1" width="1050">Cargo: 
			    <select class="form-control" id="cargo" name="cargo" readonly="true">
				  <option id="cargo" name="cargo" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargo)
				      @if($pd[0]->cargo == $cargo->nome)
						<option id="cargo" name="cargo" value="{{ $cargo->nome }}" selected>{{ $cargo->nome }}</option>	
					  @else
						<option id="cargo" name="cargo" value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>	
					  @endif
					@endforeach
				  @endif
				</select>
			 </td>
			 <td width="370">Salário: <input class="form-control" type="number" readonly="true" id="salario" name="salario" value="<?php echo $pd[0]->salario; ?>" title="ex: 2500 ou 2580,21" /></td>
			 <td width="200">Horário de Trabalho: <br>
			    <select class="form-control" id="horario_trabalho" name="horario_trabalho" readonly="true">
				  @if($pd[0]->horario_trabalho == '07:00 as 16:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00" selected>07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif($pd[0]->horario_trabalho == '08:00 as 17:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00" selected>08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif($pd[0]->horario_trabalho == '09:00 as 19:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00" selected>09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif($pd[0]->horario_trabalho == '19:00 as 07:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00" selected>19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @else
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00" selected>19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0" selected>Outro...</option>	  
				  Outro:
				  <input class="form-control" readonly="true" type="text" id="horario_trabalho2" name="horario_trabalho2" value="<?php echo $pd[0]->horario_trabalho; ?>" />
				  @endif
				</select>
				
			 </td>
			</tr>
			<tr>
			 <td colspan="1" width="1050">Escala de Trabalho: <br><br> 
			 @if($pd[0]->escala_trabalho == 'segxsex')
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" checked disabled="true" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" disabled="true" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" disabled="true" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" disabled="true" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $pd[0]->escala_trabalho6; ?>" /> 
			 @elseif($pd[0]->escala_trabalho == '12x36')
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" disabled="true" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" checked disabled="true" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" disabled="true" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" disabled="true" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $pd[0]->escala_trabalho6; ?>" /> 
			 @elseif($pd[0]->escala_trabalho == '12x60')
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" disabled="true" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" disabled="true" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" checked disabled="true" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" disabled="true" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $pd[0]->escala_trabalho6; ?>" /> 
			 @else
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" disabled="true" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" disabled="true" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" disabled="true" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" disabled="true" checked readonly="true"  onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $pd[0]->escala_trabalho; ?>" /> 
			 @endif
			 </td> 
			 <td width="370">Centro de Custo: 
			 <select id="centro_custo"  name="centro_custo" class="form-control" disabled="true">
			    <option id="centro_custo" name="centro_custo" value="">Selecione...</option>
			    @if(!empty($centro_custos))
				 @foreach($centro_custos as $c_c)
				  @if($pd[0]->centro_custo == $c_c->nome)
				   <option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>" selected>{{ $c_c->nome }}</option>
				  @else
				   <option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>">{{ $c_c->nome }}</option>	  
				  @endif
				 @endforeach
				@endif
			   </select>
			   </td>
			 <td width="450">Jornada:
			    <select class="form-control" id="jornada" name="jornada" disabled="true">
				  @if($pd[0]->jornada == 'diarista')
				   <option id="jornada" name="jornada" value="diarista" selected>Diarista</option>
				   <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				   <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  @elseif($pd[0]->jornada == 'plantao_par')
				   <option id="jornada" name="jornada" value="diarista">Diarista</option>
				   <option id="jornada" name="jornada" value="plantao_par" selected>Plantão Par</option>
				   <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  @elseif($pd[0]->jornada == 'plantao_impar')
				   <option id="jornada" name="jornada" value="diarista">Diarista</option>
				   <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				   <option id="jornada" name="jornada" value="plantao_impar" selected>Plantão Ímpar</option>
				  @endif
				</select>
			 
			 <br>Turno: <br> 
			 @if($pd[0]->turno == "dia")
			 <input type="checkbox" id="turno" name="turno" value="dia" checked disabled="true" /> Dia 
			 <input type="checkbox" id="turno2" name="turno" value="noite" disabled="true" /> Noite
			 @elseif($pd[0]->turno == "noite")
			 <input type="checkbox" id="turno" name="turno" value="dia" disabled="true" /> Dia 
			 <input type="checkbox" id="turno2" name="turno" value="noite" checked disabled="true" /> Noite
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Tipo: <br> 
			 @if($pd[0]->tipo == 'efetivo')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" checked disabled="true" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" disabled="true" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" disabled="true" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" disabled="true" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" disabled="true" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="{{ old('periodo_contrato') }}" /> 		
			 @elseif($pd[0]->tipo == 'estagiario')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" disabled="true" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" checked  disabled="true" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" disabled="true" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" disabled="true" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" disabled="true" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="{{ old('periodo_contrato') }}" /> 		
			 @elseif($pd[0]->tipo == 'temporario')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" disabled="true" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" disabled="true" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" checked disabled="true" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" disabled="true" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" disabled="true" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="{{ old('periodo_contrato') }}" /> 		
			 @elseif($pd[0]->tipo == 'aprendiz')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" disabled="true" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" disabled="true" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" disabled="true" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" disabled="true" checked /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" disabled="true" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="{{ old('periodo_contrato') }}" /> 		
			 @elseif($pd[0]->tipo == 'rpa')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" disabled="true" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" disabled="true" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" disabled="true" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" disabled="true" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" disabled="true" class="checkgroup" checked /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="<?php echo $pd[0]->periodo_contrato; ?>" /> 		
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Motivo: <br> 
			 @if($pd[0]->motivo == 'aumento_quadro')
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" checked disabled="true" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" disabled="true" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" disabled="true" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" disabled="true" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" value="{{ old('motivo6') }}" /> 
			 @elseif($pd[0]->motivo == 'substituicao_temporaria')
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" disabled="true" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" checked disabled="true" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" disabled="true" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" disabled="true" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" value="{{ old('motivo6') }}" /> 
			 @elseif($pd[0]->motivo == 'segundo_vinculo')
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" disabled="true" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" disabled="true" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" checked disabled="true" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" disabled="true" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" value="{{ old('motivo6') }}" /> 
			 @else
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" disabled="true" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" disabled="true" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" disabled="true" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" disabled="true" checked onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" value="<?php echo $pd[0]->motivo2; ?>" /> 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td>Possibilidade de Contratação de Deficiente:<br> 
			 @if($pd[0]->contratacao_deficiente == "sim")
			 <input type="checkbox" id="contratacao_deficiente" name="contratacao_deficiente" value="sim" checked disabled="true" /> Sim 
			 <input type="checkbox" id="contratacao_deficiente2" name="contratacao_deficiente" value="nao" disabled="true" /> Não
			 @elseif($pd[0]->contratacao_deficiente == "nao")
			 <input type="checkbox" id="contratacao_deficiente" name="contratacao_deficiente" value="sim" disabled="true" /> Sim 
			 <input type="checkbox" id="contratacao_deficiente2" name="contratacao_deficiente" value="nao" checked disabled="true" /> Não
			 @endif
			 </td>
			 <td colspan="2">Necessidade de conta de e-mail:<br> 
			 @if($pd[0]->email == "sim")
			 <input type="checkbox" id="email" name="email" value="sim" checked disabled="true" /> Sim 
			 <input type="checkbox" id="email2" name="email" value="nao" disabled="true" /> Não
			 @elseif($pd[0]->email == "nao")
			 <input type="checkbox" id="email" name="email" value="sim" disabled="true" /> Sim 
			 <input type="checkbox" id="email2" name="email" value="nao" checked disabled="true" /> Não
			 @endif
			 </td>
			</tr>
		   </table>
		  </center>
			 
		  <br>
			
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="135" rowspan="2"><center><h5><b>Perfil Comportamental</b></h5> </center></td>
			<td colspan="1">Comportamental cadastradas: 
			<br><br> 
			@foreach($comportamental as $comp)
			@if($comp->descricao == "percepcao_visao")
			<input type="checkbox" disabled="true" id="comportamental1" name="comportamental1" value="percepcao_visao" checked /> Percepção e Visão
		    @endif
			@if($comp->descricao == "inovacao")
			<input type="checkbox" disabled="true" id="comportamental2" name="comportamental2" value="inovacao" checked /> Inovação
			@endif
			@if($comp->descricao == "espirito_equipe")
			<input type="checkbox" disabled="true" id="comportamental3" name="comportamental3" value="espirito_equipe" checked /> Espírito de Equipe
			@endif
			@if($comp->descricao == "observacao_analise")
			<input type="checkbox" disabled="true" id="comportamental4" name="comportamental4" value="observacao_analise" checked /> Observação e Análise
			@endif
			@if($comp->descricao == "relacionamento")
			<input type="checkbox" disabled="true" id="comportamental5" name="comportamental5" value="relacionamento" checked /> Relacionamento
			@endif
			@if($comp->descricao == "senso_urgencia")
			<input type="checkbox" disabled="true" id="comportamental6" name="comportamental6" value="senso_urgencia" checked /> Senso de Urgência  
			@endif
			@if($comp->descricao == "lideranca")
			<input type="checkbox" disabled="true" id="comportamental7" name="comportamental7" value="lideranca" checked /> Liderança
			@endif
			@if($comp->descricao == "dinamismo_execucao")
			<input type="checkbox" disabled="true" id="comportamental8" name="comportamental8" value="dinamismo_execucao" checked /> Dinamismo e Execução
			@endif
			@if($comp->descricao == "outros")
			<input type="checkbox" disabled="true" id="comportamental9" name="comportamental9" value="outros" onclick="desabilitarPerfil('sim')" checked /> Outros
		    @endif
			@if($comp->descricao == "foco_versatilidade")
			<input type="checkbox" disabled="true" id="comportamental10" name="comportamental10" value="foco_versatilidade" checked /> Foco e Versatilidade
		    @endif
			@if($comp->descricao == "disseminacao_conhecimento")
			<input type="checkbox" disabled="true" id="comportamental11" name="comportamental11" value="disseminacao_conhecimento" checked /> Disseminação do Conhecimento
		    @endif
		    @endforeach
			<td>
		   </tr>
		   <tr>
		   <td>
		   Apresentação de Outros Perfis: <br> 
		     @foreach($comportamental as $cp)
			  @if($cp->outros != "")
			   <textarea type="text" disabled="true" id="perfil" name="perfil" class="form-control" required="true" rows="8" cols="40" value=""><?php if(!empty($cp)){echo $cp->outros;}else{echo "";} ?></textarea>
			  @endif
			 @endforeach
		   </td>
		   </tr>
		  </table>
		  </center>
				
		  <br>
		  	
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="135" rowspan="5"><center><h5><b>Perfil Técnico</b></h5> </center></td>
			<td width="500">Descreva no mínimo 03 conhecimentos técnicos <b>Necessários</b> para assumir a vaga: 
			<textarea disabled="true" type="text" id="conhecimento_tecnico" name="conhecimento_tecnico" class="form-control" required="true" rows="5" cols="60" value=""><?php echo $pd[0]->conhecimento_tecnico; ?></textarea>  
			<td width="500">Descreva no mínimo 03 conhecimentos técnicos <b>Desejados</b> para assumir a vaga: 
			<textarea disabled="true" type="text" id="conhecimento_desejado" name="conhecimento_desejado" class="form-control" required="true" rows="5" cols="60" value=""><?php echo $pd[0]->conhecimento_desejado; ?></textarea></td>   
			</tr>
		   <tr>
		    <td colspan="1">Formação Acadêmica: </td>
			<td colspan="1">Idiomas: </td>
		   </tr>
		   <tr>
			<td><textarea disabled="true" type="text" id="formacao" name="formacao" class="form-control" required="true" rows="5" cols="60" value=""><?php echo $pd[0]->formacao; ?></textarea></td>     
			<td><textarea disabled="true" type="text" id="idiomas" name="idiomas" class="form-control" required="true" rows="5" cols="60" value=""><?php echo $pd[0]->idiomas; ?></textarea></td>     
		   </tr>
		   <tr>
		   <td colspan="2">Competências  cadastradas: <br><br>
		   @if(!empty($competencias))
		   @foreach($competencias as $comp)
			@if($comp->descricao == "conhecimento_windows")
			<input type="checkbox" disabled="true" id="motivoA1" name="motivoA1" value="conhecimento_windows" checked /> Conhecimentos em Windows
			@endif
			@if($comp->descricao == "pacote_office")
			<input type="checkbox" disabled="true" id="motivoA2" name="motivoA2" value="pacote_office" checked /> Conhecimentos em Windows
			@endif
			@if($comp->descricao == "certificacao_especifica")
			<input type="checkbox" disabled="true" id="motivoA3" name="motivoA3" value="certificacao_especifica" checked /> Certificação Específica	
			@endif
			@if($comp->descricao == "curso_atualizacao")
			<input type="checkbox" disabled="true" id="motivoA7" name="motivoA7" value="curso_atualizacao" checked /> Curso de Atualização da Área	
			@endif
			@if($comp->descricao == "excel_basico")
			<input type="checkbox" disabled="true" id="motivoA4" name="motivoA4" value="excel_basico" checked /> Excel Básico	
			@endif
			@if($comp->descricao == "outros")
			<input type="checkbox" disabled="true" id="motivoB9" name="motivoB9" value="outros" onclick="desabilitarMotivo('sim')" checked /> Outros 	
			@endif
			@if($comp->descricao == "excel_intermediario")
			<input type="checkbox" disabled="true" id="motivoA5" name="motivoA5" value="excel_intermediario" checked  /> Excel Intermediário   	
			@endif
			@if($comp->descricao == "excel_avancado")
			<input type="checkbox" disabled="true" id="motivoA6" name="motivoA6" value="excel_avancado" checked /> Excel Avançado
			@endif
			@if($comp->descricao == "ferramentas_gestao")
			<input type="checkbox" disabled="true" id="motivoA8" name="motivoA8" value="ferramentas_gestao" checked /> Ferramentas de Gestão (PDCA/5S/MÉTODOS ÁGEIS)	
			@endif
		   @endforeach
		   @endif
		   </td>
		   </tr>
		   <tr>
			<td colspan="2"> Apresentação de Outras Competências: <br><br> 
			@foreach($competencias as $cp)
			 @if($cp->outros != "")
			  <textarea disabled="true" required type="text" id="outras_competencias" name="outras_competencias" class="form-control" required="true" rows="5" cols="20"><?php echo $cp->outros; ?></textarea></td>	
			 @endif
			@endforeach 
			</td>
		   </tr>
		  </table>
		  </center>

		  <br>
		  <center>		
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="40"><strong><h5>Justificativa/Observações:</h5></strong></td>
			<td><textarea type="text" id="descricao" name="descricao" class="form-control" required rows="10" cols="60" value="<?php echo $just_v[0]->descricao; ?>" readonly="true">{{ $just_v[0]->descricao }}</textarea></td>
		   </tr>
		  </table>
		  </center>

		  

		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td align="right"> 
			 <a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
			 <a href="{{ route('reprovarInscricao', array($inscricao[0]->id, $inscricao[0]->vaga_interna_id)) }}" type="button" class="btn btn-danger btn-sm" > REPROVAR <i class="fas fa-times-circle"></i> </a>
			 <a href="{{ route('aprovarInscricao', array($inscricao[0]->id, $inscricao[0]->vaga_interna_id)) }}" type="button" class="btn btn-success btn-sm" > APROVAR <i class="fas fa-check"></i> </a>			
			</td>
		   </tr>
		  </table>
		  </center>
</body>