<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Movimentação de Pessoal</title>
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style-dashboard.css')}}">
  <link href="{{ asset('js/utils.js') }}" rel="stylesheet">
  <link href="{{ asset('js/bootstrap.js') }}" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	  <br><br>
	      <center>
		  <form method="POST" action="{{ route('storeAutMP', $mp[0]->id) }}">
		  <input type="hidden" name="_token" value="{{ csrf_token() }}">
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td width="800"><center><strong><br>Autorizar MP!!! </strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			  <td hidden><input hidden type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" class="form-control" ></td>
			  <td hidden><input hidden type="text" id="mp_id" name="mp_id" value="<?php echo $mp[0]->id; ?>" class="form-control" /></td>
			  <td hidden><input hidden type="text" id="ativo" name="ativo" value="<?php echo 1; ?>" class="form-control" /></td>
			</tr>
			</table>
		  </center>
		  <input type="hidden" id="substituicao" name="substituicao" value="0" />
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td>Movimentação de Pessoal</td>
			<td>{{ $mp[0]->nome }}</td>
		   </tr>
		   @if(Auth::user()->funcao == "Superintendencia")
		    <select hidden type="text" id="gestor_id" name="gestor_id" class="form-control"> 
		      <option id="gestor_id" name="gestor_id" value="30"></option>   
		    </select>
		   @else
		   <tr>
		    <td>Próxima Etapa: </td> <?php $qtdAp = sizeof($aprovacao); ?>
			<td>
			   @if(Auth::user()->funcao != "Superintendencia" && Auth::user()->funcao != "Diretoria Tecnica" && Auth::user()->funcao != "Diretoria" && Auth::user()->funcao != "RH")
			    @foreach($gestores as $gestor)
				 @if(Auth::user()->id == 55 || Auth::user()->id == 117)
				  <select type="text" id="gestor_id" name="gestor_id" class="form-control"> 
			       <option id="gestor_id" name="gestor_id" value="30"> {{ 'JANAINA GLAYCE PEREIRA LIMA' }}</option>   
				  </select>
				 @else
				 <select type="text" id="gestor_id" name="gestor_id" class="form-control"> 
			      <option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id; ?>"> {{ $gestor->nome }}</option>   
				 </select> 
				 @endif
			 	@endforeach
			   @endif
			   
			   @if(Auth::user()->funcao == "Diretoria")
			   	 @if(!empty($aprovacao)) <?php $qtdAp = sizeof($aprovacao); ?>
				   @if($qtdAp == 0)
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	  
					   <option id="gestor_id" name="gestor_id" value="30">RH - JANAINA GLAYCE PEREIRA LIMA</option>
					 </select>  
				   @else
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	    
				       <option id="gestor_id" name="gestor_id" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option> 
					 </select>  
				   @endif
				 @endif
    		   @endif
    			
			   @if(Auth::user()->funcao == "Diretoria Tecnica")
			     @if(!empty($aprovacao)) <?php $qtdAp = sizeof($aprovacao); ?>
			      @if(Auth::user()->id == 65)
				   @if($qtdAp == 0)
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	  
					   <option id="gestor_id" name="gestor_id" value="30">RH - JANAINA GLAYCE PEREIRA LIMA</option>
					 </select>  
				   @else
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	    
					   <option id="gestor_id" name="gestor_id" value="59">DIRETORIA - ISABELA COUTINHO</option>   
    			       <option id="gestor_id" name="gestor_id" value="60">DIRETORIA - LUCIANA MELO</option> 
    			       <option id="gestor_id" name="gestor_id" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>
				       <option id="gestor_id" name="gestor_id" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option> 
					 </select>  
				   @endif
				  @elseif(Auth::user()->id == 163)
				   @if($qtdAp == 0)
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	  
					   <option id="gestor_id" name="gestor_id" value="30">RH - JANAINA GLAYCE PEREIRA LIMA</option>
					 </select>  
				   @else
					 <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	     
				      <option id="gestor_id" name="gestor_id" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>
					 </select>
				  @endif
				 @elseif(Auth::user()->id == 93)
				    <select type="text" id="gestor_id" name="gestor_id" class="form-control">  	  
					   <option id="gestor_id" name="gestor_id" value="30">RH - JANAINA GLAYCE PEREIRA LIMA</option>
					</select>  
				 @endif
			   @endif
			  @endif
			   
			   @if(Auth::user()->funcao == "RH")
				 @if($mp[0]->tipo_mp == 0)
				 <select type="text" id="gestor_id" name="gestor_id" class="form-control"> 
				  @foreach($gestoresUnd as $gestor)
				   <option id="gestor_id" name="gestor_id" value="<?php echo $gestor->id; ?>"> {{ $gestor->nome }}</option>   
				  @endforeach
				  <option id="gestor_id" name="gestor_id" value="65">DIRETORIA TÉCNICA - CINTHIA KOMURO</option>  
				  <option id="gestor_id" name="gestor_id" value="163">DIRETORIA TÉCNICA - GUILHERME JORGE COSTA</option>
				  <option id="gestor_id" name="gestor_id" value="12">ANALICE MARIA DE MENDONCA FERNANDES SILVA</option>
				  @if($mp[0]->unidade_id == 3)
				  <option id="gestor_id" name="gestor_id" value="165">COORDENADOR UNIDADE - ALEXANDRA AMARAL</option>	
				  @elseif($mp[0]->unidade_id == 4)
				  <option id="gestor_id" name="gestor_id" value="160">COORDENADOR UNIDADE - LUIZ GONZAGA</option>
				  @elseif($mp[0]->unidade_id == 5)
				  <option id="gestor_id" name="gestor_id" value="166">COORDENADOR UNIDADE - ADRIANA BEZERRA</option>	
				  @elseif($mp[0]->unidade_id == 6)
				  <option id="gestor_id" name="gestor_id" value="155">COORDENADOR UNIDADE - JOÃO PEIXOTO</option>
				  @endif
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