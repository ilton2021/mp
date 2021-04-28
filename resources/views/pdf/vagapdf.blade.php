<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Abertura de Vaga - RH</title>
  
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<body> 
	      <center>
		   <table class="table table-bordered" border="1" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td colspan="2"><center><strong><h3><br>Solicitação de Abertura de Vaga - ORDINÁRIO</h3></strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			</tr>
			<tr>
			  <td width="340px">Unidade: <input type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
			  <td width="340px">Local de Trabalho:
			  <input type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome; ?>" readonly="true" />
			  </td>
			  <td>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo $vagas[0]->solicitante; ?>" /></td>
			</tr>
			
			<tr>
			  <td colspan="1">Vaga: <input class="form-control" type="text" id="vaga" name="vaga" required="true" value="<?php echo $vagas[0]->vaga; ?>" /></td>
			  <td> Código da Vaga: <input class="form-control" type="text" id="codigo_vaga" name="codigo_vaga" value="<?php echo $vagas[0]->codigo_vaga; ?>" /> </td>
			  <td> Gestor Imediato: <input class="form-control" type="text" id="gestor_id" name="gestor_id" value="<?php echo $gestor_nome; ?>" /></td>
			</tr>
			
			<tr>
			  <td colspan="2">Área: <input class="form-control" type="text" id="area" name="area" value="<?php echo $vagas[0]->area; ?>" required /></td>
			  <td>Vaga disponível em Edital: <br>  
			    <select class="form-control" id="edital_disponivel" name="edital_disponivel" required="true">
				 	@if($vagas[0]->edital_disponivel == 'Sim')
					<option id="edital_disponivel" name="edital_disponivel" value="Sim" selected> {{ 'Sim' }} </option>
				    @elseif($vagas[0]->edital_disponivel == 'Não')
					<option id="edital_disponivel" name="edital_disponivel" value="Não" selected> {{ 'Não' }}</option>
					@endif
				</select>
			</tr>
		   </table>
		  </center>
		  
		  
		  <br>	 
		  <center>
			<table class="table table-bordered" border="1" style="width: 1000px;" cellspacing="0">
			  <tr>
			   <td width="800px;" colspan="2"><center><strong><h4>Preenchimento da Área</h4></strong></center></td>
		 	   <td>Data Prevista: <input class="form-control" type="text" id="data_prevista" name="data_prevista" required value="<?php echo date('d-m-Y', strtotime($vagas[0]->data_prevista)); ?>" /></td>
			  </tr>	
			</table>
		  </center>
		  
		  <br>	 
		  <center>
		   <table class="table table-bordered" border="1" style="width: 1000px;" cellspacing="0">
		    </tr>
		    <tr>
			 <td rowspan="5" width="100px"><center><h5><b>Abertura e/ou Promoção</b></h5> </center></td>
			 <td width="270px">Cargo: 
				<input type="text" style="top-margin: 10px" class="form-control" id="cargo" name="cargo" value="<?php echo $vagas[0]->cargo; ?>" />
			 </td>
			 <td width="300px">Salário: <input class="form-control" type="text" id="salario" name="salario" value="<?php echo "R$ ".number_format($vagas[0]->salario, 2,',','.'); ?>" /></td>
			 <td width="200px">Horário de Trabalho: <br>
			    <select class="form-control" id="horario_trabalho" name="horario_trabalho" required="true">
				  @if($vagas[0]->horario_trabalho == '07:00 as 16:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00" selected>07h às 16h</option>
				  @elseif($vagas[0]->horario_trabalho == '08:00 as 17:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00" selected>08h às 17h</option>
				  @elseif($vagas[0]->horario_trabalho == '09:00 as 19:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00" selected>09h às 19h</option>
				  @elseif($vagas[0]->horario_trabalho == '19:00 as 07:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="19:00 as 07:00" selected>19h às 07h</option>
				  @else
				   <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				   Outro:
				   <input class="form-control"  type="text" id="horario_trabalho2" name="horario_trabalho2" value="<?php echo $vagas[0]->horario_trabalho2; ?>" />
				  @endif
				</select>
			 </td>
			</tr>
			<tr>
			 <td colspan="1" width="270px">Escala de Trabalho: <br><br> 
			 @if($vagas[0]->escala_trabalho == 'segxsex')
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" checked /> Segunda a Sexta <br>
			 @elseif($vagas[0]->escala_trabalho == '12x36')
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" checked /> 12x36 <br>
			 @elseif($vagas[0]->escala_trabalho == '12x60')
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" checked /> 12x60 <br>
			 @elseif($vagas[0]->escala_trabalho == 'outra')
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" checked onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $vagas[0]->escala_trabalho6; ?>" /> 
			 @endif
			 </td> 
			 <td width="300px">Centro de Custo: 
			   <input type="text" class="form-control" id="centro_custo" name="centro_custo" value="<?php echo $vagas[0]->centro_custo; ?>" />
			 </td>
			 <td width="250px">Jornada:
			    <select  class="form-control" id="jornada" name="jornada" required>
				  @if($vagas[0]->jornada == 'diarista')
				   <option id="jornada" name="jornada" value="diarista" selected>Diarista</option>
				  @elseif($vagas[0]->jornada == 'plantao_par')
				   <option id="jornada" name="jornada" value="plantao_par" selected>Plantão Par</option>
				  @elseif($vagas[0]->jornada == 'plantao_impar')
				   <option id="jornada" name="jornada" value="plantao_impar" selected>Plantão Ímpar</option>
				  @endif
				</select>
			 
			 <br>Turno: <br> 
			 @if($vagas[0]->turno == "dia")
			 <input type="checkbox" id="turno" name="turno" value="dia" checked /> Dia 
			 @elseif($vagas[0]->turno == "noite")
			 <input type="checkbox" id="turno2" name="turno" value="noite" checked /> Noite
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Tipo: <br> 
			 @if($vagas[0]->tipo == 'efetivo')
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" checked /> Efetivo 
		     @elseif($vagas[0]->tipo == 'estagiario')
			 <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" checked /> Estagiário 
			 @elseif($vagas[0]->tipo == 'temporario')
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" checked /> Temporário 
			 @elseif($vagas[0]->tipo == 'aprendiz')
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" checked /> Aprendiz 
			 @elseif($vagas[0]->tipo == 'rpa')
			 <input type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" checked /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="<?php echo $vagas[0]->periodo_contrato; ?>" /> 		
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Motivo: <br> 
			 @if($vagas[0]->motivo == 'aumento_quadro')
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" checked /> Aumento de Quadro 
			 @elseif($vagas[0]->motivo == 'substituicao_temporaria')
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" checked /> Substituição temporária 
			 @elseif($vagas[0]->motivo == 'segundo_vinculo')
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" checked /> Segundo Vínculo 
			 @elseif($vagas[0]->motivo == 'substituicao_definitiva')
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" checked /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" value="{{ old('motivo6') }}" /> 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td>Possibilidade de Contratação de Deficiente:<br> 
			 @if($vagas[0]->contratacao_deficiente == "sim")
			 <input type="checkbox" id="contratacao_deficiente" name="contratacao_deficiente" value="sim" checked /> Sim 
			 @elseif($vagas[0]->contratacao_deficiente == "nao")
			 <input type="checkbox" id="contratacao_deficiente2" name="contratacao_deficiente" value="nao" checked /> Não
			 @endif
			 </td>
			 <td colspan="2">Necessidade de conta de e-mail:<br> 
			 @if($vagas[0]->email == "sim")
			 <input type="checkbox" id="email" name="email" value="sim" checked /> Sim 
			 @elseif($vagas[0]->email == "nao")
			 <input type="checkbox" id="email2" name="email" value="nao" checked /> Não
			 @endif
			 </td>
			</tr>
		   </table>
		  </center>
			 
		  <br>
			
		  <center>
		  <table class="table table-bordered" border="1" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="135"><center><h5><b>Perfil Comportamental</b></h5> </center></td>
			<td width="600">Comportamental: 
			<br><br> 
			@foreach($comportamental as $comp)
			 @if($comp->descricao == "percepcao_visao")
				<input type="checkbox" id="comportamental1" name="comportamental1" value="percepcao_visao" checked /> Percepção e Visão
			 @endif
			 @if($comp->descricao == "inovacao")
				<input type="checkbox" id="comportamental2" name="comportamental2" value="inovacao" checked /> Inovação	 
			 @endif
			 @if($comp->descricao == "espirito_equipe")
				<input type="checkbox" id="comportamental3" name="comportamental3" value="espirito_equipe" checked /> Espírito de Equipe
			 @endif
			 @if($comp->descricao == "observacao_analise")
			    <input type="checkbox" id="comportamental4" name="comportamental4" value="observacao_analise" checked /> Observação e Análise 	 
			 @endif
			 @if($comp->descricao == "relacionamento")
				<input type="checkbox" id="comportamental5" name="comportamental5" value="relacionamento" checked /> Relacionamento 
			 @endif
			 @if($comp->descricao == "senso_urgencia")
				<input type="checkbox" id="comportamental6" name="comportamental6" value="senso_urgencia" checked /> Senso de Urgência
			 @endif
			 @if($comp->descricao == "lideranca")
				<input type="checkbox" id="comportamental7" name="comportamental7" value="lideranca" checked /> Liderança 
			 @endif
			 @if($comp->descricao == "dinamismo_execucao")
				<input type="checkbox" id="comportamental8" name="comportamental8" value="dinamismo_execucao" checked /> Dinamismo e Execução 
			 @endif
			 @if($comp->descricao == "foco_versatilidade")
				<input type="checkbox" id="comportamental10" name="comportamental10" value="foco_versatilidade" checked /> Foco e Versatilidade
			 @endif
			 @if($comp->descricao == "disseminacao_conhecimento")
				<input type="checkbox" id="comportamental11" name="comportamental11" value="disseminacao_conhecimento" checked /> Disseminação do Conhecimento 
			 @endif
			 @if($comp->descricao == "outros")
				<input type="checkbox" id="comportamental9" name="comportamental9" value="outros" onclick="desabilitarPerfil('sim')" checked /> Outros </td>
				<td>Apresentação de Outros Perfis: <br> <textarea type="text" id="perfil" name="perfil" class="form-control" required="true" rows="8" cols="60" value="">{{ $comp->descricao }}</textarea></td>  
			 @endif
			@endforeach
			</td>
		   </tr>
		  </table>
		  </center>
				
		  <br>
			
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" border="1" cellspacing="0">
		   <tr>
			<td width="120" rowspan="5"><center><h5><b>Perfil Técnico</b></h5> </center></td>
			<td width="300">Descreva no mínimo 03 conhecimentos técnicos <b>Necessários</b> para assumir a vaga: 
			<textarea required type="text" id="conhecimento_tecnico" name="conhecimento_tecnico" class="form-control" required="true" rows="5" cols="30" value=""><?php echo $vagas[0]->conhecimento_tecnico; ?></textarea>  
			<td width="300">Descreva no mínimo 03 conhecimentos técnicos <b>Desejados</b> para assumir a vaga: 
			<textarea required type="text" id="conhecimento_desejado" name="conhecimento_desejado" class="form-control" required="true" rows="5" cols="30" value=""><?php echo $vagas[0]->conhecimento_desejado; ?></textarea></td>   
			</tr>
		   <tr>
		    <td colspan="1">Formação Acadêmica: </td>
			<td colspan="1">Idiomas: </td>
		   </tr>
		   <tr>
			<td><textarea required type="text" id="formacao" name="formacao" class="form-control" required="true" rows="5" cols="30" value=""><?php echo $vagas[0]->formacao; ?></textarea></td>     
			<td><textarea required type="text" id="idiomas" name="idiomas" class="form-control" required="true" rows="5" cols="30" value=""><?php echo $vagas[0]->idiomas; ?></textarea></td>     
		   </tr>
		   <tr>
			<td>Competências: <br><br> 
			@foreach($competencias as $compe)
			 @if($compe->descricao == "conhecimento_windows")
				<input type="checkbox" id="motivoA1" name="motivoA1" value="conhecimento_windows" checked /> Conhecimentos em Windows 
			 @endif
			 @if($compe->descricao == "pacote_office")
				<input type="checkbox" id="motivoA2" name="motivoA2" value="pacote_office" checked /> Pacote Office 
			 @endif
			 @if($compe->descricao == "certificacao_especifica")
				<input type="checkbox" id="motivoA3" name="motivoA3" value="certificacao_especifica" checked /> Certificação Específica	 
			 @endif
			 @if($compe->descricao == "curso_atualizacao")
				<input type="checkbox" id="motivoA7" name="motivoA7" value="curso_atualizacao" checked /> Curso de Atualização da Área 
			 @endif
			 @if($compe->descricao == "excel_basico")
				<input type="checkbox" id="motivoA4" name="motivoA4" value="excel_basico" checked /> Excel Básico 
			 @endif
			 @if($compe->descricao == "excel_intermediario")
				<input type="checkbox" id="motivoA5" name="motivoA5" value="excel_intermediario" checked /> Excel Intermediário 
			 @endif
			 @if($compe->descricao == "excel_avancado")
				<input type="checkbox" id="motivoA6" name="motivoA6" value="excel_avancado" checked /> Excel Avançado 
			 @endif
			 @if($compe->descricao == "outros")
				<input type="checkbox" id="motivoA9" name="motivoA9" value="outros" onclick="desabilitarMotivo('sim')" checked /> Outros
				<td colspan="1"> Apresentação de Outras Competências 
				<textarea required type="text" id="outras_competencias" name="outras_competencias" class="form-control" required="true" rows="5" cols="20">{{ Request::old('outras_competencias') }}</textarea></td>
			 @endif
			 @if($compe->descricao == "ferramentas_gestao")
				<input type="checkbox" id="motivoA8" name="motivoA8" value="ferramentas_gestao" checked /> Ferramentas de Gestão (PDCA/5S/MÉTODOS ÁGEIS) 
			 @endif
			@endforeach
		   </tr>
		  </table>
		  </center>
			
		  <br>
		  <center>		
		  <table class="table table-bordered" border="1" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="40"><strong><h5>Justificativa/Observações:</h5></strong></td>
			<td><textarea type="text" id="justificativa" name="justificativa" class="form-control" required="true" rows="10" cols="60"><?php echo $justificativa[0]->descricao; ?></textarea></td>
		   </tr>
		  </table>
		  </center>
		  
		  <br>
		  <center>	
		  <table class="table table-bordered" style="width: 1000px;" border="1" cellspacing="0">
		   <tr>
			<td width="100" colspan="6"><strong>Aprovações (Carimbo e Assinatura):</strong></td>
		   </tr>
		   <tr>
			<td>Solicitante </td>
			<td><input readonly="true" type="date" id="data_solicitante" name="data_solicitante" class="form-control" /></td>
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
   </form>
</body>