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
				  <form action="{{\Request::route('storeInscricaoPD', $pd[0]->id)}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<center>
						<table class="table table-bordered"> 
							<tr>
							<td colspan="2"><center><strong><h4><br>Programa Degrau - INSCRIÇÃO</h4></strong></center></td>
							<td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="concluida" name="concluida" value="0" readonly /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="aprovada" name="aprovada" value="0" readonly /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="vaga_interna_id" name="vaga_interna_id" value="" readonly /></td>
							</tr>
							<tr>
							<td>Unidade: <input class="form-control form-control-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly /></td>
							<td hidden><input class="form-control form-control-sm" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly /></td>
							<td>Local de Trabalho:
								<input type="text" readonly id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome; ?>" class="form-control form-control-sm"></option>
							</td>
							<td hidden>Solicitante: <input readonly class="form-control form-control-sm" type="text" id="solicitante" name="solicitante" required value="<?php echo Auth::user()->id; ?>" /></td>
							<td>Solicitante: <input readonly class="form-control form-control-sm" type="text" id="solicitante_" name="solicitante_" required value="<?php echo Auth::user()->name; ?>" /></td>
							</tr>
							<tr>
							<td colspan="1">Vaga: <input class="form-control form-control-sm" type="text" id="vaga" name="vaga" readonly value="<?php echo $pd[0]->vaga; ?>" /></td>
							<td>Código da Vaga: <input class="form-control form-control-sm" type="text" id="codigo_vaga" name="codigo_vaga" value="<?php echo $pd[0]->codigo_vaga; ?>" readonly /> </td>
							<td hidden><input readonly class="form-control form-control-sm" type="text" id="gestor_id" name="gestor_id" required value="73" /></td>
							<td>Gestor Imediato: <input readonly class="form-control form-control-sm" type="text" id="gestor" name="gestor" required value="JANAINA GLAYCE PEREIRA LIMA" /></td>
							</tr>
							<tr>
							<td>Departamento Atual: 
								<input type="text" class="form-control form-control-sm" id="departamento" name="departamento" value="<?php echo $pd[0]->departamento; ?>" readonly>
							</td>
							<td>Data de Emissão: <input class="form-control form-control-sm" type="text" id="data_emissao" name="data_emissao" value="<?php echo date('d-m-Y', strtotime('now')); ?>" readonly /></td>
							<td>Data Prevista: <input class="form-control form-control-sm" type="text" id="data_prevista" name="data_prevista" readonly value="<?php echo date('d-m-Y', strtotime($pd[0]->data_prevista)); ?>" /></td>
							</tr>
						</table>
						</center>
					
						<center>
						<table class="table table-bordered table-sm" style="height: 10px">
						  <tr>
							<td colspan="3"> <b>Funcionário:</b> </td>
						  </tr>
						  <tr>
						    <td> Nome: <input type="text" name="nome_funcionario" id="nome_funcionario" class="form-control form-control-sm" required /></td>
							<td> Matrícula: <input type="text" name="matricula_funcionario" id="matricula_funcionario" class="form-control form-control-sm" required /> </td>
							<td> Unidade: 
							  <select class="form-control form-control-sm" id="unidade_funcionario" name="unidade_funcionario" required>
							 	<option id="unidade_funcionario" name="unidade_funcionario" value=""> Selecione... </option>
								@foreach($unidades as $und)
								  <option id="unidade_funcionario" name="unidade_funcionario" value="<?php echo $und->nome; ?>">{{ $und->nome }} </option>
								@endforeach
							  </select>
							</td>
						  </tr>
						</table>	
						</center>

						<center>
						<table class="table table-bordered">
							</tr>
							<tr>
							<td rowspan="5" width="150"><center><font size="3"><b>Abertura de Vaga</b></font> </center></td>
							<td>Cargo: 
								<select class="form-control form-control-sm" id="cargo" name="cargo" readonly>
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
							<td>Salário: <input class="form-control form-control-sm" type="number" readonly id="salario" name="salario" value="<?php echo $pd[0]->salario; ?>" title="ex: 2500 ou 2580,21" /></td>
							<td>Horário de Trabalho: <br>
								<select class="form-control form-control-sm" id="horario_trabalho" name="horario_trabalho" readonly>
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
								<option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
								<option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
								<option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
								<option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00" selected>19h às 07h</option>
								<option id="horario_trabalho" name="horario_trabalho" value="0" selected>Outro...</option>	  
								Outro:
								<input class="form-control form-control-sm" readonly type="text" id="horario_trabalho2" name="horario_trabalho2" value="<?php echo $pd[0]->horario_trabalho; ?>" />
								@endif
								</select>
							</td>
							</tr>
							<tr>
							<td>Escala de Trabalho: <br>
							<select class="form-control form-control-sm" id="horario_trabalho" name="horario_trabalho" readonly>
								@if($pd[0]->escala_trabalho == 'segxsex')
								<option id="escala_trabalho" name="escala_trabalho" value="Seg x Sex" selected disabled> Segunda a Sexta </option>
								@elseif($pd[0]->escala_trabalho == '12x36')
								<option id="escala_trabalho" name="escala_trabalho" value="12x36" selected disabled> 12x36 </option>
								@elseif($pd[0]->escala_trabalho == '12x60')
								<option id="escala_trabalho" name="escala_trabalho" value="12x60" selected disabled> 12x60 </option>
								@else
								<option id="escala_trabalho" name="escala_trabalho" value="outra" disabled selected readonly  onclick="desabilitarOutra('sim')"> Outra: </option>
								<br><input class="form-control form-control-sm" disabled type="text" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $pd[0]->escala_trabalho; ?>" /> 
								@endif
							</select>
							</td> 
							<td>Centro de Custo: 
							<select id="centro_custo"  name="centro_custo" class="form-control form-control-sm" disabled>
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
							<td>Jornada:
								<select class="form-control form-control-sm" id="jornada" name="jornada" disabled>
								@if($pd[0]->jornada == 'diarista')
								<option id="jornada" name="jornada" value="diarista" selected>Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
								@elseif($pd[0]->jornada == 'plantao_par')
								<option id="jornada" name="jornada" value="diarista">Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par" selected>Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
								@elseif($pd[0]->jornada == 'plantao_impar')
								<option id="jornada" name="jornada" value="diarista">Diarista</option>
								<option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
								<option id="jornada" name="jornada" value="plantao_impar" selected>Plantão Ímpar</option>
								@endif
								</select>
							<br>Turno: <br> 
							<select class="form-control form-control-sm" id="turno" name="turno" disabled>
								@if($pd[0]->turno == "dia")
								<option id="turno" name="turno" value="dia" selected disabled> Dia </option>
								@elseif($pd[0]->turno == "noite")
								<option id="turno" name="turno" value="noite" selected disabled> Noite </option>
								@endif
							</select>
							</td>
							</tr>
							<tr>
							<td>Tipo: <br> 
							<select class="form-control form-control-sm" id="tipo" name="tipo" disabled>
								@if($pd[0]->tipo == 'efetivo')
								<option id="tipo" name="tipo" value="Efetivo" selected disabled> Efetivo </option>
								@elseif($pd[0]->tipo == 'estagiario')
								<option id="tipo" name="tipo" value="Estagiário" selected  disabled> Estagiário </option>
								@elseif($pd[0]->tipo == 'temporario')
								<option id="tipo" name="tipo" value="Temporário" selected disabled> Temporário </option>
								@elseif($pd[0]->tipo == 'aprendiz')
								<option id="tipo" name="tipo" value="Aprendiz" disabled selected> Aprendiz </option>
								@elseif($pd[0]->tipo == 'rpa')
								<option id="tipo" name="tipo" value="RPA" onclick="desabilitarRPA('sim')" disabled selected> RPA - (Período do Contrato RPA): </option> 
								<input disabled class="form-control form-control-sm" type="text" id="periodo_contrato" name="periodo_contrato" value="<?php echo $pd[0]->periodo_contrato; ?>" /> 		
								@endif
							</select>
							</td>
							<td>Motivo: <br> 
							<select class="form-control form-control-sm" id="motivo" name="motivo" disabled>
								@if($pd[0]->motivo == 'aumento_quadro')
								<option id="motivo" name="motivo" value="aumento_quadro" selected disabled> Aumento de Quadro </option>
								@elseif($pd[0]->motivo == 'substituicao_temporaria')
								<option id="motivo" name="motivo" value="substituicao_temporaria" selected disabled> Substituição temporária </option>
								@elseif($pd[0]->motivo == 'segundo_vinculo')
								<option id="motivo" name="motivo" value="segundo_vinculo" selected disabled> Segundo Vínculo </option>
								@else
								<option id="motivo" name="motivo" value="substituicao_definitiva" disabled selected onclick="desabilitarSubst('sim')"> Substituição definitiva a: </option>
								<input class="form-control form-control-sm" disabled type="text" id="motivo" name="motivo" value="<?php echo $pd[0]->motivo2; ?>" /> 
								@endif
							</select>
							</td>
							</tr>
							<tr>
							<td>Possibilidade de Contratação de Deficiente:<br> 
							<select class="form-control form-control-sm" id="contratacao_deficiente" name="contratacao_deficiente" disabled>
								@if($pd[0]->contratacao_deficiente == "sim")
								<option id="contratacao_deficiente" name="contratacao_deficiente" value="sim" selected> Sim </option>
								@elseif($pd[0]->contratacao_deficiente == "nao")
								<option id="contratacao_deficiente" name="contratacao_deficiente" value="nao" selected> Não </option>
								@endif 
							</select>
							</td>
							<td>Necessidade de conta de e-mail:<br> 
							<select class="form-control form-control-sm" id="email" name="email" disabled>
								@if($pd[0]->email == "sim")
								<option id="email" name="email" value="sim" selected> Sim </option>
								@elseif($pd[0]->email == "nao")
								<option id="email" name="email" value="nao" selected> Não </option>
								@endif
							</select>
							</td>
							</tr>
						</table>
						</center>
							
						<center>
						<table class="table table-bordered">
						<tr>
							<td width="135" rowspan="2"><center><font size="3"><b>Perfil Comportamental</b></font> </center></td>
							<td>Comportamental cadastradas: 
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
							<input type="checkbox" disabled id="comportamental6" name="comportamental6" value="senso_urgencia" checked /> <font size="2">Senso de Urgência</font> 
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
						Apresentação de Outros Perfis: <br> 
							@foreach($comportamental as $cp)
							@if($cp->outros != "")
							<textarea type="text" disabled id="perfil" name="perfil" class="form-control form-control-sm" required rows="8" cols="40" value=""><?php if(!empty($cp)){echo $cp->outros;}else{echo "";} ?></textarea>
							@endif
							@endforeach
						</td>
						</tr>
						</table>
						</center>
								
						<center>
						<table class="table table-bordered">
						<tr>
							<td width="135" rowspan="5"><center><font size="3"><b>Perfil Técnico</b></font></center></td>
							<td>Descreva no mínimo 03 conhecimentos técnicos <b>Necessários</b> para assumir a vaga: 
							<textarea disabled type="text" id="conhecimento_tecnico" name="conhecimento_tecnico" class="form-control form-control-sm" required rows="5" cols="60" value=""><?php echo $pd[0]->conhecimento_tecnico; ?></textarea>  
							<td>Descreva no mínimo 03 conhecimentos técnicos <b>Desejados</b> para assumir a vaga: 
							<textarea disabled type="text" id="conhecimento_desejado" name="conhecimento_desejado" class="form-control form-control-sm" required rows="5" cols="60" value=""><?php echo $pd[0]->conhecimento_desejado; ?></textarea></td>   
							</tr>
						<tr>
							<td>Formação Acadêmica: </td>
							<td>Idiomas: </td>
						</tr>
						<tr>
							<td><textarea disabled type="text" id="formacao" name="formacao" class="form-control form-control-sm" required rows="5" cols="60" value=""><?php echo $pd[0]->formacao; ?></textarea></td>     
							<td><textarea disabled type="text" id="idiomas" name="idiomas" class="form-control form-control-sm" required rows="5" cols="60" value=""><?php echo $pd[0]->idiomas; ?></textarea></td>     
						</tr>
						<tr>
						<td colspan="2">Competências  cadastradas: <br><br>
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
							<td colspan="2"> Apresentação de Outras Competências: <br><br> 
							@foreach($competencias as $cp)
							@if($cp->outros != "")
							<textarea disabled required type="text" id="outras_competencias" name="outras_competencias" class="form-control form-control-sm" required rows="5" cols="20"><?php echo $cp->outros; ?></textarea></td>	
							@endif
							@endforeach 
							</td>
						</tr>
						</table>
						</center>

						<center>		
						<table class="table table-bordered" style="height: 10px;">
						<tr>
							<td width="40"><strong><font size="3">Justificativa/Observações:</font></strong></td>
							<td><textarea type="text" id="descricao" name="descricao" class="form-control form-control-sm" required rows="4" cols="60" value="<?php echo $just_v[0]->descricao; ?>" readonly>{{ $just_v[0]->descricao }}</textarea></td>
						</tr>
						</table>
						</center>

						<center>
						<table class="table table-bordered" style="height: 10px;">
						<tr>
							<td align="right"> 
							<a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
							<input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="CONCLUIR" id="Salvar" name="Salvar" /> 
							</td>
						</tr>
						</table>
						</center>
                  </div>
                </fieldset> 
             </div>
        </div>
    </div>
</div>
</body>
</HTML>