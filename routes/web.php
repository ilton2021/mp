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
Route::post('auth/passwords/email', 'UserController@emailReset')->name('emailReset');
Route::get('auth/passwords/reset', 'UserController@telaReset')->name('telaReset');
Route::post('auth/passwords/reset', 'UserController@resetarSenha')->name('resetarSenha');
Route::post('auth/login', 'UserController@Login')->name('Login');

Route::middleware(['auth'])->group( function() {
		Route::get('/home', function(){
			$dataI = date('d-m-Y', strtotime(Auth::user()->updated_at));
			$dataF = date('d-m-Y', strtotime('03-09-2021'));
			if(strtotime($dataI) < strtotime($dataF)){
				return view('auth/passwords/email');
			} else {
				$unidade = Unidade::all();
				return view('escolha');
			}
		});
		
		//MP
		Route::get('/homeMP', 'MPController@inicioMP')->name('inicioMP');
		Route::get('/home/unidade','HomeController@index2')->name('index2');
		Route::get('/escolha/{id}/mp','HomeController@mp')->name('mp');
		Route::get('/home/unidade/mp/{id}/mp_admissao', 'MPController@cadastroMPAdmissao')->name('cadastroMPAdmissao');
		Route::post('/home/unidade/mp/{id}/mp_admissao', 'MPController@storeAdmissaoMP')->name('storeAdmissaoMP');
		Route::get('/home/unidade/mp/{id}/mp_demissao', 'MPController@cadastroMPDemissao')->name('cadastroMPDemissao');
		Route::post('/home/unidade/mp/{id}/mp_demissao', 'MPController@storeDemissaoMP')->name('storeDemissaoMP');
		Route::get('/home/unidade/mp/{id}/mp_alteracao', 'MPController@cadastroMPAlteracao')->name('cadastroMPAlteracao');
		Route::post('/home/unidade/mp/{id}/mp_alteracao', 'MPController@storeAlteracaoMP')->name('storeAlteracaoMP');
		Route::get('/home/unidade/mp/{id}/mp_rpa', 'MPController@cadastroMPRpa')->name('cadastroMPRpa');
		Route::post('/home/unidade/mp/{id}/mp_rpa', 'MPController@storeRpaMP')->name('storeRpaMP');
		Route::post('/home/unidade/mp/{id}/{i}/', 'MPController@storeMP')->name('storeMP');
		Route::get('/home/validar', 'HomeController@indexValida')->name('indexValida');
		Route::post('/home/validar/', 'HomeController@validarMPs')->name('validarMPs');
		Route::get('/home/validar/{id}', 'HomeController@validarMP')->name('validarMP');
		Route::post('/home/validar/{id}', 'HomeController@salvarMP')->name('salvarMP');
		Route::get('/home/validar/{id}/salvarDemissao/{idG}', 'MPController@salvarMPDemissao')->name('salvarMPDemissao');
		Route::post('/home/validar/{id}/salvarDemissao/{idG}', 'MPController@salvarMPDemissao')->name('salvarMPDemissao');
		Route::get('/home/validar/{id}/salvarAdmHCP/{idG}', 'MPController@salvarMPAdmissaoHCP')->name('salvarMPAdmissaoHCP');
		Route::post('/home/validar/{id}/salvarAdmHCP/{idG}', 'MPController@salvarMPAdmissaoHCP')->name('salvarMPAdmissaoHCP');
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
		Route::get('/home/error','MPController@welcomeErro')->name('welcomeErro');

		Route::get('/home/validar/{id}/upadm_rpa/{id_adm_rpa}', 'MPController@alterarMPAdmissaoRPA')->name('alterarMPAdmissaoRPA');
		Route::post('/home/validar/{id}/upadm_rpa/{id_adm_rpa}', 'MPController@updateMPAdmissaoRPA')->name('updateMPAdmissaoRPA');
		
		Route::get('/home/validar/{id}/autorizar', 'HomeController@autorizarMP')->name('autorizarMP');
		Route::post('/home/validar/{id}/autorizar/store', 'HomeController@storeAutMP')->name('storeAutMP');
		Route::get('/home/validar/{id}/n_autorizar', 'HomeController@n_autorizarMP')->name('n_autorizarMP');
		Route::post('/home/validar/{id}/n_autorizar/', 'HomeController@storeNAutMP')->name('storeNAutMP');
		
		Route::get('/pdf/{idG}/{idMP}','MPController@mpPDF')->name('mpPDF');
		Route::get('/home/excluir/mp','MPController@excluirMPs')->name('excluirMPs');
		Route::get('/home/excluir/mp/pesquisa','MPController@pesquisaMPsExclusao')->name('pesquisaMPsExclusao');
		Route::post('/home/excluir/mp/pesquisa','MPController@pesquisaMPsExclusao')->name('pesquisaMPsExclusao');
		Route::get('/home/excluir/mp/{id}','MPController@excluirMP')->name('excluirMP');
		Route::post('/home/excluir/mp/{id}','MPController@deleteMP')->name('deleteMP');
		Route::get('/home/visualizarMPS/minhasMPS', 'HomeController@minhasMPS')->name('minhasMPS');
		Route::get('/home/visualizarMPS/minhasMPS/pesquisa', 'HomeController@pesquisaHistMPs')->name('pesquisaHistMPs');
		Route::post('/home/visualizarMPS/minhasMPS/pesquisa', 'HomeController@pesquisaHistMPs')->name('pesquisaHistMPs');
		//
		Route::get('/homeVaga/excluir/vaga','VagaController@excluirVagas')->name('excluirVagas');
		Route::post('/homeVaga/excluir/vaga','VagaController@pesquisaVagasExclusao')->name('pesquisaVagasExclusao');
		Route::get('/homeVaga/excluir/vaga/{id}','VagaController@excluirVaga')->name('excluirVaga');
		Route::post('/homeVaga/excluir/vaga/{id}','VagaController@deleteVaga')->name('deleteVaga');
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
		Route::post('/home/visualizarVagas/criadasVagas/pesquisaVagas', 'VagaController@pesquisaVagas')->name('pesquisaVagas');
		Route::post('/home/visualizarVagas/aprovadasVagas/pesquisaVagas/', 'VagaController@pesquisaVagasAp')->name('pesquisaVagasAp');
		Route::post('/home/visualizarVagas/reprovadasVagas/pesquisaVagas/', 'VagaController@pesquisaVagasRe')->name('pesquisaVagasRe');
		Route::get('/homeVaga/validar/{id}/up/', 'VagaController@alterarVaga')->name('alterarVaga');
		Route::post('/homeVaga/validar/{id}/up/', 'VagaController@updateVaga')->name('updateVaga');
		Route::get('/homeVaga/validar/{id}/autorizarVaga', 'VagaController@autorizarVaga')->name('autorizarVaga');
		Route::post('/homeVaga/validar/{id}/autorizarVaga/store', 'VagaController@storeAutVaga')->name('storeAutVaga');
		Route::get('/homeVaga/validar/{id}/n_autorizarVaga', 'VagaController@n_autorizarVaga')->name('n_autorizarVaga');
		Route::post('/homeVaga/validar/{id}/n_autorizarVaga/', 'VagaController@storeNAutVaga')->name('storeNAutVaga');
		Route::get('/homeVaga/visualizarVagas/minhasVagas', 'VagaController@minhasVagas')->name('minhasVagas');
		Route::get('/homeVaga/visualizarVagas/minhasVagas/pesquisa', 'VagaController@pesquisaHistVagas')->name('pesquisaHistVagas');
		Route::post('/homeVaga/visualizarVagas/minhasVagas/pesquisa', 'VagaController@pesquisaHistVagas')->name('pesquisaHistVagas');
		Route::get('/homeVaga/errorVaga','VagaController@welcomeErroVaga')->name('welcomeErroVaga');
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
		Route::get('/homeProgramaDegrau/errorVagaPD','VagaController@welcomeErroVagaPD')->name('welcomeErroVagaPD');
		////
		
		//Unidade
		Route::get('cadastroUnidade', 'UnidadeController@cadastroUnidade')->name('cadastroUnidade');
		Route::get('cadastroUnidade/unidadeNovo', 'UnidadeController@unidadeNovo')->name('unidadeNovo');
		Route::post('cadastroUnidade/unidadeNovo/', 'UnidadeController@storeUnidade')->name('storeUnidade');
		Route::get('cadastroUnidade/unidadeAlterar/{id}', 'UnidadeController@unidadeAlterar')->name('unidadeAlterar');
		Route::post('cadastroUnidade/unidadeAlterar/{id}/', 'UnidadeController@updateUnidade')->name('updateUnidade');
		Route::get('cadastroUnidade/unidadeExcluir/{id}', 'UnidadeController@unidadeExcluir')->name('unidadeExcluir');
		Route::post('cadastroUnidade/unidadeExcluir/{id}/', 'UnidadeController@destroyUnidade')->name('destroyUnidade');
		Route::get('cadastroUnidade/pesquisarUnidade','UnidadeController@pesquisarUnidade')->name('pesquisarUnidade');
		Route::post('cadastroUnidade/pesquisarUnidade/','UnidadeController@pesquisarUnidade')->name('pesquisarUnidade');
		////

		//Cargos
		Route::get('cadastroCargo', 'CargosController@cadastroCargo')->name('cadastroCargo');
		Route::get('cadastroCargo/cargoNovo', 'CargosController@cargoNovo')->name('cargoNovo');
		Route::post('cadastroCargo/cargoNovo/', 'CargosController@storeCargo')->name('storeCargo');
		Route::get('cadastroCargo/cargoAlterar/{id}', 'CargosController@cargoAlterar')->name('cargoAlterar');
		Route::post('cadastroCargo/cargoAlterar/{id}/', 'CargosController@updateCargo')->name('updateCargo');
		Route::get('cadastroCargo/cargoExcluir/{id}', 'CargosController@cargoExcluir')->name('cargoExcluir');
		Route::post('cadastroCargo/cargoExcluir/{id}/', 'CargosController@destroyCargo')->name('destroyCargo');
		Route::get('cadastroCargo/pesquisarCargo','CargosController@pesquisarCargo')->name('pesquisarCargo');
		Route::post('cadastroCargo/pesquisarCargo','CargosController@pesquisarCargo')->name('pesquisarCargo');
		////

		//CargosRPA
		Route::get('cadastroRPACargo', 'CargosRPAController@cadastroRPACargo')->name('cadastroRPACargo');
		Route::get('cadastroRPACargo/cargoRPANovo', 'CargosRPAController@cargoRPANovo')->name('cargoRPANovo');
		Route::post('cadastroRPACargo/cargoRPANovo/', 'CargosRPAController@storeRPACargo')->name('storeRPACargo');
		Route::get('cadastroRPACargo/cargoRPAAlterar/{id}', 'CargosRPAController@cargoRPAAlterar')->name('cargoRPAAlterar');
		Route::post('cadastroRPACargo/cargoRPAAlterar/{id}/', 'CargosRPAController@updateRPACargo')->name('updateRPACargo');
		Route::get('cadastroRPACargo/cargoRPAExcluir/{id}', 'CargosRPAController@cargoRPAExcluir')->name('cargoRPAExcluir');
		Route::post('cadastroRPACargo/cargoRPAExcluir/{id}/', 'CargosRPAController@destroyRPACargo')->name('destroyRPACargo');
		Route::get('cadastroRPACargo/pesquisarRPACargo','CargosRPAController@pesquisarRPACargo')->name('pesquisarRPACargo');
		Route::post('cadastroRPACargo/pesquisarRPACargo','CargosRPAController@pesquisarRPACargo')->name('pesquisarRPACargo');
		////

		//Centro de custo
		Route::get('cadastroCentrocusto', 'CentroCustoController@cadastroCentrocusto')->name('cadastroCentrocusto');
		Route::get('cadastroCentrocusto/centrocustoNovo', 'CentroCustoController@centrocustoNovo')->name('centrocustoNovo');
		Route::post('cadastroCentrocusto/centrocustoNovo/', 'CentroCustoController@storeCentrocusto')->name('storeCentrocusto');
		Route::get('cadastroCentrocusto/centrocustoAlterar/{id}', 'CentroCustoController@centrocustoAlterar')->name('centrocustoAlterar');
		Route::post('cadastroCentrocusto/centrocustoAlterar/{id}/', 'CentroCustoController@updateCentrocusto')->name('updateCentrocusto');
		Route::get('cadastroCentrocusto/centrocustoExcluir/{id}', 'CentroCustoController@centrocustoExcluir')->name('centrocustoExcluir');
		Route::post('cadastroCentrocusto/centrocustoExcluir/{id}/', 'CentroCustoController@destroyCentrocusto')->name('destroyCentrocusto');
		Route::get('cadastroCentroCusto/pesquisarCentroCusto','CentroCustoController@pesquisarCentroCusto')->name('pesquisarCentroCusto');
		Route::post('cadastroCentroCusto/pesquisarCentroCusto','CentroCustoController@pesquisarCentroCusto')->name('pesquisarCentroCusto');
		////
		
		//Gestor
		Route::get('cadastroGestor','GestorController@cadastroGestor')->name('cadastroGestor');
		Route::get('cadastroGestor/gestorNovo','GestorController@gestorNovo')->name('gestorNovo');
		Route::post('cadastroGestor/gestorNovo','GestorController@storeGestor')->name('storeGestor');
		Route::get('cadastroGestor/gestorAlterar/{id}','GestorController@gestorAlterar')->name('gestorAlterar');
		Route::post('cadastroGestor/gestorAlterar/{id}','GestorController@updateGestor')->name('updateGestor');
		Route::get('cadastroGestor/gestorExcluir/{id}','GestorController@gestorExcluir')->name('gestorExcluir');
		Route::post('cadastroGestor/gestorExcluir/{id}','GestorController@destroyGestor')->name('destroyGestor');
		Route::get('cadastroGestor/pesquisarGestor','GestorController@pesquisarGestor')->name('pesquisarGestor');
		Route::post('cadastroGestor/pesquisarGestor','GestorController@pesquisarGestor')->name('pesquisarGestor');
		////
		
		//Vaga
		Route::get('/escolha/{id}','HomeController@escolha')->name('escolha');
		Route::get('/escolha/{id}/vaga','VagaController@vaga')->name('vaga');
		Route::get('/escolha/{id}/vaga/','VagaController@cadastrarVaga')->name('cadastrarVaga');
		Route::post('/escolha/{id}/vaga/', 'VagaController@storeVaga')->name('storeVaga');
		Route::get('/home/email/vaga/{i}', 'VagaController@homeVaga')->name('homeVaga');
		Route::get('/pdf/vaga/{idG}/{idVaga}','VagaController@vagaPDF')->name('vagaPDF');
		////

		//Inativar MP's
		Route::post('/home/inativar/mp/{id}','HomeController@inativandoMPs')->name('inativandoMPs');
		Route::get('/home/inativar/mp/{id}','HomeController@inativarMPs')->name('inativarMPs');
		Route::get('/home/visualizarMPS/inativasMPs', 'HomeController@inativasMPs')->name('inativasMPs');
		////

		//Inativar Vagas
		Route::post('/home/inativar/vaga/{id}','HomeController@inativandoVagas')->name('inativandoVagas');
		Route::get('/home/inativar/vaga/{id}','HomeController@inativarVagas')->name('inativarVagas');
		Route::get('/home/visualizarVagas/inativasVagas', 'HomeController@inativasVagas')->name('inativasVagas');
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
		Route::get('/home/graphics10','HomeController@graphics10')->name('graphics10');
		Route::post('/home/graphics10','HomeController@graphics10')->name('graphics10');
		Route::post('/home/graphics10','HomeController@pesquisarGrafico10')->name('pesquisarGrafico10');
		Route::get('/home/graphics11','HomeController@graphics11')->name('graphics11');
		Route::post('/home/graphics11','HomeController@graphics11')->name('graphics11');
		Route::post('/home/graphics11','HomeController@pesquisarGrafico11')->name('pesquisarGrafico11');
		Route::get('/home/graphics12','HomeController@graphics12')->name('graphics12');
		Route::post('/home/graphics12','HomeController@graphics12')->name('graphics12');
		Route::post('/home/graphics12','HomeController@pesquisarGrafico12')->name('pesquisarGrafico12');
		Route::get('/home/graphics13','HomeController@graphics13')->name('graphics13');
		Route::post('/home/graphics13','HomeController@graphics13')->name('graphics13');
		Route::post('/home/graphics13','HomeController@pesquisarGrafico13')->name('pesquisarGrafico13');
		Route::get('/homeVaga/graphicsVagaIndex','VagaController@graphicsVagaIndex')->name('graphicsVagaIndex');
		Route::get('/homeVaga/graphicsVaga','VagaController@graphicsVaga')->name('graphicsVaga');
		Route::get('/homeVaga/graphicsVaga2','VagaController@graphicsVaga2')->name('graphicsVaga2');
		Route::post('/homeVaga/graphicsVaga2','VagaController@graphicsVaga2')->name('graphicsVaga2');
		Route::post('/homeVaga/graphicsVaga2/','VagaController@pesquisarGrafico9')->name('pesquisarGrafico9');
		Route::get('/homeVaga/graphicsVaga3','VagaController@graphicsVaga3')->name('graphicsVaga3');
		Route::post('/homeVaga/graphicsVaga3','VagaController@graphicsVaga3')->name('graphicsVaga3');
		Route::post('/homeVaga/graphicsVaga3/','VagaController@pesquisarGrafico10')->name('pesquisarGrafico10');
		
		//Usu??rio
		Route::get('/homeMP/cadastro_usuario','UserController@cadastroUsuario')->name('cadastroUsuario');
		Route::get('/homeMP/cadastro_usuario/novo','UserController@cadastroUsuarioNovo')->name('cadastroUsuarioNovo');
		Route::post('/homeMP/cadastro_usuario/novo','UserController@store')->name('store');
		Route::get('/homeMP/cadastro_usuario/alterar/{id}','UserController@cadastroUsuarioAlterar')->name('cadastroUsuarioAlterar');
		Route::post('/homeMP/cadastro_usuario/alterar/{id}','UserController@alterarUsuario')->name('alterarUsuario');
		Route::get('/homeMP/cadastro_usuario/alterar_senha/{id}','UserController@alterarSenhaUsuario')->name('alterarSenhaUsuario');
		Route::post('/homeMP/cadastro_usuario/alterar_senha/{id}','UserController@updateSenha')->name('updateSenha');
		Route::get('/homeMP/cadastro_usuario/excluir/{id}','UserController@cadastroUsuarioExcluir')->name('cadastroUsuarioExcluir');
		Route::post('/homeMP/cadastro_usuario/excluir/{id}','UserController@deleteUsuario')->name('deleteUsuario');	
		Route::get('/homeMP/cadastro_usuario/pesquisarUsuario','UserController@pesquisarUsuario')->name('pesquisarUsuario');
		Route::post('/homeMP/cadastro_usuario/pesquisarUsuario','UserController@pesquisarUsuario')->name('pesquisarUsuario');
		////

		//RH3
		Route::get('/home/visualizarMPS/aprovadasMPs/acessoRH3/{id}/acesso','AcessoRH3Controller@acessoRH3')->name('acessoRH3');
		Route::get('/home/visualizarMPS/aprovadasMPs/acessoRH3/{id}/desabilita','AcessoRH3Controller@acessoRH3Desabilita')->name('acessoRH3Desabilita');
		///

		//D??vidas
		Route::get('/duvidas','MPController@duvidas')->name('duvidas');
		Route::get('/duvidasVagas','VagaController@duvidasVagas')->name('duvidasVagas');
		Route::get('/duvidasPD','ProgramaDegrauController@duvidasPD')->name('duvidasPD');
});

?>