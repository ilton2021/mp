<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Programa Degrau - RH</title>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<body> 
	      <center>
		   <table class="table table-bordered" border="1" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td colspan="2"><center><strong><h3><br>Programa Degrau</h3></strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			</tr>
			<tr>
			  <td width="340px">Unidade: <input type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
			  <td width="340px">Local de Trabalho:
			  <input type="text" id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->nome; ?>" readonly="true" />
			  </td>
			  <td>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo $pd[0]->solicitante; ?>" /></td>
			</tr>
			
			<tr>
			  <td colspan="1">Vaga: <input class="form-control" type="text" id="vaga" name="vaga" required="true" value="<?php echo $pd[0]->vaga; ?>" /></td>
			  <td> Código da Vaga: <input class="form-control" type="text" id="codigo_vaga" name="codigo_vaga" value="<?php echo $pd[0]->codigo_vaga; ?>" /> </td>
			  <td> Gestor Imediato: <input class="form-control" type="text" id="gestor_id" name="gestor_id" value="<?php echo 'CAMILA FERNANDES'; ?>" /></td>
			</tr>
			
			<tr>
			  <td>Departamento Atual: 
			  <input type="text" id="departamento" name="departamento" value="<?php echo $pd[0]->departamento; ?>" class="form-control" /> 
			  </td>
			  <td>Data de Emissão da Vaga: <input class="form-control" type="text" id="data_emissao" name="data_emissao" value="<?php echo date('d-m-Y', strtotime('now')); ?>" /></td>
			  <td>Data Prevista: <input class="form-control" type="text" id="data_prevista" name="data_prevista" required value="<?php echo date('d-m-Y', strtotime($pd[0]->data_prevista)); ?>" /></td>
			</tr>
		   </table>
		  </center>
		  
		  <br>	 
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="400">Unidade Atual 
			  <input type="text" class="form-control" id="unidade_atual" name="unidade_atual" value="<?php echo $pd[0]->unidade_atual; ?>" />
			<td width="400">Unidade Proposta 
			  <input type="text" class="form-control" id="unidade_proposta" name="unidade_proposta" value="<?php echo $pd[0]->unidade_proposta; ?>" />
			</td>
		   </tr>
		   <tr>
		    <td colspan="1">Cargo Atual: 
			  <input type="text" class="form-control" id="cargo_atual" name="cargo_atual" value="<?php echo $pd[0]->cargo_atual; ?>" />
			</td>
			<td colspan="1">Cargo Proposto: 
			  <input type="text" class="form-control" id="cargo_proposto" name="cargo_proposto" value="<?php echo $pd[0]->cargo_proposto; ?>" />
			</td>
		   </tr>
		   <tr>
		   <td>Centro de Custo: 
		     <input type="text" class="form-control" id="centro_custo" name="centro_custo" value="<?php echo $pd[0]->centro_custo; ?>" />
		   </td>
		   <td width="50">Horário de Trabalho 
			<input class="form-control" style="width: 250px;" type="text" id="horario_trabalho" name="horario_trabalho" value="<?php echo $pd[0]->horario_trabalho; ?>" />
		   </td>
		   </tr>
		   <tr>
		    <td>Salário Atual: 
			  <input class="form-control" type="text" id="salario_atual" name="salario_atual" value="<?php echo $pd[0]->salario_atual; ?>" />
			</td>
			<td width="300">Salário Proposto: 
			  <input class="form-control" type="text" id="salario_proposto" name="salario_proposto" value="<?php echo $pd[0]->salario_proposto; ?>" />	
			</td>
		   </tr>
		  </table>
		  </center>
				
		  <br>
		  <center>		
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="40"><strong><h5>Justificativa/Observações:</h5></strong></td>
		    <td><textarea type="text" id="descricao" name="descricao" class="form-control" rows="10" cols="60" value="<?php echo $just_vaga_int[0]->descricao; ?>"> {{ $just_vaga_int[0]->descricao }} </textarea></td>
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
			<td>Recrutador</td><td><input readonly="true" type="date" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control" /></td>
		   </tr>
		   <tr>
			<td>Gerente de RH</td><td><input readonly="true" type="date" id="data_rec_humanos" name="data_rec_humanos" class="form-control" /></td>
		   </tr>
		   <tr>
			<td>Gerente da Unidade</td><td><input readonly="true" type="date" id="data_diretoria_tecnica" name="data_diretoria_tecnica" class="form-control" /></td>
		   </tr>
		   </table>
		  </center>
   </form>
</body>