<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Unidade;
use App\Model\Cargos;
use App\Model\Gestor;
use App\Model\CentroCusto;
use App\Model\Admissao;
use App\Model\Demissao;
use App\Model\Alteracao_Funcional;
use App\Model\AdmissaoRPA;
use App\Model\Aprovacao;
use App\Model\Justificativa;
use App\Model\Plantao;
use App\Model\AdmissaoHCP;
use App\Model\AdmissaoSalariosUnidades;
use App\Model\CargosRPA;
use App\Model\Loggers;
use App\Model\MP;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use DB;
use \PDF;
use Barryvdh\DomPDF\Facade;
use App\Model\Vaga;
use Validator;
use Carbon\Carbon;
use Throwable;

class MPController extends Controller
{
	//Tela Inicial da MP
	public function inicioMP(){
		$unidades  = Unidade::all();
		$mps 	   = MP::all();
		$aprovacao = Aprovacao::all();
		$gestores  = Gestor::all();
		return view('/welcome', compact('unidades','mps','aprovacao','gestores'));
	}

	//Tela de cadastro da MP//
	public function cadastroMPAdmissao($id_unidade)
	{
		$unidade  = Unidade::where('id', $id_unidade)->get();
		$unidades = Unidade::all();
		$email 	  = Auth::user()->email; 
		$gestores = MPController::retornarGestor($id_unidade);
		$cargos   = Cargos::orderBy('nome','ASC')->get();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		return view('indexAdmissao', compact('unidade','gestores','unidades','email','cargos','centro_custos','setores','centro_custo_nv'));
	}

	//Salvar MP//
	public function storeAdmissaoMP($id_unidade, Request $request)
	{ 
		try {
			$input   = $request->all(); 	
			$unidade = Unidade::where('id',$id_unidade)->get();
			$input['inativa'] 	 = 0;
			$input['unidade_id'] = $id_unidade;		
			$aprovada     = 0;
			$dataEmissao  = date('d-m-Y', strtotime('now'));
			$dataP 		  = $input['data_prevista'];
			$dataPrevista = date('d-m-Y', strtotime($dataP));
			$gestores 		 = MPController::retornarGestor($id_unidade);
			$unidades 		 = Unidade::all();
			$cargos   		 = Cargos::all();
			$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
			$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
			$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
			$validator = Validator::make($request->all(), [
				'local_trabalho' 			=> 'required|max:255',
				'solicitante'    			=> 'required|max:255',
				'nome' 			 			=> 'required|max:255',	
				'gestor_id' 	 			=> 'required|integer',
				'departamento' 	 			=> 'required|max:255',
				'data_emissao' 	 			=> 'required|date',
				'data_prevista'  			=> 'required|date',
				'cargo' 					=> 'required|max:255',
				'salario'  					=> 'required',
				'horario_trabalho' 			=> 'required|max:255',
				'escala_trabalho' 			=> 'required|max:255',
				'centro_custo' 				=> 'required|max:255',
				'jornada' 					=> 'required|max:255',
				'turno' 					=> 'required|max:255',
				'tipo' 						=> 'required|max:255',
				'motivo' 					=> 'required|max:255',
				'possibilidade_contratacao' => 'required|max:255',
				'necessidade_email' 		=> 'required|max:255',
				'descricao'					=> 'required|max:5000',
				'impacto_financeiro'		=> 'required'
			]);
			if ($validator->fails()) {
				return view('indexAdmissao', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			} else {
				if($input['horario_trabalho'] == "0") {
					if($input['horario_trabalho2'] == ""){
						$validator = "Informe qual é o Horário de Trabalho!";
						return view('indexAdmissao', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						$input['horario_trabalho'] = $input['horario_trabalho2'];
					}
				}
				if($input['escala_trabalho'] == "outra") {
					if($input['escala_trabalho6'] == ""){
						$validator = "Informe qual é a Escala de Trabalho!";
						return view('indexAdmissao', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						$input['escala_trabalho'] = $input['escala_trabalho6'];
					}
				}
				if($input['motivo'] != "substituicao_definitiva") {
					$input['motivo2'] = NULL;
				} else {
					if($input['motivo6'] == ""){
						$validator = "Informe qual é o Funcionário que vai ser substituído!";
						return view('indexAdmissao', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						$input['motivo2'] = $input['motivo6'];
					}
				}
				if($input['outras_verbas'] == "") {
					$input['outras_verbas'] = 0;
				} 
				$missing = array();
					for($a = 1; $a <= 5; $a++){
						if(!empty($input['g_'.$a])){
							$missing[] = $a;
						}
					}
					if( is_array($missing) && count($missing) > 0 ) {
						$result = '';
						$total = count($missing) - 1;
						for($i = 0; $i <= $total; $i++){ 
							$result .= $missing[$i];
							if($i < $total)
								$result .= ", ";
						}
					} else {
						$result = "";
					}
				$input['gratificacoes'] = $result;
				$input['unidade_id']    = $id_unidade;
				$unidades 			    = Unidade::all();
				$qtdU 				    = sizeof($unidades);
				$input['data_emissao']  = date('Y-m-d',(strtotime($dataEmissao)));
				for($i = 1; $i <= $qtdU; $i++) {
					if($id_unidade == $i) {
						$idU   = $input['unidade_id'];
						$mp1   = DB::table('mp')->where('unidade_id', $id_unidade)->max('ordem');
						$mps   = MP::where('unidade_id',$id_unidade)->get();
						$qtd1  = sizeof($mps);
						$sigla = Unidade::where('id',$id_unidade)->get();
						$sigla = $sigla[0]->sigla;
						$va    = 0;
						$hoje  = date('Y',(strtotime('now')));
						if($qtd1 == 0){
							$input['numeroMP'] = $sigla.'1/'.$hoje;	
							$input['ordem']    = $mp1 + 1;								
						}else if($qtd1 > 0){
							$va 			   = $mp1+1;
							$input['numeroMP'] = $sigla.$va.'/'.$hoje;
							$input['ordem']    = $mp1 + 1;								
						}
					}
				}
				$input['concluida'] = 0;
				if($input['gestor_id'] == 25){
					$input['gestor_id'] = 61;   
				} else if($input['gestor_id'] == 15) {
					$input['gestor_id'] = 65;   
				} else if($input['gestor_id'] == 43) {
					$input['gestor_id'] = 60;
				} else {
					$input['gestor_id'] = $input['gestor_id'];
				}
				$input['acessorh3'] = 0;
				$input['usuario_acessorh3'] = '';
				$input['tipo_mp'] = 0;
				$input['gratificacoes'] = '';
				$input['hcpgestao'] = "NAO";
				$mp 			= MP::create($input);
				$nome 		 	= $input['nome'];
				$unidade_id  	= $input['unidade_id'];
				$solicitante  	= $input['solicitante'];
				$numeroMP       = $input['numeroMP'];
				$input['gestor_criador_mp'] = Auth::user()->id;
				$mps  			= MP::where('numeroMP', $numeroMP)->get();
				$idMP 			= $mps[0]->id;
				$input['mp_id'] = $idMP;	
				$admissao 	    = Admissao::create($input);
				$unidade        = Unidade::where('id', $id_unidade)->get();
				$justificativa  = Justificativa::create($input);
				if($input['gestor_id'] == 25){
					$idG = 61;   
				} else if($input['gestor_id'] == 15) {
					$idG = 65;   
				} else if($input['gestor_id'] == 43) {
					$idG = 60;
				} else {
					$idG = $input['gestor_id'];   
				}
				$idG 	= $input['gestor_id'];
				$gestor = Gestor::where('id', $idG)->get();
				$email  = $gestor[0]->email; /*
				Mail::send('email.emailMP', array($email), function($m) use ($email) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('Validar MP!');
					$m->to($email);
				});*/
				$unidades = Unidade::all();
				$idG 	  = $input['gestor_id'];
				$gestor   = Gestor::where('id', $idG)->get();				
				$a = 1;
				return view('home', compact('unidade','idMP','idG','gestor','unidades','unidade','a'));
			} 
		} catch(Throwable $e) {
			$validator = "Algo está errado!! Verifique os campos novamente!";
			return view('indexAdmissao', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}
	}	
	
	public function cadastroMPDemissao($id_unidade)
	{
		$unidade  = Unidade::where('id', $id_unidade)->get();
		$unidades = Unidade::all();
		$email 	  = Auth::user()->email; 
		$gestores = MPController::retornarGestor($id_unidade);
		return view('indexDemissao', compact('unidade','gestores','unidades','email'));
	}

	//Salvar MP//
	public function storeDemissaoMP($id_unidade, Request $request)
	{ 
		try {
			$input = $request->all(); 	
			$input['inativa']    = 0;
			$input['unidade_id'] = $id_unidade;
			$unidade 	  = Unidade::where('id',$id_unidade)->get();
			$aprovada     = 0;
			$dataEmissao  = date('d-m-Y', strtotime('now'));
			$dataP 		  = $input['data_prevista'];
			$dataPrevista = date('d-m-Y', strtotime($dataP));
			$gestores 		 = MPController::retornarGestor($id_unidade);
			$unidades 		 = Unidade::all();
			$validator = Validator::make($request->all(), [
				'local_trabalho'     => 'required|max:255',
				'solicitante'        => 'required|max:255',
				'nome' 			     => 'required|max:255',	
				'gestor_id' 	     => 'required|integer',
				'departamento' 	     => 'required|max:255',
				'data_emissao' 	     => 'required|date',
				'data_prevista'      => 'required|date',
				'tipo_desligamento'  => 'required|max:255',
				'aviso_previo' 		 => 'required|max:255',
				'ultimo_dia' 		 => 'required|max:255',
				'custo_recisao' 	 => 'required|max:255',
				'salario_bruto'		 => 'required|max:255',
				'impacto_financeiro' => 'required',
				'descricao'			 => 'required|max:5000'
			]);
			if ($validator->fails()) {    
				return view('indexDemissao', compact('unidade','gestores','unidades'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			} else {
				$unidades = Unidade::all();
				$qtdU 	  = sizeof($unidades);
				$input['data_emissao'] = date('Y-m-d',(strtotime($dataEmissao)));
				for($i = 1; $i <= $qtdU; $i++) {
					if($id_unidade == $i) {
						$idU   = $input['unidade_id'];
						$mp1   = DB::table('mp')->where('unidade_id', $id_unidade)->max('ordem');
						$mps   = MP::where('unidade_id',$id_unidade)->get();
						$qtd1  = sizeof($mps);
						$sigla = Unidade::where('id',$id_unidade)->get();
						$sigla = $sigla[0]->sigla;
						$va    = 0;
						$hoje  = date('Y',(strtotime('now')));
						if($qtd1 == 0){
							$input['numeroMP'] = $sigla.'1/'.$hoje;	
							$input['ordem']    = $mp1 + 1;								
						}else if($qtd1 > 0){
							$va = $mp1+1;
							$input['numeroMP'] = $sigla.$va.'/'.$hoje;
							$input['ordem']    = $mp1 + 1;												
						}
					}
				}
				$input['unidade_id'] = $id_unidade;
				$input['concluida']  = 0;
				if($input['gestor_id'] == 25){
					$input['gestor_id'] = 61;   
				} else if($input['gestor_id'] == 15) {
					$input['gestor_id'] = 65;   
				} else if($input['gestor_id'] == 43) {
					$input['gestor_id'] = 60;
				} else {
					$input['gestor_id'] = $input['gestor_id'];
				}
				$input['acessorh3'] = 0;
				$input['usuario_acessorh3'] = '';
				$input['hcpgestao'] = "NAO";
				$input['tipo_mp'] = 0;
				$mp 			= MP::create($input);
				$nome 		 	= $input['nome'];
				$unidade_id  	= $input['unidade_id'];
				$solicitante 	= $input['solicitante'];
				$numeroMP    	= $input['numeroMP'];
				$input['gestor_criador_mp'] = Auth::user()->id;
				$mps  			= MP::where('numeroMP', $numeroMP)->get();
				$idMP 		    = $mps[0]->id;
				$input['mp_id'] = $idMP;	
				$demissao 		= Demissao::create($input);
				$unidade 		= Unidade::where('id', $id_unidade)->get();
				$justificativa  = Justificativa::create($input);
				if($input['gestor_id'] == 25){
					$idG = 61;   
				} else if($input['gestor_id'] == 15) {
					$idG = 65;   
				} else if($input['gestor_id'] == 43) {
					$idG = 60;
				} else {
					$idG = $input['gestor_id'];   
				}
				$idG    = $input['gestor_id'];
				$gestor = Gestor::where('id', $idG)->get();
				$email  = $gestor[0]->email; /*
				Mail::send('email.emailMP', array($email), function($m) use ($email) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('Validar MP!');
					$m->to($email);
				}); */
				$unidades = Unidade::all();
				$idG 	  = $input['gestor_id'];
				$gestor   = Gestor::where('id', $idG)->get();				
				$a 		  = 1;
				return view('home', compact('unidade','idMP','idG','mps','unidades','unidade','a'));
			}
		} catch(Throwable $e) {
			$validator = "Algo está errado!! Verifique os campos novamente!";
			return view('indexDemissao', compact('unidade','gestores','unidades'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		} 
	}	

	public function cadastroMPAlteracao($id_unidade)
	{
		$unidade  = Unidade::where('id', $id_unidade)->get();
		$unidades = Unidade::all();
		$email 	  = Auth::user()->email; 
		$gestores = MPController::retornarGestor($id_unidade);
		$cargos = Cargos::orderBy('nome','ASC')->get();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		return view('indexAlteracao', compact('unidade','gestores','unidades','email','cargos','centro_custos','setores','centro_custo_nv'));
	}

	//Salvar MP//
	public function storeAlteracaoMP($id_unidade, Request $request)
	{ 
		try {
			$input       	     = $request->all(); 	
			$input['inativa']    = 0;
			$input['unidade_id'] = $id_unidade;
			$unidade 	  = Unidade::where('id',$id_unidade)->get();
			$aprovada     = 0;
			$dataEmissao  = date('d-m-Y', strtotime('now'));
			$dataP 		  = $input['data_prevista'];
			$dataPrevista = date('d-m-Y', strtotime($dataP));
			$gestores 		 = MPController::retornarGestor($id_unidade);
			$unidades 		 = Unidade::all();
			$cargos   		 = Cargos::all();
			$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
			$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
			$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
			$validator = Validator::make($request->all(), [
				'local_trabalho' => 'required|max:255',
				'solicitante'    => 'required|max:255',
				'nome' 			 => 'required|max:255',	
				'gestor_id' 	 => 'required|integer',
				'departamento' 	 => 'required|max:255',
				'data_emissao' 	 => 'required|date',
				'data_prevista'  => 'required|date',
				'setor' 	   	=> 'required|max:255',
				'cargo_atual'   => 'required|max:255',
				'cargo_novo'   	=> 'required|max:255',
				'salario_atual' => 'required',
				'motivo' 		=> 'required|max:255',
				'setor'			=> 'required|max:255',
				'cargo_atual'   => 'required|max:255',
				'cargo_novo'    => 'required|max:255',
				'horario_novo'  => 'required|max:255',
				'salario_atual' => 'required',
				'centro_custo_novo' => 'required|max:255',
				'motivo'		=> 'required|max:255',
				'descricao'     => 'required|max:5000',
				'impacto_financeiro' => 'required'
			]);
			if ($validator->fails()) {
				return view('indexAlteracao', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			} else {
				if(empty($input['remuneracao'])){
					$input['salario_novo'] = $input['salario_atual'];
				}
				$unidades = Unidade::all();
				$qtdU     = sizeof($unidades);
				$input['data_emissao'] = date('Y-m-d',(strtotime($dataEmissao)));
				for($i = 1; $i <= $qtdU; $i++) {
					if($id_unidade == $i) {
						$idU   = $input['unidade_id'];
						$mp1   = DB::table('mp')->where('unidade_id', $id_unidade)->max('ordem');
						$mps   = MP::where('unidade_id',$id_unidade)->get();
						$qtd1  = sizeof($mps);
						$sigla = Unidade::where('id',$id_unidade)->get();
						$sigla = $sigla[0]->sigla;
						$va    = 0;
						$hoje  = date('Y',(strtotime('now')));
						if($qtd1 == 0){
							$input['numeroMP'] = $sigla.'1/'.$hoje;	
							$input['ordem']    = $mp1 + 1;								
						}else if($qtd1 > 0){
							$va = $mp1+1;
							$input['numeroMP'] = $sigla.$va.'/'.$hoje;
							$input['ordem']    = $mp1 + 1;								
						}
					}
				}
				$input['unidade_id'] = $id_unidade;
				$input['concluida']  = 0;
				if($input['gestor_id'] == 25){
					$input['gestor_id'] = 61;   
				} else if($input['gestor_id'] == 15) {
					$input['gestor_id'] = 65;   
				} else if($input['gestor_id'] == 43) {
					$input['gestor_id'] = 60;
				} else {
					$input['gestor_id'] = $input['gestor_id'];
				}
				$input['acessorh3'] = 0;
				$input['usuario_acessorh3'] = '';
				$input['hcpgestao'] = "NAO";
				$input['tipo_mp'] = 0;
				$mp 		 	= MP::create($input);
				$nome 		 	= $input['nome'];
				$unidade_id  	= $input['unidade_id'];
				$solicitante 	= $input['solicitante'];
				$numeroMP    	= $input['numeroMP'];
				$input['gestor_criador_mp'] = Auth::user()->id;
				$mps  			= MP::where('numeroMP', $numeroMP)->get();
				$idMP 			= $mps[0]->id;
				$input['mp_id'] = $idMP;	
				$alteracao_func = Alteracao_Funcional::create($input);
				$unidade 	    = Unidade::where('id', $id_unidade)->get();
				$justificativa  = Justificativa::create($input);
				if($input['gestor_id'] == 25){
					$idG = 61;   
				} else if($input['gestor_id'] == 15) {
					$idG = 65;   
				} else if($input['gestor_id'] == 43) {
					$idG = 60;
				} else {
					$idG = $input['gestor_id'];   
				}
				$idG 	= $input['gestor_id'];
				$gestor = Gestor::where('id', $idG)->get();
				$email  = $gestor[0]->email; /*
				Mail::send('email.emailMP', array($email), function($m) use ($email) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('Validar MP!');
					$m->to($email);
				}); */
				$unidades 	   = Unidade::all();
				$idG 		   = $input['gestor_id'];
				$a = 1;
				return view('home', compact('unidade','idMP','idG','mps','unidades','unidade','a'));
			}
		} catch(Throwable $e) {
			$validator = "Algo está errado!! Verifique os campos novamente!";
			return view('indexAlteracao', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		} 
	}	

	public function cadastroMPRpa($id_unidade)
	{
		$unidade  = Unidade::where('id', $id_unidade)->get();
		$unidades = Unidade::all();
		$email 	  = Auth::user()->email; 
		$gestores = MPController::retornarGestor($id_unidade);
		$cargos = Cargos::orderBy('nome','ASC')->get();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade','like','%'.$id_unidade.'%')->orderBy('nome','ASC')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade','like','%'.$id_unidade.'%')->orderBy('nome','ASC')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade','like','%'.$id_unidade.'%')->orderBy('nome','ASC')->get();
		$cargos_rpa      = CargosRPA::all(); 
		return view('indexRpa', compact('unidade','gestores','unidades','email','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'));
	}

	function retornarGestor($id_unidade)
	{
		$idG = Auth::user()->id;
		$gest = Gestor::where('id',$idG)->get(); 
		$gIm  = $gest[0]->gestor_imediato; 
		if($gIm == "LUCIANA MELO DA SILVA"){
			$idI = 60;
			$gestores = Gestor::where('id',$idI)->get();
		} else if($gIm == "FILIPE BITU") { 
			$idI = 30;
			$gestores = Gestor::where('id',$idI)->get();
		} else if($gIm == "LUCIANA VENANCIO SANTOS SOUZA") {
			$idI = 61;
			$gestores = Gestor::where('id',$idI)->get();
		} else if($gIm == "NICOLE VIANA LEAL"){
			$idI = 215;
			$gestores = Gestor::where('id',$idI)->get();
		} else if($gIm == "LUIZ GONZAGA JUNIOR") {
			$idI = 160;
			$gestores = Gestor::where('id',$idI)->get();
		} else if($gIm == "ALEXANDRA SILVESTRE AMARAL PEIXOTO"){ 
			$idI = 5;
			$gestores = Gestor::where('id',$idI)->get();
		} else if($gIm == "JOAO CLAUDIO FERREIRA PEIXOTO") {
			$idI = 155;
			$gestores = Gestor::where('id',$idI)->get();
		} else if($gIm == "ADRIANA CAVALCANTI BEZERRA") {
			$idI = 167;
			$gestores = Gestor::where('id',$idI)->get();
		} else {
			$gestores = Gestor::where('nome',$gIm)->get();
		}
		if($idG == 29) {
			if($id_unidade == 3){
				$idI = 5;
				$gestores = Gestor::where('id',$idI)->get();
			} else if($id_unidade == 4){
				$idI = 1;
				$gestores = Gestor::where('id',$idI)->get();
			}
		}
		if($idG == 30) {
		    if($id_unidade == 2) {
		        $idI = 174;
		        $gestores = Gestor::where('id',$idI)->get();
		    } else if($id_unidade == 9) {
		        $idI = 183;
		        $gestores = Gestor::where('id',$idI)->get();
		    } else {
		        $idI = 61;
		        $gestores = Gestor::where('id',$idI)->get();
		    }
		}
		if($idG == 65 || $idG == 183) {
			$idI = 30;
		    $gestores = Gestor::where('id',$idI)->get();
		}
		return $gestores;
	}
	
	//Salvar MP//
	public function storeRpaMP($id_unidade, Request $request)
	{ 
		try {
			$input               = $request->all(); 	
			$input['inativa']    = 0;
			$input['unidade_id'] = $id_unidade;
			$unidade 	  = Unidade::where('id',$id_unidade)->get();
			$aprovada     = 0;
			$dataEmissao  = date('d-m-Y', strtotime('now'));
			$dataP 		  = $input['data_prevista'];
			$dataPrevista = date('d-m-Y', strtotime($dataP));
			$unidades 		 = Unidade::all();
			$cargos   		 = Cargos::all();
			$gestores 		 = MPController::retornarGestor($id_unidade);
			$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
			$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
			$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
			$cargos_rpa      = CargosRPA::all();
			$validator = Validator::make($request->all(), [
				'local_trabalho' => 'required|max:255',
				'solicitante'    => 'required|max:255',
				'nome' 			 => 'required|max:255',	
				'gestor_id' 	 => 'required|integer',
				'departamento' 	 => 'required|max:255',
				'data_emissao' 	 => 'required|date',
				'data_prevista'  => 'required|date',
				'cargo' 					=> 'required|max:255',
				'salario'  					=> 'required',
				'horario_trabalho' 			=> 'required|max:255',
				'escala_trabalho' 			=> 'required|max:255',
				'centro_custo' 				=> 'required|max:255',
				'jornada' 					=> 'required|max:255',
				'turno' 					=> 'required|max:255',
				'motivo' 					=> 'required|max:255',
				'possibilidade_contratacao' => 'required|max:255',
				'necessidade_email' 		=> 'required|max:255',
				'valor_plantao'             => 'required',
				'valor_pago_plantao'        => 'required',
				'quantidade_plantao'		=> 'required',
				'substituto'				=> 'required|max:255',
				'descricao'                 => 'required|max:1000',
				'impacto_financeiro'		=> 'required'
			]);
			if ($validator->fails()) {
				return view('indexRpa', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			} else {
				if($input['horario_trabalho'] == "0"){
					if($input['horario_trabalho2'] == ""){
						$validator = "Informe qual é o Horário de Trabalho!";
						return view('indexRpa', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						$input['horario_trabalho'] = $input['horario_trabalho2'];
					}
				}
				if($input['escala_trabalho'] == "outra"){
					if($input['escala_trabalho6'] == ""){
						$validator = "Informe qual é a Escala de Trabalho!";
						return view('indexRpa', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						$input['escala_trabalho'] = $input['escala_trabalho6'];
					}
				}
				if($input['motivo'] != "substituicao_definitiva"){
					$input['motivo2'] = NULL;
				} else {
					if($input['motivo2'] == ""){
						$validator = "Informe qual é o Funcionário que vai ser substituído!";
						return view('indexRpa', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} 
				}
				if($input['qtdDias'] == 'Data Inválida' || $input['qtdDias'] > 31) {
					$validator = "Período máximo de RPA são 31 dias!";
					return view('indexRpa', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}	
				if($input['outras_verbas'] == ""){
					$input['outras_verbas'] = 0.00;
				}
				$input['periodo_inicio'] = date('Y-m-d', strtotime($input['mes_ano']));
				$input['periodo_fim']    = date('Y-m-d', strtotime($input['mes_ano2']));
				$input['unidade_id']     = $id_unidade;
				$unidades 			     = Unidade::all();
				$qtdU 				     = sizeof($unidades);
				$input['data_emissao']   = date('Y-m-d',(strtotime($dataEmissao)));
				for($i = 1; $i <= $qtdU; $i++) {
					if($id_unidade == $i) {
						$idU   = $input['unidade_id'];
						$mp1   = DB::table('mp')->where('unidade_id', $id_unidade)->max('ordem');
						$mps   = MP::where('unidade_id',$id_unidade)->get();
						$qtd1  = sizeof($mps);
						$sigla = Unidade::where('id',$id_unidade)->get();
						$sigla = $sigla[0]->sigla;
						$va    = 0;
						$hoje  = date('Y',(strtotime('now')));
						if($qtd1 == 0){
							$input['numeroMP'] = $sigla.'1/'.$hoje;	
							$input['ordem']    = $mp1 + 1;								
						}else if($qtd1 > 0){
							$va 			   = $mp1+1;
							$input['numeroMP'] = $sigla.$va.'/'.$hoje;
							$input['ordem']    = $mp1 + 1;								
						}
					}
				}
				$input['concluida'] = 0;
				if($input['gestor_id'] == 25){
					$input['gestor_id'] = 61;   
				} else if($input['gestor_id'] == 15) {
					$input['gestor_id'] = 65;   
				} else if($input['gestor_id'] == 43) {
					$input['gestor_id'] = 60;
				} else {
					$input['gestor_id'] = $input['gestor_id'];
				}
				$input['acessorh3'] = 0;
				$input['usuario_acessorh3'] = '';
				$input['hcpgestao'] = "NAO";
				$input['tipo_mp']   = 0;
				$mp 			= MP::create($input);
				$nome 		 	= $input['nome'];
				$unidade_id  	= $input['unidade_id'];
				$solicitante  	= $input['solicitante'];
				$numeroMP       = $input['numeroMP'];
				$input['gestor_criador_mp'] = Auth::user()->id;
				$mps  			= MP::where('numeroMP', $numeroMP)->get();
				$idMP 			= $mps[0]->id;
				$input['mp_id'] = $idMP;
				$input['departamento'] = $input['setor_plantao'];	
				$admissao 	    = AdmissaoRPA::create($input);
				$unidade        = Unidade::where('id', $id_unidade)->get();
				$justificativa  = Justificativa::create($input);
				if($input['gestor_id'] == 25){
					$idG = 61;   
				} else if($input['gestor_id'] == 15) {
					$idG = 65;   
				} else if($input['gestor_id'] == 43) {
					$idG = 60;
				} else {
					$idG = $input['gestor_id'];   
				}
				$idG 	= $input['gestor_id'];
				$gestor = Gestor::where('id', $idG)->get();
				$email  = $gestor[0]->email; /*
				Mail::send('email.emailMP', array($email), function($m) use ($email) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('Validar MP!');
					$m->to($email);
				});*/
				$unidades = Unidade::all();
				$idG 	  = $input['gestor_id'];
				$gestor   = Gestor::where('id', $idG)->get();				
				$a = 1;
				return view('home', compact('unidade','idMP','idG','mps','gestor','unidades','a'));
			}
		} catch(Throwable $e) {
			$validator = "Algo está errado!! Verifique os campos novamente!";
			return view('indexRpa', compact('unidade','gestores','unidades','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}   
	}	

	//GErar PDF
	public function mpPDF($idG, $idMP)
	{
		try {
			$unidades = Unidade::all();
			$admissao = Admissao::where('mp_id', $idMP)->get(); 
			$demissao = Demissao::where('mp_id', $idMP)->get();
			$alteracaoF    = Alteracao_Funcional::where('mp_id', $idMP)->get();
			$justificativa = Justificativa::where('mp_id', $idMP)->get();	
			$aprovacao     = Aprovacao::where('mp_id', $idMP)->get();		
			$gestor  = Gestor::where('id', $idG)->get();				
			$mps     = MP::where('id', $idMP)->get();
			$idU     = $mps[0]->unidade_id;
			$unidade = Unidade::where('id', $idU)->get();
			$pdf     = PDF::loadView('pdf.mpdf', compact('mps','gestor','unidades','unidade','admissao','demissao','alteracaoF','justificativa','aprovacao'));
			$pdf->setPaper('A4', 'landscape');
			return $pdf->download('mp.pdf');
		} catch(Throwable $e) {
			$validator = "Algo está errado!! Verifique os campos novamente!";
		}  
	}
	
	// Tela para Alterar MP de Alteração Funcional //
	public function alterarMPAlteracao($id, $id_alt) {
		try {
			$gestores = Gestor::all();
			$unidades = Unidade::all();
			$mps = MP::where('id',$id)->get();
			$justificativa = Justificativa::where('mp_id', $mps[0]->id)->get();
			$solicitante = $mps[0]->solicitante;
			$solic   = Gestor::where('nome',$solicitante)->get();
			$gestor  = $solic[0]->gestor_imediato;
			$gestor  = Gestor::where('nome', $gestor)->get();
			$unidade = $mps[0]->unidade_id;
			$unidade = Unidade::where('id',$unidade)->get();
			$alteracaoF = Alteracao_Funcional::where('mp_id',$mps[0]->id)->get();
			$idA  = $id_alt;
			$idMP = $id;
			$cargos = Cargos::all();
			$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade','like','%'.$unidade[0]->id.'%')->get();
			$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade','like','%'.$unidade[0]->id.'%')->get();
			$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade','like','%'.$unidade[0]->id.'%')->get();
			return view('alterarMPAlteracao', compact('unidade','gestores','unidades','mps','alteracaoF','idA','idMP','centro_custos','setores','centro_custo_nv','cargos','justificativa','gestor'));
		} catch(Throwable $e) {
			return view('welcomeErro');
		}  
	}

	// Alterar MP de Alteração //
	public function updateMPAlteracao($id, $id_alt, Request $request){
		try {
			$input   = $request->all(); 
			$mps     = MP::where('id',$id)->get();
			$unidade = $mps[0]->unidade_id;
			$unidade = Unidade::where('id',$unidade)->get();
			$cargos  = Cargos::all();
			$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
			$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
			$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
			$dataE = $input['data_emissao'];
			$dataP = $input['data_prevista'];
			$dataEmissao   = date('d-m-Y', strtotime($dataE));
			$dataPrevista  = date('d-m-Y', strtotime($dataP));
			$mp            = MP::where('id',$id)->get();
			$gestores      = MPController::retornarGestor($mp[0]->unidade_id);
			$unidades 	   = Unidade::all();
			$justificativa = Justificativa::where('mp_id', $mps[0]->id)->get();
			$solicitante   = $mps[0]->solicitante;
			$solic   	   = Gestor::where('nome',$solicitante)->get();
			$gestor  	   = $solic[0]->gestor_imediato;
			$gestor  	   = Gestor::where('nome', $gestor)->get();
			$alteracaoF    = Alteracao_Funcional::where('mp_id',$mps[0]->id)->get();
			$idA 		   = $id_alt;
			$idMP		   = $id;
			$aprovacao     = Aprovacao::where('mp_id',$id)->get();
			$validator = Validator::make($request->all(), [
					'setor' 	   		=> 'required|max:255',
					'cargo_novo'   		=> 'required|max:255',
					'horario_novo' 		=> 'required|max:255',
					'salario_atual' 	=> 'required',
					'salario_novo' 		=> 'required',
					'centro_custo_novo' => 'required|max:255',
					'motivo' 			=> 'required|max:255',
					'nome'				=> 'required|max:255',
					'departamento'      => 'required|max:255',
					'data_prevista'     => 'required'
			]);
			if ($validator->fails()) {
				$mps = MP::where('id',$id)->get();
				$unidade = $mps[0]->unidade_id;
				$unidade = Unidade::where('id',$unidade)->get();
				return view('alterarMPAlteracao', compact('unidade','gestores','unidades','mps','alteracaoF','idA','idMP','aprovacao','justificativa','gestor','solicitante','cargos','centro_custos','setores','centro_custo_nv'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			} else {
				$input['acesssorh3'] = 0;
				$input['usuario_acessorh3'] = '';
				if(!empty($input['sim_impacto']) == "on") {
					$input['impacto_financeiro'] = 'sim';
				} else if (!empty($input['nao_impacto']) == "on") {
					$input['impacto_financeiro'] = 'nao';
				}
				$alteracaoF    = Alteracao_Funcional::find($id_alt);
				$alteracaoF->update($input);
				$mp 		   = MP::find($id);
				$mp->update($input);
				$J   		   = Justificativa::where('mp_id', $id)->get();
				$idJ 		   = $J[0]->id; 
				$justificativa = Justificativa::find($idJ);
				$justificativa->update($input);
				$mps 		   = MP::where('id', $id)->get();
				$solicitante   = $mps[0]->solicitante;
				$solic         = Gestor::where('nome',$solicitante)->get();
				$gestor   	   = $solic[0]->gestor_imediato;
				$gestor   	   = Gestor::where('nome', $gestor)->get();
				$gestores 	   = Gestor::all();
				$unidades 	   = Unidade::all();
				$idU 		   = $mps[0]->unidade_id;
				$unidade 	   = Unidade::where('id', $idU)->get();
				$alteracaoF    = Alteracao_Funcional::where('mp_id',$id)->get();
				$justificativa = Justificativa::where('mp_id', $id)->get();
				$aprovacao 	   = Aprovacao::where('mp_id',$id)->get();
				if(Auth::user()->id == 30) {
					$input['acao']    = 'alterar_alteracao_funcional_mp_'.$id;
					$input['user_id'] = Auth::user()->id;
					$logger = Loggers::create($input);
				}
				$validator = "Alteração Funcional Alterada com sucesso!";
				return view('index_', compact('mps','gestores','unidades','unidade','alteracaoF','justificativa','aprovacao','gestor'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		} catch(Throwable $e) {
			$mps     = MP::where('id',$id)->get();
			$solicitante   = $mps[0]->solicitante;
			$solic   	   = Gestor::where('nome',$solicitante)->get();
			$gestor  	   = $solic[0]->gestor_imediato;
			$gestor  	   = Gestor::where('nome', $gestor)->get();
			$validator = "Algo está errado!! Verifique os campos novamente!";
			return view('alterarMPAlteracao', compact('unidade','gestores','unidades','mps','alteracaoF','idA','idMP','aprovacao','justificativa','gestor','solicitante','cargos','centro_custos','setores','centro_custo_nv'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}   
	}
	
	//Voltar para o fluxo - Concluir Correção MP Alteração
	public function salvarMPAlteracao($id, $idG, Request $request){
		try {
			$input 	  = $request->all();
			$mp 	  = MP::where('id',$id)->get();
			$idMP 	  = $id;  
			$idU      = $mp[0]->unidade_id;
			$unidade  = Unidade::where('id', $idU)->get();
			$numeroMP = $mp[0]->numeroMP;
			$gestor   = Gestor::where('id', $idG)->get();
			$email 	  = $gestor[0]->email;
			DB::statement('UPDATE mp SET gestor_id = '.$idG.' WHERE id = '.$id.';');
			/*Mail::send([], [], function($m) use ($email,$numeroMP,$nome) {
				$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
				$m->subject('MP - '.$numeroMP.' Alterada!');
				$m->setBody('A MP: '. $numeroMP.' foi alterada por: '.$nome.' e precisa da sua validação! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
				$m->to($email);
			});*/
			$a = 0;
			return view('home', compact('unidade','idMP','idG','a'));
		} catch(Throwable $e) {
			return view('welcomeErro');
		}
	}
	
	// Tela para Alterar MP de Demissão //
	public function alterarMPDemissao($id, $id_dem) {
		try {
			$gestores = Gestor::all();
			$unidades = Unidade::all();
			$mps = MP::where('id',$id)->get();
			$justificativa = Justificativa::where('mp_id', $mps[0]->id)->get();
			$solicitante = $mps[0]->solicitante;
			$solic   = Gestor::where('nome',$solicitante)->get();
			$gestor  = $solic[0]->gestor_imediato;
			$gestor  = Gestor::where('nome', $gestor)->get();
			$unidade = $mps[0]->unidade_id;
			$unidade = Unidade::where('id',$unidade)->get();
			$demissao = Demissao::where('mp_id',$mps[0]->id)->get();
			$idA  = $id_dem;
			$idMP = $id;
			return view('alterarMPDemissao', compact('unidade','gestores','unidades','mps','demissao','idA','idMP','justificativa','gestor'));
		} catch(Throwable $e) {
			return view('welcomeErro');
		} 
	}

	// Alterar MP de Demissão //
	public function updateMPDemissao($id, $id_dem, Request $request){
		try {
			$input = $request->all(); 
			$dataE = $input['data_emissao'];
			$dataP = $input['data_prevista'];
			$dataEmissao   = date('d-m-Y', strtotime($dataE));
			$dataPrevista  = date('d-m-Y', strtotime($dataP));
			$mp 		   = MP::where('id',$id)->get();
			$gestores      = MPController::retornarGestor($mp[0]->unidade_id);
			$unidades  	   = Unidade::all();
			$mps 		   = MP::where('id',$id)->get();
			$justificativa = Justificativa::where('mp_id', $mps[0]->id)->get();
			$solicitante   = $mps[0]->solicitante;
			$solic   	   = Gestor::where('nome',$solicitante)->get();
			$gestor  	   = $solic[0]->gestor_imediato;
			$gestor  	   = Gestor::where('nome', $gestor)->get();
			$unidade 	   = $mps[0]->unidade_id;
			$unidade 	   = Unidade::where('id',$unidade)->get();
			$demissao 	   = Demissao::where('mp_id',$mps[0]->id)->get();
			$idA 		   = $id_dem;
			$idMP 		   = $id;
			$aprovacao     = Aprovacao::where('mp_id',$id)->get();
			if(strtotime($dataEmissao) >= strtotime($dataPrevista)){
				$validator = "Data Prevista não pode ser Menor ou Igual a Data de Emissão!";
				return view('alterarMPDemissao', compact('unidade','text','gestores','unidades','mps','demissao','idA','idMP','aprovacao','justificativa','gestor','solicitante'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
			
			$validator = Validator::make($request->all(), [
					'tipo_desligamento' => 'required|max:255',
					'aviso_previo' 		=> 'required|max:255',
					'ultimo_dia' 		=> 'required|max:255',
					'custo_recisao' 	=> 'required|max:255',
					'nome'  			=> 'required|max:225',
					'departamento'      => 'required|max:255',
					'data_prevista'     => 'required',
					'descricao'     	=> 'required|max:255'
			]);
			if ($validator->fails()) {
				return view('alterarMPDemissao', compact('unidade','gestores','unidades','mps','demissao','idA','idMP','aprovacao','justificativa','gestor','solicitante'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			} else {
				$input['acesssorh3'] = 0;
				$input['usuario_acessorh3'] = '';
				if(!empty($input['sim_impacto']) == "on") {
					$input['impacto_financeiro'] = 'sim';
				} else if (!empty($input['nao_impacto']) == "on") {
					$input['impacto_financeiro'] = 'nao';
				}
				$demissao 	   = Demissao::find($id_dem);
				$demissao->update($input);
				$mp			   = MP::find($id);
				$mp->update($input);
				$J   		   = Justificativa::where('mp_id', $id)->get();
				$idJ 		   = $J[0]->id; 
				$justificativa = Justificativa::find($idJ);
				$justificativa->update($input);
				$mps 		   = MP::where('id', $id)->get();
				$solicitante   = $mps[0]->solicitante;
				$solic    	   = Gestor::where('nome',$solicitante)->get();
				$gestor   	   = $solic[0]->gestor_imediato;
				$gestor   	   = Gestor::where('nome', $gestor)->get();
				$gestores 	   = Gestor::all();
				$unidades 	   = Unidade::all();
				$idU 		   = $mps[0]->unidade_id;
				$unidade 	   = Unidade::where('id', $idU)->get();
				$demissao 	   = Demissao::where('mp_id',$id)->get();
				$justificativa = Justificativa::where('mp_id', $id)->get();
				$aprovacao 	   = Aprovacao::where('mp_id',$id)->get();
				if(Auth::user()->id == 30) {
					$input['acao']    = 'alterar_demissao_mp_'.$id;
					$input['user_id'] = Auth::user()->id;
					$logger = Loggers::create($input);
				}
				$validator 	   = "Demissão Alterada com sucesso!";
				return view('index_', compact('mps','gestores','unidades','unidade','demissao','justificativa','aprovacao','gestor'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		} catch(Throwable $e) {
			$validator = "Algo está errado!! Verifique os campos novamente!";
			return view('alterarMPDemissao', compact('unidade','gestores','unidades','mps','demissao','idA','idMP','aprovacao','justificativa','gestor','solicitante'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}  
	}

	//Voltar para o fluxo - Concluir Correção de MP Demissão
	public function salvarMPDemissao($id, $idG, Request $request){
		try {
			$input 	  = $request->all();
			$mp 	  = MP::where('id',$id)->get();
			$idMP 	  = $id;
			$idU      = $mp[0]->unidade_id; 
			$unidade  = Unidade::where('id', $idU)->get();
			$numeroMP = $mp[0]->numeroMP;
			$gestor   = Gestor::where('id', $idG)->get();
			$nome     = $mp[0]->solicitante;
			$email 	  = $gestor[0]->email; 
			DB::statement('UPDATE mp SET gestor_id = '.$idG.' WHERE id = '.$id.';');
			/*Mail::send([], [], function($m) use ($email,$numeroMP,$nome) {
				$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
				$m->subject('MP - '.$numeroMP.' Alterada!');
				$m->setBody('A MP: '. $numeroMP.' foi alterada por: '.$nome.' e precisa da sua validação! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
				$m->to($email);
			});*/
			$a = 0;
			return view('home', compact('unidade','idMP','idG','a'));
		} catch(Throwable $e) {
			return view('welcomeErro');
		} 
	}
	
	// Tela para Alterar MP de Admissão //
	public function alterarMPAdmissao($id, $id_adm) {
		try {
			$gestores = Gestor::all();
			$unidades = Unidade::all();
			$mps 	  = MP::where('id',$id)->get();
			$justificativa = Justificativa::where('mp_id', $mps[0]->id)->get();
			$solicitante   = $mps[0]->solicitante;
			$solic    = Gestor::where('nome',$solicitante)->get();
			$gestor   = $solic[0]->gestor_imediato;
			$gestor   = Gestor::where('nome', $gestor)->get();
			$unidade  = $mps[0]->unidade_id;
			$unidade  = Unidade::where('id',$unidade)->get();
			$admissao = Admissao::where('mp_id',$mps[0]->id)->get();
			$idA    = $id_adm;
			$idMP   = $id;
			$cargos = Cargos::all();
			$centro_custos = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
			return view('alterarMPAdmissao', compact('unidade','gestores','unidades','mps','admissao','idA','idMP','cargos','centro_custos','justificativa','gestor'));
		} catch(Throwable $e) {
			return view('welcomeErro');
		} 
	}
	
	// Alterar MP de Admissão //
	public function updateMPAdmissao($id, $id_adm, Request $request){
		try {
			$input 		   = $request->all();
			$dataE 		   = $input['data_emissao'];
			$dataP 		   = $input['data_prevista'];
			$dataEmissao   = date('d-m-Y', strtotime($dataE));
			$dataPrevista  = date('d-m-Y', strtotime($dataP));
			$mp			   = MP::where('id',$id)->get();
			$gestores 	   = MPController::retornarGestor($mp[0]->unidade_id);
			$unidades 	   = Unidade::all();
			$mps 		   = MP::where('id',$id)->get();
			$justificativa = Justificativa::where('mp_id', $mps[0]->id)->get();
			$solicitante   = $mps[0]->solicitante;
			$solic   	   = Gestor::where('nome',$solicitante)->get();
			$gestor  	   = $solic[0]->gestor_imediato;
			$gestor  	   = Gestor::where('nome', $gestor)->get();
			$unidade 	   = $mps[0]->unidade_id;
			$unidade 	   = Unidade::where('id',$unidade)->get();
			$admissao 	   = Admissao::where('mp_id',$mps[0]->id)->get();
			$idA 		   = $id_adm;
			$idMP 		   = $id;
			$aprovacao 	   = Aprovacao::where('mp_id',$id)->get();
			$cargos   		 = Cargos::all();
			$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $mps[0]->unidade_id . '%')->get();
			$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $mps[0]->unidade_id . '%')->get();
			$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $mps[0]->unidade_id . '%')->get();
			$validator = Validator::make($request->all(), [
				'local_trabalho' 			=> 'required|max:255',
				'solicitante'    			=> 'required|max:255',
				'nome' 			 			=> 'required|max:255',	
				'departamento' 	 			=> 'required|max:255',
				'data_emissao' 	 			=> 'required|date',
				'data_prevista'  			=> 'required|date',
				'cargo' 					=> 'required|max:255',
				'salario'  					=> 'required',
				'horario_trabalho' 			=> 'required|max:255',
				'escala_trabalho' 			=> 'required|max:255',
				'centro_custo' 				=> 'required|max:255',
				'jornada' 					=> 'required|max:255',
				'turno' 					=> 'required|max:255',
				'tipo' 						=> 'required|max:255',
				'motivo' 					=> 'required|max:255',
				'possibilidade_contratacao' => 'required|max:255',
				'necessidade_email' 		=> 'required|max:255',
				'descricao'					=> 'required|max:5000',
				'impacto_financeiro'		=> 'required'
			]);
			if ($validator->fails()) {
				return view('indexAdmissao', compact('unidade','gestores','gestor','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			} else {
				if($input['horario_trabalho'] == "0") {
					if($input['horario_trabalho2'] == ""){
						$validator = "Informe qual é o Horário de Trabalho!";
						return view('indexAdmissao', compact('unidade','gestores','gestor','unidades','cargos','centro_custos','setores','centro_custo_nv'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						$input['horario_trabalho'] = $input['horario_trabalho2'];
					}
				}
				if($input['escala_trabalho'] == "outra") {
					if($input['escala_trabalho6'] == ""){
						$validator = "Informe qual é a Escala de Trabalho!";
						return view('indexAdmissao', compact('unidade','gestores','gestor','unidades','cargos','centro_custos','setores','centro_custo_nv'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						$input['escala_trabalho'] = $input['escala_trabalho6'];
					}
				}
				if($input['motivo'] != "substituicao_definitiva") {
					$input['motivo2'] = NULL;
				} else {
					if($input['motivo6'] == ""){
						$validator = "Informe qual é o Funcionário que vai ser substituído!";
						return view('indexAdmissao', compact('unidade','gestores','gestor','unidades','cargos','centro_custos','setores','centro_custo_nv'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						$input['motivo2'] = $input['motivo6'];
					}
				}
				if($input['outras_verbas'] == "") {
					$input['outras_verbas'] = 0;
				} 
				$missing = array();
				for($a = 1; $a <= 5; $a++){
					if(!empty($input['g_'.$a])){
						$missing[] = $a;
					}
				}
				if( is_array($missing) && count($missing) > 0 ) {
					$result = '';
					$total = count($missing) - 1;
					for($i = 0; $i <= $total; $i++){ 
						$result .= $missing[$i];
						if($i < $total)
							$result .= ", ";
					}
				} else {
					$result = "";
				}
				$input['gratificacoes'] = $result;
				$input['unidade_id']    = $mps[0]->unidade_id;
				$input['acesssorh3'] = 0;
				$input['usuario_acessorh3'] = '';	
				$admissao 	   = Admissao::find($id_adm);
				$admissao->update($input);
				$mp 		   = MP::find($id);
				$mp->update($input);
				$J   		   = Justificativa::where('mp_id', $id)->get();
				$idJ 		   = $J[0]->id; 
				$justificativa = Justificativa::find($idJ);
				$justificativa->update($input);
				$mps 		   = MP::where('id', $id)->get();
				$solicitante   = $mps[0]->solicitante;
				$solic    	   = Gestor::where('nome',$solicitante)->get();
				$gestor   	   = $solic[0]->gestor_imediato;
				$gestor  	   = Gestor::where('nome', $gestor)->get();
				$mps 		   = MP::where('id', $id)->get();
				$gestores 	   = Gestor::all();
				$unidades 	   = Unidade::all();
				$idU 		   = $mps[0]->unidade_id;
				$unidade 	   = Unidade::where('id', $idU)->get();
				$admissao 	   = Admissao::where('mp_id',$id)->get();
				$justificativa = Justificativa::where('mp_id', $id)->get();
				$aprovacao 	   = Aprovacao::where('mp_id',$id)->get();
				if(Auth::user()->id == 30) {
					$input['acao']    = 'alterar_admissao_mp_'.$id;
					$input['user_id'] = Auth::user()->id;
					$logger = Loggers::create($input);
				}
				$validator = "Admissão Alterada com sucesso!";
				return view('index_', compact('mps','gestores','gestor','unidades','unidade','admissao','justificativa','aprovacao','gestor'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		} catch(Throwable $e) {
			return view('indexAdmissao', compact('unidade','gestores','gestor','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}  
	}
	
	//Voltar para o fluxo - Concluir Correção MP de Admissão
	public function salvarMPAdmissao($id, $idG, Request $request){
		try {
			$input 	  = $request->all();
			$mp 	  = MP::where('id',$id)->get();
			$idMP 	  = $id;
			$idU      = $mp[0]->unidade_id;
			$unidade  = Unidade::where('id', $idU)->get();
			$numeroMP = $mp[0]->numeroMP;
			$gestor   = Gestor::where('id', $idG)->get();
			$nome     = $mp[0]->solicitante;
			$email 	  = $gestor[0]->email;
			DB::statement('UPDATE mp SET gestor_id = '.$idG.' WHERE id = '.$id.';');
			/*Mail::send([], [], function($m) use ($email,$numeroMP,$nome) {
				$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
				$m->subject('MP - '.$numeroMP.' Alterada!');
				$m->setBody('A MP: '. $numeroMP.' foi alterada por: '.$nome.' e precisa da sua validação! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
				$m->to($email);
			});*/
			$a = 0;
			return view('home', compact('unidade','idMP','idG','a'));
		} catch(Throwable $e) {
			return view('welcomeErro');
		}
	}

	// Tela para Alterar MP de Admissão //
	public function alterarMPAdmissaoRPA($id, $id_adm_rpa) {
		try {
			$gestores = Gestor::all();
			$unidades = Unidade::all();
			$mps = MP::where('id',$id)->get();
			$justificativa = Justificativa::where('mp_id', $mps[0]->id)->get();
			$solicitante = $mps[0]->solicitante;
			$solic   = Gestor::where('nome',$solicitante)->get();
			$gestor  = $solic[0]->gestor_imediato;
			$gestor  = Gestor::where('nome', $gestor)->get();
			$unidade = $mps[0]->unidade_id;
			$unidade = Unidade::where('id',$unidade)->get();
			$admissaoRPA = AdmissaoRPA::where('mp_id',$mps[0]->id)->get();
			$idA  = $id_adm_rpa;
			$idMP = $id;
			$cargos    		 = Cargos::all();
			$cargos_rpa 	 = CargosRPA::all();
			$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
			$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
			$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
			return view('alterarMPAdmissaoRPA', compact('unidade','gestores','unidades','mps','admissaoRPA','idA','idMP','cargos','cargos_rpa','centro_custos','justificativa','gestor','setores','centro_custo_nv'));
		} catch(Throwable $e) {
			return view('welcomeErro');
		}
	}

	// Alterar MP de Admissão RPA //
	public function updateMPAdmissaoRPA($id, $id_adm_rpa, Request $request){
		try {
			$input 		   = $request->all();
			$dataE 		   = $input['data_emissao'];
			$dataP 		   = $input['data_prevista'];
			$dataEmissao   = date('d-m-Y', strtotime($dataE));
			$dataPrevista  = date('d-m-Y', strtotime($dataP));
			$mp            = MP::where('id',$id)->get();
			$gestores      = MPController::retornarGestor($mp[0]->unidade_id);
			$unidades 	   = Unidade::all();
			$mps 		   = MP::where('id',$id)->get();
			$justificativa = Justificativa::where('mp_id', $mps[0]->id)->get();
			$solicitante   = $mps[0]->solicitante;
			$solic   	   = Gestor::where('nome',$solicitante)->get();
			$gestor  	   = $solic[0]->gestor_imediato;
			$gestor  	   = Gestor::where('nome', $gestor)->get();
			$unidade 	   = $mps[0]->unidade_id;
			$unidade 	   = Unidade::where('id',$unidade)->get();
			$admissaoRPA   = AdmissaoRPA::where('mp_id',$mps[0]->id)->get();
			$aprovacao 	   = Aprovacao::where('mp_id',$id)->get();
			$cargos    		 = Cargos::all();
			$cargos_rpa 	 = CargosRPA::all();
			$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
			$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
			$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
			$validator = Validator::make($request->all(), [
				'local_trabalho' => 'required|max:255',
				'solicitante'    => 'required|max:255',
				'nome' 			 => 'required|max:255',	
				'departamento' 	 => 'required|max:255',
				'data_emissao' 	 => 'required|date',
				'data_prevista'  => 'required|date',
				'cargo' 					=> 'required|max:255',
				'salario'  					=> 'required',
				'horario_trabalho' 			=> 'required|max:255',
				'escala_trabalho' 			=> 'required|max:255',
				'centro_custo' 				=> 'required|max:255',
				'jornada' 					=> 'required|max:255',
				'turno' 					=> 'required|max:255',
				'motivo' 					=> 'required|max:255',
				'possibilidade_contratacao' => 'required|max:255',
				'necessidade_email' 		=> 'required|max:255',
				'valor_plantao'             => 'required',
				'valor_pago_plantao'        => 'required',
				'quantidade_plantao'		=> 'required',
				'substituto'				=> 'required|max:255',
				'descricao'                 => 'required|max:1000',
				'impacto_financeiro'		=> 'required'
			]);
			if ($validator->fails()) {
				return view('indexRpa', compact('unidade','gestores','gestor','unidades','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			} else {
				if($input['horario_trabalho'] == "0"){
					if($input['horario_trabalho2'] == ""){
						$validator = "Informe qual é o Horário de Trabalho!";
						return view('indexRpa', compact('unidade','gestores','gestor','unidades','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						$input['horario_trabalho'] = $input['horario_trabalho2'];
					}
				}
				if($input['escala_trabalho'] == "outra"){
					if($input['escala_trabalho6'] == ""){
						$validator = "Informe qual é a Escala de Trabalho!";
						return view('indexRpa', compact('unidade','gestores','gestor','unidades','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						$input['escala_trabalho'] = $input['escala_trabalho6'];
					}
				}
				if($input['motivo'] != "substituicao_definitiva"){
					$input['motivo2'] = NULL;
				} else {
					if($input['motivo2'] == ""){
						$validator = "Informe qual é o Funcionário que vai ser substituído!";
						return view('indexRpa', compact('unidade','gestores','gestor','unidades','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} 
				}
				if($input['qtdDias'] == 'Data Inválida' || $input['qtdDias'] > 31) {
					$validator = "Período máximo de RPA são 31 dias!";
					return view('indexRpa', compact('unidade','gestores','gestor','unidades','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}	
				if($input['outras_verbas'] == ""){
					$input['outras_verbas'] = 0.00;
				}
				$input['periodo_inicio'] = date('Y-m-d', strtotime($input['mes_ano']));
				$input['periodo_fim']    = date('Y-m-d', strtotime($input['mes_ano2']));
				$input['unidade_id']     = $mps[0]->unidade_id;
				$unidades 			     = Unidade::all();
				$qtdU 				     = sizeof($unidades);
				$input['data_emissao']   = date('Y-m-d',(strtotime($dataEmissao)));
				for($i = 1; $i <= $qtdU; $i++) {
					if($mps[0]->unidade_id == $i) {
						$idU   = $input['unidade_id'];
						$mp1   = DB::table('mp')->where('unidade_id', $mps[0]->unidade_id)->max('ordem');
						$mps   = MP::where('unidade_id',$mps[0]->unidade_id)->get();
						$qtd1  = sizeof($mps);
						$sigla = Unidade::where('id',$mps[0]->unidade_id)->get();
						$sigla = $sigla[0]->sigla;
						$va    = 0;
						$hoje  = date('Y',(strtotime('now')));
						if($qtd1 == 0){
							$input['numeroMP'] = $sigla.'1/'.$hoje;	
							$input['ordem']    = $mp1 + 1;								
						}else if($qtd1 > 0){
							$va 			   = $mp1+1;
							$input['numeroMP'] = $sigla.$va.'/'.$hoje;
							$input['ordem']    = $mp1 + 1;								
						}
					}
				}
				$input['concluida'] = 0;
				if($input['gestor_id'] == 25){
					$input['gestor_id'] = 61;   
				} else if($input['gestor_id'] == 15) {
					$input['gestor_id'] = 65;   
				} else if($input['gestor_id'] == 43) {
					$input['gestor_id'] = 60;
				} else {
					$input['gestor_id'] = $input['gestor_id'];
				}
				$input['acessorh3'] = 0;
				$input['usuario_acessorh3'] = '';
				$input['hcpgestao'] 	 = "NAO";
				$input['tipo_mp']   	 = 0;
				$input['local_trabalho'] = $mps[0]->unidade_id;
				$input['gestor_id'] = Auth::user()->id;
				$input['mp_id'] = $id;
				$admissao 	   = AdmissaoRPA::find($id_adm_rpa);
				$admissao->update($input);
				$mp 		   = MP::find($id);
				$mp->update($input);
				$J   		   = Justificativa::where('mp_id', $id)->get();
				$idJ 		   = $J[0]->id; 
				$justificativa = Justificativa::find($idJ);
				$justificativa->update($input);
				$mps 		   = MP::where('id', $id)->get();
				$solicitante   = $mps[0]->solicitante;
				$solic    	   = Gestor::where('nome',$solicitante)->get();
				$gestor   	   = $solic[0]->gestor_imediato;
				$gestor  	   = Gestor::where('nome', $gestor)->get();
				$mps 		   = MP::where('id', $id)->get();
				$gestores 	   = Gestor::all();
				$unidades 	   = Unidade::all();
				$idU 		   = $mps[0]->unidade_id;
				$unidade 	   = Unidade::where('id', $idU)->get();
				$admissaoRPA   = AdmissaoRPA::where('mp_id',$id)->get();
				$justificativa = Justificativa::where('mp_id', $id)->get();
				$aprovacao 	   = Aprovacao::where('mp_id',$id)->get();
				$validator 	   = "Admissão RPA Alterada com sucesso!";
				return view('index_', compact('mps','gestores','gestor','unidades','unidade','admissaoRPA','justificativa','aprovacao','gestor','cargos_rpa'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		} catch(Throwable $e) {
			$validator = "Algo está errado!! Verifique os campos novamente!";
			return view('indexRpa', compact('unidade','gestores','gestor','unidades','cargos','centro_custos','setores','centro_custo_nv','cargos_rpa'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}  
	}
	
	public function salvarMPAdmissaoRPA($id, $idG, Request $request){
		try {
			$input 	  = $request->all();
			$mp 	  = MP::where('id',$id)->get();
			$idMP 	  = $id;
			$idU      = $mp[0]->unidade_id;
			$unidade  = Unidade::where('id', $idU)->get();
			$numeroMP = $mp[0]->numeroMP;
			$gestor   = Gestor::where('id', $idG)->get();
			$nome     = $mp[0]->solicitante;
			$email 	  = $gestor[0]->email;
			DB::statement('UPDATE mp SET gestor_id = '.$idG.' WHERE id = '.$id.';');
			/*Mail::send([], [], function($m) use ($email,$numeroMP,$nome) {
				$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
				$m->subject('MP - '.$numeroMP.' Alterada!');
				$m->setBody('A MP: '. $numeroMP.' foi alterada por: '.$nome.' e precisa da sua validação! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
				$m->to($email);
			});*/
			$a = 0;
			return view('home', compact('unidade','idMP','idG','a'));
		} catch(Throwable $e) {
			return view('welcomeErro');
		}
	}

	public function excluirMPs()
	{
		$mps = MP::where('solicitante',Auth::user()->name)->where('inativa',0)->paginate(7);
		$unidades = Unidade::all();
		return view('excluirMPs', compact('mps','unidades'));
	}

	public function excluirMP($id)
	{
		$mps     = MP::where('id', $id)->get();
		$idU     = $mps[0]->unidade_id;
		$unidade = Unidade::where('id',$idU)->get();
		$idG     = $mps[0]->solicitante;
		$gestor  = Gestor::where('nome',$idG)->get();
		$unidades = Unidade::all();
		return view('excluirMP', compact('mps','unidade','gestor','unidades'));
	}

	public function pesquisaMPsExclusao(Request $request)
	{
		try {
			$input = $request->all();
			$solicitante = Auth::user()->name;
			if(empty($input['unidade_id'])){ $input['unidade_id'] = 0;  }
			if(empty($input['pesq'])) { $input['pesq'] = ""; }
			if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
			$unidade_id = $input['unidade_id'];
			$pesq 	    = $input['pesq'];
			$pesq2      = $input['pesq2'];
			$funcao = Auth::user()->funcao;
			$unidades = Unidade::all();
			if($funcao == "Administrador" || Auth::user()->id == 198 || Auth::user()->id == 30) {
				if($pesq2 == "numero") {
					if($unidade_id == "0"){
						$mps = DB::table('mp')->where('mp.numeroMP','like','%'.$pesq.'%')->where('inativa',0)->paginate(7);
					} else {
						$mps = DB::table('mp')->where('mp.numeroMP','like','%'.$pesq.'%')->where('inativa',0)
									->where('mp.unidade_id',$unidade_id)->paginate(7);
					}
				} else if($pesq2 == "funcionario"){
					if($unidade_id == "0"){
						$mps = DB::table('mp')->where('mp.nome','like','%'.$pesq.'%')->where('inativa',0)->paginate(7);
					} else {
						$mps = DB::table('mp')->where('mp.nome','like','%'.$pesq.'%')->where('inativa',0)
									->where('mp.unidade_id',$unidade_id)->paginate(7);
					}
				} else if($pesq2 == "solicitante"){
					if($unidade_id == "0"){
						$mps = DB::table('mp')->where('mp.solicitante','like','%'.$pesq.'%')->where('inativa',0)->paginate(7);
					} else {
						$mps = DB::table('mp')->where('mp.solicitante','like','%'.$pesq.'%')->where('inativa',0)
									->where('mp.unidade_id',$unidade_id)->paginate(7);
					}
				} else if($pesq2 == ""){
					if($unidade_id == "0"){
						$mps = MP::where('inativa',0)->orderby('unidade_id','ASC')->paginate(7);
					} else {
						$mps = MP::where('unidade_id',$unidade_id)->where('inativa',0)->paginate(7);
					}
				}
			} else {
				if($pesq2 == "numero") {
					if($unidade_id == "0"){
						$mps = DB::table('mp')->where('mp.numeroMP','like','%'.$pesq.'%')
							->where('solicitante',$solicitante)->where('inativa',0)->paginate(7);
					} else {
						$mps = DB::table('mp')->where('mp.numeroMP','like','%'.$pesq.'%')->where('inativa',0)
						->where('solicitante',$solicitante)->where('mp.unidade_id',$unidade_id)->paginate(7);
					}
				} else if($pesq2 == "funcionario"){
					if($unidade_id == "0"){
						$mps = DB::table('mp')->where('mp.nome','like','%'.$pesq.'%')
							->where('solicitante',$solicitante)->where('inativa',0)->paginate(7);
					} else {
						$mps = DB::table('mp')->where('mp.nome','like','%'.$pesq.'%')->where('inativa',0)
							->where('solicitante',$solicitante)->where('mp.unidade_id',$unidade_id)->paginate(7);
					}
				} else if($pesq2 == ""){
					if($unidade_id == "0"){
						$mps = MP::where('inativa',0)->where('solicitante',$solicitante)->paginate(7);
					} else {
						$mps = MP::where('unidade_id',$unidade_id)->where('solicitante',$solicitante)
							->where('inativa',0)->paginate(7);
					}
				}
			} 
			return view('excluirMPs', compact('mps','unidade_id','pesq2','pesq','unidades'));
		} catch(Throwable $e) {
			$validator = "Algo está errado!! Verifique os campos novamente!";
			return view('excluirMPs', compact('mps','unidade_id','pesq2','pesq','unidades'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}  
	}

	public function deleteMP($id, Request $request)
	{
		try {
			$input = $request->all();
			$mp    = MP::where('id',$id)->get();
			$idMP  = $mp[0]->id;
			$aprovacao = Aprovacao::where('mp_id',$idMP)->get();
			$qtdAp 	   = sizeof($aprovacao);
			if($qtdAp > 0){
				DB::statement('delete from aprovacao where mp_id = '.$idMP);
			}
			$justificativa = Justificativa::where('mp_id',$idMP)->get();
			$qtdJust   	   = sizeof($justificativa);
			if($qtdJust > 0){
				DB::statement('delete from justificativa where mp_id = '.$idMP);
			}
			$admissao = Admissao::where('mp_id',$idMP)->get();
			$qtdAdm   = sizeof($admissao);
			if($qtdAdm > 0){
				DB::statement('delete from admissao where mp_id = '.$idMP);
			}
			$alteracaoF = Alteracao_Funcional::where('mp_id',$idMP)->get();
			$qtdAltF    = sizeof($alteracaoF);
			if($qtdAltF > 0){
				DB::statement('delete from alteracao_funcional where mp_id = '.$idMP);
			}
			$demissao = Demissao::where('mp_id',$idMP)->get();
			$qtdDem   = sizeof($demissao);
			if($qtdDem > 0){
				DB::statement('delete from demissao where mp_id = '.$idMP);
			}
			$admissaoRPA = AdmissaoRPA::where('mp_id',$idMP)->get();
			$qtdAdmRPA  = sizeof($admissaoRPA);
			if($qtdAdmRPA > 0){
				DB::statement('delete from admissao_rpa where mp_id = '.$idMP);
			} 
			DB::statement('delete from mp where id = '.$idMP);
			$mps = MP::where('id',0)->paginate(7);
			$loggers   = Loggers::create($input);
			$validator = "MP Excluída com sucesso!";
			$unidades  = Unidade::all();
			return view('excluirMPs', compact('mps','unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
		} catch(Throwable $e) {
			$validator = "Algo está errado!! Verifique os campos novamente!";
			return view('excluirMPs', compact('mps','unidades'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}  
	}

	public function duvidas()
	{
		return view('duvidas');
	}

	public function welcomeErro()
	{
		return view('welcomeErro');
	}

}