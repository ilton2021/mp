<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
        <title>MP RH</title>
		    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
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
                <?php $qtdPla = sizeof($plantao);  
                for($d = 1; $d <= $qtdPla; $d++){ ?>
                    if(status == true){ 
                        document.getElementById('check4_<?php echo $d ?>').checked = true;
                    } else {
                        document.getElementById('check4_<?php echo $d ?>').checked = false;
                    }
                <?php } ?>
            }

            function habilitar5(valor) {
		        var status = document.getElementById('checkAll5').checked;  
                <?php $qtdAdmHCP = sizeof($admissaoHCP);  
                for($d = 1; $d <= $qtdAdmHCP; $d++){ ?>
                    if(status == true){ 
                        document.getElementById('check5_<?php echo $d ?>').checked = true;
                    } else {
                        document.getElementById('check5_<?php echo $d ?>').checked = false;
                    }
                <?php } ?>
            }
        </script>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-5 rounded fixed-top">
  	    <img src="{{asset('img/Imagem1.png')}}"  height="50" class="d-inline-block align-top" alt="">
			<span class="navbar-brand mb-0 h1" style="margin-left:10px;margin-top:5px ;color: rgb(103, 101, 103) !important">
				<h4 class="d-none d-sm-block">Movimentação de Pessoal - RH</h4>
			</span>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto"></ul>
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
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif	  
		  <div class="container d-flex justify-content-between" style="margin-left: -10px;">
         <div class="row"> 
         <form action="{{ \Request::route('validarMPs') }}" method="post">
	        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <table class="table table-sm table-bordered" style="font-size: 12px;">
            <?php $qtdAdm = sizeof($admissao); ?>
              @if($qtdAdm > 0) 
              <tr><td colspan="12"><br><b><font size="04px">ADMISSÃO:</font></b></td></tr>
              <tr>
              <td><center>SELECIONAR <br><input onclick="habilitar('sim')" type="checkbox" id="checkAll1" name="checkAll1" /></center> </td>
                <td><center>UNIDADE</center></td>
                <td><center>NÚMERO MP</center></td>
                <td><center>NOME</center></td>
                <td><center>CARGO</center></td>
                <td><center>REMUNERAÇÃO</center></td>
                <td><center>TIPO</center></td>
                <td><center>MOTIVO</center></td>
                <td><center>FLUXO</center></td>
                <td ><center>JUSTIFICATIVA</center></td>
                <td ><center>VISUALIZAR</center></td>
                @if(Auth::user()->id == 30)
                <td><center>GESTOR:</center></td>
                @endif
              </tr> <?php $a = 1; ?>
				      @foreach($admissao as $adm)
              	<tr> 
                 <td> <br><center> <input type="checkbox" id="check_<?php echo $a ?>" name="check_<?php echo $a ?>"  /> </center> </td>
				         <td> <br><center> <b> @if($adm->unidade_id == 1) <?php echo "HCP GESTÃO"; ?>  
                      @elseif($adm->unidade_id == 2) <?php echo "HMR"; ?>  
                      @elseif($adm->unidade_id == 3) <?php echo "BELO JARDIM"; ?>  
                      @elseif($adm->unidade_id == 4) <?php echo "ARCOVERDE"; ?>  
                      @elseif($adm->unidade_id == 5) <?php echo "ARRUDA"; ?>  
                      @elseif($adm->unidade_id == 6) <?php echo "CARUARU"; ?>  
                      @elseif($adm->unidade_id == 7) <?php echo "HSS"; ?>  
                      @elseif($adm->unidade_id == 8) <?php echo "HPR"; ?>  
                      @endif </b> </center> </td>
                 <td title="<?php echo $adm->numeroMP; ?>"> <p><center>  {{ $adm->numeroMP }} </center></p></td> 
                 <td title="<?php echo $adm->nome; ?>"> <p><center> {{ substr($adm->nome, 0, 30) }} </center> </p>  </td>
                 <td title="<?php echo $adm->cargo; ?>"> <p><center> {{ $adm->cargo }} </center> </p>  </td>
                 <td> <p><center> {{ "R$ ".number_format($adm->salario + $adm->outras_verbas, 2,',','.') }} </center> </p>  </td>
                 <td> <p><center> <?php if($adm->tipo == "efetivo"){ ?>
                                    {{ "Efetivo" }} </center> </p>  </td>
                                  <?php }else if($adm->tipo == "rpa"){ ?>
                                    {{ "RPA" }} </center> </p>  </td>    
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
                 <td><br>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $adm->id?>"> 
                    Justificativa
                  </button> 
                  <div class="modal fade" id="exampleModal<?php echo $adm->id ?>" >
                  <div class="modal-dialog" role="document">
                  <div class='modal-content'>
                    <div class='modal-header'>
                    <h5 class='modal-title' align="left"></h5>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <div class='modal-body'>
                    <div class='panel panel-default'>
                    <div class='panel-heading'><b>Justificativa:</b> <br><br> </div>
                    <div class='panel-body'>
                      <p align="justify">{{ $adm->just }}</a>
                    </div>
                    </div>
                  </div>
                </div> </td>
                 <td> <p><center> <a href="{{ route('validarMP', $adm->mp_id) }}" target="_blank" class="btn btn-dark btn-sm">Visualizar</a> </center></p></td>
                 <input hidden type="text" id="id_mp_<?php echo $a ?>" name="id_mp_<?php echo $a ?>" value="<?php echo $adm->mp_id; ?>" /> 
                 @if(Auth::user()->id == 30)
                 <td>
                  @if($adm->tipo_mp == 0)
                  <center>
                  <select type="text" id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" class="form-control" style="width: 200px;"> 
                    @if($adm->unidade_id == 1)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 1)
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($adm->unidade_id == 2)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 2)
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?><?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="65">DIRETORIA TÉCNICA - CINTHIA KOMURO</option>  
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="174">DIRETORIA TÉCNICA - MARCOS VINICIUS COSTA SILVA</option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="59">DIRETORIA - ISABELA COUTINHO</option>   
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($adm->unidade_id == 3)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 3)
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="165">COORDENADOR UNIDADE - ALEXANDRA AMARAL</option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($adm->unidade_id == 4)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 4)
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="160">COORDENADOR UNIDADE - LUIZ GONZAGA</option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($adm->unidade_id == 5)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 5)
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="166">COORDENADOR UNIDADE - ADRIANA BEZERRA</option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($adm->unidade_id == 6)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 6 && $gestor->id != 48)
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="155">COORDENADOR UNIDADE - JOÃO PEIXOTO</option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($adm->unidade_id == 7)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 7)
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="42">DIRETORIA - LUCAS QUEIROZ FERREIRA</option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="60">DIRETORIA - LUCIANA MELO</option>   
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($adm->unidade_id == 8)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 8)
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="163">DIRETORIA TÉCNICA - GUILHERME JORGE COSTA</option>
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                    <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @endif 
                  </select>
                  @else
                  <select type="text" id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" class="form-control"> 
                      <option id="gestor_id_<?php echo $a ?>" name="gestor_id_<?php echo $a ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
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
          <table class="table table-sm table-bordered" style="font-size: 12px;">
            <?php $qtdAdmHCP = sizeof($admissaoHCP); ?>
              @if($qtdAdmHCP > 0) 
              <tr><td colspan="12"><br><b><font size="04px">ADMISSÃO HCPGESTÃO:</font></b></td></tr>
              <tr>
              <td><center>SELECIONAR <br><input onclick="habilitar5('sim')" type="checkbox" id="checkAll5" name="checkAll5" /></center> </td>
                <td><center>UNIDADE</center></td>
                <td><center>NÚMERO MP</center></td>
                <td><center>NOME</center></td>
                <td><center>TIPO</center></td>
                <td><center>MOTIVO</center></td>
                <td><center>FLUXO</center></td>
                <td ><center>JUSTIFICATIVA</center></td>
                <td ><center>VISUALIZAR</center></td>
                @if(Auth::user()->id == 30)
                <td><center>GESTOR:</center></td>
                @endif
              </tr> <?php $e = 1; ?>
				      @foreach($admissaoHCP as $admHCP)
              	<tr> 
                 <td> <br><center> <input type="checkbox" id="check5_<?php echo $e ?>" name="check5_<?php echo $e ?>"  /> </center> </td>
				         <td> <br><center> <b> @if($admHCP->unidade_id == 1) <?php echo "HCP GESTÃO"; ?>  @endif </b> </center> </td>
                 <td title="<?php echo $admHCP->numeroMP; ?>"> <p><center>  {{ $admHCP->numeroMP }} </center></p></td> 
                 <td title="<?php echo $admHCP->nome; ?>"> <p><center> {{ substr($admHCP->nome, 0, 30) }} </center> </p>  </td>
                 <td> <p><center> <?php if($admHCP->tipo == "efetivo"){ ?>
                                    {{ "Efetivo" }} </center> </p>  </td>
                                  <?php }else if($admHCP->tipo == "rpa"){ ?>
                                    {{ "RPA" }} </center> </p>  </td>    
                                  <?php }else if($admHCP->tipo == "estagiario"){ ?>
                                    {{ "Estagiário" }} </center> </p>  </td>
                                  <?php }else if($admHCP->tipo == "temporario"){ ?>
                                    {{ "Temporário" }} </center> </p>  </td>
                                  <?php }else if($admHCP->tipo == "aprendiz"){ ?>
                                    {{ "Aprendiz" }} </center> </p>  </td>
                                  <?php } ?>
                 <td> <p><center> <?php if($admHCP->motivo == "aumento_quadro") { ?>
                                    {{ 'Aumento de Quadro' }}  
                                  <?php } else if($admHCP->motivo == "substituicao_temporaria") { ?> 
                                    {{ 'Substituição Temporária' }}
                                  <?php } else if($admHCP->motivo == "segundo_vinculo") { ?> 
                                    {{ 'Segundo Vínculo' }}
                                  <?php } else if($admHCP->motivo == "substituicao_definitiva") { ?>
                                    {{ 'Substituição Definitiva' }}
                                  <?php } else { ?> {{ $motivo2 }}   <?php } ?> 
                        </center> </p>  </td>
                 <td> 
                 <center><input readonly="true" type="text" id="gestor" name="gestor" value="<?php echo substr($admHCP->solicitante, 0, 8); ?>" title="<?php echo $admHCP->solicitante; ?>" style="width: 60px" /></center> 
                 <?php $qtdApHCP = sizeof($aprovacaoAdmHCP); for($ap = 0; $ap < $qtdApHCP; $ap++) { ?>
                 @if($aprovacaoAdmHCP[$ap]->mp_id == $admHCP->mp_id)
                  <?php $idG = $aprovacaoAdmHCP[$ap]->gestor_anterior; ?> 
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
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $admHCP->id?>"> 
                    Justificativa
                  </button> 
                 </center>
                  <div class="modal fade" id="exampleModal<?php echo $admHCP->id ?>" >
                  <div class="modal-dialog" role="document">
                  <div class='modal-content'>
                    <div class='modal-header'>
                    <h5 class='modal-title' align="left"></h5>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <div class='modal-body'>
                    <div class='panel panel-default'>
                    <div class='panel-heading'><b>Justificativa:</b> <br><br> </div>
                    <div class='panel-body'>
                      <p align="justify">{{ $admHCP->just }}</a>
                    </div>
                    </div>
                  </div>
                </div> </td>
                 <td> <p><center> <a href="{{ route('validarMP', $admHCP->mp_id) }}" target="_blank" class="btn btn-dark btn-sm">Visualizar</a> </center></p></td>
                 <input hidden type="text" id="id_mp5_<?php echo $e ?>" name="id_mp5_<?php echo $e ?>" value="<?php echo $admHCP->mp_id; ?>" /> 
                 @if(Auth::user()->id == 61)
                 <td>
                  <center>
                  <select type="text" id="gestor_id5_<?php echo $e ?>" name="gestor_id5_<?php echo $e ?>" class="form-control" style="width: 200px;"> 
                    <option id="gestor_id5_<?php echo $e ?>" name="gestor_id5_<?php echo $e ?>" value="30">RH - ANA AMÉRICA OLIVEIRA DE ARRUDA</option>   
                  </select>
                  </center>	 
                 </td>   
                 @endif
                 @if(Auth::user()->id == 30)
                 <td>
                  <center>
                  <select type="text" id="gestor_id5_<?php echo $e ?>" name="gestor_id5_<?php echo $e ?>" class="form-control" style="width: 200px;"> 
                    <option id="gestor_id5_<?php echo $e ?>" name="gestor_id5_<?php echo $e ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                  </select>
                 </td>   
                 @endif
                 <?php $e += 1; ?>
                @endforeach
               @endif
               </tr>
          </table>
          <table class="table table-responsive table-bordered" style="font-size: 12px; width: 1344px;"> 
			    <?php $qtdDem = sizeof($demissao); ?>
              @if($qtdDem > 0)	
               <tr><td colspan="10"><br><b><font size="04">DEMISSÃO:</font></b></td></tr>
                <tr>
                <td><center>Selecionar <br><input onclick="habilitar2('sim')" type="checkbox" id="checkAll2" name="checkAll2" /></center> </td>
                <td><center>UNIDADE</center></td>
                <td style="width: 200px;"><center>NÚMERO MP</center></td>
                <td style="width: 300px;"><center>NOME</center></td>
                <td><center>CUSTO/RECISÃO</center></td>
                <td style="width: 300px;"><center>TIPO</center></td>
                <td style="width: 200px;"><center>AVISO PRÉVIO</center></td>
                <td><center>FLUXO</center></td>
                <td><center>JUSTIFICATIVA</center></td>
                <td><center></center></td>
                @if(Auth::user()->id == 30)
                <td><center>GESTOR</center></td>
                @endif
               </tr>
               <?php $b = 1; ?>
                @foreach($demissao as $dem)
               <tr>
                 <td> <br><center> <input type="checkbox" id="check2_<?php echo $b ?>" name="check2_<?php echo $b ?>" /> </center> </td>
				         <td> <br><center> <b> @if($dem->unidade_id == 1) <?php echo "HCP GESTÃO"; ?>   
                      @elseif($dem->unidade_id == 2) <?php echo "HMR"; ?>  
                      @elseif($dem->unidade_id == 3) <?php echo "BELO JARDIM"; ?>  
                      @elseif($dem->unidade_id == 4) <?php echo "ARCOVERDE"; ?>  
                      @elseif($dem->unidade_id == 5) <?php echo "ARRUDA"; ?>  
                      @elseif($dem->unidade_id == 6) <?php echo "CARUARU"; ?>  
                      @elseif($dem->unidade_id == 7) <?php echo "HSS"; ?>  
                      @elseif($dem->unidade_id == 8) <?php echo "HPR"; ?>  
                      @endif </b> </center> </td>
                 <td> <p><center> {{ $dem->numeroMP }}  </center></p> </td>
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
                 <td><br>
                 <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $dem->id?>"> 
                    Justificativa
                  </button> 
                  <div class="modal fade" id="exampleModal<?php echo $dem->id ?>" >
                  <div class="modal-dialog" role="document">
                  <div class='modal-content'>
                    <div class='modal-header'>
                    <h5 class='modal-title' align="left"></h5>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <div class='modal-body'>
                    <div class='panel panel-default'>
                    <div class='panel-heading'><b>Justificativa:</b> <br><br> </div>
                    <div class='panel-body'>
                      <p align="justify">{{ $dem->just }}</a>
                    </div>
                    </div>
                  </div>
                 </div> </td>
                 <td> <p><center> <a href="{{ route('validarMP', $dem->mp_id) }}" target="_blank" class="btn btn-dark btn-sm">Visualizar</a> </center></p> </td>
				         <td> <input hidden type="text" id="id_mp_<?php echo $b ?>" name="id_mp2_<?php echo $b ?>" value="<?php echo $dem->mp_id; ?>" />  </td>
                 @if(Auth::user()->id == 30)
                 <td>
                  @if($dem->tipo_mp == 0)
                  <center>
                  <select type="text" id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" class="form-control" style="width: 200px;"> 
                    @if($dem->unidade_id == 1)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 1)
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($dem->unidade_id == 2)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 2)
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="65">DIRETORIA TÉCNICA - CINTHIA KOMURO</option>  
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="174">DIRETORIA TÉCNICA - MARCOS VINICIUS COSTA SILVA</option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="59">DIRETORIA - ISABELA COUTINHO</option>   
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($dem->unidade_id == 3)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 3)
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="165">COORDENADOR UNIDADE - ALEXANDRA AMARAL</option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($dem->unidade_id == 4)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 4)
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="160">COORDENADOR UNIDADE - LUIZ GONZAGA</option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($dem->unidade_id == 5)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 5)
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="166">COORDENADOR UNIDADE - ADRIANA BEZERRA</option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($dem->unidade_id == 6)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 6 && $gestor->id != 48)
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="155">COORDENADOR UNIDADE - JOÃO PEIXOTO</option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($dem->unidade_id == 7)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 7)
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="42">DIRETORIA - LUCAS QUEIROZ FERREIRA</option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="60">DIRETORIA - LUCIANA MELO</option>   
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($dem->unidade_id == 8)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 8)
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="163">DIRETORIA TÉCNICA - GUILHERME JORGE COSTA</option>
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                    <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @endif 
                  </select>
                  @else
                  <select type="text" id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" class="form-control"> 
                      <option id="gestor_id2_<?php echo $b ?>" name="gestor_id2_<?php echo $b ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                  </select>
                  </center>	 
                  @endif
                 </td>   
                 @endif
				        </tr>
                <?php $b += 1; ?>
                @endforeach
              @endif
          </table>                          
          <table class="table table-responsive table-bordered" style="font-size: 12px; width: 1344px;">  
          <?php $qtdAlt = sizeof($alteracF); ?>
              @if($qtdAlt > 0)
               <tr><td colspan="10"><br><b><font size="04">ALTERAÇÃO FUNCIONAL:</font></b></td></tr>
                <tr>
                <td><center> Selecionar <br><input onclick="habilitar3('sim')" type="checkbox" id="checkAll3" name="checkAll3" /></center> </td>
                <td><center>UNIDADE</center></td>
                <td style="width: 180px;"><center>NÚMERO MP</center></td>
                <td style="width: 250px;"><center>NOME</center></td>
                <td style="width: 180px;"><center>CARGO</center></td>
                <td><center>ALTERAÇÃO REMUNERAÇÃO</center></td>
                <td><center>REMUNERAÇÃO</center></td>
                <td style="width: 100px;"><center>MOTIVO</center></td>
                <td><center>FLUXO</center></td>
                <td><center>JUSTIFICATIVA</center></td>
                <td><center></center></td>
                @if(Auth::user()->id == 30)
                <td><center>GESTOR</center></td>
                @endif
               </tr> <?php $c = 1; ?>
                @foreach($alteracF as $altF)
                <tr>
                 <td> <br><center> <input type="checkbox" id="check3_<?php echo $c ?>" name="check3_<?php echo $c ?>"  /> </center> </td>
				         <td> <br><center> <b>  @if($altF->unidade_id == 1) <?php echo "HCP GESTÃO"; ?>  
                      @elseif($altF->unidade_id == 2) <?php echo "HMR"; ?>  
                      @elseif($altF->unidade_id == 3) <?php echo "UPAE BELO JARDIM"; ?>  
                      @elseif($altF->unidade_id == 4) <?php echo "UPAE ARCOVERDE"; ?>  
                      @elseif($altF->unidade_id == 5) <?php echo "UPAE ARRUDA"; ?>  
                      @elseif($altF->unidade_id == 6) <?php echo "UPAE CARUARU"; ?>  
                      @elseif($altF->unidade_id == 7) <?php echo "HSS"; ?>  
                      @elseif($altF->unidade_id == 8) <?php echo "HPR"; ?>  
                      @endif </b> </center> </td>
                 <td title="<?php echo $altF->numeroMP; ?>"> <p><center> {{ $altF->numeroMP }}  </center> </p> </td>
                 <td title="<?php echo $altF->nome; ?>"> <p><center> {{ $altF->nome }} </center> </p> </td>
                 <td title="<?php echo $altF->cargo_novo; ?>"> <p><center> {{ $altF->cargo_novo }} </center> </p>  </td>
                 <td> <p><center> <?php if($altF->salario_atual == $altF->salario_novo){ ?>
                                    {{ "NÃO" }} </center> </p>  </td>
                                  <?php }else if($altF->salario_atual != $altF->salario_novo){ ?>
                                    {{ "SIM" }} </center> </p>  </td>    
                                  <?php } ?>
                 <td> <p><center> {{ "R$ ".number_format($altF->salario_novo, 2,',','.') }} </center> </p>  </td>
                 <td> <p><center> <?php if($altF->motivo == "promocao"){ ?>
                                    {{ "Promoção" }} </center> </p>  </td>
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
                 <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $altF->id?>"> 
                    Justificativa
                  </button> 
                  <div class="modal fade" id="exampleModal<?php echo $altF->id ?>" >
                  <div class="modal-dialog" role="document">
                  <div class='modal-content'>
                    <div class='modal-header'>
                    <h5 class='modal-title' align="left"></h5>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <div class='modal-body'>
                    <div class='panel panel-default'>
                    <div class='panel-heading'><b>Justificativa:</b> <br><br> </div>
                    <div class='panel-body'>
                      <p align="justify">{{ $altF->just }}</a>
                    </div>
                    </div>
                  </div>
                 </div> </td>
                 <td> <p><center> <a href="{{ route('validarMP', $altF->mp_id) }}" target="_blank" class="btn btn-dark btn-sm">Visualizar</a> </center></p>
                 <input hidden type="text" id="id_mp_<?php echo $c ?>" name="id_mp3_<?php echo $c ?>" value="<?php echo $altF->mp_id; ?>" /> </td>
				         @if(Auth::user()->id == 30)
                 <td>
                  @if($altF->tipo_mp == 0)
                  <center>
                  <select type="text" id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" class="form-control" style="width: 200px;"> 
                    @if($altF->unidade_id == 1)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 1)
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($altF->unidade_id == 2)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 2)
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="65">DIRETORIA TÉCNICA - CINTHIA KOMURO</option>  
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="174">DIRETORIA TÉCNICA - MARCOS VINICIUS COSTA SILVA</option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="59">DIRETORIA - ISABELA COUTINHO</option>   
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($altF->unidade_id == 3)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 3)
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="165">COORDENADOR UNIDADE - ALEXANDRA AMARAL</option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($altF->unidade_id == 4)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 4)
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="160">COORDENADOR UNIDADE - LUIZ GONZAGA</option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($altF->unidade_id == 5)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 5)
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="166">COORDENADOR UNIDADE - ADRIANA BEZERRA</option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($altF->unidade_id == 6)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 6 && $gestor->id != 48)
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="155">COORDENADOR UNIDADE - JOÃO PEIXOTO</option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($altF->unidade_id == 7)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 7)
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="60">DIRETORIA - LUCIANA MELO</option>   
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($altF->unidade_id == 8)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 8)
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="163">DIRETORIA TÉCNICA - GUILHERME JORGE COSTA</option>
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                    <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @endif 
                  </select>
                  @else
                  <select type="text" id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" class="form-control"> 
                      <option id="gestor_id3_<?php echo $c ?>" name="gestor_id3_<?php echo $c ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                  </select>
                  </center>	 
                  @endif
                 </td>   
                 @endif
                 </tr> 
                 <?php $c += 1; ?>
                @endforeach
              @endif
		  </table>     
      <table class="table table-responsive table-bordered" style="font-size: 12px; width: 1344px;"> 
			    <?php $qtdPla = sizeof($plantao); ?>
              @if($qtdPla > 0)	
               <tr><td colspan="12"><br><b><font size="04">PLANTÃO EXTRA:</font></b></td></tr>
                <tr>
                <td><center>Selecionar <br><input onclick="habilitar4('sim')" type="checkbox" id="checkAll4" name="checkAll4" /></center> </td>
                <td><center>UNIDADE</center></td>
                <td style="width: 200px;"><center>NÚMERO MP</center></td>
                <td style="width: 300px;"><center>NOME</center></td>
                <td style="width: 300px;"><center>SETOR</center></td>
                <td style="width: 200px;"><center>MOTIVO</center></td>
                <td style="width: 200px;"><center>QUANTIDADE</center></td>
                <td style="width: 200px;"><center>VALOR PAGO</center></td>
                <td><center>FLUXO</center></td>
                <td><center>JUSTIFICATIVA</center></td>
                @if(Auth::user()->id == 30)
                <td><center>GESTOR</center></td>
                @endif
               </tr>
               <?php $d = 1; ?>
                @foreach($plantao as $pla)
               <tr>
                 <td> <br><center> <input type="checkbox" id="check4_<?php echo $d ?>" name="check4_<?php echo $d ?>" /> </center> </td>
				         <td> <br><center> <b> @if($pla->unidade_id == 1) <?php echo "HCP GESTÃO"; ?>   
                      @elseif($pla->unidade_id == 2) <?php echo "HMR"; ?>  
                      @elseif($pla->unidade_id == 3) <?php echo "BELO JARDIM"; ?>  
                      @elseif($pla->unidade_id == 4) <?php echo "ARCOVERDE"; ?>  
                      @elseif($pla->unidade_id == 5) <?php echo "ARRUDA"; ?>  
                      @elseif($pla->unidade_id == 6) <?php echo "CARUARU"; ?>  
                      @elseif($pla->unidade_id == 7) <?php echo "HSS"; ?>  
                      @elseif($pla->unidade_id == 8) <?php echo "HPR"; ?>  
                      @endif </b> </center> </td>
                 <td> <p><center> {{ $pla->numeroMP }}  </center></p> </td>
                 <td> <p><center> {{ $pla->nome }} </center> </p>  </td>
                 <td> <p><center> {{ $pla->setor_plantao }} </center> </p>  </td>
                 <td><br>
                 <center>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $pla->id?>"> 
                    Motivo
                  </button> 
                 </center> 
                  <div class="modal fade" id="exampleModal<?php echo $pla->id ?>" >
                  <div class="modal-dialog" role="document">
                  <div class='modal-content'>
                    <div class='modal-header'>
                    <h5 class='modal-title' align="left"></h5>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <div class='modal-body'>
                    <div class='panel panel-default'>
                    <div class='panel-heading'><b>Justificativa:</b> <br><br> </div>
                    <div class='panel-body'>
                      <p align="justify">{{ $pla->motivo_plantao }}</a>
                    </div>
                    </div>
                  </div>
                 </div> </td>
                 <td> <p><center> {{ $pla->quantidade_plantao }} </center> </p>  </td>
                 <td> <p><center> {{ "R$ ".number_format($pla->valor_pago_plantao, 2,',','.') }} </center> </p>  </td>
                 <td>
                 <input readonly="true" type="text" id="gestor" name="gestor" value="<?php echo substr($pla->solicitante, 0, 8); ?>" title="<?php echo $pla->solicitante; ?>" style="width: 70px" /> <br>
                 <?php $qtdPl = sizeof($aprovacaoPl); for($pl = 0; $pl < $qtdPl; $pl++) { ?>
                 @if($aprovacaoPl[$pl]->mp_id == $pla->mp_id)
                  <?php $idG = $aprovacaoPl[$pl]->gestor_anterior; ?> 
                  @foreach($gestores as $g)
                      @if($g->id == $idG)
                        <input readonly="true" type="text" id="gestor" name="gestor" value="<?php echo substr($g->nome, 0, 8); ?>" title="<?php echo $g->nome; ?>" style="width: 70px" /> <br>
                      @endif  
                  @endforeach
                 @endif 
                 <?php } ?> 
                 </td>       
                 <td><br>
                  <center>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal1<?php echo $pla->id?>"> 
                    Justificativa
                  </button>
                  </center> 
                  <div class="modal fade" id="exampleModal1<?php echo $pla->id ?>" >
                  <div class="modal-dialog" role="document">
                  <div class='modal-content'>
                    <div class='modal-header'>
                    <h5 class='modal-title' align="left"></h5>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <div class='modal-body'>
                    <div class='panel panel-default'>
                    <div class='panel-heading'><b>Justificativa:</b> <br><br> </div>
                    <div class='panel-body'>
                      <p align="justify">{{ $pla->just }}</a>
                    </div>
                    </div>
                  </div>
                 </div> </td>
                 <td> <p><center> <a href="{{ route('validarMP', $pla->mp_id) }}" target="_blank" class="btn btn-dark btn-sm">Visualizar</a> </center></p> </td>
				         <td> <input hidden type="text" id="id_mp_<?php echo $d ?>" name="id_mp2_<?php echo $d ?>" value="<?php echo $pla->mp_id; ?>" />  </td>
                 @if(Auth::user()->id == 30)
                 <td>
                  @if($pla->tipo_mp == 0)
                  <center>
                  <select type="text" id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" class="form-control" style="width: 200px;"> 
                    @if($pla->unidade_id == 1)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 1)
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($pla->unidade_id == 2)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 2)
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="65">DIRETORIA TÉCNICA - CINTHIA KOMURO</option>  
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="174">DIRETORIA TÉCNICA - MARCOS VINICIUS COSTA SILVA</option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="59">DIRETORIA - ISABELA COUTINHO</option>   
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($pla->unidade_id == 3)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 3)
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="165">COORDENADOR UNIDADE - ALEXANDRA AMARAL</option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($pla->unidade_id == 4)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 4)
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="160">COORDENADOR UNIDADE - LUIZ GONZAGA</option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($pla->unidade_id == 5)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 5)
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="166">COORDENADOR UNIDADE - ADRIANA BEZERRA</option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($pla->unidade_id == 6)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 6 && $gestor->id != 48)
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="155">COORDENADOR UNIDADE - JOÃO PEIXOTO</option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($pla->unidade_id == 7)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 7)
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="60">DIRETORIA - LUCIANA MELO</option>   
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @elseif($pla->unidade_id == 8)
                    @foreach($gestores as $gestor) @if($gestor->unidade_id == 8)
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="<?php echo $gestor->id; ?>"> <?php echo "GESTOR - "; ?>  {{  $gestor->nome }}</option>   
                    @endif @endforeach
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="12">GERENTE - ANALICE MARIA </option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="163">DIRETORIA TÉCNICA - GUILHERME JORGE COSTA</option>
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="61">DIRETORIA - LUCIANA VENÂNCIO</option>   
                    <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                    @endif 
                  </select>
                  @else
                  <select type="text" id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" class="form-control"> 
                      <option id="gestor_id4_<?php echo $d ?>" name="gestor_id4_<?php echo $d ?>" value="62">SUPERINTENDÊNCIA - FILIPE BITU</option>   
                  </select>
                  </center>	 
                  @endif
                 </td>   
                 @endif
				        </tr>
                <?php $d += 1; ?>
                @endforeach
              @endif
          </table>                                               
          <table style="width: 1340px;">
            <tr>
                <td> <a href="{{ url('/homeMP') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>  </td>
                @if(Auth::user()->funcao == "Gestor" && Auth::user()->funcao == "Gestor Imediato")
                <td> <center> <b>*** Para Alterar clique em Visualizar</b> </center> </td>
                @endif
                <td> <p align="right"> <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="APROVAR" id="Salvar" name="Salvar" /> </p> </td> </tr>
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