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
        <title>MP RH</title>
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
	<p align="right"><a href="{{ url('home/visualizarMPS') }}" class="btn btn-warning btn-sm" style="margin-top: -50px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a></p>
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
                  <a type="button" href="{{ route('graphics') }}" class="btn btn-success btn-info">Gráfico Total de MP'S</a>
			      <a type="button" href="{{ route('graphics2') }}" class="btn btn-success btn-info">Gráfico Total de MP'S Por Unidade</a>
                  <br> ADMISSÃO: <br>
				  <a type="button" href="{{ route('graphics3') }}" class="btn btn-success btn-info">Gráfico Total de Salários - MP's Admissão</a>
                  <a type="button" href="{{ route('graphics6') }}" class="btn btn-success btn-info">Gráfico Total de Salário por Centro de Custo - MP's Admissão</a>
                  <a type="button" href="{{ route('graphics9') }}" class="btn btn-success btn-info">Gráfico Total de Salário por Aumento de Quadro</a>
                  <a type="button" href="{{ route('graphics8') }}" class="btn btn-success btn-info">Gráfico Total de Salário por RPA</a>
                  <br> ALTERAÇÃO FUNCIONAL: <br>
				  <a type="button" href="{{ route('graphics4') }}" class="btn btn-success btn-info">Gráfico Total de Salários - MP's Alteração Funcional</a>
                  <a type="button" href="{{ route('graphics7') }}" class="btn btn-success btn-info">Gráfico Total de Salário por Centro de Custo - MP's Alteração Funcional</a>
                  @if(Auth::user()->id == 30 || Auth::user()->id == 71)
                  <a type="button" href="{{ route('graphics13') }}" class="btn btn-success btn-info">Novo Gráfico</a>
                  @endif
                  <br> DEMISSÃO: <br>
				  <a type="button" href="{{ route('graphics5') }}" class="btn btn-success btn-info">Gráfico Total de Custo de Recisão - MP's Demissão</a>
 				  <br>ADMISSÃO HCP: <br>
                  <a type="button" href="{{ route('graphics10') }}" class="btn btn-success btn-info">Gráfico Total de Salário por Centro de Custo - Admissão HCP</a>
                  <br>PLANTÃO EXTRA:<br>
                  <a type="button" href="{{ route('graphics11') }}" class="btn btn-success btn-info">Gráfico Total de Valor Pago por Centro de Custo - Plantão Extras</a>
                  <br>TOTAL:<br>
                  <a type="button" href="{{ route('graphics12') }}" class="btn btn-success btn-info">Gráfico Total de Valores</a>
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