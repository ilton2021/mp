<html>
  <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>MP RH</title>
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
	    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
		<style>
		.navbar .dropdown-menu .form-control {
			width: 300px;
		}
        </style>
		<script>
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
         ["Elemento", "Total", { role: "style" } ],
		 ["Total Salário Atual", <?php echo $totalAltSA ?>, "blue"],
		 ["", <?php echo 0 ?>, "blue"],
		 ["Total Salário Novo", <?php echo $totalAltSN ?>, "red"]
        ]);
        var view = new google.visualization.DataView(data);
		view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);
      var options = {
        title: "Total de Salários - MP's Alteração Funcional:",
        width: 800,
        height: 200,
        bar: {groupWidth: "100%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values3"));
      chart.draw(view, options);
      }
    </script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-5 rounded fixed-top">
  	    <img src="{{asset('img/Imagem1.png')}}"  height="50" class="d-inline-block align-top" alt="">
			<span class="navbar-brand mb-0 h1" style="margin-left:10px;margin-top:5px ;color: rgb(103, 101, 103) !important">
				<h4 class="d-none d-sm-block">Movimentação de Pessoal - RH</h4>
			</span>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">     
            
            </div>
            <div class="col-sm-4">
            </div>
        </div>
    </div>
	<section id="unidades">
    <div class="container" style="margin-top:30px; margin-bottom:20px;">
	<p align="right"><a href="{{ url('/home/graphicsIndex') }}" class="btn btn-warning btn-sm" style="margin-top: -15px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a></p>
        <div class="row">
            <div class="col-5">
                <div class="progress" style="height: 3px;">
                    <div class="progress-bar" role="progressbar" style="width: 100%; background-color: #65b345;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-2 text-center"></div>
            <div class="col-5">
                <div class="progress" style="height: 3px;">
                    <div class="progress-bar" role="progressbar" style="width: 100%; background-color: #65b345;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
		@if(Auth::user()->id == 62 || Auth::user()->id == 30 || Auth::user()->id == 13 || Auth::user()->id == 71)
		<center>
	    <form action="{{\Request::route('pesquisarGrafico4')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table>
		 <tr>
		  <td>Unidade:</td>
		  <td>
		  <select width="400px" class="form-control" id="unidade_id" name="unidade_id">
			 <option id="unidade_id" name="unidade_id" value="0">{{ 'Todos' }}</option>
		  @foreach($unidades as $unidade)
		     <option id="unidade_id" name="unidade_id" value="<?php echo $unidade->id; ?>">{{ $unidade->nome }}</option>
		  @endforeach
		  </select>
		  </td>
		  <td>&nbsp;&nbsp;&nbsp;</td>
		  <td align="right">Data Início:</td>
		  <td>
		   <input type="date" id="data_inicio" name="data_inicio" class="form-control" value="" />
		  </td>
		  <td>&nbsp;&nbsp;&nbsp;</td>
		  <td align="right">Data Fim:</td>
		  <td>
		   <input type="date" id="data_fim" name="data_fim" class="form-control" value="" />
		  </td>
		  <td>&nbsp;&nbsp;&nbsp;</td>
		  <td>
		   <input type="submit" id="pesquisar" name="pesquisar" class="btn btn-sm btn-info" value="Pesquisar"> 
		  </td>
		 </tr>
		 <tr>
		   <td colspan="5"><br><center><b>Total de MP's: {{ $qtdAlt }}</b></center></td>
		 </tr>
		</table>
		</form>
		</center>
		@endif
		<table style="margin-left: 170px;"> 
		 <tr>
		  <td><div id="barchart_values3" style="width: 600px; height: 300px;"></div></td>
		 </tr>
		</table>
		<center>
		  <table class="table table-bordered" style="width: 150px;" cellspacing="0">
		   <tr>
		    <td align="center"> 
			 <a id="imprimir" name="imprimir" type="button" class="btn btn-info btn-sm" style="color: #FFFFFF;"> Imprimir <i class="fas fa-box"></i> </a>  
			</td> 
		   </tr>
		  </table>
		</center>
		<center>
	  	 <table class="table table-bordered">
	  	  <tr>
			<td style="background-color: #90EE90"><center>NÚMERO MP</center></td>			
			<td style="background-color: #FFDB58"><center>CENTRO DE CUSTO</center></td>
			<td style="background-color: #87CEFA"><center>SALÁRIO NOVO</center></td>
			<td style="background-color: #90EE90"><center>SALÁRIO ATUAL</center></td>
			<td style="background-color: #FFDB58"><center>MOTIVO</center></td>
		  </tr> <?php $a = 0; $totalCustos = 0; ?>
		  @foreach($alteracaoF as $altF)
		  <tr> <?php $a += 1; $totalCustos += $altF->salario_novo - $altF->salario_atual; ?>
			@foreach($row5 as $mp)
			 @if($mp->id == $altF->mp_id)
			   <td><center>{{ $mp->numeroMP }}</center></td>
			 @endif
			@endforeach
			<td><center>{{ $altF->centro_custo_novo }}</center></td>
			<td><center>{{ "R$ ". number_format($altF->salario_novo,2,',','.') }}</center></td>
			<td><center>{{ "R$ ". number_format($altF->salario_atual,2,',','.') }}</center></td>
			@if($altF->motivo == "merito")
			<td><center>{{ 'MÉRITO' }}</center></td>
			@elseif($altF->motivo == "substituicao_demissao_voluntaria")
			<td><center>{{ 'SUBSTITUIÇÃO POR DEMISSÃO' }}</center></td>
			@elseif($altF->motivo == "mudanca_horaria")
			<td><center>{{ 'MUDANÇA DE HORÁRIO' }}</center></td>
			@elseif($altF->motivo == "mudanca_setor_area")
			<td><center>{{ 'MUDANÇA DE SETOR/ÁREA' }}</center></td>
			@elseif($altF->motivo == "recrutamento_interno")
			<td><center>{{ 'RECRUTAMENTO INTERNO' }}</center></td>
			@elseif($altF->motivo == "promocao")
			<td><center>{{ 'PROMOÇÃO' }}</center></td>
			@elseif($altF->motivo == "transferencia_outra_unidade")
			<td><center>{{ 'TRANSFERÊNCIA PARA OUTRA UNIDADE' }}</center></td>
			@elseif($altF->motivo == "enquadramento")
			<td><center>{{ 'ENQUADRAMENTO' }}</center></td>
			@elseif($altF->motivo == "aumento_quadro")
			<td><center>{{ 'AUMENTO DE QUADRO' }}</center></td>
			@elseif($altF->motivo == "empregado")
			<td><center>{{ 'EMPREGADO' }}</center></td>
			@elseif($altF->motivo == "empregador")
			<td><center>{{ 'EMPREGADOR' }}</center></td>
			@endif
		  </tr>
		  @endforeach
		  <tr>
	  		<td><center><b>QUANTIDADE MP's:</b></center></td>
			<td><center><b>{{ $a }}</b></center></td>
			<td colspan="2"><center><b>TOTAL DE CUSTOS:</b></center></td>
			<td ><center><b>{{ "R$ ". number_format($totalCustos,2,',','.') }}</b></center></td>
		  </tr>
		 </table>
		</center>
    </div>
    </section>		 
 </body>
</html>