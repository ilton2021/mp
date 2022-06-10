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
  <script type="text/javascript">
            function habilitar(valor) {
		        var status = document.getElementById('checkAll1').checked;  
                <?php $qtdVagas = sizeof($vagas);  
                for($a = 1; $a <= $qtdVagas; $a++){ ?>
                    if(status == true){ 
                        document.getElementById('check_<?php echo $a ?>').checked = true;
                    } else {
                        document.getElementById('check_<?php echo $a ?>').checked = false;
                    }
                <?php } ?>
            }
        </script>
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
                  <form action="{{ \Request::route('validarPDs') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table class="table table-sm table-bordered" style="font-size: 12px;">
                        <?php $qtdVagas = sizeof($vagas); ?>
                        @if($qtdVagas > 0) 
                        <tr><td colspan="12"><br><b><font size="04px">VAGAS:</font></b></td></tr>
                        <tr>
                            <td><center>UNIDADE</center></td>
                            <td><center>NOME</center></td>
                            <td><center>DEPARTAMENTO</center></td>
                            <td><center>CARGO</center></td>
                            <td><center>SALÁRIO</center></td>
                            <td><center>CENTRO DE CUSTO</center></td>
                            <td><center>VISUALIZAR</center></td>
                            @if(Auth::user()->id == 198 || Auth::user()->id == 71 || Auth::user()->id == 30)
                            <td><center>INSCRITOS</center></td>
                            @endif
                            <td><center>INSCRIÇÃO</center></td>
                            <td><center>VINCULAR CANDIDATO/VAGA</center></td>
                        </tr> <?php $a = 1; ?>
                            @foreach($vagas as $vaga)
                            <tr> 
                            <td> <br><center> <b>  @if($vaga->unidade_id == 1) <?php echo "HCP GESTÃO"; ?>  
                                @elseif($vaga->unidade_id == 2) <?php echo "HMR"; ?>  
                                @elseif($vaga->unidade_id == 3) <?php echo "BELO JARDIM"; ?>  
                                @elseif($vaga->unidade_id == 4) <?php echo "ARCOVERDE"; ?>  
                                @elseif($vaga->unidade_id == 5) <?php echo "ARRUDA"; ?>  
                                @elseif($vaga->unidade_id == 6) <?php echo "CARUARU"; ?>  
                                @elseif($vaga->unidade_id == 7) <?php echo "HSS"; ?>  
                                @elseif($vaga->unidade_id == 8) <?php echo "HPR"; ?> 
                                @elseif($vaga->unidade_id == 9) <?php echo "IGARASSU"; ?>  
                                @endif </b> </center> </td>
                            <td title="<?php echo $vaga->vaga; ?>"> <p><center> {{ substr($vaga->vaga, 0, 30) }} </center> </p>  </td>
                            <td title="<?php echo $vaga->departamento; ?>"> <p><center> {{ $vaga->departamento }} </center> </p>  </td>
                            <td> <p><center> {{ $vaga->cargo }} </center> </p> </td>
                            <td> <p><center> {{ "R$ ".number_format($vaga->salario, 2,',','.') }} </center> </p> </td>
                            <td> <br> <center> {{ $vaga->centro_custo }} </center> </td>
                            <td> <p><center> <a href="{{ route('visualizarVagaPD', $vaga->id) }}" class="btn btn-dark btn-sm">VISUALIZAR</a> </center></p></td>
                            
                            @if(Auth::user()->id == 198 || Auth::user()->id == 71 || Auth::user()->id == 30)
                            <td> <p><center> <a href="{{ route('inscricaoInscritosPD', $vaga->id) }}" class="btn btn-info btn-sm">INSCRITOS</a> </center></p></td>
                            @endif
                            
                            @if($vaga->concluida == 1 && $vaga->aprovada == 1 && $vaga->vinculo == "0")
                            <td> <p><center> <a href="{{ route('inscricaoPDs', $vaga->id) }}" class="btn btn-success btn-sm">INSCRIÇÃO</a> </center></p></td>  
                            @else
                            <td></td>
                            @endif
                            
                            @if((Auth::user()->id == 198 || Auth::user()->id == 71 || Auth::user()->id == 30) && ($vaga->vinculo == "0"))
                            <td> <p><center> <a href="{{ route('vincularInscritosPD', $vaga->id) }}" class="btn btn-success btn-sm">VINCULAR</a> </center></p></td>
                            @else
                            <td> <p><center> {{ $vaga->vinculo }} </center></p></td> 
                            @endif
                            
                            @endforeach
                        @endif
                        </tr>
                    </table>
                    <table class="table table-sm" style="height: 10px">
                        <tr>
                            <td align="right"> <a href="{{ url('homeProgramaDegrau') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>  </td>
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
                </fieldset> 
             </div>
        </div>
    </div>
</div>
</body>
</HTML>