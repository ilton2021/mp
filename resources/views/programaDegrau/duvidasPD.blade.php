<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>PROGRAMA DEGRAU - RH</title>
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
         <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
	    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
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
    <p style="margin-left: 1170px"> <br><BR><a href="{{url('homeProgramaDegrau')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a></p>
	  <center>
      <table class="table table-bordeared" style="WIDTH: 1200px;">
		    <thead>
			  <tr>
			   <td colspan="2"><center><font color="blue"><b>DÚVIDAS PROGRAMA DEGRAU:</b></font></center></td>
         <td colspan="2">
          <center>
            <select id="opcoes" name="opcoes" class="form-control" style="width: 400px;" onchange="funDuvidas('sim')">
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
			  </tr> 
      </table>
	    <table class="table table-bordeared" style="WIDTH: 1200px;">
          <tr>
            <td id="funcCadastrarPD" hidden colspan="2">
                <p> 
                  <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br>
                  <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                  <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Cadastrar Nova Vaga</B>; <br>
                  <font style="margin-left: 50px">PASSO 4)</font> Escolher a <B>Unidade</B> correspondente; <br>
                  <font style="margin-left: 50px">PASSO 5)</font> Preencher as <B>informações da Vaga do Programa Degrau</B>; <br>
                  <font style="margin-left: 50px">PASSO 6)</font> Clicar no botão <B>Concluir</B>; <br>
                  <font style="margin-left: 50px">PASSO 7)</font> Em seguida irá aparecer a tela de <B>Confirmação de Cadastro</B>.
                </p>
                <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/cadastrarPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
            </td>
         </tr>
         <tr>
			      <td id="funcVisualizarPD" hidden colspan="2">
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Visualizar Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Pesquisar: pela <B>Unidade</B>, pelo <B>Solicitante</B> ou pela <B>Data</B>; <br> 
                <font style="margin-left: 50px">PASSO 5)</font> Clicar no botão <B>Visualizar</B>; <br>
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/visualizarPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
            </td>
			  </tr>
        <tr>
			    <td id="funcCadastrarCandidatoPD" hidden colspan="2">
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Inscrição Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Clicar no botão <B>Inscrição</B>; <br>
                <font style="margin-left: 50px">PASSO 5)</font> Informar os dados do Funcionário que irá concorrer a vaga do <B>Programa Degrau</B>; <br>
                <font style="margin-left: 50px">PASSO 6)</font> Informar o <B>Nome</B>, a <B>Matrícula</B> e a <B>Unidade</B> do Funcionário; <br>
                <font style="margin-left: 50px">PASSO 7)</font> Em seguida irá aparecer a tela de <B>Confirmação da Inscrição</B>. <br>
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/inscricaoCandidatoPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
          </td>
			  </tr>
        <tr>
			    <td id="funcVincularCandidatoPD" hidden>
              <p>  
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Inscrição Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Clicar no botão <B>Vincular</B>; <br>
                <font style="margin-left: 50px">PASSO 5)</font> Escolher o Funcionário que ficará com a <B>Vaga</B>; <br>
                <font style="margin-left: 50px">PASSO 6)</font> Clicar no botão <B>Vincular</B>; <br>
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/vincularCandidatoPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
          </td>
			  </tr>
        <tr>
			    <td id="funcAprovarCandidatoPD" hidden>
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Inscrição Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Clicar no botão <B>Vincular</b> <br>
                <font style="margin-left: 50px">PASSO 5)</font> Clicar no botão <B>Validar</B>; <br>
                <font style="margin-left: 50px">PASSO 6)</font> Clicar no botão <B>Aprovar</B>; <br>
                <font style="margin-left: 50px">PASSO 7)</font> Clicar no botão <B>Aprovar</B> novamente; <br>
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/aprovarCandidato.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
          </td>
			  </tr>
        <tr>
			    <td id="funcReprovarCandidatoPD" hidden>
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Inscrição Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Clicar no botão <B>Vincular</b> <br>
                <font style="margin-left: 50px">PASSO 5)</font> Clicar no botão <B>Validar</B>; <br>
                <font style="margin-left: 50px">PASSO 6)</font> Clicar no botão <B>Reprovar</B>; <br>
                <font style="margin-left: 50px">PASSO 7)</font> Clicar no botão <B>Reprovar</B> novamente; <br>
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/reprovarCandidato.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
          </td>
			  </tr>
        <tr>
			    <td id="funcAprovarVagaPD" hidden>
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Validar Vaga</B>; <br> 
                <font style="margin-left: 50px"><B>Opção 1:</B> <br> </font>
                <font style="margin-left: 50px">PASSO 4)</font> Selecionar a(s) <B>Vaga(s)</B> que deseja aprovar; <br> 
                <font style="margin-left: 50px">PASSO 5)</font> Clicar no botão <B>Aprovar</B>; <br>
                <font style="margin-left: 50px"><B>Opção 2:</B> <br> </font>
                <font style="margin-left: 50px">PASSO 4)</font> Clicar no botão <B>Visualizar</B>, na Vaga que deseja aprovar; <br>
                <font style="margin-left: 50px">PASSO 5)</font> Clicar no botão <B>Autorizar</B>; <br>
                <font style="margin-left: 50px">PASSO 6)</font> Informar a <B>justificativa</B> e clicar no botão <B>Autorizar</B>; <br>
                <font style="margin-left: 50px">PASSO 7)</font> Em seguida irá aparecer a tela de <B>Confirmação de Aprovação</B>. <br> 
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/aprovarPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
          </td>
        </tr>
        <tr>
          <td id="funcReprovarVagaPD" hidden>
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Validar Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Clicar no botão <B>Visualizar</B>, na Vaga que deseja reprovar; <br>
                <font style="margin-left: 50px">PASSO 5)</font> Clicar no botão <B>Não Autorizar</B>; <br>
                <font style="margin-left: 50px">PASSO 6)</font> Informar a <B>justificativa</B> e clicar no botão <B>Não Autorizar</B>; <br>
                <font style="margin-left: 50px">PASSO 7)</font> Em seguida irá aparecer a tela de <B>Confirmação de Reprovação</B>. <br> 
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/reprovarPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
          </td>
        </tr>
        <tr>
          <td id="funcCorrigirVagaPD" hidden>
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Programa Degrau</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Validar Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Clicar no botão <B>Visualizar</B>, na Vaga que deseja reprovar; <br>
                <font style="margin-left: 50px">PASSO 5)</font> Clicar no botão <B>Não Autorizar</B>; <br>
                <font style="margin-left: 50px">PASSO 6)</font> Informar a <B>justificativa</B> <br>
                <font style="margin-left: 50px">PASSO 6)</font> Selecionar o <B>Checkbox</B> para retornar a Vaga para <B>Correção</B> do <B>Solicitante</B> <br> 
                <font style="margin-left: 50px">PASSO 6)</font> Clicar no botão <B>Não Autorizar</B> <br>
                <font style="margin-left: 50px">PASSO 7)</font> Em seguida irá aparecer a tela de <B>Confirmação de Reprovação</B>. <br> 
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/pd/corrigirPD.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
          </td>
		    </tr>
      </thead>
		</table>
	  </center>
	</footer>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    </body>
</html>