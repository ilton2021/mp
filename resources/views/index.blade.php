<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Movimentação de Pessoal - Validação</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	<script type="text/javascript">

		function comoSoube(){
			var optionSelect = document.getElementById("como_soube").value;
			if(optionSelect == "outros"){
				document.getElementById("como_soube2").disabled = false;
			} else {
				document.getElementById("como_soube2").disabled = true;
			}
		}

		function multiplicar(){
			m1 = Number(document.getElementById("valor_plantao").value);
			m2 = Number(document.getElementById("quantidade_plantao").value);
			r = Number(m1*m2);
			document.getElementById("valor_pago_plantao").value = r;
		}

		function somarSalarios(){
			s1 = Number(document.getElementById("salario").value);
			s2 = Number(document.getElementById("outras_verbas").value);
			soma = Number(s1 + s2);
			document.getElementById("remuneracao_total").value = soma;
		}

		function multiplicar2(){
			m1  = Number(document.getElementById("salario_2").value);
			m2  = Number(document.getElementById("outras_verbas_2").value);
			m3  = Number(document.getElementById("salario_3").value);
			m4  = Number(document.getElementById("outras_verbas_3").value);
			m5  = Number(document.getElementById("salario_4").value);
			m6  = Number(document.getElementById("outras_verbas_4").value);
			m7  = Number(document.getElementById("salario_5").value);
			m8  = Number(document.getElementById("outras_verbas_5").value);
			m9  = Number(document.getElementById("salario_6").value);
			m10 = Number(document.getElementById("outras_verbas_6").value);
			m11 = Number(document.getElementById("salario_7").value);
			m12 = Number(document.getElementById("outras_verbas_7").value);
			r = Number((m1 + m2 + m3 + m4 + m5 + m6 + m7 + m8 + m9 + m10 + m11 + m12));
			document.getElementById("total").value = r;
		}

		function subtrai(){
			m1 = document.getElementById("salario_atual").value;
			m2 = document.getElementById("salario_novo").value;
			r  = parseInt(m2 - m1);
			document.getElementById("renda_var").value = r;
		}

		function desabilitarTipos(valor){
			var a = document.getElementById('sim_impacto').checked;
			var b = document.getElementById('nao_impacto').checked; 
			
			if(a == true || b == true){
				document.getElementById('tipo_mov1').disabled = false;
				document.getElementById('tipo_mov2').disabled = false;
				document.getElementById('tipo_mov3').disabled = false;
				document.getElementById('tipo_mov4').disabled = false;
				document.getElementById('tipo_mov5').disabled = false;
			} else {
				document.getElementById('tipo_mov1').disabled = true;
				document.getElementById('tipo_mov2').disabled = true;
				document.getElementById('tipo_mov3').disabled = true;
				document.getElementById('tipo_mov4').disabled = true;
				document.getElementById('tipo_mov5').disabled = true;
			}
		}

		function desabilitar(valor) {
		  var status = document.getElementById('tipo_mov1').checked;
		  
		  if (status == true) {
			document.getElementById('cargo').disabled 			  = false;
			document.getElementById('salario').disabled 		  = false;
			document.getElementById('outras_verbas').disabled 	  = false;
			document.getElementById('horario_trabalho').disabled  = false;
			document.getElementById('escala_trabalho').disabled   = false;
			document.getElementById('escala_trabalho2').disabled  = false;
			document.getElementById('escala_trabalho3').disabled  = false;
			document.getElementById('escala_trabalho4').disabled  = false;
			document.getElementById('centro_custo').disabled 	 = false;
			document.getElementById('jornada').disabled 	 	 = false;
			document.getElementById('turno').disabled 	 		 = false;
			document.getElementById('turno2').disabled 	 		 = false;
			document.getElementById('tipo').disabled  			 = false;
			document.getElementById('tipo2').disabled  			 = false;
			document.getElementById('tipo3').disabled  			 = false;
			document.getElementById('tipo4').disabled  			 = false;
			document.getElementById('tipo5').disabled  			 = false;			
			document.getElementById('motivo').disabled  		 = false;
			document.getElementById('motivo2').disabled  		 = false;
			document.getElementById('motivo3').disabled  		 = false;
			document.getElementById('motivo4').disabled  		 = false;
			document.getElementById('possibilidade_contratacao').disabled  = false;
			document.getElementById('possibilidade_contratacao2').disabled = false;
			document.getElementById('necessidade_email').disabled  		   = false;
			document.getElementById('necessidade_email2').disabled  	   = false;
			
		  } else {
			document.getElementById('cargo').disabled 			  = true;
			document.getElementById('salario').disabled 		  = true;
			document.getElementById('outras_verbas').disabled	  = true;
			document.getElementById('horario_trabalho').disabled  = true;
			document.getElementById('escala_trabalho').disabled   = true;
			document.getElementById('escala_trabalho2').disabled  = true;
			document.getElementById('escala_trabalho3').disabled  = true;
			document.getElementById('escala_trabalho4').disabled  = true;
			document.getElementById('centro_custo').disabled 	 = true;
			document.getElementById('jornada').disabled 	 	 = true;
			document.getElementById('turno').disabled 	 		 = true;
			document.getElementById('turno2').disabled 	 		 = true;
			document.getElementById('tipo').disabled  			 = true;
			document.getElementById('tipo2').disabled  			 = true;
			document.getElementById('tipo3').disabled  			 = true;
			document.getElementById('tipo4').disabled  			 = true;
			document.getElementById('tipo5').disabled  			 = true;
			document.getElementById('motivo').disabled  		 = true;
			document.getElementById('motivo2').disabled  		 = true;
			document.getElementById('motivo3').disabled  		 = true;
			document.getElementById('motivo4').disabled  		 = true;
			document.getElementById('possibilidade_contratacao').disabled  = true;
			document.getElementById('possibilidade_contratacao2').disabled = true;
			document.getElementById('necessidade_email').disabled  		   = true;
			document.getElementById('necessidade_email2').disabled  	   = true;
		  }
		}

		function desabilitarUnd1(valor){
			var status = document.getElementById('und').checked;
			if(status == true) {
				document.getElementById('cargo_2').disabled 	    = false;
				document.getElementById('centro_custo_2').disabled 	= false;
				document.getElementById('salario_2').disabled 	    = false;
				document.getElementById('outras_verbas_2').disabled = false;
			} else {
				document.getElementById('cargo_2').disabled 	    = true;
				document.getElementById('centro_custo_2').disabled 	= true;
				document.getElementById('salario_2').disabled 	    = true;
				document.getElementById('outras_verbas_2').disabled = true;
			}
		}

		function desabilitarUnd2(valor) {
			var status = document.getElementById('und2').checked;
			if(status == true){
				document.getElementById('cargo_3').disabled 	    = false;
				document.getElementById('centro_custo_3').disabled 	= false;
				document.getElementById('salario_3').disabled 	    = false;
				document.getElementById('outras_verbas_3').disabled = false;
			} else {
				document.getElementById('cargo_3').disabled 	    = true;
				document.getElementById('centro_custo_3').disabled 	= true;
				document.getElementById('salario_3').disabled 	    = true;
				document.getElementById('outras_verbas_3').disabled = true;
			}
		}

		function desabilitarUnd3(valor) {
			var status = document.getElementById('und3').checked;
			if(status == true){
				document.getElementById('cargo_4').disabled 	    = false;
				document.getElementById('centro_custo_4').disabled 	= false;
				document.getElementById('salario_4').disabled 	    = false;
				document.getElementById('outras_verbas_4').disabled = false;
			} else {
				document.getElementById('cargo_4').disabled 	    = true;
				document.getElementById('centro_custo_4').disabled 	= true;
				document.getElementById('salario_4').disabled 	    = true;
				document.getElementById('outras_verbas_4').disabled = true;
			}
		}	

		function desabilitarUnd4(valor) {
			var status = document.getElementById('und4').checked;
			if(status == true){
				document.getElementById('cargo_5').disabled 	    = false;
				document.getElementById('centro_custo_5').disabled 	= false;
				document.getElementById('salario_5').disabled 	    = false;
				document.getElementById('outras_verbas_5').disabled = false;
			} else {
				document.getElementById('cargo_5').disabled 	    = true;
				document.getElementById('centro_custo_5').disabled 	= true;
				document.getElementById('salario_5').disabled 	    = true;
				document.getElementById('outras_verbas_5').disabled = true;
			}
		}	

		function desabilitarUnd5(valor) {
			var status = document.getElementById('und5').checked;
			if(status == true){
				document.getElementById('cargo_6').disabled 	    = false;
				document.getElementById('centro_custo_6').disabled 	= false;
				document.getElementById('salario_6').disabled 	    = false;
				document.getElementById('outras_verbas_6').disabled = false;
			} else {
				document.getElementById('cargo_6').disabled 	    = true;
				document.getElementById('centro_custo_6').disabled 	= true;
				document.getElementById('salario_6').disabled 	    = true;
				document.getElementById('outras_verbas_6').disabled = true;
			}
		}	
			
		function desabilitarUnd6(valor) {
			var status = document.getElementById('und6').checked;
			if(status == true){
				document.getElementById('cargo_7').disabled 	    = false;
				document.getElementById('centro_custo_7').disabled 	= false;
				document.getElementById('salario_7').disabled 	    = false;
				document.getElementById('outras_verbas_7').disabled = false;
			} else {
				document.getElementById('cargo_7').disabled 	    = true;
				document.getElementById('centro_custo_7').disabled 	= true;
				document.getElementById('salario_7').disabled 	    = true;
				document.getElementById('outras_verbas_7').disabled = true;
			}
		}	

		function desabilitarUnd7(valor) {
			var status = document.getElementById('und7').checked;
			if(status == true){
				document.getElementById('cargo_8').disabled 	    = false;
				document.getElementById('centro_custo_8').disabled 	= false;
				document.getElementById('salario_8').disabled 	    = false;
				document.getElementById('outras_verbas_8').disabled = false;
			} else {
				document.getElementById('cargo_8').disabled 	    = true;
				document.getElementById('centro_custo_8').disabled 	= true;
				document.getElementById('salario_8').disabled 	    = true;
				document.getElementById('outras_verbas_8').disabled = true;
			}
		}	

		function desabilitar5(valor) {
		  var status = document.getElementById('tipo_mov5').checked;
		  
		  if (status == true) {
			document.getElementById('und').disabled             = false;	
			document.getElementById('und2').disabled            = false;
			document.getElementById('und3').disabled            = false;
			document.getElementById('und4').disabled            = false;
			document.getElementById('und5').disabled            = false;
			document.getElementById('und6').disabled            = false;
			document.getElementById('jornadahcp').disabled  	= false;
			document.getElementById('tipohcp_1').disabled  		= false;
			document.getElementById('tipohcp_2').disabled  		= false;
			document.getElementById('tipohcp_3').disabled  		= false;
			document.getElementById('tipohcp_4').disabled  		= false;
			document.getElementById('tipohcp_5').disabled  		= false;			
			document.getElementById('motivohcp_1').disabled  	= false;
			document.getElementById('motivohcp_2').disabled  	= false;
			document.getElementById('motivohcp_3').disabled  	= false;
			document.getElementById('motivohcp_4').disabled  	= false;
			document.getElementById('possibilidade_contratacaohcp').disabled   = false;
			document.getElementById('possibilidade_contratacaohcp_2').disabled = false;
			document.getElementById('necessidade_emailhcp').disabled  		   = false;
			document.getElementById('necessidade_emailhcp_2').disabled  	   = false;			
		  } else {
			document.getElementById('und').disabled             = true;	
			document.getElementById('und2').disabled            = true;
			document.getElementById('und3').disabled            = true;
			document.getElementById('und4').disabled            = true;
			document.getElementById('und5').disabled            = true;
			document.getElementById('und6').disabled            = true;
			document.getElementById('jornadahcp').disabled  	= true;
			document.getElementById('tipohcp_1').disabled  		= true;
			document.getElementById('tipohcp_2').disabled  		= true;
			document.getElementById('tipohcp_3').disabled  		= true;
			document.getElementById('tipohcp_4').disabled  		= true;
			document.getElementById('tipohcp_5').disabled  		= true;				
			document.getElementById('motivohcp_1').disabled  	= true;
			document.getElementById('motivohcp_2').disabled  	= true;
			document.getElementById('motivohcp_3').disabled  	= true;
			document.getElementById('motivohcp_4').disabled  	= true;
			document.getElementById('possibilidade_contratacaohcp').disabled   = true;
			document.getElementById('possibilidade_contratacaohcp_2').disabled = true;
			document.getElementById('necessidade_emailhcp').disabled  		   = true;
			document.getElementById('necessidade_emailhcp_2').disabled  	   = true;
		  }
		}
		
		function desabilitar2(valor) {
		  var status = document.getElementById('tipo_desligamento').disabled;
		  if (status == true) {
			  document.getElementById('tipo_desligamento').disabled  = false;
			  document.getElementById('tipo_desligamento2').disabled = false;
			  document.getElementById('tipo_desligamento3').disabled = false;
			  document.getElementById('tipo_desligamento4').disabled = false;
			  document.getElementById('tipo_desligamento5').disabled = false;
			  document.getElementById('tipo_desligamento6').disabled = false;
			  document.getElementById('tipo_desligamento7').disabled = false;
			  document.getElementById('aviso_previo').disabled  = false;
			  document.getElementById('aviso_previo2').disabled = false;
			  document.getElementById('aviso_previo3').disabled = false;
			  document.getElementById('ultimo_dia').disabled    = false;
			  document.getElementById('custo_recisao').disabled = false;
			  document.getElementById('salario_bruto').disabled = false;
		  }else {
			  document.getElementById('tipo_desligamento').disabled  = true;
			  document.getElementById('tipo_desligamento2').disabled = true;
			  document.getElementById('tipo_desligamento3').disabled = true;
			  document.getElementById('tipo_desligamento4').disabled = true;
			  document.getElementById('tipo_desligamento5').disabled = true;
			  document.getElementById('tipo_desligamento6').disabled = true;
			  document.getElementById('tipo_desligamento7').disabled = true;
			  document.getElementById('aviso_previo').disabled  = true;
			  document.getElementById('aviso_previo2').disabled = true;
			  document.getElementById('aviso_previo3').disabled = true;
			  document.getElementById('ultimo_dia').disabled    = true;
			  document.getElementById('custo_recisao').disabled = true;
			  document.getElementById('salario_bruto').disabled = true;
		  }
		}
		
		function desabilitar3(valor) {
		  var status = document.getElementById('unidade_id2').disabled;
		  if (status == true) {
		      document.getElementById('unidade_id2').disabled    = false;
			  document.getElementById('setor').disabled 	     = false;
			  document.getElementById('cargo_atual').disabled 	 = false;
			  document.getElementById('cargo_novo').disabled 	 = false;
			  document.getElementById('remuneracao').disabled    = false;
			  document.getElementById('salario_atual').disabled  = false;
			  document.getElementById('centro_custo_novo').disabled = false;
			  document.getElementById('horario_novo').disabled 		= false;
			  document.getElementById('gratificacoes').disabled 	= false;
			  document.getElementById('motivoA').disabled 			= false;
			  document.getElementById('motivoA2').disabled  = false;
			  document.getElementById('motivoA3').disabled  = false;
			  document.getElementById('motivoA4').disabled  = false;
			  document.getElementById('motivoA5').disabled  = false;
			  document.getElementById('motivoA6').disabled  = false;
			  document.getElementById('motivoA7').disabled  = false;
			  document.getElementById('motivoA8').disabled  = false;
			  document.getElementById('motivoA9').disabled  = false;
			  document.getElementById('motivoA10').disabled = false;
			  document.getElementById('motivoA11').disabled = false;
		  } else {
			  document.getElementById('unidade_id2').disabled    = true;
			  document.getElementById('setor').disabled 	     = true;
			  document.getElementById('cargo_atual').disabled    = true;
			  document.getElementById('cargo_novo').disabled     = true;
			  document.getElementById('remuneracao').disabled    = true;
			  document.getElementById('salario_atual').disabled  = true;
			  document.getElementById('centro_custo_novo').disabled = true;
			  document.getElementById('horario_novo').disabled 		= true;
			  document.getElementById('gratificacoes').disabled 	= true;
			  document.getElementById('motivoA').disabled 			= true;
			  document.getElementById('motivoA2').disabled  = true;
			  document.getElementById('motivoA3').disabled  = true;
			  document.getElementById('motivoA4').disabled  = true;
			  document.getElementById('motivoA5').disabled  = true;
			  document.getElementById('motivoA6').disabled  = true;
			  document.getElementById('motivoA7').disabled  = true;
			  document.getElementById('motivoA8').disabled  = true;
			  document.getElementById('motivoA9').disabled  = true;
			  document.getElementById('motivoA10').disabled = true;
			  document.getElementById('motivoA11').disabled = true;
		  }
		}

		function desabilitar4(valor) {
		  var status = document.getElementById('tipo_mov4').checked;
		  if (status == true) {
		      document.getElementById('setor_plantao').disabled    		 = false;
			  document.getElementById('cargo_plantao').disabled 	     = false;
			  document.getElementById('motivo_plantao').disabled 	 	 = false;
			  document.getElementById('centro_custo_plantao').disabled 	 = false;
			  document.getElementById('valor_plantao').disabled    	  	 = false;
			  document.getElementById('valor_pago_plantao').disabled  	 = false;
			  document.getElementById('quantidade_plantao').disabled  	 = false;
			  document.getElementById('substituto').disabled 			 = false;
		  } else {
			document.getElementById('setor_plantao').disabled    	   = true;
			  document.getElementById('cargo_plantao').disabled 	   = true;
			  document.getElementById('motivo_plantao').disabled 	   = true;
			  document.getElementById('centro_custo_plantao').disabled = true;
			  document.getElementById('valor_plantao').disabled    	   = true;
			  document.getElementById('valor_pago_plantao').disabled   = true;
			  document.getElementById('quantidade_plantao').disabled   = true;
			  document.getElementById('substituto').disabled  		   = true;
		  }
		}
		
		function desabilitarSal(valor) {
		  var status = document.getElementById('remuneracao').checked;
		  if (status == true) {
			document.getElementById('salario_novo').disabled   = false;
		  } else {
			document.getElementById('salario_novo').disabled   = true;
		  }
		}

		function desabilitarOutra(valor) {
		  var status = document.getElementById('escala_trabalho6').disabled;
		  if (status == true) {
			document.getElementById('escala_trabalho6').disabled = false;
		  }else {
			document.getElementById('escala_trabalho6').disabled = true;  
		  }
		}
		
		function desabilitarRPA(valor) {
		  var status = document.getElementById('tipo5').checked; 
		  if (status == true) {
			document.getElementById('table-rpa').hidden  = false;
			document.getElementById('mes_rpa').disabled  = false;
			document.getElementById('ano_rpa').disabled  = false;
			document.getElementById('mes2_rpa').disabled = false;
			document.getElementById('ano2_rpa').disabled = false;
		  } else {
			document.getElementById('table-rpa').hidden  = true;
			document.getElementById('mes_rpa').disabled  = true;
			document.getElementById('ano_rpa').disabled  = true;
			document.getElementById('mes2_rpa').disabled = true;
			document.getElementById('ano2_rpa').disabled = true;
		  }
		}

		function desabilitarRPA2(valor) {
		  var status = document.getElementById('periodo_contratohcp').disabled;
		  if (status == true) {
			document.getElementById('periodo_contratohcp').disabled = false;
		  } else {
			document.getElementById('periodo_contratohcp').disabled = true;  
		  }
		}
		
		function desabilitarSubst(valor) {
		  var status = document.getElementById('motivo6').disabled;
		  if (status == true) {
			document.getElementById('motivo6').disabled = false;
		  }else {
			document.getElementById('motivo6').disabled = true;  
		  }
		}

		function desabilitarSubst2(valor) {
		  var status = document.getElementById('motivo6hcp').disabled;
		  if (status == true) {
			document.getElementById('motivo6hcp').disabled = false;
		  }else {
			document.getElementById('motivo6hcp').disabled = true;  
		  }
		}

		function desabilitarTable(valor) {
			var x = document.getElementById('hcpgestao'); 
			var y = x.options[x.selectedIndex].text;    
			if(y == "SIM"){ 
				document.getElementById('table_hcpgestao').hidden = false;
				document.getElementById('table_unidades').hidden  = true;
			} else {
				document.getElementById('table_hcpgestao').hidden = true;
				document.getElementById('table_unidades').hidden  = false;
			}
		}

		function ativarOutra(valor){
			var x = document.getElementById('horario_trabalho'); 
			var y = x.options[x.selectedIndex].text;  
			if(y == "Outro..."){
				document.getElementById('horario_trabalho2').disabled = false;
			} else {
				document.getElementById('horario_trabalho2').disabled = true;
			}
		}

		function funcaoCargoSalario(valor){
			var x = document.getElementById('cargo'); 
			var u = document.getElementById('unidade').value;
			var y = x.options[x.selectedIndex].text; 
			if(u == "Hospital da Mulher do Recife" || u == "UPAE Arruda"){
				if(y == "ENFERMEIRO(A) 24H"){
					document.getElementById('salario').value = "2369.99";
				} else if(y == "ENFERMEIRO(A) 30H"){
					document.getElementById('salario').value = "2369.99";
				} else if(y == "ENFERMEIRO(A) 40H"){
					document.getElementById('salario').value = "3159.60";
				} else {
					document.getElementById('salario').value = "";
				}
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
	  <form action="{{\Request::route('storeMP'), $unidade[0]->id}}" method="post">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td colspan="2"><center><strong><h3><br>Movimentação de Pessoal</h3></strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			  <td hidden><input hidden class="form-control" type="text" id="mp_id" name="mp_id" value="" readonly="true" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="concluida" name="concluida" value="" readonly="true" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="aprovada" name="aprovada" value="0" readonly="true" /></td>
			  <td hidden><input hidden class="form-control" type="text" id="ordem" name="ordem" value="" readonly="true" /></td>
			</tr>
			<tr>
			  <td width="400px">Unidade: <input class="form-control" type="text" id="unidade" name="unidade" value="<?php echo $unidade[0]->nome; ?>" readonly="true" /></td>
			  <td hidden><input class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" readonly="true" /></td>
			  <td>Local de Trabalho:
			  <select class="form-control" id="local_trabalho" name="local_trabalho">
			     <option id="local_trabalho" name="local_trabalho" value="<?php echo $unidade[0]->id ?>">{{ $unidade[0]->nome }}</option>
			  </select>
			  </td>
			  <td>Solicitante: <input readonly="true" class="form-control" type="text" id="solicitante" name="solicitante" required value="<?php echo Auth::user()->name; ?>" /></td>
			</tr>
			<tr>
			  <td hidden> Número do MP: <input class="form-control" type="text" id="numeroMP" name="numeroMP" value="" /> </td>
			  <td colspan="1">Nome: <input class="form-control" type="text" id="nome" name="nome" required="true" value="{{ Request::old('nome') }}" /></td>
			  <td> Matrícula: <input class="form-control" type="text" id="matricula" name="matricula" value="{{Request::old('matricula')}}" /> </td>
			  <td>Gestor Imediato: 
			  <select id="gestor_id" name="gestor_id" class="form-control">
			  <?php if($tipo_mp == 0){ ?>
			  @if(!empty($gestores))
			   @foreach($gestores as $gestor)
		         <option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id ?>" selected>{{ $gestor->nome }}</option>
			   @endforeach
			  @endif
			  <?php } else { ?>
			    <option id="gestor_id" name="gestor_id" value="30">{{ 'ANA AMÉRICA OLIVEIRA DE ARRUDA' }}</option>
			  <?php } ?>
			  </select>
			  <td hidden><input id="tipo_mp" name="tipo_mp" value="{{ $tipo_mp }}" /></td>
			</tr>
			<tr>
			  @if($tipo_mp == 1)
			  <td colspan="2">Departamento: <input class="form-control" type="text" id="departamento" name="departamento" value="{{ old('departamento') }}" required /></td>
			  @else
			  <td>Departamento: <input class="form-control" type="text" id="departamento" name="departamento" value="{{ old('departamento') }}" required /></td>
			  <td>HCPGESTÃO: <br>
			  <select id="hcpgestao" name="hcpgestao" class="form-control" onchange="desabilitarTable('sim')"> 
			   @if(old('hcpgestao') == "NAO")
			    <option id="hcpgestao" name="hcpgestao" value="NAO" selected>NÃO</option>  
			    <option id="hcpgestao" name="hcpgestao" value="SIM">SIM</option>
			   @elseif(old('hcpgestao') == "SIM")
			    <option id="hcpgestao" name="hcpgestao" value="NAO">NÃO</option>  
			    <option id="hcpgestao" name="hcpgestao" value="SIM" selected>SIM</option>
			   @else
			    <option id="hcpgestao" name="hcpgestao" value="NAO">NÃO</option>  
			    <option id="hcpgestao" name="hcpgestao" value="SIM">SIM</option>
			   @endif
			  </select>
			  </td>
			  @endif
			  <td>Data de Emissão: <input class="form-control" type="text" id="data_emissao" name="data_emissao" value="<?php echo date('d-m-Y', strtotime('now')); ?>" readonly="true" /></td>
			</tr>
		   </table>
		  </center>
		  
		  <br>	 
		  <center>
			<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
			  <tr>
			   <td  colspan="2"><center><strong><h4>Tipos de Movimentação</h4></strong></center></td>
			  </tr>
			  <tr>  
			   <td width="800px;"> <center><br><b>IMPACTO FINANCEIRO:</b>
			       @if(old('sim_impacto') == "on")	
				   SIM: <input type="checkbox" checked id="sim_impacto" name="sim_impacto" onclick="desabilitarTipos('sim')" /> 
				   NÃO: <input type="checkbox" id="nao_impacto" name="nao_impacto" onclick="desabilitarTipos('sim')" /> 
				   @elseif(old('nao_impacto') == "on")	
				   SIM: <input type="checkbox" id="sim_impacto" name="sim_impacto" onclick="desabilitarTipos('sim')" /> 
				   NÃO: <input type="checkbox" checked id="nao_impacto" name="nao_impacto" onclick="desabilitarTipos('sim')" /> 
				   @else
				   SIM: <input type="checkbox" id="sim_impacto" name="sim_impacto" onclick="desabilitarTipos('sim')" /> 
				   NÃO: <input type="checkbox" id="nao_impacto" name="nao_impacto" onclick="desabilitarTipos('sim')" /> 
				   @endif
				</center>
				</td>
		 	   <td>Data Prevista: <input class="form-control" type="date" id="data_prevista" name="data_prevista" required value="{{ Request::old('data_prevista') }}" /></td>
			  </tr>	
			</table>
		  </center>
		  
	 	  <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0" id="table_unidades" name="table_unidades">
		    </tr>
		    <tr>
			 <td rowspan="5" width="150"><center><h5>Admissão</h5> 
			 @if(old('tipo_mov1') == "on")
			 <input type="checkbox" onclick="desabilitar('sim')" id="tipo_mov1" name="tipo_mov1" checked />
		     @else
			 <input disabled type="checkbox" onclick="desabilitar('sim')" id="tipo_mov1" name="tipo_mov1" /> 
			 @endif
			 </center></td>
			 <td colspan="1" width="1050">Cargo: 
				@if(old('tipo_mov1') == "on")
				<select class="form-control" id="cargo" name="cargo" required="true" onchange="funcaoCargoSalario('sim')">
				  <option id="cargo" name="cargo" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargo)
				      @if(old('cargo') == $cargo->nome)
						<option id="cargo" name="cargo" selected value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>	
					  @else
						<option id="cargo" name="cargo" value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>	  
					  @endif
					@endforeach
				  @endif
				</select>
				@else
				<select class="form-control" id="cargo" name="cargo" disabled="" required="true" onchange="funcaoCargoSalario('sim')">
				  <option id="cargo" name="cargo" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargo)
						<option id="cargo" name="cargo" value="<?php echo $cargo->nome; ?>">{{ $cargo->nome }}</option>	
					@endforeach
				  @endif
				</select>	
				@endif
			 </td>
			 <td width="370">
			 @if(old('tipo_mov1') == "on")
			 Salário <br>
			 <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" required="true" id="salario" name="salario" value="{{ old('salario') }}" onchange="somarSalarios('sim')" />
			 Outras Verbas
			 <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="outras_verbas" name="outras_verbas" value="{{ old('outras_verbas') }}" onchange="somarSalarios('sim')" />
			 Remuneração Total:
			 <input class="form-control" disabled id="remuneracao_total" name="remuneracao_total" value="{{ old('remuneracao_total') }}" />
			 @else
			 Salário <br>
			 <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" disabled="true" type="number" required="true" id="salario" name="salario" value="{{ old('salario') }}" onchange="somarSalarios('sim')" />
			 Outras Verbas
			 <input class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" disabled="true" type="number" id="outras_verbas" name="outras_verbas" value="{{ old('outras_verbas') }}" onchange="somarSalarios('sim')" />	 
			 Remuneração Total:
			 <input class="form-control" disabled id="remuneracao_total" name="remuneracao_total" value="{{ old('remuneracao_total') }}" />
			 @endif	
			 </td>
			 <td width="200">Horário de Trabalho: <br>
				  @if(old('tipo_mov1') == "on")
				  <select class="form-control" id="horario_trabalho" name="horario_trabalho" required="true" onchange="ativarOutra('sim')">
				  @if(old('horario_trabalho') == "07:00 as 16:00")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00" selected>07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif(old('horario_trabalho') == "08:00 as 17:00")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00" selected>08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif(old('horario_trabalho') == "07:00 as 19:00")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00" selected>07h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif(old('horario_trabalho') == "09:00 as 19:00")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00" selected>09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  @elseif(old('horario_trabalho') == "0")
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0" selected>Outro...</option>
				  Outro:
				  <input class="form-control" type="text" id="horario_trabalho2" name="horario_trabalho2" value="{{ old('horario_trabalho2') }}" />	
				  @endif
				  </select>
				  @else
				  <select class="form-control" disabled="true" id="horario_trabalho" name="horario_trabalho" required="true" onchange="ativarOutra('sim')"> 
				  <option id="horario_trabalho" name="horario_trabalho" value="">Selecione...</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 16:00">07h às 16h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="08:00 as 17:00">08h às 17h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="07:00 as 19:00">07h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="09:00 as 19:00">09h às 19h</option>
				  <option id="horario_trabalho" name="horario_trabalho" value="0">Outro...</option>
				  </select>
				  @endif
				
				Outro:
				<input class="form-control" disabled="true" type="text" id="horario_trabalho2" name="horario_trabalho2" disabled="true" />	
			 </td>
			</tr>
			<tr>
			 <td colspan="1" width="1050">Escala de Trabalho: <br><br> 
			 @if(old('tipo_mov1') == "on")
			 @if(old('escala_trabalho') == "segxsex")
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" checked /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 
			 @elseif(old('escala_trabalho') == "12x36")
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" checked /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 
			 @elseif(old('escala_trabalho') == "12x60")
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" checked /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 
			 @elseif(old('escala_trabalho') == "outra")
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" checked /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="{{ old('escala_trabalho6') }}" /> 
			 @else
			 <input type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 
			 @endif
			 @else
			 <input disabled="true" type="checkbox" id="escala_trabalho" name="escala_trabalho" value="segxsex" /> Segunda a Sexta <br>
			 <input disabled="true" type="checkbox" id="escala_trabalho2" name="escala_trabalho" value="12x36" /> 12x36 <br>
			 <input disabled="true" type="checkbox" id="escala_trabalho3" name="escala_trabalho" value="12x60" /> 12x60 <br>
			 <input disabled="true" type="checkbox" id="escala_trabalho4" name="escala_trabalho" value="outra" onclick="desabilitarOutra('sim')" /> Outra: 
			 <input disabled="true" type="text" style="width: 108px;" id="escala_trabalho6" name="escala_trabalho6" value="" /> 	 
			 @endif
			 </td> 
			 <td width="370">Centro de Custo: 
			   @if(old('tipo_mov1') == "on")
			   <select id="centro_custo" name="centro_custo" class="form-control" required>
			    @if(!empty($centro_custos))
				 @foreach($centro_custos as $c_c)
			      @if(old('centro_custo') == $c_c->nome)
				   <option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>" selected>{{ $c_c->nome }}</option>
			      @else
				   <option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>">{{ $c_c->nome }}</option>	  
				  @endif
				 @endforeach
				@endif
			   </select>
			   @else
			   <select id="centro_custo" disabled="true" name="centro_custo" class="form-control" required>
			    <option id="centro_custo" name="centro_custo" value="">Selecione...</option>
			    @if(!empty($centro_custos))
				 @foreach($centro_custos as $c_c)
				   <option id="centro_custo" name="centro_custo" value="<?php echo $c_c->nome; ?>">{{ $c_c->nome }}</option>	  
				 @endforeach
				@endif
			   </select>	   
			   @endif
			 </td>
			 <td width="450">Jornada:
			    @if(old('tipo_mov1') == "on")
			    <select class="form-control" id="jornada" name="jornada" required>
				  <option id="jornada" name="jornada" value="">Selecione...</option>
				  @if(old('jornada') == "diarista")
				  <option id="jornada" name="jornada" value="diarista" selected>Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  <option id="jornada" name="jornada" value="outra">Outra</option>
				  @elseif(old('jornada') == "plantao_par")
				  <option id="jornada" name="jornada" value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par" selected>Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  <option id="jornada" name="jornada" value="outra">Outra</option>
				  @elseif(old('jornada') == "plantao_impar")
				  <option id="jornada" name="jornada" value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar" selected>Plantão Ímpar</option>
				  <option id="jornada" name="jornada" value="outra">Outra</option>
				  @elseif(old('jornada') == "outra")
				  <option id="jornada" name="jornada" value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  <option id="jornada" name="jornada" value="outra" checked>Outra</option>
				  @else
				  <option id="jornada" name="jornada" value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  <option id="jornada" name="jornada" value="outra">Outra</option>	   
				  @endif
				</select>
				@else
				<select disabled="true" class="form-control" id="jornada" name="jornada" required>
				  <option id="jornada" name="jornada" value="">Selecione...</option>
				  <option id="jornada" name="jornada" value="diarista">Diarista</option>
				  <option id="jornada" name="jornada" value="plantao_par">Plantão Par</option>
				  <option id="jornada" name="jornada" value="plantao_impar">Plantão Ímpar</option>
				  <option id="jornada" name="jornada" value="outra">Outra</option>
				</select>	
				@endif
			 <br>Turno: <br> 
			  @if(old('tipo_mov1') == "on")
			  @if(old('turno') == "dia")
			  <input checked type="checkbox" id="turno" name="turno" value="dia" /> Dia 
			  <input type="checkbox" id="turno2" name="turno" value="noite" /> Noite
		      @elseif(old('turno') == "noite")
			  <input type="checkbox" id="turno" name="turno" value="dia" /> Dia 
			  <input checked type="checkbox" id="turno2" name="turno" value="noite" /> Noite
			  @else
			  <input type="checkbox" id="turno" name="turno" value="dia" /> Dia 	  
			  <input type="checkbox" id="turno2" name="turno" value="noite" /> Noite
			  @endif
			  @else
			  <input disabled="true" type="checkbox" id="turno" name="turno" value="dia" /> Dia 	  
			  <input disabled="true" type="checkbox" id="turno2" name="turno" value="noite" /> Noite	  
			  @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Tipo: <br> 
			 @if(old('tipo_mov1') == "on")
			 @if(old('tipo') == "efetivo")
			 <input checked type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 @elseif(old('tipo') == "estagiario")
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input checked type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 @elseif(old('tipo') == "temporario")
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input checked type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 @elseif(old('tipo') == "aprendiz")
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input checked type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 @else
			 <input type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 @endif
			 @else
			 <input disabled="true" type="checkbox" id="tipo" name="tipo" value="efetivo" class="checkgroup" /> Efetivo 
			 <input disabled="true" type="checkbox" id="tipo2" name="tipo" value="estagiario" class="checkgroup" /> Estagiário 
			 <input disabled="true" type="checkbox" id="tipo3" name="tipo" value="temporario" class="checkgroup" /> Temporário 
			 <input disabled="true" type="checkbox" id="tipo4" name="tipo" value="aprendiz" class="checkgroup" /> Aprendiz 
			 <input disabled="true" type="checkbox" id="tipo5" name="tipo" value="rpa" onclick="desabilitarRPA('sim')" class="checkgroup" /> RPA (Período (Competência)): 
			 <input type="month" id="mes_ano" name="mes_ano" style="width: 163px;" /> Até
			 <input type="month" id="mes_ano2" name="mes_ano2" style="width: 163px;" />
			 @endif
			 </td>
			</tr>
			<tr>
			 <td colspan="3">Motivo: <br> 
			 @if(old('tipo_mov1') == "on")
			 @if(old('motivo') == "aumento_quadro")
			 <input checked type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 
			 @elseif(old('motivo') == "substituicao_temporaria")
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input checked type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 
			 @elseif(old('motivo') == "segundo_vinculo")
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input checked type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 
			 @elseif(old('motivo') == "substituicao_definitiva")
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input checked type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input type="text" style="width: 220px;" id="motivo6" name="motivo6" value="{{ old('motivo6') }}" /> 
			 @else
			 <input type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 
			 @endif
			 @else
			 <input disabled="true" type="checkbox" id="motivo" name="motivo" value="aumento_quadro" /> Aumento de Quadro 
			 <input disabled="true" type="checkbox" id="motivo2" name="motivo" value="substituicao_temporaria" /> Substituição temporária 
			 <input disabled="true" type="checkbox" id="motivo3" name="motivo" value="segundo_vinculo" /> Segundo Vínculo 
			 <input disabled="true" type="checkbox" id="motivo4" name="motivo" value="substituicao_definitiva" onclick="desabilitarSubst('sim')" /> Substituição definitiva a: 
			 <input disabled="true" type="text" style="width: 220px;" id="motivo6" name="motivo6" /> 	 
			 @endif
			 </td>
			</tr>
			<tr>
			 <td>Possibilidade de Contratação de Deficiente:<br> 
			 @if(old('tipo_mov1') == "on")
			 @if(old('possibilidade_contratacao') == "sim")
			 <input checked type="checkbox" id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" /> Sim 
			 <input type="checkbox" id="possibilidade_contratacao2" name="possibilidade_contratacao" value="nao" /> Não
			 @elseif(old('possibilidade_contratacao') == "nao")
			 <input type="checkbox" id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" /> Sim 
			 <input checked type="checkbox" id="possibilidade_contratacao2" name="possibilidade_contratacao" value="nao" /> Não
			 @else
			 <input type="checkbox" id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" /> Sim 
			 <input type="checkbox" id="possibilidade_contratacao2" name="possibilidade_contratacao" value="nao" /> Não	 
			 @endif
			 @else
			 <input disabled="true" type="checkbox" id="possibilidade_contratacao" name="possibilidade_contratacao" value="sim" /> Sim 
			 <input disabled="true" type="checkbox" id="possibilidade_contratacao2" name="possibilidade_contratacao" value="nao" /> Não	 
			 @endif
			 </td>
			 <td colspan="2">Necessidade de conta de e-mail:<br> 
			 @if(old('tipo_mov1') == "on")
			 @if(old('necessidade_email') == "sim")
			 <input checked type="checkbox" id="necessidade_email" name="necessidade_email" value="sim" /> Sim 
			 <input type="checkbox" id="necessidade_email2" name="necessidade_email" value="nao" /> Não
			 @elseif(old('necessidade_email') == "nao")
			 <input type="checkbox" id="necessidade_email" name="necessidade_email" value="sim" /> Sim 
			 <input checked type="checkbox" id="necessidade_email2" name="necessidade_email" value="nao" /> Não
			 @else
			 <input type="checkbox" id="necessidade_email" name="necessidade_email" value="sim" /> Sim 
			 <input type="checkbox" id="necessidade_email2" name="necessidade_email" value="nao" /> Não
			 @endif
			 @else
			 <input disabled="true" type="checkbox" id="necessidade_email" name="necessidade_email" value="sim" /> Sim 
			 <input disabled="true" type="checkbox" id="necessidade_email2" name="necessidade_email" value="nao" /> Não	 
			 @endif
			 </td>
			</tr>
		   </table>
		  </center>

		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="135"><center><h5>Demissão</h5> 
			@if(old('tipo_mov2') == "on")
			<input type="checkbox" onclick="desabilitar2('sim')" id="tipo_mov2" name="tipo_mov2" checked />
		    @else
			<input disabled type="checkbox" onclick="desabilitar2('sim')" id="tipo_mov2" name="tipo_mov2" />	
			@endif
			</center>
			</td>
			<td width="800">Tipo de desligamento: 
			@if(old('tipo_mov2') == "on")
			@if(old('tipo_desligamento') == "termino_contrato")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" checked /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@elseif(old('tipo_desligamento') == "extincao_antecipada")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" checked /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@elseif(old('tipo_desligamento') == "sem_justa_causa")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" checked /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@elseif(old('tipo_desligamento') == "aposentadoria")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" checked /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@elseif(old('tipo_desligamento') == "com_justa_causa")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" checked /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@elseif(old('tipo_desligamento') == "morte")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" checked /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@elseif(old('tipo_desligamento') == "pedido_demissao")	
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" checked /> Pedido de Demissão 
			@else 
			<br><br> <input type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão  
			@endif
			@else
			<br><br> <input disabled="true" type="checkbox" id="tipo_desligamento" name="tipo_desligamento" value="termino_contrato" /> Término de Contrato 
			<br> <input disabled="true" type="checkbox" id="tipo_desligamento2" name="tipo_desligamento" value="extincao_antecipada" /> Extinção Antecipada do Contrato 
			<br> <input disabled="true" type="checkbox" id="tipo_desligamento3" name="tipo_desligamento" value="sem_justa_causa" /> Dispensa sem justa causa 
			<br> <input disabled="true" type="checkbox" id="tipo_desligamento4" name="tipo_desligamento" value="aposentadoria" /> Aposentadoria 
			<br> <input disabled="true" type="checkbox" id="tipo_desligamento5" name="tipo_desligamento" value="com_justa_causa" /> Dispensa com justa causa 
			<br> <input disabled="true" type="checkbox" id="tipo_desligamento6" name="tipo_desligamento" value="morte" /> Morte 
			<br> <input disabled="true" type="checkbox" id="tipo_desligamento7" name="tipo_desligamento" value="pedido_demissao" /> Pedido de Demissão 
			@endif
			</td>
			<td width="200">Aviso Prévio: <br><br> 
			@if(old('tipo_mov2') == "on")
			@if(old('aviso_previo') == "trabalhado")
			<input type="checkbox" id="aviso_previo" name="aviso_previo" value="trabalhado" checked /> Trabalhado 
			<br><br> <input type="checkbox" id="aviso_previo2" name="aviso_previo" value="indenizado" /> Indenizado 
			<br><br> <input type="checkbox" id="aviso_previo3" name="aviso_previo" value="dispensado" /> Dispensado </td>
			@elseif(old('aviso_previo') == "indenizado")
			<input type="checkbox" id="aviso_previo" name="aviso_previo" value="trabalhado" /> Trabalhado 
			<br><br> <input type="checkbox" id="aviso_previo2" name="aviso_previo" value="indenizado" checked /> Indenizado 
			<br><br> <input type="checkbox" id="aviso_previo3" name="aviso_previo" value="dispensado" /> Dispensado </td>
			@elseif(old('aviso_previo') == "dispensado")
			<input type="checkbox" id="aviso_previo" name="aviso_previo" value="trabalhado" /> Trabalhado 
			<br><br> <input type="checkbox" id="aviso_previo2" name="aviso_previo" value="indenizado" /> Indenizado 
			<br><br> <input type="checkbox" id="aviso_previo3" name="aviso_previo" value="dispensado" checked /> Dispensado </td>
			@else
			<input type="checkbox" id="aviso_previo" name="aviso_previo" value="trabalhado" /> Trabalhado 
			<br><br> <input type="checkbox" id="aviso_previo2" name="aviso_previo" value="indenizado" /> Indenizado 
			<br><br> <input type="checkbox" id="aviso_previo3" name="aviso_previo" value="dispensado" /> Dispensado </td>	
			@endif
			@else
			<input disabled="true" type="checkbox" id="aviso_previo" name="aviso_previo" value="trabalhado" /> Trabalhado 
			<br><br> <input disabled="true" type="checkbox" id="aviso_previo2" name="aviso_previo" value="indenizado" /> Indenizado 
			<br><br> <input disabled="true" type="checkbox" id="aviso_previo3" name="aviso_previo" value="dispensado" /> Dispensado </td>	
			@endif
			<td width="50">Último dia Trabalhado: <br> 
			@if(old('tipo_mov2') == "on")
			<input required class="form-control" type="date" id="ultimo_dia" name="ultimo_dia" value="{{ old('ultimo_dia') }}" /> 
			@else
			<input required disabled="true" class="form-control" type="date" id="ultimo_dia" name="ultimo_dia" /> 	
			@endif
			<br> Custo da Recisão: 
			@if(old('tipo_mov2') == "on")
			<input required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" class="form-control" id="custo_recisao" name="custo_recisao"  value="{{ old('custo_recisao') }}" />
			@else
			<input disabled="true" required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" class="form-control" id="custo_recisao" name="custo_recisao"  /> 
			@endif
			<br> Salário Bruto: 
			@if(old('tipo_mov2') == "on")
			<input required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" class="form-control" id="salario_bruto" name="salario_bruto"  value="{{ old('salario_bruto') }}" /> </td>
			@else
			<input disabled="true" required placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" class="form-control" id="salario_bruto" name="salario_bruto"  /> </td>	
			@endif
		   </tr>
		  </table>
		  </center>
				
		  <br>
			
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="130" rowspan="6"><center><h5>Alteração Funcional</h5> 
			@if(old('tipo_mov3') == "on")
			<input type="checkbox" onclick="desabilitar3('sim')" checked id="tipo_mov3" name="tipo_mov3" />
			@else
			<input disabled type="checkbox" onclick="desabilitar3('sim')" id="tipo_mov3" name="tipo_mov3" />	
			@endif
			</center></td>
			
			<td width="400">Transferência proposta: Indique a Unidade 
			  @if(old('tipo_mov3') == "on")
			  <select required id="unidade_id2" name="unidade_id2" class="form-control">
			  @foreach($unidades as $unidade)
			   @if(old('unidade_id2') == $unidade->nome)
			    <option id="unidade_id2" name="unidade_id2" selected>{{ $unidade->nome }}</option>
			   @else
				<option id="unidade_id2" name="unidade_id2">{{ $unidade->nome }}</option>   
			   @endif
			  @endforeach
			  </select>
			  @else
			  <select required disabled="true" id="unidade_id2" name="unidade_id" class="form-control">
			   <option id="unidade_id2" name="unidade_id2" value="">Selecione...</option>
			  @foreach($unidades as $unidade)
			    <option id="unidade_id2" name="unidade_id2">{{ $unidade->nome }}</option>
			  @endforeach
			  </select>
			  @endif
			  <td colspan="1">Departamento Proposto 
				  @if(old('tipo_mov3') == "on")
			 <select required class="form-control" id="setor" name="setor">
			 <option id="setor" name="setor" value="">Selecione...</option>
			 @foreach($setores as $setor)
			 @if(old('setor') == $setor->nome)
			    <option id="setor" name="setor" value="<?php echo $setor->nome; ?>" selected>{{ $setor->nome }}</option>
				@else
				<option id="setor" name="setor" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>   
				@endif
				@endforeach
			</select>
			@else
			<select required disabled="true" class="form-control" id="setor" name="setor">
				<option id="setor" name="setor" value="">Selecione...</option>
				@foreach($setores as $setor)
			    <option id="setor" name="setor" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>
				@endforeach
			</select>	 
			@endif
		</td>
		</td>
		<td>Novo Centro de Custo: 
		@if(old('tipo_mov3') == "on")
		<select required name="centro_custo_novo" id="centro_custo_novo" class="form-control">	
		<option id="centro_custo_novo" name="centro_custo_novo" value="">Selecione...</option>
			@foreach($centro_custo_nv as $cc_nv)
			@if(old('centro_custo_novo') == $cc_nv->nome)
			<option id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $cc_nv->nome; ?>" selected>{{ $cc_nv->nome }}</option>
			@else
			<option id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $cc_nv->nome; ?>">{{ $cc_nv->nome }}</option>	
			@endif
			@endforeach
		</select>
		@else
		<select required disabled="true" name="centro_custo_novo" id="centro_custo_novo" class="form-control">	
		<option id="centro_custo_novo" name="centro_custo_novo" value="">Selecione...</option>
			@foreach($centro_custo_nv as $cc_nv)
			<option id="centro_custo_novo" name="centro_custo_novo" value="<?php echo $cc_nv->nome; ?>">{{ $cc_nv->nome }}</option>
			@endforeach
		</select>	   
		@endif
		</td>
		   </tr>
		   <tr>
		    <td colspan="1">Cargo Atual: 
			  @if(old('tipo_mov3') == "on")
			  <select required class="form-control" id="cargo_atual" name="cargo_atual">
			     <option id="cargo_atual" name="cargo_atual" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargoAtual)
				      @if(old('cargo_atual') == $cargoAtual->nome)
						<option id="cargo_atual" name="cargo_atual" value="<?php echo $cargoAtual->nome; ?>" selected>{{ $cargoAtual->nome }}</option>	
					  @else
						<option id="cargo_atual" name="cargo_atual" value="<?php echo $cargoAtual->nome; ?>">{{ $cargoAtual->nome }}</option>	  
					  @endif
					@endforeach
				  @endif
			  </select>
			  @else
			  <select required disabled="true" class="form-control" id="cargo_atual" name="cargo_atual">
			     <option id="cargo_atual" name="cargo_atual" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargoAtual)
						<option id="cargo_atual" name="cargo_atual" value="<?php echo $cargoAtual->nome; ?>">{{ $cargoAtual->nome }}</option>	
					@endforeach
				  @endif
			  </select>	  
			  @endif
			</td>
			<td colspan="1">Cargo Proposto: 
			  @if(old('tipo_mov3') == "on")
			  <select required class="form-control" id="cargo_novo" name="cargo_novo">
			    <option id="cargo_novo" name="cargo_novo" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargoP)
				      @if(old('cargo_novo') == $cargoP->nome)
						<option id="cargo_novo" name="cargo_novo" value="<?php echo $cargoP->nome; ?>" selected>{{ $cargoP->nome }}</option>	
					  @else
						<option id="cargo_novo" name="cargo_novo" value="<?php echo $cargoP->nome; ?>">{{ $cargoP->nome }}</option>  
					  @endif
					@endforeach
				  @endif
			  </select>
			  @else
			  <select required disabled="true" class="form-control" id="cargo_novo" name="cargo_novo">
			    <option id="cargo_novo" name="cargo_novo" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargoP)
						<option id="cargo_novo" name="cargo_novo" value="<?php echo $cargoP->nome; ?>">{{ $cargoP->nome }}</option>	
					@endforeach
				  @endif
			  </select> 	  
			  @endif
			</td>

			<td width="50">Novo Horário de Trabalho 
			@if(old('tipo_mov3') == "on")
			<input class="form-control" style="width: 250px;" type="text" id="horario_novo" name="horario_novo" value="{{ old('horario_novo') }}" />
			@else
			<input disabled="true" class="form-control" style="width: 300px;" type="text" id="horario_novo" name="horario_novo" />	
			@endif
			</td>
		   </tr>
		   <tr>
		    <td> Existe Alteração de Remuneração:
			     SIM <input onclick="desabilitarSal('sim')" disabled="true" type="checkbox" id="remuneracao" name="remuneracao" /></td>
		   </tr>
		   <tr>
		    <td>Salário Atual: 
			@if(old('tipo_mov3') == "on")
			<input required class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_atual" onChange="subtrai();"  name="salario_atual" value="{{ old('salario_atual') }}" />
		    @else
			<input required class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" disabled="true" type="number" id="salario_atual" onChange="subtrai();"  name="salario_atual"  />	
			@endif
			</td>
			<td width="300">Salário Proposto: 
			@if(old('tipo_mov3') == "on")
			<input required class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_novo" onChange="subtrai();"  name="salario_novo" value="{{ old('salario_novo') }}" />	
			@else
			<input required disabled="true" class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="salario_novo" onChange="subtrai();"  name="salario_novo"  />	
			@endif
			</td>
			<td width="300"><b>Diferença Salarial: </b>
			@if(old('tipo_mov3') == "on")
			<input required class="form-control" readonly="true" placeholder="ex: 2500 ou 2580,21"  type="text" id="renda_var" name="renda_var" value="{{ old('renda_var') }}" />	
			@else
			<input required disabled="true" readonly="true" class="form-control" placeholder="ex: 2500 ou 2580,21"  type="text" id="renda_var" name="renda_var"  />	
			@endif
		   </tr>
		   <tr>
			 <td> Gratificações:
			 @if(old('tipo_mov3') == "on")	 
			 <input required class="form-control" placeholder="ex: 2500 ou 2580,21" step="00.01" type="number" id="gratificacoes" name="gratificacoes" value="{{ old('gratificacoes') }}" />	
			 @else
			 <input required disabled="true" class="form-control" placeholder="ex: 2500 ou 2580,21"  type="number" id="gratificacoes" name="gratificacoes"  />	
			 @endif
			 </td>
		   </tr>
		   <tr>
			<td colspan="3">Motivo: <br><br> 
			@if(old('tipo_mov3') == "on")
			@if(old('motivo') == "promocao")	
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" checked /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="empregado" /> Empregado &nbsp;&nbsp;   
			<input type="checkbox" id="motivoA11" name="motivo" value="empregador" /> Empregador
			@elseif(old('motivo') == "merito")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" checked /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="empregado" /> Empregado &nbsp;&nbsp;   
			<input type="checkbox" id="motivoA11" name="motivo" value="empregador" /> Empregador
			@elseif(old('motivo') == "mudanca_setor_area")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" checked /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="empregado" /> Empregado &nbsp;&nbsp;   
			<input type="checkbox" id="motivoA11" name="motivo" value="empregador" /> Empregador
			@elseif(old('motivo') == "transferencia_outra_unidade")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" checked /> Transferência para outra unidade 
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="empregado" /> Empregado &nbsp;&nbsp;   
			<input type="checkbox" id="motivoA11" name="motivo" value="empregador" /> Empregador
			@elseif(old('motivo') == "enquadramento")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" checked /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="empregado" /> Empregado &nbsp;&nbsp;   
			<input type="checkbox" id="motivoA11" name="motivo" value="empregador" /> Empregador
			@elseif(old('motivo') == "mudanca_horaria")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" checked /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="empregado" /> Empregado &nbsp;&nbsp;  
			<input type="checkbox" id="motivoA11" name="motivo" value="empregador" /> Empregador
			@elseif(old('motivo') == "substituicao_demissao_voluntaria")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" checked /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="empregado" /> Empregado &nbsp;&nbsp;   
			<input type="checkbox" id="motivoA11" name="motivo" value="empregador" /> Empregador
			@elseif(old('motivo') == "recrutamento_interno")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" checked /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="empregado" /> Empregado &nbsp;&nbsp;   
			<input type="checkbox" id="motivoA11" name="motivo" value="empregador" /> Empregador
			@elseif(old('motivo') == "aumento_quadro")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" checked /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="empregado" /> Empregado &nbsp;&nbsp;   
			<input type="checkbox" id="motivoA11" name="motivo" value="empregador" /> Empregador
			@elseif(old('motivo') == "empregado")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="empregado" checked /> Empregado &nbsp;&nbsp;   
			<input type="checkbox" id="motivoA11" name="motivo" value="empregador" /> Empregador
			@elseif(old('motivo') == "empregador")
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="empregado" /> Empregado &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA11" name="motivo" value="empregador" checked /> Empregador
			@else
			<input type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			<br><br> <input type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao_voluntaria" /> Substituição por demissão voluntária <br><br> 
			<input type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" id="motivoA10" name="motivo" value="empregado" /> Empregado &nbsp;&nbsp;  
			<input type="checkbox" id="motivoA11" name="motivo" value="empregador" /> Empregador
			@endif
			@else
			<input disabled="true" type="checkbox" id="motivoA" name="motivo" value="promocao" /> Promoção &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input disabled="true" type="checkbox" id="motivoA2" name="motivo" value="merito" /> Mérito 
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input disabled="true" type="checkbox" id="motivoA3" name="motivo" value="mudanca_setor_area" /> Mudança de Setor/Área &nbsp;&nbsp; 
			<input disabled="true" type="checkbox" id="motivoA4" name="motivo" value="transferencia_outra_unidade" /> Transferência para outra unidade 
			<br><br> <input disabled="true" type="checkbox" id="motivoA5" name="motivo" value="enquadramento" /> Enquadramento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input disabled="true" type="checkbox" id="motivoA6" name="motivo" value="mudanca_horaria" /> Mudança de Horário 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input disabled="true" type="checkbox" id="motivoA7" name="motivo" value="substituicao_demissao" /> Substituição por demissão <br><br> 
			<input disabled="true" type="checkbox" id="motivoA8" name="motivo" value="recrutamento_interno" /> Recrutamento Interno &nbsp;&nbsp;&nbsp;&nbsp; 
			<input disabled="true" type="checkbox" id="motivoA9" name="motivo" value="aumento_quadro" /> Aumento de Quadro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input disabled="true" type="checkbox" id="motivoA10" name="motivo" value="empregado" /> Empregado &nbsp;&nbsp;   
			<input disabled="true" type="checkbox" id="motivoA11" name="motivo" value="empregador" /> Empregador
			@endif
			</td>
		   </tr>
		  </table>
		</center>
		@endif

		@if($tipo_mp == 1)
		<center>
		<table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		  <tr>
			<td width="130" rowspan="5"><center><h5>RPA</h5> 
			@if(old('tipo_mov4') == "on")
			<input type="checkbox" onclick="desabilitar4('sim')" checked id="tipo_mov4" name="tipo_mov4" />
			@else
			<input disabled type="checkbox" onclick="desabilitar4('sim')" id="tipo_mov4" name="tipo_mov4" />	
			@endif
			</center>
			<td colspan="2">Departamento 
			 @if(old('tipo_mov4') == "on")
			 <select  class="form-control" id="setor_plantao" name="setor_plantao">
			 <option id="setor_plantao" name="setor_plantao" value="">Selecione...</option>
			 @foreach($setores as $setor)
			   @if(old('setor_plantao') == $setor->nome)
			    <option id="setor_plantao" name="setor_plantao" value="<?php echo $setor->nome; ?>" selected>{{ $setor->nome }}</option>
			   @else
				<option id="setor_plantao" name="setor_plantao" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>   
			   @endif
			 @endforeach
			 </select>
			 @else
			 <select required disabled="true" class="form-control" id="setor_plantao" name="setor_plantao">
			 <option id="setor_plantao" name="setor_plantao" value="">Selecione...</option>
			 @foreach($setores as $setor)
			    <option id="setor_plantao" name="setor_plantao" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>
			 @endforeach
			 </select>	 
			 @endif
			</td>
			<td colspan="1">Profissional: 
			  @if(old('tipo_mov4') == "on")
			  <select required class="form-control" id="cargo_plantao" name="cargo_plantao">
			    <option id="cargo_plantao" name="cargo_plantao" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargoP)
				      @if(old('cargo_plantao') == $cargoP->nome)
						<option id="cargo_plantao" name="cargo_plantao" value="<?php echo $cargoP->nome; ?>" selected>{{ $cargoP->nome }}</option>	
					  @else
						<option id="cargo_plantao" name="cargo_plantao" value="<?php echo $cargoP->nome; ?>">{{ $cargoP->nome }}</option>  
					  @endif
					@endforeach
				  @endif
			  </select>
			  @else
			  <select required disabled="true" class="form-control" id="cargo_plantao" name="cargo_plantao">
			    <option id="cargo_plantao" name="cargo_plantao" value="">Selecione...</option>
				  @if(!empty($cargos))	
					@foreach($cargos as $cargoP)
						<option id="cargo_plantao" name="cargo_plantao" value="<?php echo $cargoP->nome; ?>">{{ $cargoP->nome }}</option>	
					@endforeach
				  @endif
			  </select> 	  
			  @endif
			</td>
		   </tr>
		   <tr>
			<td colspan="2">Substituto:
			@if(old('tipo_mov4') == "on")
			<input class="form-control" required style="width: 560px;" type="text" id="substituto" name="substituto" value="{{ old('substituto') }}" />
			@else
			<input disabled="true" class="form-control" style="width: 560px;" type="text" id="substituto" name="substituto" />	
			@endif
			</td>
			<td>Motivo: 
			   @if(old('tipo_mov4') == "on")
			   <select required  name="motivo_plantao" id="motivo_plantao" class="form-control">	
			    <option id="motivo_plantao" name="motivo_plantao" value="">Selecione..</option>
				<option id="motivo_plantao" name="motivo_plantao" value="">Atestado Médico</option>
				<option id="motivo_plantao" name="motivo_plantao" value="">Férias</option>
				<option id="motivo_plantao" name="motivo_plantao" value="">Licença Maternidade</option>
				<option id="motivo_plantao" name="motivo_plantao" value="">Outras</option>
				</select>
			   @else
			   <select required disabled="true" name="motivo_plantao" id="motivo_plantao" class="form-control">	
			    <option id="motivo_plantao" name="motivo_plantao" value="">Selecione..</option>
				<option id="motivo_plantao" name="motivo_plantao" value="">Atestado Médico</option>
				<option id="motivo_plantao" name="motivo_plantao" value="">Férias</option>
				<option id="motivo_plantao" name="motivo_plantao" value="">Licença Maternidade</option>
				<option id="motivo_plantao" name="motivo_plantao" value="">Outras</option>
				</select>  
			   @endif
			</td>
		   </tr>
		   <tr>
			   <td width="120">Plantões/Diárias:
			   @if(old('tipo_mov4') == "on")
			   <select disabled required="true" class="form-control" id="quantidade_plantao" name="quantidade_plantao" onChange="multiplicar();">
				 @for($a = 1; $a < 31; $a++)  
				 <option id="quantidade_plantao" name="quantidade_plantao" value="<?php echo $a; ?>">{{ $a }}</option>
				 @endfor
			   </select>
			   @else
			   <select disabled required="true" class="form-control" id="quantidade_plantao" name="quantidade_plantao" onChange="multiplicar();">
				 @for($a = 1; $a < 31; $a++)  
				 <option id="quantidade_plantao" name="quantidade_plantao" value="<?php echo $a; ?>">{{ $a }}</option>
				 @endfor
			   </select>
			   @endif
			   </td>
		       <td>Valor do Plantão:
				@if(old('tipo_mov4') == "on")
				<input required="true" class="form-control" placeholder="ex: 2500 ou 2580,21"  type="number" id="valor_plantao" name="valor_plantao" onChange="multiplicar();" value="{{ old('valor_plantao') }}" />
				@else
				<input required class="form-control" placeholder="ex: 2500 ou 2580,21"  disabled="true" type="number" onChange="multiplicar();" id="valor_plantao" name="valor_plantao"  />	
				@endif
				</td>
				<td width="300">Valor a ser Pago: (Quantidade * Valor)
				@if(old('tipo_mov4') == "on")
				<input required class="form-control" readonly="true" placeholder="ex: 2500 ou 2580,21"  type="number" id="valor_pago_plantao" name="valor_pago_plantao" value="{{ old('valor_pago_plantao') }}" />	
				@else
				<input required disabled="true"  readonly="true" class="form-control" placeholder="ex: 2500 ou 2580,21"  type="number" id="valor_pago_plantao" name="valor_pago_plantao"  />	
				@endif
			   </td>
		   </tr>
		 </table>
	  	</center>
		@endif

		  <br>
		  <center>		
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="40"><strong><h5>Justificativa/Observações:</h5></strong></td>
			<td><textarea required type="text" id="descricao" name="descricao" class="form-control" required="true" rows="3" cols="60" maxlength="200"> {{ old('descricao') }} </textarea></td>
		   </tr>
		  </table>
		  </center>
		  
		  <br>
		  <center>	
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
			<td width="100" colspan="6"><strong>Aprovações (Carimbo e Assinatura): 48h Úteis para aprovação</strong></td>
		   </tr>
		   <tr>
			<td>Solicitante </td><td><input readonly="true" type="date" id="data_solicitante" name="data_solicitante" class="form-control" /></td>
		   </tr>
		   <tr>
			<td>Gestor Imediato</td><td><input readonly="true" type="date" id="data_gestor_imediato" name="data_gestor_imediato" class="form-control" /></td>
		   </tr>
		   <tr>
			<td>Departamento Pessoal / SESMT</td><td><input readonly="true" type="date" id="data_rec_humanos" name="data_rec_humanos" class="form-control" /></td>
		   </tr>
		   <tr>
			<td>Recursos Humanos</td><td><input readonly="true" type="date" id="data_rec_humanos" name="data_rec_humanos" class="form-control" /></td>
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
		  
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td align="right"> 
			 <a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
			 <input type="submit" onclick="validar()" class="btn btn-success btn-sm" style="margin-top: 10px;" value="CONCLUIR" id="Salvar" name="Salvar" /> 
			</td>
		   </tr>
		  </table>
		  </center>
   </form>

</body>

