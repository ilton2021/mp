<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
</head>
<body>

	  <div class="container px-4">
		<div class="row gx-5">
			<div class="col">
			 <div class="p-3 border bg-light">
			  <center><h5><b> Movimentação de Pessoal (MP)</b></h5></center>
			  <center><img src="{{ asset('/img/foto.jpeg') }}" width="300" height="300" /></center>
			  <center><b>Formulário de Movimentação de Pessoal </b></center>
			  <center> <a href="{{ route('inicioMP') }}" id="Selecionar" name="Selecionar" type="button" class="btn btn-info btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Selecionar </a> </center>
			 </div>
			</div>
			<div class="col">
			 <div class="p-3 border bg-light">
			 <center><h5><b>Solicitação de Abertura de Vaga</b></h5></center>
			 <center><img src="{{ asset('/img/foto2.jpeg') }}" width="300" height="300" /></center>
			 <center><b>Formulário de Solicitação de Vagas</b></center>
			 <center> <a href="{{ route('inicioVaga') }}" id="Selecionar" name="Selecionar" type="button" class="btn btn-info btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Selecionar </a> </center>
			 </div>
			</div>
			<div class="col">
			 <div class="p-3 border bg-light">
			 <center><h5><b>Programa Degrau</b></h5></center>
			 <center><img src="{{ asset('/img/programaDegrau.png') }}" width="300" height="300" /></center>
			 <center><b>Formulário de Solicitação de Inscrição</b></center>
			 <center> <a href="{{ route('inicioDegrau') }}" id="Selecionar" name="Selecionar" type="button" class="btn btn-info btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Selecionar </a> </center>
			 </div>
			</div>
		</div>
	  </div>
	  
	<script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>