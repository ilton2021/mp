<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Movimentação de Pessoal - Validação</title>
  <link rel="stylesheet" href="{{ asset('css/app2.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-7">
            <div class="card2 b-0">

                <fieldset class="show">
                    <div class="form-card2">
                        <h5 class="sub-heading">Escolha uma opção:</h5>

                        <div class="row px-1 radio2-group">
                            <div class="card2-block radio">
							 <a href="{{ route('inicioMP') }}">
                                <div class="image2-icon">
                                    <img class="icon2 icon1" src="{{ asset('/img/foto.jpeg') }}">
                                </div>
                                <p class="sub-desc"><center>MP</center></p> 
							 </a>
                            </div>
                            <div class="card2-block radio">
							 <a href="{{ route('inicioVaga') }}">
                                <div class="image2-icon">
                                    <img class="icon2 icon1" src="{{ asset('/img/foto2.jpeg') }}">
                                </div>
                                <p class="sub-desc"><center>VAGAS</center></p>
						 	 </a>
                            </div>
                            <div class="card2-block radio">
							 <a href="{{ route('inicioDegrau') }}">
                                <div class="image2-icon">
                                    <img class="icon2 icon1" src="{{ asset('/img/programaDegrau.png') }}">
                                </div>
                                <p class="sub-desc"><center>PROGRAMA DEGRAU</center></p>
							 </a>
                            </div>
                        </div>
                    </div>
                </fieldset>

             </div>
        </div>
    </div>
</div>
</body>
</HTML>