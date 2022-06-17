<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Movimentação de Pessoal - Cadastro MP Demissão</title>
  <link rel="stylesheet" href="{{ asset('css/appCadastrosMP.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
  <script type="text/javascript">
		function desabilitarOutra(valor) {
		  var x = document.getElementById('escala_trabalho'); 
		  var y = x.options[x.selectedIndex].text; 
		  
		  if (y == "Outra:") {
			document.getElementById('escala_trabalho6').disabled = false;
		  } else {
			document.getElementById('escala_trabalho6').disabled = true;  
		  }
		}
		
		function desabilitarRPA(valor){
		  var x = document.getElementById('tipo'); 
		  var y = x.options[x.selectedIndex].text; 
		  
		  if(y == "RPA - (Período do Contrato RPA):") {
			document.getElementById('periodo_contrato').disabled = false;  
		  } else {
            document.getElementById('periodo_contrato').disabled = true;  
		  }		  
		}
		
		function desabilitarSubst(valor){
		  var x = document.getElementById('motivo'); 
		  var y = x.options[x.selectedIndex].text; 
			
		  if(y == "Substituição definitiva a:"){
			document.getElementById('motivo2').disabled = false;
		  } else {
		    document.getElementById('motivo2').disabled = true;
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
</head>
<body>
  <div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-7">
            <div class="card b-0">
                @if ($errors->any())
                  <div class="alert alert-success">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                  </div>
                @endif
                <fieldset class="show">
                  <div class="form-card">
				  <form action="{{\Request::route('alterarPDs')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<center>
						<table class="table table-bordered table-sm"> 
							<tr>
							<td colspan="2"><center><strong><h4><br>Programa Degrau</h4></strong></center></td>
							<td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="vaga_id" name="vaga_id" value="" readonly /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="concluida" name="concluida" value="" readonly /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="aprovada" name="aprovada" value="0" readonly /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="descricao" name="descricao" value="" readonly /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="data_emissao" name="data_emissao" value="<?php echo date('Y-m-d', strtotime('now')); ?>" readonly /></td>
							</tr>
							<tr>
							<td hidden><font size="2"><b>Unidade:</b></font><input class="form-control form-control-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->id; ?>" readonly /></td>
							<td><font size="2"><b>Unidade:</b></font><input class="form-control form-control-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly /></td>
							<td hidden><input class="form-control form-control-sm" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly /></td>
							<td><font size="2"><b>Local de Trabalho:</b></font>
							<select class="form-control form-control-sm" id="local_trabalho" name="local_trabalho">
								<option id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->id ?>">{{ $unidade[0]->nome }}</option>
							</select>
							</td>
							<td><font size="2"><b>Solicitante:</b></font><input readonly class="form-control form-control-sm" type="text" id="solicitante" name="solicitante" required value="<?php echo Auth::user()->name; ?>" /></td>
							</tr>
							<tr>
							<td colspan="1"><font size="2"><b>Vaga:</b></font><input class="form-control form-control-sm" type="text" id="vaga" name="vaga" required value="<?php echo $pd[0]->vaga; ?>" /></td>
							<td><font size="2"><b>Código da Vaga:</b></font><input class="form-control form-control-sm" type="text" id="codigo_vaga" name="codigo_vaga" value="<?php echo $pd[0]->codigo_vaga; ?>" /> </td>
							<td><font size="2"><b>Gestor Imediato:</b></font> 
							<select id="gestor_id" name="gestor_id" class="form-control form-control-sm" readonly>
								<option id="gestor_id" name="gestor_id" value="73">{{ 'JANAINA GLAYCE PEREIRA LIMA' }}</option>
							</select>
							</tr>
							<tr>
							<td><font size="2"><b>Departamento Atual:</b></font> 
							<select id="departamento" name="departamento" class="form-control form-control-sm" required>
							<option id="departamento" name="departamento" value="">Selecione...</option>
							@foreach($setores as $setor)
								@if($pd[0]->departamento == $setor->nome)
								<option id="departamento" name="departamento" value="<?php echo $setor->nome; ?>" selected>{{ $setor->nome }}</option>
								@else
								<option id="departamento" name="departamento" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>
								@endif
							@endforeach
							</select>
							</td>
							<td><font size="2"><b>Data de Emissão:</b></font><input class="form-control form-control-sm" type="text" id="data_emissao" name="data_emissao" value="<?php echo date('d-m-Y', strtotime('now')); ?>" readonly /></td>
							<td><font size="2"><b>Data Prevista:</b></font><input class="form-control form-control-sm" type="date" id="data_prevista" name="data_prevista" value="<?php echo $pd[0]->data_prevista; ?>" required /></td>
							</tr>
						</table>
						</center>

						<center>
						<table class="table table-bordered">
							</tr>
							<tr>
							<td rowspan="5" width="150"><center><font size="3"><b>Abertura de Vaga</b></font></center></td>
							<td><font size="2"><b>Cargo:</b></font> 
								<select class="form-control form-control-sm" id="cargo" name="cargo" required>
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
							<td><font size="2"><b>Salário:</b></font><input class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" required id="salario" name="salario" value="<?php echo $pd[0]->salario; ?>" title="ex: 2500 ou 2580,21" /></td>
							<td><font size="2"><b>Horário de Trabalho:</b></font><br>
								<select class="form-control form-control-sm" id="horario_trabalho" name="horario_trabalho" required onclick="desabilitarHorario('sim')">
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
								<option id="horario_trabalho" name="horario_trabalho" value="">Selecione...</option>	  
								<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
								<option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
								<option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
								<option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00">19h às 07h</option>
								<option id="horario_trabalho" name="horario_trabalho" value="0" selected>Outro...</option>
								@endif
								</select>
								<font size="2"><b>Outro:</b></font>
								@if($pd[0]->horario_trabalho != '07:00 as 16:00' && $pd[0]->horario_trabalho != '08:00 as 17:00' && $pd[0]->horario_trabalho != '09:00 as 19:00' && $pd[0]->horario_trabalho != '19:00 as 07:00')
								<input required class="form-control form-control-sm" type="text" id="horario_trabalho2" name="horario_trabalho2" value="<?php echo $pd[0]->horario_trabalho; ?>" />
								@else
								<input required class="form-control form-control-sm" type="text" id="horario_trabalho2" name="horario_trabalho2" value="" disabled />
								@endif
							</td>
							</tr>
							<tr>
							<td><font size="2"><b>Escala de Trabalho:</b></font><br><br> 
							<select class="form-control form-control-sm" id="escala_trabalho" name="escala_trabalho" onchange="desabilitarOutra('sim')">
								@if($pd[0]->escala_trabalho == 'segxsex')
								<option id="escala_trabalho" name="escala_trabalho" value="segxsex" selected> Segunda a Sexta </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x36"> 12x36 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x60"> 12x60 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="outra"> Outra: </option>
								@elseif($pd[0]->escala_trabalho == '12x36')
								<option id="escala_trabalho" name="escala_trabalho" value="segxsex"> Segunda a Sexta </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x36" selected> 12x36 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x60"> 12x60 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="outra"> Outra: </option>
								@elseif($pd[0]->escala_trabalho == '12x60')
								<option id="escala_trabalho" name="escala_trabalho" value="segxsex"> Segunda a Sexta </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x36"> 12x36 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x60" selected> 12x60 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="outra"> Outra: </option>
								@elseif($pd[0]->escala_trabalho != 'segxsex' && $pd[0]->escala_trabalho != '12x36' && $pd[0]->escala_trabalho != '12x60')
								<option id="escala_trabalho" name="escala_trabalho" value="segxsex"> Segunda a Sexta </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x36"> 12x36 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x60"> 12x60 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="outra" selected> Outra: </option>
								@else
								<option id="escala_trabalho" name="escala_trabalho" value="segxsex"> Segunda a Sexta </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x36"> 12x36 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x60"> 12x60 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="outra"> Outra: </option>
								@endif
							</select>
							@if($pd[0]->escala_trabalho != 'segxsex' && $pd[0]->escala_trabalho != '12x36' && $pd[0]->escala_trabalho != '12x60')
							<input required class="form-control form-control-sm" type="text" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $pd[0]->escala_trabalho; ?>">
							@else
							<input required class="form-control form-control-sm" disabled type="text" id="escala_trabalho6" name="escala_trabalho6" value="">  	  
							@endif
							</td> 
							<td><font size="2"><b>Centro de Custo:</b></font> 
							<select id="centro_custo"  name="centro_custo" class="form-control form-control-sm" required>
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
							<td><font size="2"><b>Jornada:</b></font>
								<select  class="form-control form-control-sm" id="jornada" name="jornada" required>
								<option id="jornada" name="jornada" value="">Selecione...</option>
								@if($pd[0]->jornada == 'diarista')
								<option id="jornada" name="jornada" value="diarista" selected>Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
								<option id="jornada" name="jornada" value="semanal">Semanal</option>
								@elseif($pd[0]->jornada == 'plantao_par')
								<option id="jornada" name="jornada" value="diarista">Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par" selected>Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
								<option id="jornada" name="jornada" value="semanal">Semanal</option>
								@elseif($pd[0]->jornada == 'plantao_impar')
								<option id="jornada" name="jornada" value="diarista">Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar" selected>Plantão Ímpar</option>
								<option id="jornada" name="jornada" value="semanal">Semanal</option>
								@elseif($pd[0]->jornada == 'semanal')
								<option id="jornada" name="jornada" value="diarista">Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
								<option id="jornada" name="jornada" value="semanal" selected>Semanal</option>
								@else
								<option id="jornada" name="jornada" value="">Selecione..</option>    
								<option id="jornada" name="jornada" value="diarista">Diarista</option>  
								<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
								@endif
								</select>
							<br><font size="2"><b>Turno:</b></font><br> 
							<select class="form-control form-control-sm" id="turno" name="turno" required>
							<option id="turno" name="turno" value="">Selecione...</option>
								@if($pd[0]->turno == "dia")
								<option id="turno" name="turno" value="dia" selected> Dia </option> 
								<option id="turno" name="turno" value="noite"> Noite </option>
								@elseif($pd[0]->turno == "noite")
								<option id="turno" name="turno" value="dia"> Dia </option>
								<option id="turno" name="turno" value="noite" selected> Noite </option>
								@else
								<option id="turno" name="turno" value="dia"> Dia </option> 
								<option id="turno" name="turno" value="noite"> Noite </option>	 
								@endif
							</select>
							</td>
							</tr>
							<tr>
							<td><font size="2"><b>Tipo:</b></font><br> 
							<select class="form-control form-control-sm" id="tipo" name="tipo" required onchange="desabilitarRPA('sim')">
							 <option id="tipo" name="tipo" value="">Selecione...</option>
								@if($pd[0]->tipo == 'efetivo')
								<option id="tipo" name="tipo" value="efetivo" selected> Efetivo </option>
								<option id="tipo" name="tipo" value="estagiario"> Estagiário </option>
								<option id="tipo" name="tipo" value="temporario"> Temporário </option>
								<option id="tipo" name="tipo" value="aprendiz"> Aprendiz </option>
								<option id="tipo" name="tipo" value="rpa"> RPA - (Período do Contrato RPA): </option>
								@elseif($pd[0]->tipo == 'estagiario')
								<option id="tipo" name="tipo" value="efetivo"> Efetivo </option>
								<option id="tipo" name="tipo" value="estagiario" selected> Estagiário </option>
								<option id="tipo" name="tipo" value="temporario"> Temporário </option>
								<option id="tipo" name="tipo" value="aprendiz"> Aprendiz </option>
								<option id="tipo" name="tipo" value="rpa"> RPA - (Período do Contrato RPA): </option>
								@elseif($pd[0]->tipo == 'temporario')
								<option id="tipo" name="tipo" value="efetivo"> Efetivo </option>
								<option id="tipo" name="tipo" value="estagiario"> Estagiário </option>
								<option id="tipo" name="tipo" value="temporario" selected> Temporário </option>
								<option id="tipo" name="tipo" value="aprendiz"> Aprendiz </option>
								<option id="tipo" name="tipo" value="rpa"> RPA - (Período do Contrato RPA): </option>
								@elseif($pd[0]->tipo == 'aprendiz')
								<option id="tipo" name="tipo" value="efetivo"> Efetivo </option>
								<option id="tipo" name="tipo" value="estagiario"> Estagiário </option>
								<option id="tipo" name="tipo" value="temporario"> Temporário </option>
								<option id="tipo" name="tipo" value="aprendiz" selected> Aprendiz </option>
								<option id="tipo" name="tipo" value="rpa"> RPA - (Período do Contrato RPA): </option>
								@elseif($pd[0]->tipo == 'rpa')
								<option id="tipo" name="tipo" value="efetivo"> Efetivo </option>
								<option id="tipo" name="tipo" value="estagiario"> Estagiário </option>
								<option id="tipo" name="tipo" value="temporario"> Temporário </option>
								<option id="tipo" name="tipo" value="aprendiz"> Aprendiz </option>
								<option id="tipo" name="tipo" value="rpa" selected> RPA - (Período do Contrato RPA): </option>
								@else
								<option id="tipo" name="tipo" value="efetivo"> Efetivo </option>
								<option id="tipo" name="tipo" value="estagiario"> Estagiário </option>
								<option id="tipo" name="tipo" value="temporario"> Temporário </option>
								<option id="tipo" name="tipo" value="aprendiz"> Aprendiz </option>
								<option id="tipo" name="tipo" value="rpa" > RPA - (Período do Contrato RPA): </option>
								@endif
							</select>
							@if($pd[0]->tipo == 'rpa')
							<input required class="form-control form-control-sm" type="text" id="periodo_contrato" name="periodo_contrato" value="<?php echo $pd[0]->periodo_contrato; ?>" /> 		
							@else
							<input required class="form-control form-control-sm" disabled type="text" id="periodo_contrato" name="periodo_contrato" /> 		
							@endif
							</td>
							<td><font size="2"><b>Motivo:</b></font><br> 
							<select class="form-control form-control-sm" id="motivo" name="motivo" required onchange="desabilitarSubst('sim')" >
							<option id="motivo" name="motivo" value="">Selecione...</option>
								@if($pd[0]->motivo == 'aumento_quadro')
								<option id="motivo" name="motivo" value="aumento_quadro" selected> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="substituicao_temporaria"> Substituição temporária </option>
								<option id="motivo" name="motivo" value="segundo_vinculo"> Segundo Vínculo </option>
								<option id="motivo" name="motivo" value="substituicao_definitiva"> Substituição definitiva a: </option>
								@elseif($pd[0]->motivo == 'substituicao_temporaria')
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="substituicao_temporaria" selected> Substituição temporária </option>
								<option id="motivo" name="motivo" value="segundo_vinculo"> Segundo Vínculo </option>
								<option id="motivo" name="motivo" value="substituicao_definitiva"> Substituição definitiva a: </option>
								@elseif($pd[0]->motivo == 'segundo_vinculo')
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="substituicao_temporaria"> Substituição temporária </option>
								<option id="motivo" name="motivo" value="segundo_vinculo" selected> Segundo Vínculo </option>
								<option id="motivo" name="motivo" value="substituicao_definitiva"> Substituição definitiva a: </option>
								@elseif($pd[0]->motivo == 'substituicao_definitiva')
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="substituicao_temporaria"> Substituição temporária </option>
								<option id="motivo" name="motivo" value="segundo_vinculo"> Segundo Vínculo </option>
								<option id="motivo" name="motivo" value="substituicao_definitiva" selected> Substituição definitiva a: </option>
								@else
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="substituicao_temporaria"> Substituição temporária </option>
								<option id="motivo" name="motivo" value="segundo_vinculo"> Segundo Vínculo </option>
								<option id="motivo" name="motivo" value="substituicao_definitiva"> Substituição definitiva a: </option>
								@endif
							</select>
							@if($pd[0]->motivo == 'substituicao_definitiva')
								<input required class="form-control form-control-sm" type="text" id="motivo2" name="motivo2" value="<?php echo $pd[0]->motivo2; ?>">
							@else
								<input required class="form-control form-control-sm" disabled type="text" id="motivo2" name="motivo2">
							@endif
							</td>
							</tr>
							<tr>
							<td><font size="2"><b>Possibilidade de Contratação de Deficiente:</b></font><br> 
							<select class="form-control form-control-sm" id="contratacao_deficiente" name="contratacao_deficiente" required onclick="desabilitarRPA('sim')">
							<option id="contratacao_deficiente" name="contratacao_deficiente" value="">Selecione...</option>
								@if($pd[0]->contratacao_deficiente == "sim")
								<option id="contratacao_deficiente" name="contratacao_deficiente" value="sim" selected> Sim </option>
								<option id="contratacao_deficiente" name="contratacao_deficiente" value="nao"> Não </option>
								@elseif($pd[0]->contratacao_deficiente == "nao")
								<option id="contratacao_deficiente" name="contratacao_deficiente" value="sim"> Sim </option>
								<option id="contratacao_deficiente" name="contratacao_deficiente" value="nao" selected> Não </option>
								@else
								<option id="contratacao_deficiente" name="contratacao_deficiente" value="sim"> Sim </option>
								<option id="contratacao_deficiente" name="contratacao_deficiente" value="nao"> Não </option>
								@endif
							</select>
							</td>
							<td><font size="2"><b>Necessidade de conta de e-mail:</b></font><br> 
							<select class="form-control form-control-sm" id="email" name="email" required onclick="desabilitarRPA('sim')">
							<option id="email" name="email" value="">Selecione...</option>
								@if($pd[0]->email == "sim")
								<option id="email" name="email" value="sim" selected> Sim </option>
								<option id="email" name="email" value="nao"> Não </option>
								@elseif($pd[0]->email == "nao")
								<option id="email" name="email" value="sim"> Sim </option>
								<option id="email" name="email" value="nao" selected> Não </option>
								@else
								<option id="email" name="email" value="sim"> Sim </option>
								<option id="email" name="email" value="nao"> Não </option>	 
								@endif
							</select>
							</td>
							</tr>
						</table>
						</center>
					
						<center>
						<table class="table table-bordered table-sm" style="height: 10px;">
						<tr>
							<td width="135" rowspan="2"><center><font size="3"><b>Perfil Comportamental</b></font></center></td>
							<td colspan="2">Comportamental cadastradas: 
							<br><br> 
							@foreach($comportamental as $comp)
							@if($comp->descricao == "percepcao_visao")
							<input type="checkbox" disabled id="comportamental1" name="comportamental1" value="percepcao_visao" checked /> <font size="2">Percepção e Visão</font> 
							@endif
							@if($comp->descricao == "inovacao")
							<input type="checkbox" disabled id="comportamental2" name="comportamental2" value="inovacao" checked /> <font size="2">Inovação</font> 
							@endif
							@if($comp->descricao == "espirito_equipe")
							<input type="checkbox" disabled id="comportamental3" name="comportamental3" value="espirito_equipe" checked /> <font size="2">Espírito de Equipe</font> 
							@endif
							@if($comp->descricao == "observacao_analise")
							<input type="checkbox" disabled id="comportamental4" name="comportamental4" value="observacao_analise" checked /> <font size="2">Observação e Análise</font> 
							@endif
							@if($comp->descricao == "relacionamento")
							<input type="checkbox" disabled id="comportamental5" name="comportamental5" value="relacionamento" checked /> <font size="2">Relacionamento</font> 
							@endif
							@if($comp->descricao == "senso_urgencia")
							<input type="checkbox" disabled id="comportamental6" name="comportamental6" value="senso_urgencia" checked /> <font size="2">Senso de Urgência </font> 
							@endif
							@if($comp->descricao == "lideranca")
							<input type="checkbox" disabled id="comportamental7" name="comportamental7" value="lideranca" checked /> <font size="2">Liderança</font> 
							@endif
							@if($comp->descricao == "dinamismo_execucao")
							<input type="checkbox" disabled id="comportamental8" name="comportamental8" value="dinamismo_execucao" checked /> <font size="2">Dinamismo e Execução</font> 
							@endif
							@if($comp->descricao == "outros")
							<input type="checkbox" disabled id="comportamental9" name="comportamental9" value="outros" onclick="desabilitarPerfil('sim')" checked /> <font size="2">Outros</font> 
							@endif
							@if($comp->descricao == "foco_versatilidade")
							<input type="checkbox" disabled id="comportamental10" name="comportamental10" value="foco_versatilidade" checked /> <font size="2">Foco e Versatilidade</font> 
							@endif
							@if($comp->descricao == "disseminacao_conhecimento")
							<input type="checkbox" disabled id="comportamental11" name="comportamental11" value="disseminacao_conhecimento" checked /> <font size="2">Disseminação do Conhecimento</font> 
							@endif
							@endforeach
							<td>
						</tr>
						<tr>
						  <td>
							<input type="checkbox" id="comportamentalB1" name="comportamentalB1" value="percepcao_visao" /> <font size="2">Percepção e Visão</font> <br>  	
							<input type="checkbox" id="comportamentalB2" name="comportamentalB2" value="inovacao" /> <font size="2">Inovação <br> 	
							<input type="checkbox" id="comportamentalB3" name="comportamentalB3" value="espirito_equipe" /> <font size="2">Espírito de Equipe</font> <br> 
							<input type="checkbox" id="comportamentalB4" name="comportamentalB4" value="observacao_analise" /> <font size="2">Observação e Análise</font> <br>  
							<input type="checkbox" id="comportamentalB5" name="comportamentalB5" value="relacionamento" /> <font size="2">Relacionamento</font> <br> 
							<input type="checkbox" id="comportamentalB6" name="comportamentalB6" value="senso_urgencia" /> <font size="2">Senso de Urgência </font> <br>
							<input type="checkbox" id="comportamentalB7" name="comportamentalB7" value="lideranca" /> <font size="2">Liderança</font> <br>   
							<input type="checkbox" id="comportamentalB8" name="comportamentalB8" value="dinamismo_execucao" /> <font size="2">Dinamismo e Execução</font> <br>  
							<input type="checkbox" id="comportamentalB10" name="comportamentalB10" value="foco_versatilidade" /> <font size="2">Foco e Versatilidade</font> <br>
							<input type="checkbox" id="comportamentalB11" name="comportamentalB11" value="disseminacao_conhecimento" /> <font size="2">Disseminação do Conhecimento</font> <br> 	
							<input type="checkbox" id="comportamentalB9" name="comportamentalB9" value="outros" onclick="desabilitarPerfil('sim')" /> <font size="2">Outros</font> 
						  </td>
						<td>
						Apresentação de Outros Perfis: <br> <textarea type="text" disabled id="perfil" name="perfil" class="form-control form-control-sm" required rows="5" cols="40" value=""><?php if(!empty($comportamental)){echo "";}else{echo $comportamental[0]->outros;} ?></textarea>
						</td>
						</tr>
						</table>
						</center>
						
						<center>
						<table class="table table-bordered table-sm" style="height: 10px;">
						<tr>
							<td width="135" rowspan="5"><center><font size="3"><b>Perfil Técnico</b></font></center></td>
							<td>Descreva no mínimo 03 conhecimentos técnicos <b>Necessários</b> para assumir a vaga: 
							<textarea required type="text" id="conhecimento_tecnico" name="conhecimento_tecnico" class="form-control form-control-sm" required rows="5" cols="60" value="">{{ $pd[0]->conhecimento_tecnico }}</textarea>  
							<td>Descreva no mínimo 03 conhecimentos técnicos <b>Desejados</b> para assumir a vaga: 
							<textarea required type="text" id="conhecimento_desejado" name="conhecimento_desejado" class="form-control form-control-sm" required rows="5" cols="60" value="">{{ $pd[0]->conhecimento_desejado }}</textarea></td>   
							</tr>
						<tr>
							<td>Formação Acadêmica: </td>
							<td>Idiomas: </td>
						</tr>
						<tr>
							<td><textarea required type="text" id="formacao" name="formacao" class="form-control form-control-sm" required rows="5" cols="60" value="">{{ $pd[0]->formacao }}</textarea></td>     
							<td><textarea required type="text" id="idiomas" name="idiomas" class="form-control form-control-sm" required rows="5" cols="60" value="">{{ $pd[0]->idiomas }}</textarea></td>     
						</tr>
						<tr>
						<td colspan="2">Competências cadastradas: <br><br>
						@if(!empty($competencias))
						@foreach($competencias as $comp)
							@if($comp->descricao == "conhecimento_windows")
							<input type="checkbox" disabled id="motivoA1" name="motivoA1" value="conhecimento_windows" checked /> <font size="2">Conhecimentos em Windows</font>
							@endif
							@if($comp->descricao == "pacote_office")
							<input type="checkbox" disabled id="motivoA2" name="motivoA2" value="pacote_office" checked /> <font size="2">Conhecimentos em Windows</font>
							@endif
							@if($comp->descricao == "certificacao_especifica")
							<input type="checkbox" disabled id="motivoA3" name="motivoA3" value="certificacao_especifica" checked /> <font size="2">Certificação Específica</font>	
							@endif
							@if($comp->descricao == "curso_atualizacao")
							<input type="checkbox" disabled id="motivoA7" name="motivoA7" value="curso_atualizacao" checked /> <font size="2">Curso de Atualização da Área</font>	
							@endif
							@if($comp->descricao == "excel_basico")
							<input type="checkbox" disabled id="motivoA4" name="motivoA4" value="excel_basico" checked /> <font size="2">Excel Básico</font>	
							@endif
							@if($comp->descricao == "outros")
							<input type="checkbox" disabled id="motivoB9" name="motivoB9" value="outros" onclick="desabilitarMotivo('sim')" checked /> <font size="2">Outros</font>	
							@endif
							@if($comp->descricao == "excel_intermediario")
							<input type="checkbox" disabled id="motivoA5" name="motivoA5" value="excel_intermediario" checked  /> <font size="2">Excel Intermediário</font>   	
							@endif
							@if($comp->descricao == "excel_avancado")
							<input type="checkbox" disabled id="motivoA6" name="motivoA6" value="excel_avancado" checked /> <font size="2">Excel Avançado</font>
							@endif
							@if($comp->descricao == "ferramentas_gestao")
							<input type="checkbox" disabled id="motivoA8" name="motivoA8" value="ferramentas_gestao" checked /> <font size="2">Ferramentas de Gestão (PDCA/5S/MÉTODOS ÁGEIS)</font>	
							@endif
						@endforeach
						@endif
						</td>
						</tr>
						<tr>
						<td>Competências: <br><br> 
							<input type="checkbox" id="motivoB1" name="motivoB1" value="conhecimento_windows" /> <font size="2">Conhecimentos em Windows</font> <br>
							<input type="checkbox" id="motivoB2" name="motivoB2" value="pacote_office" /> <font size="2">Pacote Office</font> <br>
							<input type="checkbox" id="motivoB3" name="motivoB3" value="certificacao_especifica" /> <font size="2">Certificação Específica</font> <br>  	
							<input type="checkbox" id="motivoB7" name="motivoB7" value="curso_atualizacao" /> <font size="2">Curso de Atualização da Área</font> <br>
							<input type="checkbox" id="motivoB4" name="motivoB4" value="excel_basico"  /> <font size="2">Excel Básico</font> <br>
							<input type="checkbox" id="motivoB5" name="motivoB5" value="excel_intermediario"  /> <font size="2">Excel Intermediário</font> <br>  	
							<input type="checkbox" id="motivoB6" name="motivoB6" value="excel_avancado"  /> <font size="2">Excel Avançado</font> <br>	
							<input type="checkbox" id="motivoB8" name="motivoB8" value="ferramentas_gestao"  /> <font size="2">Ferramentas de Gestão (PDCA/5S/MÉTODOS ÁGEIS)</font> <br>
							<input type="checkbox" id="motivoB9" name="motivoB9" value="outros" onclick="desabilitarMotivo('sim')"  /> <font size="2">Outros</font> 
							</td>
							<td colspan="2"> Apresentação de Outras Competências: <br><br> 
							<textarea disabled required type="text" id="outras_competencias" name="outras_competencias" class="form-control form-control-sm" required rows="5" cols="20"><?php if(!empty($competencias)){echo $competencias[0]->outros;}else{echo "";} ?></textarea></td>	
							</td>
						</tr>
						</table>
						</center>
						
						<center>		
						<table class="table table-bordered table-sm" style="height: 10px;">
						<tr>
							<td width="40"><strong><font size="3">Justificativa/Observações:</font></strong></td>
							<td><textarea type="text" id="descricao" name="descricao" class="form-control form-control-sm" required rows="5" cols="60" value="<?php echo $just_vaga[0]->descricao; ?>"> {{ $just_vaga[0]->descricao }} </textarea></td>
						</tr>
						</table>
						</center>
						
						<center>	
						<table class="table table-bordered table-sm" style="height: 10px;">
						<tr>
							<td width="100" colspan="6"><strong>Aprovações (Carimbo e Assinatura):</strong></td>
						</tr>
						<tr>
							<td><font size="2">SOLICITANTE</font></td>
							<td>
							<input readonly type="text" id="data_solicitante" name="data_solicitante" class="form-control form-control-sm" value="<?php echo date('d-m-Y', strtotime($pd[0]->data_emissao)); ?>" />
							</td>
						</tr>
						<tr>
							<td><font size="2">GERENTE DE RH</font></td>
							<td>
							@foreach($aprovacao as $ap)
							@if($ap->gestor_anterior == 198 || $ap->gestor_anterior == 30)
							<input readonly type="text" id="data_rec_humanos" name="data_rec_humanos" class="form-control form-control-sm" value="<?php echo date('d-m-Y', strtotime($ap->data_aprovacao)); ?>" />
							@endif
							@endforeach
							</td>
						</tr>
						<tr>
							<td><font size="2">GESTOR DE UNIDADE</font></td>
							<td>
							@foreach($aprovacao as $ap)
							@if(($ap->gestor_anterior == 59 || $ap->gestor_anterior == 60 || $ap->gestor_anterior == 61 || $ap->gestor_anterior == 155 || $ap->gestor_anterior == 165 || $ap->gestor_anterior == 166 || $ap->gestor_anterior == 183) && $ap->vaga_interna_id == $pd[0]->id)
							<input readonly type="text" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control form-control-sm" value="<?php echo date('d-m-Y', strtotime($ap->data_aprovacao)); ?>" />
							@endif
							@endforeach
							</td>
						</tr>
						</table>
						</center>
						
						<center>
						<table class="table table-bordered" style="height: 10px;">
						<tr>
							<td align="right"> 
							 <a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a> 
							 <input type="submit" onclick="validar()" class="btn btn-success btn-sm" value="ALTERAR" id="Salvar" name="Salvar" /> 
							</td>
						</tr>
						</table>
						</center>
					</form>	 
                  </div>
                </fieldset> 
             </div>
        </div>
    </div>
</div>
</body>
</HTML>