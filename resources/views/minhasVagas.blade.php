<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Abertura de Vaga - RH</title>
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
		<script type="text/javascript">
			function data(valor) {
				var x = document.getElementById('pesq2'); 
				var y = x.options[x.selectedIndex].text;  
				if(y == "NÚMERO DA VAGA") {
					document.getElementById('pesq').disabled = false;
					document.getElementById('pesq').hidden = false;
					document.getElementById('status').hidden = true;
				} else if(y == "NOME DA VAGA"){
					document.getElementById('pesq').disabled = false;
					document.getElementById('pesq').hidden = false;
					document.getElementById('status').hidden = true;
				} else if(y == "CARGO"){
					document.getElementById('pesq').disabled = false;
					document.getElementById('pesq').hidden = false;
					document.getElementById('status').hidden = true;
				} else if(y == "STATUS"){
					document.getElementById('pesq').hidden = true;
					document.getElementById('status').hidden = false;
				}
			}
		</script>
    </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-5 rounded fixed-top">
  	    <img src="{{asset('img/Imagem1.png')}}"  height="50" class="d-inline-block align-top" alt="">
			<span class="navbar-brand mb-0 h1" style="margin-left:10px;margin-top:5px ;color: rgb(103, 101, 103) !important">
				<h4 class="d-none d-sm-block">Abertura de Vaga - RH</h4>
			</span>
    </nav>
	@if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
	@endif	
	<center>
	<form action="{{ route('pesquisaHistVagas') }}" method="POST">	
	<table class="table table-bordeared" style="WIDTH: 1000px;"> 
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	 <tr>
	 	<td><a href="{{url('home/visualizarMPS')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 5px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a></td>
	    <td>Escolha uma Opção:</td>
		<td> 
			<select class="form-control" id="pesq2" name="pesq2" onchange="data('sim')">
			  <option id="pesq2" name="pesq2" value="">Selecione...</option>
			  <option id="pesq2" name="pesq2" value="numeroVaga">NÚMERO DA VAGA</option>	 
			  <option id="pesq2" name="pesq2" value="nome">NOME DA VAGA</option> 
			  <option id="pesq2" name="pesq2" value="cargo">CARGO</option>
			  <option id="pesq2" name="pesq2" value="status">STATUS</option>
			</select>	
		</td> 
		<td> <input class="form-control" type="text" id="pesq" name="pesq" disabled required> </td>
		<td id="status" hidden> 
			<select id="status" name="status" class="form-control"> 
				<option id="status" name="status" value="0">{{ 'NO FLUXO' }}</option>
				<option id="status" name="status" value="1">{{ 'APROVADO' }}</option>
				<option id="status" name="status" value="2">{{ 'REPROVADO' }}</option>
			</select>
		</td>
		<td> <input type="submit" class="btn btn-info btn-sm" style="margin-top: 5px;" value="Pesquisar" id="Salvar" name="Salvar" /> </td>
	</table>
	</form>
	<center>
	<table class="table table-bordeared" style="WIDTH: 1300px; border-style:solid; border-color:yellow;">
		 <tr>
		    <thead>
			  <tr> 
			   <td colspan="6"><center><font color="blue"><b>HISTÓRICO DE VAGAS:</b></font><center></td>
			  </tr>
			  <tr>
			   <td><center>NÚMERO DA VAGA</center></td>    
			   <td><center>NOME DA VAGA</center></td>
			   <td><center>CARGO</center></td>   
			   <td><center>DATA EMISSÃO</center></td>  
			   <td><center>DATA PREVISTA</center></td>
			   <td><center>STATUS</center></td>
			  </tr>
			</thead>
			@foreach($vagas as $vaga)
			<tbody>
              <tr>
			   	<td><center><b>{{ strtoupper($vaga->numeroVaga) }}</b></center></td>   
			    <td><center><b>{{ strtoupper($vaga->vaga) }}</center></b></td>
			    <td><center><b>{{ strtoupper($vaga->cargo) }}</center></b></td>
                <td><center><b>{{ date('d/m/Y', strtotime($vaga->data_emissao)) }}</b></center></td>
                <td><center><b>{{ date('d/m/Y', strtotime($vaga->data_prevista)) }}</b></center></td> 
				<td> <center> <b>
				@if($vaga->concluida == 0)
				  {{ 'NO FLUXO' }}
				@elseif($vaga->concluida == 1 && $vaga->aprovada == 0)
				 <font color="red"> {{ 'REPROVADA' }} </font>
				@elseif($vaga->concluida == 1 && $vaga->aprovada == 1)
				 <font color="green"> {{ 'APROVADA' }} </font>
				@endif
				</b></center></td>
			  </tr> 
            </tbody>
            @endforeach
          </td>
		 </tr>
		 </table>
	    </center>
	</footer>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    </body>
</html>