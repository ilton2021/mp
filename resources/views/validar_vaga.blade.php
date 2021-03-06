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
                  <form action="{{ \Request::route('storeValidaVaga') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table class="table table-sm table-bordered" style="font-size: 12px;">
                        <?php $qtdVagas = sizeof($vagas); ?>
                        @if($qtdVagas > 0) 
                        <tr><td colspan="10"><br><b><font size="04px">VAGAS:</font></b></td></tr>
                        <tr>
                        <td><center>Selecionar <br><input onclick="habilitar('sim')" type="checkbox" id="checkAll1" name="checkAll1" /></center> </td>
                            <td><center>NÚMERO VAGA</center></td>
                            <td><center>NOME</center></td>
                            <td><center>CARGO</center></td>
                            <td><center>REMUNERAÇÃO</center></td>
                            <td><center>CENTRO DE CUSTO</center></td>
                            <td><center>FLUXO</center></td>
                            <td ><center>JUSTIFICATIVA</center></td>
                            <td ><center>VISUALIZAR</center></td>
                            @if(Auth::user()->id == 30)
                            <td><center>GESTOR:</center></td>
                            @endif
                        </tr> <?php $a = 1; ?>
                            @foreach($vagas as $vaga)
                            <tr> 
                            <td> <br><center> <input type="checkbox" id="check_<?php echo $a ?>" name="check_<?php echo $a ?>"  /> </center> </td>
                            <td title="<?php echo $vaga->numeroVaga; ?>"> <p><center> <b>{{ $vaga->numeroVaga }}</b> </center></p></td>
                            <td title="<?php echo $vaga->vaga; ?>"> <p><center> {{ substr($vaga->vaga, 0, 30) }} </center> </p>  </td>
                            <td title="<?php echo $vaga->cargo; ?>"> <p><center> {{ $vaga->cargo }} </center> </p>  </td>
                            <td> <p><center> {{ "R$ ".number_format($vaga->salario, 2,',','.') }} </center> </p>  </td>
                            <td> <br> <center> {{ $vaga->centro_custo }} </center> </td>
                            <td>
                            <center><input readonly="true" type="text" id="gestor" name="gestor" value="<?php echo substr($vaga->solicitante, 0, 8); ?>" title="<?php echo $vaga->solicitante; ?>" style="width: 60px" /></center> 
                            <?php $qtdAp = sizeof($aprovacao); for($ap = 0; $ap < $qtdAp; $ap++) { ?>
                            @if($aprovacao[$ap]->vaga_id == $vaga->id)
                            <?php $idG = $aprovacao[$ap]->gestor_anterior; ?> 
                            @foreach($gestores as $g)
                                @if($g->id == $idG) 
                                    <center><input readonly="true" type="text" id="gestor" name="gestor" value="<?php echo substr($g->nome, 0, 8); ?>" title="<?php echo $g->nome; ?>" style="width: 60px" /></center> 
                                @endif  
                            @endforeach
                            @endif 
                            <?php } ?>                
                            </td>
                            <td><br> 
                            <center>
                             <button type="button" title="<?php echo $vaga->just; ?>" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $vaga->id?>"> 
                                JUST.
                             </button> 
                            </center> 
                            </td>
                            <td> <p><center> <a href="{{ route('validarVaga', $vaga->id) }}" class="btn btn-dark btn-sm">VISUALIZAR</a> </center></p></td>
                            <input hidden type="text" id="id_vaga_<?php echo $a ?>" name="id_vaga_<?php echo $a ?>" value="<?php echo $vaga->id; ?>" /> 
                            @if(Auth::user()->id == 30)
                            <td>
                            @if($vaga->tipo_vaga == 0)
                            <center>
                            <select type="text" id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" class="form-control" style="width: 150px;"> 
                                @if($vaga->unidade_id == 1)
                                @foreach($gestores as $gestor) @if($gestor->unidade_id == 1)
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                                @endif @endforeach
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?><?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                                @elseif($vaga->unidade_id == 2)
                                @foreach($gestores as $gestor) @if($gestor->unidade_id == 2)
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                                @endif @endforeach
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?><?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="65">DIRETORIA TÉCNICA - CINTHIA KOMURO</option>  
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="59">DIRETORIA - ISABELA COUTINHO</option>   
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="174">DIRETOR FINANCEIRO - MARCOS COSTA</option>     
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                                @elseif($vaga->unidade_id == 3)
                                @foreach($gestores as $gestor) @if($gestor->unidade_id == 3)
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                                @endif @endforeach
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="165">COORDENADOR UNIDADE - ALEXANDRA AMARAL</option>
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                                @elseif($vaga->unidade_id == 4)
                                @foreach($gestores as $gestor) @if($gestor->unidade_id == 4)
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                                @endif @endforeach
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="160">COORDENADOR UNIDADE - LUIZ GONZAGA</option>
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                                @elseif($vaga->unidade_id == 5)
                                @foreach($gestores as $gestor) @if($gestor->unidade_id == 5)
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                                @endif @endforeach
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="166">COORDENADOR UNIDADE - ADRIANA BEZERRA</option>
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                                @elseif($vaga->unidade_id == 6)
                                @foreach($gestores as $gestor) @if($gestor->unidade_id == 6 && $gestor->id != 48)
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                                @endif @endforeach
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                                <option id="gestor_id_" name="gestor_id_" value="155">COORDENADOR UNIDADE - JOÃO PEIXOTO</option>
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>         
                                @elseif($vaga->unidade_id == 7)
                                @foreach($gestores as $gestor) @if($gestor->unidade_id == 7)
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                                @endif @endforeach
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                                <!--option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="60">DIRETORIA - LUCIANA MELO</option-->   
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="42">COORDENAÇÃO ADMINISTRATIVA - LUCAS QUEIROZ FERREIRA</option>
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                                @elseif($vaga->unidade_id == 8)
                                @foreach($gestores as $gestor) @if($gestor->unidade_id == 8)
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                                @endif @endforeach
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="163">DIRETORIA TÉCNICA - GUILHERME JORGE COSTA</option>
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                                @endif 
                            </select>
                            @else
                            <select type="text" id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" class="form-control"> 
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                            </select>
                            </center>	 
                            @endif
                            </td>   
                            @endif
                            <?php $a += 1; ?>
                            @endforeach
                        @endif
                        </tr>
                    </table>
                    <center>
                    <table class="table table-sm" style="height: 10px">
                        <tr>
                            <td> <a href="{{ url('homeVaga') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>  </td>
                            @if(Auth::user()->funcao == "Gestor" && Auth::user()->funcao == "Gestor Imediato")
                            <td> <center> <b>*** Para Alterar clique em Visualizar</b> </center> </td>
                            @endif
                            <td> <p align="right"> <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="APROVAR" id="Salvar" name="Salvar" /> </p> </td> 
                        </tr>
                    </table>
                    </center>
                    <input hidden type="text" id="resposta" name="resposta" value="" /> 
                    <input hidden type="text" id="data_aprovacao" name="data_aprovacao" value="" /> 
                    <input hidden type="text" id="gestor_anterior" name="gestor_anterior" value="" /> 
                    <input hidden type="text" id="vaga_id" name="vaga_id" value="" /> 
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