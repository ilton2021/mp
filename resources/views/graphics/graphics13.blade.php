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
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-5 rounded fixed-top">
  	    <img src="{{asset('img/Imagem1.png')}}"  height="50" class="d-inline-block align-top" alt="">
			<span class="navbar-brand mb-0 h1" style="margin-left:10px;margin-top:5px ;color: rgb(103, 101, 103) !important">
				<h4 class="d-none d-sm-block">Movimentação de Pessoal - RH</h4>
			</span>
    </nav>
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
	    <form action="{{\Request::route('pesquisarGrafico7')}}" method="post">
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
		  <td align="right">Motivo:</td>
		  <td>
			  <select id="motivo" name="motivo" class="form-control">
			    <option id="motivo" name="motivo" value="">Selecione...</option>
	  			<option id="motivo" name="motivo" value="mudanca_setor_area">Mudança de Setor/Área</option>
				<option id="motivo" name="motivo" value="transferencia_outra_unidade">Transferência de Outra Unidade</option>
				<option id="motivo" name="motivo" value="mudanca_horaria">Mudança Horária</option>
				<option id="motivo" name="motivo" value="merito">Mérito</option>
				<option id="motivo" name="motivo" value="promocao">Promoção</option>
				<option id="motivo" name="motivo" value="substituicao_temporaria">Substituição Temporária</option>
				<option id="motivo" name="motivo" value="enquadramento">Enquadramento</option>
				<option id="motivo" name="motivo" value="substituicao_demissao_voluntaria">Substituição de Demissão Voluntária</option>
				<option id="motivo" name="motivo" value="recrutamento_interno">Recrutamento Interno</option>
				<option id="motivo" name="motivo" value="aumento_quadro">Aumento de Quadro</option>
				<option id="motivo" name="motivo" value="substituicao_demissao_forcada">Substituição de Demissão Forçada</option>
			  </select>
		  </td>
		  <td>
		   <input type="submit" id="pesquisar" name="pesquisar" class="btn btn-sm btn-info" value="Pesquisar"> 
		  </td>
		 </tr>
		 <tr>
		   <td colspan="10"><br><center><b>Total de MP's: {{ $qtdMP }}</b></center></td>
		 </tr>
		</table>
		</form>
		</center>
		@endif
		<table class="table table-bordered" width="1800px">
		<tr>
		 <td colspan="7"><b>MP Alteração Funcional</b></td>
		</tr>
		@foreach($alteracaoF as $cc)
		 <tr>
		 	<td width="250px" style="background-color: #90EE90"><center>Funcionário</center></td>	
		 	<td style="background-color: #90EE90"><center>Matrícula</center></td>	
			<td style="background-color: #FFDB58"><center>Setor</center></td>
			<td style="background-color: #FFDB58"><center>Setor Proposto</center></td>
			<td style="background-color: #87CEFA"><center>Cargo</center></td>
			<td style="background-color: #87CEFA"><center>Cargo Proposto</center></td>
			<td style="background-color: #90EE90"><center>Motivo</center></td>
		 </tr>
		 <tr>
		 <tbody>
		 	@foreach($row5 as $mps)
			 @if($mps->id == $cc->mp_id)
	  		   <td title="<?php echo $mps->nome; ?>"><center><font size="2"> {{ substr($mps->nome,0,28) }} </font></center></td>
			   <td><center><font size="2"> {{ $mps->matricula }} </font></center></td>
			 @endif
			@endforeach
			<td><center><font size="2"> {{ $cc->setor }} </font></center></td>
			<td><center><font size="2"> {{ $cc->centro_custo_novo }} </font></center></td>
			<td><center><font size="2"> {{ $cc->cargo_atual }} </font></center></td>
			<td><center><font size="2"> {{ $cc->cargo_novo }} </font></center></td>
			@if($cc->motivo == "mudanca_setor_area")
			<td><center><font size="2"> {{ 'Mudança Setor Área' }} </font></center></td>
			@elseif($cc->motivo == "transferencia_outra_unidade")
			<td><center><font size="2"> {{ 'Transferência Outra Unidade' }} </font></center></td>
			@elseif($cc->motivo == "mudanca_horaria")
			<td><center><font size="2"> {{ 'Mudança Horária' }} </font></center></td>
			@elseif($cc->motivo == "merito")
			<td><center><font size="2"> {{ 'Mérito' }} </font></center></td>
			@elseif($cc->motivo == "promocao")
			<td><center><font size="2"> {{ 'Promoção' }} </font></center></td>
			@elseif($cc->motivo == "enquadramento")
			<td><center><font size="2"> {{ 'Enquadramento' }} </font></center></td>
			@elseif($cc->motivo == "substituicao_demissao_voluntaria")
			<td><center><font size="2"> {{ 'Substituição Demissão Voluntária' }} </font></center></td>
			@elseif($cc->motivo == "recrutamento_interno")
			<td><center><font size="2"> {{ 'Recrutamento Interno' }} </font></center></td>
			@elseif($cc->motivo == "aumento_quadro")
			<td><center><font size="2"> {{ 'Aumento de Quadro' }} </font></center></td>
			@elseif($cc->motivo == "substituicao_temporaria")
			<td><center><font size="2">{{ 'Substituição Temporária' }}</font></center></td>
			@elseif($cc->motivo == "substituicao_demissao_forcada")
			<td><center><font size="2"> {{ 'Substituição Demissão Forçada' }} </font></center></td>
			@endif
		 </tbody>	
		 </tr>
		@endforeach
		</table>
    </div>
    </section>		 
 </body>
</html>