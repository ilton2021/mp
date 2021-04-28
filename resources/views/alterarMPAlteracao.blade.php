<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Movimentação de Pessoal - Alterar</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script   src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
		<form action="{{route('updateMPAlteracao', array($idMP, $idA))}}" method="post">
		 <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
	      <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td colspan="2"><center><strong><h3><br>Alterar - Movimentação de Pessoal</h3></strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			</tr>
			@foreach($mps as $mp)
			<tr>
			  <td width="350">Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" title="{{ $unidade[0]->nome }}" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" title="{{ $unidade[0]->id }}" readonly="true" /></td>
			  <td width="200">Local de Trabalho: <input class="form-control" type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->id; ?>" title="{{ $unidade[0]->nome }}" readonly="true" required /></td>
			  <td width="100">Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo $mp->solicitante; ?>" title="{{ $mp->solicitante }}" /></td>
			</tr>
			<tr>
			  <td>Nome: <input class="form-control" type="text" id="nome" name="nome" value="<?php echo $mp->nome; ?>" title="{{ $mp->nome }}" required /></td>
			  <td>Matrícula: <input class="form-control" type="text" id="matricula" name="matricula" value="<?php echo $mp->matricula; ?>" title="{{ $mp->numeroMP }}" required /></td>
			  <td>Gestor Imediato: 
			  <select id="gestor_id" name="gestor_id" class="form-control" readonly="true" disabled="true">
			   <option id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->id ?>" title="{{ $gestor[0]->nome }}">{{ $gestor[0]->nome }}</option>
			  </select>
			</tr>
			<tr>
			 <td colspan="1">Departamento: <input class="form-control" type="text" id="departamento" name="departamento" value="<?php echo $mp->departamento; ?>" title="{{ $mp->departamento }}" required /></td>
			 <td>Número MP: <input class="form-control" type="text" id="numeroMP" name="numeroMP" value="<?php echo $mp->numeroMP; ?>" title="{{ $mp->numeroMP }}" required readonly="true" /></td>
			  <td>Data de Emissão: <input class="form-control" type="date" id="data_emissao" name="data_emissao" readonly="true" value="<?php echo $mp->data_emissao; ?>" title="{{ $mp->data_emissao }}" required /></td>
			</tr>
		   </table>
		  </center>
		  
		  <br>	 
		  <center>
			<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
			  <tr>
			   <td width="800px;" colspan="2"><center><strong><h4>Tipos de Movimentação</h4></strong></center></td>
		 	   <td >Data Prevista: <input class="form-control" type="date" id="data_prevista" name="data_prevista" value="<?php echo $mp->data_prevista; ?>" required  title="{{ $mp->data_prevista }}" /></td>
			  </tr>	
			</table>
		  </center>
		  @endforeach
 
		 @if(!empty($alteracaoF))
	 	  @foreach($alteracaoF as $altF)	 
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="130" rowspan="5"><center><h5>Alteração Funcional</h5> <input type="checkbox" id="tipo_mov3" name="tipo_mov3" checked disabled="true" /></center>
			<td width="300">Transferência proposta: Indique a Unidade 
			  <select id="unidade_id" name="unidade_id" class="form-control" disabled="true">
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
			<td colspan="2">Departamento Proposto 
				<input readonly="true" class="form-control" type="text" id="setor" name="setor" value="<?php echo $altF->setor; ?>" required />
				<select required class="form-control" id="setor" name="setor">
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
		    <td colspan="1">Cargo Atual:
 		 	 <input readonly="true" class="form-control" type="text" id="cargo_atual" name="cargo_atual" value="<?php echo $altF->cargo_atual; ?>" required />
			 <select required class="form-control" id="cargo_atual" name="cargo_atual">
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
			<td colspan="1" width="200">Cargo Proposto: 
			 <input readonly="true" class="form-control" type="text" id="cargo_novo" name="cargo_novo" value="<?php echo $altF->cargo_novo; ?>" required />
			  <select required class="form-control" id="cargo_novo" name="cargo_novo">
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
			<td width="50">Novo Horário de Trabalho <input class="form-control" type="text" id="horario_novo" name="horario_novo" value="<?php echo $altF->horario_novo; ?>" required /></td>
		   </tr>
		   <tr>
		    <td>Salário Atual: <input required class="form-control" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_atual" name="salario_atual" value="<?php echo $altF->salario_atual; ?>" /></td>
			<td width="100">Salário Proposto: <input required class="form-control" placeholder="ex-: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_novo" name="salario_novo" value="<?php echo $altF->salario_novo; ?>" /></td>
			<td width="200">Novo Centro de Custo: 
			  <input class="form-control" readonly="true" type="text" id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $altF->centro_custo_novo; ?>" required />
			  <select required name="centro_custo_novo" id="centro_custo_novo" class="form-control">	
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
			<td colspan="3">Motivo: <br><br> 
			@if($altF->motivo == "promocao")
						<input type="checkbox" checked id="motivo" name="motivo" value="promocao"  /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
						<input type="checkbox" id="motivo" name="motivo" value="merito"  /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_setor_area"  /> Mudança de Setor/Área &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="transferencia_outra_unidade"  /> Transferência para outra unidade <br><br>
						<input type="checkbox" id="motivo" name="motivo" value="enquadramento"  /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_horaria"  /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_voluntaria"  /> Substituição por demissão voluntária <br><br> 
						<input type="checkbox" id="motivo" name="motivo" value="recrutamento_interno"  /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="aumento_quadro"  /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_forcada"  /> Substituição por demissão forçada  </td>
						@elseif($altF->motivo == "merito")
						<input type="checkbox" id="motivo" name="motivo" value="promocao"  /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
						<input type="checkbox" checked id="motivo" name="motivo" value="merito"  /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_setor_area"  /> Mudança de Setor/Área &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="transferencia_outra_unidade"  /> Transferência para outra unidade <br><br>
						<input type="checkbox" id="motivo" name="motivo" value="enquadramento"  /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_horaria"  /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_voluntaria"  /> Substituição por demissão voluntária <br><br> 
						<input type="checkbox" id="motivo" name="motivo" value="recrutamento_interno"  /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="aumento_quadro"  /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_forcada"  /> Substituição por demissão forçada  </td>
						@elseif($altF->motivo == "mudanca_setor_area")
						<input type="checkbox" id="motivo" name="motivo" value="promocao"  /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
						<input type="checkbox" id="motivo" name="motivo" value="merito"  /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" checked id="motivo" name="motivo" value="mudanca_setor_area"  /> Mudança de Setor/Área &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="transferencia_outra_unidade"  /> Transferência para outra unidade <br><br>
						<input type="checkbox" id="motivo" name="motivo" value="enquadramento"  /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_horaria"  /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_voluntaria"  /> Substituição por demissão voluntária <br><br> 
						<input type="checkbox" id="motivo" name="motivo" value="recrutamento_interno"  /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="aumento_quadro"  /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_forcada"  /> Substituição por demissão forçada  </td>
						@elseif($altF->motivo == "transferencia_outra_unidade")
						<input type="checkbox" id="motivo" name="motivo" value="promocao"  /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
						<input type="checkbox" id="motivo" name="motivo" value="merito"  /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_setor_area"  /> Mudança de Setor/Área &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" checked id="motivo" name="motivo" value="transferencia_outra_unidade"  /> Transferência para outra unidade <br><br>
						<input type="checkbox" id="motivo" name="motivo" value="enquadramento"  /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_horaria"  /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_voluntaria"  /> Substituição por demissão voluntária <br><br> 
						<input type="checkbox" id="motivo" name="motivo" value="recrutamento_interno"  /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="aumento_quadro"  /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_forcada"  /> Substituição por demissão forçada  </td>
						@elseif($altF->motivo == "enquadramento")
						<input type="checkbox" id="motivo" name="motivo" value="promocao"  /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
						<input type="checkbox" id="motivo" name="motivo" value="merito"  /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_setor_area"  /> Mudança de Setor/Área &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="transferencia_outra_unidade"  /> Transferência para outra unidade <br><br>
						<input type="checkbox" checked id="motivo" name="motivo" value="enquadramento"  /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_horaria"  /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_voluntaria"  /> Substituição por demissão voluntária <br><br> 
						<input type="checkbox" id="motivo" name="motivo" value="recrutamento_interno"  /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="aumento_quadro"  /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_forcada"  /> Substituição por demissão forçada  </td>
						@elseif($altF->motivo == "mudanca_horaria")
						<input type="checkbox" id="motivo" name="motivo" value="promocao"  /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
						<input type="checkbox" id="motivo" name="motivo" value="merito"  /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_setor_area"  /> Mudança de Setor/Área &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="transferencia_outra_unidade"  /> Transferência para outra unidade <br><br>
						<input type="checkbox" id="motivo" name="motivo" value="enquadramento"  /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" checked id="motivo" name="motivo" value="mudanca_horaria"  /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_voluntaria"  /> Substituição por demissão voluntária <br><br> 
						<input type="checkbox" id="motivo" name="motivo" value="recrutamento_interno"  /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="aumento_quadro"  /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_forcada"  /> Substituição por demissão forçada  </td>
						@elseif($altF->motivo == "substituicao_demissao_voluntaria")
						<input type="checkbox" id="motivo" name="motivo" value="promocao"  /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
						<input type="checkbox" id="motivo" name="motivo" value="merito"  /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_setor_area"  /> Mudança de Setor/Área &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="transferencia_outra_unidade"  /> Transferência para outra unidade <br><br>
						<input type="checkbox" id="motivo" name="motivo" value="enquadramento"  /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_horaria"  /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" checked id="motivo" name="motivo" value="substituicao_demissao_voluntaria"  /> Substituição por demissão voluntária <br><br> 
						<input type="checkbox" id="motivo" name="motivo" value="recrutamento_interno"  /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="aumento_quadro"  /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_forcada"  /> Substituição por demissão forçada  </td>
						@elseif($altF->motivo == "recrutamento_interno")
						<input type="checkbox" id="motivo" name="motivo" value="promocao"  /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
						<input type="checkbox" id="motivo" name="motivo" value="merito"  /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_setor_area"  /> Mudança de Setor/Área &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="transferencia_outra_unidade"  /> Transferência para outra unidade <br><br>
						<input type="checkbox" id="motivo" name="motivo" value="enquadramento"  /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_horaria"  /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_voluntaria"  /> Substituição por demissão voluntária <br><br> 
						<input type="checkbox" checked id="motivo" name="motivo" value="recrutamento_interno"  /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="aumento_quadro"  /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_forcada"  /> Substituição por demissão forçada  </td>
						@elseif($altF->motivo == "aumento_quadro")
						<input type="checkbox" id="motivo" name="motivo" value="promocao"  /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
						<input type="checkbox" id="motivo" name="motivo" value="merito"  /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_setor_area"  /> Mudança de Setor/Área &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="transferencia_outra_unidade"  /> Transferência para outra unidade <br><br>
						<input type="checkbox" id="motivo" name="motivo" value="enquadramento"  /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_horaria"  /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_voluntaria"  /> Substituição por demissão voluntária <br><br> 
						<input type="checkbox" id="motivo" name="motivo" value="recrutamento_interno"  /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" checked id="motivo" name="motivo" value="aumento_quadro"  /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_forcada"  /> Substituição por demissão forçada  </td>
						@elseif($altF->motivo == "substituicao_demissao_forcada")
						<input type="checkbox" id="motivo" name="motivo" value="promocao"  /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
						<input type="checkbox" id="motivo" name="motivo" value="merito"  /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_setor_area"  /> Mudança de Setor/Área &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="transferencia_outra_unidade"  /> Transferência para outra unidade <br><br>
						<input type="checkbox" id="motivo" name="motivo" value="enquadramento"  /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="mudanca_horaria"  /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="substituicao_demissao_voluntaria"  /> Substituição por demissão voluntária <br><br> 
						<input type="checkbox" id="motivo" name="motivo" value="recrutamento_interno"  /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<input type="checkbox" id="motivo" name="motivo" value="aumento_quadro"  /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" checked id="motivo" name="motivo" value="substituicao_demissao_forcada"  /> Substituição por demissão forçada  </td>
						@endif
			</tr>
		  </table>
		  </center>
		  @endforeach 
		 @endif		
		 
		 <br>
		  <center>		
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="40"><strong><h5>Justificativa/Observações:</h5></strong></td>
			<td><textarea required type="text" id="descricao" name="descricao" class="form-control" rows="10" cols="60"> {{ $justificativa[0]->descricao }} </textarea></td>
		   </tr>
		  </table>
		  </center>
		 
		  <center>
		  <table class="table table" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td align="left"> 
			 <a href="{{route('indexValida')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
			</td> 
			<td align="right"> 
			 <input type="submit" class="btn btn-success btn-sm" value="Alterar" id="Salvar" name="Salvar" /> 
			</td>
		   </tr>
		  </table>
		  </center>
   </form>
</body>