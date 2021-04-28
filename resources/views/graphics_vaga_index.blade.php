<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Vaga RH</title>
    </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-5 rounded fixed-top">
  	    <img src="{{asset('img/Imagem1.png')}}"  height="50" class="d-inline-block align-top" alt="">
			<span class="navbar-brand mb-0 h1" style="margin-left:10px;margin-top:5px ;color: rgb(103, 101, 103) !important">
				<h4 class="d-none d-sm-block">Abertura de Vaga - RH</h4>
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
	<p align="right"><a href="{{ url('homeVaga/visualizarVagas') }}" class="btn btn-warning btn-sm" style="margin-top: -50px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a></p>
        <div class="row" style="margin-top: -40px;">
            <div class="col-12 text-center">
                <span><h3 style="color:#65b345; margin-bottom:0px;">Escolha uma opção:</h3></span>
            </div>
        </div>
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
		
		<table>
		 <tr>
		  <td>
			
              <div class="card-body text-center">
			   <center>
			   <table border="1" >
			    <tr>
				 <td rows="6"><img width="500px" id="img-unity" src="{{asset('img/graficos.jpg')}}" class="rounded-sm" alt="..."> </td>
				 <td align="center">
                  <a type="button" href="{{ route('graphicsVaga') }}" class="btn btn-success btn-info">Gráfico Total de Vagas</a>
			      <a type="button" href="{{ route('graphicsVaga2') }}" class="btn btn-success btn-info">Gráfico Total de Vagas Por Unidade</a>
				  <a type="button" href="{{ route('graphicsVaga3') }}" class="btn btn-success btn-info">Gráfico Total de Salário das Vagas</a>
				 </td>
				</tr>
               </table>
			   </center>
              </div>
		  </td>
		 </tr>
		</table>
    </div>
    </div>
    </section>	
 </body>
</html>