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
		 ["Total Custo de Recisão Demissão", <?php echo $totalDem ?>, "gold"],
		 ["", <?php echo 0 ?>, "blue"]
        ]);
        var view = new google.visualization.DataView(data);
		view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);
      var options = {
        title: "Total de Custo de Recisão - MP's Demissão:",
        width: 700,
        height: 200,
        bar: {groupWidth: "100%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values2"));
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
	    <form action="{{\Request::route('pesquisarGrafico5')}}" method="post">
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
		   <td colspan="5"><br><center><b>Total de MP's: {{ $qtdDem }}</b></center></td>
		 </tr>
		</table>
		</form>
		</center>
		@endif
		<table style="margin-left: 170px;"> 
		 <tr>
		  <td><div id="barchart_values2" style="width: 600px; height: 300px;"></div></td>
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
			<td style="background-color: #FFDB58"><center>AVISO PRÉVIO</center></td>
			<td style="background-color: #FFDB58"><center>TIPO DE DESLIGAMENTO</center></td>
			<td style="background-color: #87CEFA"><center>ÚLTIMO DIA</center></td>
			<td style="background-color: #90EE90"><center>CUSTO DA RECISÃO</center></td>
		  </tr> <?php $a = 0; $totalCustos = 0; ?>
		  @foreach($demissao as $dem)
		  <tr> <?php $a += 1; $totalCustos += $dem->custo_recisao; ?>
			@foreach($row5 as $mp)
			 @if($mp->id == $dem->mp_id)
			   <td><center>{{ $mp->numeroMP }}</center></td>
			 @endif
			@endforeach
			@if($dem->aviso_previo == "dispensado")
			<td><center>{{ 'DISPENSADO' }}</center></td>
			@elseif($dem->aviso_previo == "indenizado")
			<td><center>{{ 'INDENIZADO' }}</center></td>
			@elseif($dem->aviso_previo == "trabalhado")
			<td><center>{{ 'TRABALHADO' }}</center></td>
			@elseif($dem->aviso_previo == "dispensado")
			<td><center>{{ 'DISPENSADO' }}</center></td>
			@endif
			@if($dem->tipo_desligamento == "sem_justa_causa")
			<td><center>{{ 'DISPENSA SEM JUSTA CAUSA' }}</center></td>
			@elseif($dem->tipo_desligamento == "termino_contrato")
			<td><center>{{ 'TÉRMINO DE CONTRATO' }}</center></td>
			@elseif($dem->tipo_desligamento == "extincao_antecipada")
			<td><center>{{ 'EXTINÇÃO ANTECIPADA DO CONTRATO' }}</center></td>
			@elseif($dem->tipo_desligamento == "aposentadoria")
			<td><center>{{ 'APOSENTADORIA' }}</center></td>
			@elseif($dem->tipo_desligamento == "com_justa_causa")
			<td><center>{{ 'DISPENSA COM JUSTA CAUSA' }}</center></td>
			@elseif($dem->tipo_desligamento == "morte")
			<td><center>{{ 'MORTE' }}</center></td>
			@elseif($dem->tipo_desligamento == "pedido_demissao")
			<td><center>{{ 'PEDIDO DE DEMISSÃO' }}</center></td>
			@endif
			<td><center>{{ date('d/m/Y', strtotime($dem->ultimo_dia))  }}</center></td>
			<td><center>{{ "R$ ". number_format($dem->custo_recisao,2,',','.') }}</center></td>
		  </tr>
		  @endforeach
		  <tr>
	  		<td><center><b>QUANTIDADE MP's:</b></center></td>
			<td><center><b>{{ $a }}</b></center></td>
			<td><center><b>TOTAL DE CUSTOS:</b></center></td>
			<td colspan="2"><center><b>{{ "R$ ". number_format($totalCustos,2,',','.') }}</b></center></td>
		  </tr>
		 </table>
		</center>
    </div>
    </section>		 
 </body>
</html>