<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Abertura de Vaga - RH</title>
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style-dashboard.css')}}">
  <link href="{{ asset('js/utils.js') }}" rel="stylesheet">
  <link href="{{ asset('js/bootstrap.js') }}" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
	  @if (Session::has('mensagem')) 
		@if ($text == true)
		   <div class="container">
			  <div class="alert alert-danger {{ Session::get ('mensagem')['class'] }} ">
				 {{ Session::get ('mensagem')['msg'] }}
			  </div>
		   </div>
		@endif
	  @endif 
	  <br><br>
	      <center>
		  <form method="POST" action="{{ route('storeAutVaga', $vaga[0]->id) }}">
		  <input type="hidden" name="_token" value="{{ csrf_token() }}">
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td width="800"><center><strong><br>Autorizar Vaga!!! </strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			  <td hidden><input hidden type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" class="form-control" ></td>
			  <td hidden><input hidden type="text" id="vaga_id" name="vaga_id" value="<?php echo $vaga[0]->id; ?>" class="form-control" /></td>
			  <td hidden><input hidden type="text" id="ativo" name="ativo" value="<?php echo 1; ?>" class="form-control" /></td>
			</tr>
			</table>
		  </center>
		  <input type="hidden" id="substituicao" name="substituicao" value="0" />
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td>Abertura de Vaga</td>
			<td>{{ $vaga[0]->vaga }}</td>
		   </tr>
		   @if(Auth::user()->funcao == "Superintendencia")
		    <select hidden type="text" id="gestor_id" name="gestor_id" class="form-control"> 
		      <option id="gestor_id" name="gestor_id" value="30"></option>   
		    </select>
		   @else
		   <tr>
		    <td>Próxima Etapa: </td> 
			<td>
			   @if(Auth::user()->funcao != "Superintendencia" && Auth::user()->funcao != "Diretoria Tecnica" && Auth::user()->funcao != "Diretoria" && Auth::user()->funcao != "RH")
			    @foreach($gestores as $gestor)
				 <select type="text" id="gestor_id" name="gestor_id" class="form-control"> 
			      <option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id; ?>"> {{ $gestor->nome }}</option>   
				 </select> 
			 	@endforeach
			   @endif
			   
			   @if(Auth::user()->funcao == "Diretoria")
			   	 @if(!empty($aprovacao)) <?php $qtdAp = sizeof($aprovacao); ?>
				   @if($qtdAp == 0)
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	  
					   <option id="gestor_id" name="gestor_id" value="30">RH - RAFAELA GONCALVES CARAZZAI</option>
					 </select>  
				   @else
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	    
				       <option id="gestor_id" name="gestor_id" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option> 
					 </select>  
				   @endif
				 @endif
    		   @endif
    			
			   @if(Auth::user()->funcao == "Diretoria Tecnica")
			     <select type="text" id="gestor_id" name="gestor_id" class="form-control"> 
			      <option id="gestor_id" name="gestor_id" value="30">RH - RAFAELA GONCALVES CARAZZAI</option> 
			      <option id="gestor_id" name="gestor_id" value="59">DIRETORIA - ISABELA COUTINHO</option>   
			      <option id="gestor_id" name="gestor_id" value="60">DIRETORIA - LUCIANA MELO</option> 
			      <option id="gestor_id" name="gestor_id" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>
			     </select>
			   @endif
			   
			   @if(Auth::user()->funcao == "RH")
				 @if($vaga[0]->tipo_vaga == 0)
				 <select type="text" id="gestor_id" name="gestor_id" class="form-control"> 
				  @foreach($gestoresUnd as $gestor)
				   <option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id; ?>"> {{ $gestor->nome }}</option>   
				  @endforeach
				  <option id="gestor_id" name="gestor_id" value="65">DIRETORIA TÉCNICA - CINTHIA KOMURO</option>   
			      <option id="gestor_id" name="gestor_id" value="59">DIRETORIA - ISABELA COUTINHO</option>   
			      <option id="gestor_id" name="gestor_id" value="60">DIRETORIA - LUCIANA MELO</option>   
			      <option id="gestor_id" name="gestor_id" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
			      <option id="gestor_id" name="gestor_id" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
				 </select>
				 @else
				 <select type="text" id="gestor_id" name="gestor_id" class="form-control"> 
			        <option id="gestor_id" name="gestor_id" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
			     </select>	 
				 @endif
			   @endif
			</td>
		   </tr>
		   @endif
		   <tr> 
		    <td>Justificativa:</td>
			<td><textarea id="motivo" name="motivo" class="form-control" rows="8" value=""></textarea></td>
		   </tr>
		   </table>
		  </center>	
		  
		  <center>
		  <table border="0" class="table table" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td>
			<p align="left"> <a href="javascript:history.back();" class="btn btn-warning">Voltar</a>
			</td>
			<td align="right">
			 <input type="submit" class="btn btn-success btn-sm" value="AUTORIZAR" id="Salvar" name="Salvar" />
			</td>
			</form>
		   </tr>
		  </table>
		  </center>
</body>