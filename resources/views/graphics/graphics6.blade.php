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
		@if(Auth::user()->id == 62 || Auth::user()->id == 30 || Auth::user()->id == 71 || Auth::user()->id == 13)
		<center>
	    <form action="{{\Request::route('pesquisarGrafico6')}}" method="post">
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
		   <td colspan="9"><br><center><b>Total de MP's: {{ $qtdAd }}</b></center></td>
		 </tr>
		</table>
		</form>
		</center>
		@endif
		<table class="table table-bordered" width="1000">
		<tr>
		 <td colspan="4"><b>Total de Salário por Centro de Custo - MP Admissão</b></td>
		 <td align="center"><a id="imprimir" width="80px" name="imprimir" type="button" class="btn btn-info btn-sm" style="color: #FFFFFF;"> Imprimir <i class="fas fa-box"></i> </a> </td>
		</tr>
		<tr>
		 <td colspan="2"><b><center>Centro de Custo</center></td>
		 <td colspan="2"><b><center>Quantidade</center><b></td>
		 <td><b><center>Salário</center></b></td>
		</tr>
		@foreach($centro_custo as $cc)
		<tr>
		 <td colspan="2" style="background-color: #90EE90"><center><b>{{ $cc->centro_custo }}</b></center></td>
		 <td colspan="2" style="background-color: #FFDB58"><center><b>{{ $cc->qtd }}</b></center></td>
		 <td style="background-color: #87CEFA"><center><b>{{ "R$ ". number_format($cc->soma,2,',','.') }}</b></center></td>
	 	</tr>
		 <tr id="table_descricao" disabled="true">
	  	    <td><center>NÚMERO MP</center></td>
			<td><center>CARGO</center></td>
			<td><center>SALÁRIO</center></td>
			<td><center>OUTRAS VERBAS</center></td>
			<td><center>MOTIVO</center></td>
		 </tr>
		@foreach($admissao as $adm)
		 @if($adm->centro_custo == $cc->centro_custo)	 
		 <tr>
		 <tbody>
			@foreach($row5 as $mps)
			 @if($mps->id == $adm->mp_id)
	  		   <td><center> {{ $mps->numeroMP }} </center></td>
			 @endif
			@endforeach
			<td><center> {{ $adm->cargo }} </center></td>
			<td><center> {{ "R$ ". number_format($adm->salario,2,',','.') }} </center></td>
			<td><center> {{ "R$ ". number_format($adm->outras_verbas,2,',','.') }} </center></td>
			@if($adm->motivo == "substituicao_definitiva")
			<td><center> {{ 'Substituição Definitiva' }} </center></td>
			@elseif($adm->motivo == "substituicao_temporaria")
			<td><center> {{ 'Substituição Temporária' }} </center></td>
			@elseif($adm->motivo == "aumento_quadro")
			<td><center> {{ 'Aumento de Quadro' }} </center></td>
			@elseif($adm->motivo == "segundo_vinculo")
			<td><center> {{ 'Segundo Vínculo' }} </center></td>
			@endif
		 </tbody>	
		 </tr>
		 @endif
		@endforeach
		@endforeach
		</table>	
      </div>
    </section>		 
 </body>
</html>