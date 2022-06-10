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
				  <form action="{{\Request::route('storeDemissaoMP'), $unidade[0]->id}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<center>
						<table class="table table-bordered table-sm"> 
							<tr>
							<td colspan="2"><center><strong><h5><br>Movimentação de Pessoal - Demissão</h5></strong></center></td>
							<td><center><img width="150" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="mp_id" name="mp_id" value="" readonly="true" /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="concluida" name="concluida" value="" readonly="true" /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="aprovada" name="aprovada" value="0" readonly="true" /></td>
							<td hidden><input hidden class="form-control form-control-sm" type="text" id="ordem" name="ordem" value="" readonly="true" /></td>
							</tr>
							<tr>
							<td><b><font size="2">Unidade:</font></b> <input class="form-control form-control-sm" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
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
							<td width="800px;"> <center><b><font size="2">IMPACTO FINANCEIRO:</font></b>
								@if(old('impacto_financeiro') == "sim")
									<font size="3">SIM:</font> <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="sim" checked /> 
									<font size="3">NÃO:</font> <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="nao" /> 
								@elseif(old('impacto_financeiro') == "nao")
									<font size="3">SIM:</font> <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="sim" /> 
									<font size="3">NÃO:</font> <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="nao" checked />
								@else
									<font size="3">SIM:</font> <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="sim" /> 
									<font size="3">NÃO:</font> <input type="checkbox" id="impacto_financeiro" name="impacto_financeiro" value="nao" />
								@endif
								</center>
								</td>
							</tr>	
							</table>
						</center>
						
						<center>
						<table class="table table-bordered table-sm">
						<tr>
							<td width="300"><b><font size="2">Tipo de desligamento:</font></b> 
							<select id="tipo_desligamento" name="tipo_desligamento" class="form-control form-control-sm" required>
							@if(old('tipo_desligamento') == "termino_contrato")	
							<option id="tipo_desligamento" name="tipo_desligamento" value=""> Selecione ... </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" selected> Término de Contrato </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@elseif(old('tipo_desligamento') == "extincao_antecipada")	
							<option id="tipo_desligamento" name="tipo_desligamento" value=""> Selecione ... </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada" selected> Extinção Antecipada do Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@elseif(old('tipo_desligamento') == "sem_justa_causa")	
							<option id="tipo_desligamento" name="tipo_desligamento" value=""> Selecione ... </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa" selected> Dispensa sem justa causa </option> 
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@elseif(old('tipo_desligamento') == "aposentadoria")	
							<option id="tipo_desligamento" name="tipo_desligamento" value=""> Selecione ... </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria" selected> Aposentadoria </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option> 
							@elseif(old('tipo_desligamento') == "com_justa_causa")	
							<option id="tipo_desligamento" name="tipo_desligamento" value=""> Selecione ... </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa" selected> Dispensa com justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@elseif(old('tipo_desligamento') == "morte")	
							<option id="tipo_desligamento" name="tipo_desligamento" value=""> Selecione ... </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte" selected> Morte </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@elseif(old('tipo_desligamento') == "pedido_demissao")	
							<option id="tipo_desligamento" name="tipo_desligamento" value=""> Selecione ... </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao" selected> Pedido de Demissão </option>
							@else 
							<option id="tipo_desligamento" name="tipo_desligamento" value=""> Selecione ... </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato"> Término de Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="extincao_antecipada"> Extinção Antecipada do Contrato </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="sem_justa_causa"> Dispensa sem justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="aposentadoria"> Aposentadoria </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="com_justa_causa"> Dispensa com justa causa </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="morte"> Morte </option>
							<option id="tipo_desligamento" name="tipo_desligamento" value="pedido_demissao"> Pedido de Demissão </option>
							@endif
							</select>
							</td>
							<td width="300"><b><font size="2">Aviso Prévio:</font></b>
							<select id="aviso_previo" name="aviso_previo" class="form-control form-control-sm" required>
							@if(old('aviso_previo') == "trabalhado")
							<option id="aviso_previo" name="aviso_previo" value=""> Selecione ... </option>				    
							<option id="aviso_previo" name="aviso_previo" value="trabalhado" selected> Trabalhado </option>
							<option id="aviso_previo" name="aviso_previo" value="indenizado"> Indenizado </option>
							<option id="aviso_previo" name="aviso_previo" value="dispensado"> Dispensado </option>
							@elseif(old('aviso_previo') == "indenizado")
							<option id="aviso_previo" name="aviso_previo" value=""> Selecione ... </option>				    
							<option id="aviso_previo" name="aviso_previo" value="trabalhado"> Trabalhado </option>
							<option id="aviso_previo" name="aviso_previo" value="indenizado" selected> Indenizado </option>
							<option id="aviso_previo" name="aviso_previo" value="dispensado"> Dispensado </option>
							@elseif(old('aviso_previo') == "dispensado")
							<option id="aviso_previo" name="aviso_previo" value=""> Selecione ... </option>				    
							<option id="aviso_previo" name="aviso_previo" value="trabalhado"> Trabalhado </option>
							<option id="aviso_previo" name="aviso_previo" value="indenizado"> Indenizado </option>
							<option id="aviso_previo" name="aviso_previo" value="dispensado" selected> Dispensado </option>
							@else
							<option id="aviso_previo" name="aviso_previo" value=""> Selecione ... </option>				    
							<option id="aviso_previo" name="aviso_previo" value="trabalhado"> Trabalhado </option>
							<option id="aviso_previo" name="aviso_previo" value="indenizado"> Indenizado </option>
							<option id="aviso_previo" name="aviso_previo" value="dispensado"> Dispensado </option>	
							@endif
							</select>
							</td>
							<td width="200"><b><font size="2">Último dia Trabalhado:</font></b><br> 
							<input required class="form-control form-control-sm" type="date" id="ultimo_dia" name="ultimo_dia" value="{{ old('ultimo_dia') }}" /> 
							<br><b><font size="2">Custo da Recisão:</font></b> 
							<input required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" class="form-control form-control-sm" id="custo_recisao" name="custo_recisao"  value="{{ old('custo_recisao') }}" />
							<br><b><font size="2">Salário Base:</font></b> 
							<input required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" class="form-control form-control-sm" id="salario_bruto" name="salario_bruto"  value="{{ old('salario_bruto') }}" /> </td>
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
						@if($unidade[0]->id == 2)
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