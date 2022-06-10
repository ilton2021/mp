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
				  <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<center>
					<table class="table table-bordered table-sm"> 
						@foreach($mps as $mp)
						<tr>
						<td colspan="2"><center><strong><h5>Validar - Movimentação de Pessoal</h5></strong></center></td>	 
						<td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
						</tr>
						<tr>
						<td><b><font size="2">Unidade:</font></b><input class="form-control form-control-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly /></td>
						<td hidden><input class="form-control form-control-sm" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly /></td>
						<td><b><font size="2">Local de Trabalho:</font></b><input class="form-control form-control-sm" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly required /></td>
						<td><b><font size="2">Solicitante:</font></b><input readonly="true" class="form-control form-control-sm" type="text" id="solicitante" name="solicitante" required value="<?php echo $mp->solicitante; ?>" title="{{ $mp->solicitante }}" /></td>
						</tr>
						<tr>
						<td><b><font size="2">Nome:</font></b><input class="form-control form-control-sm" type="text" id="nome" name="nome" value="<?php echo $mp->nome; ?>" title="{{ $mp->nome }}" required readonly /></td>
						<td><b><font size="2">Matrícula:</font></b><input class="form-control form-control-sm" type="text" id="matricula" name="matricula" value="<?php echo $mp->matricula; ?>" title="{{ $mp->matricula }}" required readonly /></td>
						<td><b><font size="2">Gestor Imediato:</font></b> 
						<select id="gestor_id" name="gestor_id" class="form-control form-control-sm" readonly disabled>
						<?php $gId = $gestor[0]->id; ?> 
						@if($mp->tipo_mp == 0)
						@if(Auth::user()->name == $mp->solicitante)
							<option id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->id ?>" title="{{ $gestor[0]->nome }}">{{ $gestor[0]->nome }}</option>  
						@else
							@if(!empty($gestores))
							@foreach($gestores as $gestor)
								@if($mp->gestor_id == $gestor->id)
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
						<td><b><font size="2">Número MP:</font></b><input class="form-control form-control-sm" type="text" id="numeroMP" name="numeroMP" value="<?php echo $mp->numeroMP; ?>" title="{{ $mp->numeroMP }}" required readonly /></td>
						<td colspan="1"><b><font size="2">Departamento:</font></b><input class="form-control form-control-sm" type="text" id="departamento" readonly name="departamento" value="<?php echo $mp->departamento; ?>" title="{{ $mp->departamento }}" required /></td>
						<td><b><font size="2">Data de Emissão:</font></b><input class="form-control form-control-sm" type="date" id="data_emissao" name="data_emissao" readonly value="<?php echo $mp->data_emissao; ?>" title="{{ $mp->data_emissao }}" required /></td>
						</tr>
					</table>
					</center>
					
					<center>
						<table class="table table-bordered table-sm" style="height: 10px;">
						<tr>
						<td> <center><b><font size="2">IMPACTO FINANCEIRO:</font></b>
							@if($mp->impacto_financeiro == "sim")
							SIM: <input type="checkbox" id="sim_impacto" name="sim_impacto" disabled checked onclick="desabilitarTipos1('sim')" /> 
							@elseif($mp->impacto_financeiro == "nao")
							NÃO: <input type="checkbox" id="nao_impacto" name="nao_impacto" disabled checked onclick="desabilitarTipos1('sim')" /> 
							@endif
						</center></td>	  
						<td><center><b><font size="2">Data Prevista:</font></b></center></td>
						<td><input class="form-control form-control-sm" type="date" id="data_prevista" name="data_prevista" value="<?php echo $mp->data_prevista; ?>" required readonly="true" title="{{ $mp->data_prevista }}" /></td>
						</tr>	
						</table>
					</center>
					@endforeach
					
					@if(!empty($admissao))
					@foreach($admissao as $adm)	
					<center>
					<table class="table table-bordered table-sm">
						</tr>
						<tr>
						<td rowspan="5">
						<center><h5><font size="2"><b>Admissão</b></font></h5><input type="checkbox" id="tipo_mov1" name="tipo_mov1" checked readonly disabled /></center>
						<?php $a = 0; ?>
						@if(Auth::user()->name == $mps[0]->solicitante && $mps[0]->gestor_id == Auth::user()->id)
						 @if(empty($aprovacao))
						  <br><center><a class="btn btn-primary btn-sm" href="{{ route('alterarMPAdmissao', array($mp->id, $adm->id)) }}">ALTERAR</a> </center></td>
						 @else 
						  @foreach($aprovacao as $ap)
							<?php if($ap->resposta == 3){ $a = 1; } ?>
						  @endforeach	
						  @if($a == 0)
							<br><center><a class="btn btn-primary btn-sm" href="{{ route('alterarMPAdmissao', array($mp->id, $adm->id)) }}">ALTERAR</a>	</center></td>
						  @endif
						 @endif
						@endif
						</td> 
						<td>
							<b><font size="2">Cargo:</font></b><input class="form-control form-control-sm" type="text" id="cargo" name="cargo" value="<?php echo $adm->cargo; ?>" readonly />
							<br><br><b><font size="2">Centro de Custo:</font></b><input class="form-control form-control-sm" type="text" id="centro_custo" name="centro_custo" value="<?php echo $adm->centro_custo; ?>" readonly />	
						</td>
						<td>
						<b><font size="2">Remuneração Total:</font></b>
							<input class="form-control form-control-sm" type="text" id="salario" name="salario" value="<?php echo "R$ ".number_format($adm->salario + $adm->outras_verbas, 2,',','.'); ?>" readonly />
						<b><font size="2">Salário:</b> 
							<input class="form-control form-control-sm" type="text" id="salario" name="salario" value="<?php echo "R$ ".number_format($adm->salario, 2,',','.'); ?>" readonly />
						<b><font size="2">Outras Verbas:</b>
							<input class="form-control form-control-sm" type="text" id="outras_verbas" name="outras_verbas" value="<?php echo "R$ ".number_format($adm->outras_verbas, 2,',','.'); ?>" readonly />
						</td>
						<td><b><font size="2">Horário de Trabalho:</font></b><br><input class="form-control form-control-sm" type="text" id="horario_trabalho" name="horario_trabalho" value="<?php echo $adm->horario_trabalho; ?>" readonly /></td>
						</tr>
						<tr>
						<td><b><font size="2">Escala de Trabalho:</font></b><br>
						@if($adm->escala_trabalho == "segxsex")
						<input class="form-control form-control-sm" type="text" id="escala_trabalho" name="escala_trabalho" value="Seg x Sex" disabled />
						@elseif($adm->escala_trabalho == "12x36")
						<input class="form-control form-control-sm" type="text" id="escala_trabalho" name="escala_trabalho" value="12x36" disabled /> 
						@elseif($adm->escala_trabalho == "12x60")
						<input class="form-control form-control-sm" type="text" id="escala_trabalho" name="escala_trabalho" value="12x60" disabled /> 
						@else
						<input class="form-control form-control-sm" type="text" id="escala_trabalho" name="escala_trabalho" value="outra" disabled /> 
						<br><input class="form-control form-control-sm" type="text" id="escala_trabalho2" name="escala_trabalho2" value="<?php echo $adm->escala_trabalho; ?>" disabled /> 
						@endif
						</td> 
						<td>
						@if(!empty($adm))
						<?php $q1 = $adm->gratificacoes; $r1 = "1"; $s1 = str_contains($q1, $r1); ?>
						<?php $r2 = "2"; $s2 = str_contains($q1, $r2); ?> <?php $r3 = "3"; $s3 = str_contains($q1, $r3); ?>
						<?php $r4 = "4"; $s4 = str_contains($q1, $r4); ?> <?php $r5 = "5"; $s5 = str_contains($q1, $r5); ?>
						<?php $r6 = "6"; $s6 = str_contains($q1, $r6); ?>
						@if($s1 == true)
						<input type='checkbox' id="g_1" name="g_1" disabled checked /> GRATIFICAÇÃO <br>
						@endif
						@if($s2 == true)
						<input type='checkbox' id="g_2" name="g_2" disabled checked /> INSALUBRIDADE <br>
						@endif
						@if($s3 == true)
						<input type='checkbox' id="g_3" name="g_3" disabled checked /> PERICULOSIDADE <br>
						@endif
						@if($s4 == true)
						<input type='checkbox' id="g_4" name="g_4" disabled checked /> VA <br>
						@endif
						@if($s5 == true)
						<input type='checkbox' id="g_5" name="g_5" disabled checked /> VT <br>
						@endif
						@if($s6 == true)
						<input type='checkbox' id="g_6" name="g_6" disabled checked title="NENHUMA DAS RESPOSTAS" /> N. D. R
						@endif
						@endif
						</td>
						<td><b><font size="2">Jornada:</font></b>
						@if($adm->jornada == "diarista")
						<input class="form-control form-control-sm" type="text" id="jornada" name="jornada" value="Diarista" readonly />
						@elseif($adm->jornada == "plantao_par")
						<input class="form-control form-control-sm" type="text" id="jornada" name="jornada" value="Plantão Par" readonly />
						@elseif($adm->jornada == "plantao_impar")
						<input class="form-control form-control-sm" type="text" id="jornada" name="jornada" value="Plantão Ímpar" readonly />
						@elseif($adm->jornada == "semanal")
						<input class="form-control form-control-sm" type="text" id="jornada" name="jornada" value="Semanal" readonly />
						@else
						<input class="form-control form-control-sm" type="text" id="jornada" name="jornada" value="Outra" readonly />
						@endif
						<b><font size="2">Turno:</font></b><br> 
						@if($adm->turno == "dia")
						<input class="form-control form-control-sm" type="text" id="turno" name="turno" value="Dia" disabled />  
						@elseif($adm->turno == "noite")
						<input class="form-control form-control-sm" type="text" id="turno" name="turno" value="Noite" disabled /> 
						@endif
						</td>
						</tr>
						<tr>
						<td><b><font size="2">Tipo:</font></b><br> 
						@if($adm->tipo == "efetivo")
						<input class="form-control form-control-sm" type="text" id="tipo" name="tipo" value="Efetivo" disabled  />  
						@elseif($adm->tipo == "estagiario")
						<input class="form-control form-control-sm" type="text" id="tipo" name="tipo" value="Estagiário" disabled  />  
						@elseif($adm->tipo == "temporario")
						<input class="form-control form-control-sm" type="text" id="tipo" name="tipo" value="Temporário" disabled  />   
						@elseif($adm->tipo == "aprendiz")
						<input class="form-control form-control-sm" type="text" id="tipo" name="tipo" value="Aprendiz" disabled  />  
						@endif
						<td><b><font size="2">Motivo:</font></b><br> 
						@if($adm->motivo == "aumento_quadro")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Aumento de Quadro" disabled />  
						@elseif($adm->motivo == "substituicao_temporaria")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Substituição Temporária" disabled /> 
						@elseif($adm->motivo == "segundo_vinculo")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Segundo Vínculo" disabled />  
						@elseif($adm->motivo == "substituicao_definitiva")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Substituição Definitiva" disabled /> 
						<br><input type="text" class="form-control form-control-sm" id="motivo2" name="motivo2" value="<?php echo $adm->motivo2; ?>" disabled /> </td>
						@endif
						<td><font size="2"><b>Data da Demissão:</b></font>
							<input readonly type="date" id="data_demissao" name="data_demissao" class="form-control form-control-sm" value="<?php echo $adm->data_demissao; ?>">		
							<b><font size="2">Salário Base:</font></b>
							<input readonly class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" step="00.01" type="text" required id="salario_base" name="salario_base" value="<?php echo "R$ ".number_format($adm->salario_base, 2,',','.'); ?>" title="ex: 2500 ou 2580,21" value="<?php echo $adm->salario_base; ?>" />
						</td>
						</tr>
						<tr>
						<td><b><font size="2">Possibilidade de Contratação de Deficiente:</font></b><br> 
						@if($adm->possibilidade_contratacao == 'sim') 
						<input type="text" class="form-control form-control-sm" readonly id="possibilidade_contratacao" name="possibilidade_contratacao" value="Sim" disabled /> 
						@else
						<input type="text" class="form-control form-control-sm" readonly id="possibilidade_contratacao" name="possibilidade_contratacao" value="Não" disabled /> 
						@endif 
						</td>
						<td colspan="2"><b><font size="2">Necessidade de conta de e-mail:</font></b><br> 
						@if($adm->necessidade_email == "sim")
						<input type="text" class="form-control form-control-sm" id="necessidade_email" name="necessidade_email" value="Sim" disabled style="width: 250px;" />  
						@else
						<input type="text" class="form-control form-control-sm" id="necessidade_email" name="necessidade_email" value="Não" disabled style="width: 250px;" />
						@endif
						</td>
						</tr>
					</table>
					</center>
					@endforeach	 
					@endif
					
					
					@if(!empty($demissao))		
					@foreach($demissao as $dem)	 
					<center>
					<table class="table table-bordered table-sm">
					<tr>
						<td><center><h5><font size="2"><b>Demissão</b></font></h5><input checked type="checkbox" id="tipo_mov2" name="tipo_mov2" disabled /></center>
						<?php $a = 0; ?>
						@if(Auth::user()->name == $mps[0]->solicitante && $mps[0]->gestor_id == Auth::user()->id)
						@if(empty($aprovacao))
						<br><center><a class="btn btn-primary btn-sm" href="{{ route('alterarMPDemissao', array($mp->id, $dem->id)) }}">ALTERAR</a>	</center></td>
						@else 
						@foreach($aprovacao as $ap)
							<?php if($ap->resposta == 3){ $a = 1; } ?>
						@endforeach	
						@if($a == 0)
							<br><center><a class="btn btn-primary btn-sm" href="{{ route('alterarMPDemissao', array($mp->id, $dem->id)) }}">ALTERAR</a>	</center></td>
						@endif
						@endif
						@endif
						<td><b><font size="2">Tipo de desligamento:</font></b>
						@if($dem->tipo_desligamento == "termino_contrato")
						<br><br> <input type="text" class="form-control form-control-sm" id="tipo_desligamento" name="tipo_desligamento" value="Término de Contrato" disabled />  
						@elseif($dem->tipo_desligamento == "extincao_antecipada")
						<br><br> <input type="text" class="form-control form-control-sm" id="tipo_desligamento" name="tipo_desligamento" value="Extinção Antecipada do Contrato" disabled />  
						@elseif($dem->tipo_desligamento == "sem_justa_causa")
						<br><br> <input type="text" class="form-control form-control-sm" id="tipo_desligamento" name="tipo_desligamento" value="Dispensa sem justa causa" disabled />  
						@elseif($dem->tipo_desligamento == "aposentadoria")
						<br><br> <input type="text" class="form-control form-control-sm" id="tipo_desligamento" name="tipo_desligamento" value="Aposentadoria" disabled />  
						@elseif($dem->tipo_desligamento == "com_justa_causa")
						<br><br> <input type="text" class="form-control form-control-sm" id="tipo_desligamento" name="tipo_desligamento" value="Dispensa com justa causa" disabled />  
						@elseif($dem->tipo_desligamento == "morte")
						<br><br> <input type="text" class="form-control form-control-sm" id="tipo_desligamento" name="tipo_desligamento" value="Morte" disabled />  
						@elseif($dem->tipo_desligamento == "pedido_demissao")
						<br><br> <input type="text" class="form-control form-control-sm" id="tipo_desligamento" name="tipo_desligamento" value="Pedido de Demissão" disabled />   
						@endif
						</td>
						<td><b><font size="2">Aviso Prévio:</font></b><br><br> 
						@if($dem->aviso_previo == "trabalhado")
						<input type="text" class="form-control form-control-sm" id="aviso_previo" name="aviso_previo" value="Trabalhado" disabled />  
						@elseif($dem->aviso_previo == "indenizado")
						<input type="text" class="form-control form-control-sm" id="aviso_previo" name="aviso_previo" value="Indenizado" disabled />  
						@elseif($dem->aviso_previo == "dispensado")
						<input type="text" class="form-control form-control-sm" id="aviso_previo" name="aviso_previo" value="Dispensado" disabled /> 
						@endif
						</td>
						<td><b><font size="2">Último dia Trabalhado:</font></b><br><br><input class="form-control form-control-sm" type="date" id="ultimo_dia" name="ultimo_dia" value="<?php echo $dem->ultimo_dia; ?>" disabled /> 
						<br><b><font size="2">Custo da Recisão:</font></b><input type="text" class="form-control form-control-sm" id="custo_recisao" name="custo_recisao" value="<?php echo "R$ ".number_format($dem->custo_recisao, 2,',','.'); ?>" disabled />
						<br><b><font size="2">Salário Base:</font></b><input type="text" class="form-control form-control-sm" id="salario_bruto" name="salario_bruto" value="<?php echo "R$ ".number_format($dem->salario_bruto, 2,',','.'); ?>" disabled /> </td>
					</tr>
					</table>
					</center>
					@endforeach
					@endif		
					
					@if(!empty($alteracaoF))
					@foreach($alteracaoF as $altF)	 
					<center>
					<table class="table table-bordered table-sm">
					<tr>
						<td rowspan="5"><center><h5><font size="2"><b>Alteração Funcional</b></font></h5><input type="checkbox" id="tipo_mov3" name="tipo_mov3" checked disabled /></center>
						<?php $a = 0; ?>
						@if(Auth::user()->name == $mps[0]->solicitante && $mps[0]->gestor_id == Auth::user()->id)
						@if(empty($aprovacao))
						<br><center><a class="btn btn-primary btn-sm" href="{{ route('alterarMPAlteracao', array($mp->id, $altF->id)) }}">ALTERAR</a></center>
						@else 
						@foreach($aprovacao as $ap)
							<?php if($ap->resposta == 3){ $a = 1; } ?>
						@endforeach	
						@if($a == 0)
							<br><center><a class="btn btn-primary btn-sm" href="{{ route('alterarMPAlteracao', array($mp->id, $altF->id)) }}">ALTERAR</a></center>
						@endif
						@endif
						@endif
						<td><b><font size="2">Transferência proposta: Indique a Unidade</font> 
						<select id="unidade_id" name="unidade_id" class="form-control form-control-sm" disabled>
						@foreach($unidades as $unidade)
							<option id="unidade_id2" name="unidade_id2">{{ $unidade->nome }}</option>
						@endforeach
						</select>
						<td colspan="1"><b><font size="2">Departamento Proposto</font><input class="form-control form-control-sm" type="text" id="setor" name="setor" value="<?php echo $altF->setor; ?>" disabled /></td>
					</tr>
					<tr>
						<td><b><font size="2">Cargo Atual:</font><input class="form-control form-control-sm" type="text" id="cargo_atual" name="cargo_atual" value="<?php echo $altF->cargo_atual; ?>" disabled /></td>
						<td><b><font size="2">Cargo Proposto:</font><input class="form-control form-control-sm" type="text" id="cargo_novo" name="cargo_novo" value="<?php echo $altF->cargo_novo; ?>" disabled /></td>
						<td><b><font size="2">Novo Horário de Trabalho:</font><input class="form-control form-control-sm" type="text" id="horario_novo" name="horario_novo" value="<?php echo $altF->horario_novo; ?>" disabled /></td>
					</tr>
					<tr> 
						<td><b><font size="2">Salário Atual:</font><input class="form-control form-control-sm" type="text" id="salario_atual" name="salario_atual" value="<?php echo "R$ ".number_format($altF->salario_atual, 2,',','.'); ?>" disabled /></td>
						<td><b><font size="2">Salário Proposto:</font><input class="form-control form-control-sm" type="text" id="salario_novo" name="salario_novo" value="<?php echo "R$ ".number_format($altF->salario_novo, 2,',','.'); ?>" disabled /></td>
						<td><b><font size="2">Novo Centro de Custo:</font><input class="form-control form-control-sm" type="text" id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $altF->centro_custo_novo; ?>" disabled /></td>
					</tr>
					<tr>
						<td><b><font size="2">Gratificações:</font><input class="form-control form-control-sm" type="text" id="gratificacoes" name="gratificacoes" value="<?php echo "R$ ".number_format($altF->gratificacoes, 2,',','.'); ?>" disabled /></td>
						<td colspan="1"><b><font size="2">Motivo:</font></b><br>
						@if($altF->motivo == "promocao")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Promoção" disabled />  
						@elseif($altF->motivo == "merito")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Mérito" disabled />  
						@elseif($altF->motivo == "mudanca_setor_area")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Mudança de Setor/Área" disabled />  
						@elseif($altF->motivo == "transferencia_outra_unidade")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Transferência para outra unidade" disabled />  
						@elseif($altF->motivo == "substituicao_temporaria")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Substituição Temporária" disabled />  
						@elseif($altF->motivo == "enquadramento")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Enquadramento" disabled />  
						@elseif($altF->motivo == "mudanca_horaria")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Mudança de Horário" disabled />   
						@elseif($altF->motivo == "substituicao_demissao_voluntaria")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Substituição por demissão voluntária" disabled />   
						@elseif($altF->motivo == "recrutamento_interno")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Recrutamento Interno" disabled />   
						@elseif($altF->motivo == "aumento_quadro")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Aumento de Quadro" disabled />  
						@elseif($altF->motivo == "substituicao_demissao_forcada")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Substituição por demissão forçada" disabled />   
						@endif
						</td>
					</tr>
					</table>
					</center>
					@endforeach 
					@endif	
					
					@if(!empty($admissaoRPA))
					@foreach($admissaoRPA as $adm)	
					<center>
					<table class="table table-bordered table-sm">
						<tr>
						<td rowspan="5">
						<center><h5><font size="2"><b>Admissão RPA</b></font></h5> <input type="checkbox" id="tipo_mov1" name="tipo_mov1" checked readonly disabled /></center>
						<?php $a = 0; ?>
							@if(Auth::user()->name == $mps[0]->solicitante && $mps[0]->gestor_id == Auth::user()->id)
							@if(empty($aprovacao))
							<br><center><a class="btn btn-primary btn-sm" href="{{ route('alterarMPAdmissaoRPA', array($mp->id, $adm->id)) }}">ALTERAR</a></center>
							@else 
							@foreach($aprovacao as $ap)
								<?php if($ap->resposta == 3){ $a = 1; } ?>
							@endforeach	
							@if($a == 0)
								<br><center><a class="btn btn-primary btn-sm" href="{{ route('alterarMPAdmissaoRPA', array($mp->id, $adm->id)) }}">ALTERAR</a></center>
							@endif
							@endif
							@endif
						</td>
						<td>
						<b><font size="2">Cargo:</font></b><input class="form-control form-control-sm" type="text" id="cargo" name="cargo" value="<?php echo $adm->cargo; ?>" readonly /> <br><br>
						<b><font size="2">Centro de Custo:</font></b><input class="form-control form-control-sm" type="text" id="centro_custo" name="centro_custo" value="<?php echo $adm->centro_custo; ?>" readonly />
						</td>
						<td>
						<b><font size="2">Remuneração Total:</font></b>
						<input class="form-control form-control-sm" type="text" id="salario" name="salario" value="<?php echo "R$ ".number_format($adm->salario + $adm->outras_verbas, 2,',','.'); ?>" readonly />
						<b><font size="2">Salário:</font></b>
						<input class="form-control form-control-sm" type="text" id="salario" name="salario" value="<?php echo "R$ ".number_format($adm->salario, 2,',','.'); ?>" readonly />
						<b><font size="2">Outras Verbas:</font></b>
						<input class="form-control form-control-sm" type="text" id="outras_verbas" name="outras_verbas" value="<?php echo "R$ ".number_format($adm->outras_verbas, 2,',','.'); ?>" readonly />
						<td><b><font size="2">Horário de Trabalho:</font></b><br><input class="form-control form-control-sm" type="text" id="horario_trabalho" name="horario_trabalho" value="<?php echo $adm->horario_trabalho; ?>" readonly /></td>
						</tr>
						<tr>
						<td><b><font size="2">Escala de Trabalho:</font></b><br><br>
						@if($adm->escala_trabalho == "segxsex")
							<input type="text" class="form-control form-control-sm" selected id="escala_trabalho" name="escala_trabalho" value="Seg x Sex" disabled/> 
						@elseif($adm->escala_trabalho == "12x36")
							<input type="text" class="form-control form-control-sm" selected id="escala_trabalho" name="escala_trabalho" value="12x36" disabled/>
						@elseif($adm->escala_trabalho == "12x60")
							<input type="text" class="form-control form-control-sm" selected id="escala_trabalho" name="escala_trabalho" value="12x60" disabled/>
						@else
							<input type="text" class="form-control form-control-sm" selected id="escala_trabalho" name="escala_trabalho" value="Outra" disabled/>
							<br><input type="text" class="form-control form-control-sm" id="escala_trabalho2" name="escala_trabalho2" disabled value="<?php echo $adm->escala_trabalho; ?>"> 
						@endif
						</select>
						</td> 
						<td><b><font size="2">Jornada:</font></b>
						@if($adm->jornada == "diarista")
						<input class="form-control form-control-sm" type="text" id="jornada" name="jornada" value="Diarista" disabled />
						@elseif($adm->jornada == "plantao_par")
						<input class="form-control form-control-sm" type="text" id="jornada" name="jornada" value="Plantão Par" disabled />
						@elseif($adm->jornada == "plantao_impar")
						<input class="form-control form-control-sm" type="text" id="jornada" name="jornada" value="Plantão Ímpar" disabled />
						@elseif($adm->jornada == "semanal")
						<input class="form-control form-control-sm" type="text" id="jornada" name="jornada" value="Semanal" disabled />
						@elseif($adm->jornada == "outra")
						<input class="form-control form-control-sm" type="text" id="jornada" name="jornada" value="Outra" disabled />
						@endif
						<br><b><font size="2">Turno:</font></b><br> 
						@if($adm->turno == "dia")
						<input class="form-control form-control-sm" type="text" id="turno" name="turno" value="Dia" disabled />  
						@elseif($adm->turno == "noite")
						<input class="form-control form-control-sm" type="text" id="turno" name="turno" value="Noite" disabled /> 
						@endif
						</td>
						<td><b><font size="2">Período (01 Competência):</font></b><br> 
						<input class="form-control form-control-sm" type="text" id="mes_ano" name="mes_ano" readonly diabled value="<?php echo date('d/m/Y', strtotime($adm->periodo_inicio)); ?>" /> Até
						<input class="form-control form-control-sm" type="text" id="mes_ano2" name="mes_ano2" readonly diabled value="<?php echo date('d/m/Y', strtotime($adm->periodo_fim)); ?>" />
						<font size="2">Quantidades de Dias: <b>(*máximo 31 dias)</font></b><br>
						<input type="text" id="qtdDias" name="qtdDias" readonly class="form-control form-control-sm" value="<?php echo $adm->qtdDias; ?>" />
						</td>
						</tr>
						<tr>
						<td><b><font size="2">Profissional:</font></b> 
							@if(!empty($cargos_rpa))	
								@foreach($cargos_rpa as $cargoP)
								@if($adm->cargos_rpa_id == $cargoP->id)
									<input id="cargo_rpa_id" name="cargo_rpa_id" class="form-control form-control-sm" value="<?php echo $cargoP->cargo; ?>" readonly />	
								@endif					  
								@endforeach
							@endif
						</td>
						<td><b><font size="2">Contratação de Deficiente:</font></b><br> 
						@if($adm->possibilidade_contratacao == "sim")
							<input id="possibilidade_contratacao" name="possibilidade_contratacao" value="Sim" class="form-control form-control-sm" readonly> 
						@else
							<input id="possibilidade_contratacao" name="possibilidade_contratacao" value="Não" class="form-control form-control-sm" readonly>  
						@endif
						</td>
						<td colspan="2"><b><font size="2">Necessidade de conta de e-mail:</font></b><br> 
						@if($adm->necessidade_email == "sim")
							<input type="text" id="necessidade_email" name="necessidade_email" value="Sim" class="form-control form-control-sm" readonly> 
						@else
							<input type="text" id="necessidade_email" name="necessidade_email" value="Não" class="form-control form-control-sm" readonly> 
						@endif
						</td>
					</tr>
						<tr>
						<td><b><font size="2">Substituto:</font></b>
						<input class="form-control form-control-sm" readonly type="text" id="substituto" name="substituto" value="<?php echo $adm->substituto; ?>" />
						</td>
						<td><b><font size="2">Departamento:</font></b> 
						<input type="text" id="setor_plantao" name="setor_plantao" value="<?php echo $adm->departamento; ?>" class="form-control form-control-sm" readonly />
						</td>
						<td colspan="2"><b><font size="2">Motivo:</font></b><br> 
						@if($adm->motivo == "aumento_quadro")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Aumento Quadro" disabled /> 
						@elseif($adm->motivo == "substituicao_temporaria")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Substituição Temporária" disabled /> 
						@elseif($adm->motivo == "segundo_vinculo")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Segundo Vínculo" disabled /> 
						@elseif($adm->motivo == "substituicao_definitiva")
						<input class="form-control form-control-sm" type="text" id="motivo" name="motivo" value="Substituicao Definitiva a:" disabled /> 
						<br><input class="form-control form-control-sm" type="text" id="motivo2" name="motivo2" value="<?php echo $adm->motivo2; ?>" disabled /> </td>
						@endif
						</tr>
						<tr>
						<td><b><font size="2">Quantidade:</font></b>
						<input type="text" class="form-control form-control-sm" readonly id="quantidade_plantao" name="quantidade_plantao" value="<?php echo $adm->quantidade_plantao; ?>" />
						</td>
						<td><b><font size="2">Valor:</font></b>
							<input readonly class="form-control form-control-sm" type="text" id="valor_plantao" name="valor_plantao" value="<?php echo "R$ ".number_format($adm->valor_plantao, 2,',','.'); ?>" />
						</td>
						<td><b><font size="2">Valor a ser Pago:</font></b>
							<input readonly class="form-control form-control-sm" title="(Quantidade * Valor)" type="text" id="valor_pago_plantao" name="valor_pago_plantao" value="<?php echo "R$ ".number_format($adm->valor_pago_plantao, 2,',','.'); ?>" />	
						</td>
					</table>
					</center>
					@endforeach	 
					@endif
					
					<center>		
					<table class="table table-bordered table-sm" style="height: 10px;">
					<tr>
						<td width="170"><strong><h5><font size="2"><b>Informações Adicionais:</b></font></h5></strong></td>
						<td><textarea type="text" id="descricao" name="descricao" class="form-control form-control-sm" required rows="1" cols="60" title="<?php echo $justificativa[0]->descricao; ?>" value="<?php echo $justificativa[0]->descricao; ?>" readonly="true">{{ $justificativa[0]->descricao }}</textarea></td>
					</tr>
					</table>
					</center>
					
					<center>	
					<table class="table table-bordered table-sm">
					<tr>
						<td width="100" colspan="6"><strong><font size="2">Aprovações - 48h Úteis para cada aprovador(a).</font></strong></td>
					</tr>
					<tr>
					@if(!empty($data_aprovacao))
						<td width="220"><font size="2">SOLICITANTE</font></td>
						<td width="380"><font size="2"><?php if($solicitante == ""){ echo ""; } else { echo $solicitante; } ?></font></td>
						<td width="50"><input readonly="true" type="text" id="data_aprovacao" name="data_aprovacao" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_aprovacao))); ?>" /></td>
						<td><center>{{ $justificativa[0]->descricao }}</center></td>
						@else
						<td>Solicitante </td>
						<td></td>
						<td><input readonly="true" type="date" id="data_aprovacao" name="data_aprovacao" class="form-control form-control-sm" value="" /></td>	
						<td></td>
						@endif
					</tr> 
					<tr>
					@if(!empty($data_gestor_imediato))
						<td><font size="2">GESTOR IMEDIATO</font></td> 
						<td><font size="2"><?php if($gestorData == ""){ echo ""; } else { echo $gestorData[0]->nome; } ?></font></td>
						<td><input readonly="true" type="text" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_gestor_imediato))); ?>" /></td>
						<td> 
						@foreach($aprovacao as $ap) 
						@if($ap->mp_id == $mps[0]->id && $gestorDataId[0]->id == $ap->gestor_anterior)
						<center>{{ $ap->motivo }}</center>
						@endif
						@endforeach
						</td>
					@else
						<td><font size="2">GESTOR IMEDIATO</font></td>
						<td></td>
						<td><input readonly="true" type="date" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control form-control-sm" value="" /></td>   
						<td>
						@if(!empty($gestorDataId))
						@foreach($aprovacao as $ap) 
						@if($ap->mp_id == $mps[0]->id && $gestorDataId[0]->id == $ap->gestor_anterior)
						<center>{{ $ap->motivo }}</center>
						@endif
						@endforeach
						@endif
						</td>
					@endif	
					</tr>
					<tr>
					@if(!empty($data_rec_humanos))
						<td><font size="2">RECURSOS HUMANOS</font></td>
						<?php $dataI = date('d-m-Y', strtotime($data_rec_humanos)); ?> 
						<?php $dataF = date('d-m-Y', strtotime('02-09-2021')); ?>
						<?php $dataFJana = date('d-m-Y', strtotime('22-10-2021'));?>
						<?php if(strtotime($dataI) < strtotime($dataF)){  ?>
						<td><font size="2"><?php if($rh == ""){ echo ""; } else { echo 'RAFAELA CARAZZAI'; } ?></font></td>	
						<?php } else if(strtotime($dataI) < strtotime($dataFJana)) {  ?>
						<td><font size="2"><?php if($rh == ""){ echo ""; } else { echo 'JANAINA GLAYCE PEREIRA LIMA'; } ?></font></td>	
						<?php } else {  ?>
						<td><font size="2"><?php if($rh == ""){ echo ""; } else { echo 'ANA AMÉRICA OLIVEIRA DE ARRUDA'; } ?></font></td>	
						<?php } ?>
						<td><input readonly="true" type="text" id="data_rec_humanos" name="data_rec_humanos" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_rec_humanos))); ?>" /></td>
						<td> 
						@foreach($aprovacao as $ap) 
						@if($ap->mp_id == $mps[0]->id && $rhId[0]->id == $ap->gestor_anterior)
						<center>{{ $ap->motivo }}</center>
						@endif
						@endforeach
						</td>
					@else
						<td><font size="2">RECURSOS HUMANOS / DP</font></td>
						<td></td>
						<td><input readonly="true" type="date" id="data_rec_humanos" name="data_rec_humanos" class="form-control form-control-sm" value="" /></td>   
						<td>
						@if(!empty($rhId))
						@foreach($aprovacao as $ap) 
						@if($ap->mp_id == $mps[0]->id && $rhId[0]->id == $ap->gestor_anterior)
						<center>{{ $ap->motivo }}</center>
						@endif
						@endforeach
						@endif
						</td>
					@endif	
					</tr>
					<tr>
					@if(!empty($data_diretoria_tecnica))
						<td><font size="2">DIRETORIA TÉCNICA</font></td>
						<td><font size="2"><?php if($diretoriaT == ""){ echo ""; } else { echo $diretoriaT[0]->nome; } ?></font></td>
						<td><input readonly="true" type="text" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_diretoria_tecnica))); ?>" /></td>
						<td>
						@foreach($aprovacao as $ap) 
						@if($ap->mp_id == $mps[0]->id && $diretoriaTId[0]->id == $ap->gestor_anterior)
						<center>{{ $ap->motivo }}</center>
						@endif
						@endforeach
						</td>
					@else
						<td><font size="2">DIRETORIA TÉCNICA</font></td>
						<td></td>
						<td><input readonly="true" type="date" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control form-control-sm" value="" /></td>   
						<td>
						@if(!empty($diretoriaTId))
						@foreach($aprovacao as $ap) 
						@if($ap->mp_id == $mps[0]->id && $diretoriaTId[0]->id == $ap->gestor_anterior)
						<center>{{ $ap->motivo }}</center>
						@endif
						@endforeach
						@endif
						</td>
					@endif	
					</tr>
					<tr>
					@if(!empty($data_diretoria_financeira))
						<td><font size="2">DIRETORIA FINANCEIRA</font></td>
						<td><font size="2"><?php if($diretoriaF == ""){ echo ""; } else { echo $diretoriaF[0]->nome; } ?></font></td>
						<td><input readonly="true" type="text" id="data_diretoria_financeira" name="data_diretoria_financeira" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_diretoria_financeira))); ?>" /></td>
						<td>
						@foreach($aprovacao as $ap) 
						@if($ap->mp_id == $mps[0]->id && $diretoriaFId[0]->id == $ap->gestor_anterior)
						<center>{{ $ap->motivo }}</center>
						@endif
						@endforeach
						</td>
					@else
						<td><font size="2">DIRETORIA FINANCEIRA</font></td>
						<td></td>
						<td><input readonly="true" type="date" id="data_diretoria_financeira" name="data_diretoria_financeira" class="form-control form-control-sm" value="" /></td>   
						<td>
						@if(!empty($diretoriaFId))
						@foreach($aprovacao as $ap) 
						@if($ap->mp_id == $mps[0]->id && $diretoriaFId[0]->id == $ap->gestor_anterior)
						<center>{{ $ap->motivo }}</center>
						@endif
						@endforeach
						@endif
						</td>
					@endif	
					</tr>   
					<tr>
					@if(!empty($data_diretoria))
						<td><font size="2">DIRETOR / COORDENAÇÃO GERAL</font></td>
						<td><font size="2"><?php if($diretoria == ""){ echo ""; } else { echo $diretoria[0]->nome; } ?></font></td>
						<td><input readonly="true" type="text" id="data_diretoria" name="data_diretoria" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_diretoria))); ?>" /></td>
						<td>
						@if(!empty($diretoriaId[0]->id))
						@foreach($aprovacao as $ap) 
						@if($ap->mp_id == $mps[0]->id && $diretoriaId[0]->id == $ap->gestor_anterior)
						<center>{{ $ap->motivo }}</center>
						@endif
						@endforeach
						@endif
						</td>
					@else
						<td><font size="2">DIRETOR / COORDENAÇÃO GERAL</font></td>
						<td></td>
						<td><input readonly="true" type="date" id="data_diretoria" name="data_diretoria" class="form-control form-control-sm" value="" /></td>   
						<td>
						@if(!empty($diretoriaId))
						@foreach($aprovacao as $ap) 
						@if($ap->mp_id == $mps[0]->id && $diretoriaId[0]->id == $ap->gestor_anterior)
						<center>{{ $ap->motivo }}</center>
						@endif
						@endforeach
						@endif
						</td>
					@endif
					</tr>
					<tr>
					@if(!empty($data_superintendencia))
						<td><font size="2">SUPERINTENDÊNCIA</font></td>
						<td><font size="2"><?php if($super == ""){ echo "FILIPE BITU"; } else { echo "FILIPE BITU"; } ?></font></td>
						<td><input readonly="true" type="text" id="data_superintendencia" name="data_superintendencia" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_superintendencia))); ?>" /></td>
						<td>
						@if(!empty($superId))	
						@foreach($aprovacao as $ap) 
						@if($ap->mp_id == $mps[0]->id && $superId[0]->id == $ap->gestor_anterior)
						<center>{{ $ap->motivo }}</center>
						@endif
						@endforeach
						@endif
						</td>
					@else
						<td><font size="2">SUPERINTENDÊNCIA</font></td>
						<td></td>
						<td><input readonly="true" type="date" id="data_superintendencia" name="data_superintendencia" class="form-control form-control-sm" value="" /></td>   
						<td>
						@if(!empty($superId))
						@foreach($aprovacao as $ap) 
						@if($ap->mp_id == $mps[0]->id && $superId[0]->id == $ap->gestor_anterior)
						<center>{{ $ap->motivo }}</center>
						@endif
						@endforeach
						@endif
						</td>
					@endif
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
						<?php $a = 0; ?>
						@if(Auth::user()->name == $mps[0]->solicitante)
						@if(!empty($admissaoHCP))
						@if($qtdAdmHCP > 0)
						<a href="{{ route('salvarMPAdmissaoHCP', array($mps[0]->id,$gId)) }}" type="button" class="btn btn-success btn-sm" > CONCLUIR <i class="fas fa-check"></i> </a>
						@else
						<a href="{{ route('salvarMPDemissao', array($mps[0]->id,$gId)) }}" type="button" class="btn btn-success btn-sm" > CONCLUIR <i class="fas fa-check"></i> </a>
						@endif
						@else
						<a href="{{ route('salvarMPDemissao', array($mps[0]->id,$gId)) }}" type="button" class="btn btn-success btn-sm" > CONCLUIR <i class="fas fa-check"></i> </a>
						@endif
						@elseif(Auth::user()->id == 104 && $mps[0]->gestor_id == 25)
							
						@else
							
						@if(empty($aprovacao))
						<a href="{{ route('n_autorizarMP', $mps[0]->id) }}" type="button" class="btn btn-danger btn-sm" > NÃO AUTORIZAR <i class="fas fa-times-circle"></i> </a>
						<a href="{{ route('autorizarMP', $mps[0]->id) }}" type="button" class="btn btn-success btn-sm" > AUTORIZAR <i class="fas fa-check"></i> </a>
						@else 
						@foreach($aprovacao as $ap)
							<?php if($ap->resposta == 3){ $a = 1; } ?>
						@endforeach	
						@if($a == 0)
							<a href="{{ route('n_autorizarMP', $mps[0]->id) }}" type="button" class="btn btn-danger btn-sm" > NÃO AUTORIZAR <i class="fas fa-times-circle"></i> </a>
							<a href="{{ route('autorizarMP', $mps[0]->id) }}" type="button" class="btn btn-success btn-sm" > AUTORIZAR <i class="fas fa-check"></i> </a>			
						@endif
						@endif
						
						@endif
						</td>
					</tr>
					</table>
					</center>
					<input hidden class="form-control form-control-sm" type="hidden" id="mp_id" name="mp_id" value="" readonly="true" />
					</form>
                  </div>
                </fieldset> 
             </div>
        </div>
    </div>
</div>
</body>
</HTML>