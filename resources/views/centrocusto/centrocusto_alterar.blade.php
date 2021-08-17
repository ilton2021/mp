<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
        <title>MP RH</title>
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <script src="https://kit.fontawesome.com/7656d93ed3.js" crossorigin="anonymous"></script>
        <style>
		.navbar .dropdown-menu .form-control {
			width: 300px;
		}
        </style>
    </head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm p-3 mb-5 rounded fixed-top">
  	    <img src="{{asset('img/Imagem1.png')}}"  height="50" class="d-inline-block align-top" alt="">
			<span class="navbar-brand mb-0 h1" style="margin-left:10px;margin-top:5px ;color: rgb(103, 101, 103) !important">
				<h4 class="d-none d-sm-block">Movimentação de Pessoal - RH</h4>
			</span>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>

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
	<div class="container-fluid">
	<div class="row" style="margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">ALTERAR CENTRO DE CUSTO:</h3>
		</div>
	</div>
	@if ($errors->any())
		<div class="alert alert-success">
		  <ul>
		    @foreach ($errors->all() as $error)
		      <li>{{ $error }}</li>
			@endforeach
		  </ul>
		</div>
	@endif
	<div class="row" style="margin-top: 25px;">
		<div class="col-md-2 col-sm-0"></div>
		<div class="col-md-8 col-sm-12 text-center">
		 <div class="accordion" id="accordionExample">
                <div class="card">
                    <a class="card-header bg-success text-decoration-none text-white bg-success" type="button" data-toggle="collapse" data-target="#PESSOAL" aria-expanded="true" aria-controls="PESSOAL">
                        Centro de Custo: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					 <form action="{{\Request::route('updateCentrocusto', $centrocustos[0]->id)}}" method="post">
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <table border="0" class="table bordered" style="line-height: 1.5;" >
						 <tr>
							<td> Nome: </td>
							<td>
								<input class="form-control" type="text" id="nome" name="nome" required value="<?php echo $centrocustos[0]->nome; ?>" />
							</td>
                         </tr> 
                         <tr>
                            <td> Unidade(s): </td>   
                            <td> 
                            <?php $q1 = $centrocustos[0]->unidade; $r1 = "1"; $s1 = str_contains($q1, $r1); ?>
                            <?php $q2 = $centrocustos[0]->unidade; $r2 = "2"; $s2 = str_contains($q2, $r2); ?>
                            <?php $q3 = $centrocustos[0]->unidade; $r3 = "3"; $s3 = str_contains($q3, $r3); ?>
                            <?php $q4 = $centrocustos[0]->unidade; $r4 = "4"; $s4 = str_contains($q4, $r4); ?>
                            <?php $q5 = $centrocustos[0]->unidade; $r5 = "5"; $s5 = str_contains($q5, $r5); ?>
                            <?php $q6 = $centrocustos[0]->unidade; $r6 = "6"; $s6 = str_contains($q6, $r6); ?>
                            <?php $q7 = $centrocustos[0]->unidade; $r7 = "7"; $s7 = str_contains($q7, $r7); ?>
                            <?php $q8 = $centrocustos[0]->unidade; $r8 = "8"; $s8 = str_contains($q8, $r8); ?>

                            @if($s1 == true)
                              <p align="left"><input type="checkbox" id="unidade_1" name="unidade_1" checked /> HCP GESTÃO <br></p>
                            @else
                              <p align="left"><input type="checkbox" id="unidade_1" name="unidade_1" /> HCP GESTÃO <br></p>
                            @endif  
                            @if($s2 == true)
                              <p align="left"><input type="checkbox" id="unidade_2" name="unidade_2" checked /> HMR </p>
                            @else
                              <p align="left"><input type="checkbox" id="unidade_2" name="unidade_2" /> HMR </p>
                            @endif
                            @if($s3 == true)
                              <p align="left"><input type="checkbox" id="unidade_3" name="unidade_3" checked /> UPAE BELO JARDIM </p>
                            @else
                              <p align="left"><input type="checkbox" id="unidade_3" name="unidade_3" /> UPAE BELO JARDIM </p>
                            @endif  
                            @if($s4 == true)
                              <p align="left"><input type="checkbox" id="unidade_4" name="unidade_4" checked /> UPAE ARCOVERDE </p>
                            @else
                              <p align="left"><input type="checkbox" id="unidade_4" name="unidade_4" /> UPAE ARCOVERDE </p>
                            @endif                              
                            @if($s5 == true)  
                              <p align="left"><input type="checkbox" id="unidade_5" name="unidade_5" checked /> UPAE ARRUDA </p>
                            @else
                              <p align="left"><input type="checkbox" id="unidade_5" name="unidade_5" /> UPAE ARRUDA </p>
                            @endif                              
                            @if($s6 == true)  
                              <p align="left"><input type="checkbox" id="unidade_6" name="unidade_6" checked /> UPAE CARUARU </p>
                            @else
                              <p align="left"><input type="checkbox" id="unidade_6" name="unidade_6" /> UPAE CARUARU </p>
                            @endif  
                            @if($s7 == true)  
                              <p align="left"><input type="checkbox" id="unidade_7" name="unidade_7" checked /> HSS </p>
                            @else  
                              <p align="left"><input type="checkbox" id="unidade_7" name="unidade_7" /> HSS </p>
                            @endif  
                            @if($s8 == true)  
                              <p align="left"><input type="checkbox" id="unidade_8" name="unidade_8" checked /> HCA </p>
                            @else
                              <p align="left"><input type="checkbox" id="unidade_8" name="unidade_8" /> HCA </p>   
                            @endif
                            </td>
						  <td> 
                          <p style="margin-top: 260px; margin-right: -45px;"> 
                           <a href="{{ route('cadastroCentrocusto') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a> 
						   <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" />
                          </p> 
                          </td>
						 </tr>
						</table>
						</form>
		</div>
    </div>
</div>
</body>