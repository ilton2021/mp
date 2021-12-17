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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
	<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
         ["Elemento", "Total", { role: "style" } ],
		 ["Admissão", <?php echo $totalAdm ?>, "green"],
		 ["", <?php echo 0 ?>, "blue"],
		 ["Alteração Funcional", <?php echo $totalAlt ?>, "black"],
		 ["", <?php echo 0 ?>, "blue"],
		 ["Demissão", <?php echo $totalDem ?>, "orange"],
		 ["", <?php echo 0 ?>, "blue"],
		 ["Total1:", <?php echo $total_SAL ?>, "blue"],
		 ["", <?php echo 0 ?>, "blue"],
		 ["Total2:", <?php echo $total_DES ?>, "red"],
		 ["", <?php echo 0 ?>, "red"]
        ]);
        var view = new google.visualization.DataView(data);
		view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);
      var options = {
        title: "Total de Salários:",
        width: 800,
        height: 400,
        bar: {groupWidth: "100%"},
        legend: { position: "none" },
		series: {
            0: { axis: 'admissão' }, 
            1: { axis: 'alteração' },
			2: { axis: 'demissão' } 	
          },
          axes: {
            x: {
              distance: {label: 'parsecs'}, 
              brightness: {side: 'top', label: 'apparent magnitude'} 
            }
          }
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
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
                    <div  class="progress-bar" role="progressbar" style="width: 100%; background-color: #65b345;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-2 text-center"></div>
            <div class="col-5">
                <div class="progress" style="height: 3px;">
                    <div  class="progress-bar" role="progressbar" style="width: 100%; background-color: #65b345;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
		@if(Auth::user()->id == 62 || Auth::user()->id == 30 || Auth::user()->id == 13 || Auth::user()->id == 71)
		<center>
	    <form action="{{\Request::route('pesquisarGrafico12')}}" method="post">
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
		   <td colspan="10"><br><center><b>Total de MP's: {{ $qtdMP }}</b></center></td>
		 </tr>
		</table>
		<table style="margin-left: 250px;"> 
		 <tr>
		  <td><div id="barchart_values" style="width: 600px; height: 300px;"></div></td>
		 </tr>
		</table>
		<table class="table" style="margin-left: -250px; margin-top: -260px;">
	  	    <tr>
			 <td><font color="green"><b>Admissão (Salário + Outras Verbas)</b></font></td>
			</tr>
			<tr>
			 <td><font color="black"><b>Alteração Funcional (Salário Novo - Salário Atual)</b></font></td>
			</tr>
			<tr>
			 <td><font color="gold"><b>Demissão (Custo Recisão - Salário Bruto)</b></font></td>
		    </tr>
			<tr>
			 <td><font color="blue"><b>Total 1 (Admissão + Alteração F. + Demissão)</b></font></td>
		    </tr>
			<tr>
			 <td><font color="red"><b>Total 2 (Admissão + Alteração F. - Demissão)</b></font></td>
		    </tr>
		</table>
		</form>
		</center>
		@endif
    </div>
    </section>		 
 </body>
</html>