<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Movimentação de Pessoal - Validação</title>
  <link rel="stylesheet" href="{{ asset('css/appValidar.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-2 mb-2 rounded fixed-top">
  	    <img src="{{asset('img/Imagem1.png')}}"  height="50" class="d-inline-block align-top" alt="">
			<span class="navbar-brand mb-0 h1" style="margin-left:10px;margin-top:5px ;color: rgb(103, 101, 103) !important">
				<h4 class="d-none d-sm-block">Movimentação de Pessoal - RH</h4>
			</span>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">  </ul>

        <ul class="navbar-nav ml-auto">
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('telaLogin') }}">{{ __('Logar') }}</a>
            </li>
          @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('telaRegistro') }}">{{ __('Cadastrar Usuário') }}</a>
            </li>
          @endif
          @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>
             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('telaReset') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form1').submit();">
                  {{ __('Trocar Senha') }}
              </a>
              <form id="logout-form1" action="{{ route('telaReset') }}" method="GET" style="display: none;"> </form>
            	<a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form2').submit();">
                  {{ __('Sair') }}
              </a>
              <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
              </form>
             </div>
            </li>
          @endguest
        </ul>
      </div>
    </nav>
  <div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-7">
            <div class="card b-0">
                @if ($errors->any())
                  <div class="alert alert-success">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                  </div>
                @endif
                <fieldset class="show">
                  <div class="form-card">
                  <form method="POST" action="{{ route('storeAutPD', $pd[0]->id) }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<center>
					<table class="table table-bordered" style="height: 10px;"> 
						<tr>
						<td width="800"><center><strong><br>Autorizar Vaga Programa Degrau!!! </strong></center></td>
						<td><center><img width="200" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
						<td hidden><input hidden type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade[0]->id; ?>" class="form-control" ></td>
						<td hidden><input hidden type="text" id="vaga_interna_id" name="vaga_interna_id" value="<?php echo $pd[0]->id; ?>" class="form-control" /></td>
						<td hidden><input hidden type="text" id="ativo" name="ativo" value="<?php echo 1; ?>" class="form-control" /></td>
						</tr>
						</table>
					</center>
					<input type="hidden" id="substituicao" name="substituicao" value="0" />
					<input type="hidden" id="gestor_anterior" name="gestor_anterior" value="" />
					<center>
					<table class="table table-bordered">
					<tr>
						<td>Programa Degrau</td>
						<td>{{ $pd[0]->vaga }}</td>
					</tr>
					<tr>
						<td>Próxima Etapa: </td> <?php $qtdAp = sizeof($aprovacao); ?>
						<td>
						@if(Auth::user()->name == "JANAINA GLAYCE PEREIRA LIMA" || Auth::user()->name == "ANA AMÉRICA OLIVEIRA DE ARRUDA")
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
							@elseif($pd[0]->unidade_id == 9)
								<select type="text" id="gestor_id" name="gestor_id" class="form-control">  	    
								<option id="gestor_id" name="gestor_id" value="183">THALYTA MARYAH DOS SANTOS</option> 
								</select>
							@endif
						@endif

						@if(Auth::user()->id == 59 || Auth::user()->id == 60 || Auth::user()->id == 61 || Auth::user()->id == 155 || Auth::user()->id == 160 || Auth::user()->id == 5 || Auth::user()->id == 167 || Auth::user()->id == 183) 
							<select hidden type="text" id="gestor_id" name="gestor_id" class="form-control"> 
							<option id="gestor_id" name="gestor_id" value="198"> {{ 'JANAINA GLAYCE PEREIRA LIMA' }}</option>   
							</select>
						@endif
							
						</td>
					</tr>
					<tr> 
						<td>Justificativa:</td>
						<td><textarea id="motivo" name="motivo" class="form-control" rows="6" value=""></textarea></td>
					</tr>
					</table>
					</center>	
					
					<center>
					<table class="table table" style="height: 8px;">
					<tr>
						<td>
						<p align="left"> <a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a> </p>
						</td>
						<td align="right">
						<input type="submit" class="btn btn-success btn-sm" value="AUTORIZAR" id="Salvar" name="Salvar" />
						</td>
						</form>
					</tr>
					</table>
					</center>
                    </form>
                  </div>
                </fieldset> 
             </div>
        </div>
    </div>
</div>
</body>
</HTML>