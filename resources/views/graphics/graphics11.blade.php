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
				["Total Pago", <?php echo $total_PAGO ?>, "blue"],
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
				title: "Total Pago Plant??es:",
				width: 800,
				height: 100,
				bar: {groupWidth: "100%"},
				legend: { position: "none" },
			};
			var chart = new google.visualization.BarChart(document.getElementById("barchart_values3"));
			chart.draw(view, options);
			}
		</script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-5 rounded fixed-top">
  	    <img src="{{asset('img/Imagem1.png')}}"  height="50" class="d-inline-block align-top" alt="">
			<span class="navbar-brand mb-0 h1" style="margin-left:10px;margin-top:5px ;color: rgb(103, 101, 103) !important">
				<h4 class="d-none d-sm-block">Movimenta????o de Pessoal - RH</h4>
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
		  <td align="right">Data In??cio:</td>
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
		   <td><br><center><b>Total de MP's: {{ $qtdPla }}</b></center></td>
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
		<table class="table table-bordered" width="1000">
		<tr>
		 <td colspan="5"><b>Total de Sal??rio Por Centro de Custo - MP Plant??o Extra</b></td>
		</tr>
		<tr>
		 <td colspan="2"><b><center>Centro de Custo</center></td>
		 <td colspan="2"><b><center>Quantidade</center><b></td>
		 <td><b><center>Valor Pago</center></b></td>
		</tr>
		@foreach($plantao2 as $cc)
		<tr>
		 <td colspan="2" style="background-color: #90EE90"><center><b>{{ $cc->centro_custo_plantao }}</b></center></td>
		 <td colspan="2" style="background-color: #FFDB58"><center><b>{{ $cc->qtd }}</b></center></td>
		 <td style="background-color: #87CEFA"><center><b>{{ "R$ ". number_format($cc->soma,2,',','.') }}</b></center></td>
	 	</tr>
		 <tr id="table_descricao" disabled="true">
	  	    <td><center>N??MERO MP</center></td>
			<td><center>SETOR</center></td>
			<td><center>QUANTIDADE PLANT??O</center></td>
			<td><center>VALOR PLANT??O</center></td>
			<td><center>MOTIVO</center></td>
		 </tr>
		@foreach($plantao as $alt)
		 @if($alt->centro_custo_plantao == $cc->centro_custo_plantao)
		 
		 <tr>
		 <tbody>
			@foreach($row5 as $mps)
			 @if($mps->id == $alt->mp_id)
	  		   <td><center><a target="_blank" href="{{ route('visualizarMP', $alt->mp_id) }}" class="btn btn-info btn-sm"> {{ $mps->numeroMP }} </a></center></td>
			 @endif
			@endforeach
			<td><center> {{ $alt->setor_plantao }} </center></td>
			<td><center> {{ $alt->quantidade_plantao }} </center></td>
			<td><center> {{ "R$ ". number_format($alt->valor_plantao,2,',','.') }} </center></td>
			<td><center> {{ $alt->motivo_plantao }} </center></td>
		 </tbody>	
		 </tr>
		 @endif
		@endforeach
		@endforeach
		</table>
		</center>
    </div>
    </section>		 
 </body>
</html>