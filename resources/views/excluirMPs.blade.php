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
	@if($errors->any())
      <div class="alert alert-success">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
	@endif 
	<p style="margin-left: 1170px"> <a href="{{url('homeMP')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a></p>
	<center>
	<form action="{{ route('pesquisaMPsExclusao') }}" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<table class="table table-bordeared" style="WIDTH: 1000px; border-style:solid;"> 
	 <tr>
		<td align="right"> <p style="margin-top: 10px;"> Unidade: </p> </td>
		<td> 
		 <select class="form-control" id="unidade_id" name="unidade_id">
		     <option id="unidade_id" name="unidade_id" value="0">Selecione...</option>
			 <option id="unidade_id" name="unidade_id" value="1">HCP GESTÃO</option>
			 <option id="unidade_id" name="unidade_id" value="2">HMR</option>
			 <option id="unidade_id" name="unidade_id" value="3">UPAE BELO JARDIM</option>
			 <option id="unidade_id" name="unidade_id" value="4">UPAE ARCOVERDE</option>
			 <option id="unidade_id" name="unidade_id" value="5">UPAE ARRUDA</option>
			 <option id="unidade_id" name="unidade_id" value="6">UPAE CARUARU</option>
			 <option id="unidade_id" name="unidade_id" value="7">HSS</option>
			 <option id="unidade_id" name="unidade_id" value="8">HPR</option>
			 <option id="unidade_id" name="unidade_id" value="9">UPA IGARASSU</option>
		 </select>
		</td>
		<td align="right"> 
			<select class="form-control" id="pesq2" name="pesq2">
			  <option id="pesq2" name="pesq2" value="">Selecione...</option>
			  <option id="pesq2" name="pesq2" value="funcionario">FUNCIONÁRIO</option>
			  <option id="pesq2" name="pesq2" value="numero">NÚMERO MP</option>	
			  @if(Auth::user()->funcao == "Administrador")
			  <option id="pesq2" name="pesq2" value="solicitante">SOLICITANTE</option>
			  @endif
			</select>	
		</td> 
		<td> <input class="form-control" type="text" id="pesq" name="pesq"> </td>
		<td> <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Pesquisar" id="Salvar" name="Salvar" /> </td>
	 </tr>
	</table>
	
    <table class="table table-bordeared" style="WIDTH: 1000px; border-style:solid; border-color:red;">
		 <tr>
		    <thead>
			  <tr>
			   <td colspan="4"><center><font color="red"><b>MP'S:</b></font><center></td>
			  </tr>
			  <tr>
			   <td><center>NOME DA MP</center></td>
			   <td><center>SOLICITANTE</center></td>
			   @if(Auth::user()->id == 71) 
			   <td><center>EXCLUIR</center></td>
			   @endif
			   <td><center>INATIVAR</center></td>
			   <td><center>STATUS</center></td>
			  </tr>
			 </thead>
			 <?php $qtd = sizeof($mps); ?>
			 @if($qtd > 0)
			 @foreach($mps as $mp)
			 <tbody>
			  <tr>  
			   <td><center>{{ $mp->numeroMP }}</center></td>
			   <td><center>{{ $mp->solicitante }}</center></td>   
			   @if(Auth::user()->id == 71) 
			   <td><center><a href="{{ route('excluirMP', $mp->id) }}" class="btn-danger btn">EXCLUIR</center></a></td>
			   @endif
			   <td><center><a href="{{ route('inativarMPs', $mp->id) }}" class="btn-info btn">INATIVAR</center></a></td>
			   @if($mp->concluida == 0 && $mp->aprovada == 0)
			   <td><center><font color="blue"><b>{{ 'NO FLUXO' }}</b></font></center></td>
			   @elseif($mp->concluida == 1 && $mp->aprovada == 0)
			   <td><center><font color="red"><b>{{ 'REPROVADA' }}</b></font></center></td>
			   @elseif($mp->concluida == 1 && $mp->aprovada == 1)
			   <td><center><font color="green"><b>{{ 'APROVADA' }}</b></font></center></td>
			   @endif
			  </tr>
			 </tbody>
			 @endforeach
			 @endif
		 </tr>
		 </table>
		 <table>
			<tr>
			  <td> {{ $mps->appends(['unidade_id' => isset($unidade_id) ? $unidade_id : '','pesq2' => isset($pesq2) ? $pesq2 : '', 'pesq' => isset($pesq) ? $pesq : ''])->links() }} </td>
			</tr> 
		 </table>
		 </form>
	</footer>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    </body>
</html>