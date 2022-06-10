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
           function funDuvidas(valor){
              var u = document.getElementById('opcoes').value; 
              if(u == 1){
                  document.getElementById('funcCadastrarPD').hidden          = false;   
                  document.getElementById('funcVisualizarPD').hidden         = true;
                  document.getElementById('funcCadastrarCandidatoPD').hidden = true;
                  document.getElementById('funcAprovarCandidatoPD').hidden   = true;
                  document.getElementById('funcReprovarCandidatoPD').hidden  = true;
                  document.getElementById('funcVincularCandidatoPD').hidden  = true;
                  document.getElementById('funcAprovarVagaPD').hidden        = true;
                  document.getElementById('funcReprovarVagaPD').hidden       = true;
                  document.getElementById('funcCorrigirVagaPD').hidden       = true;
              } else if(u == 2){
                  document.getElementById('funcCadastrarPD').hidden          = true;   
                  document.getElementById('funcVisualizarPD').hidden         = false;
                  document.getElementById('funcCadastrarCandidatoPD').hidden = true;
                  document.getElementById('funcAprovarCandidatoPD').hidden   = true;
                  document.getElementById('funcReprovarCandidatoPD').hidden  = true;
                  document.getElementById('funcVincularCandidatoPD').hidden  = true;
                  document.getElementById('funcAprovarVagaPD').hidden        = true;
                  document.getElementById('funcReprovarVagaPD').hidden       = true;
                  document.getElementById('funcCorrigirVagaPD').hidden       = true;
              } else if(u == 3){
                  document.getElementById('funcCadastrarPD').hidden          = true;   
                  document.getElementById('funcVisualizarPD').hidden         = true;
                  document.getElementById('funcCadastrarCandidatoPD').hidden = false;
                  document.getElementById('funcAprovarCandidatoPD').hidden   = true;
                  document.getElementById('funcReprovarCandidatoPD').hidden  = true;
                  document.getElementById('funcVincularCandidatoPD').hidden  = true;
                  document.getElementById('funcAprovarVagaPD').hidden        = true;
                  document.getElementById('funcReprovarVagaPD').hidden       = true;
                  document.getElementById('funcCorrigirVagaPD').hidden       = true;
              } else if(u == 4){
                  document.getElementById('funcCadastrarPD').hidden          = true;   
                  document.getElementById('funcVisualizarPD').hidden         = true;
                  document.getElementById('funcCadastrarCandidatoPD').hidden = true;
                  document.getElementById('funcAprovarCandidatoPD').hidden   = false;
                  document.getElementById('funcReprovarCandidatoPD').hidden  = true;
                  document.getElementById('funcVincularCandidatoPD').hidden  = true;
                  document.getElementById('funcAprovarVagaPD').hidden        = true;
                  document.getElementById('funcReprovarVagaPD').hidden       = true;
                  document.getElementById('funcCorrigirVagaPD').hidden       = true;
              } else if(u == 5){
                  document.getElementById('funcCadastrarPD').hidden          = true;   
                  document.getElementById('funcVisualizarPD').hidden         = true;
                  document.getElementById('funcCadastrarCandidatoPD').hidden = true;
                  document.getElementById('funcAprovarCandidatoPD').hidden   = true;
                  document.getElementById('funcReprovarCandidatoPD').hidden  = false;
                  document.getElementById('funcVincularCandidatoPD').hidden  = true;
                  document.getElementById('funcAprovarVagaPD').hidden        = true;
                  document.getElementById('funcReprovarVagaPD').hidden       = true;
                  document.getElementById('funcCorrigirVagaPD').hidden       = true;
              } else if(u == 6){
                  document.getElementById('funcCadastrarPD').hidden          = true;   
                  document.getElementById('funcVisualizarPD').hidden         = true;
                  document.getElementById('funcCadastrarCandidatoPD').hidden = true;
                  document.getElementById('funcAprovarCandidatoPD').hidden   = true;
                  document.getElementById('funcReprovarCandidatoPD').hidden  = true;
                  document.getElementById('funcVincularCandidatoPD').hidden  = false;
                  document.getElementById('funcAprovarVagaPD').hidden        = true;
                  document.getElementById('funcReprovarVagaPD').hidden       = true;
                  document.getElementById('funcCorrigirVagaPD').hidden       = true;
              } else if(u == 7){
                  document.getElementById('funcCadastrarPD').hidden          = true;   
                  document.getElementById('funcVisualizarPD').hidden         = true;
                  document.getElementById('funcCadastrarCandidatoPD').hidden = true;
                  document.getElementById('funcAprovarCandidatoPD').hidden   = true;
                  document.getElementById('funcReprovarCandidatoPD').hidden  = true;
                  document.getElementById('funcVincularCandidatoPD').hidden  = true;
                  document.getElementById('funcAprovarVagaPD').hidden        = false;
                  document.getElementById('funcReprovarVagaPD').hidden       = true;
                  document.getElementById('funcCorrigirVagaPD').hidden       = true;
              } else if(u == 8) {
                  document.getElementById('funcCadastrarPD').hidden          = true;   
                  document.getElementById('funcVisualizarPD').hidden         = true;
                  document.getElementById('funcCadastrarCandidatoPD').hidden = true;
                  document.getElementById('funcAprovarCandidatoPD').hidden   = true;
                  document.getElementById('funcReprovarCandidatoPD').hidden  = true;
                  document.getElementById('funcVincularCandidatoPD').hidden  = true;
                  document.getElementById('funcAprovarVagaPD').hidden        = true;
                  document.getElementById('funcReprovarVagaPD').hidden       = false;
                  document.getElementById('funcCorrigirVagaPD').hidden       = true;
              } else if(u == 9) {
                  document.getElementById('funcCadastrarPD').hidden          = true;   
                  document.getElementById('funcVisualizarPD').hidden         = true;
                  document.getElementById('funcCadastrarCandidatoPD').hidden = true;
                  document.getElementById('funcAprovarCandidatoPD').hidden   = true;
                  document.getElementById('funcReprovarCandidatoPD').hidden  = true;
                  document.getElementById('funcVincularCandidatoPD').hidden  = true;
                  document.getElementById('funcAprovarVagaPD').hidden        = true;
                  document.getElementById('funcReprovarVagaPD').hidden       = true;
                  document.getElementById('funcCorrigirVagaPD').hidden       = false;
              } else {
                  document.getElementById('funcCadastrarPD').hidden          = true;   
                  document.getElementById('funcVisualizarPD').hidden         = true;
                  document.getElementById('funcCadastrarCandidatoPD').hidden = true;
                  document.getElementById('funcAprovarCandidatoPD').hidden   = true;
                  document.getElementById('funcReprovarCandidatoPD').hidden  = true;
                  document.getElementById('funcVincularCandidatoPD').hidden  = true;
                  document.getElementById('funcAprovarVagaPD').hidden        = true;
                  document.getElementById('funcReprovarVagaPD').hidden       = true;
                  document.getElementById('funcCorrigirVagaPD').hidden       = true;
              }
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
            <table class="table table-sm" style="height: 10px;">
             <thead>
              <tr>
                <td colspan="2"><center><font color="blue"><b>DÚVIDAS PROGRAMA DEGRAU:</b></font></center></td>
                <td colspan="2">
                <center>
                  <select id="opcoes" name="opcoes" class="form-control form-control-sm" style="width: 400px;" onchange="funDuvidas('sim')">
                    <option id="opcoes" name="opcoes" value="">SELECIONE..</option>
                    <option id="opcoes" name="opcoes" value="1">COMO CADASTRAR NOVA VAGA PD</option>
                    <option id="opcoes" name="opcoes" value="2">COMO VISUALIZAR VAGA PD</option>
                    <option id="opcoes" name="opcoes" value="3">COMO CADASTRAR CANDIDATO PD</option>
                    <option id="opcoes" name="opcoes" value="4">COMO VALIDAR CANDIDATO PD - APROVAR</option>
                    <option id="opcoes" name="opcoes" value="5">COMO VALIDAR CANDIDATO PD - REPROVAR</option>
                    <option id="opcoes" name="opcoes" value="6">COMO VINCULAR CANDIDATO PD</option>
                    <option id="opcoes" name="opcoes" value="7">COMO APROVAR VAGA PD</option>
                    <option id="opcoes" name="opcoes" value="8">COMO REPROVAR VAGA PD</option>
                    <option id="opcoes" name="opcoes" value="9">COMO VOLTAR VAGA PD PARA CORREÇÃO</option>
                  </select>
                </center>
                </td>
                <td> <a href="{{url('homeProgramaDegrau')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a> </td>
              </tr> 
            </table>
            <table class="table table-sm">
              <tr>
                <td id="funcCadastrarPD" hidden colspan="2">
                  <p> 
                    <font style="margin-left: 20px">PASSO 1)</font> <B>Logar</B> no sistema; <br>
                    <font style="margin-left: 20px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                    <font style="margin-left: 20px">PASSO 3)</font> Escolher a opção <B>Cadastrar Nova Vaga</B>; <br>
                    <font style="margin-left: 20px">PASSO 4)</font> Escolher a <B>Unidade</B> correspondente; <br>
                    <font style="margin-left: 20px">PASSO 5)</font> Preencher as <B>informações da Vaga do Programa Degrau</B>; <br>
                    <font style="margin-left: 20px">PASSO 6)</font> Clicar no botão <B>Concluir</B>; <br>
                    <font style="margin-left: 20px">PASSO 7)</font> Em seguida irá aparecer a tela de <B>Confirmação de Cadastro</B>.
                  </p>
                  <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/cadastrarPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
                </td>
              </tr>
              <tr>
                <td id="funcVisualizarPD" hidden colspan="2">
                  <p> 
                    <font style="margin-left: 20px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                    <font style="margin-left: 20px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                    <font style="margin-left: 20px">PASSO 3)</font> Escolher a opção <B>Visualizar Vaga</B>; <br> 
                    <font style="margin-left: 20px">PASSO 4)</font> Pesquisar: pela <B>Unidade</B>, pelo <B>Solicitante</B> ou pela <B>Data</B>; <br> 
                    <font style="margin-left: 20px">PASSO 5)</font> Clicar no botão <B>Visualizar</B>; <br>
                  </p>
                  <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/visualizarPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
                </td>
              </tr>
              <tr>
                <td id="funcCadastrarCandidatoPD" hidden colspan="2">
                  <p> 
                    <font style="margin-left: 20px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                    <font style="margin-left: 20px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                    <font style="margin-left: 20px">PASSO 3)</font> Escolher a opção <B>Inscrição Vaga</B>; <br> 
                    <font style="margin-left: 20px">PASSO 4)</font> Clicar no botão <B>Inscrição</B>; <br>
                    <font style="margin-left: 20px">PASSO 5)</font> Informar os dados do Funcionário que irá concorrer a vaga do <B>Programa Degrau</B>; <br>
                    <font style="margin-left: 20px">PASSO 6)</font> Informar o <B>Nome</B>, a <B>Matrícula</B> e a <B>Unidade</B> do Funcionário; <br>
                    <font style="margin-left: 20px">PASSO 7)</font> Em seguida irá aparecer a tela de <B>Confirmação da Inscrição</B>. <br>
                  </p>
                  <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/inscricaoCandidatoPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
                </td>
              </tr>
              <tr>
                <td id="funcVincularCandidatoPD" hidden>
                  <p>  
                    <font style="margin-left: 20px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                    <font style="margin-left: 20px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                    <font style="margin-left: 20px">PASSO 3)</font> Escolher a opção <B>Inscrição Vaga</B>; <br> 
                    <font style="margin-left: 20px">PASSO 4)</font> Clicar no botão <B>Vincular</B>; <br>
                    <font style="margin-left: 20px">PASSO 5)</font> Escolher o Funcionário que ficará com a <B>Vaga</B>; <br>
                    <font style="margin-left: 20px">PASSO 6)</font> Clicar no botão <B>Vincular</B>; <br>
                  </p>
                  <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/vincularCandidatoPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
                </td>
              </tr>
              <tr>
                <td id="funcAprovarCandidatoPD" hidden>
                  <p> 
                    <font style="margin-left: 20px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                    <font style="margin-left: 20px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                    <font style="margin-left: 20px">PASSO 3)</font> Escolher a opção <B>Inscrição Vaga</B>; <br> 
                    <font style="margin-left: 20px">PASSO 4)</font> Clicar no botão <B>Vincular</b> <br>
                    <font style="margin-left: 20px">PASSO 5)</font> Clicar no botão <B>Validar</B>; <br>
                    <font style="margin-left: 20px">PASSO 6)</font> Clicar no botão <B>Aprovar</B>; <br>
                    <font style="margin-left: 20px">PASSO 7)</font> Clicar no botão <B>Aprovar</B> novamente; <br>
                  </p>
                  <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/aprovarCandidato.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
                </td>
              </tr>
              <tr>
                <td id="funcReprovarCandidatoPD" hidden>
                  <p> 
                    <font style="margin-left: 20px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                    <font style="margin-left: 20px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                    <font style="margin-left: 20px">PASSO 3)</font> Escolher a opção <B>Inscrição Vaga</B>; <br> 
                    <font style="margin-left: 20px">PASSO 4)</font> Clicar no botão <B>Vincular</b> <br>
                    <font style="margin-left: 20px">PASSO 5)</font> Clicar no botão <B>Validar</B>; <br>
                    <font style="margin-left: 20px">PASSO 6)</font> Clicar no botão <B>Reprovar</B>; <br>
                    <font style="margin-left: 20px">PASSO 7)</font> Clicar no botão <B>Reprovar</B> novamente; <br>
                  </p>
                  <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/reprovarCandidato.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
                </td>
              </tr>
              <tr>
                <td id="funcAprovarVagaPD" hidden>
                  <p> 
                    <font style="margin-left: 20px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                    <font style="margin-left: 20px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                    <font style="margin-left: 20px">PASSO 3)</font> Escolher a opção <B>Validar Vaga</B>; <br> 
                    <font style="margin-left: 20px"><B>Opção 1:</B> <br> </font>
                    <font style="margin-left: 20px">PASSO 4)</font> Selecionar a(s) <B>Vaga(s)</B> que deseja aprovar; <br> 
                    <font style="margin-left: 20px">PASSO 5)</font> Clicar no botão <B>Aprovar</B>; <br>
                    <font style="margin-left: 20px"><B>Opção 2:</B> <br> </font>
                    <font style="margin-left: 20px">PASSO 4)</font> Clicar no botão <B>Visualizar</B>, na Vaga que deseja aprovar; <br>
                    <font style="margin-left: 20px">PASSO 5)</font> Clicar no botão <B>Autorizar</B>; <br>
                    <font style="margin-left: 20px">PASSO 6)</font> Informar a <B>justificativa</B> e clicar no botão <B>Autorizar</B>; <br>
                    <font style="margin-left: 20px">PASSO 7)</font> Em seguida irá aparecer a tela de <B>Confirmação de Aprovação</B>. <br> 
                  </p>
                  <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/aprovarPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
                </td>
              </tr>
            <tr>
              <td id="funcReprovarVagaPD" hidden>
                  <p> 
                    <font style="margin-left: 20px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                    <font style="margin-left: 20px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                    <font style="margin-left: 20px">PASSO 3)</font> Escolher a opção <B>Validar Vaga</B>; <br> 
                    <font style="margin-left: 20px">PASSO 4)</font> Clicar no botão <B>Visualizar</B>, na Vaga que deseja reprovar; <br>
                    <font style="margin-left: 20px">PASSO 5)</font> Clicar no botão <B>Não Autorizar</B>; <br>
                    <font style="margin-left: 20px">PASSO 6)</font> Informar a <B>justificativa</B> e clicar no botão <B>Não Autorizar</B>; <br>
                    <font style="margin-left: 20px">PASSO 7)</font> Em seguida irá aparecer a tela de <B>Confirmação de Reprovação</B>. <br> 
                  </p>
                  <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/reprovarPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
              </td>
            </tr>
            <tr>
              <td id="funcCorrigirVagaPD" hidden>
                  <p> 
                    <font style="margin-left: 20px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                    <font style="margin-left: 20px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                    <font style="margin-left: 20px">PASSO 3)</font> Escolher a opção <B>Validar Vaga</B>; <br> 
                    <font style="margin-left: 20px">PASSO 4)</font> Clicar no botão <B>Visualizar</B>, na Vaga que deseja reprovar; <br>
                    <font style="margin-left: 20px">PASSO 5)</font> Clicar no botão <B>Não Autorizar</B>; <br>
                    <font style="margin-left: 20px">PASSO 6)</font> Informar a <B>justificativa</B> <br>
                    <font style="margin-left: 20px">PASSO 6)</font> Selecionar o <B>Checkbox</B> para retornar a Vaga para <B>Correção</B> do <B>Solicitante</B> <br> 
                    <font style="margin-left: 20px">PASSO 6)</font> Clicar no botão <B>Não Autorizar</B> <br>
                    <font style="margin-left: 20px">PASSO 7)</font> Em seguida irá aparecer a tela de <B>Confirmação de Reprovação</B>. <br> 
                  </p>
                  <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/corrigirPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
              </td>
            </tr>
          </thead>
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