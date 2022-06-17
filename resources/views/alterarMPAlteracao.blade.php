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
				  <form action="{{route('updateMPAlteracao', array($idMP, $idA))}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
					<center>
					<table class="table table-bordered table-sm" style="height: 10px;"> 
						<tr>
						<td colspan="2"><center><strong><h5><br>Alterar - Movimentação de Pessoal</h5></strong></center></td>
						<td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
						</tr>
						@foreach($mps as $mp)
						<tr>
						<td><b><font size="2">Unidade:</font></b><input class="form-control form-control-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly /></td>
						<td hidden><input class="form-control form-control-sm" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" title="{{ $unidade[0]->id }}" readonly /></td>
						<td><b><font size="2">Local de Trabalho:</font></b><input class="form-control form-control-sm" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->id; ?>" title="{{ $unidade[0]->nome }}" readonly required /></td>
						<td><b><font size="2">Solicitante:</font></b><input readonly class="form-control form-control-sm" type="text" id="solicitante" name="solicitante" required value="<?php echo $mp->solicitante; ?>" title="{{ $mp->solicitante }}" /></td>
						</tr>
						<tr>
						<td><b><font size="2">Nome:</font></b><input class="form-control form-control-sm" type="text" id="nome" name="nome" value="<?php echo $mp->nome; ?>" title="{{ $mp->nome }}" required /></td>
						<td><b><font size="2">Matrícula:</font></b><input class="form-control form-control-sm" type="text" id="matricula" name="matricula" value="<?php echo $mp->matricula; ?>" title="{{ $mp->numeroMP }}" /></td>
						<td><b><font size="2">Gestor Imediato:</font></b> 
						<select id="gestor_id" name="gestor_id" class="form-control form-control-sm" readonly disabled>
						<option id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->id ?>" title="{{ $gestor[0]->nome }}">{{ $gestor[0]->nome }}</option>
						</select>
						</tr>
						<tr>
						<td colspan="1"><b><font size="2">Departamento:</font></b><input class="form-control form-control-sm" type="text" id="departamento" name="departamento" value="<?php echo $mp->departamento; ?>" title="{{ $mp->departamento }}" required /></td>
						<td><b><font size="2">Número MP:</font></b><input class="form-control form-control-sm" type="text" id="numeroMP" name="numeroMP" value="<?php echo $mp->numeroMP; ?>" title="{{ $mp->numeroMP }}" required readonly /></td>
						<td><b><font size="2">Data de Emissão:</font></b><input class="form-control form-control-sm" type="date" id="data_emissao" name="data_emissao" readonly value="<?php echo $mp->data_emissao; ?>" title="{{ $mp->data_emissao }}" required /></td>
						</tr>
					</table>
					</center>
					
					<center>
						<table class="table table-bordered table-sm" style="height: 10px;">
						<tr>  
						<td> <center><b><font size="2">IMPACTO FINANCEIRO:</font></b>
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
						<td><input class="form-control form-control-sm" type="date" id="data_prevista" name="data_prevista" required value="<?php echo $mp->data_prevista; ?>" onchange="handler2(event);" /></td>
						</tr>	
						</table>
					</center>
					@endforeach
			
					@if(!empty($alteracaoF))
					@foreach($alteracaoF as $altF)	 
					<center>
					<table class="table table-bordered table-sm">
					<tr>
						<td rowspan="5"><center><h5><font size="2"><b>Alteração Funcional</b></font></h5><input type="checkbox" id="tipo_mov3" name="tipo_mov3" checked disabled /></center>
						<td><b><font size="2">Transferência proposta: Indique a Unidade</font></b> 
						<select id="unidade_id" name="unidade_id" class="form-control form-control-sm" disabled >
						@foreach($unidades as $unidade)
							@if($altF->unidade_id == 1)
							<option id="unidade_id" name="unidade_id" value="<?php echo $altF->unidade_id; ?>">{{ "HCP GESTÃO" }}</option>	
							@elseif($altF->unidade_id == 2)
							<option id="unidade_id" name="unidade_id" value="<?php echo $altF->unidade_id; ?>">{{ "Hospital da Mulher do Recife" }}</option>
							@elseif($altF->unidade_id == 3)
							<option id="unidade_id" name="unidade_id" value="<?php echo $altF->unidade_id; ?>">{{ "UPAE BELO JARDIM" }}</option>
							@elseif($altF->unidade_id == 4)
							<option id="unidade_id" name="unidade_id" value="<?php echo $altF->unidade_id; ?>">{{ "UPAE ARCOVERDE" }}</option>
							@elseif($altF->unidade_id == 5)
							<option id="unidade_id" name="unidade_id" value="<?php echo $altF->unidade_id; ?>">{{ "UPAE ARRUDA" }}</option>
							@elseif($altF->unidade_id == 6)
							<option id="unidade_id" name="unidade_id" value="<?php echo $altF->unidade_id; ?>">{{ "UPAE CARUARU" }}</option>
							@elseif($altF->unidade_id == 7)
							<option id="unidade_id" name="unidade_id" value="<?php echo $altF->unidade_id; ?>">{{ "Hospital São Sebastião" }}</option>
							@elseif($altF->unidade_id == 8)
							<option id="unidade_id" name="unidade_id" value="<?php echo $altF->unidade_id; ?>">{{ "Hospital Provisório do Recife" }}</option>
							@endif
						@endforeach
						</select>
						<td colspan="2"><b><font size="2">Departamento Proposto:</font></b> 
							<select required class="form-control form-control-sm" id="setor" name="setor">
							<option id="setor" name="setor" value="">Selecione ... </option>	
							@foreach($setores as $setor)
							@if($setor->nome == $altF->setor)
								<option id="setor" name="setor" value="<?php echo $setor->nome; ?>" selected>{{ $setor->nome }}</option>
							@else
								<option id="setor" name="setor" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>
							@endif
							@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td><b><font size="2">Cargo Atual:</font></b>
						<select required class="form-control form-control-sm" id="cargo_atual" name="cargo_atual">
							<option id="cargo_atual" name="cargo_atual" value="">Selecione ... </option>
							@if(!empty($cargos))	
							@foreach($cargos as $cargoAtual)
							@if($cargoAtual->nome == $altF->cargo_atual)
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
							<option id="cargo_novo" name="cargo_novo" value="">Selecione ... </option>
							@if(!empty($cargos))	
							@foreach($cargos as $cargoP)
							@if($cargoP->nome == $altF->cargo_novo)
								<option id="cargo_novo" name="cargo_novo" value="<?php echo $cargoP->nome; ?>" selected> {{ $cargoP->nome }}</option>	
							@else
								<option id="cargo_novo" name="cargo_novo" value="<?php echo $cargoP->nome; ?>">{{ $cargoP->nome }}</option>		 
							@endif
							@endforeach
							@endif
						</select>
						</td>
						<td><b><font size="2">Novo Centro de Custo:</font></b> 
						<select required name="centro_custo_novo" id="centro_custo_novo" class="form-control form-control-sm">
							<option id="centro_custo_novo" name="centro_custo_novo" value="">Selecione ... </option>	
							@foreach($centro_custo_nv as $cc_nv)
							@if($cc_nv->nome == $altF->centro_custo_novo)
								<option id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $cc_nv->nome; ?>" selected>{{ $cc_nv->nome }}</option>
							@else
								<option id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $cc_nv->nome; ?>">{{ $cc_nv->nome }}</option>   
							@endif
							@endforeach
						</select>
						</td>
					</tr>
					<tr>
						<td><b><font size="2">Salário Atual:</font></b><input required class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_atual" name="salario_atual" value="<?php echo $altF->salario_atual; ?>" /></td>
						<td><b><font size="2">Salário Proposto:</font></b><input required class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_novo" name="salario_novo" value="<?php echo $altF->salario_novo; ?>" /></td>
						<td><b><font size="2">Gratificações:</font></b><input required class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="gratificacoes" name="gratificacoes" value="<?php echo $altF->gratificacoes; ?>" /></td>
					</tr>
					<tr>
					<td><b><font size="2">Novo Horário de Trabalho</font></b><input class="form-control form-control-sm" type="text" id="horario_novo" name="horario_novo" value="<?php echo $altF->horario_novo; ?>" required /></td>
					<td colspan="2"><b><font size="2">Motivo:</font></b><br>
						<select required name="motivo" id="motivo" class="form-control form-control-sm">
						<option id="motivo" name="motivo" value="">Selecione ... </option>
							@if($altF->motivo == "promocao")
							<option selected id="motivo" name="motivo" value="promocao"> Promoção </option>
							<option id="motivo" name="motivo" value="merito"> Mérito </option>
							<option id="motivo" name="motivo" value="mudanca_setor_area"> Mudança de Setor/Área </option> 
							<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
							<option id="motivo" name="motivo" value="enquadramento"> Enquadramento </option>
							<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
							<option id="motivo" name="motivo" value="substituicao_demissao"> Substituição por demissão </option>
							<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno </option> 
							<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
							<option id="motivo" name="motivo" value="empregado"> Empregado  </option>
							<option id="motivo" name="motivo" value="empregador"> Empregador  </option>
							@elseif($altF->motivo == "merito")
							<option id="motivo" name="motivo" value="promocao"> Promoção </option>
							<option selected id="motivo" name="motivo" value="merito"> Mérito </option>
							<option id="motivo" name="motivo" value="mudanca_setor_area"> Mudança de Setor/Área </option>
							<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
							<option id="motivo" name="motivo" value="enquadramento"> Enquadramento </option>
							<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
							<option id="motivo" name="motivo" value="substituicao_demissao"> Substituição por demissão </option>
							<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno </option>
							<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
							<option id="motivo" name="motivo" value="empregado"> Empregado </option>
							<option id="motivo" name="motivo" value="empregador"> Empregador </option>
							@elseif($altF->motivo == "mudanca_setor_area")
							<option id="motivo" name="motivo" value="promocao"> Promoção </option>
							<option id="motivo" name="motivo" value="merito"> Mérito </option>
							<option selected id="motivo" name="motivo" value="mudanca_setor_area"> Mudança de Setor/Área </option>
							<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
							<option id="motivo" name="motivo" value="enquadramento"> Enquadramento </option>
							<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
							<option id="motivo" name="motivo" value="substituicao_demissao"> Substituição por demissão </option>
							<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno </option>
							<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
							<option id="motivo" name="motivo" value="empregado"> Empregado </option>
							<option id="motivo" name="motivo" value="empregador"> Empregador </option>
							@elseif($altF->motivo == "transferencia_outra_unidade")
							<option id="motivo" name="motivo" value="promocao"> Promoção </option>
							<option id="motivo" name="motivo" value="merito"> Mérito </option>
							<option id="motivo" name="motivo" value="mudanca_setor_area"> Mudança de Setor/Área </option>
							<option selected id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
							<option id="motivo" name="motivo" value="enquadramento"> Enquadramento </option>
							<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
							<option id="motivo" name="motivo" value="substituicao_demissao"> Substituição por demissão </option>
							<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno </option>
							<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
							<option id="motivo" name="motivo" value="empregado"> Empregado  </option>
							<option id="motivo" name="motivo" value="empregador"> Empregador  </option>
							@elseif($altF->motivo == "enquadramento")
							<option id="motivo" name="motivo" value="promocao"> Promoção </option>
							<option id="motivo" name="motivo" value="merito"> Mérito </option>
							<option id="motivo" name="motivo" value="mudanca_setor_area"> Mudança de Setor/Área </option>
							<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
							<option selected id="motivo" name="motivo" value="enquadramento"> Enquadramento </option>
							<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
							<option id="motivo" name="motivo" value="substituicao_demissao"> Substituição por demissão </option>
							<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno </option>
							<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
							<option id="motivo" name="motivo" value="empregado"> Empregado </option>
							<option id="motivo" name="motivo" value="empregador"> Empregador </option>
							@elseif($altF->motivo == "mudanca_horaria")
							<option id="motivo" name="motivo" value="promocao"> Promoção </option>
							<option id="motivo" name="motivo" value="merito"> Mérito </option>
							<option id="motivo" name="motivo" value="mudanca_setor_area"> Mudança de Setor/Área </option> 
							<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
							<option id="motivo" name="motivo" value="enquadramento"> Enquadramento </option>
							<option selected id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
							<option id="motivo" name="motivo" value="substituicao_demissao"> Substituição por demissão </option>
							<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno </option>
							<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
							<option id="motivo" name="motivo" value="empregado"> Empregado </option>
							<option id="motivo" name="motivo" value="empregador"> Empregador </option>
							@elseif($altF->motivo == "substituicao_demissao")
							<option id="motivo" name="motivo" value="promocao"> Promoção </option>
							<option id="motivo" name="motivo" value="merito"> Mérito </option>
							<option id="motivo" name="motivo" value="mudanca_setor_area"> Mudança de Setor/Área </option> 
							<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
							<option id="motivo" name="motivo" value="enquadramento"> Enquadramento </option> 
							<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
							<option selected id="motivo" name="motivo" value="substituicao_demissao"> Substituição por demissão </option>
							<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno </option>
							<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
							<option id="motivo" name="motivo" value="empregado"> Empregado </option>
							<option id="motivo" name="motivo" value="empregador"> Empregador </option>
							@elseif($altF->motivo == "recrutamento_interno")
							<option id="motivo" name="motivo" value="promocao"> Promoção </option>
							<option id="motivo" name="motivo" value="merito"> Mérito </option>
							<option id="motivo" name="motivo" value="mudanca_setor_area"> Mudança de Setor/Área </option>
							<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
							<option id="motivo" name="motivo" value="enquadramento"> Enquadramento </option>
							<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
							<option id="motivo" name="motivo" value="substituicao_demissao"> Substituição por demissão </option>
							<option selected id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno </option>
							<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
							<option id="motivo" name="motivo" value="empregado"> Empregado </option>
							<option id="motivo" name="motivo" value="empregador"> Empregador </option>
							@elseif($altF->motivo == "aumento_quadro")
							<option id="motivo" name="motivo" value="promocao"> Promoção </option>
							<option id="motivo" name="motivo" value="merito"> Mérito </option>
							<option id="motivo" name="motivo" value="mudanca_setor_area"> Mudança de Setor/Área </option> 
							<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
							<option id="motivo" name="motivo" value="enquadramento"> Enquadramento </option>
							<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
							<option id="motivo" name="motivo" value="substituicao_demissao"> Substituição por demissão </option>
							<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno </option>
							<option selected id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
							<option id="motivo" name="motivo" value="empregado"> Empregado </option>
							<option id="motivo" name="motivo" value="empregador"> Empregador </option>
							@elseif($altF->motivo == "empregado")
							<option id="motivo" name="motivo" value="promocao"> Promoção </option>
							<option id="motivo" name="motivo" value="merito"> Mérito </option>
							<option id="motivo" name="motivo" value="mudanca_setor_area"> Mudança de Setor/Área </option> 
							<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
							<option id="motivo" name="motivo" value="enquadramento"> Enquadramento </option>
							<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
							<option id="motivo" name="motivo" value="substituicao_demissao"> Substituição por demissão </option>
							<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno </option>
							<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
							<option selected id="motivo" name="motivo" value="empregado"> Empregado </option>
							<option id="motivo" name="motivo" value="empregador"> Empregador </option>
							@elseif($altF->motivo == "empregador")
							<option id="motivo" name="motivo" value="promocao"> Promoção </option>
							<option id="motivo" name="motivo" value="merito"> Mérito </option>
							<option id="motivo" name="motivo" value="mudanca_setor_area"> Mudança de Setor/Área </option> 
							<option id="motivo" name="motivo" value="transferencia_outra_unidade"> Transferência para outra unidade </option>
							<option id="motivo" name="motivo" value="enquadramento"> Enquadramento </option>
							<option id="motivo" name="motivo" value="mudanca_horaria"> Mudança de Horário </option>
							<option id="motivo" name="motivo" value="substituicao_demissao"> Substituição por demissão </option>
							<option id="motivo" name="motivo" value="recrutamento_interno"> Recrutamento Interno </option> 
							<option id="motivo" name="motivo" value="aumento_quadro"> Aumento de Quadro </option>
							<option id="motivo" name="motivo" value="empregado"> Empregado </option>
							<option selected id="motivo" name="motivo" value="empregador"> Empregador </option>
							@endif
						</select>
						</tr>
					</table>
					</center>
					@endforeach 
					@endif		
					
					<center>		
					<table class="table table-bordered" style="height: 10px;">
					<tr>
						<td width="180"><strong><font size="2"><b>Informações Adicionais:</b></font></strong></td>
						<td><textarea required type="text" id="descricao" name="descricao" class="form-control" rows="1" cols="60"> {{ $justificativa[0]->descricao }} </textarea></td>
					</tr>
					</table>
					</center>
					
					<center>
					<table class="table table-bordered" style="height: 10px;">
					<tr>
						<td align="left"> 
						<a href="{{route('indexValida')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
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