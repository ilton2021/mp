<!DOCTYPE html>
@section('content')
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Programa Degrau - RH</title>
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
		  var status = document.getElementById('motivo4').checked;	
			
		  if(status == true){
			document.getElementById('motivo6').disabled = false;
		  } else {
		    document.getElementById('motivo6').disabled = true;
		  }			  
		}
	
		function desabilitarPerfil(valor){
		  var status = document.getElementById('comportamental9').checked;	
			
		  if(status == true){
			document.getElementById('perfil').disabled = false;  
		  } else {
			document.getElementById('perfil').disabled = true;  
		  }
		}
		
		function desabilitarMotivo(valor){
		  var status = document.getElementById('motivoA9').checked;	
			
		  if(status == true){
			document.getElementById('outras_competencias').disabled = false;  
		  } else {
			document.getElementById('outras_competencias').disabled = true;  
		  }
		}

		function desabilitarHorario(valor){
			var x = document.getElementById('horario_trabalho'); 
			var y = x.options[x.selectedIndex].text;  
			if(y == "Outro..."){
				document.getElementById('horario_trabalho2').disabled = false;
			} else {
				document.getElementById('horario_trabalho2').disabled = true;
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
	  <form action="{{\Request::route('storeVaga'), $unidade[0]->id}}" method="POST">             
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td colspan="2"><center><strong><h3><br>Programa Degrau</h3></strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			  <td hidden><input hidden class="form-control" type="text" id="vaga_id" name="vaga_id" value="" readonly="true" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="concluida" name="concluida" value="" readonly="true" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="aprovada" name="aprovada" value="0" readonly="true" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="descricao" name="descricao" value="" readonly="true" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="vinculo" name="vinculo" value="" readonly="true" value="0" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="data_emissao" name="data_emissao" value="<?php echo date('Y-m-d', strtotime('now')); ?>" readonly="true" /></td>
			</tr>
			<tr>
			  <td width="340px" hidden>Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
			  <td width="340px">Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
			  <td>Local de Trabalho:
			  <select class="form-control" id="local_trabalho" name="local_trabalho">
			     <option id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->id ?>">{{ $unidade[0]->nome }}</option>
			  </select>
			  </td>
			  <td>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo Auth::user()->name; ?>" /></td>
			</tr>
			<tr>
			  <td colspan="1">Vaga: <input class="form-control" type="text" id="vaga" name="vaga" required="true" value="{{ Request::old('vaga') }}" /></td>
			  <td> Código da Vaga: <input class="form-control" type="text" id="codigo_vaga" name="codigo_vaga" value="{{Request::old('codigo_vaga')}}" /> </td>
			  <td>Gestor Imediato: 
			  <select id="gestor_id" name="gestor_id" class="form-control" readonly="true">
			    <option id="gestor_id" name="gestor_id" value="198">{{ 'JANAINA GLAYCE PEREIRA LIMA' }}</option>
			  </select>
			</tr>
			<tr>
			<td>Departamento Atual: 
			  <select id="departamento" name="departamento" class="form-control" required="true">
			  <option id="departamento" name="departamento" value="">Selecione...</option>
			  @foreach($setores as $setor)
			   	@if(old('departamento') == $setor->nome)
				  <option id="departamento" name="departamento" value="<?php echo $setor->nome; ?>" selected>{{ $setor->nome }}</option>
				@else
				  <option id="departamento" name="departamento" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>
				@endif
			  @endforeach
			  </select>
			  </td>
			  <td>Data de Emissão da Vaga: <input class="form-control" type="text" id="data_emissao" name="data_emissao" value="<?php echo date('d-m-Y', strtotime('now')); ?>" readonly="true" /></td>
			  <td>Data Prevista: <input class="form-control" type="date" id="data_prevista" name="data_prevista" value="{{ Request::old('data_prevista') }}" required="true" /></td>
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
				<select class="form-control" id="cargo" name="cargo" required="true">
				  <option id="cargo" name="cargo" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargo)
				      @if(old('cargo') == $cargo->nome)
						<option id="cargo" name="cargo" value="{{ $cargo->nome }}" selected>{{ $cargo->nome }}</option>	
					  @else
						<option id="cargo" name="cargo" value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>	
					  @endif
					@endforeach
				  @endif
				</select>
			 </td>
			 <td width="370">Salário: <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" required="true" id="salario" name="salario" value="{{ old('salario') }}" title="ex: 2500 ou 2580,21" /></td>
			 <td width="200">Horário de Trabalho: <br>
			    <select class="form-control" id="horario_trabalho" name="horario_trabalho" required="true" onclick="desabilitarHorario('sim')">
				  @if(old('horario_trabalho') == '07:00 as 16:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00" selected>07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif(old('horario_trabalho') == '08:00 as 17:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00" selected>08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif(old('horario_trabalho') == '09:00 as 19:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00" selected>09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif(old('horario_trabalho') == '19:00 as 07:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00" selected>19h às 07h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @else
				   <option id="horario_trabalho" name="horario_trabalho" value="">Selecione...</option>	  
			       <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				   <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				   <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				   <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
				   <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				   @endif
				</select>
				Outro:
				<input class="form-control"  type="text" id="horario_trabalho2" name="horario_trabalho2" value="{{ old('horario_trabalho2') }}" disabled="true" />
			 </td>
			</tr>
			<tr>
			 <td colspan="1" width="1050">Escala de Trabalho: <br><br> 
			 @if(old('escala_trabalho') == 'segxsex')
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" checked /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 
			 @elseif(old('escala_trabalho') == '12x36')
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" checked /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 
			 @elseif(old('escala_trabalho') == '12x60')
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" checked /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 
			 @elseif(old('escala_trabalho') == 'outra')
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" checked onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="{{ old('escala_trabalho6') }}" /> 
			 @else
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" />  	  
			 @endif
			 </td> 
			 <td width="370">Centro de Custo: 
			   <select id="centro_custo"  name="centro_custo" class="form-control" required>
			    <option id="centro_custo" name="centro_custo" value="">Selecione...</option>
			    @if(!empty($centro_custos))
				 @foreach($centro_custos as $c_c)
				  @if(old('centro_custo') == $c_c->nome)
				   <option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>" selected>{{ $c_c->nome }}</option>
				  @else
				   <option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>">{{ $c_c->nome }}</option>	  
				  @endif
				 @endforeach
				@endif
			   </select>
			 </td>
			 <td width="450">Jornada:
			    <select  class="form-control" id="jornada" name="jornada" required>
				  @if(old('jornada') == 'diarista')
				   <option id="jornada" name="jornada" value="diarista" selected>Diarista</option>
				   <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				   <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  @elseif(old('jornada') == 'plantao_par')
				   <option id="jornada" name="jornada" value="diarista">Diarista</option>
				   <option id="jornada" name="jornada" value="plantao_par" selected>Plantão Par</option>
				   <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  @elseif(old('jornada') == 'plantao_impar')
				   <option id="jornada" name="jornada" value="diarista">Diarista</option>
				   <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				   <option id="jornada" name="jornada" value="plantao_impar" selected>Plantão Ímpar</option>
				  @else
				   <option id="jornada" name="jornada" value="">Selecione..</option>    
				   <option id="jornada" name="jornada" value="diarista">Diarista</option>  
				   <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				   <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  @endif
				</select>
			 
			 <br>Turno: <br> 
			 @if(old('turno') == "dia")
			 <input type="checkbox" id="turno" name="turno" value="dia" checked /> Dia 
			 <input type="checkbox" id="turno2" name="turno" value="noite" /> Noite
			 @elseif(old('turno') == "noite")
			 <input type="checkbox" id="turno" name="turno" value="dia" /> Dia 
			 <input type="checkbox" id="turno2" name="turno" value="noite" checked /> Noite
			 @else
			 <input type="checkbox" id="turno" name="turno" value="dia" /> Dia 
			 <input type="checkbox" id="turno2" name="turno" value="noite" /> Noite	 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Tipo: <br> 
			 @if(old('tipo') == 'efetivo')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" checked /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" /> 		
		     @elseif(old('tipo') == 'estagiario')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" checked /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" /> 		
			 @elseif(old('tipo') == 'temporario')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" checked /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" /> 		
			 @elseif(old('tipo') == 'aprendiz')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" checked /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" /> 		
			 @elseif(old('tipo') == 'rpa')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" checked /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="{{ old('periodo_contrato') }}" /> 		
			 @else
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
		     <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" /> 		
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Motivo: <br> 
			 @if(old('motivo') == 'aumento_quadro')
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" checked /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 
			 @elseif(old('motivo') == 'substituicao_temporaria')
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" checked /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 
			 @elseif(old('motivo') == 'segundo_vinculo')
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" checked /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 
			 @elseif(old('motivo') == 'substituicao_definitiva')
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" checked /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" value="{{ old('motivo6') }}" /> 
			 @else
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" />  	 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td>Possibilidade de Contratação de Deficiente:<br> 
			 @if(old('contratacao_deficiente') == "sim")
			 <input type="checkbox" id="contratacao_deficiente" name="contratacao_deficiente" value="sim" checked /> Sim 
			 <input type="checkbox" id="contratacao_deficiente" name="contratacao_deficiente" value="nao" /> Não
			 @elseif(old('contratacao_deficiente') == "nao")
			 <input type="checkbox" id="contratacao_deficiente" name="contratacao_deficiente" value="sim" /> Sim 
			 <input type="checkbox" id="contratacao_deficiente" name="contratacao_deficiente" value="nao" checked /> Não
			 @else
			 <input type="checkbox" id="contratacao_deficiente" name="contratacao_deficiente" value="sim" /> Sim 
			 <input type="checkbox" id="contratacao_deficiente" name="contratacao_deficiente" value="nao" /> Não
			 @endif
			 </td>
			 <td colspan="2">Necessidade de conta de e-mail:<br> 
			 @if(old('email') == "sim")
			 <input type="checkbox" id="email" name="email" value="sim" checked /> Sim 
			 <input type="checkbox" id="email2" name="email" value="nao" /> Não
			 @elseif(old('email') == "nao")
			 <input type="checkbox" id="email" name="email" value="sim" /> Sim 
			 <input type="checkbox" id="email2" name="email" value="nao" checked /> Não
			 @else
			 <input type="checkbox" id="email" name="email" value="sim" /> Sim 
			 <input type="checkbox" id="email2" name="email" value="nao" /> Não 	 
			 @endif
			 </td>
			</tr>
		   </table>
		  </center>
			 
		  <br>
			
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="135"><center><h5><b>Perfil Comportamental</b></h5> </center></td>
			<td width="600">Comportamental: 
			<br><br> 
			@if(old('comportamental1') == "percepcao_visao")
			<input type="checkbox" id="comportamental1" name="comportamental1" value="percepcao_visao" checked /> Percepção e Visão &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		    @else
			<input type="checkbox" id="comportamental1" name="comportamental1" value="percepcao_visao" /> Percepção e Visão &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	
		    @endif
			@if(old('comportamental2') == "inovacao")
			<input type="checkbox" id="comportamental2" name="comportamental2" value="inovacao" checked /> Inovação &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	
			@else
			<input type="checkbox" id="comportamental2" name="comportamental2" value="inovacao" /> Inovação &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	
			@endif
			@if(old('comportamental3') == "espirito_equipe")
			<input type="checkbox" id="comportamental3" name="comportamental3" value="espirito_equipe" checked /> Espírito de Equipe  
			@else
			<input type="checkbox" id="comportamental3" name="comportamental3" value="espirito_equipe" /> Espírito de Equipe  
			@endif
			@if(old('comportamental4') == "observacao_analise")
			<br> <input type="checkbox" id="comportamental4" name="comportamental4" value="observacao_analise" checked /> Observação e Análise &nbsp;&nbsp;&nbsp;  
			@else
			<br> <input type="checkbox" id="comportamental4" name="comportamental4" value="observacao_analise" /> Observação e Análise &nbsp;&nbsp;&nbsp;  
			@endif
			@if(old('comportamental5') == "relacionamento")
			<input type="checkbox" id="comportamental5" name="comportamental5" value="relacionamento" checked /> Relacionamento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			@else
			<input type="checkbox" id="comportamental5" name="comportamental5" value="relacionamento" /> Relacionamento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			@endif
			@if(old('comportamental6') == "senso_urgencia")
			<input type="checkbox" id="comportamental6" name="comportamental6" value="senso_urgencia" checked /> Senso de Urgência  
			@else
			<input type="checkbox" id="comportamental6" name="comportamental6" value="senso_urgencia" /> Senso de Urgência  
			@endif
			@if(old('comportamental7') == "lideranca")
			<br> <input type="checkbox" id="comportamental7" name="comportamental7" value="lideranca" checked /> Liderança  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
			@else
			<br> <input type="checkbox" id="comportamental7" name="comportamental7" value="lideranca" /> Liderança  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
			@endif
			@if(old('comportamental8') == "dinamismo_execucao")
			<input type="checkbox" id="comportamental8" name="comportamental8" value="dinamismo_execucao" checked /> Dinamismo e Execução  &nbsp;&nbsp; 
			@else
			<input type="checkbox" id="comportamental8" name="comportamental8" value="dinamismo_execucao" /> Dinamismo e Execução  &nbsp;&nbsp; 
			@endif
			@if(old('comportamental9') == "outros")
			<input type="checkbox" id="comportamental9" name="comportamental9" value="outros" onclick="desabilitarPerfil('sim')" checked /> Outros
			@else
			<input type="checkbox" id="comportamental9" name="comportamental9" value="outros" onclick="desabilitarPerfil('sim')" /> Outros
			@endif
			@if(old('comportamental10') == "foco_versatilidade")
			<br> <input type="checkbox" id="comportamental10" name="comportamental10" value="foco_versatilidade" checked /> Foco e Versatilidade  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		    @else
			<br> <input type="checkbox" id="comportamental10" name="comportamental10" value="foco_versatilidade" /> Foco e Versatilidade  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			@endif
			@if(old('comportamental11') == "disseminacao_conhecimento")
			<input type="checkbox" id="comportamental11" name="comportamental11" value="disseminacao_conhecimento" checked /> Disseminação do Conhecimento  
		    @else
			<input type="checkbox" id="comportamental11" name="comportamental11" value="disseminacao_conhecimento" /> Disseminação do Conhecimento  	
			@endif
		    </td>
			<td>
			@if(old('comportamental9') == "outros")
			 Apresentação de Outros Perfis: <br> <textarea type="text" id="perfil" name="perfil" class="form-control" required="true" rows="8" cols="60" value="">{{ old('perfil') }}</textarea></td>  
		    @else
			 Apresentação de Outros Perfis: <br> <textarea disabled="true" type="text" id="perfil" name="perfil" class="form-control" required="true" rows="8" cols="60" value="">{{ old('perfil') }}</textarea></td>  	
			@endif
		   </tr>
		  </table>
		  </center>
				
		  <br>
			
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="135" rowspan="5"><center><h5><b>Perfil Técnico</b></h5> </center></td>
			<td width="500">Descreva no mínimo 03 conhecimentos técnicos <b>Necessários</b> para assumir a vaga: 
			<textarea required type="text" id="conhecimento_tecnico" name="conhecimento_tecnico" class="form-control" required="true" rows="5" cols="60" value="">{{ Request::old('conhecimento_tecnico') }}</textarea>  
			<td width="500">Descreva no mínimo 03 conhecimentos técnicos <b>Desejados</b> para assumir a vaga: 
			<textarea required type="text" id="conhecimento_desejado" name="conhecimento_desejado" class="form-control" required="true" rows="5" cols="60" value="">{{ Request::old('conhecimento_desejado') }}</textarea></td>   
			</tr>
		   <tr>
		    <td colspan="1">Formação Acadêmica: </td>
			<td colspan="1">Idiomas: </td>
		   </tr>
		   <tr>
			<td><textarea required type="text" id="formacao" name="formacao" class="form-control" required="true" rows="5" cols="60" value="">{{ Request::old('formacao') }} </textarea></td>     
			<td><textarea required type="text" id="idiomas" name="idiomas" class="form-control" required="true" rows="5" cols="60" value="">{{ Request::old('idiomas') }}</textarea></td>     
		   </tr>
		   <tr>
			<td>Competências: <br><br> 
			@if(old('motivoA1') == "conhecimento_windows")
			<input type="checkbox" id="motivoA1" name="motivoA1" value="conhecimento_windows" checked /> Conhecimentos em Windows &nbsp;&nbsp;&nbsp;&nbsp; 
		    @else
			<input type="checkbox" id="motivoA1" name="motivoA1" value="conhecimento_windows" /> Conhecimentos em Windows &nbsp;&nbsp;&nbsp;&nbsp; 	
			@endif
			@if(old('motivoA2') == "pacote_office")
			<input type="checkbox" id="motivoA2" name="motivoA2" value="pacote_office" checked /> Pacote Office 
		    @else
			<input type="checkbox" id="motivoA2" name="motivoA2" value="pacote_office" /> Pacote Office 	
			@endif
			@if(old('motivoA3') == "certificacao_especifica")
			<br><input type="checkbox" id="motivoA3" name="motivoA3" value="certificacao_especifica" checked /> Certificação Específica &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  	
			@else
			<br><input type="checkbox" id="motivoA3" name="motivoA3" value="certificacao_especifica" /> Certificação Específica &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  	
			@endif
			@if(old('motivoA7') == "curso_atualizacao")
			<input type="checkbox" id="motivoA7" name="motivoA7" value="curso_atualizacao" checked /> Curso de Atualização da Área	
			@else
			<input type="checkbox" id="motivoA7" name="motivoA7" value="curso_atualizacao" /> Curso de Atualização da Área	
			@endif
			@if(old('motivoA4') == "excel_basico")
			<br><input type="checkbox" id="motivoA4" name="motivoA4" value="excel_basico" checked /> Excel Básico  	
			@else
			<br><input type="checkbox" id="motivoA4" name="motivoA4" value="excel_basico" /> Excel Básico &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			@endif
			@if(old('motivoA5') == "excel_intermediario")
			<input type="checkbox" id="motivoA5" name="motivoA5" value="excel_intermediario" checked /> Excel Intermediário   	
			@else
			<input type="checkbox" id="motivoA5" name="motivoA5" value="excel_intermediario" /> Excel Intermediário   	
			@endif
			@if(old('motivoA6') == "excel_avancado")
			<br><input type="checkbox" id="motivoA6" name="motivoA6" value="excel_avancado" checked /> Excel Avançado	
			@else
			<br><input type="checkbox" id="motivoA6" name="motivoA6" value="excel_avancado" /> Excel Avançado	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
			@endif
			@if(old('motivoA9') == "outros")
			<input type="checkbox" id="motivoA9" name="motivoA9" value="outros" onclick="desabilitarMotivo('sim')" checked /> Outros 
			@else
			<input type="checkbox" id="motivoA9" name="motivoA9" value="outros" onclick="desabilitarMotivo('sim')" /> Outros 	
			@endif
			@if(old('motivoA8') == "ferramentas_gestao")
			<br><input type="checkbox" id="motivoA8" name="motivoA8" value="ferramentas_gestao" checked /> Ferramentas de Gestão (PDCA/5S/MÉTODOS ÁGEIS)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			@else
			<br><input type="checkbox" id="motivoA8" name="motivoA8" value="ferramentas_gestao" /> Ferramentas de Gestão (PDCA/5S/MÉTODOS ÁGEIS)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
			@endif
			<td colspan="1"> Apresentação de Outras Competências 
			@if(old('motivoA9') == "outros")
			<textarea required type="text" id="outras_competencias" name="outras_competencias" class="form-control" required="true" rows="5" cols="20">{{ Request::old('outras_competencias') }}</textarea></td>
			@else
			<textarea disabled="true" required type="text" id="outras_competencias" name="outras_competencias" class="form-control" required="true" rows="5" cols="20">{{ Request::old('outras_competencias') }}</textarea></td>	
			@endif
		   </tr>
		  </table>
		  </center>
				
		  <br>
		  <center>		
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="40"><strong><h5>Justificativa/Observações:</h5></strong></td>
			<td><textarea type="text" id="descricao" name="descricao" class="form-control" required="true" rows="10" cols="60">{{ Request::old('descricao') }}</textarea></td>
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
			<td>Gerente de RH</td><td><input readonly="true" type="date" id="data_rec_humanos" name="data_rec_humanos" class="form-control" /></td>
		   </tr>
		   <tr>
			<td>Gestor da Unidade</td><td><input readonly="true" type="date" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control" /></td>
		   </tr>
		   </table>
		  </center>
		  
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td align="right"> 
			 <a href="{{url('/homeProgramaDegrau')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
			 <input type="submit" onclick="validar()" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Concluir" id="Salvar" name="Salvar" /> 
			</td>
		   </tr>
		  </table>
		  </center>
   </form>
</body>