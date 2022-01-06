<!DOCTYPE html>
@section('content')
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Abertura de Vaga - RH</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
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
<body> 
	  @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul> 
      </div>
	  @endif 		 
	  <form action="{{\Request::route('storeVaga'), $unidade[0]->id}}" method="POST">             
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			 @if($vagas[0]->concluida == 1)
			  <td colspan="2"><center><strong><h3>Concluído - Abertura de Vaga</h3></strong></center></td>
		     @else
			  <td colspan="2"><center><strong><h3>Visualizar - Abertura de Vaga</h3></strong></center></td>
		     @endif
			  <td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			</tr>
			@foreach($vagas as $vaga)
			<tr>
			  <td width="340px" hidden>Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
			  <td width="340px">Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
			  <td>Local de Trabalho:
			  <select class="form-control" id="local_trabalho" name="local_trabalho" disabled="true">
			     <option id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->id ?>">{{ $unidade[0]->nome }}</option>
			  </select>
			  </td>
			  <td>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo $vaga->solicitante; ?>" /></td>
			</tr>
			<tr>
			  <td colspan="1">Vaga: <input class="form-control" type="text" id="vaga" disabled="true" name="vaga" required="true" value="<?php echo $vaga->vaga; ?>" /></td>
			  <td> Código da Vaga: <input class="form-control" type="text" id="codigo_vaga" disabled="true" name="codigo_vaga" value="<?php echo $vaga->codigo_vaga; ?>" /> </td>
			  <td>Gestor Imediato: 
			  <select id="gestor_id" name="gestor_id" class="form-control" disabled="true">
			  <?php $dataI = date('d-m-Y', strtotime($data_rec_humanos)); ?> 
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
			  <td>Área: <input class="form-control" disabled="true" type="text" id="area" name="area" value="<?php echo $vaga->area; ?>" required /></td>
			  <td>Vaga disponível em Edital: <br>  
			    <select class="form-control" disabled="true" id="edital_disponivel" name="edital_disponivel" required="true">
				 	@if($vaga->edital_disponivel == 'Sim')
					<option id="edital_disponivel" name="edital_disponivel" value="Sim" selected> {{ 'Sim' }} </option>
				    @elseif($vaga->edital_disponivel == 'Não')
					<option id="edital_disponivel" name="edital_disponivel" value="Não" selected> {{ 'Não' }}</option>
					@endif
				</select>
			  </td>	
			  <td>Número da Vaga:
				  <input type="text" id="numeroVaga" name="numeroVaga" class="form-control" value="<?php echo $vaga->numeroVaga; ?>" readonly="true" />
			  </td>
			</tr>
		   </table>
		  </center>
		  
		  <br>	 
		  <center>
			<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
			  <tr>
			   <td width="600px;" colspan="2"><center><strong><h4>Preenchimento da Área</h4></strong></center></td>
			   <td>Data de Emissão:<input type="text" class="form-control" readonly="true" id="data_emissao" name="data_emissao" value="<?php echo date('d-m-Y', strtotime($vaga->data_emissao)); ?>"  /></td>
			   <td>Data Prevista: <input class="form-control" disabled="true" type="date" id="data_prevista" name="data_prevista" required value="<?php echo $vaga->data_prevista; ?>" /></td>
			  </tr>	
			</table>
		  </center>

		  <br>	 
		  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		    </tr>
		    <tr>
			 <td rowspan="5" width="150"><center><h5><b>Abertura e/ou Promoção</b></h5> </center>
			 <?php $a = 0; ?>
			 @if(Auth::user()->funcao == "RH" || (Auth::user()->name == $vagas[0]->solicitante && $vagas[0]->gestor_id == Auth::user()->id))
			  @if(empty($aprovacao))
			   <br><center><a class="btn btn-primary" href="{{ route('alterarVaga', $vaga->id) }}">Alterar</a></center>
			  @else 
			   @foreach($aprovacao as $ap)
				<?php if($ap->resposta == 3){ $a = 1; } ?>
			   @endforeach	
			   @if($a == 0)
				  <br><center><a class="btn btn-primary" href="{{ route('alterarVaga', $vaga->id) }}">Alterar</a></center>
			   @endif
			  @endif
			 @endif
			 </td>
			 <td colspan="1" width="1050">Cargo: 
			    <input type="text" disabled="true" class="form-control" id="cargo" name="cargo" value="<?php echo $vaga->cargo; ?>" />
			 </td>
			 <td width="370">Salário: <input class="form-control" disabled="true" type="text" required="true" id="salario" name="salario" value="<?php echo "R$ ".number_format($vaga->salario, 2,',','.'); ?>" title="ex: 2500 ou 2580,21" /></td>
			 <td width="200">Horário de Trabalho: <br>
			    <select class="form-control" disabled="true" id="horario_trabalho" name="horario_trabalho" required="true">
				  @if($vaga->horario_trabalho == '07:00 as 16:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00" selected>07h às 16h</option>
				  @elseif($vaga->horario_trabalho == '08:00 as 17:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00" selected>08h às 17h</option>
				  @elseif($vaga->horario_trabalho == '09:00 as 19:00')
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00" selected>09h às 19h</option>
				  @else
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  Outro:
				  <input class="form-control" disabled="true" type="text" id="horario_trabalho2" name="horario_trabalho2" value="<?php echo $vaga->horario_trabalho; ?>" />
				  @endif
				</select>
				
			 </td>
			</tr>
			<tr>
			 <td colspan="1" width="1050">Escala de Trabalho: <br><br> 
			 @if($vaga->escala_trabalho == 'segxsex')
			 <input type="checkbox" disabled="true" id="escala_trabalho" name="escala_trabalho" value="segxsex" checked /> Segunda a Sexta <br>
			 @elseif($vaga->escala_trabalho == '12x36')
			 <input type="checkbox" disabled="true" id="escala_trabalho2" name="escala_trabalho" value="12x36" checked /> 12x36 <br>
			 @elseif($vaga->escala_trabalho == '12x60')
			 <input type="checkbox" disabled="true" id="escala_trabalho3" name="escala_trabalho" value="12x60" checked /> 12x60 <br>
			 @else
			 <input type="checkbox" disabled="true" id="escala_trabalho4" name="escala_trabalho" value="outra" checked onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="<?php echo $vaga->escala_trabalho; ?>" /> 
			 @endif
			 </td> 
			 <td width="370">Centro de Custo: <input disabled="true" type="text" class="form-control" id="centro_custo" name="centro_custo" value="<?php echo $vaga->centro_custo; ?>" /> </td>
			 <td width="450">Jornada:
			    <select disabled="true"  class="form-control" id="jornada" name="jornada" required>
				  @if($vaga->jornada == 'diarista')
				   <option id="jornada" name="jornada" value="diarista" selected>Diarista</option>
				  @elseif($vaga->jornada == 'plantao_par')
				   <option id="jornada" name="jornada" value="plantao_par" selected>Plantão Par</option>
				  @elseif($vaga->jornada == 'plantao_impar')
				   <option id="jornada" name="jornada" value="plantao_impar" selected>Plantão Ímpar</option>
				  @endif
				</select>
			 
			 <br>Turno: <br> 
			 @if($vaga->turno == "dia")
			 <input type="checkbox" disabled="true" id="turno" name="turno" value="dia" checked /> Dia 
			 @elseif($vaga->turno == "noite")
			 <input type="checkbox" disabled="true" id="turno2" name="turno" value="noite" checked /> Noite
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Tipo: <br> 
			 @if($vaga->tipo == 'efetivo')
			 <input type="checkbox" disabled="true" id="tipo" name="tipo" value="efetivo" class="checkgroup" checked /> Efetivo 
		     @elseif($vaga->tipo == 'estagiario')
			 <input type="checkbox" disabled="true" id="tipo2" name="tipo" value="estagiario" class="checkgroup" checked /> Estagiário 
			 @elseif($vaga->tipo == 'temporario')
			 <input type="checkbox" disabled="true" id="tipo3" name="tipo" value="temporario" class="checkgroup" checked /> Temporário 
			 @elseif($vaga->tipo == 'aprendiz')
			 <input type="checkbox" disabled="true" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" checked /> Aprendiz 
			 @elseif($vaga->tipo == 'rpa')
			 <input type="checkbox" disabled="true" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" checked /> RPA - (Período do Contrato RPA): 
			 <input disabled="true" type="text" id="periodo_contrato" name="periodo_contrato" style="width: 200px" value="<?php echo $vaga->periodo_contrato; ?>" /> 		
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Motivo: <br> 
			 @if($vaga->motivo == 'aumento_quadro')
			 <input type="checkbox" disabled="true" id="motivo" name="motivo" value="aumento_quadro" checked /> Aumento de Quadro 
			 @elseif($vaga->motivo == 'substituicao_temporaria')
			 <input type="checkbox" disabled="true" id="motivo2" name="motivo" value="substituicao_temporaria" checked /> Substituição temporária 
			 @elseif($vaga->motivo == 'segundo_vinculo')
			 <input type="checkbox" disabled="true" id="motivo3" name="motivo" value="segundo_vinculo" checked /> Segundo Vínculo 
			 @elseif($vaga->motivo == 'substituicao_definitiva')
			 <input type="checkbox" disabled="true" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" checked /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" value="<?php echo $vaga->motivo2; ?>" /> 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td>Possibilidade de Contratação de Deficiente:<br> 
			 @if($vaga->contratacao_deficiente == "sim")
			 <input type="checkbox" disabled="true" id="contratacao_deficiente" name="contratacao_deficiente" value="sim" checked /> Sim 
			 @elseif($vaga->contratacao_deficiente == "nao")
			 <input type="checkbox" disabled="true" id="contratacao_deficiente2" name="contratacao_deficiente" value="nao" checked /> Não
			 @endif
			 </td>
			 <td colspan="2">Necessidade de conta de e-mail:<br> 
			 @if($vaga->email == "sim")
			 <input type="checkbox" disabled="true" id="email" name="email" value="sim" checked /> Sim 
			 @elseif($vaga->email == "nao")
			 <input type="checkbox" disabled="true" id="email2" name="email" value="nao" checked /> Não
			 @endif
			 </td>
			</tr>
		   </table>
		  </center>
			 
		  <br>
			
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="135"><center><h5><b>Perfil Comportamental</b></h5> </center></td>
			<td width="600">Comportamental: 
			<br><br> 
			@if(!empty($comportamental))
			@foreach($comportamental as $comp)
			@if($comp->descricao == "percepcao_visao")
			 <input type="checkbox" disabled="true" id="comportamental1" name="comportamental1" value="percepcao_visao" checked /> Percepção e Visão
		    @endif
			@if($comp->descricao == "inovacao")
			<input type="checkbox" disabled="true" id="comportamental2" name="comportamental2" value="inovacao" checked /> Inovação
			@endif
			@if($comp->descricao == "espirito_equipe")
			<input type="checkbox" disabled="true" id="comportamental3" name="comportamental3" value="espirito_equipe" checked /> Espírito de Equipe
			@endif
			@if($comp->descricao == "observacao_analise")
			<input type="checkbox" disabled="true" id="comportamental4" name="comportamental4" value="observacao_analise" checked /> Observação e Análise
			@endif
			@if($comp->descricao == "relacionamento")
			<input type="checkbox" disabled="true" id="comportamental5" name="comportamental5" value="relacionamento" checked /> Relacionamento
			@endif
			@if($comp->descricao == "senso_urgencia")
			<input type="checkbox" disabled="true" id="comportamental6" name="comportamental6" value="senso_urgencia" checked /> Senso de Urgência  
			@endif
			@if($comp->descricao == "lideranca")
			<input type="checkbox" disabled="true" id="comportamental7" name="comportamental7" value="lideranca" checked /> Liderança
			@endif
			@if($comp->descricao == "dinamismo_execucao")
			<input type="checkbox" disabled="true" id="comportamental8" name="comportamental8" value="dinamismo_execucao" checked /> Dinamismo e Execução
			@endif
			@if($comp->descricao == "outros")
			<input type="checkbox" disabled="true" id="comportamental9" name="comportamental9" value="outros" onclick="desabilitarPerfil('sim')" checked /> Outros
			<td>Apresentação de Outros Perfis: <br> <textarea type="text" disabled="true" id="perfil" name="perfil" class="form-control" required="true" rows="8" cols="60" value=""><?php echo $comp->outros; ?></textarea></td>  
			@endif
			@if($comp->descricao == "foco_versatilidade")
			<input type="checkbox" disabled="true" id="comportamental10" name="comportamental10" value="foco_versatilidade" checked /> Foco e Versatilidade
		    @endif
			@if($comp->descricao == "disseminacao_conhecimento")
			<input type="checkbox" disabled="true" id="comportamental11" name="comportamental11" value="disseminacao_conhecimento" checked /> Disseminação do Conhecimento
		    @endif
		    @endforeach
			<td>
			
		   </tr>
		  </table>
		  </center>
		  @endif		
		  <br>
		  	
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="135" rowspan="5"><center><h5><b>Perfil Técnico</b></h5> </center></td>
			<td width="500">Descreva no mínimo 03 conhecimentos técnicos <b>Necessários</b> para assumir a vaga: 
			<textarea required disabled="true" type="text" id="conhecimento_tecnico" name="conhecimento_tecnico" class="form-control" required="true" rows="5" cols="60" value=""><?php echo $vaga->conhecimento_tecnico; ?></textarea>  
			<td width="500">Descreva no mínimo 03 conhecimentos técnicos <b>Desejados</b> para assumir a vaga: 
			<textarea required disabled="true" type="text" id="conhecimento_desejado" name="conhecimento_desejado" class="form-control" required="true" rows="5" cols="60" value=""><?php echo $vaga->conhecimento_desejado; ?></textarea></td>   
			</tr>
		   <tr>
		    <td colspan="1">Formação Acadêmica: </td>
			<td colspan="1">Idiomas: </td>
		   </tr>
		   <tr>
			<td><textarea required type="text" disabled="true" id="formacao" name="formacao" class="form-control" required="true" rows="5" cols="60" value=""><?php echo $vaga->formacao; ?></textarea></td>     
			<td><textarea required type="text" disabled="true" id="idiomas" name="idiomas" class="form-control" required="true" rows="5" cols="60" value=""><?php echo $vaga->idiomas; ?></textarea></td>     
		   </tr>
		   <tr>
			<td>Competências: <br><br> 
			@if(!empty($competencias))
			@foreach($competencias as $compt)
			@if($compt->descricao == "conhecimento_windows")
			<input type="checkbox" disabled="true" id="motivoA1" name="motivoA1" value="conhecimento_windows" checked /> Conhecimentos em Windows
		    @endif
			@if($compt->descricao == "pacote_office")
			<input type="checkbox" disabled="true" id="motivoA2" name="motivoA2" value="pacote_office" checked /> Pacote Office 
		    @endif
			@if($compt->descricao == "certificacao_especifica")
			<input type="checkbox" disabled="true" id="motivoA3" name="motivoA3" value="certificacao_especifica" checked /> Certificação Específica 	
			@endif
			@if($compt->descricao == "curso_atualizacao")
			<input type="checkbox" disabled="true" id="motivoA7" name="motivoA7" value="curso_atualizacao" checked /> Curso de Atualização da Área
			@endif
			@if($compt->descricao == "excel_basico")
			<input type="checkbox" disabled="true" id="motivoA4" name="motivoA4" value="excel_basico" checked /> Excel Básico
			@endif
			@if($compt->descricao == "excel_intermediario")
			<input type="checkbox" disabled="true" id="motivoA5" name="motivoA5" value="excel_intermediario" checked /> Excel Intermediário   	
			@endif
			@if($compt->descricao == "excel_avancado")
			<input type="checkbox" disabled="true" id="motivoA6" name="motivoA6" value="excel_avancado" checked /> Excel Avançado
			@endif
			@if($compt->descricao == "outros")
			<input type="checkbox" disabled="true" id="motivoA9" name="motivoA9" value="outros" onclick="desabilitarMotivo('sim')" checked /> Outros
			<td>Apresentação de Outras Competências<textarea required disabled="true" type="text" id="outras_competencias" name="outras_competencias" class="form-control" required="true" rows="5" cols="20"><?php echo $compt->outros; ?></textarea></td>
			@endif
			@if($compt->descricao == "ferramentas_gestao")
			<input type="checkbox" disabled="true" id="motivoA8" name="motivoA8" value="ferramentas_gestao" checked /> Ferramentas de Gestão (PDCA/5S/MÉTODOS ÁGEIS)
			@endif
			@endforeach
			@endif
		   </tr>
		  </table>
		  </center>
		  @endforeach
		  <br>
		  <center>		
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="40"><strong><h5>Justificativa/Observações:</h5></strong></td>
			<td><textarea type="text" disabled="true" id="justificativa" name="justificativa" class="form-control" required="true" rows="10" cols="60"><?php echo $justificativa[0]->descricao; ?></textarea></td>
		   </tr>
		  </table>
		  </center>
		  
		  <br>
		  <center>	
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="100" colspan="6"><strong>Aprovações (Carimbo e Assinatura):</strong></td>
		   </tr>
		   <tr>
		   @if(!empty($data_aprovacao))
			  <td>Solicitante </td>
			  <td><?php if($solicitante == ""){ echo ""; } else { echo $solicitante; } ?></td>
			  <td><input readonly="true" type="text" id="data_aprovacao" name="data_aprovacao" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_aprovacao))); ?>" /></td>
			  <td>
			     <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $justificativa[0]->descricao }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			 </td>
			@else
			  <td>Solicitante </td>
			  <td></td>
		      <td><input readonly="true" type="date" id="data_aprovacao" name="data_aprovacao" class="form-control" value="" /></td>	
			  <td></td>
			@endif
		   </tr> 
		   <tr>
		   @if(!empty($data_gestor_imediato))
			<td>Gestor Imediato</td> 
			<td><?php if($gestorData == ""){ echo ""; } else { echo $gestorData[0]->nome; } ?></td>
			<td><input readonly="true" type="text" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_gestor_imediato))); ?>" /></td>
		    <td> 
			@foreach($aprovacao as $ap) 
			  @if($ap->vaga_id == $vagas[0]->id && $gestorDataId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			</td>
		   @else
			<td>Gestor Imediato</td>
		    <td></td>
			<td><input readonly="true" type="date" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control" value="" /></td>   
		    <td>
			@if(!empty($gestorDataId))
			@foreach($aprovacao as $ap) 
			  @if($ap->vaga_id == $vagas[0]->id && $gestorDataId[0]->id == $ap->gestor_anterior)
				<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				</button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				</div></center>
			  @endif
			@endforeach
			@endif
			</td>
		   @endif	
		   </tr>
		   <tr>
		   @if(!empty($data_rec_humanos))
			<td>Rec. Humanos</td>
			<?php $dataI = date('d-m-Y', strtotime($data_rec_humanos)); ?> 
			<?php $dataF = date('d-m-Y', strtotime('02-09-2021')); ?>
			<?php $dataFJana = date('d-m-Y', strtotime('22-10-2021'));?>
			<?php if(strtotime($dataI) < strtotime($dataF)){  ?>
			<td><?php if($rh == ""){ echo ""; } else { echo 'RAFAELA CARAZZAI'; } ?></td>	
			<?php } else if(strtotime($dataI) < strtotime($dataFJana)) {  ?>
			<td><?php if($rh == ""){ echo ""; } else { echo 'JANAINA GLAYCE PEREIRA LIMA'; } ?></td>	
			<?php } else {  ?>
			<td><?php if($rh == ""){ echo ""; } else { echo 'ANA AMÉRICA OLIVEIRA DE ARRUDA'; } ?></td>	
			<?php } ?>
			<td><input readonly="true" type="text" id="data_rec_humanos" name="data_rec_humanos" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_rec_humanos))); ?>" /></td>
			<td> 
			@foreach($aprovacao as $ap) 
			  @if($ap->vaga_id == $vagas[0]->id && $rhId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			</td>
		   @else
			<td>Rec. Humanos</td>
			<td></td>
			<td><input readonly="true" type="date" id="data_rec_humanos" name="data_rec_humanos" class="form-control" value="" /></td>   
			<td>
			@if(!empty($rhId))
			@foreach($aprovacao as $ap) 
			  @if($ap->vaga_id == $vagas[0]->id && $rhId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			@endif
			</td>
		   @endif	
		   </tr>
		   <tr>
		   @if(!empty($data_diretoria_tecnica))
			<td>Diretoria Técnica</td>
			<td><?php if($diretoriaT == ""){ echo ""; } else { echo $diretoriaT[0]->nome; } ?></td>
			<td><input readonly="true" type="text" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_diretoria_tecnica))); ?>" /></td>
			<td>
			@foreach($aprovacao as $ap) 
			  @if($ap->vaga_id == $vagas[0]->id && $diretoriaTId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			</td>
		   @else
		   	<td>Diretoria Técnica</td>
		   	<td></td>
		   	<td><input readonly="true" type="date" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control" value="" /></td>   
			<td>
			@if(!empty($diretoriaTId))
			@foreach($aprovacao as $ap) 
			  @if($ap->vaga_id == $vagas[0]->id && $diretoriaTId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			@endif
			</td>
		   @endif	
		   </tr>
		   <tr>
		   @if($vagas[0]->unidade_id == 2)
		   @if(!empty($data_diretoria_financeira))
			<td>Diretoria Financeira</td>
			<td><?php if($diretoria == ""){ echo ""; } else { echo $diretoriaF[0]->nome; } ?></td>
			<td><input readonly="true" type="text" id="data_diretoria_financeira" name="data_diretoria_financeira" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_diretoria_financeira))); ?>" /></td>
			<td>
			@if(!empty($diretoriaFId[0]->id))
			@foreach($aprovacao as $ap) 
			  @if($ap->vaga_id == $vagas[0]->id && $diretoriaFId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			@endif
			</td>
		   @else
		    <td>Diretoria Financeira</td>
			<td></td>
			<td><input readonly="true" type="date" id="data_diretoria_financeira" name="data_diretoria_financeira" class="form-control" value="" /></td>   
			<td>
			@if(!empty($diretoriaFId))
			@foreach($aprovacao as $ap) 
			  @if($ap->vaga_id == $vagas[0]->id && $diretoriaFId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			@endif
			@endif
			</td>
		   @endif
		   </tr>
		   <tr>
		   @if(!empty($data_diretoria))
			<td>Diretoria</td>
			<td><?php if($diretoria == ""){ echo ""; } else { echo $diretoria[0]->nome; } ?></td>
			<td><input readonly="true" type="text" id="data_diretoria" name="data_diretoria" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_diretoria))); ?>" /></td>
			<td>
			@if(!empty($diretoriaId[0]->id))
			@foreach($aprovacao as $ap) 
			  @if($ap->vaga_id == $vagas[0]->id && $diretoriaId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			@endif
			</td>
		   @else
		    <td>Diretoria</td>
			<td></td>
			<td><input readonly="true" type="date" id="data_diretoria" name="data_diretoria" class="form-control" value="" /></td>   
			<td>
			@if(!empty($diretoriaId))
			@foreach($aprovacao as $ap) 
			  @if($ap->vaga_id == $vagas[0]->id && $diretoriaId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			@endif
			</td>
		   @endif
		   </tr>
		   <tr>
		   @if(!empty($data_superintendencia))
			<td>Superintendência</td>
			<td><?php if($super == ""){ echo ""; } else { echo $super[0]->nome; } ?></td>
			<td><input readonly="true" type="text" id="data_superintendencia" name="data_superintendencia" class="form-control" value="<?php echo date('d-m-Y',(strtotime($data_superintendencia))); ?>" /></td>
			<td>
			@if(!empty($superId))	
			@foreach($aprovacao as $ap) 
			  @if($ap->vaga_id == $vagas[0]->id && $superId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			@endif
			</td>
		   @else
		    <td>Superintendência</td>
		    <td></td>
		    <td><input readonly="true" type="date" id="data_superintendencia" name="data_superintendencia" class="form-control" value="" /></td>   
			<td>
			@if(!empty($superId))
			@foreach($aprovacao as $ap)
			  @if($ap->vaga_id == $vagas[0]->id && $superId[0]->id == $ap->gestor_anterior)
				 <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $ap->id; ?>" > 
			     Mensagem
				 </button>
				 <div class="modal fade" id='exampleModal<?php echo $ap->id; ?>' role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class='modal-content'>
						  <div class='modal-header'>
							<h5 class='modal-title' align="left"></h5>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>
						  </div>
						  <div class='modal-body'>
							<div class='panel panel-default'>
							 <div class='panel-heading'><b>Mensagem:</b> </div>
							 <div class='panel-body'>
								<p align="justify">{{ $ap->motivo }}</a>
							 </div>
							</div>
						  </div>
						  <div class='modal-footer'>
							<span class='codigo'></span>
						  </div>
					   </div>
					 </div>
				 </div></center>
			  @endif
			@endforeach
			@endif
			</td>
		   @endif
		   </tr>
		   </table>
		  </center>
		  
		  <center>
		  <table class="table table-bordered"  style="width: 100px;" cellspacing="0">
		   <tr>
		    <td align="center"> 
			 <a id="imprimir" name="imprimir" type="button" class="btn btn-info btn-sm" style="color: #FFFFFF;"> Imprimir <i class="fas fa-box"></i> </a>  
			</td> 
		   </tr>
		  </table>
		  </center>
		  
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
		    @if($vagas[0]->concluida == 0)
		    <td align="left"> 
			 <a href="{{route('criadasVagas')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
			</td> 
			@elseif($vagas[0]->concluida == 1 && $vagas[0]->aprovada == 1)
			<td align="left"> 
			 <a href="{{route('aprovadasVagas')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
			</td> 
			@elseif($vagas[0]->concluida == 1 && $vagas[0]->aprovada == 0)
			<td align="left"> 
			 <a href="{{route('reprovadasVagas')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
			</td> 
			@endif
			<td align="right"> 
			<?php $a = 0; ?> 
			@if((Auth::user()->name == $vagas[0]->solicitante && $vagas[0]->gestor_id == Auth::user()->id) && $vagas[0]->concluida == 0)
			  <a href="{{ route('salvarVaga', array($vagas[0]->id,$gId)) }}" type="button" class="btn btn-success btn-sm" > Concluir <i class="fas fa-times-circle"></i> </a>
			@elseif(Auth::user()->id == 104 && $vagas[0]->gestor_id == 25)
				
			@elseif($vagas[0]->gestor_id == Auth::user()->id && $vagas[0]->concluida == 0 && $vagas[0]->aprovada == 0)
				
			 @if(empty($aprovacao))
			  <a href="{{ route('n_autorizarVaga', $vagas[0]->id) }}" type="button" class="btn btn-danger btn-sm" > Não Autorizar <i class="fas fa-times-circle"></i> </a>
			  <a href="{{ route('autorizarVaga', $vagas[0]->id) }}" type="button" class="btn btn-success btn-sm" > Autorizar <i class="fas fa-check"></i> </a>
			 @else 
			  @foreach($aprovacao as $ap)
				<?php if($ap->resposta == 3){ $a = 1; } ?>
			  @endforeach	
			  @if($a == 0)
				  <a href="{{ route('n_autorizarVaga', $vagas[0]->id) }}" type="button" class="btn btn-danger btn-sm" > Não Autorizar <i class="fas fa-times-circle"></i> </a>
				  <a href="{{ route('autorizarVaga', $vagas[0]->id) }}" type="button" class="btn btn-success btn-sm" > Autorizar <i class="fas fa-check"></i> </a>			
			  @endif
			 @endif
			
			@endif
			</td>
		   </tr>
		  </table>
		  </center>
   </form>
</body>