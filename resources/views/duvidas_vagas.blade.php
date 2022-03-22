<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Abertura de Vaga - RH</title>
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
                    document.getElementById('funcCadastrarVaga').hidden  = false;   
                    document.getElementById('funcAprovarVaga').hidden    = true;
                    document.getElementById('funcReprovarVaga').hidden   = true;
                    document.getElementById('funcVoltarVaga').hidden     = true;
                    document.getElementById('funcExcluirVaga').hidden    = true;
                    document.getElementById('funcAlterarVaga').hidden    = true;
                    document.getElementById('funcCriadasVaga').hidden    = true;
                    document.getElementById('funcAprovadasVaga').hidden  = true;
                    document.getElementById('funcReprovadasVaga').hidden = true;
                } else if(u == 2){
                    document.getElementById('funcCadastrarVaga').hidden  = true;   
                    document.getElementById('funcAprovarVaga').hidden    = false;
                    document.getElementById('funcReprovarVaga').hidden   = true;
                    document.getElementById('funcVoltarVaga').hidden     = true;
                    document.getElementById('funcExcluirVaga').hidden    = true;
                    document.getElementById('funcAlterarVaga').hidden    = true;
                    document.getElementById('funcCriadasVaga').hidden    = true;
                    document.getElementById('funcAprovadasVaga').hidden  = true;
                    document.getElementById('funcReprovadasVaga').hidden = true;
                } else if(u == 3){
                    document.getElementById('funcCadastrarVaga').hidden  = true;   
                    document.getElementById('funcAprovarVaga').hidden    = true;
                    document.getElementById('funcReprovarVaga').hidden   = false;
                    document.getElementById('funcVoltarVaga').hidden     = true;
                    document.getElementById('funcExcluirVaga').hidden    = true;
                    document.getElementById('funcAlterarVaga').hidden    = true;
                    document.getElementById('funcCriadasVaga').hidden    = true;
                    document.getElementById('funcAprovadasVaga').hidden  = true;
                    document.getElementById('funcReprovadasVaga').hidden = true;
                } else if(u == 4){
                    document.getElementById('funcCadastrarVaga').hidden  = true;   
                    document.getElementById('funcAprovarVaga').hidden    = true;
                    document.getElementById('funcReprovarVaga').hidden   = true;
                    document.getElementById('funcVoltarVaga').hidden     = false;
                    document.getElementById('funcExcluirVaga').hidden    = true;
                    document.getElementById('funcAlterarVaga').hidden    = true;
                    document.getElementById('funcCriadasVaga').hidden    = true;
                    document.getElementById('funcAprovadasVaga').hidden  = true;
                    document.getElementById('funcReprovadasVaga').hidden = true;
                } else if(u == 5){
                    document.getElementById('funcCadastrarVaga').hidden  = true;   
                    document.getElementById('funcAprovarVaga').hidden    = true;
                    document.getElementById('funcReprovarVaga').hidden   = true;
                    document.getElementById('funcVoltarVaga').hidden     = true;
                    document.getElementById('funcExcluirVaga').hidden    = false;
                    document.getElementById('funcAlterarVaga').hidden    = true;
                    document.getElementById('funcCriadasVaga').hidden    = true;
                    document.getElementById('funcAprovadasVaga').hidden  = true;
                    document.getElementById('funcReprovadasVaga').hidden = true;
                } else if(u == 6){
                    document.getElementById('funcCadastrarVaga').hidden  = true;   
                    document.getElementById('funcAprovarVaga').hidden    = true;
                    document.getElementById('funcReprovarVaga').hidden   = true;
                    document.getElementById('funcVoltarVaga').hidden     = true;
                    document.getElementById('funcExcluirVaga').hidden    = true;
                    document.getElementById('funcAlterarVaga').hidden    = false;
                    document.getElementById('funcCriadasVaga').hidden    = true;
                    document.getElementById('funcAprovadasVaga').hidden  = true;
                    document.getElementById('funcReprovadasVaga').hidden = true;
                } else if(u == 7){
                    document.getElementById('funcCadastrarVaga').hidden  = true;   
                    document.getElementById('funcAprovarVaga').hidden    = true;
                    document.getElementById('funcReprovarVaga').hidden   = true;
                    document.getElementById('funcVoltarVaga').hidden     = true;
                    document.getElementById('funcExcluirVaga').hidden    = true;
                    document.getElementById('funcAlterarVaga').hidden    = true;
                    document.getElementById('funcCriadasVaga').hidden    = false;
                    document.getElementById('funcAprovadasVaga').hidden  = true;
                    document.getElementById('funcReprovadasVaga').hidden = true;
                } else if(u == 8){
                    document.getElementById('funcCadastrarVaga').hidden  = true;   
                    document.getElementById('funcAprovarVaga').hidden    = true;
                    document.getElementById('funcReprovarVaga').hidden   = true;
                    document.getElementById('funcVoltarVaga').hidden     = true;
                    document.getElementById('funcExcluirVaga').hidden    = true;
                    document.getElementById('funcAlterarVaga').hidden    = true;
                    document.getElementById('funcCriadasVaga').hidden    = true;
                    document.getElementById('funcAprovadasVaga').hidden  = false;
                    document.getElementById('funcReprovadasVaga').hidden = true;
                } else if(u == 9){
                    document.getElementById('funcCadastrarVaga').hidden  = true;   
                    document.getElementById('funcAprovarVaga').hidden    = true;
                    document.getElementById('funcReprovarVaga').hidden   = true;
                    document.getElementById('funcVoltarVaga').hidden     = true;
                    document.getElementById('funcExcluirVaga').hidden    = true;
                    document.getElementById('funcAlterarVaga').hidden    = true;
                    document.getElementById('funcCriadasVaga').hidden    = true;
                    document.getElementById('funcAprovadasVaga').hidden  = true;
                    document.getElementById('funcReprovadasVaga').hidden = false;
                } else {
                    document.getElementById('funcCadastrarVaga').hidden  = true;   
                    document.getElementById('funcAprovarVaga').hidden    = true;
                    document.getElementById('funcReprovarVaga').hidden   = true;
                    document.getElementById('funcVoltarVaga').hidden     = true;
                    document.getElementById('funcExcluirVaga').hidden    = true;
                    document.getElementById('funcAlterarVaga').hidden    = true;
                    document.getElementById('funcCriadasVaga').hidden    = true;
                    document.getElementById('funcAprovadasVaga').hidden  = true;
                    document.getElementById('funcReprovadasVaga').hidden = true;
                    document.getElementById('funcAprovarVaga').hidden    = true;
                }
		    }        
        </script>
    </head>
<body> 
    <p style="margin-left: 1170px"> <br><BR><a href="{{url('homeVaga')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a></p>
	<center>
        <table class="table table-bordeared" style="WIDTH: 1200px;">
		    <thead>
			  <tr>
			   <td colspan="2"><center><font color="blue"><b>DÚVIDAS SOLICITAÇÃO DE VAGAS:</b></font></center></td>
               <td colspan="2">
                 <center>
                    <select id="opcoes" name="opcoes" class="form-control" style="width: 450px;" onchange="funDuvidas('sim')">
                      <option id="opcoes" name="opcoes" value="">SELECIONE..</option>
                      <option id="opcoes" name="opcoes" value="1">COMO CADASTRAR UMA VAGA</option>
                      <option id="opcoes" name="opcoes" value="2">COMO APROVAR UMA VAGA</option>
                      <option id="opcoes" name="opcoes" value="3">COMO REPROVAR UMA VAGA</option>
                      <option id="opcoes" name="opcoes" value="4">COMO VOLTAR UMA VAGA PARA CORREÇÃO</option>
                      <option id="opcoes" name="opcoes" value="5">COMO EXCLUIR UMA VAGA</option>
                      <option id="opcoes" name="opcoes" value="6">COMO ALTERAR UMA VAGA</option>
                      <option id="opcoes" name="opcoes" value="7">ONDE VISUALIZAR AS VAGAS CRIADAS (NO FLUXO)</option>
                      <option id="opcoes" name="opcoes" value="8">ONDE VISUALIZAR AS VAGAS APROVADAS</option>
                      <option id="opcoes" name="opcoes" value="9">ONDE VISUALIZAR AS VAGAS REPROVADAS</option>
                   </select>
                 </center>
               </td>
			  </tr>
			  
      </table>
			<table class="table table-bordeared" style="WIDTH: 1200px;">
          <tr>
            <td id="funcCadastrarVaga" hidden colspan="2">
                <p> 
                  <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br>
                  <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Solicitação de Abertura de Vaga</B>; <br> 
                  <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Cadastrar Nova Vaga</B>; <br>
                  <font style="margin-left: 50px">PASSO 4)</font> Escolher a <B>Unidade</B> correspondente; <br>
                  <font style="margin-left: 50px">PASSO 5)</font> Escolher a opção <B>Fluxo Ordinário ou Fluxo Não Ordinário</B>; <br>
                  <font style="margin-left: 50px">PASSO 6)</font> Preencher as <B>informações da Vaga</B>; <br>
                  <font style="margin-left: 50px">PASSO 7)</font> Clicar no botão <B>Concluir</B>; <br>
                  <font style="margin-left: 50px">PASSO 8)</font> Em seguida irá aparecer a tela de <B>Confirmação de Cadastro</B>.
                </p>
                <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/vaga/cadastrarVaga.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
            </td>
         </tr>
         <tr>
			      <td id="funcAprovarVaga" hidden colspan="4">
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Solicitação de Abertura de Vaga</B>; <br> 
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
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/vaga/aprovarVaga.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
            </td>
			  </tr>
        <tr>
			      <td id="funcReprovarVaga" hidden colspan="2">
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Solicitação de Abertura de Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Validar Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Clicar no botão <B>Visualizar</B> na linha da Vaga que deseja reprovar; <br>
                <font style="margin-left: 50px">PASSO 5)</font> Clicar no botão <B>Não Autorizar</B>; <br>
                <font style="margin-left: 50px">PASSO 6)</font> Informar a <B>justificativa</B> e clicar no botão <B>Não Autorizar</B>; <br>
                <font style="margin-left: 50px">PASSO 7)</font> Em seguida irá aparecer a tela de <B>Confirmação da Reprovação</B>. <br>
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/vaga/reprovarVaga.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
            </td>
			  </tr>
        <tr>
			      <td id="funcVoltarVaga" hidden>
              <p>  
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Solicitação de Abertura de Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Validar Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Clicar no botão <B>Visualizar</B> na linha da Vaga que deseja reprovar; <br>
                <font style="margin-left: 50px">PASSO 5)</font> Clicar no botão <B>Não Autorizar</B>; <br>
                <font style="margin-left: 50px">PASSO 6)</font> Informar a <B>justificativa</B> e selecionar o <b>checkbox</b> para <b>voltar</b> a Vaga para o <b>Solicitante</b> <br>
                <font style="margin-left: 50px">PASSO 7)</font> Clicar no botão <B>Não Autorizar</B>; <br>
                <font style="margin-left: 50px">PASSO 8)</font> Em seguida irá aparecer a tela de <B>Confirmação da Reprovação</B>. <br>
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/vaga/voltarVagaCorrecao.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
            </td>
			  </tr>
        <tr>
			      <td id="funcExcluirVaga" hidden>
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Solicitação de Abertura de Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Excluir Vagas</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Pesquisar pela <b>Vaga</b>: pela unidade, nome, número ou pelo solicitante; <br>
                <font style="margin-left: 50px">PASSO 5)</font> Clicar no botão <B>Inativar</B>; <br>
                <font style="margin-left: 50px">PASSO 6)</font> Na outra tela, clicar no botão <b>Inativar</b>;
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/vaga/excluirVaga.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
            </td>
			  </tr>
        <tr>
			      <td id="funcAlterarVaga" hidden>
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Solicitação de Abertura de Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Validar Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Clicar no botão <B>Visualizar</B> na linha da Vaga que deseja alterar; <br>
                <font style="margin-left: 50px">PASSO 5)</font> Clicar no botão <B>Alterar</B>; <br>
                <font style="margin-left: 50px">PASSO 6)</font> Fazer as correções das informações da <b>Vaga</b>; <br>
                <font style="margin-left: 50px">PASSO 7)</font> Clicar no botão <b>Alterar</b>; <br>
                <font style="margin-left: 50px">PASSO 8)</font> Clicar no botão <b>Concluir</b>;
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/vaga/alterarVaga.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
            </td>
			  </tr>
        <tr>
			      <td id="funcCriadasVaga" hidden>
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Solicitação de Abertura de Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Visualizar Vagas</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Escolher a opção <b>Vagas Criadas</b>; 
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/vaga/criadasVaga.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
            </td>
			  </tr>
        <tr>
			      <td id="funcAprovadasVaga" hidden>
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Solicitação de Abertura de Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Visualizar Vagas</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Escolher a opção <b>Vagas Aprovadas</b>; 
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/vaga/aprovadasVagas.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
            </td>
			  </tr>
        <tr>
			      <td id="funcReprovadasVaga" hidden>
              <p> 
                <font style="margin-left: 50px">PASSO 1)</font> <B>Logar</B> no sistema; <br> 
                <font style="margin-left: 50px">PASSO 2)</font> Escolher a opção <B>Solicitação de Abertura de Vaga</B>; <br> 
                <font style="margin-left: 50px">PASSO 3)</font> Escolher a opção <B>Visualizar Vagas</B>; <br> 
                <font style="margin-left: 50px">PASSO 4)</font> Escolher a opção <b>Vagas Reprovadas</b>; 
              </p>
              <p style="margin-left: 40px"> <a target="_blank" class="text-danger" href="{{asset('storage/arquivos/vaga/reprovadasVaga.pdf')}}" title="Download PDF Dúvida"><img src="{{asset('storage/arquivos/pdf.png')}}" alt="" width="60"></a> </p>
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