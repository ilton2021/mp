<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Movimentação de Pessoal - Cadastro MP Alteração Funcional</title>
  <link rel="stylesheet" href="{{ asset('css/appCadastrosMP.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
  <script type="text/javascript">

		function subtrai(){
			m1 = document.getElementById("salario_atual").value;
			m2 = document.getElementById("salario_novo").value;
			r  = parseInt(m2 - m1);
			document.getElementById("renda_var").value = r;
		}
		
		function desabilitarSal(valor) {
		  var status = document.getElementById('remuneracao').checked;
		  if (status == true) {
			document.getElementById('salario_novo').disabled   = false;
		  } else {
			document.getElementById('salario_novo').disabled   = true;
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
				  <form action="{{\Request::route('storeAlteracaoMP'), $unidade[0]->id}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<center>
						<table class="table table-bordered table-sm" style="height: 10px;"> 
							<tr>
							<td colspan="2"><center><strong><h5><br>Movimentação de Pessoal - Alteração Funcional</h5></strong></center></td>
							<td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="mp_id" name="mp_id" value="" readonly="true" /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="concluida" name="concluida" value="" readonly="true" /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="aprovada" name="aprovada" value="0" readonly="true" /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="ordem" name="ordem" value="" readonly="true" /></td>
							</tr>
							<tr>
							<td><b><font size="2">Unidade:</font></b><input class="form-control form-control-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
							<td hidden><input class="form-control form-control-sm" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
							<td><b><font size="2">Local de Trabalho:</font></b>
							<select class="form-control form-control-sm" id="local_trabalho" name="local_trabalho">
								<option id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->id ?>">{{ $unidade[0]->nome }}</option>
							</select>
							</td>
							<td><b><font size="2">Solicitante:</font></b><input readonly="true" class="form-control form-control-sm" type="text" id="solicitante" name="solicitante" required value="<?php echo Auth::user()->name; ?>" /></td>
							</tr>
							<tr>
							<td hidden><b><font size="2">Número do MP:</font></b><input class="form-control form-control-sm" type="text" id="numeroMP" name="numeroMP" value="" /> </td>
							<td colspan="1"><b><font size="2">Nome:</font></b><input class="form-control form-control-sm" type="text" id="nome" name="nome" required="true" value="{{ Request::old('nome') }}" /></td>
							<td><b><font size="2">Matrícula:</font></b><input class="form-control form-control-sm" type="text" id="matricula" name="matricula" value="{{Request::old('matricula')}}" /> </td>
							<td><b><font size="2">Gestor Imediato:</font></b> 
							<select id="gestor_id" name="gestor_id" class="form-control form-control-sm">
							@if(!empty($gestores))
							@foreach($gestores as $gestor)
								<option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id ?>" selected>{{ $gestor->nome }}</option>
							@endforeach
							@endif
							</select>
							</tr>
							<tr>
							<td><b><font size="2">Departamento:</font></b><input class="form-control form-control-sm" type="text" id="departamento" name="departamento" value="{{ old('departamento') }}" required /></td>
							<td><b><font size="2">Data de Emissão:</font></b><input class="form-control form-control-sm  form-control form-control-sm-sm" type="date" id="data_emissao" name="data_emissao" value="<?php echo date('Y-m-d',strtotime('now')); ?>" readonly="true" /></td>
							<td><b><font size="2">Data Prevista:</font></b><input class="form-control form-control-sm  form-control form-control-sm-sm" type="date" id="data_prevista" name="data_prevista" required value="{{ Request::old('data_prevista') }}" onchange="handler2(event);" /></td>
							</tr>
						</table>
						</center>
						
						<center>
							<table class="table table-bordered table-sm" style="height: 10px;">
							<tr>  
							<td> <center><b><font size="2">IMPACTO FINANCEIRO:</font></b>
								@if(old('impacto_financeiro') == "sim")
									<font size="2">SIM:</font> <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="sim" checked /> 
									<font size="2">NÃO:</font> <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="nao" /> 
								@elseif(old('impacto_financeiro') == "nao")
									<font size="2">SIM:</font> <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="sim" /> 
									<font size="2">NÃO:</font> <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="nao" checked />
								@else
									<font size="2">SIM:</font> <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="sim" /> 
									<font size="2">NÃO:</font> <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="nao" />
								@endif 
								</center>
								</td>
							</tr>	
							</table>
						</center>
						<center>
						<table class="table table-bordered table-sm">
						<tr>
							<td><b><font size="2">Transferência proposta: Indique a Unidade</font></b> 
							<select required id="unidade_id2" name="unidade_id2" class="form-control form-control-sm">
							<option id="unidade_id2" name="unidade_id2" value="">Selecione..</option> 
							@foreach($unidades as $unidade)
							@if(old('unidade_id2') == $unidade->nome)
								<option id="unidade_id2" name="unidade_id2" selected>{{ $unidade->nome }}</option>
							@else
								<option id="unidade_id2" name="unidade_id2">{{ $unidade->nome }}</option>   
							@endif
							@endforeach
							</select>
							<td colspan="1"><b><font size="2">Departamento Proposto:</font></b> 
							<select required class="form-control form-control-sm" id="setor" name="setor">
							<option id="setor" name="setor" value="">Selecione...</option>
							@foreach($setores as $setor)
								@if(old('setor') == $setor->nome)
								<option id="setor" name="setor" value="<?php echo $setor->nome; ?>" selected>{{ $setor->nome }}</option>
								@else
								<option id="setor" name="setor" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>   
								@endif
							@endforeach
							</select>
							</td>
							</td>
							<td><b><font size="2">Novo Centro de Custo:</font></b> 
							<select required name="centro_custo_novo" id="centro_custo_novo" class="form-control form-control-sm">	
							<option id="centro_custo_novo" name="centro_custo_novo" value="">Selecione...</option>
								@foreach($centro_custo_nv as $cc_nv)
								@if(old('centro_custo_novo') == $cc_nv->nome)
								<option id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $cc_nv->nome; ?>" selected>{{ $cc_nv->nome }}</option>
								@else
								<option id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $cc_nv->nome; ?>">{{ $cc_nv->nome }}</option>	
								@endif
								@endforeach
							</select>
							</td>
						</tr>
						<tr>
							<td><b><font size="2">Cargo Atual:</font></b> 
							<select required class="form-control form-control-sm" id="cargo_atual" name="cargo_atual">
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
							</td>
							<td><b><font size="2">Cargo Proposto:</font></b> 
							<select required class="form-control form-control-sm" id="cargo_novo" name="cargo_novo">
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
							</td>
							<td><b><font size="2">Novo Horário de Trabalho:</font></b> 
							<input class="form-control form-control-sm" required type="text" id="horario_novo" name="horario_novo" value="{{ old('horario_novo') }}" />
							</td>
						</tr>
						<tr>
							<td><b><font size="2">Existe Alteração de Remuneração:</font></b>
							<font size="2">SIM:</font>&nbsp;<input onclick="desabilitarSal('sim')" type="checkbox" id="remuneracao" name="remuneracao" />
							</td>
						</tr>
						<tr>
							<td><b><font size="2">Salário Atual:</font></b> 
							<input required class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_atual" onChange="subtrai();"  name="salario_atual" value="{{ old('salario_atual') }}" />
							</td>
							<td><b><font size="2">Salário Proposto:</font></b> 
							<input required class="form-control form-control-sm" disabled placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_novo" onChange="subtrai();"  name="salario_novo" value="{{ old('salario_novo') }}" />	
							</td>
							<td><b><font size="2">Diferença Salarial:</font></b>
							<input required class="form-control form-control-sm" readonly="true" placeholder="ex: 2500 ou 2580,21"  type="text" id="renda_var" name="renda_var" value="{{ old('renda_var') }}" />	
						</tr>
						<tr>
							<td><b><font size="2">Outras Verbas:</font></b>
							<input required class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="gratificacoes" name="gratificacoes" value="{{ old('gratificacoes') }}" />	
							</td>
							<td colspan="2"><b><font size="2">Motivo:</font></b><br> 
							<select class="form-control form-control-sm" id="motivo" name="motivo" required> 
								@if(old('motivo') == "promocao")  
								<option id="motivo" name="motivo" value="promocao" selected> Promoção  </option>
								<option id="motivo" name="motivo" value="merito"> Mérito </option>
								<option id="motivo" name="mudanca_setor_area" value="mudanca_setor_area"> Mudança de Setor/Área  </option>
								<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
								<option id="motivo" name="motivo" value="enquadramento"> Enquadramento  </option>
								<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
								<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria"> Substituição por demissão voluntária </option>
								<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno  </option>
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="empregado"> Empregado  </option>  
								<option id="motivo" name="motivo" value="empregador"> Empregador </option>
								@elseif(old('motivo') == "merito")  
								<option id="motivo" name="motivo" value="promocao"> Promoção  </option>
								<option id="motivo" name="motivo" value="merito" selected> Mérito </option>
								<option id="motivo" name="mudanca_setor_area" value="mudanca_setor_area"> Mudança de Setor/Área  </option>
								<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
								<option id="motivo" name="motivo" value="enquadramento"> Enquadramento  </option>
								<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
								<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria"> Substituição por demissão voluntária </option>
								<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno  </option>
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="empregado"> Empregado  </option>  
								<option id="motivo" name="motivo" value="empregador"> Empregador </option>
								@elseif(old('motivo') == "mudanca_setor_area")  
								<option id="motivo" name="motivo" value="promocao"> Promoção  </option>
								<option id="motivo" name="motivo" value="merito"> Mérito </option>
								<option id="motivo" name="mudanca_setor_area" value="mudanca_setor_area" selected> Mudança de Setor/Área  </option>
								<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
								<option id="motivo" name="motivo" value="enquadramento"> Enquadramento  </option>
								<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
								<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria"> Substituição por demissão voluntária </option>
								<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno  </option>
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="empregado"> Empregado  </option>  
								<option id="motivo" name="motivo" value="empregador"> Empregador </option>
								@elseif(old('motivo') == "transferencia_outra_unidade")  
								<option id="motivo" name="motivo" value="promocao"> Promoção  </option>
								<option id="motivo" name="motivo" value="merito"> Mérito </option>
								<option id="motivo" name="mudanca_setor_area" value="mudanca_setor_area"> Mudança de Setor/Área  </option>
								<option id="motivo" name="motivo" value="transferencia_outra_unidade" selected> Transferência para outra unidade </option>
								<option id="motivo" name="motivo" value="enquadramento"> Enquadramento  </option>
								<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
								<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria"> Substituição por demissão voluntária </option>
								<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno  </option>
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="empregado"> Empregado  </option>  
								<option id="motivo" name="motivo" value="empregador"> Empregador </option>
								@elseif(old('motivo') == "enquadramento")  
								<option id="motivo" name="motivo" value="promocao"> Promoção  </option>
								<option id="motivo" name="motivo" value="merito"> Mérito </option>
								<option id="motivo" name="mudanca_setor_area" value="mudanca_setor_area"> Mudança de Setor/Área  </option>
								<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
								<option id="motivo" name="motivo" value="enquadramento" selected> Enquadramento  </option>
								<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
								<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria"> Substituição por demissão voluntária </option>
								<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno  </option>
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="empregado"> Empregado  </option>  
								<option id="motivo" name="motivo" value="empregador"> Empregador </option>
								@elseif(old('motivo') == "mudanca_horaria")  
								<option id="motivo" name="motivo" value="promocao"> Promoção  </option>
								<option id="motivo" name="motivo" value="merito"> Mérito </option>
								<option id="motivo" name="mudanca_setor_area" value="mudanca_setor_area"> Mudança de Setor/Área  </option>
								<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
								<option id="motivo" name="motivo" value="enquadramento"> Enquadramento  </option>
								<option id="motivo" name="motivo" value="mudanca_horaria" selected> Mudança de Horário </option>
								<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria"> Substituição por demissão voluntária </option>
								<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno  </option>
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="empregado"> Empregado  </option>  
								<option id="motivo" name="motivo" value="empregador"> Empregador </option>
								@elseif(old('motivo') == "substituicao_demissao_voluntaria")  
								<option id="motivo" name="motivo" value="promocao"> Promoção  </option>
								<option id="motivo" name="motivo" value="merito"> Mérito </option>
								<option id="motivo" name="mudanca_setor_area" value="mudanca_setor_area"> Mudança de Setor/Área  </option>
								<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
								<option id="motivo" name="motivo" value="enquadramento"> Enquadramento  </option>
								<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
								<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria" selected> Substituição por demissão voluntária </option>
								<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno  </option>
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="empregado"> Empregado  </option>  
								<option id="motivo" name="motivo" value="empregador"> Empregador </option>
								@elseif(old('motivo') == "recrutamento_interno")  
								<option id="motivo" name="motivo" value="promocao"> Promoção  </option>
								<option id="motivo" name="motivo" value="merito"> Mérito </option>
								<option id="motivo" name="mudanca_setor_area" value="mudanca_setor_area"> Mudança de Setor/Área  </option>
								<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
								<option id="motivo" name="motivo" value="enquadramento"> Enquadramento  </option>
								<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
								<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria"> Substituição por demissão voluntária </option>
								<option id="motivo" name="motivo" value="recrutamento_interno" selected> Recrutamento Interno  </option>
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="empregado"> Empregado  </option>  
								<option id="motivo" name="motivo" value="empregador"> Empregador </option>
								@elseif(old('motivo') == "aumento_quadro")  
								<option id="motivo" name="motivo" value="promocao"> Promoção  </option>
								<option id="motivo" name="motivo" value="merito"> Mérito </option>
								<option id="motivo" name="mudanca_setor_area" value="mudanca_setor_area"> Mudança de Setor/Área  </option>
								<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
								<option id="motivo" name="motivo" value="enquadramento"> Enquadramento  </option>
								<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
								<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria"> Substituição por demissão voluntária </option>
								<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno  </option>
								<option id="motivo" name="motivo" value="aumento_quadro" selected> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="empregado"> Empregado  </option>  
								<option id="motivo" name="motivo" value="empregador"> Empregador </option>
								@elseif(old('motivo') == "empregado")  
								<option id="motivo" name="motivo" value="promocao"> Promoção  </option>
								<option id="motivo" name="motivo" value="merito"> Mérito </option>
								<option id="motivo" name="mudanca_setor_area" value="mudanca_setor_area"> Mudança de Setor/Área  </option>
								<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
								<option id="motivo" name="motivo" value="enquadramento"> Enquadramento  </option>
								<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
								<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria"> Substituição por demissão voluntária </option>
								<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno  </option>
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="empregado" selected> Empregado  </option>  
								<option id="motivo" name="motivo" value="empregador"> Empregador </option>
								@elseif(old('motivo') == "empregador")  
								<option id="motivo" name="motivo" value="promocao"> Promoção  </option>
								<option id="motivo" name="motivo" value="merito"> Mérito </option>
								<option id="motivo" name="mudanca_setor_area" value="mudanca_setor_area"> Mudança de Setor/Área  </option>
								<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
								<option id="motivo" name="motivo" value="enquadramento"> Enquadramento  </option>
								<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
								<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria"> Substituição por demissão voluntária </option>
								<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno  </option>
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="empregado"> Empregado  </option>  
								<option id="motivo" name="motivo" value="empregador" selected> Empregador </option>
								@else
								<option id="motivo" name="motivo" value="">Selecione...</option>
								<option id="motivo" name="motivo" value="promocao"> Promoção  </option>
								<option id="motivo" name="motivo" value="merito"> Mérito </option>
								<option id="motivo" name="mudanca_setor_area" value="mudanca_setor_area"> Mudança de Setor/Área  </option>
								<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
								<option id="motivo" name="motivo" value="enquadramento"> Enquadramento  </option>
								<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
								<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria"> Substituição por demissão voluntária </option>
								<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno  </option>
								<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
								<option id="motivo" name="motivo" value="empregado"> Empregado  </option>  
								<option id="motivo" name="motivo" value="empregador"> Empregador </option>
								@endif
							</select>
							</td>
						</tr>
						</table>
						</center>

						<center>		
						<table class="table table-bordered table-sm" style="height: 10px;">
						<tr>
							<td width="160"><strong><font size="2">Informações Adicionais:</font></strong></td>
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
						@if($unidades[0]->id == 2)
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