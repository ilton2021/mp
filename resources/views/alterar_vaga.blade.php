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
	<script type="text/javascript">
		function desabilitarOutra(valor) {
		  var status = document.getElementById('escala_trabalho4').checked;
		  
		  if (status == true) {
			document.getElementById('escala_trabalho6').disabled = false;
		  } else {
			document.getElementById('escala_trabalho6').disabled = true;  
		  }
		}
		
		function desabilitarRPA(valor){
		  var status = document.getElementById('tipo5').checked;
		  
		  if(status == true) {
			document.getElementById('periodo_contrato').disabled = false;  
		  } else {
            document.getElementById('periodo_contrato').disabled = true;  
		  }		  
		}
		
		function desabilitarSubst(valor){
		  var status = document.getElementById('motivoB4').checked;	
			
		  if(status == true){
			document.getElementById('motivo6').disabled = false;
		  } else {
		    document.getElementById('motivo6').disabled = true;
		  }			  
		}
	
		function desabilitarPerfil(valor){
		  var status = document.getElementById('comportamentalB9').checked;	
			
		  if(status == true){
			document.getElementById('perfil').disabled = false;  
		  } else {
			document.getElementById('perfil').disabled = true;  
		  }
		}
		
		function desabilitarMotivo(valor){
		  var status = document.getElementById('motivoB9').checked;	
			
		  if(status == true){
			document.getElementById('outras_competencias').disabled = false;  
		  } else {
			document.getElementById('outras_competencias').disabled = true;  
		  }
		}
		
		function desabilitarSubst(valor){
		  var status = document.getElementById('motivo4').checked;

		  if(status == true){
			 document.getElementById('motivo6').disabled = false; 
		  } else {
			 document.getElementById('motivo6').disabled = true;
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
	  <form action="{{\Request::route('updateVaga'), $unidade[0]->id}}" method="POST">             
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td colspan="2"><center><strong><h3>Editar - Abertura de Vaga</h3></strong></center></td>
			  <td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			</tr>
			@foreach($vagas as $vaga)
			<tr>
			  <td width="340px" hidden>Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
			  <td width="340px">Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
			  <td>Local de Trabalho:
			  <select class="form-control" id="local_trabalho" name="local_trabalho" disabled="true">
			     <option id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->id ?>">{{ $unidade[0]->nome }}</option>
			  </select>
			  </td>
			  <td>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo $vaga->solicitante; ?>" /></td>
			</tr>
			<tr>
			  <td colspan="1">Vaga: <input class="form-control" type="text" id="vaga" name="vaga" required="true" value="<?php echo $vaga->vaga; ?>" /></td>
			  <td> Código da Vaga: <input class="form-control" type="text" id="codigo_vaga" name="codigo_vaga" value="<?php echo $vaga->codigo_vaga; ?>" /> </td>
			  <td>Gestor Imediato: 
			  <select id="gestor_id" name="gestor_id" class="form-control" disabled="true">
			  @if($vaga->tipo_vaga == 0)
			   @if(Auth::user()->name == $vaga->solicitante)
				<option id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->id ?>" title="{{ $gestor[0]->nome }}">{{ $gestor[0]->nome }}</option>  
				<?php $gId = $gestor[0]->id; ?>
			   @else
				  @if(!empty($gestores))
				   @foreach($gestores as $gestor)
					@if($vaga->gestor_id == $gestor->id)
					  <option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id ?>" title="{{ $gestor->nome }}">{{ $gestor->nome }}</option>
					  <?php $gId = 0; ?>
					@endif
				   @endforeach
				  @else
				  <option id="gestor_id" name="gestor_id" value="2">{{ 'JANAINA GLAYCE PEREIRA LIMA' }}</option>
				  <?php $gId = 0; ?>
				  @endif
			   @endif
			  @endif
			  </select>
			</tr>
			<tr>
			  <td>Área: <input class="form-control" type="text" id="area" name="area" value="<?php echo $vaga->area; ?>" required /></td>
			  <td>Vaga disponível em Edital: <br>  
			    <select class="form-control" id="edital_disponivel" name="edital_disponivel" required="true">
				 	@if($vaga->edital_disponivel == 'Sim')
					<option id="edital_disponivel" name="edital_disponivel" value="Sim" selected> {{ 'Sim' }} </option>
				    <option id="edital_disponivel" name="edital_disponivel" value="Não"> {{ 'Não' }}</option>
					@elseif($vaga->edital_disponivel == 'Não')
					<option id="edital_disponivel" name="edital_disponivel" value="Sim"> {{ 'Sim' }} </option>
					<option id="edital_disponivel" name="edital_disponivel" value="Não" selected> {{ 'Não' }}</option>
					@endif
				</select>
			  </td>
			  <td>Número da Vaga: <br>
				<input type="text" readonly="true" class="form-control" id="numeroVaga" name="numeroVaga" value="<?php echo $vaga->numeroVaga; ?>" />	  
			  </td>
			</tr>
		   </table>
		  </center>
		  
		  <br>	 
		  <center>
			<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
			  <tr>
			   <td width="600px;" colspan="2"><center><strong><h4>Preenchimento da Área</h4></strong></center></td>
		 	   <td>Data de Emissão: <input class="form-control" type="date" id="data_emissao" name="data_emissao" readonly="true" value="<?php echo $vaga->data_emissao; ?>" /></td> 
			   <td>Data Prevista: <input class="form-control" type="date" id="data_prevista" name="data_prevista" required value="<?php echo $vaga->data_prevista; ?>" /></td>
			  </tr>	
			</table>
		  </center>

		  <br>	 
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		    </tr>
		    <tr>
			 <td rowspan="5" width="150"><center><h5><b>Abertura e/ou Promoção</b></h5> </center></td>
			 <td colspan="1" width="1050">Cargo: 
			    <select class="form-control" id="cargo" name="cargo" required="true">
				  <option id="cargo" name="cargo" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargo)
				      @if($vaga->cargo == $cargo->nome)
						<option id="cargo" name="cargo" value="{{ $cargo->nome }}" selected>{{ $cargo->nome }}</option>	
					  @else
						<option id="cargo" name="cargo" value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>	
					  @endif
					@endforeach
				  @endif
				</select>
			 </td>
			 <td width="370">Salário: <input class="form-control" type="number" required="true" id="salario" name="salario" value="<?php echo $vaga->salario; ?>" title="ex: 2500 ou 2580,21" /></td>
			 <td width="200">Horário de Trabalho: <br>
			    <select class="form-control" id="horario_trabalho" name="horario_trabalho" required="true">
				  @if($vaga->horario_trabalho == '07:00 as 16:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00" selected>07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif($vaga->horario_trabalho == '08:00 as 17:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00" selected>08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif($vaga->horario_trabalho == '09:00 as 19:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00" selected>09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif($vaga->horario_trabalho == '19:00 as 07:00')
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
				  <input class="form-control" type="text" id="horario_trabalho2" name="horario_trabalho2" value="<?php echo $vaga->horario_trabalho; ?>" />
				  @endif
				</select>
				
			 </td>
			</tr>
			<tr>
			 <td colspan="1" width="1050">Escala de Trabalho: <br><br> 
			 @if($vaga->escala_trabalho == 'segxsex')
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" checked /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $vaga->escala_trabalho6; ?>" /> 
			 @elseif($vaga->escala_trabalho == '12x36')
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" checked /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $vaga->escala_trabalho6; ?>" /> 
			 @elseif($vaga->escala_trabalho == '12x60')
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" checked /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $vaga->escala_trabalho6; ?>" /> 
			 @else
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" checked  onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $vaga->escala_trabalho; ?>" /> 
			 @endif
			 </td> 
			 <td width="370">Centro de Custo: 
			 <select id="centro_custo"  name="centro_custo" class="form-control" required>
			    <option id="centro_custo" name="centro_custo" value="">Selecione...</option>
			    @if(!empty($centro_custos))
				 @foreach($centro_custos as $c_c)
				  @if($vaga->centro_custo == $c_c->nome)
				   <option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>" selected>{{ $c_c->nome }}</option>
				  @else
				   <option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>">{{ $c_c->nome }}</option>	  
				  @endif
				 @endforeach
				@endif
			   </select>
			   </td>
			 <td width="450">Jornada:
			    <select class="form-control" id="jornada" name="jornada" required>
				  @if($vaga->jornada == 'diarista')
				   <option id="jornada" name="jornada" value="diarista" selected>Diarista</option>
				   <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				   <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  @elseif($vaga->jornada == 'plantao_par')
				   <option id="jornada" name="jornada" value="diarista">Diarista</option>
				   <option id="jornada" name="jornada" value="plantao_par" selected>Plantão Par</option>
				   <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  @elseif($vaga->jornada == 'plantao_impar')
				   <option id="jornada" name="jornada" value="diarista">Diarista</option>
				   <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				   <option id="jornada" name="jornada" value="plantao_impar" selected>Plantão Ímpar</option>
				  @endif
				</select>
			 
			 <br>Turno: <br> 
			 @if($vaga->turno == "dia")
			 <input type="checkbox" id="turno" name="turno" value="dia" checked /> Dia 
			 <input type="checkbox" id="turno2" name="turno" value="noite" /> Noite
			 @elseif($vaga->turno == "noite")
			 <input type="checkbox" id="turno" name="turno" value="dia" /> Dia 
			 <input type="checkbox" id="turno2" name="turno" value="noite" checked /> Noite
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Tipo: <br> 
			 @if($vaga->tipo == 'efetivo')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" checked /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="{{ old('periodo_contrato') }}" /> 		
			 @elseif($vaga->tipo == 'estagiario')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" checked /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="{{ old('periodo_contrato') }}" /> 		
			 @elseif($vaga->tipo == 'temporario')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" checked /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="{{ old('periodo_contrato') }}" /> 		
			 @elseif($vaga->tipo == 'aprendiz')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" checked /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="{{ old('periodo_contrato') }}" /> 		
			 @elseif($vaga->tipo == 'rpa')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" checked /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="<?php echo $vaga->periodo_contrato; ?>" /> 		
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Motivo: <br> 
			 @if($vaga->motivo == 'aumento_quadro')
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" checked /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" value="{{ old('motivo6') }}" /> 
			 @elseif($vaga->motivo == 'substituicao_temporaria')
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" checked /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" value="{{ old('motivo6') }}" /> 
			 @elseif($vaga->motivo == 'segundo_vinculo')
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" checked /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" value="{{ old('motivo6') }}" /> 
			 @else
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" checked onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" value="<?php echo $vaga->motivo2; ?>" /> 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td>Possibilidade de Contratação de Deficiente:<br> 
			 @if($vaga->contratacao_deficiente == "sim")
			 <input type="checkbox" id="contratacao_deficiente" name="contratacao_deficiente" value="sim" checked /> Sim 
			 <input type="checkbox" id="contratacao_deficiente2" name="contratacao_deficiente" value="nao" /> Não
			 @elseif($vaga->contratacao_deficiente == "nao")
			 <input type="checkbox" id="contratacao_deficiente" name="contratacao_deficiente" value="sim" /> Sim 
			 <input type="checkbox" id="contratacao_deficiente2" name="contratacao_deficiente" value="nao" checked /> Não
			 @endif
			 </td>
			 <td colspan="2">Necessidade de conta de e-mail:<br> 
			 @if($vaga->email == "sim")
			 <input type="checkbox" id="email" name="email" value="sim" checked /> Sim 
			 <input type="checkbox" id="email2" name="email" value="nao" /> Não
			 @elseif($vaga->email == "nao")
			 <input type="checkbox" id="email" name="email" value="sim" /> Sim 
			 <input type="checkbox" id="email2" name="email" value="nao" checked /> Não
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
			<td colspan="1">Comportamental cadastradas (Para Alterar Selecione Novamente): 
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
		   <input type="checkbox" id="comportamentalB1" name="comportamentalB1" value="percepcao_visao" /> Percepção e Visão &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		   <input type="checkbox" id="comportamentalB2" name="comportamentalB2" value="inovacao" /> Inovação &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   <input type="checkbox" id="comportamentalB3" name="comportamentalB3" value="espirito_equipe" /> Espírito de Equipe
		   <br><input type="checkbox" id="comportamentalB4" name="comportamentalB4" value="observacao_analise" /> Observação e Análise &nbsp;&nbsp;&nbsp;
		   <input type="checkbox" id="comportamentalB5" name="comportamentalB5" value="relacionamento" /> Relacionamento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   <input type="checkbox" id="comportamentalB6" name="comportamentalB6" value="senso_urgencia" /> Senso de Urgência  
		   <br><input type="checkbox" id="comportamentalB7" name="comportamentalB7" value="lideranca" /> Liderança &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
		   <input type="checkbox" id="comportamentalB8" name="comportamentalB8" value="dinamismo_execucao" /> Dinamismo e Execução &nbsp;&nbsp;&nbsp;
		   <input type="checkbox" id="comportamentalB9" name="comportamentalB9" value="outros" onclick="desabilitarPerfil('sim')" /> Outros <br>
		   <input type="checkbox" id="comportamentalB10" name="comportamentalB10" value="foco_versatilidade" /> Foco e Versatilidade &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   <input type="checkbox" id="comportamentalB11" name="comportamentalB11" value="disseminacao_conhecimento" /> Disseminação
		   </td>
		   <td>
		   Apresentação de Outros Perfis: <br> <textarea type="text" disabled="true" id="perfil" name="perfil" class="form-control" required="true" rows="8" cols="40" value=""><?php if(!empty($comportamental)){echo "";}else{echo $comportamental[0]->outros;} ?></textarea>
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
			<textarea required type="text" id="conhecimento_tecnico" name="conhecimento_tecnico" class="form-control" required="true" rows="5" cols="60" value=""><?php echo $vaga->conhecimento_tecnico; ?></textarea>  
			<td width="500">Descreva no mínimo 03 conhecimentos técnicos <b>Desejados</b> para assumir a vaga: 
			<textarea required type="text" id="conhecimento_desejado" name="conhecimento_desejado" class="form-control" required="true" rows="5" cols="60" value=""><?php echo $vaga->conhecimento_desejado; ?></textarea></td>   
			</tr>
		   <tr>
		    <td colspan="1">Formação Acadêmica: </td>
			<td colspan="1">Idiomas: </td>
		   </tr>
		   <tr>
			<td><textarea required type="text" id="formacao" name="formacao" class="form-control" required="true" rows="5" cols="60" value=""><?php echo $vaga->formacao; ?></textarea></td>     
			<td><textarea required type="text" id="idiomas" name="idiomas" class="form-control" required="true" rows="5" cols="60" value=""><?php echo $vaga->idiomas; ?></textarea></td>     
		   </tr>
		   <tr>
		   <td colspan="2">Competências  cadastradas (Para Alterar Selecione Novamente): <br><br>
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
			<td>Competências: <br><br> 
			<input type="checkbox" id="motivoB1" name="motivoB1" value="conhecimento_windows" /> Conhecimentos em Windows &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoB2" name="motivoB2" value="pacote_office" /> Pacote Office
			<br><input type="checkbox" id="motivoB3" name="motivoB3" value="certificacao_especifica" /> Certificação Específica &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  	
			<input type="checkbox" id="motivoB7" name="motivoB7" value="curso_atualizacao" /> Curso de Atualização da Área
			<br><input type="checkbox" id="motivoB4" name="motivoB4" value="excel_basico"  /> Excel Básico &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoB5" name="motivoB5" value="excel_intermediario"  /> Excel Intermediário   	
			<br><input type="checkbox" id="motivoB6" name="motivoB6" value="excel_avancado"  /> Excel Avançado	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoB9" name="motivoB9" value="outros" onclick="desabilitarMotivo('sim')"  /> Outros 
			<br><input type="checkbox" id="motivoB8" name="motivoB8" value="ferramentas_gestao"  /> Ferramentas de Gestão (PDCA/5S/MÉTODOS ÁGEIS)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td colspan="1"> Apresentação de Outras Competências: <br><br> <?php $qtdComp = sizeof($competencias); ?>
			<textarea disabled="true" required type="text" id="outras_competencias" name="outras_competencias" class="form-control" required="true" rows="5" cols="20"><?php if($qtdComp > 0){echo $competencias[0]->outros;}else{echo "";} ?></textarea></td>	
			</td>
		   </tr>
		  </table>
		  </center>
		  @endforeach		
		  <br>
		  <center>		
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="40"><strong><h5>Justificativa/Observações:</h5></strong></td>
			<td><textarea type="text" id="justificativa" name="justificativa" class="form-control" required="true" rows="10" cols="60"><?php echo $justificativa[0]->descricao; ?></textarea></td>
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
			<td>Solicitante </td><td><input readonly="true" type="date" id="data_solicitante" name="data_solicitante" class="form-control" /></td>
		   </tr>
		   <tr>
			<td>Gestor Imediato</td><td><input readonly="true" type="date" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control" /></td>
		   </tr>
		   <tr>
			<td>Rec. Humanos</td><td><input readonly="true" type="date" id="data_rec_humanos" name="data_rec_humanos" class="form-control" /></td>
		   </tr>
		   <tr>
			<td>Diretoria Técnica</td><td><input readonly="true" type="date" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control" /></td>
		   </tr>
		   <tr>
			<td>Diretoria</td><td><input readonly="true" type="date" id="data_diretoria" name="data_diretoria" class="form-control" /></td>
		   </tr>
		   <tr>
			<td>Superintendência</td><td><input readonly="true" type="date" id="data_superintendencia" name="data_superintendencia" class="form-control" /></td>
		   </tr>
		   </table>
		  </center>
		  
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td align="left"> 
			 <a href="{{route('validarVaga', $idVaga)}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
			</td> 
			<td align="right"> 
			 <input type="submit" class="btn btn-success btn-sm" value="Alterar" id="Salvar" name="Salvar" /> 
			</td>
		   </tr>
		  </table>
		  </center>
   </form>
</body>