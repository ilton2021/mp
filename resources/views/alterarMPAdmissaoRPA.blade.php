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
		function multiplicar(){
			m1 = Number(document.getElementById("valor_plantao").value.replace(",",".",2));
			m2 = Number(document.getElementById("quantidade_plantao").value.replace(",",".",2));
			r = Number(m1*m2);
			document.getElementById('salario').value = m1;
			document.getElementById("valor_pago_plantao").value = r;
			document.getElementById("remuneracao_total").value = r;
		}

		function multiplicar2(){
			m1 = Number(document.getElementById("valor_plantao_2").value.replace(",",".",2));
			m2 = Number(document.getElementById("quantidade_plantao_2").value.replace(",",".",2));
			r2 = Number(m1*m2);
			document.getElementById("valor_pago_plantao_2").value = r2;
			
			v1 = Number(document.getElementById('valor_plantao').value.replace(",",".",2));
			v2 = Number(document.getElementById('valor_plantao_2').value.replace(",",".",2));
			v3 = Number(document.getElementById('valor_plantao_3').value.replace(",",".",2));
			v = v1+v2+v3;
			document.getElementById("salario").value = v;

			vp1 = Number(document.getElementById("valor_pago_plantao").value.replace(",",".",2));
			vp2 = Number(document.getElementById("valor_pago_plantao_2").value.replace(",",".",2));
			vp3 = Number(document.getElementById("valor_pago_plantao_3").value.replace(",",".",2));
			vp = Number(vp1+vp2+vp3);
			document.getElementById("remuneracao_total").value = vp;
		}

		function multiplicar3(){
			m1 = Number(document.getElementById("valor_plantao_3").value.replace(",",".",2));
			m2 = Number(document.getElementById("quantidade_plantao_3").value.replace(",",".",2));
			r = Number(m1*m2);
			document.getElementById("valor_pago_plantao_3").value = r;

			v1 = Number(document.getElementById('valor_plantao').value.replace(",",".",2));
			v2 = Number(document.getElementById('valor_plantao_2').value.replace(",",".",2));
			v3 = Number(document.getElementById('valor_plantao_3').value.replace(",",".",2));
			v = v1+v2+v3;
			document.getElementById('salario').value = v;
			
			vp1 = Number(document.getElementById("valor_pago_plantao").value.replace(",",".",2));
			vp2 = Number(document.getElementById("valor_pago_plantao_2").value.replace(",",".",2));
			vp3 = Number(document.getElementById("valor_pago_plantao_3").value.replace(",",".",2));
			vp = Number(vp1+vp2+vp3);
			document.getElementById("remuneracao_total").value = vp;
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
			document.getElementById('motivo2').disabled = false;
		  }else {
			document.getElementById('motivo2').disabled = true;  
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
			let z = y.substr(y.indexOf("/") + 2);
			
			document.getElementById('valor_plantao').value = z;
			document.getElementById('salario').value = z;
			document.getElementById('valor_pago_plantao').value = "";
			document.getElementById('remuneracao_total').value = "";
			multiplicar();
		}

		function funcaoCargoPlantao2(valor) {
			let x = document.getElementById('cargos_rpa_id_2'); 
			var y = x.options[x.selectedIndex].text;
			let z = y.substr(y.indexOf("/") + 2);
			
			document.getElementById('valor_plantao_2').value = z;
			document.getElementById('salario').value = z;
			document.getElementById('valor_pago_plantao_2').value = "";
			document.getElementById('remuneracao_total').value = "";
			multiplicar2();
		}
		
		function funcaoCargoPlantao3(valor) {
			let x = document.getElementById('cargos_rpa_id_3'); 
			var y = x.options[x.selectedIndex].text;
			let z = y.substr(y.indexOf("/") + 2);
			
			document.getElementById('valor_plantao_3').value = z;
			document.getElementById('salario').value = z;
			document.getElementById('valor_pago_plantao_3').value = "";
			document.getElementById('remuneracao_total').value = "";
			multiplicar2();
		}

		function handler(e){	
			var a = 0;
			if(document.getElementById('mes_ano').value != ''){
				var periodo_inicio = new Date(document.getElementById('mes_ano').value);
				var a = 1;
			}
			if(document.getElementById('mes_ano2').value != '') {
				var periodo_fim = new Date(document.getElementById('mes_ano2').value);
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
					document.getElementById('quantidade_plantao').value = "";
				} else {
					document.getElementById('qtdDias').value = diffDays + 1;
					document.getElementById('quantidade_plantao').value = diffDays + 1;
					multiplicar();
				}
	  		  } else if(periodo_fim < periodo_inicio) { 
				alert('Data Inválida! Tente outro Período!');
				document.getElementById('mes_ano').value = "";
				document.getElementById('mes_ano2').value = "";
				document.getElementById('qtdDias').value = '';
				document.getElementById('quantidade_plantao').value = "";
			  } else {
				document.getElementById('qtdDias').value = diffDays + 1;
				document.getElementById('quantidade_plantao').value = diffDays + 1;
				multiplicar();
			  }
			}
		}

		function handler2_1(e){	
			var a = 0;
			if(document.getElementById('mes_ano_2').value != ''){
				var periodo_inicio = new Date(document.getElementById('mes_ano_2').value);
				var a = 1;
			}
			if(document.getElementById('mes_ano2_2').value != '') {
				var periodo_fim = new Date(document.getElementById('mes_ano2_2').value);
				var a = 2;
			}
			var timeDiff = Math.abs(periodo_fim.getTime() - periodo_inicio.getTime());
			var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
			if(a == 2){ 
			  if(periodo_fim > periodo_inicio) {
				if(diffDays >= 31){
					alert('Limite de 31 dias! Tente outro Período!');
					document.getElementById('mes_ano_2').value = "";
					document.getElementById('mes_ano2_2').value = "";
					document.getElementById('qtdDias_2').value = "";
					document.getElementById('quantidade_plantao_2').value = "";
				} else {
					document.getElementById('qtdDias_2').value = diffDays + 1;
					document.getElementById('quantidade_plantao_2').value = diffDays + 1;
					multiplicar2();
				}
	  		  } else if(periodo_fim < periodo_inicio) { 
				alert('Data Inválida! Tente outro Período!');
				document.getElementById('mes_ano_2').value = "";
				document.getElementById('mes_ano2_2').value = "";
				document.getElementById('qtdDias_2').value = '';
				document.getElementById('quantidade_plantao_2').value = "";
			  } else {
				document.getElementById('qtdDias_2').value = diffDays + 1;
				document.getElementById('quantidade_plantao_2').value = diffDays + 1;
				multiplicar2();
			  }
			}
		}

		function handler3(e){	
			var a = 0;
			if(document.getElementById('mes_ano_3').value != ''){
				var periodo_inicio = new Date(document.getElementById('mes_ano_3').value);
				var a = 1;
			}
			if(document.getElementById('mes_ano2_3').value != '') {
				var periodo_fim = new Date(document.getElementById('mes_ano2_3').value);
				var a = 2;
			}
			var timeDiff = Math.abs(periodo_fim.getTime() - periodo_inicio.getTime());
			var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
			if(a == 2){ 
			  if(periodo_fim > periodo_inicio) {
				if(diffDays >= 31){
					alert('Limite de 31 dias! Tente outro Período!');
					document.getElementById('mes_ano_3').value = "";
					document.getElementById('mes_ano2_3').value = "";
					document.getElementById('qtdDias_3').value = "";
					document.getElementById('quantidade_plantao_3').value = "";
				} else {
					document.getElementById('qtdDias_3').value = diffDays + 1;
					document.getElementById('quantidade_plantao_3').value = diffDays + 1;
					multiplicar3();
				}
	  		  } else if(periodo_fim < periodo_inicio) { 
				alert('Data Inválida! Tente outro Período!');
				document.getElementById('mes_ano_3').value = "";
				document.getElementById('mes_ano2_3').value = "";
				document.getElementById('qtdDias_3').value = '';
				document.getElementById('quantidade_plantao_3').value = "";
			  } else {
				document.getElementById('qtdDias_3').value = diffDays + 1;
				document.getElementById('quantidade_plantao_3').value = diffDays + 1;
				multiplicar3();
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

		function exibirProfissional2()
		{
			var x = document.getElementById('val').checked;
			if(x == true){
				document.getElementById('cargos_rpa_id_2').disabled = false;
				document.getElementById('cargos_rpa_id_2').value    = "";
				document.getElementById('mes_ano_2').disabled 		= false;
				document.getElementById('mes_ano_2').value 			= "";
				document.getElementById('mes_ano2_2').disabled	    = false;
				document.getElementById('mes_ano2_2').value	    	= "";
				document.getElementById('valor_plantao_2').disabled = false;
				document.getElementById('valor_plantao_2').value 	= "";
				document.getElementById('quantidade_plantao_2').value = "";
				document.getElementById('valor_pago_plantao_2').value = "";
				document.getElementById('salario').value = Number(document.getElementById("valor_plantao").value.replace(",",".",2)) + Number(document.getElementById("valor_plantao_3").value.replace(",",".",2));
				document.getElementById('remuneracao_total').value = Number(document.getElementById("valor_pago_plantao").value.replace(",",".",2)) + Number(document.getElementById("valor_pago_plantao_3").value.replace(",",".",2));
			} else {
				document.getElementById('cargos_rpa_id_2').disabled = true;
				document.getElementById('cargos_rpa_id_2').value 	= "";
				document.getElementById('mes_ano_2').disabled 	 	= true;
				document.getElementById('mes_ano_2').value 	 		= "";
				document.getElementById('mes_ano2_2').disabled 		= true;
				document.getElementById('mes_ano2_2').value 		= "";
				document.getElementById('valor_plantao_2').disabled	= true;
				document.getElementById('valor_plantao_2').value	= "";
				document.getElementById('quantidade_plantao_2').value = "";
				document.getElementById('valor_pago_plantao_2').value = "";
				document.getElementById('salario').value = Number(document.getElementById("valor_plantao").value.replace(",",".",2)) + Number(document.getElementById("valor_plantao_3").value.replace(",",".",2));
				document.getElementById('remuneracao_total').value = Number(document.getElementById("valor_pago_plantao").value.replace(",",".",2)) + Number(document.getElementById("valor_pago_plantao_3").value.replace(",",".",2));
			}
		}

		function exibirProfissional3()
		{
			var x = document.getElementById('val2').checked;
			if(x == true){
				document.getElementById('cargos_rpa_id_3').disabled = false;
				document.getElementById('cargos_rpa_id_3').value 	= "";
				document.getElementById('mes_ano_3').disabled 	 	= false;
				document.getElementById('mes_ano_3').value 	 		= "";
				document.getElementById('mes_ano2_3').disabled 		= false;
				document.getElementById('mes_ano2_3').value 		= "";
				document.getElementById('valor_plantao_3').disabled = false;
				document.getElementById('valor_plantao_3').value 	= "";
				document.getElementById('quantidade_plantao_3').value = "";
				document.getElementById('valor_pago_plantao_3').value = "";
				document.getElementById('salario').value = Number(document.getElementById("valor_plantao").value.replace(",",".",2)) + Number(document.getElementById("valor_plantao_2").value.replace(",",".",2));
				document.getElementById('remuneracao_total').value = Number(document.getElementById("valor_pago_plantao").value.replace(",",".",2)) + Number(document.getElementById("valor_pago_plantao_2").value.replace(",",".",2));
			} else {
				document.getElementById('cargos_rpa_id_3').disabled = true;
				document.getElementById('cargos_rpa_id_3').value 	= "";
				document.getElementById('mes_ano_3').disabled 	    = true;
				document.getElementById('mes_ano_3').value 	 		= "";
				document.getElementById('mes_ano2_3').disabled 	    = true;
				document.getElementById('mes_ano2_3').value 		= "";
				document.getElementById('valor_plantao_3').disabled = true;
				document.getElementById('valor_plantao_3').value 	= "";
				document.getElementById('quantidade_plantao_3').value = "";
				document.getElementById('valor_pago_plantao_3').value = "";
				document.getElementById('salario').value = Number(document.getElementById("valor_plantao").value.replace(",",".",2)) + Number(document.getElementById("valor_plantao_2").value.replace(",",".",2));
				document.getElementById('remuneracao_total').value = Number(document.getElementById("valor_pago_plantao").value.replace(",",".",2)) + Number(document.getElementById("valor_pago_plantao_2").value.replace(",",".",2));
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
				  <form action="{{route('updateMPAdmissaoRPA', array($idMP, $idA))}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"> 	
					<center>
					<table class="table table-bordered table-sm"> 
						<tr>
						<td colspan="2"><center><strong><h5><br>Validar - Movimentação de Pessoal</h5></strong></center></td>
						<td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
						</tr>
						@foreach($mps as $mp)
						<tr>
						<td hidden><b><font size="2">Unidade:</font></b><input class="form-control form-control-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->id; ?>" title="{{ $unidade[0]->id }}" readonly /></td>
						<td><b><font size="2">Unidade:</font></b><input class="form-control form-control-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly /></td>
						<td hidden><input class="form-control form-control-sm" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" title="{{ $unidade[0]->nome }}" readonly /></td>
						<td><b><font size="2">Local de Trabalho:</font></b><input class="form-control form-control-sm" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly required /></td>
						<td><b><font size="2">Solicitante:</font></b><input readonly class="form-control form-control-sm" type="text" id="solicitante" name="solicitante" required value="<?php echo $mp->solicitante; ?>" title="{{ $mp->solicitante }}" /></td>
						</tr>
						<tr>
						<td><b><font size="2">Nome:</font></b><input class="form-control form-control-sm" type="text" id="nome" name="nome" value="<?php echo $mp->nome; ?>" title="{{ $mp->nome }}" required /></td>
						<td><b><font size="2">Matrícula:</font></b><input class="form-control form-control-sm" type="text" id="matricula" name="matricula" value="<?php echo $mp->matricula; ?>" title="{{ $mp->numeroMP }}" /></td>
						<td><b><font size="2">Gestor Imediato:</font></b> 
						<select id="gestor_id" name="gestor_id" class="form-control form-control-sm" readonly>
						<option id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->id; ?>">{{ $gestor[0]->nome }}</option>
						</select>
						</tr>
						<tr>
						<td><b><font size="2">Departamento:</font></b><input class="form-control form-control-sm" type="text" id="departamento"  name="departamento" value="<?php echo $mp->departamento; ?>" title="{{ $mp->departamento }}" required /></td>
						<td><b><font size="2">Número MP:</font></b><input class="form-control form-control-sm" type="text" id="numeroMP"  name="numeroMP" value="<?php echo $mp->numeroMP; ?>" readonly title="{{ $mp->departamento }}" required /></td>
						<td><b><font size="2">Data de Emissão:</font></b><input class="form-control form-control-sm" type="date" id="data_emissao" name="data_emissao" readonly value="<?php echo $mp->data_emissao; ?>" title="{{ $mp->data_emissao }}" required /></td>
						</tr>
					</table>
					</center>
					
					<center>
						<table class="table table-bordered table-sm" style="height: 10px;">
						<tr>  
						<td> 
							<center><b><font size="2">IMPACTO FINANCEIRO:</font></b>
							<?php if($mp->impacto_financeiro == "sim"){  ?>
							SIM: <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="sim" checked />
							NÃO: <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="nao" />  
							<?php } else if($mp->impacto_financeiro == "nao"){ ?>
							SIM: <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="sim" />
							NÃO: <input type="checkbox" checked id="impacto_financeiro" name="impacto_financeiro" value="nao" /> 
							<?php } ?>
							</center>
							</td>
						<td><center><b><font size="2">Data Prevista:</b></center></td>
						<td><input class="form-control form-control-sm" type="date" id="data_prevista" name="data_prevista" required value="<?php echo $mp->data_prevista; ?>" /></td>
						</tr>	
						</table>
					</center>
					@endforeach
					
					@if(!empty($admissaoRPA))
					@foreach($admissaoRPA as $adm)	
					<center>
					<table class="table table-bordered table-sm">
						<tr>
						<td rowspan="5">
						<center><h5><font size="2"><b>RPA</b></font></h5><input type="checkbox" id="tipo_mov1" name="tipo_mov1" checked readonly disabled /></center>
						</td>
						<td>
						<b><font size="2">Cargo:</font></b>
						<select class="form-control form-control-sm form-control form-control-sm-sm" id="cargo" name="cargo" required onchange="funcaoCargoSalario('sim')">
							<option id="cargo" name="cargo" value="">Selecione...</option>
							@if(!empty($cargos))	
								@foreach($cargos as $cargo)
								@if($adm->cargo == $cargo->nome)
									<option id="cargo" name="cargo" selected value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>	
								@else
									<option id="cargo" name="cargo" value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>	  
								@endif
								@endforeach
							@endif
							</select>
						<b><font size="2">Centro de Custo:</font></b>
						<select id="centro_custo" name="centro_custo" class="form-control form-control-sm" required>
							<option id="centro_custo" name="centro_custo" value="">Selecione...</option>
							@if(!empty($centro_custos))
							@foreach($centro_custos as $c_c)
							@if($adm->centro_custo == $c_c->nome)
							<option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>" selected>{{ $c_c->nome }}</option>
							@else
							<option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>">{{ $c_c->nome }}</option>	  
							@endif
							@endforeach
							@endif
						</select>
						</td>
						<td>
						<b><font size="2">Remuneração Total:</font></b>
						<input class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" required id="remuneracao_total" name="remuneracao_total" value="<?php echo $adm->valor_pago_plantao + $adm->valor_pago_plantao_2 + $adm->valor_pago_plantao_3; ?>" onchange="somarSalarios('sim')" disabled />
						<b><font size="2">Salário:</font></b>
						 <input disabled class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario" name="salario" value="<?php echo $adm->valor_plantao + $adm->valor_plantao_2 + $adm->valor_plantao_3; ?>" onchange="somarSalarios('sim')" />
						<b><font size="2">Outras Verbas:</font></b>
						 <input disabled class="form-control form-control-sm" id="outras_verbas" name="outras_verbas" value="<?php echo $adm->outras_verbas; ?>" />
						<td><b><font size="2">Horário de Trabalho:</font></b><br>
						<select class="form-control form-control-sm" id="horario_trabalho" name="horario_trabalho" required onchange="ativarOutra('sim')">
							<option id="horario_trabalho" name="horario_trabalho" value="">Selecione...</option>
							@if($adm->horario_trabalho == "07:00 as 16:00")
							<option id="horario_trabalho" selected name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
							@elseif($adm->horario_trabalho == "08:00 as 17:00")
							<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
							<option id="horario_trabalho" selected name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
							@elseif($adm->horario_trabalho == "07:00 as 19:00")
							<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
							<option id="horario_trabalho" selected name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
							@elseif($adm->horario_trabalho == "09:00 as 19:00")
							<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
							<option id="horario_trabalho" selected name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
							@else
							<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
							<option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
							<option id="horario_trabalho" selected name="horario_trabalho" value="0">Outro...</option>
							@endif
						</select>
						<font size="2"><b>Outro:</b></font>
						@if($adm->horario_trabalho != "07:00 as 16:00" && $adm->horario_trabalho != "08:00 as 17:00" && $adm->horario_trabalho != "07:00 as 19:00" && $adm->horario_trabalho != "09:00 as 19:00")
						<input class="form-control form-control-sm" type="text" id="horario_trabalho2" name="horario_trabalho2" value="<?php echo $adm->horario_trabalho; ?>" />	
						@else
						<input disabled class="form-control form-control-sm" type="text" id="horario_trabalho2" name="horario_trabalho2" value="{{ old('horario_trabalho2') }}" required/>	
						@endif
						</td>
						</tr>
						<tr>
						<td><b><font size="2">Escala de Trabalho:</font></b>
						<select id="escala_trabalho" name="escala_trabalho" class="form-control form-control-sm" onclick="desabilitarOutra('sim')" required>
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
							<option id="escala_trabalho" name="escala_trabalho" value="outra" selected> Outra: </option>
							@endif
						</select>			 
						<br> 
						@if($adm->escala_trabalho != "segxsex" || $adm->escala_trabalho != "12x36" || $adm->escala_trabalho != "12x60")
						<input type="text" id="escala_trabalho6" name="escala_trabalho6" class="form-control form-control-sm" value="<?php echo $adm->escala_trabalho; ?>" required /> 
						@else
						<input type="text" hidden id="escala_trabalho6" name="escala_trabalho6" class="form-control form-control-sm" value="{{ old('escala_trabalho6') }}" required /> 
						@endif
						</td> 
						<td><b><font size="2">Jornada:</font></b>
						<select class="form-control form-control-sm" id="jornada" name="jornada" required>
							<option id="jornada" name="jornada" value="">Selecione...</option>
							@if($adm->jornada == "diarista")
							<option id="jornada" name="jornada" value="diarista" selected>Diarista</option>
							<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
							<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
							<option id="jornada" name="jornada" value="semanal">Semanal</option>
							<option id="jornada" name="jornada" value="outra">Outra</option>
							@elseif($adm->jornada == "plantao_par")
							<option id="jornada" name="jornada" value="diarista">Diarista</option>
							<option id="jornada" name="jornada" value="plantao_par" selected>Plantão Par</option>
							<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
							<option id="jornada" name="jornada" value="semanal">Semanal</option>
							<option id="jornada" name="jornada" value="outra">Outra</option>
							@elseif($adm->jornada == "plantao_impar")
							<option id="jornada" name="jornada" value="diarista">Diarista</option>
							<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
							<option id="jornada" name="jornada" value="plantao_impar" selected>Plantão Ímpar</option>
							<option id="jornada" name="jornada" value="semanal">Semanal</option>
							<option id="jornada" name="jornada" value="outra">Outra</option>
							@elseif($adm->jornada == "semanal")
							<option id="jornada" name="jornada" value="diarista">Diarista</option>
							<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
							<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
							<option id="jornada" name="jornada" value="semanal" selected>Semanal</option>
							<option id="jornada" name="jornada" value="outra">Outra</option>
							@elseif($adm->jornada == "outra")
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
						</td>
						<td><b><font size="2">Turno:</font></b><br> 
						<select class="form-control form-control-sm" id="turno" name="turno" required>
						   @if($adm->turno == "dia")
							<option id="turno" name="turno" value=""> Selecione... </option>
							<option id="turno" name="turno" value="dia" selected> Dia </option>
							<option id="turno" name="turno" value="noite"> Noite</option>
						   @elseif($adm->turno == "noite")
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
						</tr>
						<tr>
						<td><b><font size="2">Contratação de Deficiente:</font></b><br> 
						<select id="possibilidade_contratacao" name="possibilidade_contratacao" class="form-control form-control-sm" required>
						  @if($adm->possibilidade_contratacao == "sim")
							<option id="possibilidade_contratacao" name="possibilidade_contratacao" value=""> Selecione... </option>	
							<option id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" selected> Sim </option>
							<option id="possibilidade_contratacao" name="possibilidade_contratacao" value="nao"> Não </option> 
						  @elseif($adm->possibilidade_contratacao == "nao")
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
						<td><b><font size="2">Necessidade de conta de e-mail:</font></b><br> 
						<select id="necessidade_email" name="necessidade_email" class="form-control form-control-sm" required>
						  @if($adm->necessidade_email == "sim")
							<option id="necessidade_email" name="necessidade_email" value=""> Selecione... </option>	
							<option id="necessidade_email" name="necessidade_email" value="sim" selected> Sim </option>
							<option id="necessidade_email" name="necessidade_email" value="nao"> Não </option> 
						  @elseif($adm->necessidade_email == "nao")
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
						<td><b><font size="2">Departamento:</font></b> 
						<select  class="form-control form-control-sm" id="departamento" name="departamento" required>
						  @foreach($setores as $setor)
							@if($adm->departamento == $setor->nome)
							<option id="departamento" name="departamento" value="<?php echo $setor->nome; ?>" selected>{{ $setor->nome }}</option>
							@else
							<option id="departamento" name="departamento" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>   
							@endif
						  @endforeach
						</select>
						</td>
					</tr>
						<tr>
						<td><b><font size="2">Substituído:</font></b>
						<input class="form-control form-control-sm" type="text" id="substituto" name="substituto" value="<?php echo $adm->substituto; ?>" />
						</td>
						<td><b><font size="2">Motivo:</font></b><br> 
						<select required  name="motivo" id="motivo" class="form-control form-control-sm" onchange="desabilitarSubst('sim')">	
							@if($adm->motivo == "aumento_quadro")  
							<option id="motivo" name="motivo" value="">Selecione..</option>
							<option id="motivo" name="motivo" value="aumento_quadro" selected>Aumento de Quadro</option>
							<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
							<option id="motivo" name="motivo" value="ferias">Férias</option>
							<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
							<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
							<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
							<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
							<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
							@elseif($adm->motivo == "atestado")  
							<option id="motivo" name="motivo" value="">Selecione..</option>
							<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
							<option id="motivo" name="motivo" value="atestado" selected>Atestado Médico</option>
							<option id="motivo" name="motivo" value="ferias">Férias</option>
							<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
							<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
							<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
							<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
							<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
							@elseif($adm->motivo == "ferias")  
							<option id="motivo" name="motivo" value="">Selecione..</option>
							<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
							<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
							<option id="motivo" name="motivo" value="ferias" selected>Férias</option>
							<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
							<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
							<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
							<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
							<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
							@elseif($adm->motivo == "licenca_maternidade")  
							<option id="motivo" name="motivo" value="">Selecione..</option>
							<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
							<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
							<option id="motivo" name="motivo" value="ferias">Férias</option>
							<option id="motivo" name="motivo" value="licenca_maternidade" selected>Licença Maternidade</option>
							<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
							<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
							<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
							<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
							@elseif($adm->motivo == "segundo_vinculo")  
							<option id="motivo" name="motivo" value="">Selecione..</option>
							<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
							<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
							<option id="motivo" name="motivo" value="ferias">Férias</option>
							<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
							<option id="motivo" name="motivo" value="segundo_vinculo" selected>Segundo Vínculo</option>
							<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
							<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
							<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
							@elseif($adm->motivo == "substituicao_temporaria")  
							<option id="motivo" name="motivo" value="">Selecione..</option>
							<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
							<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
							<option id="motivo" name="motivo" value="ferias">Férias</option>
							<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
							<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
							<option id="motivo" name="motivo" value="substituicao_temporaria" selected>Substituição Temporária</option>
							<option id="motivo" name="motivo" value="substituicao_definitiva">Substituição Definitiva</option>
							<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
							@elseif($adm->motivo == "substituicao_definitiva")  
							<option id="motivo" name="motivo" value="">Selecione..</option>
							<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
							<option id="motivo" name="motivo" value="atestado">Atestado Médico</option>
							<option id="motivo" name="motivo" value="ferias">Férias</option>
							<option id="motivo" name="motivo" value="licenca_maternidade">Licença Maternidade</option>
							<option id="motivo" name="motivo" value="segundo_vinculo">Segundo Vínculo</option>
							<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
							<option id="motivo" name="motivo" value="substituicao_definitiva" selected>Substituição Definitiva</option>
							<option id="motivo" name="motivo" value="outras">Outras (Informe na Justificativa)</option>
							@elseif($adm->motivo == "outras")  
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
						   </td>
						</tr>
						<tr>
					</table>
					</center>

					<center>
					<table class="table table-bordered table-sm">
					 <tr>
					   <td> 
						@if($adm->quantidade_plantao_2 != "")
						  Ativar Campo 2: <input type="checkbox" checked onclick="exibirProfissional2('sim')" id="val" name="val" />
						@else
						  Ativar Campo 2: <input type="checkbox" onclick="exibirProfissional2('sim')" id="val" name="val" />
						@endif
						@if($adm->quantidade_plantao_3 != "")
						  Ativar Campo 3: <input type="checkbox" checked onclick="exibirProfissional3('sim')" id="val2" name="val2" />
						@else
						  Ativar Campo 3: <input type="checkbox" onclick="exibirProfissional3('sim')" id="val2" name="val2" />
						@endif
					   </td>
					 </tr>
					 <tr>
					  <td><b><font size="2">Profissional:</font></b> 
						<select required class="form-control form-control-sm" id="cargos_rpa_id" name="cargos_rpa_id" onchange="funcaoCargoPlantao('sim')">
						 <option id="cargos_rpa_id" name="cargos_rpa_id" value="">Selecione...</option>
						 @if(!empty($cargos_rpa))	
						  @foreach($cargos_rpa as $cargoP)
							@if($adm->cargos_rpa_id == $cargoP->id)
							  @if($unidade[0]->id == 2)
								<option id="cargos_rpa_id" name="cargos_rpa_id" value="<?php echo $cargoP->id; ?>" selected>{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / {{ $cargoP->valor }}</option>	
						      @else
							    <option id="cargos_rpa_id" name="cargos_rpa_id" value="<?php echo $cargoP->id; ?>" selected>{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / </option>	
							  @endif
							@else
							  @if($unidade[0]->id == 2)	
								<option id="cargos_rpa_id" name="cargos_rpa_id" value="<?php echo $cargoP->id; ?>">{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / {{ $cargoP->valor }}</option>  
							  @else
								<option id="cargos_rpa_id" name="cargos_rpa_id" value="<?php echo $cargoP->id; ?>">{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / </option>  
							  @endif
							@endif					  
						  @endforeach
						 @endif
						</select>
						</td>
					  <td colspan="1"><font size="2"><b> Período: </b></font><br> 
						<input class="form-control form-control-sm" type="date" id="mes_ano" name="mes_ano" style="width: 140px;" required onchange="handler(event);" value="<?php echo date('Y-m-d', strtotime($adm->periodo_inicio)); ?>" /> 
					  </td>
					  <td><b><font size="2">Até:</font></b>
						<input class="form-control form-control-sm" type="date" id="mes_ano2" name="mes_ano2" style="width: 140px;" required onchange="handler(event);" value="<?php echo date('Y-m-d', strtotime($adm->periodo_fim)); ?>" />
						<input hidden type="text" id="qtdDias" name="qtdDias" readonly class="form-control form-control-sm" value="<?php echo $adm->qtdDias; ?>" />
				   	  </td>
					  <td><b><font size="2">Quantidade:</font></b>
						 <input required readonly class="form-control form-control-sm" id="quantidade_plantao" name="quantidade_plantao" onChange="multiplicar();" value="<?php echo $adm->qtdDias; ?>">
					  </td>
					  <td><b><font size="2">Valor:</font></b>
							<input class="form-control form-control-sm" required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="valor_plantao" name="valor_plantao" value="<?php echo $adm->valor_plantao; ?>" onChange="multiplicar();" />
					  </td>
					  <td><b><font size="2">Valor a ser Pago:</font></b>
							<input class="form-control form-control-sm" title="(Quantidade * Valor)" readonly placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="valor_pago_plantao" name="valor_pago_plantao" value="<?php echo $adm->valor_pago_plantao; ?>" />
					  </td>
					 </tr>
					 @if($adm->cargos_rpa_id_2)
					 <tr>
					  <td><b><font size="2">Profissional:</font></b> 
						<select required class="form-control form-control-sm" id="cargos_rpa_id_2" name="cargos_rpa_id_2" onchange="funcaoCargoPlantao2('sim')">
						 <option id="cargos_rpa_id_2" name="cargos_rpa_id_2" value="">Selecione...</option>
						 @if(!empty($cargos_rpa))	
						  @foreach($cargos_rpa as $cargoP)
							@if($adm->cargos_rpa_id_2 == $cargoP->id)
							  @if($unidade[0]->id == 2)
								<option id="cargos_rpa_id_2" name="cargos_rpa_id_2" value="<?php echo $cargoP->id; ?>" selected>{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / {{ $cargoP->valor }}</option>	
						      @else
							    <option id="cargos_rpa_id_2" name="cargos_rpa_id_2" value="<?php echo $cargoP->id; ?>" selected>{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / </option>	
							  @endif
							@else
							  @if($unidade[0]->id == 2)	
								<option id="cargos_rpa_id_2" name="cargos_rpa_id_2" value="<?php echo $cargoP->id; ?>">{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / {{ $cargoP->valor }}</option>  
							  @else
								<option id="cargos_rpa_id_2" name="cargos_rpa_id_2" value="<?php echo $cargoP->id; ?>">{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / </option>  
							  @endif
							@endif					  
						  @endforeach
						 @endif
						</select>
						</td>
					  <td colspan="1"><font size="2"><b> Período: </b></font><br> 
						<input class="form-control form-control-sm" type="date" id="mes_ano_2" name="mes_ano_2" style="width: 140px;" required onchange="handler2_1(event);" value="<?php echo date('Y-m-d', strtotime($adm->periodo_inicio_2)); ?>" /> 
					  </td>
					  <td><b><font size="2">Até:</font></b>
						<input class="form-control form-control-sm" type="date" id="mes_ano2_2" name="mes_ano2_2" style="width: 140px;" required onchange="handler2_1(event);" value="<?php echo date('Y-m-d', strtotime($adm->periodo_fim_2)); ?>" />
						<input hidden type="text" id="qtdDias_2" name="qtdDias_2" readonly class="form-control form-control-sm" value="<?php echo $adm->quantidade_plantao_2; ?>" />
				   	  </td>
					  <td><b><font size="2">Quantidade:</font></b>
						 <input required readonly class="form-control form-control-sm" id="quantidade_plantao_2" name="quantidade_plantao_2" onChange="multiplicar2();" value="<?php echo $adm->quantidade_plantao_2; ?>">
					  </td>
					  <td><b><font size="2">Valor:</font></b>
							<input class="form-control form-control-sm" required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="valor_plantao_2" name="valor_plantao_2" value="<?php echo $adm->valor_plantao_2; ?>" onChange="multiplicar2();" />
					  </td>
					  <td><b><font size="2">Valor a ser Pago:</font></b>
							<input class="form-control form-control-sm" title="(Quantidade * Valor)" readonly placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="valor_pago_plantao_2" name="valor_pago_plantao_2" value="<?php echo $adm->valor_pago_plantao_2; ?>" />
					  </td>
					 </tr>
					 @else
					 <tr>
					  <td><b><font size="2">Profissional:</font></b> 
						<select disabled required class="form-control form-control-sm" id="cargos_rpa_id_2" name="cargos_rpa_id_2" onchange="funcaoCargoPlantao2('sim')">
						 <option id="cargos_rpa_id_2" name="cargos_rpa_id_2" value="">Selecione...</option>
						 @if(!empty($cargos_rpa))	
						  @foreach($cargos_rpa as $cargoP)
							@if($adm->cargos_rpa_id_2 == $cargoP->id)
							  @if($unidade[0]->id == 2)
								<option id="cargos_rpa_id_2" name="cargos_rpa_id_2" value="<?php echo $cargoP->id; ?>" selected>{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / {{ $cargoP->valor }}</option>	
						      @else
							    <option id="cargos_rpa_id_2" name="cargos_rpa_id_2" value="<?php echo $cargoP->id; ?>" selected>{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / </option>	
							  @endif
							@else
							  @if($unidade[0]->id == 2)	
								<option id="cargos_rpa_id_2" name="cargos_rpa_id_2" value="<?php echo $cargoP->id; ?>">{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / {{ $cargoP->valor }}</option>  
							  @else
								<option id="cargos_rpa_id_2" name="cargos_rpa_id_2" value="<?php echo $cargoP->id; ?>">{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / </option>  
							  @endif
							@endif					  
						  @endforeach
						 @endif
						</select>
						</td>
					  <td colspan="1"><font size="2"><b> Período: </b></font><br> 
						<input disabled class="form-control form-control-sm" type="date" id="mes_ano_2" name="mes_ano_2" style="width: 140px;" required onchange="handler2_1(event);" value="<?php echo date('Y-m-d', strtotime($adm->periodo_inicio_2)); ?>" /> 
					  </td>
					  <td><b><font size="2">Até:</font></b>
						<input disabled class="form-control form-control-sm" type="date" id="mes_ano2_2" name="mes_ano2_2" style="width: 140px;" required onchange="handler2_1(event);" value="<?php echo date('Y-m-d', strtotime($adm->periodo_fim_2)); ?>" />
						<input hidden type="text" id="qtdDias_2" name="qtdDias_2" readonly class="form-control form-control-sm" value="<?php echo $adm->quantidade_plantao_2; ?>" />
				   	  </td>
					  <td><b><font size="2">Quantidade:</font></b>
						<input required readonly class="form-control form-control-sm" id="quantidade_plantao_2" name="quantidade_plantao_2" onChange="multiplicar2();" value="<?php echo $adm->quantidade_plantao_2; ?>">
					  </td>
					  <td><b><font size="2">Valor:</font></b>
						<input disabled class="form-control form-control-sm" required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="valor_plantao_2" name="valor_plantao_2" value="<?php echo $adm->valor_plantao_2; ?>" onChange="multiplicar2();" />
					  </td>
					  <td><b><font size="2">Valor a ser Pago:</font></b>
						<input class="form-control form-control-sm" title="(Quantidade * Valor)" readonly placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="valor_pago_plantao_2" name="valor_pago_plantao_2" value="<?php echo $adm->valor_pago_plantao_2; ?>" />
					  </td>
					 </tr>
					 @endif
					 @if($adm->cargos_rpa_id_3)
					 <tr>
					  <td><b><font size="2">Profissional:</font></b> 
						<select required class="form-control form-control-sm" id="cargos_rpa_id_3" name="cargos_rpa_id_3" onchange="funcaoCargoPlantao3('sim')">
						 <option id="cargos_rpa_id_3" name="cargos_rpa_id_3" value="">Selecione...</option>
						 @if(!empty($cargos_rpa))	
						  @foreach($cargos_rpa as $cargoP)
							@if($adm->cargos_rpa_id_3 == $cargoP->id)
							  @if($unidade[0]->id == 3)
								<option id="cargos_rpa_id_3" name="cargos_rpa_id_3" value="<?php echo $cargoP->id; ?>" selected>{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / {{ $cargoP->valor }}</option>	
						      @else
							    <option id="cargos_rpa_id_3" name="cargos_rpa_id_3" value="<?php echo $cargoP->id; ?>" selected>{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / </option>	
							  @endif
							@else
							  @if($unidade[0]->id == 3)	
								<option id="cargos_rpa_id_3" name="cargos_rpa_id_3" value="<?php echo $cargoP->id; ?>">{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / {{ $cargoP->valor }}</option>  
							  @else
								<option id="cargos_rpa_id_3" name="cargos_rpa_id_3" value="<?php echo $cargoP->id; ?>">{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / </option>  
							  @endif
							@endif					  
						  @endforeach
						 @endif
						</select>
						</td>
					  <td colspan="1"><font size="2"><b> Período: </b></font><br> 
						<input class="form-control form-control-sm" type="date" id="mes_ano_3" name="mes_ano_3" style="width: 140px;" required onchange="handler3(event);" value="<?php echo date('Y-m-d', strtotime($adm->periodo_inicio_3)); ?>" /> 
					  </td>
					  <td><b><font size="2">Até:</font></b>
						<input class="form-control form-control-sm" type="date" id="mes_ano2_3" name="mes_ano2_3" style="width: 140px;" required onchange="handler3(event);" value="<?php echo date('Y-m-d', strtotime($adm->periodo_fim_3)); ?>" />
						<input hidden type="text" id="qtdDias_3" name="qtdDias_3" readonly class="form-control form-control-sm" value="<?php echo $adm->quantidade_plantao_3; ?>" />
				   	  </td>
					  <td><b><font size="2">Quantidade:</font></b>
						 <input required readonly class="form-control form-control-sm" id="quantidade_plantao_3" name="quantidade_plantao_3" onChange="multiplicar3();" value="<?php echo $adm->quantidade_plantao_3; ?>">
					  </td>
					  <td><b><font size="2">Valor:</font></b>
							<input class="form-control form-control-sm" required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="valor_plantao_3" name="valor_plantao_3" value="<?php echo $adm->valor_plantao_3; ?>" onChange="multiplicar3();" />
					  </td>
					  <td><b><font size="2">Valor a ser Pago:</font></b>
							<input class="form-control form-control-sm" title="(Quantidade * Valor)" readonly placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="valor_pago_plantao_3" name="valor_pago_plantao_3" value="<?php echo $adm->valor_pago_plantao_3; ?>" />
					  </td>
					 </tr>
					 @else
					 <tr>
					  <td><b><font size="2">Profissional:</font></b> 
						<select disabled required class="form-control form-control-sm" id="cargos_rpa_id_3" name="cargos_rpa_id_3" onchange="funcaoCargoPlantao3('sim')">
						 <option id="cargos_rpa_id_3" name="cargos_rpa_id_3" value="">Selecione...</option>
						 @if(!empty($cargos_rpa))	
						  @foreach($cargos_rpa as $cargoP)
							@if($adm->cargos_rpa_id_3 == $cargoP->id)
							  @if($unidade[0]->id == 3)
								<option id="cargos_rpa_id_3" name="cargos_rpa_id_3" value="<?php echo $cargoP->id; ?>" selected>{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / {{ $cargoP->valor }}</option>	
						      @else
							    <option id="cargos_rpa_id_3" name="cargos_rpa_id_3" value="<?php echo $cargoP->id; ?>" selected>{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / </option>	
							  @endif
							@else
							  @if($unidade[0]->id == 3)	
								<option id="cargos_rpa_id_3" name="cargos_rpa_id_3" value="<?php echo $cargoP->id; ?>">{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / {{ $cargoP->valor }}</option>  
							  @else
								<option id="cargos_rpa_id_3" name="cargos_rpa_id_3" value="<?php echo $cargoP->id; ?>">{{ $cargoP->cargo }} - {{ $cargoP->tipo }} / </option>  
							  @endif
							@endif					  
						  @endforeach
						 @endif
						</select>
						</td>
					  <td colspan="1"><font size="2"><b> Período: </b></font><br> 
						<input disabled class="form-control form-control-sm" type="date" id="mes_ano_3" name="mes_ano_3" style="width: 140px;" required onchange="handler3(event);" value="<?php echo date('Y-m-d', strtotime($adm->periodo_inicio_3)); ?>" /> 
					  </td>
					  <td><b><font size="2">Até:</font></b>
						<input disabled class="form-control form-control-sm" type="date" id="mes_ano2_3" name="mes_ano2_3" style="width: 140px;" required onchange="handler3(event);" value="<?php echo date('Y-m-d', strtotime($adm->periodo_fim_3)); ?>" />
						<input hidden type="text" id="qtdDias_3" name="qtdDias_3" readonly class="form-control form-control-sm" value="<?php echo $adm->quantidade_plantao_3; ?>" />
				   	  </td>
					  <td><b><font size="2">Quantidade:</font></b>
						<input required readonly class="form-control form-control-sm" id="quantidade_plantao_3" name="quantidade_plantao_3" onChange="multiplicar3();" value="<?php echo $adm->quantidade_plantao_3; ?>">
					  </td>
					  <td><b><font size="2">Valor:</font></b>
						<input disabled class="form-control form-control-sm" required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="valor_plantao_3" name="valor_plantao_3" value="<?php echo $adm->valor_plantao_3; ?>" onChange="multiplicar3();" />
					  </td>
					  <td><b><font size="2">Valor a ser Pago:</font></b>
						<input class="form-control form-control-sm" title="(Quantidade * Valor)" readonly placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="valor_pago_plantao_3" name="valor_pago_plantao_3" value="<?php echo $adm->valor_pago_plantao_3; ?>" />
					  </td>
					 </tr>				
					 @endif
					</table>
					</center>
					@endforeach	 
					@endif

					<center>		
					<table class="table table-bordered" style="height: 10px;">
					<tr>
						<td width="180"><strong><h5><font size="2"><b>Informações Adicionais:</b></font></h5></strong></td>
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