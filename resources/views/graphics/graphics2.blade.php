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
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Elemento', 'Total'],
          ['HCP Gestão - <?php echo $qtd1 ?>',   <?php echo $qtd1 ?>],
          ['HMR - <?php echo $qtd2 ?>',   <?php echo $qtd2 ?>],
          ['UPAE BELO - <?php echo $qtd3 ?>', <?php echo $qtd3 ?>],
		  ['UPAE ARCO - <?php echo $qtd4 ?>',   <?php echo $qtd4 ?>],
          ['UPAE ARRUDA - <?php echo $qtd5 ?>',   <?php echo $qtd5 ?>],
          ['UPAE CARUARU - <?php echo $qtd6 ?>', <?php echo $qtd6 ?>],
		  ['HSS - <?php echo $qtd7 ?>',   <?php echo $qtd7 ?>],
          ['HPR - <?php echo $qtd8 ?>',   <?php echo $qtd8 ?>],
          ['UPA IGARASSU - <?php echo $qtd9 ?>', <?php echo $qtd9 ?>]
        ]);
        var options = {
          title: 'Total de MPs por Unidade:',
		  width: 700,
		  height: 360,
		  pieHole: 0.5,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
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
		<table style="margin-left:170px;"> 
		 <tr>
		  <td><div id="donutchart" style="width: 600px; height: 300px;"></div></td>
		 </tr>
		</table><br><br>
		<center>
		  <table class="table table-bordered" style="width: 150px;" cellspacing="0">
		   <tr>
		    <td align="center"> 
			 <a id="imprimir" name="imprimir" type="button" class="btn btn-info btn-sm" style="color: #FFFFFF;"> Imprimir <i class="fas fa-box"></i> </a>  
			</td> 
		   </tr>
		  </table>
		</center>	
	 </div>
    </section>		 
 </body>
</html>