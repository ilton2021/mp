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
	<script type="text/javascript">
		function desabilitar(valor) {
		  var status = document.getElementById('tipo_mov1').checked;
		  
		  if (status == true) {
			document.getElementById('cargo').disabled 			  = false;
			document.getElementById('salario').disabled 		  = false;
			document.getElementById('outras_verbas').disabled 	  = false;
			document.getElementById('horario_trabalho').disabled  = false;
			document.getElementById('escala_trabalho').disabled   = false;
			document.getElementById('escala_trabalho2').disabled  = false;
			document.getElementById('escala_trabalho3').disabled  = false;
			document.getElementById('escala_trabalho4').disabled  = false;
			document.getElementById('centro_custo').disabled 	 = false;
			document.getElementById('jornada').disabled 	 	 = false;
			document.getElementById('turno').disabled 	 		 = false;
			document.getElementById('turno2').disabled 	 		 = false;
			document.getElementById('tipo').disabled  			 = false;
			document.getElementById('tipo2').disabled  			 = false;
			document.getElementById('tipo3').disabled  			 = false;
			document.getElementById('tipo4').disabled  			 = false;
			document.getElementById('tipo5').disabled  			 = false;			
			document.getElementById('motivo').disabled  		 = false;
			document.getElementById('motivo2').disabled  		 = false;
			document.getElementById('motivo3').disabled  		 = false;
			document.getElementById('motivo4').disabled  		 = false;
			document.getElementById('possibilidade_contratacao').disabled  = false;
			document.getElementById('possibilidade_contratacao2').disabled = false;
			document.getElementById('necessidade_email').disabled  		   = false;
			document.getElementById('necessidade_email2').disabled  	   = false;
			
		  } else {
			document.getElementById('cargo').disabled 			  = true;
			document.getElementById('salario').disabled 		  = true;
			document.getElementById('outras_verbas').disabled	  = true;
			document.getElementById('horario_trabalho').disabled  = true;
			document.getElementById('escala_trabalho').disabled   = true;
			document.getElementById('escala_trabalho2').disabled  = true;
			document.getElementById('escala_trabalho3').disabled  = true;
			document.getElementById('escala_trabalho4').disabled  = true;
			document.getElementById('centro_custo').disabled 	 = true;
			document.getElementById('jornada').disabled 	 	 = true;
			document.getElementById('turno').disabled 	 		 = true;
			document.getElementById('turno2').disabled 	 		 = true;
			document.getElementById('tipo').disabled  			 = true;
			document.getElementById('tipo2').disabled  			 = true;
			document.getElementById('tipo3').disabled  			 = true;
			document.getElementById('tipo4').disabled  			 = true;
			document.getElementById('tipo5').disabled  			 = true;
			document.getElementById('motivo').disabled  		 = true;
			document.getElementById('motivo2').disabled  		 = true;
			document.getElementById('motivo3').disabled  		 = true;
			document.getElementById('motivo4').disabled  		 = true;
			document.getElementById('possibilidade_contratacao').disabled  = true;
			document.getElementById('possibilidade_contratacao2').disabled = true;
			document.getElementById('necessidade_email').disabled  		   = true;
			document.getElementById('necessidade_email2').disabled  	   = true;
		  }
		  
		}
		
		function desabilitar2(valor) {
		  var status = document.getElementById('tipo_desligamento').disabled;
		  if (status == true) {
			  document.getElementById('tipo_desligamento').disabled  = false;
			  document.getElementById('tipo_desligamento2').disabled = false;
			  document.getElementById('tipo_desligamento3').disabled = false;
			  document.getElementById('tipo_desligamento4').disabled = false;
			  document.getElementById('tipo_desligamento5').disabled = false;
			  document.getElementById('tipo_desligamento6').disabled = false;
			  document.getElementById('tipo_desligamento7').disabled = false;
			  document.getElementById('aviso_previo').disabled  = false;
			  document.getElementById('aviso_previo2').disabled = false;
			  document.getElementById('aviso_previo3').disabled = false;
			  document.getElementById('ultimo_dia').disabled    = false;
			  document.getElementById('custo_recisao').disabled = false;
		  }else {
			  document.getElementById('tipo_desligamento').disabled  = true;
			  document.getElementById('tipo_desligamento2').disabled = true;
			  document.getElementById('tipo_desligamento3').disabled = true;
			  document.getElementById('tipo_desligamento4').disabled = true;
			  document.getElementById('tipo_desligamento5').disabled = true;
			  document.getElementById('tipo_desligamento6').disabled = true;
			  document.getElementById('tipo_desligamento7').disabled = true;
			  document.getElementById('aviso_previo').disabled  = true;
			  document.getElementById('aviso_previo2').disabled = true;
			  document.getElementById('aviso_previo3').disabled = true;
			  document.getElementById('ultimo_dia').disabled    = true;
			  document.getElementById('custo_recisao').disabled = true;
		  }
		}
		
		function desabilitar3(valor) {
		  var status = document.getElementById('unidade_id2').disabled;
		  if (status == true) {
		      document.getElementById('unidade_id2').disabled    = false;
			  document.getElementById('setor').disabled 	     = false;
			  document.getElementById('cargo_atual').disabled 	 = false;
			  document.getElementById('cargo_novo').disabled 	 = false;
			  document.getElementById('remuneracao').disabled    = false;
			  document.getElementById('salario_atual').disabled  = false;
			  document.getElementById('centro_custo_novo').disabled = false;
			  document.getElementById('horario_novo').disabled 		= false;
			  document.getElementById('motivoA').disabled 			= false;
			  document.getElementById('motivoA2').disabled  = false;
			  document.getElementById('motivoA3').disabled  = false;
			  document.getElementById('motivoA4').disabled  = false;
			  document.getElementById('motivoA5').disabled  = false;
			  document.getElementById('motivoA6').disabled  = false;
			  document.getElementById('motivoA7').disabled  = false;
			  document.getElementById('motivoA8').disabled  = false;
			  document.getElementById('motivoA9').disabled  = false;
			  document.getElementById('motivoA10').disabled = false;
			  document.getElementById('motivoA11').disabled = false;
		  } else {
			  document.getElementById('unidade_id2').disabled    = true;
			  document.getElementById('setor').disabled 	     = true;
			  document.getElementById('cargo_atual').disabled    = true;
			  document.getElementById('cargo_novo').disabled     = true;
			  document.getElementById('remuneracao').disabled    = true;
			  document.getElementById('salario_atual').disabled  = true;
			  document.getElementById('centro_custo_novo').disabled = true;
			  document.getElementById('horario_novo').disabled 		= true;
			  document.getElementById('motivoA').disabled 			= true;
			  document.getElementById('motivoA2').disabled  = true;
			  document.getElementById('motivoA3').disabled  = true;
			  document.getElementById('motivoA4').disabled  = true;
			  document.getElementById('motivoA5').disabled  = true;
			  document.getElementById('motivoA6').disabled  = true;
			  document.getElementById('motivoA7').disabled  = true;
			  document.getElementById('motivoA8').disabled  = true;
			  document.getElementById('motivoA9').disabled  = true;
			  document.getElementById('motivoA10').disabled = true;
			  document.getElementById('motivoA11').disabled = true;
		  }
		}
		
		function desabilitarSal(valor) {
		  var status = document.getElementById('remuneracao').checked;
		  if (status == true) {
			document.getElementById('salario_novo').disabled   = false;
		  } else {
			document.getElementById('salario_novo').disabled   = true;
		  }
		}

		function desabilitarOutra(valor) {
		  var status = document.getElementById('escala_trabalho6').disabled;
		  if (status == true) {
			document.getElementById('escala_trabalho6').disabled = false;
		  }else {
			document.getElementById('escala_trabalho6').disabled = true;  
		  }
		}
		
		function desabilitarRPA(valor) {
		  var status = document.getElementById('periodo_contrato').disabled;
		  if (status == true) {
			document.getElementById('periodo_contrato').disabled = false;
		  }else {
			document.getElementById('periodo_contrato').disabled = true;  
		  }
		}
		
		function desabilitarSubst(valor) {
		  var status = document.getElementById('motivo6').disabled;
		  if (status == true) {
			document.getElementById('motivo6').disabled = false;
		  }else {
			document.getElementById('motivo6').disabled = true;  
		  }
		}

		function ativarOutra(valor){
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
	  <form action="{{\Request::route('storeMP'), $unidade[0]->id}}" method="post">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <?php if($tipo_mp == 0){ ?>
			  <td colspan="2"><center><strong><h3><br>Movimentação de Pessoal - ORDINÁRIO</h3></strong></center></td>
			  <?php } else { ?>
			  <td colspan="2"><center><strong><h3><br>Movimentação de Pessoal - NÃO ORDINÁRIO</h3></strong></center></td>
			  <?php } ?>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			  <td hidden><input hidden class="form-control" type="text" id="mp_id" name="mp_id" value="" readonly="true" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="concluida" name="concluida" value="" readonly="true" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="aprovada" name="aprovada" value="0" readonly="true" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="ordem" name="ordem" value="" readonly="true" /></td>
			</tr>
			<tr>
			  <td width="400px">Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
			  <td>Local de Trabalho:
			  <select class="form-control" id="local_trabalho" name="local_trabalho">
			     <option id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->id ?>">{{ $unidade[0]->nome }}</option>
			  </select>
			  </td>
			  <td>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo Auth::user()->name; ?>" /></td>
			</tr>
			<tr>
			  <td hidden> Número do MP: <input class="form-control" type="text" id="numeroMP" name="numeroMP" value="" /> </td>
			  <td colspan="1">Nome: <input class="form-control" type="text" id="nome" name="nome" required="true" value="{{ Request::old('nome') }}" /></td>
			  <td> Matrícula: <input class="form-control" type="text" id="matricula" name="matricula" value="{{Request::old('matricula')}}" /> </td>
			  <td>Gestor Imediato: 
			  <select id="gestor_id" name="gestor_id" class="form-control">
			  <?php if($tipo_mp == 0){ ?>
			  @if(!empty($gestores))
			   @foreach($gestores as $gestor)
		         <option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id ?>" selected>{{ $gestor->nome }}</option>
			   @endforeach
			  @endif
			  <?php } else { ?>
			    <option id="gestor_id" name="gestor_id" value="30">{{ 'RAFAELA GONÇALVES CARAZZAI' }}</option>
			  <?php } ?>
			  </select>
			  <td hidden><input id="tipo_mp" name="tipo_mp" value="{{ $tipo_mp }}" /></td>
			</tr>
			<tr>
			  <td colspan="2">Departamento: <input class="form-control" type="text" id="departamento" name="departamento" value="{{ old('departamento') }}" required /></td>
			  <td>Data de Emissão: <input class="form-control" type="text" id="data_emissao" name="data_emissao" value="<?php echo date('d-m-Y', strtotime('now')); ?>" readonly="true" /></td>
			</tr>
		   </table>
		  </center>
		  
		  <br>	 
		  <center>
			<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
			  <tr>
			   <td width="800px;" colspan="2"><center><strong><h4>Tipos de Movimentação</h4></strong></center></td>
		 	   <td >Data Prevista: <input class="form-control" type="date" id="data_prevista" name="data_prevista" required value="{{ Request::old('data_prevista') }}" /></td>
			  </tr>	
			</table>
		  </center>

		  <br>	 
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		    </tr>
		    <tr>
			 <td rowspan="5" width="150"><center><h5>Admissão</h5> 
			 @if(old('tipo_mov1') == "on")
			 <input type="checkbox" onclick="desabilitar('sim')" id="tipo_mov1" name="tipo_mov1" checked />
		     @else
			 <input type="checkbox" onclick="desabilitar('sim')" id="tipo_mov1" name="tipo_mov1" /> 
			 @endif
			 </center></td>
			 <td colspan="1" width="1050">Cargo: 
				
				@if(old('tipo_mov1') == "on")
				<select class="form-control" id="cargo" name="cargo" required="true">
				  <option id="cargo" name="cargo" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargo)
				      @if(old('cargo') == $cargo->nome)
						<option id="cargo" name="cargo" selected value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>	
					  @else
						<option id="cargo" name="cargo" value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>	  
					  @endif
					@endforeach
				  @endif
				</select>
				@else
				<select class="form-control" id="cargo" name="cargo" disabled="" required="true">
				  <option id="cargo" name="cargo" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargo)
						<option id="cargo" name="cargo" value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>	
					@endforeach
				  @endif
				</select>	
				@endif
			 </td>
			 <td width="370">
			 Remuneração Total: <br>
			 @if(old('tipo_mov1') == "on")
			 Salário <br>
			 <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" required="true" id="salario" name="salario" value="{{ old('salario') }}" />
			 Outras Verbas
			 <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="outras_verbas" name="outras_verbas" value="{{ old('outras_verbas') }}" />
			 @else
			 Salário <br>
			 <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" disabled="true" type="number" required="true" id="salario" name="salario" value="{{ old('salario') }}" />
			 Outras Verbas
			 <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" disabled="true" type="number" id="outras_verbas" name="outras_verbas" value="{{ old('outras_verbas') }}" />	 
			 @endif
			 </td>
			 <td width="200">Horário de Trabalho: <br>
				  @if(old('tipo_mov1') == "on")
				  <select class="form-control" id="horario_trabalho" name="horario_trabalho" required="true" onchange="ativarOutra('sim')">
				  @if(old('horario_trabalho') == "07:00 as 16:00")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00" selected>07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif(old('horario_trabalho') == "08:00 as 17:00")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00" selected>08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif(old('horario_trabalho') == "07:00 as 19:00")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00" selected>07h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif(old('horario_trabalho') == "09:00 as 19:00")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00" selected>09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif(old('horario_trabalho') == "0")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0" selected>Outro...</option>
				  Outro:
				  <input class="form-control" type="text" id="horario_trabalho2" name="horario_trabalho2" value="{{ old('horario_trabalho2') }}" />	
				  @endif
				  </select>
				  @else
				  <select class="form-control" disabled="true" id="horario_trabalho" name="horario_trabalho" required="true" onchange="ativarOutra('sim')"> 
				  <option id="horario_trabalho" name="horario_trabalho" value="">Selecione...</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  </select>
				  @endif
				
				Outro:
				<input class="form-control" disabled="true" type="text" id="horario_trabalho2" name="horario_trabalho2" disabled="true" />	
			 </td>
			</tr>
			<tr>
			 <td colspan="1" width="1050">Escala de Trabalho: <br><br> 
			 @if(old('tipo_mov1') == "on")
			 @if(old('escala_trabalho') == "segxsex")
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" checked /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 
			 @elseif(old('escala_trabalho') == "12x36")
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" checked /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 
			 @elseif(old('escala_trabalho') == "12x60")
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" checked /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 
			 @elseif(old('escala_trabalho') == "outra")
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" checked /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 
			 @else
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 
			 @endif
			 @else
			 <input disabled="true" type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input disabled="true" type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input disabled="true" type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input disabled="true" type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 	 
			 @endif
			 </td> 
			 <td width="370">Centro de Custo: 
			   @if(old('tipo_mov1') == "on")
			   <select id="centro_custo" name="centro_custo" class="form-control" required>
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
			   @else
			   <select id="centro_custo" disabled="true" name="centro_custo" class="form-control" required>
			    <option id="centro_custo" name="centro_custo" value="">Selecione...</option>
			    @if(!empty($centro_custos))
				 @foreach($centro_custos as $c_c)
				   <option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>">{{ $c_c->nome }}</option>	  
				 @endforeach
				@endif
			   </select>	   
			   @endif
			 </td>
			 <td width="450">Jornada:
			    @if(old('tipo_mov1') == "on")
			    <select class="form-control" id="jornada" name="jornada" required>
				  <option id="jornada" name="jornada" value="">Selecione...</option>
				  @if(old('jornada') == "diarista")
				  <option id="jornada" name="jornada" value="diarista" selected>Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  <option id="jornada" name="jornada" value="outra">Outra</option>
				  @elseif(old('jornada') == "plantao_par")
				  <option id="jornada" name="jornada" value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par" selected>Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  <option id="jornada" name="jornada" value="outra">Outra</option>
				  @elseif(old('jornada') == "plantao_impar")
				  <option id="jornada" name="jornada" value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar" selected>Plantão Ímpar</option>
				  <option id="jornada" name="jornada" value="outra">Outra</option>
				  @elseif(old('jornada') == "outra")
				  <option id="jornada" name="jornada" value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  <option id="jornada" name="jornada" value="outra" checked>Outra</option>
				  @else
				  <option id="jornada" name="jornada" value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  <option id="jornada" name="jornada" value="outra">Outra</option>	   
				  @endif
				</select>
				@else
				<select disabled="true" class="form-control" id="jornada" name="jornada" required>
				  <option id="jornada" name="jornada" value="">Selecione...</option>
				  <option id="jornada" name="jornada" value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  <option id="jornada" name="jornada" value="outra">Outra</option>
				</select>	
				@endif
			 <br>Turno: <br> 
			  @if(old('tipo_mov1') == "on")
			  @if(old('turno') == "dia")
			  <input checked type="checkbox" id="turno" name="turno" value="dia" /> Dia 
			  <input type="checkbox" id="turno2" name="turno" value="noite" /> Noite
		      @elseif(old('turno') == "noite")
			  <input type="checkbox" id="turno" name="turno" value="dia" /> Dia 
			  <input checked type="checkbox" id="turno2" name="turno" value="noite" /> Noite
			  @else
			  <input type="checkbox" id="turno" name="turno" value="dia" /> Dia 	  
			  <input type="checkbox" id="turno2" name="turno" value="noite" /> Noite
			  @endif
			  @else
			  <input disabled="true" type="checkbox" id="turno" name="turno" value="dia" /> Dia 	  
			  <input disabled="true" type="checkbox" id="turno2" name="turno" value="noite" /> Noite	  
			  @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Tipo: <br> 
			 @if(old('tipo_mov1') == "on")
			 @if(old('tipo') == "efetivo")
			 <input checked type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" /> 
			 @elseif(old('tipo') == "estagiario")
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input checked type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" /> 
			 @elseif(old('tipo') == "temporario")
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input checked type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" /> 
			 @elseif(old('tipo') == "aprendiz")
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input checked type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" /> 
			 @elseif(old('tipo') == "rpa")
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input checked type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="{{ old('periodo_contrato') }}" /> 
			 @else
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" /> 	 
			 @endif
			 @else
			 <input disabled="true" type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input disabled="true" type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input disabled="true" type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input disabled="true" type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input disabled="true" type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" /> 	 	 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Motivo: <br> 
			 @if(old('tipo_mov1') == "on")
			 @if(old('motivo') == "aumento_quadro")
			 <input checked type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 
			 @elseif(old('motivo') == "substituicao_temporaria")
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input checked type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 
			 @elseif(old('motivo') == "segundo_vinculo")
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input checked type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 
			 @elseif(old('motivo') == "substituicao_definitiva")
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input checked type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input type="text" style="width: 220px;" id="motivo6" name="motivo6" value="{{ old('motivo6') }}" /> 
			 @else
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 
			 @endif
			 @else
			 <input disabled="true" type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input disabled="true" type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input disabled="true" type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input disabled="true" type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 	 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td>Possibilidade de Contratação de Deficiente:<br> 
			 @if(old('tipo_mov1') == "on")
			 @if(old('possibilidade_contratacao') == "sim")
			 <input checked type="checkbox" id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" /> Sim 
			 <input type="checkbox" id="possibilidade_contratacao2" name="possibilidade_contratacao" value="nao" /> Não
			 @elseif(old('possibilidade_contratacao') == "nao")
			 <input type="checkbox" id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" /> Sim 
			 <input checked type="checkbox" id="possibilidade_contratacao2" name="possibilidade_contratacao" value="nao" /> Não
			 @else
			 <input type="checkbox" id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" /> Sim 
			 <input type="checkbox" id="possibilidade_contratacao2" name="possibilidade_contratacao" value="nao" /> Não	 
			 @endif
			 @else
			 <input disabled="true" type="checkbox" id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" /> Sim 
			 <input disabled="true" type="checkbox" id="possibilidade_contratacao2" name="possibilidade_contratacao" value="nao" /> Não	 
			 @endif
			 </td>
			 <td colspan="2">Necessidade de conta de e-mail:<br> 
			 @if(old('tipo_mov1') == "on")
			 @if(old('necessidade_email') == "sim")
			 <input checked type="checkbox" id="necessidade_email" name="necessidade_email" value="sim" /> Sim 
			 <input type="checkbox" id="necessidade_email2" name="necessidade_email" value="nao" /> Não
			 @elseif(old('necessidade_email') == "nao")
			 <input type="checkbox" id="necessidade_email" name="necessidade_email" value="sim" /> Sim 
			 <input checked type="checkbox" id="necessidade_email2" name="necessidade_email" value="nao" /> Não
			 @else
			 <input type="checkbox" id="necessidade_email" name="necessidade_email" value="sim" /> Sim 
			 <input type="checkbox" id="necessidade_email2" name="necessidade_email" value="nao" /> Não
			 @endif
			 @else
			 <input disabled="true" type="checkbox" id="necessidade_email" name="necessidade_email" value="sim" /> Sim 
			 <input disabled="true" type="checkbox" id="necessidade_email2" name="necessidade_email" value="nao" /> Não	 
			 @endif
			 </td>
			</tr>
		   </table>
		  </center>
			 
		  <br>
			
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="135"><center><h5>Demissão</h5> 
			@if(old('tipo_mov2') == "on")
			<input type="checkbox" onclick="desabilitar2('sim')" id="tipo_mov2" name="tipo_mov2" checked />
		    @else
			<input type="checkbox" onclick="desabilitar2('sim')" id="tipo_mov2" name="tipo_mov2" />	
			@endif
			</center>
			</td>
			<td width="800">Tipo de desligamento: 
			@if(old('tipo_mov2') == "on")
			@if(old('tipo_desligamento') == "termino_contrato")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" checked /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@elseif(old('tipo_desligamento') == "extincao_antecipada")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" checked /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@elseif(old('tipo_desligamento') == "sem_justa_causa")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" checked /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@elseif(old('tipo_desligamento') == "aposentadoria")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" checked /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@elseif(old('tipo_desligamento') == "com_justa_causa")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" checked /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@elseif(old('tipo_desligamento') == "morte")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" checked /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@elseif(old('tipo_desligamento') == "pedido_demissao")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" checked /> Pedido de Demissão 
			@else 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@endif
			@else
			<br><br> <input disabled="true" type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input disabled="true" type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input disabled="true" type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input disabled="true" type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input disabled="true" type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input disabled="true" type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input disabled="true" type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão 
			@endif
			</td>
			<td width="200">Aviso Prévio: <br><br> 
			@if(old('tipo_mov2') == "on")
			@if(old('aviso_previo') == "trabalhado")
			<input type="checkbox" id="aviso_previo" name="aviso_previo" value="trabalhado" checked /> Trabalhado 
			<br><br> <input type="checkbox" id="aviso_previo2" name="aviso_previo" value="indenizado" /> Indenizado 
			<br><br> <input type="checkbox" id="aviso_previo3" name="aviso_previo" value="dispensado" /> Dispensado </td>
			@elseif(old('aviso_previo') == "indenizado")
			<input type="checkbox" id="aviso_previo" name="aviso_previo" value="trabalhado" /> Trabalhado 
			<br><br> <input type="checkbox" id="aviso_previo2" name="aviso_previo" value="indenizado" checked /> Indenizado 
			<br><br> <input type="checkbox" id="aviso_previo3" name="aviso_previo" value="dispensado" /> Dispensado </td>
			@elseif(old('aviso_previo') == "dispensado")
			<input type="checkbox" id="aviso_previo" name="aviso_previo" value="trabalhado" /> Trabalhado 
			<br><br> <input type="checkbox" id="aviso_previo2" name="aviso_previo" value="indenizado" /> Indenizado 
			<br><br> <input type="checkbox" id="aviso_previo3" name="aviso_previo" value="dispensado" checked /> Dispensado </td>
			@else
			<input type="checkbox" id="aviso_previo" name="aviso_previo" value="trabalhado" /> Trabalhado 
			<br><br> <input type="checkbox" id="aviso_previo2" name="aviso_previo" value="indenizado" /> Indenizado 
			<br><br> <input type="checkbox" id="aviso_previo3" name="aviso_previo" value="dispensado" /> Dispensado </td>	
			@endif
			@else
			<input disabled="true" type="checkbox" id="aviso_previo" name="aviso_previo" value="trabalhado" /> Trabalhado 
			<br><br> <input disabled="true" type="checkbox" id="aviso_previo2" name="aviso_previo" value="indenizado" /> Indenizado 
			<br><br> <input disabled="true" type="checkbox" id="aviso_previo3" name="aviso_previo" value="dispensado" /> Dispensado </td>	
			@endif
			<td width="50">Último dia Trabalhado: <br> 
			@if(old('tipo_mov2') == "on")
			<input required class="form-control" type="date" id="ultimo_dia" name="ultimo_dia" value="{{ old('ultimo_dia') }}" /> 
			@else
			<input required disabled="true" class="form-control" type="date" id="ultimo_dia" name="ultimo_dia" /> 	
			@endif
			<br><br> Custo da Recisão: 
			@if(old('tipo_mov2') == "on")
			<input required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" class="form-control" id="custo_recisao" name="custo_recisao"  value="{{ old('custo_recisao') }}" /> </td>
			@else
			<input disabled="true" required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" class="form-control" id="custo_recisao" name="custo_recisao"  /> </td>	
			@endif
		   </tr>
		  </table>
		  </center>
				
		  <br>
			
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="130" rowspan="5"><center><h5>Alteração Funcional</h5> 
			@if(old('tipo_mov3') == "on")
			<input type="checkbox" onclick="desabilitar3('sim')" checked id="tipo_mov3" name="tipo_mov3" />
			@else
			<input type="checkbox" onclick="desabilitar3('sim')" id="tipo_mov3" name="tipo_mov3" />	
			@endif
			</center></td>
			
			<td width="400">Transferência proposta: Indique a Unidade 
			  @if(old('tipo_mov3') == "on")
			  <select required id="unidade_id2" name="unidade_id2" class="form-control">
			  @foreach($unidades as $unidade)
			   @if(old('unidade_id2') == $unidade->nome)
			    <option id="unidade_id2" name="unidade_id2" selected>{{ $unidade->nome }}</option>
			   @else
				<option id="unidade_id2" name="unidade_id2">{{ $unidade->nome }}</option>   
			   @endif
			  @endforeach
			  </select>
			  @else
			  <select required disabled="true" id="unidade_id2" name="unidade_id" class="form-control">
			   <option id="unidade_id2" name="unidade_id2" value="">Selecione...</option>
			  @foreach($unidades as $unidade)
			    <option id="unidade_id2" name="unidade_id2">{{ $unidade->nome }}</option>
			  @endforeach
			  </select>
			  @endif
			<td colspan="2">Departamento Proposto 
			 @if(old('tipo_mov3') == "on")
			 <select required class="form-control" id="setor" name="setor">
			 <option id="setor" name="setor" value="">Selecione...</option>
			 @foreach($setores as $setor)
			   @if(old('setor') == $setor->nome)
			    <option id="setor" name="setor" value="<?php echo $setor->nome; ?>" selected>{{ $setor->nome }}</option>
			   @else
				<option id="setor" name="setor" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>   
			   @endif
			 @endforeach
			 </select>
			 @else
			 <select required disabled="true" class="form-control" id="setor" name="setor">
			 <option id="setor" name="setor" value="">Selecione...</option>
			 @foreach($setores as $setor)
			    <option id="setor" name="setor" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>
			 @endforeach
			 </select>	 
			 @endif
			</td>
		   </tr>
		   <tr>
		    <td colspan="1">Cargo Atual: 
			  @if(old('tipo_mov3') == "on")
			  <select required class="form-control" id="cargo_atual" name="cargo_atual">
			     <option id="cargo_atual" name="cargo_atual" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargoAtual)
				      @if(old('cargo_atual') == $cargoAtual->nome)
						<option id="cargo_atual" name="cargo_atual" value="<?php echo $cargoAtual->nome; ?>" selected>{{ $cargoAtual->nome }}</option>	
					  @else
						<option id="cargo_atual" name="cargo_atual" value="<?php echo $cargoAtual->nome; ?>">{{ $cargoAtual->nome }}</option>	  
					  @endif
					@endforeach
				  @endif
			  </select>
			  @else
			  <select required disabled="true" class="form-control" id="cargo_atual" name="cargo_atual">
			     <option id="cargo_atual" name="cargo_atual" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargoAtual)
						<option id="cargo_atual" name="cargo_atual" value="<?php echo $cargoAtual->nome; ?>">{{ $cargoAtual->nome }}</option>	
					@endforeach
				  @endif
			  </select>	  
			  @endif
			</td>
			<td colspan="1">Cargo Proposto: 
			  @if(old('tipo_mov3') == "on")
			  <select required class="form-control" id="cargo_novo" name="cargo_novo">
			    <option id="cargo_novo" name="cargo_novo" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargoP)
				      @if(old('cargo_novo') == $cargoP->nome)
						<option id="cargo_novo" name="cargo_novo" value="<?php echo $cargoP->nome; ?>" selected>{{ $cargoP->nome }}</option>	
					  @else
						<option id="cargo_novo" name="cargo_novo" value="<?php echo $cargoP->nome; ?>">{{ $cargoP->nome }}</option>  
					  @endif
					@endforeach
				  @endif
			  </select>
			  @else
			  <select required disabled="true" class="form-control" id="cargo_novo" name="cargo_novo">
			    <option id="cargo_novo" name="cargo_novo" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargoP)
						<option id="cargo_novo" name="cargo_novo" value="<?php echo $cargoP->nome; ?>">{{ $cargoP->nome }}</option>	
					@endforeach
				  @endif
			  </select> 	  
			  @endif
			</td>
			<td width="50">Novo Horário de Trabalho 
			@if(old('tipo_mov3') == "on")
			<input class="form-control" style="width: 250px;" type="text" id="horario_novo" name="horario_novo" value="{{ old('horario_novo') }}" />
			@else
			<input disabled="true" class="form-control" style="width: 250px;" type="text" id="horario_novo" name="horario_novo" />	
			@endif
			</td>
		   </tr>
		   <tr>
		    <td> Existe Alteração de Remuneração:
			     SIM <input onclick="desabilitarSal('sim')" disabled="true" type="checkbox" id="remuneracao" name="remuneracao" /></td>
		   </tr>
		   <tr>
		    <td>Salário Atual: 
			@if(old('tipo_mov3') == "on")
			<input required class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_atual" name="salario_atual" value="{{ old('salario_atual') }}" />
		    @else
			<input required class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" disabled="true" type="number" id="salario_atual" name="salario_atual"  />	
			@endif
			</td>
			<td width="300">Salário Proposto: 
			@if(old('tipo_mov3') == "on")
			<input required class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_novo" name="salario_novo" value="{{ old('salario_novo') }}" />	
			@else
			<input required disabled="true" class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_novo" name="salario_novo"  />	
			@endif
			</td>
			<td>Novo Centro de Custo: 
			   @if(old('tipo_mov3') == "on")
			   <select required name="centro_custo_novo" id="centro_custo_novo" class="form-control">	
			   <option id="centro_custo_novo" name="centro_custo_novo" value="">Selecione...</option>
				@foreach($centro_custo_nv as $cc_nv)
				@if(old('centro_custo_novo') == $cc_nv->nome)
				 <option id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $cc_nv->nome; ?>" selected>{{ $cc_nv->nome }}</option>
			    @else
				 <option id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $cc_nv->nome; ?>">{{ $cc_nv->nome }}</option>	
				@endif
				@endforeach
			   </select>
			   @else
			   <select required disabled="true" name="centro_custo_novo" id="centro_custo_novo" class="form-control">	
			   <option id="centro_custo_novo" name="centro_custo_novo" value="">Selecione...</option>
				@foreach($centro_custo_nv as $cc_nv)
				<option id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $cc_nv->nome; ?>">{{ $cc_nv->nome }}</option>
				@endforeach
			   </select>	   
			   @endif
			</td>
		   </tr>
		   <tr>
			<td colspan="3">Motivo: <br><br> 
			@if(old('tipo_mov3') == "on")
			@if(old('motivo') == "promocao")	
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" checked /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" /> Substituição Temporária
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="substituicao_demissao_forcada" /> Substituição por demissão forçada  
			@elseif(old('motivo') == "merito")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" checked /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" /> Substituição Temporária
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="substituicao_demissao_forcada" /> Substituição por demissão forçada
			@elseif(old('motivo') == "mudanca_setor_area")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" checked /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" /> Substituição Temporária
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="substituicao_demissao_forcada" /> Substituição por demissão forçada
			@elseif(old('motivo') == "transferencia_outra_unidade")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" checked /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" /> Substituição Temporária
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="substituicao_demissao_forcada" /> Substituição por demissão forçada
			@elseif(old('motivo') == "substituicao_temporaria")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" checked /> Substituição Temporária
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="substituicao_demissao_forcada" /> Substituição por demissão forçada
			@elseif(old('motivo') == "enquadramento")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" /> Substituição Temporária
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" checked /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="substituicao_demissao_forcada" /> Substituição por demissão forçada
			@elseif(old('motivo') == "mudanca_horaria")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" /> Substituição Temporária
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" checked /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="substituicao_demissao_forcada" /> Substituição por demissão forçada
			@elseif(old('motivo') == "substituicao_demissao_voluntaria")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" /> Substituição Temporária
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" checked /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="substituicao_demissao_forcada" /> Substituição por demissão forçada
			@elseif(old('motivo') == "recrutamento_interno")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" /> Substituição Temporária
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" checked /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="substituicao_demissao_forcada" /> Substituição por demissão forçada
			@elseif(old('motivo') == "aumento_quadro")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" /> Substituição Temporária
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" checked /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="substituicao_demissao_forcada" /> Substituição por demissão forçada
			@elseif(old('motivo') == "substituicao_demissao_forcada")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" /> Substituição Temporária
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" checked /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="substituicao_demissao_forcada" /> Substituição por demissão forçada
			@else
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" /> Substituição Temporária
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="substituicao_demissao_forcada" /> Substituição por demissão forçada	
			@endif
			@else
			<input disabled="true" type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input disabled="true" type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito 
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input disabled="true" type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input disabled="true" type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input disabled="true" type="checkbox" id="motivoA11" name="motivo" value="substituicao_temporaria" /> Substituição Temporária
			<br><br> <input disabled="true" type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input disabled="true" type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input disabled="true" type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input disabled="true" type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input disabled="true" type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input disabled="true" type="checkbox" id="motivoA10" name="motivo" /> Substituição por demissão forçada  	
			@endif
			</td>
		   </tr>
		  </table>
		  </center>
				
		  <br>
		  <center>		
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="40"><strong><h5>Justificativa/Observações:</h5></strong></td>
			<td><textarea required type="text" id="descricao" name="descricao" class="form-control" required="true" rows="10" cols="60">  </textarea></td>
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
		    <td align="right"> 
			 <a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
			 <input type="submit" onclick="validar()" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Concluir" id="Salvar" name="Salvar" /> 
			</td>
		   </tr>
		  </table>
		  </center>
   </form>
</body>