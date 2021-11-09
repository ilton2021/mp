<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
        <title>Programa Degrau - RH</title>
		    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
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
				<h4 class="d-none d-sm-block">Programa Degrau - RH</h4>
			</span>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>

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

                                    <form id="logout-form1" action="{{ route('telaReset') }}" method="GET" style="display: none;">
                                        
                                    </form>
									
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
  <section id="unidades">
    	<p align="right"><a href="{{ url('/homeMP') }}" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a></p>
        <div class="row">
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
		@if ($errors->any())
        <div class="alert alert-success">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif	
        <div class="container d-flex justify-content-between" style="margin-left: -10px;">
         <div class="row"> 
         <form action="{{ \Request::route('validarPDs') }}" method="post">
	     <input type="hidden" name="_token" value="{{ csrf_token() }}">
         @if(Auth::user()->id == 198 || Auth::user()->id == 71)
          <table class="table table-sm table-bordered" style="font-size: 12px;">
            <?php $qtdVagas = sizeof($vagas); ?>
              @if($qtdVagas > 0) 
              <tr><td colspan="12"><br><b><font size="04px">APROVAR INSCRIÇÃO:</font></b></td></tr>
              <tr>
                <td><center>UNIDADE</center></td>
                <td><center>VAGA</center></td>
                <td><center>SOLICITANTE</center></td>
                <td><center>FUNCIONÁRIO</center></td>
                <td title="UNIDADE FUNCIONÁRIO"><center>UND. FUNCIONÁRIO</center></td>
                <td><center>MATRÍCULA</center></td>
                <td><center>DATA EMISSÃO</center></td>
                <td><center>VALIDAR</center></td>
                <td><center>STATUS</center></td>
              </tr> <?php $a = 1; ?>
				@foreach($inscricao as $vaga)
              	<tr> 
                 <td> <br><center> <b>  @if($vaga->unidade_id == 1) <?php echo "HCP GESTÃO"; ?>  
                      @elseif($vaga->unidade_id == 2) <?php echo "HMR"; ?>  
                      @elseif($vaga->unidade_id == 3) <?php echo "BELO JARDIM"; ?>  
                      @elseif($vaga->unidade_id == 4) <?php echo "ARCOVERDE"; ?>  
                      @elseif($vaga->unidade_id == 5) <?php echo "ARRUDA"; ?>  
                      @elseif($vaga->unidade_id == 6) <?php echo "CARUARU"; ?>  
                      @elseif($vaga->unidade_id == 7) <?php echo "HSS"; ?>  
                      @elseif($vaga->unidade_id == 8) <?php echo "HPR"; ?>  
                      @endif </b> </center> </td>
                 <td><p><center> {{ $vaga->NomeVaga }} </center></td>
                 @foreach($gestores as $gestor)     
                  @if($gestor->id == $vaga->solicitante)
                   <td title="<?php echo $vaga->solicitante; ?>"> <p><center> {{ substr($gestor->nome, 0, 30) }} </center> </p>  </td>
                  @endif
                 @endforeach
                 <td title="<?php echo $vaga->nome_funcionario; ?>"> <p><center> {{ $vaga->nome_funcionario }} </center> </p>  </td>
                 <td> <p><center> {{ $vaga->unidade_funcionario }} </center></p></td>
                 <td> <p><center> {{ $vaga->matricula_funcionario }} </center> </p> </td>
                 <td> <p><center> {{ date('d-m-Y', strtotime($vaga->data_emissao)) }} </center> </p> </td>
                 <td> <p><center> 
                 @if($vaga->concluida == 0)
                    <a href="{{ route('inscricaoAprovarPDs', array($vaga->id,$vaga->vaga_interna_id)) }}" class="btn btn-info btn-sm">VALIDAR</a> 
                 @endif
                 </center></p></td>
                 <td> <p><center>  
                 @if($vaga->concluida == 1 && $vaga->aprovada == 0)
                   <a href="" class="btn btn-danger btn-sm">REPROVADO</a>
                 @elseif($vaga->concluida == 1 && $vaga->aprovada == 1)
                   <a href="" class="btn btn-success btn-sm">APROVADO</a>
                 @endif
                 </center> </td>
                @endforeach
               @endif
               </tr>
          </table>
          @endif
          <table style="width: 1340px;">
            <tr>
              <td> <a href="{{ route('inscricaoPD') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>  </td>
            </tr>    
          </table>
          <input hidden type="text" id="resposta" name="resposta" value="" /> 
          <input hidden type="text" id="data_aprovacao" name="data_aprovacao" value="" /> 
          <input hidden type="text" id="gestor_anterior" name="gestor_anterior" value="" /> 
          <input hidden type="text" id="mp_id" name="mp_id" value="" /> 
          <input hidden type="text" id="unidade_id" name="unidade_id" value="" /> 
          <input hidden type="text" id="motivo" name="motivo" value="" /> 
          <input hidden type="text" id="ativo" name="ativo" value="" /> 
          </form>
		 </div>
		</div>
    </div>
    </div>
    </section >
    </footer>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    </body>
</html>