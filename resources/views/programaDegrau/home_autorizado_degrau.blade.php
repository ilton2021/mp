<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Programa Degrau - RH</title>
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
		  <form method="POST" action="{{ route('storeAutPD', $pd[0]->id) }}">
		  <input type="hidden" name="_token" value="{{ csrf_token() }}">
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td width="800"><center><strong><br>Autorizar Vaga Programa Degrau!!! </strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			  <td hidden><input hidden type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" class="form-control" ></td>
			  <td hidden><input hidden type="text" id="vaga_interna_id" name="vaga_interna_id" value="<?php echo $pd[0]->id; ?>" class="form-control" /></td>
			  <td hidden><input hidden type="text" id="ativo" name="ativo" value="<?php echo 1; ?>" class="form-control" /></td>
			</tr>
			</table>
		  </center>
		  <input type="hidden" id="substituicao" name="substituicao" value="0" />
		  <input type="hidden" id="gestor_anterior" name="gestor_anterior" value="" />
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td>Programa Degrau</td>
			<td>{{ $pd[0]->vaga }}</td>
		   </tr>
		   <tr>
		    <td>Próxima Etapa: </td> <?php $qtdAp = sizeof($aprovacao); ?>
			<td>
			   @if(Auth::user()->name == "CAMILA FERNANDES")
			     <select type="text" id="gestor_id" name="gestor_id" class="form-control"> 
			       <option id="gestor_id" name="gestor_id" value="30"> {{ 'JANAINA GLAYCE PEREIRA LIMA' }}</option>   
				 </select>
			   @endif
			   
			   @if(Auth::user()->name == "JANAINA GLAYCE PEREIRA LIMA")
			   	 @if($pd[0]->unidade_id == 2)
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	  
					   <option id="gestor_id" name="gestor_id" value="59">ISABELA CRISTINA COUTINHO DE ALBUQUERQUE NEIVA COELHO</option>
					 </select>  
				 @elseif($pd[0]->unidade_id == 3)
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	    
				       <option id="gestor_id" name="gestor_id" value="5">ALEXANDRA SILVESTRE AMARAL PEIXOTO</option> 
					 </select>  
				 @elseif($pd[0]->unidade_id == 4)
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	    
				       <option id="gestor_id" name="gestor_id" value="160">LUIZ GONZAGA JUNIOR</option> 
					 </select>  
				 @elseif($pd[0]->unidade_id == 5)
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	    
				       <option id="gestor_id" name="gestor_id" value="167">ADRIANA CAVALCANTI BEZERRA</option> 
					 </select>  
				 @elseif($pd[0]->unidade_id == 6)
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	    
				       <option id="gestor_id" name="gestor_id" value="155">JOAO CLAUDIO FERREIRA PEIXOTO</option> 
					 </select> 
				 @elseif($pd[0]->unidade_id == 7)
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	    
				       <option id="gestor_id" name="gestor_id" value="60">LUCIANA MELO DA SILVA</option> 
					 </select>  
				 @elseif($pd[0]->unidade_id == 8)
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	    
				       <option id="gestor_id" name="gestor_id" value="61">LUCIANA VENANCIO SANTOS SOUZA</option> 
					 </select>  
				 @endif
    		   @endif

			   @if(Auth::user()->id == 59 || Auth::user()->id == 60 || Auth::user()->id == 61 || Auth::user()->id == 155 || Auth::user()->id == 160 || Auth::user()->id == 5 || Auth::user()->id == 167) 
				 <select hidden type="text" id="gestor_id" name="gestor_id" class="form-control"> 
			       <option id="gestor_id" name="gestor_id" value="30"> {{ 'JANAINA GLAYCE PEREIRA LIMA' }}</option>   
				 </select>
			   @endif
    			
			</td>
		   </tr>
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