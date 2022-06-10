<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Movimentação de Pessoal - Cadastro MP Admissão RPA</title>
  <link rel="stylesheet" href="{{ asset('css/appCadastrosMP.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
  <script type="text/javascript">

		function multiplicar(){
			m1 = Number(document.getElementById("valor_plantao").value);
			m2 = Number(document.getElementById("quantidade_plantao").value);
			r = Number(m1*m2);
			document.getElementById("valor_pago_plantao").value = r;
		}

		function somarSalarios(){
			s1 = Number(document.getElementById("salario").value);
			s2 = Number(document.getElementById("outras_verbas").value);
			soma = Number(s1 + s2);
			document.getElementById("remuneracao_total").value = soma;
		}

		function desabilitarOutra(valor) {
		  var x = document.getElementById('escala_trabalho'); 
	 	  var y = x.options[x.selectedIndex].text; 
		  if (y == "Outra:") {
			document.getElementById('escala_trabalho6').disabled = false;
		  }else {
			document.getElementById('escala_trabalho6').disabled = true;  
		  }
		}
			
		function desabilitarSubst(valor) {
			var x = document.getElementById('motivo'); 
			var y = x.options[x.selectedIndex].text; 
		  if (y == "Substituição Definitiva") {
			document.getElementById('motivo2').hidden = false;
		  }else {
			document.getElementById('motivo2').hidden = true;  
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

		function funcaoCargoSalario(valor){
			var x = document.getElementById('cargo'); 
			var u = document.getElementById('unidade').value;
			var y = x.options[x.selectedIndex].text; 
			if(u == "Hospital da Mulher do Recife" || u == "UPAE Arruda"){
				if(y == "ENFERMEIRO(A) 24H"){
					document.getElementById('salario').value = "2369.99";
				} else if(y == "ENFERMEIRO(A) 30H"){
					document.getElementById('salario').value = "2369.99";
				} else if(y == "ENFERMEIRO(A) 40H"){
					document.getElementById('salario').value = "3159.60";
				} else {
					document.getElementById('salario').value = "";
				}
			}
		}

		function funcaoCargoPlantao(valor) {
			let x = document.getElementById('cargos_rpa_id'); 
			var y = x.options[x.selectedIndex].text;
			let z = y.substr(y.indexOf("/") + 1);
			
			document.getElementById('valor_plantao').value = z;

			multiplicar();
		}

		function handler(e){	
			var a = 0;
			if(document.getElementById('mes_ano').value != ''){
				var periodo_inicio = new Date(document.getElementById('mes_ano').value);
				var a = 1;
			}
			if(document.getElementById('mes_ano2').value != '') {
				var periodo_fim    = new Date(document.getElementById('mes_ano2').value);
				var a = 2;
			}
			var timeDiff = Math.abs(periodo_fim.getTime() - periodo_inicio.getTime());
			var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
			if(a == 2){ 
			  if(periodo_fim > periodo_inicio) {
				 
				if(diffDays >= 31){
					alert('Limite de 31 dias! Tente outro Período!');
					document.getElementById('mes_ano').value = "";
					document.getElementById('mes_ano2').value = "";
					document.getElementById('qtdDias').value = "";
				} else {
					document.getElementById('qtdDias').value = diffDays + 1;
				}
	  		  } else if(periodo_fim < periodo_inicio) { 
				alert('Data Inválida! Tente outro Período!');
				document.getElementById('mes_ano').value = "";
				document.getElementById('mes_ano2').value = "";
				document.getElementById('qtdDias').value = '';
			  } else {
				document.getElementById('qtdDias').value = diffDays + 1;
			  }
			}
		}

		function handler2(e){
			if(document.getElementById('data_prevista').value != ''){
				var periodo_fim = new Date(document.getElementById('data_prevista').value);
			}
			var periodo_inicio = new Date(document.getElementById('data_emissao').value);
			var timeDiff = Math.abs(periodo_fim.getTime() - periodo_inicio.getTime());
			var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
		
			if(periodo_fim <= periodo_inicio) {
				if(diffDays > 2){
					alert('Data Limite de 2 Dias Retroativos! Tente outra data!');
					document.getElementById('data_prevista').value = "";
				}
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
				  <form action="{{\Request::route('storeRpaMP'), $unidade[0]->id}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<center>
						<table class="table table-bordered table-sm" style="height: 10px;"> 
							<tr>
							<td colspan="2"><center><strong><h5><br>Movimentação de Pessoal - RPA</h5></strong></center></td>
							<td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="mp_id" name="mp_id" value="" readonly="true" /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="concluida" name="concluida" value="" readonly="true" /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="aprovada" name="aprovada" value="0" readonly="true" /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="ordem" name="ordem" value="" readonly="true" /></td>
							</tr>
							<tr>
							<td><b><font size="2">Unidade:</font></b><input class="form-control form-control-sm form-control form-control-sm-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
							<td hidden><input class="form-control form-control-sm" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
							<td><b><font size="2">Local de Trabalho:</font></b>
							<select class="form-control form-control-sm form-control form-control-sm-sm" id="local_trabalho" name="local_trabalho">
								<option id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->id ?>">{{ $unidade[0]->nome }}</option>
							</select>
							</td>
							<td><b><font size="2">Solicitante:</font></b><input readonly="true" class="form-control form-control-sm form-control form-control-sm-sm" type="text" id="solicitante" name="solicitante" required value="<?php echo Auth::user()->name; ?>" /></td>
							</tr>
							<tr>
							<td hidden><b><font size="2">Número do MP:</font></b><input class="form-control form-control-sm form-control form-control-sm-sm" type="text" id="numeroMP" name="numeroMP" value="" /> </td>
							<td colspan="1"><b><font size="2">Nome:</font></b><input class="form-control form-control-sm form-control form-control-sm-sm" type="text" id="nome" name="nome" required="true" value="{{ Request::old('nome') }}" /></td>
							<td><b><font size="2">Matrícula:</font><input class="form-control form-control-sm  form-control form-control-sm-sm" type="text" id="matricula" name="matricula" value="{{Request::old('matricula')}}" /> </td>
							<td><b><font size="2">Gestor Imediato:</font></b> 
							<select id="gestor_id" name="gestor_id" class="form-control form-control-sm form-control form-control-sm-sm">
							@if(!empty($gestores))
							@foreach($gestores as $gestor)
								<option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id ?>" selected>{{ $gestor->nome }}</option>
							@endforeach
							@endif
							</select>
							</tr>
							<tr>
							<td><b><font size="2">Departamento:</font></b><input class="form-control form-control-sm  form-control form-control-sm-sm" type="text" id="departamento" name="departamento" value="{{ old('departamento') }}" required /></td>
							<td><b><font size="2">Data de Emissão:</font></b><input class="form-control form-control-sm  form-control form-control-sm-sm" type="date" id="data_emissao" name="data_emissao" value="<?php echo date('Y-m-d',strtotime('now')); ?>" readonly="true" /></td>
							<td><b><font size="2">Data Prevista:</font></b><input class="form-control form-control-sm  form-control form-control-sm-sm" type="date" id="data_prevista" name="data_prevista" required value="{{ Request::old('data_prevista') }}" onchange="handler2(event);" /></td>
							</tr>	
							</table>
						</center>
						
						<center>
							<table class="table table-bordered table-sm" style="height: 10px;">
							<tr>  
							<td> <center><b><font size="2">IMPACTO FINANCEIRO:</b>
								@if(old('impacto_financeiro') == "sim")
									SIM: <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="sim" checked /> 
									NÃO: <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="nao" /> 
								@elseif(old('impacto_financeiro') == "nao")
									SIM: <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="sim" /> 
									NÃO: <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="nao" checked />
								@else
									SIM: <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="sim" /> 
									NÃO: <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="nao" />
								@endif 
								</center>
								</td>
							</tr>	
							</table>
						</center>

						<center>
						<table class="table table-bordered table-sm">
							<tr>
							<td><b><font size="2">Cargo:</font></b> 
								<select class="form-control form-control-sm" id="cargo" name="cargo" required onchange="funcaoCargoSalario('sim')">
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
								<br><br>
								<b><font size="2">Centro de Custo:</font></b>
								<select id="centro_custo" name="centro_custo" class="form-control form-control-sm" required>
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
							<td>
							<b><font size="2">Salário:</font></b><br>
							<input class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" required id="salario" name="salario" value="{{ old('salario') }}" onchange="somarSalarios('sim')" />
							<b><font size="2">Outras Verbas:</font></b>
							<input class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="outras_verbas" name="outras_verbas" value="{{ old('outras_verbas') }}" onchange="somarSalarios('sim')" />
							<b><font size="2">Remuneração Total:</font></b>
							<input class="form-control form-control-sm" disabled id="remuneracao_total" name="remuneracao_total" value="{{ old('remuneracao_total') }}" />
							</td>
							<td><b><font size="2">Horário de Trabalho:</font></b><br>
								<select class="form-control form-control-sm" id="horario_trabalho" name="horario_trabalho" required onchange="ativarOutra('sim')">
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
								@else
								<option id="horario_trabalho" name="horario_trabalho" value="">Selecione...</option>
								<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
								<option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
								<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
								<option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
								<option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
								@endif
								</select>
								<font size="2"><b>Outro:</b></font>
								@if(old('horario_trabalho') == "0")
								<input class="form-control form-control-sm" type="text" id="horario_trabalho2" name="horario_trabalho2" value="{{ old('horario_trabalho2') }}" />	
								@else
								<input disabled class="form-control form-control-sm" type="text" id="horario_trabalho2" name="horario_trabalho2" value="{{ old('horario_trabalho2') }}" required/>	
								@endif
							</td>
							</tr>
							<tr>
							<td><b><font size="2">Escala de Trabalho:</font></b><br>
							<select id="escala_trabalho" name="escala_trabalho" class="form-control form-control-sm" onchange="desabilitarOutra('sim')" required>
								@if(old('escala_trabalho') == "segxsex")
								<option id="escala_trabalho" name="escala_trabalho" value=""> Selecione... </option>
								<option id="escala_trabalho" name="escala_trabalho" value="segxsex" selected> Segunda a Sexta </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x36"> 12x36 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x60"> 12x60 </option>
								@elseif(old('escala_trabalho') == "12x36")
								<option id="escala_trabalho" name="escala_trabalho" value=""> Selecione... </option>
								<option id="escala_trabalho" name="escala_trabalho" value="segxsex"> Segunda a Sexta </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x36" selected> 12x36 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x60"> 12x60 </option>
								@elseif(old('escala_trabalho') == "12x60")
								<option id="escala_trabalho" name="escala_trabalho" value=""> Selecione... </option>
								<option id="escala_trabalho" name="escala_trabalho" value="segxsex"> Segunda a Sexta </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x36"> 12x36 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x60" selected> 12x60 </option>
								@else
								<option id="escala_trabalho" name="escala_trabalho" value=""> Selecione... </option>
								<option id="escala_trabalho" name="escala_trabalho" value="segxsex"> Segunda a Sexta </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x36"> 12x36 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="12x60"> 12x60 </option>
								<option id="escala_trabalho" name="escala_trabalho" value="outra"> Outra: </option>
								@endif
							</select>			 
							<br> 
							@if(old('escala_trabalho') == "outra")
							<input type="text" id="escala_trabalho6" name="escala_trabalho6" class="form-control form-control-sm" value="{{ old('escala_trabalho6') }}" required /> 
							@else
							<input type="text" disabled id="escala_trabalho6" name="escala_trabalho6" class="form-control form-control-sm" value="{{ old('escala_trabalho6') }}" /> 
							@endif
							</td> 
							<td><b><font size="2">Jornada:</font></b>
							<select class="form-control form-control-sm" id="jornada" name="jornada" required>
								<option id="jornada" name="jornada" value="">Selecione...</option>
								@if(old('jornada') == "diarista")
								<option id="jornada" name="jornada" value="diarista" selected>Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
								<option id="jornada" name="jornada" value="semanal">Semanal</option>
								<option id="jornada" name="jornada" value="outra">Outra</option>
								@elseif(old('jornada') == "plantao_par")
								<option id="jornada" name="jornada" value="diarista">Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par" selected>Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
								<option id="jornada" name="jornada" value="semanal">Semanal</option>
								<option id="jornada" name="jornada" value="outra">Outra</option>
								@elseif(old('jornada') == "plantao_impar")
								<option id="jornada" name="jornada" value="diarista">Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar" selected>Plantão Ímpar</option>
								<option id="jornada" name="jornada" value="semanal">Semanal</option>
								<option id="jornada" name="jornada" value="outra">Outra</option>
								@elseif(old('jornada') == "semanal")
								<option id="jornada" name="jornada" value="diarista">Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
								<option id="jornada" name="jornada" value="semanal" selected>Semanal</option>
								<option id="jornada" name="jornada" value="outra">Outra</option>
								@elseif(old('jornada') == "outra")
								<option id="jornada" name="jornada" value="diarista">Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
								<option id="jornada" name="jornada" value="semanal">Semanal</option>
								<option id="jornada" name="jornada" value="outra" selected>Outra</option>
								@else
								<option id="jornada" name="jornada" value="diarista">Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
								<option id="jornada" name="jornada" value="semanal">Semanal</option>
								<option id="jornada" name="jornada" value="outra">Outra</option>	   
								@endif
								</select>
							<br><b><font size="2">Turno:</font></b><br> 
							<select class="form-control form-control-sm" id="turno" name="turno" required>
							@if(old('turno') == "dia")
								<option id="turno" name="turno" value=""> Selecione... </option>
								<option id="turno" name="turno" value="dia" selected> Dia </option>
								<option id="turno" name="turno" value="noite"> Noite</option>
							@elseif(old('turno') == "noite")
								<option id="turno" name="turno" value=""> Selecione... </option>
								<option id="turno" name="turno" value="dia"> Dia </option>
								<option id="turno" name="turno" value="noite" selected> Noite</option>
							@else
								<option id="turno" name="turno" value=""> Selecione... </option>
								<option id="turno" name="turno" value="dia"> Dia </option>	  
								<option id="turno" name="turno" value="noite"> Noite</option>
							@endif
							</select>
							</td>
							<td><font size="2"><b> Período (01 Competência): </b></font><br> 
							<input type="date" id="mes_ano" name="mes_ano" required onchange="handler(event);" value="{{ old('mes_ano') }}" /> Até
							<input type="date" id="mes_ano2" name="mes_ano2" required onchange="handler(event);" value="{{ old('mes_ano2') }}" />
							<br><br><font size="2">Quantidades de Dias: <b>(*máximo 31 dias)</font></b><br>
							<input type="text" id="qtdDias" name="qtdDias" readonly class="form-control form-control-sm" style="width:200px;" value="{{ old('qtdDias') }}" />
							</td>
							</tr>
							<tr>
							<td><b><font size="2">Profissional:</font></b> 
							<select required class="form-control form-control-sm" id="cargos_rpa_id" name="cargos_rpa_id" onchange="funcaoCargoPlantao('sim')">
								<option id="cargos_rpa_id" name="cargos_rpa_id" value="">Selecione...</option>
								@if(!empty($cargos_rpa))	
									@foreach($cargos_rpa as $cargoP)
									@if(old('cargos_rpa_id') == $cargoP->id)
										<option id="cargos_rpa_id" name="cargos_rpa_id" value="<?php echo $cargoP->id; ?>" selected>{{ $cargoP->cargo }} / {{ $cargoP->valor }}</option>	
									@else
										<option id="cargos_rpa_id" name="cargos_rpa_id" value="<?php echo $cargoP->id; ?>">{{ $cargoP->cargo }} / {{ $cargoP->valor }}</option>  
									@endif					  
									@endforeach
								@endif
							</select>
							</td>
							<td><b><font size="2">Necessidade de Contratação de Deficiente:</font></b><br> 
							<select id="possibilidade_contratacao" name="possibilidade_contratacao" class="form-control form-control-sm" required>
							@if(old('possibilidade_contratacao') == "sim")
								<option id="possibilidade_contratacao" name="possibilidade_contratacao" value=""> Selecione... </option>	
								<option id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" selected> Sim </option>
								<option id="possibilidade_contratacao" name="possibilidade_contratacao" value="nao"> Não </option> 
							@elseif(old('possibilidade_contratacao') == "nao")
								<option id="possibilidade_contratacao" name="possibilidade_contratacao" value=""> Selecione... </option>	
								<option id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim"> Sim </option>  
								<option id="possibilidade_contratacao" name="possibilidade_contratacao" value="nao" selected> Não </option> 
							@else
								<option id="possibilidade_contratacao" name="possibilidade_contratacao" value=""> Selecione... </option>	
								<option id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim"> Sim </option>  
								<option id="possibilidade_contratacao" name="possibilidade_contratacao" value="nao"> Não </option> 
							@endif
							</select>
							</td>
							<td colspan="2"><b><font size="2">Necessidade de conta de e-mail:</font></b><br> 
							<select id="necessidade_email" name="necessidade_email" class="form-control form-control-sm" required>
							@if(old('necessidade_email') == "sim")
								<option id="necessidade_email" name="necessidade_email" value=""> Selecione... </option>	
								<option id="necessidade_email" name="necessidade_email" value="sim" selected> Sim </option>
								<option id="necessidade_email" name="necessidade_email" value="nao"> Não </option> 
							@elseif(old('necessidade_email') == "nao")
								<option id="necessidade_email" name="necessidade_email" value=""> Selecione... </option>	
								<option id="necessidade_email" name="necessidade_email" value="sim"> Sim </option>  
								<option id="necessidade_email" name="necessidade_email" value="nao" selected> Não </option> 
							@else
								<option id="necessidade_email" name="necessidade_email" value=""> Selecione... </option>	
								<option id="necessidade_email" name="necessidade_email" value="sim"> Sim </option>  
								<option id="necessidade_email" name="necessidade_email" value="nao"> Não </option> 
							@endif
							</select>
							</td>
						</tr>
						<tr> 
							<td><b><font size="2">Substituto:</font></b>
							<input class="form-control form-control-sm" required type="text" id="substituto" name="substituto" value="{{ old('substituto') }}" />
							</td>
							<td><b><font size="2">Departamento:</font></b> 
							<select  class="form-control form-control-sm" id="setor_plantao" name="setor_plantao" required>
							<option id="setor_plantao" name="setor_plantao" value="">Selecione...</option>
							@foreach($setores as $setor)
							@if(old('setor_plantao') == $setor->nome)
								<option id="setor_plantao" name="setor_plantao" value="<?php echo $setor->nome; ?>" selected>{{ $setor->nome }}</option>
							@else
								<option id="setor_plantao" name="setor_plantao" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>   
							@endif
							@endforeach
							</select>
							</td>
							<td><b><font size="2">Motivo:</font></b> 
							<select required  name="motivo" id="motivo" class="form-control form-control-sm" onchange="desabilitarSubst('sim')">	
								@if(old('motivo') == "aumento_quadro")  
								<option id="motivo" name="motivo" value="">Selecione..</option>
								<option id="motivo" name="motivo" value="aumento_quadro" selected>Aumento de Quadro</option>
								<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
								<option id="motivo" name="motivo" value="ferias">Férias</option>
								<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
								<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
								<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
								<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
								<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
								@elseif(old('motivo') == "atestado")  
								<option id="motivo" name="motivo" value="">Selecione..</option>
								<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
								<option id="motivo" name="motivo" value="atestado" selected>Atestado Médico</option>
								<option id="motivo" name="motivo" value="ferias">Férias</option>
								<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
								<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
								<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
								<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
								<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
								@elseif(old('motivo') == "ferias")  
								<option id="motivo" name="motivo" value="">Selecione..</option>
								<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
								<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
								<option id="motivo" name="motivo" value="ferias" selected>Férias</option>
								<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
								<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
								<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
								<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
								<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
								@elseif(old('motivo') == "licenca_maternidade")  
								<option id="motivo" name="motivo" value="">Selecione..</option>
								<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
								<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
								<option id="motivo" name="motivo" value="ferias">Férias</option>
								<option id="motivo" name="motivo" value="licenca_maternidade" selected>Licença Maternidade</option>
								<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
								<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
								<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
								<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
								@elseif(old('motivo') == "segundo_vinculo")  
								<option id="motivo" name="motivo" value="">Selecione..</option>
								<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
								<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
								<option id="motivo" name="motivo" value="ferias">Férias</option>
								<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
								<option id="motivo" name="motivo" value="segundo_vinculo" selected>Segundo Vínculo</option>
								<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
								<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
								<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
								@elseif(old('motivo') == "substituicao_temporaria")  
								<option id="motivo" name="motivo" value="">Selecione..</option>
								<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
								<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
								<option id="motivo" name="motivo" value="ferias">Férias</option>
								<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
								<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
								<option id="motivo" name="motivo" value="substituicao_temporaria" selected>Substituição Temporária</option>
								<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
								<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
								@elseif(old('motivo') == "substituicao_definitiva")  
								<option id="motivo" name="motivo" value="">Selecione..</option>
								<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
								<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
								<option id="motivo" name="motivo" value="ferias">Férias</option>
								<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
								<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
								<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
								<option id="motivo" name="motivo" value="substituicao_definitiva" selected>Substituição Definitiva</option>
								<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
								@elseif(old('motivo') == "outras")  
								<option id="motivo" name="motivo" value="">Selecione..</option>
								<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
								<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
								<option id="motivo" name="motivo" value="ferias">Férias</option>
								<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
								<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
								<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
								<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
								<option id="motivo" name="motivo" value="outras" selected>Outras (Informe na Justificativa)</option>
								@else
								<option id="motivo" name="motivo" value="">Selecione..</option>
								<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
								<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
								<option id="motivo" name="motivo" value="ferias">Férias</option>
								<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
								<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
								<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
								<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
								<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
								@endif
								</select>
								@if(old('motivo') == "substituicao_definitiva")
								<input class="form-control form-control-sm" placeholder="Nome do Funcionário:" type="text" id="motivo2" name="motivo2" value="{{ old('motivo2') }}"/>
								@else
								<input hidden class="form-control form-control-sm" placeholder="Nome do Funcionário:" type="text" id="motivo2" name="motivo2" />
								@endif
							</td>
						</tr>
						<tr>
							<td><b><font size="2">Quantidade:</font></b>
								<select required class="form-control form-control-sm" id="quantidade_plantao" name="quantidade_plantao" onChange="multiplicar();">
								@for($a = 1; $a < 32; $a++)  
								<option id="quantidade_plantao" name="quantidade_plantao" value="<?php echo $a; ?>">{{ $a }}</option>
								@endfor
							</select>
							</td>
							<td><b><font size="2">Valor:</font></b>
								<input required class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" type="text" id="valor_plantao" name="valor_plantao" onChange="multiplicar();"  value="{{ old('valor_plantao') }}" />
							</td>
							<td><b><font size="2">Valor a ser Pago:</font></b>
								<input required class="form-control form-control-sm" title="(Quantidade * Valor)" readonly placeholder="ex: 2500 ou 2580,21"  type="text" id="valor_pago_plantao" name="valor_pago_plantao" value="{{ old('valor_pago_plantao') }}" />	
							</td>
						</tr>
						</table>
						</center>
					
						<center>		
						<table class="table table-bordered" style="height: 10px;">
						<tr>
							<td width="180"><strong><font size="2">Informações Adicionais:</font></strong></td>
							<td><textarea required type="text" id="descricao" name="descricao" class="form-control form-control-sm" required="true" rows="1" cols="60" maxlength="200"> {{ old('descricao') }} </textarea></td>
						</tr>
						</table>
						</center>
						
						<center>	
						<table class="table table-bordered table-sm">
						<tr>
							<td width="100" colspan="6"><strong><font size="2">Aprovações - 48h Úteis para cada aprovador(a).</font></strong></td>
						</tr>
						<tr>
							<td><font size="2">Solicitante</font></td><td><input readonly="true" type="date" id="data_solicitante" name="data_solicitante" class="form-control form-control-sm" /></td>
						</tr>
						<tr>
							<td><font size="2">Gestor Imediato</font></td><td><input readonly="true" type="date" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control form-control-sm" /></td>
						</tr>
							<tr>
							<td><font size="2">Recursos Humanos / DP</font></td><td><input readonly="true" type="date" id="data_rec_humanos" name="data_rec_humanos" class="form-control form-control-sm" /></td>
						</tr>
						<tr>
							<td><font size="2">Diretoria Técnica</font></td><td><input readonly="true" type="date" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control form-control-sm" /></td>
						</tr>
						@if($unidade[0]->id == 2)
						<tr>
							<td><font size="2">Diretoria Financeira</font></td><td><input readonly="true" type="date" id="data_diretoria_financeira" name="data_diretoria_financeira" class="form-control form-control-sm" /></td>
						</tr>
						@endif
						<tr>
							<td><font size="2">Diretor / Coordenação Geral</font></td><td><input readonly="true" type="date" id="data_diretoria" name="data_diretoria" class="form-control form-control-sm" /></td>
						</tr>
						<tr>
							<td><font size="2">Superintendência</font></td><td><input readonly="true" type="date" id="data_superintendencia" name="data_superintendencia" class="form-control form-control-sm" /></td>
						</tr>
						</table>
						</center>
						
						<center>
						<table class="table table-bordered table-sm" style="height: 10px;">
						<tr>
							<td align="right"> 
							<a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
							<input type="submit" onclick="validar()" class="btn btn-success btn-sm" style="margin-top: 10px;" value="CONCLUIR" id="Salvar" name="Salvar" /> 
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