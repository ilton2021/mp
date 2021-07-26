<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Programa Degrau - Vaga</title>
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style-dashboard.css')}}">
  <link href="{{ asset('js/utils.js') }}" rel="stylesheet">
  <link href="{{ asset('js/bootstrap.js') }}" rel="stylesheet">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
	  <br><br><br><br><br>
	      <center>
		   <table class="table table-bordered" style="width: 1000px;" cellspacing="0"> 
			<tr>
			  <td><center><strong><br>Vaga do Programa Degrau <br>criada com Sucesso!!!</strong></center></td>
			  <td><center><strong><br>E-mail enviado com Sucesso!!! <br>Clique em Voltar para voltar ao início.</strong></center></td>
			  <td><center><img width="250" id="img-unity" src="{{asset('img')}}/{{$unidade[0]->caminho}}" class="rounded-sm" alt="..."></center></td>
			</tr>
			<tr>
			  <td>
			   Exportar PDF:
			   <a class="text-danger" href="{{ route('degrauPDF', array($idG, $idVI)) }}" title="Download PDF Vaga"><img src="{{asset('img/pdf.png')}}" alt="" width="60"></a>
			  </td>
			</tr>
		   </table>
		  </center>		  		  
		  <center>
		  <table class="table table-bordered" style="width: 1000px;" cellspacing="0">
		   <tr>
		    <td align="right"> <a href="{{ url('/home') }}" class="btn btn-success">Voltar</a></td>
		   </tr>
		  </table>
		  </center>
   </form>   
</body>