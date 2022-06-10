<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Movimentação de Pessoal - Validação</title>
  <link rel="stylesheet" href="{{ asset('css/app3.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
  
</head>
<body>
  <div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-7">
            <div class="card b-0">

                <fieldset class="show">
                    <div class="form-card">
                        <h5 class="sub-heading">Escolha uma Unidade:</h5>
                        <div class="row px-1 radio-group">                            
                            @foreach($unidades as $unidade)
                             @if($unidade-> id != 1)
                              @foreach($gestor as $g)
                               @if($g->unidade_id == $unidade->id) 
                               <div class="card-block text-center radio">
                                <a href="{{ route('cadastroPD', $unidade->id) }}">
                                    <div class="image-icon">
                                        <img class="icon icon1" title="{{ $unidade->nome }}" src="{{asset('img')}}/{{$unidade->caminho}}"  style="width: 180px;" >
                                    </div>
                                </a>
                               </div>
                               @elseif($g->id == 13 || $g->id == 12 || $g->id == 26 || $g->id == 71 || $g->id == 29 || $g->id == 61 || $g->id == 198 || $g->id == 23 || $g->id == 63 || $g->id == 10 || $g->id == 64 || $g->id == 32 || $g->id == 24 || $g->id == 30)
                               <div class="card-block text-center radio">
                                <a href="{{ route('cadastroPD', $unidade->id) }}">
                                    <div class="image-icon">
                                        <img class="icon icon1" title="{{ $unidade->nome }}" src="{{asset('img')}}/{{$unidade->caminho}}"  style="width: 180px;" >
                                    </div>
                                </a>
                               </div>
                               @endif
                              @endforeach
                             @endif
                            @endforeach                            
                        </div>
                    </div>
                </fieldset>

                <a href="{{url('homeProgramaDegrau')}}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
            </div>
        </div>
    </div>
</div>
</body>
</HTML>
    