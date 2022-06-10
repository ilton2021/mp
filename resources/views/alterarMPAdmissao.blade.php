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
		function somarSalarios(){
			s1 = Number(document.getElementById("salario").value);
			s2 = Number(document.getElementById("outras_verbas").value);
			soma = Number(s1 + s2);
			document.getElementById("remuneracao_total").value = soma;
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

		function desabilitarOutra(valor) {
		  var x = document.getElementById('escala_trabalho'); 
	 	  var y = x.options[x.selectedIndex].text; 
		  if (y == "Outra:") {
			document.getElementById('escala_trabalho6').hidden = false;
		  }else {
			document.getElementById('escala_trabalho6').hidden = true;  
		  }
		}
		
		function desabilitarSubst(valor){
		  var x = document.getElementById('motivo'); 
		  var y = x.options[x.selectedIndex].text; 
			
		  if(y == "Substituição Definitiva a:"){ 
			document.getElementById('data_demissao').disabled = false;
			document.getElementById('salario_base').disabled  = false;
			document.getElementById('motivo6').disabled = false;
		  } else if(y == "Substituição Temporária") {
			document.getElementById('data_demissao').disabled = false;
			document.getElementById('salario_base').disabled  = false;
			document.getElementById('motivo6').disabled = true;
		  } else {
		    document.getElementById('data_demissao').disabled = true;
			document.getElementById('salario_base').disabled  = true;
			document.getElementById('motivo6').disabled = true;
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
				  <form action="{{route('updateMPAdmissao', array($idMP, $idA))}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
					<center>
					<table class="table table-bordered table-sm"> 
						<tr>
						<td colspan="2"><center><strong><h5><br>Alterar - Movimentação de Pessoal</h5></strong></center></td>
						<td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
						</tr>
						@foreach($mps as $mp)
						<tr>
						<td><b><font size="2">Unidade:</font></b><input class="form-control form-control-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly /></td>
						<td hidden><input class="form-control form-control-sm" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" title="{{ $unidade[0]->id }}" readonly /></td>
						<td><b><font size="2">Local de Trabalho:</font></b><input class="form-control form-control-sm" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly required /></td>
						<td><b><font size="2">Solicitante:</font></b><input readonly class="form-control form-control-sm" type="text" id="solicitante" name="solicitante" required value="<?php echo $mp->solicitante; ?>" title="{{ $mp->solicitante }}" /></td>
						</tr>
						<tr>
						<td><b><font size="2">Nome:</font></b><input class="form-control form-control-sm" type="text" id="nome" name="nome" value="<?php echo $mp->nome; ?>" title="{{ $mp->nome }}" required maxlength="200" /></td>
						<td><b><font size="2">Matrícula:</font></b><input class="form-control form-control-sm" type="text" id="matricula" name="matricula" value="<?php echo $mp->matricula; ?>" title="{{ $mp->numeroMP }}" /></td>
						<td><b><font size="2">Gestor Imediato:</font></b> 
						<select id="gestor_id" name="gestor_id" class="form-control form-control-sm" readonly disabled>
						<option id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->id ?>" title="{{ $gestor[0]->nome }}">{{ $gestor[0]->nome }}</option>
						</select>
						</tr>
						<tr>
						<td colspan="1"><b><font size="2">Departamento:</font></b><input class="form-control form-control-sm" type="text" id="departamento" name="departamento" value="<?php echo $mp->departamento; ?>" title="{{ $mp->departamento }}" required /></td>
						<td colspan="1"><b><font size="2">Número MP:</font></b><input class="form-control form-control-sm" type="text" id="numeroMP" name="numeroMP" value="<?php echo $mp->numeroMP; ?>" title="{{ $mp->numeroMP }}" readonly /></td>
						<td><b><font size="2">Data de Emissão:</font></b><input class="form-control form-control-sm" type="date" id="data_emissao" name="data_emissao" readonly value="<?php echo $mp->data_emissao; ?>" title="{{ $mp->data_emissao }}" required /></td>
						</tr>
					</table>
					</center>
					
					<center>
						<table class="table table-bordered" style="height: 10px;">
						<tr>  
						<td>
							<center><b><font size="2">IMPACTO FINANCEIRO:</font></b>
								<?php if($mp->impacto_financeiro == "sim"){  ?>
								SIM: <input type="checkbox" checked id="impacto_financeiro" name="impacto_financeiro" value="sim" />
								NÃO: <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="nao" />  
								<?php } else if($mp->impacto_financeiro == "nao"){ ?>
								SIM: <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="sim" />
								NÃO: <input type="checkbox" checked id="impacto_financeiro" name="impacto_financeiro" value="nao" /> 
								<?php } ?>
							</center>
							</td>
						<td><center><b><font size="2">Data Prevista:</font></b></center></td>
						<td><input class="form-control form-control-sm" type="date" id="data_prevista" name="data_prevista" required value="<?php echo $mp->data_prevista; ?>" /></td>
						</tr>	
						</table>
					</center>
					@endforeach
					
					@if(!empty($admissao))
					@foreach($admissao as $adm)	
					<br>	 
					<center>
					<table class="table table-bordered table-sm">
						</tr>
						<tr>
						<td rowspan="5">
						<center><h5><font size="2"><b>Admissão</b></font></h5><input type="checkbox" id="tipo_mov1" name="tipo_mov1" checked readonly disabled /></center>
						</td>
						<td><b><font size="2">Cargo:</font></b> 
						<select class="form-control form-control-sm" id="cargo" name="cargo" onchange="funcaoCargoSalario('sim')">
						<option id="cargo" name="cargo" value="">Selecione...</option>	
							@if(!empty($cargos))	
								@foreach($cargos as $cargo)
									@if($cargo->nome == $adm->cargo)
									<option id="cargo" name="cargo" value="<?php echo $cargo->nome; ?>" selected>{{ $cargo->nome }}</option>	
									@else 
									<option id="cargo" name="cargo" value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>		
									@endif
								@endforeach
							@endif
						</select> <br><br>
						<b><font size="2">Centro de Custo:</font></b> 
						<select id="centro_custo" name="centro_custo" class="form-control form-control-sm">
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
						<td>
						<b><font size="2">Remuneração Total:</font></b> 
						<input disabled required class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="remuneracao_total" name="remuneracao_total" value="<?php echo $adm->salario + $adm->outras_verbas; ?>" />
						<b><font size="2">Salário:</font></b> 
						<input required class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario" name="salario" value="<?php echo $adm->salario; ?>" onchange="somarSalarios('sim')" />
						<b><font size="2">Outras Verbas:</font></b> 
						<input class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="outras_verbas" name="outras_verbas" value="<?php echo $adm->outras_verbas; ?>" onchange="somarSalarios('sim')" />
						</td>
						<td><b><font size="2">Horário de Trabalho:</font></b><br>
						<select class="form-control form-control-sm" id="horario_trabalho" name="horario_trabalho" onchange="ativarOutra('sim')">
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
							<option id="horario_trabalho" name="horario_trabalho" selected value="0">Outro...</option>
							@endif
						</select>
						<b><font size="2">Outro:</font></b>
						@if($adm->horario_trabalho != "07:00 as 16:00" && $adm->horario_trabalho != "08:00 as 17:00" && $adm->horario_trabalho != "09:00 as 19:00" && $adm->horario_trabalho != "19:00 as 07:00")
						<input class="form-control form-control-sm" type="text" id="horario_trabalho2" name="horario_trabalho2" value="<?php echo $adm->horario_trabalho; ?>" />
						@else
						<input disabled class="form-control form-control-sm" type="text" id="horario_trabalho2" name="horario_trabalho2" value="" />
						@endif
						</td>
						</tr>
						<tr>
						<td><b><font size="2">Escala de Trabalho:</font></b><br>
						<select class="form-control form-control-sm" id="escala_trabalho" name="escala_trabalho" onchange="desabilitarOutra('sim')">
						<option id="escala_trabalho" name="escala_trabalho" value=""> Selecione... </option>
							@if($adm->escala_trabalho == "segxsex")
							<option selected id="escala_trabalho" name="escala_trabalho" value="segxsex"> Segunda a Sexta </option>
							<option id="escala_trabalho" name="escala_trabalho" value="12x36"> 12x36 </option>
							<option id="escala_trabalho" name="escala_trabalho" value="12x60"> 12x60 </option>
							<option id="escala_trabalho" name="escala_trabalho" value="outra"> Outra: </option>
							@elseif($adm->escala_trabalho == "12x36")
							<option id="escala_trabalho" name="escala_trabalho" value="segxsex"> Segunda a Sexta </option>
							<option selected id="escala_trabalho" name="escala_trabalho" value="12x36"> 12x36 </option>
							<option id="escala_trabalho" name="escala_trabalho" value="12x60"> 12x60 </option>
							<option id="escala_trabalho" name="escala_trabalho" value="outra"> Outra: </option>
							@elseif($adm->escala_trabalho == "12x60")
							<option id="escala_trabalho" name="escala_trabalho" value="segxsex"> Segunda a Sexta </option>
							<option id="escala_trabalho" name="escala_trabalho" value="12x36"> 12x36 </option>
							<option selected id="escala_trabalho" name="escala_trabalho" value="12x60"> 12x60 </option>
							<option id="escala_trabalho" name="escala_trabalho" value="outra"> Outra: </option>
							@else
							<option id="escala_trabalho" name="escala_trabalho" value="segxsex"> Segunda a Sexta </option>
							<option id="escala_trabalho" name="escala_trabalho" value="12x36"> 12x36 </option>
							<option id="escala_trabalho" name="escala_trabalho" value="12x60"> 12x60 </option>
							<option selected id="escala_trabalho" name="escala_trabalho" value="outra"> Outra: </option>
							@endif 
						</select>
						@if($adm->escala_trabalho != "segxsex" && $adm->escala_trabalho != "12x36" && $adm->escala_trabalho != "12x60")
						<br><input class="form-control form-control-sm" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $adm->escala_trabalho; ?>">
						@else
						<br><input hidden class="form-control form-control-sm" id="escala_trabalho6" name="escala_trabalho6" value="">
						@endif
						</td> 
						<td>
						<?php $q1 = $adm->gratificacoes; $r1 = "1"; $s1 = str_contains($q1, $r1); ?>
						<?php $r2 = "2"; $s2 = str_contains($q1, $r2); ?> <?php $r3 = "3"; $s3 = str_contains($q1, $r3); ?>
						<?php $r4 = "4"; $s4 = str_contains($q1, $r4); ?> <?php $r5 = "5"; $s5 = str_contains($q1, $r5); ?>
						<?php $r6 = "6"; $s6 = str_contains($q1, $r6); ?>
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
						</td>
						<td><b><font size="2">Jornada:</font></b>
						<select class="form-control form-control-sm" id="jornada" name="jornada">
							<option type="checkbox" id="jornada" name="jornada" value=""> Selecione... </option>
							@if($adm->jornada == "diarista")
							<option id="jornada" name="jornada" selected value="diarista">Diarista</option>
							<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
							<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
							<option id="jornada" name="jornada" value="semanal">Semanal</option>
							<option id="jornada" name="jornada" value="outra">Outra</option>
							@elseif($adm->jornada == "plantao_par")
							<option id="jornada" name="jornada" value="diarista">Diarista</option>
							<option id="jornada" name="jornada" selected value="plantao_par">Plantão Par</option>
							<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
							<option id="jornada" name="jornada" value="semanal">Semanal</option>
							<option id="jornada" name="jornada" value="outra">Outra</option>
							@elseif($adm->jornada == "plantao_impar")
							<option id="jornada" name="jornada" value="diarista">Diarista</option>
							<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
							<option id="jornada" name="jornada" selected value="plantao_impar">Plantão Ímpar</option>
							<option id="jornada" name="jornada" value="semanal">Semanal</option>
							<option id="jornada" name="jornada" value="outra">Outra</option>
							@elseif($adm->jornada == "semanal")
							<option id="jornada" name="jornada" value="diarista">Diarista</option>
							<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
							<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
							<option id="jornada" name="jornada" selected value="semanal">Semanal</option>
							<option id="jornada" name="jornada" value="outra">Outra</option>
							@else
							<option id="jornada" name="jornada" value="diarista">Diarista</option>
							<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
							<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
							<option id="jornada" name="jornada" value="semanal">Semanal</option>
							<option id="jornada" name="jornada" selected value="outra">Outra</option>
							@endif
						</select>
						<br><b><font size="2">Turno:</font></b><br> 
						<select id="turno" name="turno" class="form-control form-control-sm">
						<option type="checkbox" id="turno" name="turno" value=""> Selecione... </option> 
							@if($adm->turno == "dia")
							<option selected id="turno" name="turno" value="dia"> Dia </option>
							<option id="turno" name="turno" value="noite"> Noite </option>
							@elseif($adm->turno == "noite")
							<option id="turno" name="turno" value="dia"> Dia </option>
							<option selected id="turno" name="turno" value="noite"> Noite </option>
							@endif
						</select>
						</td>
						</tr>
						<tr>
						<td><b><font size="2">Tipo:</font></b><br>
						<select id="tipo" name="tipo" class="form-control form-control-sm">
						<option type="checkbox" id="tipo" name="tipo" value=""> Selecione... </option> 
							@if($adm->tipo == "efetivo")
							<option selected id="tipo" name="tipo" value="efetivo"> Efetivo </option> 
							<option id="tipo" name="tipo" value="estagiario"> Estagiário </option> 
							<option id="tipo" name="tipo" value="temporario"> Temporário </option> 
							<option id="tipo" name="tipo" value="aprendiz"> Aprendiz </option> 
							@elseif($adm->tipo == "estagiario")
							<option id="tipo" name="tipo" value="efetivo"> Efetivo </option>
							<option selected id="tipo" name="tipo" value="estagiario"> Estagiário </option>
							<option id="tipo" name="tipo" value="temporario"> Temporário </option>
							<option id="tipo" name="tipo" value="aprendiz"> Aprendiz </option>
							@elseif($adm->tipo == "temporario")
							<option id="tipo" name="tipo" value="efetivo"> Efetivo </option>
							<option id="tipo" name="tipo" value="estagiario"> Estagiário </option>
							<option selected id="tipo" name="tipo" value="temporario"> Temporário </option> 
							<option id="tipo" name="tipo" value="aprendiz"> Aprendiz </option>
							@elseif($adm->tipo == "aprendiz")
							<option id="tipo" name="tipo" value="efetivo"> Efetivo </option>
							<option id="tipo" name="tipo" value="estagiario"> Estagiário </option>
							<option id="tipo" name="tipo" value="temporario"> Temporário </option> 
							<option selected id="tipo" name="tipo" value="aprendiz"> Aprendiz </option>
							@endif
						</select>
						</td>
						<td><b><font size="2">Motivo:</font></b><br> 
						 <select id="motivo" name="motivo" class="form-control form-control-sm" onchange="desabilitarSubst('sim')">
						  <option type="checkbox" id="motivo" name="motivo" value=""> Selecione... </option>
						   @if($adm->motivo == "aumento_quadro")
						    <option selected id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
						    <option id="motivo" name="motivo" value="substituicao_temporaria"> Substituição Temporária </option>
						    <option id="motivo" name="motivo" value="segundo_vinculo"> Segundo Vínculo </option>
						    <option id="motivo" name="motivo" value="substituicao_definitiva"> Substituição Definitiva a: </option>
						   @elseif($adm->motivo == "substituicao_temporaria")
						    <option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
						    <option selected id="motivo" name="motivo" value="substituicao_temporaria"> Substituição Temporária </option>
						    <option id="motivo" name="motivo" value="segundo_vinculo"> Segundo Vínculo </option>
						    <option id="motivo" name="motivo" value="substituicao_definitiva"> Substituição Definitiva a: </option>
						  @elseif($adm->motivo == "segundo_vinculo")
						    <option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
						    <option id="motivo" name="motivo" value="substituicao_temporaria"> Substituição Temporária </option>
						    <option selected id="motivo" name="motivo" value="segundo_vinculo"> Segundo Vínculo </option>
						    <option id="motivo" name="motivo" value="substituicao_definitiva"> Substituição Definitiva a: </option>
						  @elseif($adm->motivo == "substituicao_definitiva")
						    <option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
						    <option id="motivo" name="motivo" value="substituicao_temporaria"> Substituição Temporária </option>
						    <option id="motivo" name="motivo" value="segundo_vinculo"> Segundo Vínculo </option>
						    <option selected id="motivo" name="motivo" value="substituicao_definitiva"> Substituição Definitiva a: </option>
						  @endif 
						 </select>
						@if($adm->motivo == "substituicao_definitiva")
						<br><input type="text" class="form-control form-control-sm" id="motivo6" name="motivo6" value="<?php echo $adm->motivo2; ?>">
						@else	
						<br><input hidden type="text" class="form-control form-control-sm" id="motivo6" name="motivo6">
						@endif
						</td>
						<td>
						 @if($adm->motivo == "substituicao_definitiva")
						  <font size="2"><b>Data da Demissão:</b></font>
						  <input type="date" id="data_demissao" name="data_demissao" class="form-control form-control-sm" value="<?php echo $adm->data_demissao; ?>">		
						  <b><font size="2">Salário Base:</font></b>
						  <input class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" required id="salario_base" name="salario_base" value="<?php echo $adm->salario_base; ?>" title="ex: 2500 ou 2580,21" />
						 @else
						  <font size="2"><b>Data da Demissão:</b></font>
						  <input disabled type="date" id="data_demissao" name="data_demissao" class="form-control form-control-sm" value="<?php echo $adm->data_demissao; ?>">		
						  <b><font size="2">Salário Base:</font></b>
						  <input disabled class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" required id="salario_base" name="salario_base" value="<?php echo $adm->salario_base; ?>" title="ex: 2500 ou 2580,21" />
						 @endif
						</td>
						</tr>
						<tr>
						<td><b><font size="2">Possibilidade de Contratação de Deficiente:</font></b><br> 
						<select id="possibilidade_contratacao" name="possibilidade_contratacao" class="form-control form-control-sm">
						<option id="possibilidade_contratacao" name="possibilidade_contratacao" value="">Selecione...</option> 
						@if($adm->possibilidade_contratacao == 'sim') 
							<option selected id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim"> Sim </option>
							<option id="possibilidade_contratacao" name="possibilidade_contratacao" value="nao"> Não </option>
						@else
							<option id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim"> Sim </option>
							<option selected id="possibilidade_contratacao" name="possibilidade_contratacao" value="nao"> Não </option>
						@endif
						</select> 
						</td>
						<td><b><font size="2">Necessidade de conta de e-mail:</font></b><br>
						<select id="necessidade_email" name="necessidade_email" class="form-control form-control-sm">
						<option id="necessidade_email" name="necessidade_email" value="">Selecione...</option> 
						@if($adm->necessidade_email == "sim")
							<option selected id="necessidade_email" name="necessidade_email" value="sim"> Sim </option>
							<option id="necessidade_email" name="necessidade_email" value="nao"> Não </option> 
						@else
							<option id="necessidade_email" name="necessidade_email" value="sim"> Sim </option> 
							<option selected id="necessidade_email" name="necessidade_email" value="nao"> Não </option>
						@endif
						</select>
						</td>
						</tr>
					</table>
					</center>
					@endforeach	 
					@endif
					
					<center>		
					<table class="table table-bordered" style="height: 10px;">
					<tr>
						<td width="180"><strong><font size="2">Informações Adicionais:</font></strong></td>
						<td><textarea required type="text" id="descricao" name="descricao" class="form-control" rows="1" cols="60"> {{ $justificativa[0]->descricao }} </textarea></td>
					</tr>
					</table>
					</center>
					
					<center>
					<table class="table table-bordered" style="height: 10px;">
					<tr>
						<td align="left"> 
						<a href="{{route('validarMP', $idMP)}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
						</td> 
						<td align="right"> 
						<input type="submit" class="btn btn-success btn-sm" value="ALTERAR" id="Salvar" name="Salvar" /> 
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