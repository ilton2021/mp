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
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
  <script type="text/javascript">
            function habilitar(valor) {
		        var status = document.getElementById('checkAll1').checked;  
                <?php $qtdAdm = sizeof($admissao);  
                for($a = 1; $a <= $qtdAdm; $a++){ ?>
                    if(status == true){ 
                        document.getElementById('check_<?php echo $a ?>').checked = true;
                    } else {
                        document.getElementById('check_<?php echo $a ?>').checked = false;
                    }
                <?php } ?>
            }
            function habilitar2(valor) {
		        var status = document.getElementById('checkAll2').checked;  
                <?php $qtdDem = sizeof($demissao);  
                for($b = 1; $b <= $qtdDem; $b++){ ?>
                    if(status == true){ 
                        document.getElementById('check2_<?php echo $b ?>').checked = true;
                    } else {
                        document.getElementById('check2_<?php echo $b ?>').checked = false;
                    }
                <?php } ?>
            }
            function habilitar3(valor) {
		        var status = document.getElementById('checkAll3').checked;  
                <?php $qtdAltF = sizeof($alteracF);  
                for($c = 1; $c <= $qtdAltF; $c++){ ?>
                    if(status == true){ 
                        document.getElementById('check3_<?php echo $c ?>').checked = true;
                    } else {
                        document.getElementById('check3_<?php echo $c ?>').checked = false;
                    }
                <?php } ?>
            }
            function habilitar4(valor) {
		        var status = document.getElementById('checkAll4').checked;  
                <?php $qtdRPA = sizeof($admissaoRPA);  
                for($d = 1; $d <= $qtdRPA; $d++){ ?>
                    if(status == true){ 
                        document.getElementById('check4_<?php echo $d ?>').checked = true;
                    } else {
                        document.getElementById('check4_<?php echo $d ?>').checked = false;
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
                    <form action="{{ \Request::route('validarMPs') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!--ADMISSÃO-->
                    @if($qtdAdm > 0) 
                    <table class="table table-sm table-bordered" style="font-size: 12px;">
                      <?php $qtdAdm = sizeof($admissao); ?>
                        <tr><td colspan="12"><br><b><font size="04px">ADMISSÃO:</font></b></td></tr>
                        <tr>
                          <td><center>Selecionar <br><input onclick="habilitar('sim')" type="checkbox" id="checkAll1" name="checkAll1" /></center> </td>
                          <td><center>NÚMERO MP</center></td>
                          <td><center>NOME</center></td>
                          <td><center>CARGO</center></td>
                          <td><center>REMUNERAÇÃO</center></td>
                          <td><center>TIPO</center></td>
                          <td><center>MOTIVO</center></td>
                          <td><center>FLUXO</center></td>
                          <td><center>JUSTIFICATIVA</center></td>
                          <td><center>VISUALIZAR</center></td>
                          @if(Auth::user()->id == 30)
                          <td><center>GESTOR:</center></td>
                          @endif
                        </tr> <?php $a = 1; ?>
                        @foreach($admissao as $adm)
                          <tr> 
                          <td> <br><center> <input type="checkbox" id="check_<?php echo $a ?>" name="check_<?php echo $a ?>"  /> </center> </td>
                          <td title="<?php echo $adm->numeroMP; ?>"> <p><center><b>{{ $adm->numeroMP }}</b></center></p></td> 
                          <td title="<?php echo $adm->nome; ?>"> <p><center> {{ substr($adm->nome, 0, 30) }} </center> </p>  </td>
                          <td title="<?php echo $adm->cargo; ?>"> <p><center> {{ $adm->cargo }} </center> </p>  </td>
                          <td> <p><center> {{ "R$ ".number_format($adm->salario + $adm->outras_verbas, 2,',','.') }} </center> </p>  </td>
                          <td> <p><center> <?php if($adm->tipo == "efetivo"){ ?>
                                              {{ "Efetivo" }} </center> </p>  </td>
                                            <?php }else if($adm->tipo == "estagiario"){ ?>
                                              {{ "Estagiário" }} </center> </p>  </td>
                                            <?php }else if($adm->tipo == "temporario"){ ?>
                                              {{ "Temporário" }} </center> </p>  </td>
                                            <?php }else if($adm->tipo == "aprendiz"){ ?>
                                              {{ "Aprendiz" }} </center> </p>  </td>
                                            <?php } ?>
                          <td> <p><center> <?php if($adm->motivo == "aumento_quadro") { ?>
                                              {{ 'Aumento de Quadro' }}  
                                            <?php } else if($adm->motivo == "substituicao_temporaria") { ?> 
                                              {{ 'Substituição Temporária' }}
                                            <?php } else if($adm->motivo == "segundo_vinculo") { ?> 
                                              {{ 'Segundo Vínculo' }}
                                            <?php } else if($adm->motivo == "substituicao_definitiva") { ?>
                                              {{ 'Substituição Definitiva' }}
                                            <?php } else { ?> {{ $motivo2 }}   <?php } ?> 
                                  </center> </p>  </td>
                          <td> 
                          <center><input readonly="true" type="text" id="gestor" name="gestor" value="<?php echo substr($adm->solicitante, 0, 8); ?>" title="<?php echo $adm->solicitante; ?>" style="width: 60px" /></center> 
                          <?php $qtdAp = sizeof($aprovacaoAd); for($ap = 0; $ap < $qtdAp; $ap++) { ?>
                          @if($aprovacaoAd[$ap]->mp_id == $adm->mp_id)
                            <?php $idG = $aprovacaoAd[$ap]->gestor_anterior; ?> 
                            @foreach($gestores as $g)
                                @if($g->id == $idG) 
                                  <center><input readonly="true" type="text" id="gestor" name="gestor" value="<?php echo substr($g->nome, 0, 8); ?>" title="<?php echo $g->nome; ?>" style="width: 60px" /></center> 
                                @endif  
                            @endforeach
                          @endif 
                          <?php } ?>                
                          </td>
                          <td title="JUSTIFICATIVA"><br>
                           <center>
                            <button title="<?php echo $adm->just; ?>" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $adm->id; ?>"> 
                              JUST.
                            </button>
                          </center> 
                          </div> </td>
                          <td> <p><center> <a href="{{ route('validarMP', $adm->mp_id) }}" class="btn btn-dark btn-sm">VISUALIZAR</a> </center></p></td>
                          <input hidden type="text" id="id_mp_<?php echo $a ?>" name="id_mp_<?php echo $a ?>" value="<?php echo $adm->mp_id; ?>" /> 
                          @if(Auth::user()->id == 30)
                          <td>
                            @if($adm->tipo_mp == 0)
                            <center>
                            <select type="text" id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" class="form-control" style="width: 150px;"> 
                              @if($adm->unidade_id == 1)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 1)
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                              @elseif($adm->unidade_id == 2)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 2)
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?><?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="65">DIRETORIA TÉCNICA - CINTHIA KOMURO</option>  
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="59">DIRETORIA - ISABELA COUTINHO</option>   
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="174">DIRETOR FINANCEIRO - MARCOS COSTA</option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                              @elseif($adm->unidade_id == 3)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 3)
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="165">COORDENADOR UNIDADE - ALEXANDRA AMARAL</option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                              @elseif($adm->unidade_id == 4)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 4)
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="160">COORDENADOR UNIDADE - LUIZ GONZAGA</option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                              @elseif($adm->unidade_id == 5)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 5)
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="166">COORDENADOR UNIDADE - ADRIANA BEZERRA</option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                              @elseif($adm->unidade_id == 6)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 6 && $gestor->id != 48)
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id_" name="gestor_id_" value="155">COORDENADOR UNIDADE - JOÃO PEIXOTO</option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                              @elseif($adm->unidade_id == 7)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 7)
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="42">COORDENAÇÃO ADMINISTRATIVA - LUCAS QUEIROZ FERREIRA</option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="60">DIRETORIA - LUCIANA MELO</option>   
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>
                              @elseif($adm->unidade_id == 8)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 8)
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="163">DIRETORIA TÉCNICA - GUILHERME JORGE COSTA</option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                              @elseif($adm->unidade_id == 9)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 9)
                              @if($gestor->id != 183)
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif
                              @endif @endforeach
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="183">DIRETORIA - THALYTA SANTOS</option>   
                              <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                              @endif
                            </select>
                            @else
                            <select type="text" id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" class="form-control"> 
                                <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                            </select>
                            </center>	 
                            @endif
                          </td>   
                          @endif
                          <?php $a += 1; ?>
                          @endforeach
                        </tr>
                    </table>
                    @endif
                    <!--ADMISSÃO-->
                    <!--DEMISSÃO-->
                    @if($qtdDem > 0)	
                    <table class="table table-sm table-bordered" style="font-size: 12px;"> 
                      <?php $qtdDem = sizeof($demissao); ?>
                        <tr><td colspan="12"><br><b><font size="04">DEMISSÃO:</font></b></td></tr>
                          <tr>
                          <td><center>Selecionar <br><input onclick="habilitar2('sim')" type="checkbox" id="checkAll2" name="checkAll2" /></center> </td>
                          <td style="width: 200px;"><center>NÚMERO MP</center></td>
                          <td style="width: 300px;"><center>NOME</center></td>
                          <td><center>CUSTO/RECISÃO</center></td>
                          <td style="width: 300px;"><center>TIPO</center></td>
                          <td style="width: 200px;"><center>AVISO PRÉVIO</center></td>
                          <td><center>FLUXO</center></td>
                          <td><center>JUSTIFICATIVA</center></td>
                          <td><center>VISUALIZAR</center></td>
                          @if(Auth::user()->id == 30)
                           <td><center>GESTOR</center></td>
                          @endif
                        </tr>
                        <?php $b = 1; ?>
                          @foreach($demissao as $dem)
                        <tr>
                          <td> <br><center> <input type="checkbox" id="check2_<?php echo $b ?>" name="check2_<?php echo $b ?>" /> </center> </td>
                          <td> <p><center><b> {{ $dem->numeroMP }} </b></center></p> </td>
                          <td> <p><center> {{ $dem->nome }} </center> </p>  </td>
                          <td> <p><center> {{ "R$ ".number_format($dem->custo_recisao, 2,',','.') }} </center> </p>  </td>
                          <td> <p><center> <?php if($dem->tipo_desligamento == "termino_contrato"){ ?>
                                              {{ "Término de Contrato" }} </center> </p>  </td>
                                            <?php }else if($dem->tipo_desligamento == "extincao_antecipada"){ ?>
                                              {{ "Extinção Antecipada" }} </center> </p>  </td>    
                                            <?php }else if($dem->tipo_desligamento == "sem_justa_causa"){ ?>
                                              {{ "Sem Justa Causa" }} </center> </p>  </td>
                                            <?php }else if($dem->tipo_desligamento == "aposentadoria"){ ?>
                                              {{ "Aposentadoria" }} </center> </p>  </td>
                                            <?php }else if($dem->tipo_desligamento == "com_justa_causa"){ ?>
                                              {{ "Com Justa Causa" }} </center> </p>  </td>
                                            <?php }else if($dem->tipo_desligamento == "morte"){ ?>
                                              {{ "Morte" }} </center> </p>  </td>
                                            <?php }else if($dem->tipo_desligamento == "pedido_demissao"){ ?>
                                              {{ "Pedido Demissão" }} </center> </p>  </td>
                                            <?php } ?>
                          <td> <p><center> <?php if($dem->aviso_previo == "trabalhado") { ?>
                                              {{ "Trabalhado" }}  
                                            <?php } else if($dem->aviso_previo == "indenizado") { ?> 
                                              {{ "Indenizado" }}  
                                            <?php } else if($dem->aviso_previo == "dispensado") { ?> 
                                              {{ "Dispensado" }}  
                                            <?php } ?> 
                                  </center> </p>  </td>
                          <td>
                          <input readonly="true" type="text" id="gestor" name="gestor" value="<?php echo substr($dem->solicitante, 0, 8); ?>" title="<?php echo $dem->solicitante; ?>" style="width: 70px" /> <br>
                          <?php $qtdAp = sizeof($aprovacaoDe); for($ap = 0; $ap < $qtdAp; $ap++) { ?>
                          @if($aprovacaoDe[$ap]->mp_id == $dem->mp_id)
                            <?php $idG = $aprovacaoDe[$ap]->gestor_anterior; ?> 
                            @foreach($gestores as $g)
                                @if($g->id == $idG)
                                  <input readonly="true" type="text" id="gestor" name="gestor" value="<?php echo substr($g->nome, 0, 8); ?>" title="<?php echo $g->nome; ?>" style="width: 70px" /> <br>
                                @endif  
                            @endforeach
                          @endif 
                          <?php } ?> 
                          </td>       
                          <td title="JUSTIFICATIVA"><br>
                            <center>
                            <button type="button" title="<?php echo $dem->just; ?>" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $dem->id?>"> 
                              JUST.
                            </button> 
                            </center>
                          </div> </td>
                          <td> <p><center> <a href="{{ route('validarMP', $dem->mp_id) }}" class="btn btn-dark btn-sm">VISUALIZAR</a> </center></p> </td>
                          <td hidden> <input hidden type="text" id="id_mp_<?php echo $b ?>" name="id_mp2_<?php echo $b ?>" value="<?php echo $dem->mp_id; ?>" />  </td>
                          @if(Auth::user()->id == 30)
                          <td>
                            @if($dem->tipo_mp == 0)
                            <center>
                            <select type="text" id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" class="form-control" style="width: 150px;"> 
                             @if($dem->unidade_id == 1)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 1)
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>
                             @elseif($dem->unidade_id == 2)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 2)
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="65">DIRETORIA TÉCNICA - CINTHIA KOMURO</option>  
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="59">DIRETORIA - ISABELA COUTINHO</option>   
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">DIRETOR FINANCEIRO - MARCOS COSTA</option>   
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option> 
                             @elseif($dem->unidade_id == 3)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 3)
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="165">COORDENADOR UNIDADE - ALEXANDRA AMARAL</option>
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                             @elseif($dem->unidade_id == 4)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 4)
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="160">COORDENADOR UNIDADE - LUIZ GONZAGA</option>
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option> 
                             @elseif($dem->unidade_id == 5)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 5)
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="166">COORDENADOR UNIDADE - ADRIANA BEZERRA</option>
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                             @elseif($dem->unidade_id == 6)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 6 && $gestor->id != 48)
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id2_" name="gestor_id2_" value="155">COORDENADOR UNIDADE - JOÃO PEIXOTO</option>
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>
                             @elseif($dem->unidade_id == 7)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 7)
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <!--option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="42">COORDENAÇÃO ADMINISTRATIVA - LUCAS QUEIROZ FERREIRA</option-->
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="60">DIRETORIA - LUCIANA MELO</option>   
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                             @elseif($dem->unidade_id == 8)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 8)
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="163">DIRETORIA TÉCNICA - GUILHERME JORGE COSTA</option>
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>     
                             @elseif($dem->unidade_id == 9)
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 9)
                              @if($gestor->id != 183)
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif
                              @endif @endforeach
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="183">DIRETORIA - THALYTA SANTOS</option>   
                              <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                             @endif 
                            </select>
                            @else
                            <select type="text" id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" class="form-control"> 
                                <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                            </select>
                            </center>	 
                            @endif
                          </td>   
                          @endif
                          </tr>
                          <?php $b += 1; ?>
                          @endforeach
                    </table>
                    @endif      
                    <!--DEMISSÃO-->
                    <!--ALTERAÇÃO FUNCIONAL-->                    
                    @if($qtdAltF > 0)
                    <table class="table table-sm table-bordered" style="font-size: 12px;">  
                     <?php $qtdAlt = sizeof($alteracF); $alteracao_sal = 0; ?>
                      <tr><td colspan="12"><br><b><font size="04">ALTERAÇÃO FUNCIONAL:</font></b></td></tr>
                      <tr>
                        <td><center> Selecionar <br><input onclick="habilitar3('sim')" type="checkbox" id="checkAll3" name="checkAll3" /></center> </td>
                        <td><center>NÚMERO MP</center></td>
                        <td><center>NOME</center></td>
                        <td><center>CARGO</center></td>
                        <td><center>REMUNERAÇÃO</center></td>
                        <td><center>MOTIVO</center></td>
                        <td><center>FLUXO</center></td>
                        <td><center>JUSTIFICATIVA</center></td>
                        <td><center>VISUALIZAR</center></td>
                        @if(Auth::user()->id == 30)
                         <td><center>GESTOR</center></td>
                        @endif
                      </tr> <?php $c = 1; ?>
                      @foreach($alteracF as $altF)
                      <tr>
                        <td> <br><center> <input type="checkbox" id="check3_<?php echo $c ?>" name="check3_<?php echo $c ?>"  /> </center> </td>
                        <td title="<?php echo $altF->numeroMP; ?>"><b><p><center> {{ $altF->numeroMP }} </center></p></b></td>
                        <td title="<?php echo $altF->nome; ?>"> <p><center>{{ $altF->nome }} </center> </p> </td>
                        <td title="<?php echo $altF->cargo_novo; ?>"> <p><center> {{ substr($altF->cargo_novo, 0, 20) }} </center> </p>  </td>
                        <td title="Remuneração (Alteração Remuneração)"> <p> 
                        <center> {{ "R$ ".number_format($altF->salario_novo, 2,',','.') }} 
                          <?php if($altF->salario_atual == $altF->salario_novo && $altF->impacto_financeiro == "nao"){ ?>
                          <b>{{ "(NÃO)" }} </b> <?php $alteracao_sal = 0; ?>
                          <?php }else { ?>
                          <b>{{ "(SIM)" }} </b> <?php $alteracao_sal = 1; ?>
                          <?php } ?> 
                        </center> </p> </td>
                        <td> <p><center> <?php if($altF->motivo == "promocao"){ ?>
                                         {{ "Promoção"  }} </center> </p>  </td>
                                         <?php }else if($altF->motivo == "merito"){ ?>
                                         {{ "Mérito" }} </center> </p>  </td>    
                                         <?php }else if($altF->motivo == "mudanca_setor_area"){ ?>
                                         {{ "Mudança Setor/Área" }} </center> </p>  </td>
                                         <?php }else if($altF->motivo == "transferencia_outra_unidade"){ ?>
                                         {{ "Transferência para outra unidade" }} </center> </p>  </td>
                                         <?php }else if($altF->motivo == "substituicao_temporaria"){ ?>
                                         {{ "Substituição Temporária" }} </center> </p>  </td>
                                         <?php }else if($altF->motivo == "enquadramento"){ ?>
                                         {{ "Enquadramento" }} </center> </p>  </td>
                                         <?php }else if($altF->motivo == "mudanca_horaria"){ ?>
                                         {{ "Mudança de Horário" }} </center> </p>  </td>
                                         <?php }else if($altF->motivo == "substituicao_demissao_voluntaria"){ ?>
                                         {{ "Substituição por Demissão Voluntária" }} </center> </p>  </td>
                                         <?php }else if($altF->motivo == "recrutamento_interno"){ ?>
                                         {{ "Recrutamento Interno" }} </center> </p>  </td>
                                         <?php }else if($altF->motivo == "aumento_quadro"){ ?>
                                         {{ "Aumento de Quadro" }} </center> </p>  </td>
                                         <?php }else if($altF->motivo == "substituicao_demissao_forcada"){ ?>
                                         {{ "Substituição por Demissão Forçada" }} </center> </p>  </td>
                                         <?php } ?>
                        <td>
                          <input readonly="true" type="text" id="gestor" name="gestor" value="<?php echo substr($altF->solicitante, 0, 8); ?>" title="<?php echo $altF->solicitante; ?>" style="width: 70px" /> <br>
                           <?php $qtdAp = sizeof($aprovacaoAl); for($ap = 0; $ap < $qtdAp; $ap++) { ?>
                            @if($aprovacaoAl[$ap]->mp_id == $altF->mp_id)
                             <?php $idG = $aprovacaoAl[$ap]->gestor_anterior; ?> 
                             @foreach($gestores as $g)
                              @if($g->id == $idG)
                               <input readonly="true" type="text" id="gestor" name="gestor" value="<?php echo substr($g->nome, 0, 8); ?>" title="<?php echo $g->nome; ?>" style="width: 70px" /> <br>
                              @endif  
                             @endforeach
                            @endif 
                           <?php } ?>                      
                        </td>
                        <td><br>
                          <center><button type="button" title="<?php echo $altF->just; ?>" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $altF->id?>"> 
                           JUST.
                          </button></center>
                        </td>
                        <td> <p><center> <a href="{{ route('validarMP', $altF->mp_id) }}" class="btn btn-dark btn-sm">VISUALIZAR</a> </center></p>
                          <input hidden type="text" id="id_mp3_<?php echo $c ?>" name="id_mp3_<?php echo $c ?>" value="<?php echo $altF->mp_id; ?>" /> </td>
                          @if(Auth::user()->id == 30)
                        <td>
                          @if($altF->tipo_mp == 0)
                           <center>
                            <select type="text" id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" class="form-control" style="width: 150px;"> 
                            @if($altF->unidade_id == 1)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 1)
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>
                            @elseif($altF->unidade_id == 2)
                             @if($alteracao_sal == 1)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 2)
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="65">DIRETORIA TÉCNICA - CINTHIA KOMURO</option>  
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="59">DIRETORIA - ISABELA COUTINHO</option>   
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>
                             @else 
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="30">FINALIZAR FLUXO</option>
                             @endif
                            @elseif($altF->unidade_id == 3)
                             @if($alteracao_sal == 1) 
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 3)
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="165">COORDENADOR UNIDADE - ALEXANDRA AMARAL</option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                             @else
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="30">FINALIZAR FLUXO</option>
                             @endif
                            @elseif($altF->unidade_id == 4)
                             @if($alteracao_sal == 1) 
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 4)
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="160">COORDENADOR UNIDADE - LUIZ GONZAGA</option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>  
                             @else
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="30">FINALIZAR FLUXO</option>
                             @endif
                            @elseif($altF->unidade_id == 5)
                             @if($alteracao_sal == 1)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 5)
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="166">COORDENADOR UNIDADE - ADRIANA BEZERRA</option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                             @else
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="30">FINALIZAR FLUXO</option>
                             @endif
                            @elseif($altF->unidade_id == 6)
                             @if($alteracao_sal == 1)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 6 && $gestor->id != 48)
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id3_" name="gestor_id3_" value="155">COORDENADOR UNIDADE - JOÃO PEIXOTO</option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                             @else
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="30">FINALIZAR FLUXO</option>
                             @endif
                            @elseif($altF->unidade_id == 7)
                             @if($alteracao_sal == 1) 
                              @foreach($gestores as $gestor) @if($gestor->unidade_id == 7)
                               <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif @endforeach
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <!--option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="60">DIRETORIA - LUCIANA MELO</option-->   
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="42">COORDENAÇÃO ADMINISTRATIVA - LUCAS QUEIROZ FERREIRA </option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                             @else
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="30">FINALIZAR FLUXO</option>
                             @endif
                            @elseif($altF->unidade_id == 8)
                             @if($alteracao_sal == 1)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 8)
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="163">DIRETORIA TÉCNICA - GUILHERME JORGE COSTA</option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>    
                             @else
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="30">FINALIZAR FLUXO</option>
                             @endif
                            @elseif($altF->unidade_id == 9)
                             @if($alteracao_sal == 1)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 9)
                              @if($gestor->id != 183)
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif
                             @endif @endforeach
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="183">DIRETORIA - THALYTA SANTOS</option>   
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                             @else
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="30">FINALIZAR FLUXO</option>
                             @endif
                            @endif 
                            </select>
                          @else
                            <select type="text" id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" class="form-control"> 
                              <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                            </select>
                           </center>	 
                          @endif
                        </td>   
                        @endif
                      </tr> 
                      <?php $c += 1; ?>
                     @endforeach
                    </table>
                    @endif     
                    <!-- ALTERAÇÃO FUNCIONAL -->
                    <!-- RPA-->
                    @if($qtdRPA > 0) 
                    <table class="table table-sm table-bordered" style="font-size: 12px;">
                    <?php $qtdRPA=sizeof($admissaoRPA); ?>
                      <tr><td colspan="12"><br><b><font size="04px">ADMISSÃO RPA:</font></b></td></tr>
                      <tr>
                        <td><center>Selecionar <br><input onclick="habilitar4('sim')" type="checkbox" id="checkAll4" name="checkAll4" /></center> </td>
                        <td><center>NÚMERO MP</center></td>
                        <td><center>NOME</center></td>
                        <td><center>CARGO</center></td>
                        <td><center>REMUNERAÇÃO</center></td>
                        <td><center>MOTIVO</center></td>
                        <td><center>FLUXO</center></td>
                        <td ><center>JUSTIFICATIVA</center></td>
                        <td ><center>VISUALIZAR</center></td>
                        @if(Auth::user()->id == 30)
                         <td><center>GESTOR:</center></td>
                        @endif
                      </tr> <?php $a = 1; ?>
                      @foreach($admissaoRPA as $admRPA)
                      <tr> 
                        <td> <br><center> <input type="checkbox" id="check4_<?php echo $d ?>" name="check4_<?php echo $d ?>"  /> </center> </td>
                        <td title="<?php echo $admRPA->numeroMP; ?>"><p><center><b>{{ $admRPA->numeroMP }}</b></center></p></td> 
                        <td title="<?php echo $admRPA->nome; ?>"> <p><center> {{ substr($admRPA->nome, 0, 30) }} </center> </p>  </td>
                        <td title="<?php echo $admRPA->cargo; ?>"> <p><center> {{ $admRPA->cargo }} </center> </p>  </td>
                        <td> <p><center> {{ "R$ ".number_format($admRPA->salario + $admRPA->outras_verbas, 2,',','.') }} </center> </p>  </td>
                        <td> <p><center> <?php if($admRPA->motivo == "aumento_quadro") { ?>
                                               {{ 'Aumento de Quadro' }}  
                                         <?php } else if($admRPA->motivo == "substituicao_temporaria") { ?> 
                                               {{ 'Substituição Temporária' }}
                                         <?php } else if($admRPA->motivo == "segundo_vinculo") { ?> 
                                               {{ 'Segundo Vínculo' }}
                                         <?php } else if($admRPA->motivo == "substituicao_definitiva") { ?>
                                               {{ 'Substituição Definitiva' }}
                                         <?php } else { ?> {{ $motivo2 }}   <?php } ?> 
                                </center> </p>  
                        </td>
                        <td> 
                         <center><input readonly="true" type="text" id="gestor" name="gestor" value="<?php echo substr($admRPA->solicitante, 0, 8); ?>" title="<?php echo $admRPA->solicitante; ?>" style="width: 60px" /></center> 
                         <?php $qtdApRPA = sizeof($aprovacaoAdmRPA); for($ap = 0; $ap < $qtdApRPA; $ap++) { ?>
                         @if($aprovacaoAdmRPA[$ap]->mp_id == $admRPA->mp_id)
                         <?php $idG = $aprovacaoAdmRPA[$ap]->gestor_anterior; ?> 
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
                          <button type="button" title="<?php echo $admRPA->just; ?>" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $admRPA->id?>"> 
                            JUST.
                          </button> 
                         </center>
                        </td>
                        <td> <p><center> <a href="{{ route('validarMP', $admRPA->mp_id) }}" class="btn btn-dark btn-sm">VISUALIZAR</a> </center></p> </td>
                             <input hidden type="text" id="id_mp_<?php echo $d ?>" name="id_mp_<?php echo $d ?>" value="<?php echo $admRPA->mp_id; ?>" /> 
                             @if(Auth::user()->id == 30)
                        <td>
                         @if($admRPA->tipo_mp == 0)
                          <center>
                           <select type="text" id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" class="form-control" style="width: 150px;"> 
                            @if($admRPA->unidade_id == 1)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 1)
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                            @elseif($admRPA->unidade_id == 2)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 2)
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?><?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="65">DIRETORIA TÉCNICA - CINTHIA KOMURO</option>  
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="59">DIRETORIA - ISABELA COUTINHO</option>   
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="174">DIRETOR FINANCEIRO - MARCOS COSTA</option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                            @elseif($admRPA->unidade_id == 3)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 3)
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="165">COORDENADOR UNIDADE - ALEXANDRA AMARAL</option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                            @elseif($admRPA->unidade_id == 4)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 4)
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="160">COORDENADOR UNIDADE - LUIZ GONZAGA</option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                            @elseif($admRPA->unidade_id == 5)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 5)
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="166">COORDENADOR UNIDADE - ADRIANA BEZERRA</option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                            @elseif($admRPA->unidade_id == 6)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 6 && $gestor->id != 48)
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id4_" name="gestor_id4_" value="155">COORDENADOR UNIDADE - JOÃO PEIXOTO</option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                            @elseif($admRPA->unidade_id == 7)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 7)
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="42">COORDENAÇÃO ADMINISTRATIVA - LUCAS QUEIROZ FERREIRA</option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="60">DIRETORIA - LUCIANA MELO</option>   
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>
                            @elseif($admRPA->unidade_id == 8)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 8)
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                             @endif @endforeach
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="163">DIRETORIA TÉCNICA - GUILHERME JORGE COSTA</option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                            @elseif($admRPA->unidade_id == 9)
                             @foreach($gestores as $gestor) @if($gestor->unidade_id == 9)
                              @if($gestor->id != 183)
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                              @endif
                             @endif @endforeach
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="183">DIRETORIA - THALYTA SANTOS</option>   
                              <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                            @endif
                           </select>
                          @else
                           <select type="text" id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" class="form-control"> 
                            <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="61">SUPERINTENDÊNCIA - LUCIANA VENÂNCIO</option>   
                           </select>
                          </center>	 
                          @endif
                        </td>   
                        @endif
                      <?php $d += 1; ?>
                      @endforeach
                     </tr>
                    </table>   
                    @endif
                    <!--RPA -->
                    <table>
                     <tr>
                      <td> <a href="{{ url('/homeMP') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>  </td>
                        @if(Auth::user()->funcao == "Gestor" && Auth::user()->funcao == "Gestor Imediato")
                          <td> <center> <b>*** Para Alterar clique em Visualizar</b> </center> </td>
                        @endif
                      <td>  <input type="submit" class="btn btn-success btn-sm" value="APROVAR" id="Salvar" name="Salvar" />  </td> 
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