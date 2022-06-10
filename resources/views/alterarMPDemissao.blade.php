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
				  <form action="{{route('updateMPDemissao', array($idMP, $idA))}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"> 	

					<center>
					<table class="table table-bordered table-sm"> 
						<tr>
						<td colspan="2"><center><strong><h5><br>Alterar - Movimentação de Pessoal</h5></strong></center></td>
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
						<select id="gestor_id" name="gestor_id" class="form-control form-control-sm" readonly disabled>
						<option id="gestor_id" name="gestor_id" value="<?php echo $gestor[0]->id ?>" title="{{ $gestor[0]->nome }}">{{ $gestor[0]->nome }}</option>
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
					
					@if(!empty($demissao))		
					@foreach($demissao as $dem)	 
					<center>
					<table class="table table-bordered">
					<tr>
						<td><center><h5><font size="2"><b>Demissão</b></font></h5><input checked type="checkbox" id="tipo_mov2" name="tipo_mov2" disabled /></center></td>
						<td><b><font size="2">Tipo de desligamento:</font></b> <br><br>
						<select class="form-control form-control-sm" id="tipo_desligamento" name="tipo_desligamento">
						<option id="tipo_desligamento" name="tipo_desligamento" value=""> Selecione... </option>
							@if($dem->tipo_desligamento == "termino_contrato")
							<option selected id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@elseif($dem->tipo_desligamento == "extincao_antecipada")
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option> 
							<option selected id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@elseif($dem->tipo_desligamento == "sem_justa_causa")
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option> 
							<option selected id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@elseif($dem->tipo_desligamento == "aposentadoria")
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option> 
							<option selected id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@elseif($dem->tipo_desligamento == "com_justa_causa")
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option> 
							<option selected id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@elseif($dem->tipo_desligamento == "morte")
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option> 
							<option selected id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@elseif($dem->tipo_desligamento == "pedido_demissao")
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato  </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria  </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa  </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte  </option>
							<option selected id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@endif
						</select>
						</td>
						<td><b><font size="2">Aviso Prévio:</font></b><br><br>
						<select class="form-control form-control-sm" id="aviso_previo" name="aviso_previo">
							<option id="aviso_previo" name="aviso_previo" value=""> Selecione... </option> 
							@if($dem->aviso_previo == "trabalhado")
							<option selected id="aviso_previo" name="aviso_previo" value="trabalhado"> Trabalhado </option>
							<option id="aviso_previo" name="aviso_previo" value="indenizado"> Indenizado </option>
							<option id="aviso_previo" name="aviso_previo" value="dispensado"> Dispensado </option>
							@elseif($dem->aviso_previo == "indenizado")
							<option id="aviso_previo" name="aviso_previo" value="trabalhado"> Trabalhado </option>
							<option selected id="aviso_previo" name="aviso_previo" value="indenizado"> Indenizado </option>
							<option id="aviso_previo" name="aviso_previo" value="dispensado"> Dispensado </option>
							@elseif($dem->aviso_previo == "dispensado")
							<option id="aviso_previo" name="aviso_previo" value="trabalhado"> Trabalhado </option> 
							<option id="aviso_previo" name="aviso_previo" value="indenizado"> Indenizado </option> 
							<option selected id="aviso_previo" name="aviso_previo" value="dispensado"> Dispensado </option>
							@endif
						</select>
						</td>
						<td><b><font size="2">Último dia Trabalhado:</font></b><br><br><input class="form-control form-control-sm" type="date" id="ultimo_dia" name="ultimo_dia" value="<?php echo $dem->ultimo_dia; ?>" required /> 
						<br><b><font size="2">Custo da Recisão:</font></b><input required class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="custo_recisao" name="custo_recisao" value="<?php echo $dem->custo_recisao; ?>" />
						<br><b><font size="2">Salário Base:</font></b><input required class="form-control form-control-sm" placeholder="ex: 2500 ou 2580,21" title="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_bruto" name="salario_bruto" value="<?php echo $dem->salario_bruto; ?>" /></td>
					</tr>
					</table>
					</center>
					@endforeach
					@endif	
					
					<center>		
					<table class="table table-bordered" style="height: 10px;">
					<tr>
						<td width="180"><strong><font size="2">Informações Adicionais:</font></strong></td>
						<td><textarea required type="text" id="descricao" name="descricao" class="form-control" rows="1" cols="60"> {{ $justificativa[0]->descricao }} </textarea></td>
					</tr>
					</table>
					</center>
					
					<center>
					<table class="table table" style="height: 10px;">
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