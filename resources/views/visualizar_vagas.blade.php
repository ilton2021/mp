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
		window.onload = function() {
		var imprimir = document.querySelector("#imprimir");
		    imprimir.onclick = function() {
		    	
		    	imprimir.style.display = 'none';
		    	window.print();
                var time = window.setTimeout(function() {
		    		imprimir.style.display = 'block';
		    	}, 1000);
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
				  <form action="{{\Request::route('storeVaga'), $unidade[0]->id}}" method="POST">             
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<center>
						<table class="table table-bordered table-sm"> 
							<tr>
							@if($vagas[0]->concluida == 1)
							<td colspan="2"><center><strong><h5>Concluído - Abertura de Vaga</h5></strong></center></td>
							@else
							<td colspan="2"><center><strong><h5>Visualizar - Abertura de Vaga</h5></strong></center></td>
							@endif
							<td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
							</tr>
							@foreach($vagas as $vaga)
							<tr>
							<td hidden><font size="2"><b>Unidade:</b></font><input class="form-control form-control-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->id; ?>" readonly /></td>
							<td><font size="2"><b>Unidade:</b></font><input class="form-control form-control-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly /></td>
							<td hidden><input class="form-control form-control-sm" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly /></td>
							<td><font size="2"><b>Local de Trabalho:</b></font>
							<select class="form-control form-control-sm" id="local_trabalho" name="local_trabalho" disabled>
								<option id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->id ?>">{{ $unidade[0]->nome }}</option>
							</select>
							</td>
							<td><font size="2"><b>Solicitante:</b></font><input readonly class="form-control form-control-sm" type="text" id="solicitante" name="solicitante"  value="<?php echo $vaga->solicitante; ?>" /></td>
							</tr>
							<tr>
							<td colspan="1"><font size="2"><b>Vaga:</b></font><input class="form-control form-control-sm" type="text" id="vaga" disabled name="vaga"  value="<?php echo $vaga->vaga; ?>" /></td>
							<td><font size="2"><b>Código da Vaga:</b></font><input class="form-control form-control-sm" type="text" id="codigo_vaga" disabled name="codigo_vaga" value="<?php echo $vaga->codigo_vaga; ?>" /> </td>
							<td><font size="2"><b>Gestor Imediato:</b></font>
							<select id="gestor_id" name="gestor_id" class="form-control form-control-sm" disabled>
							<?php if(!empty($data_rec_humanos)){ $dataI = date('d-m-Y', strtotime($data_rec_humanos)); } else { $dataI = date('d-m-Y', strtotime('now')); } ?> 
							<?php $dataF = date('d-m-Y', strtotime('02-09-2021')); ?>
							@if($vaga->tipo_vaga == 0)
							@if(Auth::user()->name == $vaga->solicitante)
								<option id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->id ?>" title="{{ $gestor[0]->nome }}">{{ $gestor[0]->nome }}</option>  
								<?php $gId = $gestor[0]->id; ?>
							@else
								@if(!empty($gestores))
								@foreach($gestores as $gestor)
									@if($vaga->gestor_id == $gestor->id)
									<?php $gId = 0; ?>
									<?php if(strtotime($dataI) < strtotime($dataF)){  ?>
										<option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id ?>" title="{{ $gestor->nome }}">{{'RAFAELA CARAZZAI' }}</option>
									<?php } else {  ?>
										<option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id ?>" title="{{ $gestor->nome }}">{{ 'JANAINA GLAYCE PEREIRA LIMA' }}</option>	
									<?php } ?>
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
							<td><font size="2"><b>Área:</b></font><input class="form-control form-control-sm" disabled type="text" id="area" name="area" value="<?php echo $vaga->area; ?>"  /></td>
							<td><font size="2"><b>Vaga disponível em Edital:</b></font><br>  
								<select class="form-control form-control-sm" disabled id="edital_disponivel" name="edital_disponivel" >
									@if($vaga->edital_disponivel == 'Sim')
									<option id="edital_disponivel" name="edital_disponivel" value="Sim" selected> {{ 'Sim' }} </option>
									@elseif($vaga->edital_disponivel == 'Não')
									<option id="edital_disponivel" name="edital_disponivel" value="Não" selected> {{ 'Não' }}</option>
									@endif
								</select>
							</td>	
							<td><font size="2"><b>Número da Vaga:</b></font>
								<input type="text" id="numeroVaga" name="numeroVaga" class="form-control form-control-sm" value="<?php echo $vaga->numeroVaga; ?>" readonly />
							</td>
							</tr>
						</table>
						</center>
						
						<br>	 
						<center>
							<table class="table table-bordered table-sm" style="height: 10px;">
							<tr>
							<td colspan="2"><center><strong><h5>Preenchimento da Área</h5></strong></center></td>
							<td><font size="2"><b>Data de Emissão:</b></font><input type="text" class="form-control form-control-sm" readonly id="data_emissao" name="data_emissao" value="<?php echo date('d-m-Y', strtotime($vaga->data_emissao)); ?>"  /></td>
							<td><font size="2"><b>Data Prevista:</b></font><input class="form-control form-control-sm" disabled type="date" id="data_prevista" name="data_prevista"  value="<?php echo $vaga->data_prevista; ?>" /></td>
							</tr>	
							</table>
						</center>

						<br>	 
						<center>
						<table class="table table-bordered">
							</tr>
							<tr>
							<td width="140" rowspan="5"><center><font size="3"><b>Abertura e/ou Promoção</b></font></center>
							<?php $a = 0; ?>
							@if(Auth::user()->name == $vagas[0]->solicitante && $vagas[0]->gestor_id == Auth::user()->id)
							 @if(empty($aprovacao))
							  <br><center><a class="btn btn-primary btn-sm" href="{{ route('alterarVaga', $vaga->id) }}">ALTERAR</a></center>
							 @else 
							  @foreach($aprovacao as $ap)
								<?php if($ap->resposta == 3){ $a = 1; } ?>
							  @endforeach	
							  @if($a == 0)
								<br><center><a class="btn btn-primary btn-sm" href="{{ route('alterarVaga', $vaga->id) }}">ALTERAR</a></center>
							  @endif
							 @endif
							@endif
							</td>
							<td><font size="2"><b>Cargo:</b></font> 
								<input type="text" disabled class="form-control form-control-sm" id="cargo" name="cargo" value="<?php echo $vaga->cargo; ?>" />
							</td>
							<td><font size="2"><b>Salário:</b></font><input class="form-control form-control-sm" disabled type="text"  id="salario" name="salario" value="<?php echo "R$ ".number_format($vaga->salario, 2,',','.'); ?>" title="ex: 2500 ou 2580,21" /></td>
							<td><font size="2"><b>Horário de Trabalho:</b></font><br>
								<select class="form-control form-control-sm" disabled id="horario_trabalho" name="horario_trabalho" >
								@if($vaga->horario_trabalho == '07:00 as 16:00')
								<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00" selected>07h às 16h</option>
								@elseif($vaga->horario_trabalho == '08:00 as 17:00')
								<option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00" selected>08h às 17h</option>
								@elseif($vaga->horario_trabalho == '09:00 as 19:00')
								<option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00" selected>09h às 19h</option>
								@else
								<option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
								Outro:
								<input class="form-control form-control-sm" disabled type="text" id="horario_trabalho2" name="horario_trabalho2" value="<?php echo $vaga->horario_trabalho; ?>" />
								@endif
								</select>
							</td>
							</tr>
							<tr>
							<td><font size="2"><b>Escala de Trabalho:</b></font><br>
							<select class="form-control form-control-sm" disabled id="escala_trabalho" name="escala_trabalho">
							@if($vaga->escala_trabalho == 'segxsex')
							<option disabled id="escala_trabalho" name="escala_trabalho" value="segxsex" selected> Segunda a Sexta </option>
							@elseif($vaga->escala_trabalho == '12x36')
							<option disabled id="escala_trabalho" name="escala_trabalho" value="12x36" selected> 12 x 36 </option>
							@elseif($vaga->escala_trabalho == '12x60')
							<option disabled id="escala_trabalho" name="escala_trabalho" value="12x60" selected> 12 x 60 </option>
							@else
							<option disabled id="escala_trabalho" name="escala_trabalho" value="outra" selected> Outra: </option> 
							@endif 
							@if($vaga->escala_trabalho != 'segxsex' && $vaga->escala_trabalho != '12x36' && $vaga->escala_trabalho != '12x60')
							<input disabled class="form-control form-control-sm" type="text" id="escala_trabalho" name="escala_trabalho" value="<?php echo $vaga->escala_trabalho; ?>" /> 
							@endif
							</select>
							</td> 
							<td><font size="2"><b>Centro de Custo:</b></font><input disabled type="text" class="form-control form-control-sm" id="centro_custo" name="centro_custo" value="<?php echo $vaga->centro_custo; ?>" /> </td>
							<td><font size="2"><b>Jornada:</b></font>
								<select disabled class="form-control form-control-sm" id="jornada" name="jornada" >
								@if($vaga->jornada == 'diarista')
								<option id="jornada" name="jornada" value="diarista" selected>Diarista</option>
								@elseif($vaga->jornada == 'plantao_par')
								<option id="jornada" name="jornada" value="plantao_par" selected>Plantão Par</option>
								@elseif($vaga->jornada == 'plantao_impar')
								<option id="jornada" name="jornada" value="plantao_impar" selected>Plantão Ímpar</option>
								@endif
								</select>
							<br><font size="2"><b>Turno:</b></font><br> 
							<select disabled class="form-control form-control-sm" id="turno" name="turno">
							@if($vaga->turno == "dia")
							<option disabled id="turno" name="turno" value="dia" selected> Dia </option>
							@elseif($vaga->turno == "noite")
							<option disabled id="turno" name="turno" value="noite" selected> Noite </option>
							@endif 
							</select>
							</td>
							</tr>
							<tr>
							<td><font size="2"><b>Tipo:</b></font><br> 
							<select disabled class="form-control form-control-sm" id="tipo" name="tipo">
							@if($vaga->tipo == 'efetivo')
							<option disabled id="tipo" name="tipo" value="efetivo" selected> Efetivo </option>
							@elseif($vaga->tipo == 'estagiario')
							<option disabled id="tipo" name="tipo" value="estagiario" selected> Estagiário </option>
							@elseif($vaga->tipo == 'temporario')
							<option disabled id="tipo" name="tipo" value="temporario" selected> Temporário </option>
							@elseif($vaga->tipo == 'aprendiz')
							<option disabled id="tipo" name="tipo" value="aprendiz" selected> Aprendiz </option>
							@elseif($vaga->tipo == 'rpa')
							<option class="form-control form-control-sm" disabled id="tipo" name="tipo" value="rpa" selected> RPA - (Período do Contrato RPA): </option>
							@endif
							</select>
							@if($vaga->tipo == 'rpa')
							<input class="form-control form-control-sm" disabled type="text" id="periodo_contrato" name="periodo_contrato" value="<?php echo $vaga->periodo_contrato; ?>" /> 		
							@endif
							</td>
							<td><font size="2"><b>Motivo:</b></font><br> 
							<select disabled class="form-control form-control-sm" id="motivo" name="motivo">
							@if($vaga->motivo == 'aumento_quadro')
							<option disabled id="motivo" name="motivo" value="aumento_quadro" selected> Aumento de Quadro </option>
							@elseif($vaga->motivo == 'substituicao_temporaria')
							<option disabled id="motivo" name="motivo" value="substituicao_temporaria" selected> Substituição temporária </option>
							@elseif($vaga->motivo == 'segundo_vinculo')
							<option disabled id="motivo" name="motivo" value="segundo_vinculo" selected> Segundo Vínculo </option>
							@elseif($vaga->motivo == 'substituicao_definitiva')
							<option disabled id="motivo" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" selected> Substituição definitiva a: </option>
							@endif
							</select>
							@if($vaga->motivo == 'substituicao_definitiva')
							<input disabled class="form-control form-control-sm" type="text" id="motivo2" name="motivo2" value="<?php echo $vaga->motivo2; ?>"> 
							@endif
							</td>
							@if($vaga->motivo == 'substituicao_definitiva')
							<td><label id="data_demissao_lbl"><font size="2"><b>Data da Demissão:</b></font></label>
								<input disabled type="text" id="data_demissao" name="data_demissao" class="form-control form-control-sm" value="<?php echo date('d/m/Y', strtotime($vaga->data_demissao)); ?>" required>		
								<label id="salario_base_lbl"><b><font size="2">Salário Base:</font></b></label>
								<input disabled class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" type="text" required id="salario_base" name="salario_base" value="<?php echo $vaga->salario_base; ?>" title="ex: 2500 ou 2580,21" />
							</td>
							@endif
							</tr>
							<tr>
							<td><font size="2"><b>Possibilidade de Contratação de Deficiente:</b></font><br> 
							<select disabled class="form-control form-control-sm" id="contratacao_deficiente" name="contratacao_deficiente">
							@if($vaga->contratacao_deficiente == "sim")
							<option disabled id="contratacao_deficiente" name="contratacao_deficiente" value="sim" selected> Sim </option>
							@elseif($vaga->contratacao_deficiente == "nao")
							<option disabled id="contratacao_deficiente" name="contratacao_deficiente" value="nao" selected> Não </option>
							@endif
							</select>
							</td>
							<td><font size="2"><b>Necessidade de conta de e-mail:</b></font><br> 
							<select disabled class="form-control form-control-sm" id="email" name="email">
							@if($vaga->email == "sim")
							<option disabled id="email" name="email" value="sim" selected> Sim </option>
							@elseif($vaga->email == "nao")
							<option disabled id="email" name="email" value="nao" selected> Não </option>
							@endif 
							</select>
							</td>
							</tr>
						</table>
						</center>
							
						<center>
						<table class="table table-bordered table-sm">
						<tr>
							<td width="135"><center><font size="3"><b>Perfil Comportamental</b></font> </center></td>
							<td>Comportamental: 
							<br><br> 
							@if(!empty($comportamental))
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
							@if($comp->descricao == "foco_versatilidade")
							<input type="checkbox" disabled id="comportamental10" name="comportamental10" value="foco_versatilidade" checked /> <font size="2">Foco e Versatilidade</font>
							@endif
							@if($comp->descricao == "disseminacao_conhecimento")
							<input type="checkbox" disabled id="comportamental11" name="comportamental11" value="disseminacao_conhecimento" checked /> <font size="2">Disseminação do Conhecimento</font>
							@endif
							@if($comp->descricao == "outros")
							<input type="checkbox" disabled id="comportamental9" name="comportamental9" value="outros" checked /> <font size="2">Outros</font>
							@endif
							@endforeach
							@if(!empty($comportamental))
							@foreach($comportamental as $comp)
							@if($comp->descricao == "outros")
							<td>Apresentação de Outros Perfis: <br> <textarea type="text" disabled id="perfil" name="perfil" class="form-control form-control-sm"  rows="8" cols="60" value="">{{ $comp->outros }}</textarea></td>  
							@endif
							@endforeach	
							@endif
						</tr>
						</table>
						</center>
						@endif	

						<center>
						<table class="table table-bordered table-sm">
						<tr>
							<td width="135" rowspan="5"><center><font size="3"><b>Perfil Técnico</b></font> </center></td>
							<td width="500">Descreva no mínimo 03 conhecimentos técnicos <b>Necessários</b> para assumir a vaga: 
							<textarea  disabled type="text" id="conhecimento_tecnico" name="conhecimento_tecnico" class="form-control form-control-sm" rows="5" cols="60" value=""><?php echo $vaga->conhecimento_tecnico; ?></textarea>  
							<td width="500">Descreva no mínimo 03 conhecimentos técnicos <b>Desejados</b> para assumir a vaga: 
							<textarea  disabled type="text" id="conhecimento_desejado" name="conhecimento_desejado" class="form-control form-control-sm" rows="5" cols="60" value=""><?php echo $vaga->conhecimento_desejado; ?></textarea></td>   
						</tr>
						<tr>
							<td>Formação Acadêmica: </td>
							<td>Idiomas: </td>
						</tr>
						<tr>
							<td><textarea type="text" disabled id="formacao" name="formacao" class="form-control form-control-sm" rows="5" cols="60" value=""><?php echo $vaga->formacao; ?></textarea></td>     
							<td><textarea type="text" disabled id="idiomas" name="idiomas" class="form-control form-control-sm" rows="5" cols="60" value=""><?php echo $vaga->idiomas; ?></textarea></td>     
						</tr>
						<tr>
							<td>Competências: <br><br> 
							@if(!empty($competencias))
							@foreach($competencias as $compt)
							@if($compt->descricao == "conhecimento_windows")
							<input type="checkbox" disabled id="motivoA1" name="motivoA1" value="conhecimento_windows" checked /> <font size="2">Conhecimentos em Windows </font>
							@endif
							@if($compt->descricao == "pacote_office")
							<input type="checkbox" disabled id="motivoA2" name="motivoA2" value="pacote_office" checked /> <font size="2">Pacote Office </font>
							@endif
							@if($compt->descricao == "certificacao_especifica")
							<input type="checkbox" disabled id="motivoA3" name="motivoA3" value="certificacao_especifica" checked /> <font size="2">Certificação Específica </font> 	
							@endif
							@if($compt->descricao == "curso_atualizacao")
							<input type="checkbox" disabled id="motivoA7" name="motivoA7" value="curso_atualizacao" checked /> <font size="2">Curso de Atualização da Área </font>
							@endif
							@if($compt->descricao == "excel_basico")
							<input type="checkbox" disabled id="motivoA4" name="motivoA4" value="excel_basico" checked /> <font size="2">Excel Básico </font>
							@endif
							@if($compt->descricao == "excel_intermediario")
							<input type="checkbox" disabled id="motivoA5" name="motivoA5" value="excel_intermediario" checked /> <font size="2">Excel Intermediário </font>   	
							@endif
							@if($compt->descricao == "excel_avancado")
							<input type="checkbox" disabled id="motivoA6" name="motivoA6" value="excel_avancado" checked /> <font size="2">Excel Avançado </font>
							@endif
							@if($compt->descricao == "outros")
							<input type="checkbox" disabled id="motivoA9" name="motivoA9" value="outros" onclick="desabilitarMotivo('sim')" checked /> <font size="2">Outros </font>
							<td>Apresentação de Outras Competências<textarea  disabled type="text" id="outras_competencias" name="outras_competencias" class="form-control form-control-sm" rows="5" cols="20"><?php echo $compt->outros; ?></textarea></td>
							@endif
							@if($compt->descricao == "ferramentas_gestao")
							<input type="checkbox" disabled id="motivoA8" name="motivoA8" value="ferramentas_gestao" checked /> <font size="2">Ferramentas de Gestão (PDCA/5S/MÉTODOS ÁGEIS) </font>
							@endif
							@endforeach
							@endif
							</td>
						</tr>
						</table>
						</center>
						@endforeach
				
						<center>		
						<table class="table table-bordered" style="height: 10px;">
						 <tr>
							<td width="40"><strong><font size="3"><b>Justificativa/Observações:</b></font></strong></td>
							<td><textarea type="text" disabled id="justificativa" name="justificativa" class="form-control form-control-sm" rows="3" cols="60"><?php echo $justificativa[0]->descricao; ?></textarea></td>
						 </tr>
						</table>
						</center>
						
						<center>	
						<table class="table table-bordered" style="height: 10px;">
						<tr>
							<td width="100" colspan="6"><strong>Aprovações (Carimbo e Assinatura):</strong></td>
						</tr>
						<tr>
						@if(!empty($data_aprovacao))
							<td width="200"><font size="2">SOLICITANTE</font></td>
							<td width="300"><font size="2"><?php if($solicitante == ""){ echo ""; } else { echo $solicitante; } ?></font></td>
							<td><input readonly type="text" id="data_aprovacao" name="data_aprovacao" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_aprovacao))); ?>" /></td>
							<td>
								<p align="justify">{{ $justificativa[0]->descricao }}</a>
							</td>
							@else
							<td>Solicitante </td>
							<td></td>
							<td><input readonly type="date" id="data_aprovacao" name="data_aprovacao" class="form-control form-control-sm" value="" /></td>	
							<td></td>
							@endif
						</tr> 
						<tr>
						@if(!empty($data_gestor_imediato))
							<td><font size="2">GESTOR IMEDIATO</font></td> 
							<td><font size="2"><?php if($gestorData == ""){ echo ""; } else { echo $gestorData[0]->nome; } ?></font></td>
							<td><input readonly type="text" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_gestor_imediato))); ?>" /></td>
							<td> 
							@foreach($aprovacao as $ap) 
							 @if($ap->vaga_id == $vagas[0]->id && $gestorDataId[0]->id == $ap->gestor_anterior)
								<p align="justify">{{ $ap->motivo }}</a>
							 @endif
							@endforeach
							</td>
						@else
							<td><font size="2">GESTOR IMEDIATO</font></td>
							<td></td>
							<td><input readonly type="date" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control form-control-sm" value="" /></td>   
							<td>
							@if(!empty($gestorDataId))
							 @foreach($aprovacao as $ap) 
							  @if($ap->vaga_id == $vagas[0]->id && $gestorDataId[0]->id == $ap->gestor_anterior)
								<p align="justify">{{ $ap->motivo }}</a>
							  @endif
							 @endforeach
							@endif
							</td>
						@endif	
						</tr>
						<tr>
						@if(!empty($data_rec_humanos))
							<td><font size="2">RECURSOS HUMANOS / DP</font></td>
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
							<td><input readonly type="text" id="data_rec_humanos" name="data_rec_humanos" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_rec_humanos))); ?>" /></td>
							<td> 
							@foreach($aprovacao as $ap) 
							 @if($ap->vaga_id == $vagas[0]->id && $rhId[0]->id == $ap->gestor_anterior)
								<p align="justify">{{ $ap->motivo }}</a>
							 @endif
							@endforeach
							</td>
						@else
							<td><font size="2">RECURSOS HUMANOS / DP</font></td>
							<td></td>
							<td><input readonly type="date" id="data_rec_humanos" name="data_rec_humanos" class="form-control form-control-sm" value="" /></td>   
							<td>
							@if(!empty($rhId))
							 @foreach($aprovacao as $ap) 
							  @if($ap->vaga_id == $vagas[0]->id && $rhId[0]->id == $ap->gestor_anterior)
								<p align="justify">{{ $ap->motivo }}</a>
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
							<td><input readonly type="text" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_diretoria_tecnica))); ?>" /></td>
							<td>
							@foreach($aprovacao as $ap) 
							 @if($ap->vaga_id == $vagas[0]->id && $diretoriaTId[0]->id == $ap->gestor_anterior)
								<p align="justify">{{ $ap->motivo }}</a>
							 @endif
							@endforeach
							</td>
						@else
							<td><font size="2">DIRETORIA TÉCNICA</font></td>
							<td></td>
							<td><input readonly type="date" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control form-control-sm" value="" /></td>   
							<td>
							@if(!empty($diretoriaTId))
							 @foreach($aprovacao as $ap) 
							  @if($ap->vaga_id == $vagas[0]->id && $diretoriaTId[0]->id == $ap->gestor_anterior)
								<p align="justify">{{ $ap->motivo }}</a>
							  @endif
							 @endforeach
							@endif
							</td>
						@endif	
						</tr>
						<tr>
						@if(!empty($data_diretoria_financeira))
							<td><font size="2">DIRETORIA FINANCEIRA</font></td>
							<td><font size="2"><?php if($diretoria == ""){ echo ""; } else { echo $diretoriaF[0]->nome; } ?></font></td>
							<td><input readonly type="text" id="data_diretoria_financeira" name="data_diretoria_financeira" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_diretoria_financeira))); ?>" /></td>
							<td>
							@if(!empty($diretoriaFId[0]->id))
							 @foreach($aprovacao as $ap) 
							  @if($ap->vaga_id == $vagas[0]->id && $diretoriaFId[0]->id == $ap->gestor_anterior)
								<p align="justify">{{ $ap->motivo }}</a>
							  @endif
							 @endforeach
							@endif
							</td>
						@else
							<td><font size="2">DIRETORIA FINANCEIRA</font></td>
							<td></td>
							<td><input readonly type="date" id="data_diretoria_financeira" name="data_diretoria_financeira" class="form-control form-control-sm" value="" /></td>   
							<td>
							@if(!empty($diretoriaFId))
							 @foreach($aprovacao as $ap) 
							  @if($ap->vaga_id == $vagas[0]->id && $diretoriaFId[0]->id == $ap->gestor_anterior)
								<p align="justify">{{ $ap->motivo }}</a>
							  @endif
							 @endforeach
							@endif
							</td>
						@endif
						</tr>
						<tr>
						@if(!empty($data_diretoria))
							<td><font size="2">DIRETORIA</font></td>
							<td><font size="2"><?php if($diretoria == ""){ echo ""; } else { echo $diretoria[0]->nome; } ?></font></td>
							<td><input readonly type="text" id="data_diretoria" name="data_diretoria" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_diretoria))); ?>" /></td>
							<td>
							@if(!empty($diretoriaId[0]->id))
							 @foreach($aprovacao as $ap) 
							  @if($ap->vaga_id == $vagas[0]->id && $diretoriaId[0]->id == $ap->gestor_anterior)
								<p align="justify">{{ $ap->motivo }}</a>
							  @endif
							 @endforeach
							@endif
							</td>
						@else
							<td><font size="2">DIRETORIA</font></td>
							<td></td>
							<td><input readonly type="date" id="data_diretoria" name="data_diretoria" class="form-control form-control-sm" value="" /></td>   
							<td>
							@if(!empty($diretoriaId))
							 @foreach($aprovacao as $ap) 
							  @if($ap->vaga_id == $vagas[0]->id && $diretoriaId[0]->id == $ap->gestor_anterior)
								<p align="justify">{{ $ap->motivo }}</a>
							  @endif
							 @endforeach
							@endif
							</td>
						@endif
						</tr>
						<tr>
						@if(!empty($data_superintendencia))
							<td><font size="2">SUPERINTENDÊNCIA</font></td>
							<td><font size="2"><?php if($super == ""){ echo ""; } else { echo $super[0]->nome; } ?></font></td>
							<td><input readonly type="text" id="data_superintendencia" name="data_superintendencia" class="form-control form-control-sm" value="<?php echo date('d-m-Y',(strtotime($data_superintendencia))); ?>" /></td>
							<td>
							@if(!empty($superId))	
							 @foreach($aprovacao as $ap) 
							  @if($ap->vaga_id == $vagas[0]->id && $superId[0]->id == $ap->gestor_anterior)
								<p align="justify">{{ $ap->motivo }}</a>
							  @endif
							 @endforeach
							@endif
							</td>
						@else
							<td><font size="2">SUPERINTENDÊNCIA</font></td>
							<td></td>
							<td><input readonly type="date" id="data_superintendencia" name="data_superintendencia" class="form-control form-control-sm" value="" /></td>   
							<td>
							@if(!empty($superId))
							 @foreach($aprovacao as $ap)
							  @if($ap->vaga_id == $vagas[0]->id && $superId[0]->id == $ap->gestor_anterior)
								<p align="justify">{{ $ap->motivo }}</a>
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
							<td align="center"> 
							<a id="imprimir" name="imprimir" type="button" class="btn btn-info btn-sm" style="color: #FFFFFF;"> Imprimir <i class="fas fa-box"></i> </a>  
							</td> 
						</tr>
						</table>
						</center>
						
						<center>
						<table class="table table-bordered" style="height: 10px;">
						<tr>
							<td align="left"> 
							<a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
							</td> 
							<td align="right"> 
							<?php $a = 0; ?> 
							@if((Auth::user()->name == $vagas[0]->solicitante && $vagas[0]->gestor_id == Auth::user()->id) && $vagas[0]->concluida == 0)
							<a href="{{ route('salvarVaga', array($vagas[0]->id,$gId)) }}" type="button" class="btn btn-success btn-sm" > CONCLUIR <i class="fas fa-check"></i> </a>
							@elseif(Auth::user()->id == 104 && $vagas[0]->gestor_id == 25)
								
							@elseif($vagas[0]->gestor_id == Auth::user()->id || $vagas[0]->gestor_id == 62 && Auth::user()->id == 61 && $vagas[0]->concluida == 0 && $vagas[0]->aprovada == 0)
								
							@if(empty($aprovacao))
							<a href="{{ route('n_autorizarVaga', $vagas[0]->id) }}" type="button" class="btn btn-danger btn-sm" > NÃO AUTORIZAR <i class="fas fa-times-circle"></i> </a>
							<a href="{{ route('autorizarVaga', $vagas[0]->id) }}" type="button" class="btn btn-success btn-sm" > AUTORIZAR <i class="fas fa-check"></i> </a>
							@else 
							@foreach($aprovacao as $ap)
								<?php if($ap->resposta == 3){ $a = 1; } ?>
							@endforeach	
							@if($a == 0)
								<a href="{{ route('n_autorizarVaga', $vagas[0]->id) }}" type="button" class="btn btn-danger btn-sm" > NÃO AUTORIZAR <i class="fas fa-times-circle"></i> </a>
								<a href="{{ route('autorizarVaga', $vagas[0]->id) }}" type="button" class="btn btn-success btn-sm" > AUTORIZAR <i class="fas fa-check"></i> </a>			
							@endif
							@endif
							
							@endif
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