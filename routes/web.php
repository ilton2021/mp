<?php

use Illuminate\Support\Facades\Route;
use App\Model\Unidade;
use App\Model\MP;
use Illuminate\Support\Facades\Auth;
use App\Model\Aprovacao;
use App\Model\Gestor;

Auth::routes();

Route::get('/','UserController@telaLogin')->name('telaLogin');
Route::get('auth/register', 'UserController@telaRegistro')->name('telaRegistro');
Route::post('auth/register', 'UserController@store')->name('store');
Route::get('auth/passwords/email', 'UserController@telaEmail')->name('telaEmail');
Route::get('auth/passwords/reset', 'UserController@telaReset')->name('telaReset');
Route::post('auth/passwords/reset','UserController@resetarSenha')->name('resetarSenha');
Route::post('auth/login', 'UserController@Login')->name('Login');

Route::middleware(['auth'])->group( function() {
		Route::get('/home', function(){
			return view('escolha');
		});
		
		//MP
		Route::get('/homeMP', 'MPController@inicioMP')->name('inicioMP');
		Route::get('/home/unidade','HomeController@index2')->name('index2');
		Route::get('/escolha/{id}/mp','HomeController@mp')->name('mp');
		Route::get('/home/unidade/mp/{id}/{i}', 'MPController@cadastroMP')->name('cadastroMP');
		Route::get('/home/validar', 'HomeController@indexValida')->name('indexValida');
		Route::post('/home/validar/', 'HomeController@validarMPs')->name('validarMPs');
		Route::get('/home/validar/{id}', 'HomeController@validarMP')->name('validarMP');
		Route::post('/home/validar/{id}', 'HomeController@salvarMP')->name('salvarMP');
		Route::get('/home/validar/{id}/salvarDemissao/{idG}', 'MPController@salvarMPDemissao')->name('salvarMPDemissao');
		Route::post('/home/validar/{id}/salvarDemissao/{idG}', 'MPController@salvarMPDemissao')->name('salvarMPDemissao');
		Route::get('/home/validar/{id}/salvarAlteracao/{idG}', 'MPController@salvarMPAlteracao')->name('salvarMPAlteracao');
		Route::post('/home/validar/{id}/salvarAlteracao/{idG}', 'MPController@salvarMPAlteracao')->name('salvarMPAlteracao');
		Route::get('/home/validar/{id}/salvarAdmissao/{idG}', 'MPController@salvarMPAdmissao')->name('salvarMPAdmissao');
		Route::post('/home/validar/{id}/salvarAdmissao/{idG}', 'MPController@salvarMPAdmissao')->name('salvarMPAdmissao');
		Route::get('/homeMP/visualizar/{id}', 'HomeController@visualizarMP')->name('visualizarMP');
		Route::get('/home/visualizarMPS/', 'HomeController@visualizarMPs')->name('visualizarMPs');
		Route::get('/home/visualizarMPS/criadasMPs', 'HomeController@criadasMPs')->name('criadasMPs');
		Route::get('/home/visualizarMPS/aprovadasMPs', 'HomeController@aprovadasMPs')->name('aprovadasMPs');
		Route::get('/home/visualizarMPS/reprovadasMPs', 'HomeController@reprovadasMPs')->name('reprovadasMPs');
		Route::get('/home/visualizarMPS/criadasMPs/pesquisaMPs', 'HomeController@pesquisaMPs')->name('pesquisaMPs');
		Route::get('/home/visualizarMPS/aprovadasMPs/pesquisaMPs', 'HomeController@pesquisaMPsAp')->name('pesquisaMPsAp');
		Route::get('/home/visualizarMPS/reprovadasMPs/pesquisaMPs', 'HomeController@pesquisaMPsRe')->name('pesquisaMPsRe');
		Route::post('/home/visualizarMPS/criadasMPs/pesquisaMPs/', 'HomeController@pesquisaMPs')->name('pesquisaMPs');
		Route::post('/home/visualizarMPS/aprovadasMPs/pesquisaMPs/', 'HomeController@pesquisaMPsAp')->name('pesquisaMPsAp');
		Route::post('/home/visualizarMPS/reprovadasMPs/pesquisaMPs/', 'HomeController@pesquisaMPsRe')->name('pesquisaMPsRe');
		Route::get('/home/validar/{id}/up/{id_alt}', 'MPController@alterarMPAlteracao')->name('alterarMPAlteracao');
		Route::post('/home/validar/{id}/up/{id_alt}', 'MPController@updateMPAlteracao')->name('updateMPAlteracao');
		Route::get('/home/validar/{id}/updem/{id_dem}', 'MPController@alterarMPDemissao')->name('alterarMPDemissao');
		Route::post('/home/validar/{id}/updem/{id_dem}', 'MPController@updateMPDemissao')->name('updateMPDemissao');
		Route::get('/home/validar/{id}/upadm/{id_adm}', 'MPController@alterarMPAdmissao')->name('alterarMPAdmissao');
		Route::post('/home/validar/{id}/upadm/{id_adm}', 'MPController@updateMPAdmissao')->name('updateMPAdmissao');
		Route::get('/home/validar/{id}/autorizar', 'HomeController@autorizarMP')->name('autorizarMP');
		Route::post('/home/validar/{id}/autorizar/store', 'HomeController@storeAutMP')->name('storeAutMP');
		Route::get('/home/validar/{id}/n_autorizar', 'HomeController@n_autorizarMP')->name('n_autorizarMP');
		Route::post('/home/validar/{id}/n_autorizar/', 'HomeController@storeNAutMP')->name('storeNAutMP');
		Route::post('/home/unidade/mp/{id}/{i}/', 'MPController@storeMP')->name('storeMP');
		Route::get('/pdf/{idG}/{idMP}','MPController@mpPDF')->name('mpPDF');
		Route::get('/home/excluir/mp','MPController@excluirMPs')->name('excluirMPs');
		Route::post('/home/excluir/mp','MPController@pesquisaMPsExclusao')->name('pesquisaMPsExclusao');
		Route::get('/home/excluir/mp/{id}','MPController@excluirMP')->name('excluirMP');
		Route::post('/home/excluir/mp/{id}','MPController@deleteMP')->name('deleteMP');
		////
		
		//Vaga
		Route::get('/homeVaga', 'VagaController@inicioVaga')->name('inicioVaga');
		Route::get('/homeVaga/unidade','VagaController@indexVaga2')->name('indexVaga2');
		Route::get('/homeVaga/unidade/escolha/{id}/vaga','VagaController@escolha_vaga')->name('escolha_vaga');
		Route::get('/homeVaga/validar', 'VagaController@indexValidaVaga')->name('indexValidaVaga');
		Route::post('/homeVaga/validar', 'VagaController@storeValidaVaga')->name('storeValidaVaga');
		Route::get('/homeVaga/validar/{id}', 'VagaController@validarVaga')->name('validarVaga');
		Route::post('/homeVaga/validar/{id}', 'VagaController@salvarVaga')->name('salvarVaga');
		Route::get('/homeVaga/validar/{id}/salvarVaga/{idG}', 'VagaController@salvarVaga')->name('salvarVaga');
		Route::post('/homeVaga/validar/{id}/salvarVaga/{idG}', 'VagaController@salvarVaga')->name('salvarVaga');
		Route::get('/homeVaga/visualizar/{id}', 'VagaController@visualizarVaga')->name('visualizarVaga');
		Route::get('/homeVaga/visualizarVagas/', 'VagaController@visualizarVagas')->name('visualizarVagas');
		Route::get('/homeVaga/visualizarVagas', 'VagaController@visualizarVagas')->name('visualizarVagas');
		Route::get('/homeVaga/visualizarVagas/criadasVagas', 'VagaController@criadasVagas')->name('criadasVagas');
		Route::get('/homeVaga/visualizarVagas/aprovadasVagas', 'VagaController@aprovadasVagas')->name('aprovadasVagas');
		Route::get('/homeVaga/visualizarVagas/reprovadasVagas', 'VagaController@reprovadasVagas')->name('reprovadasVagas');
		Route::get('/home/visualizarVagas/criadasVagas/pesquisaVagas', 'VagaController@pesquisaVagas')->name('pesquisaVagas');
		Route::get('/home/visualizarVagas/aprovadasVagas/pesquisaVagas', 'VagaController@pesquisaVagasAp')->name('pesquisaVagasAp');
		Route::get('/home/visualizarVagas/reprovadasVagas/pesquisaVagas', 'VagaController@pesquisaVagasRe')->name('pesquisaVagasRe');
		Route::post('/home/visualizarVagas/criadasVagas/pesquisaVagas/', 'VagaController@pesquisaVagas')->name('pesquisaVagas');
		Route::post('/home/visualizarVagas/aprovadasVagas/pesquisaVagas/', 'VagaController@pesquisaVagasAp')->name('pesquisaVagasAp');
		Route::post('/home/visualizarVagas/reprovadasVagas/pesquisaVagas/', 'VagaController@pesquisaVagasRe')->name('pesquisaVagasRe');
		Route::get('/homeVaga/validar/{id}/up/', 'VagaController@alterarVaga')->name('alterarVaga');
		Route::post('/homeVaga/validar/{id}/up/', 'VagaController@updateVaga')->name('updateVaga');
		Route::get('/homeVaga/validar/{id}/autorizarVaga', 'VagaController@autorizarVaga')->name('autorizarVaga');
		Route::post('/homeVaga/validar/{id}/autorizarVaga/store', 'VagaController@storeAutVaga')->name('storeAutVaga');
		Route::get('/homeVaga/validar/{id}/n_autorizarVaga', 'VagaController@n_autorizarVaga')->name('n_autorizarVaga');
		Route::post('/homeVaga/validar/{id}/n_autorizarVaga/', 'VagaController@storeNAutVaga')->name('storeNAutVaga');
		////
		
		//Unidade
		Route::get('cadastroUnidade', 'UnidadeController@cadastroUnidade')->name('cadastroUnidade');
		Route::get('cadastroUnidade/unidadeNovo', 'UnidadeController@unidadeNovo')->name('unidadeNovo');
		Route::post('cadastroUnidade/unidadeNovo/', 'UnidadeController@storeUnidade')->name('storeUnidade');
		Route::get('cadastroUnidade/unidadeAlterar/{id}', 'UnidadeController@unidadeAlterar')->name('unidadeAlterar');
		Route::post('cadastroUnidade/unidadeAlterar/{id}/', 'UnidadeController@updateUnidade')->name('updateUnidade');
		Route::get('cadastroUnidade/unidadeExcluir/{id}', 'UnidadeController@unidadeExcluir')->name('unidadeExcluir');
		Route::post('cadastroUnidade/unidadeExcluir/{id}/', 'UnidadeController@destroyUnidade')->name('destroyUnidade');
		////
		
		//Gestor
		Route::get('cadastroGestor','GestorController@cadastroGestor')->name('cadastroGestor');
		Route::get('cadastroGestor/gestorNovo','GestorController@gestorNovo')->name('gestorNovo');
		Route::post('cadastroGestor/gestorNovo','GestorController@storeGestor')->name('storeGestor');
		Route::get('cadastroGestor/gestorAlterar/{id}','GestorController@gestorAlterar')->name('gestorAlterar');
		Route::post('cadastroGestor/gestorAlterar/{id}','GestorController@updateGestor')->name('updateGestor');
		Route::get('cadastroGestor/gestorExcluir/{id}','GestorController@gestorExcluir')->name('gestorExcluir');
		Route::post('cadastroGestor/gestorExcluir/{id}','GestorController@destroyGestor')->name('destroyGestor');
		Route::post('cadastroGestor/pesquisarGestor','GestorController@pesquisarGestor')->name('pesquisarGestor');
		////
		
		//Vaga
		Route::get('/escolha/{id}','HomeController@escolha')->name('escolha');
		Route::get('/escolha/{id}/vaga','VagaController@vaga')->name('vaga');
		Route::get('/escolha/{id}/{i}/vaga','VagaController@cadastrarVaga')->name('cadastrarVaga');
		Route::post('/escolha/{id}/{i}/vaga', 'VagaController@storeVaga')->name('storeVaga');
		Route::get('/home/email/vaga/{i}', 'VagaController@homeVaga')->name('homeVaga');
		Route::get('/pdf/vaga/{idG}/{idVaga}','VagaController@vagaPDF')->name('vagaPDF');
		////
		
		//ProgramaDegrau
		Route::get('/homeProgramaDegrau', 'ProgramaDegrauController@inicioDegrau')->name('inicioDegrau');
		Route::get('/homeProgramaDegrau/unidade','ProgramaDegrauController@index3')->name('index3');
		Route::get('/homeProgramaDegrau/unidade/programaDegrau/{id}', 'ProgramaDegrauController@cadastroPD')->name('cadastroPD');
		Route::post('/homeProgramaDegrau/unidade/programaDegrau/{id}', 'ProgramaDegrauController@storePD')->name('storePD');
		Route::get('/degrauPdf/{idG}/{idVI}','ProgramaDegrauController@degrauPDF')->name('degrauPDF');
		Route::get('/homeProgramaDegrau/visualizarVagasProgramaDegrau', 'ProgramaDegrauController@visualizarVagasPD')->name('visualizarVagasPD');
		Route::post('/homeProgramaDegrau/visualizarVagasProgramaDegrau', 'ProgramaDegrauController@pesquisaPD')->name('pesquisaPD');
		Route::get('/homeProgramaDegrau/visualizarVagasProgramaDegrau/v/{id}', 'ProgramaDegrauController@visualizarVagaPD')->name('visualizarVagaPD');
		Route::get('/homeProgramaDegrau/visualizarVagasProgramaDegrau/{id}', 'ProgramaDegrauController@updateVagaPD')->name('updateVagaPD');
		Route::get('/homeProgramaDegrau/visualizarVagasProgramaDegrau/{id}/up/', 'ProgramaDegrauController@alterarPD')->name('alterarPD');
		Route::post('/homeProgramaDegrau/visualizarVagasProgramaDegrau/{id}/up/', 'ProgramaDegrauController@alterarPDs')->name('alterarPDs');
		Route::get('/homeProgramaDegrau/validarPD/', 'ProgramaDegrauController@validarPD')->name('validarPD');
		Route::post('/homeProgramaDegrau/validarPD/', 'ProgramaDegrauController@validarPDs')->name('validarPDs');
		Route::get('/homeProgramaDegrau/inscricaoPD/', 'ProgramaDegrauController@inscricaoPD')->name('inscricaoPD');
		Route::get('/homeProgramaDegrau/inscricaoPDs/{id}', 'ProgramaDegrauController@inscricaoPDs')->name('inscricaoPDs');
		Route::get('/homeProgramaDegrau/inscricaoInscritosPD/{id}', 'ProgramaDegrauController@inscricaoInscritosPD')->name('inscricaoInscritosPD');
		Route::get('/homeProgramaDegrau/vincularInscritosPD/{id}', 'ProgramaDegrauController@vincularInscritosPD')->name('vincularInscritosPD');
		Route::post('/homeProgramaDegrau/vincularInscritosPD/{id}', 'ProgramaDegrauController@storeVincularInscricao')->name('storeVincularInscricao');
		Route::post('/homeProgramaDegrau/inscricaoPDs/{id}', 'ProgramaDegrauController@storeInscricaoPD')->name('storeInscricaoPD');
		Route::get('/homeProgramaDegrau/inscricaoAprovarPDs/{id_vaga}/{id}', 'ProgramaDegrauController@inscricaoAprovarPDs')->name('inscricaoAprovarPDs');
		Route::get('/homeProgramaDegrau/inscricaoAprovarPDs/{id_vaga}/{id}/aprovar', 'ProgramaDegrauController@aprovarInscricao')->name('aprovarInscricao');
		Route::post('/homeProgramaDegrau/inscricaoAprovarPDs/{id_vaga}/{id}/aprovar', 'ProgramaDegrauController@storeAprovarInscricao')->name('storeAprovarInscricao');
		Route::get('/homeProgramaDegrau/inscricaoAprovarPDs/{id_vaga}/{id}/reprovar', 'ProgramaDegrauController@reprovarInscricao')->name('reprovarInscricao');
		Route::post('/homeProgramaDegrau/inscricaoAprovarPDs/{id_vaga}/{id}/reprovar', 'ProgramaDegrauController@storeReprovarInscricao')->name('storeReprovarInscricao');
		Route::get('/homeProgramaDegrau/validar/{id}/n_autorizarPD', 'ProgramaDegrauController@n_autorizarPD')->name('n_autorizarPD');
		Route::post('/homeProgramaDegrau/validar/{id}/n_autorizarPD', 'ProgramaDegrauController@storeNAutPD')->name('storeNAutPD');
		Route::get('/homeProgramaDegrau/validar/{id}/autorizarPD', 'ProgramaDegrauController@autorizarPD')->name('autorizarPD');
		Route::post('/homeProgramaDegrau/validar/{id}/autorizarPD', 'ProgramaDegrauController@storeAutPD')->name('storeAutPD');
		////

		Route::get('/home/graphicsIndex','HomeController@graphicsIndex')->name('graphicsIndex');
		Route::get('/home/graphics','HomeController@graphics')->name('graphics');
		Route::post('/home/graphics','HomeController@graphics')->name('graphics');
		Route::post('/home/graphics/','HomeController@pesquisarGrafico1')->name('pesquisarGrafico1');
		Route::get('/home/graphics2','HomeController@graphics2')->name('graphics2');
		Route::get('/home/graphics3','HomeController@graphics3')->name('graphics3');
		Route::post('/home/graphics3','HomeController@graphics3')->name('graphics3');
		Route::post('/home/graphics3/','HomeController@pesquisarGrafico3')->name('pesquisarGrafico3');
		Route::get('/home/graphics4','HomeController@graphics4')->name('graphics4');
		Route::post('/home/graphics4','HomeController@graphics4')->name('graphics4');
		Route::post('/home/graphics4/','HomeController@pesquisarGrafico4')->name('pesquisarGrafico4');
		Route::get('/home/graphics5','HomeController@graphics5')->name('graphics5');
		Route::post('/home/graphics5','HomeController@graphics5')->name('graphics5');
		Route::post('/home/graphics5','HomeController@pesquisarGrafico5')->name('pesquisarGrafico5');
		Route::get('/home/graphics6','HomeController@graphics6')->name('graphics6');
		Route::post('/home/graphics6','HomeController@graphics6')->name('graphics6');
		Route::post('/home/graphics6','HomeController@pesquisarGrafico6')->name('pesquisarGrafico6');
		Route::get('/home/graphics7','HomeController@graphics7')->name('graphics7');
		Route::post('/home/graphics7','HomeController@graphics7')->name('graphics7');
		Route::post('/home/graphics7','HomeController@pesquisarGrafico7')->name('pesquisarGrafico7');
		Route::get('/home/graphics8','HomeController@graphics8')->name('graphics8');
		Route::post('/home/graphics8','HomeController@graphics8')->name('graphics8');
		Route::post('/home/graphics8','HomeController@pesquisarGrafico8')->name('pesquisarGrafico8');
		Route::get('/home/graphics9','HomeController@graphics9')->name('graphics9');
		Route::post('/home/graphics9','HomeController@graphics9')->name('graphics9');
		Route::post('/home/graphics9','HomeController@pesquisarGrafico9')->name('pesquisarGrafico9');
		Route::get('/homeVaga/graphicsVagaIndex','VagaController@graphicsVagaIndex')->name('graphicsVagaIndex');
		Route::get('/homeVaga/graphicsVaga','VagaController@graphicsVaga')->name('graphicsVaga');
		Route::get('/homeVaga/graphicsVaga2','VagaController@graphicsVaga2')->name('graphicsVaga2');
		Route::post('/homeVaga/graphicsVaga2','VagaController@graphicsVaga2')->name('graphicsVaga2');
		Route::post('/homeVaga/graphicsVaga2/','VagaController@pesquisarGrafico9')->name('pesquisarGrafico9');
		Route::get('/homeVaga/graphicsVaga3','VagaController@graphicsVaga3')->name('graphicsVaga3');
		Route::post('/homeVaga/graphicsVaga3','VagaController@graphicsVaga3')->name('graphicsVaga3');
		Route::post('/homeVaga/graphicsVaga3/','VagaController@pesquisarGrafico10')->name('pesquisarGrafico10');
});

?>