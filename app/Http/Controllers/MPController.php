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
use App\Model\Aprovacao;
use App\Model\Justificativa;
use App\Model\Plantao;
use App\Model\AdmissaoHCP;
use App\Model\AdmissaoSalariosUnidades;
use App\Model\Loggers;
use App\Model\MP;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use DB;
use \PDF;
use Barryvdh\DomPDF\Facade;
use App\Model\Vaga;
use Validator;

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
	public function cadastroMP($id_unidade, $i)
	{
		$unidade  = Unidade::where('id', $id_unidade)->get();
		$unidades = Unidade::all();
		$email 	  = Auth::user()->email; 
		$tipo_mp  = $i;
		$idG 	  = Auth::user()->id;
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
		} else if($gIm == "CINTHIA MARIA DE OLIVEIRA LIMA KOMURO"){
			$idI = 65;
			$gestores = Gestor::where('id',$idI)->get();
		} else if($gIm == "ALEXANDRA SILVESTRE AMARAL PEIXOTO"){ 
			$idI = 5;
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
		        $idI = 62;
		        $gestores = Gestor::where('id',$idI)->get();
		    }
		}
		if($idG == 65) {
			$idI = 30;
		    $gestores = Gestor::where('id',$idI)->get();
		}
		$cargos = Cargos::orderBy('nome','ASC')->get();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		return view('index', compact('unidade','gestores','tipo_mp','unidades','email','cargos','centro_custos','setores','centro_custo_nv'));
	}
	
	//Salvar MP//
	public function storeMP($id_unidade, Request $request)
	{ 
		$input        = $request->all(); 	
		$input['inativa'] = 0;
		$input['unidade_id'] = $id_unidade;
		if(!empty($input['sim_impacto']) == "on") {
			$input['impacto_financeiro'] = 'sim';
		} else if (!empty($input['nao_impacto']) == "on") {
			$input['impacto_financeiro'] = 'nao';
		}
		$unidade 	  = Unidade::where('id',$id_unidade)->get();
		$tipo_mp      = $input['tipo_mp'];
		$input['inativa'] = 0;
		$aprovada     = 0;
		$dataEmissao  = date('d-m-Y', strtotime('now'));
		$dataP 		  = $input['data_prevista'];
		$dataPrevista = date('d-m-Y', strtotime($dataP));
		$idG  = Auth::user()->id;
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
		} else if($gIm == "CINTHIA MARIA DE OLIVEIRA LIMA KOMURO"){
			$idI = 65;
			$gestores = Gestor::where('id',$idI)->get();
		} else if($gIm == "ALEXANDRA SILVESTRE AMARAL PEIXOTO"){ 
			$idI = 5;
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
		        $idI = 62;
		        $gestores = Gestor::where('id',$idI)->get();
		    }
		}
		if($idG == 65) {
			$idI = 30;
		    $gestores = Gestor::where('id',$idI)->get();
		}
		$unidades 		 = Unidade::all();
		$cargos   		 = Cargos::all();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
	
		if(strtotime($dataEmissao) == strtotime($dataPrevista)){
			$validator = "Data Prevista não pode ser Igual a Data de Emissão!";
			return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		} else if(strtotime($dataPrevista) < strtotime($dataEmissao)) {
			$validator = "Data Prevista não pode ser Menor que a Data de Emissão!";
			return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		}
		
		$validator = Validator::make($request->all(), [
			'local_trabalho' => 'required|max:255',
			'solicitante'    => 'required|max:255',
			'nome' 			 => 'required|max:255',	
			'gestor_id' 	 => 'required|integer',
			'departamento' 	 => 'required|max:255',
			'data_emissao' 	 => 'required|date',
			'data_prevista'  => 'required|date'
			
		]);
		if ($validator->fails()) {
			return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
        }
		
		if(!empty($input['tipo_mov1'])) {
			$validator = Validator::make($request->all(), [
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
				'necessidade_email' 		=> 'required|max:255'
			]);
			if ($validator->fails()) {
				return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
			} else {
				if($input['horario_trabalho'] == "0")
				{
					if($input['horario_trabalho2'] == ""){
						$validator = "Informe qual é o Horário de Trabalho!";
					    return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					    ->withErrors($validator)
                        ->withInput(session()->flashInput($request->input()));
					} else {
						$input['horario_trabalho'] = $input['horario_trabalho2'];
					}
				}
				if($input['escala_trabalho'] == "outra")
				{
					if($input['escala_trabalho6'] == ""){
						$validator = "Informe qual é a Escala de Trabalho!";
					    return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					    ->withErrors($validator)
                        ->withInput(session()->flashInput($request->input()));
					} else {
						$input['escala_trabalho'] = $input['escala_trabalho6'];
					}
				}
				if($input['motivo'] != "substituicao_definitiva")
				{
					$input['motivo2'] = NULL;
				}
				if($input['motivo'] == "substituicao_definitiva")
				{
					if($input['motivo6'] == ""){
						$validator = "Informe qual é o Funcionário que vai ser substituído!";
					    return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					    ->withErrors($validator)
                        ->withInput(session()->flashInput($request->input()));
					} else {
						$input['motivo2'] = $input['motivo6'];
					}
				}
				$input['qtd_mes'] = 0;
				if($input['tipo'] == "rpa")
				{
					$periodo_inicio = date('m/Y', strtotime($input['mes_ano']));
					$periodo_fim	= date('m/Y', strtotime($input['mes_ano2']));
					$arr  = explode('/',$periodo_inicio);
					$arr2 = explode('/',$periodo_fim);
					$mes1 = $arr[0];	
					$ano1 = $arr[1];
					$mes2 = $arr2[0];
					$ano2 = $arr2[1];
					$a1 = ($ano2 - $ano1)*12;
					$m1 = ($mes2 - $mes1)+1;
					$m3 = ($m1 + $a1);
					$input['qtd_mes'] = $m3;
					if(strtotime($periodo_inicio) > strtotime($periodo_fim)) {
						$validator = "Datas de RPA Inválidas!";
						return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						if($m3 > 3) {
							$validator = "Máximo 3 meses de RPA!";
							return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
								->withErrors($validator)
								->withInput(session()->flashInput($request->input()));
						}
					}

					$input['periodo_inicio'] = $periodo_inicio;
					$input['periodo_fim'] 	 = $periodo_fim;

					$missing = array();
					for($a = 1; $a <= 6; $a++){
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
				} else {
					$input['gratificacoes'] = 0;
				}
				if($input['descricao'] != "") {
					$input['unidade_id']   = $id_unidade;
					$unidades 			   = Unidade::all();
					$qtdU 				   = sizeof($unidades);
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

					if($tipo_mp == 1) {
						if($input['hcpgestao'] == "SIM") {
							if($input['gestor_id'] == 61) {
								$input['gestor_id'] = 30;
							} else {
								$input['gestor_id'] = 61;
							}
						} 
					} else {
						$input['hcpgestao'] = "NAO";
					}

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
				} else {
					$validator = "Informe a Justificativa!";
					return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
				}
				if($id_unidade == 1){
					$gestores = Gestor::where('funcao','=','rh')->where('gestor_sim',1)->get(); 
            	} else {
            		$gestores = DB::select("SELECT * FROM gestor WHERE (funcao = 'rh' OR funcao = 'gestor imediato') AND (unidade_id = 0 OR unidade_id = ".$id_unidade.")");
            	}
				$unidades      = Unidade::all();
				$admissao      = Admissao::where('mp_id', $idMP)->get(); 
				$demissao      = Demissao::where('mp_id', $idMP)->get();
				$alteracaoF    = Alteracao_Funcional::where('mp_id', $idMP)->get();
				$justificativa = Justificativa::where('mp_id', $idMP)->get();	
				$aprovacao 	   = Aprovacao::where('mp_id', $idMP)->get();		
				$idG 		   = $input['gestor_id'];
				$gestor 	   = Gestor::where('id', $idG)->get();				
				$a = 1;
				return view('home', compact('unidade','idMP','idG','mps','gestor','unidades','unidade','admissao','demissao','alteracaoF','justificativa','aprovacao','a'));
			}
		} else if (!empty($input['tipo_mov2'])) {
			$validator = Validator::make($request->all(), [
				'tipo_desligamento' => 'required|max:255',
				'aviso_previo' 		=> 'required|max:255',
				'ultimo_dia' 		=> 'required|max:255',
				'custo_recisao' 	=> 'required|max:255'
			]);
			if ($validator->fails()) {    
				return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
			} else {
				if($input['descricao'] != "") {
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
					if($tipo_mp == 1) {
						if($input['hcpgestao'] == "SIM") {
							if($input['gestor_id'] == 61) {
								$input['gestor_id'] = 30;
							} else {
								$input['gestor_id'] = 61;
							}
						} 
					} else {
						$input['hcpgestao'] = "NAO";
					}
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
				} else {
					$validator = "Informe a Justificativa!";
					return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
				}
            	$unidades 	   = Unidade::all();
				$admissao 	   = Admissao::where('mp_id', $idMP)->get(); 
				$demissao 	   = Demissao::where('mp_id', $idMP)->get();
				$alteracaoF    = Alteracao_Funcional::where('mp_id', $idMP)->get();
				$justificativa = Justificativa::where('mp_id', $idMP)->get();	
				$aprovacao 	   = Aprovacao::where('mp_id', $idMP)->get();		
				$idG 		   = $input['gestor_id'];
				$gestor = Gestor::where('id', $idG)->get();				
				$a = 1;
				return view('home', compact('unidade','idMP','idG','mps','gestor','unidades','unidade','admissao','demissao','alteracaoF','justificativa','aprovacao','a'));
			}
		} else if (!empty($input['tipo_mov3'])) { 
			$validator = Validator::make($request->all(), [
				'setor' 	   	=> 'required|max:255',
				'cargo_atual'   => 'required|max:255',
				'cargo_novo'   	=> 'required|max:255',
				'salario_atual' => 'required',
				'motivo' 		=> 'required|max:255'
			]);
			if ($validator->fails()) {
				return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
			} else {
				if($input['descricao'] != "") {
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
					if($tipo_mp == 1) {
						if($input['hcpgestao'] == "SIM") {
							if($input['gestor_id'] == 61) {
								$input['gestor_id'] = 30;
							} else {
								$input['gestor_id'] = 61;
							}
						} 
					} else {
						$input['hcpgestao'] = "NAO";
					}
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
				} else {
					$validator = "Informe a Justificativa!";
					return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
			
				}
				$unidades 	   = Unidade::all();
				$admissao 	   = Admissao::where('mp_id', $idMP)->get(); 
				$demissao 	   = Demissao::where('mp_id', $idMP)->get();
				$alteracaoF    = Alteracao_Funcional::where('mp_id', $idMP)->get();
				$justificativa = Justificativa::where('mp_id', $idMP)->get();	
				$aprovacao 	   = Aprovacao::where('mp_id', $idMP)->get();		
				$idG 		   = $input['gestor_id'];
				$gestor 	   = Gestor::where('id', $idG)->get();				
				$a = 1;
				return view('home', compact('unidade','idMP','idG','mps','gestor','unidades','unidade','admissao','demissao','alteracaoF','justificativa','aprovacao','a'));
			}
		} else if (!empty($input['tipo_mov4'])) {
			$validator = Validator::make($request->all(), [
				'setor_plantao' 	   => 'required|max:255',
				'cargo_plantao'   	   => 'required|max:255',
				'motivo_plantao'   	   => 'required|max:800',
				'substituto' 		   => 'required|max:255',
				'centro_custo_plantao' => 'required|max:255',
				'quantidade_plantao'   => 'required|max:255',
				'valor_plantao' 	   => 'required|max:255',
				'valor_pago_plantao'   => 'required|max:255'
			]);
			if ($validator->fails()) {
				return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
			} else {
				if($input['descricao'] != "") {
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
					if($tipo_mp == 1) {
						if($input['hcpgestao'] == "SIM") {
							if($input['gestor_id'] == 61) {
								$input['gestor_id'] = 30;
							} else {
								$input['gestor_id'] = 61;
							}
						} 
					} else {
						$input['hcpgestao'] = "NAO";
					}	
					$mp 		 	= MP::create($input);
					$nome 		 	= $input['nome'];
					$unidade_id  	= $input['unidade_id'];
					$solicitante 	= $input['solicitante'];
					$numeroMP    	= $input['numeroMP'];
					$input['gestor_criador_mp'] = Auth::user()->id;
					$mps  			= MP::where('numeroMP', $numeroMP)->get();
					$idMP 			= $mps[0]->id;
					$input['mp_id'] = $idMP;
					$plantao = Plantao::create($input);
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
				} else {
					$validator = "Informe a Justificativa!";
					return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
			
				}
				$unidades 	   = Unidade::all();
				$admissao 	   = Admissao::where('mp_id', $idMP)->get(); 
				$demissao 	   = Demissao::where('mp_id', $idMP)->get();
				$alteracaoF    = Alteracao_Funcional::where('mp_id', $idMP)->get();
				$plantao       = Plantao::where('mp_id', $idMP)->get();
				$justificativa = Justificativa::where('mp_id', $idMP)->get();	
				$aprovacao 	   = Aprovacao::where('mp_id', $idMP)->get();		
				$idG 		   = $input['gestor_id'];
				$gestor 	   = Gestor::where('id', $idG)->get();				
				$a = 1;
				return view('home', compact('unidade','idMP','idG','mps','gestor','unidades','unidade','admissao','demissao','alteracaoF','plantao','justificativa','aprovacao','a'));
			}
		} else if(!empty($input['tipo_mov5'])) {
			$validator = Validator::make($request->all(), [
				'jornadahcp' 	   			=> 'required|max:255',
				'tipohcp'   	   			=> 'required|max:255',
				'motivohcp'   	   			=> 'required|max:255',
				'possibilidade_contratacao' => 'required|max:255',
				'necessidade_email' 		=> 'required|max:255',
			]);
			if ($validator->fails()) {
				return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
			} else {
				if($input['descricao'] != "") {
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
					$input['gestor_id'] = 61;
					$input['acessorh3'] = 0;
					$input['usuario_acessorh3'] = '';
					if($tipo_mp == 1) {
						if($input['hcpgestao'] == "SIM") {
							if(Auth::user()->id == 61) {
								$input['gestor_id'] = 30;
							} else {
								$input['gestor_id'] = 61;
							}
						} 
					} else {
						$input['hcpgestao'] = "NAO";
					}
					$mp 		 	= MP::create($input);
					$nome 		 	= $input['nome'];
					$unidade_id  	= $input['unidade_id'];
					$solicitante 	= $input['solicitante'];
					$numeroMP    	= $input['numeroMP'];
					$input['gestor_criador_mp'] = Auth::user()->id;
					$mps  			= MP::where('numeroMP', $numeroMP)->get();
					$idMP 			= $mps[0]->id;
					$input['mp_id'] = $idMP;	
					
					if($input['tipohcp'] == "rpa"){
						$input['tipo'] = 'rpa';
						$input['periodo_contrato'] = $input['periodo_contratohcp'];
					}

					if($input['motivohcp'] == "substituicao_definitiva") {
						$input['motivo2'] = $input['motivo6hcp'];
					}

					$input['jornada'] = $input['jornadahcp'];
					$input['tipo'] 	  = $input['tipohcp'];
					$input['motivo']  = $input['motivohcp'];
				
					$admissao_hcp   = AdmissaoHCP::create($input);
					$unidade 	    = Unidade::where('id', $id_unidade)->get();
					$justificativa  = Justificativa::create($input);

					$idAdHCP = AdmissaoHCP::max('id');

					if(!empty($input['und'])){
						if($input['und'] == "on"){
							$input['gestor']          = $input['nome'];
							$input['unidade_id']      = 2;
							$input['salario'] 	      = $input['salario_2'];
							$input['outras_verbas']   = $input['outras_verbas_2'];
							$input['cargo'] 		  = $input['cargo_2'];
							$input['centro_custo']    = $input['centro_custo_2'];
							$input['admissao_hcp_id'] = $idAdHCP; 
							$admissao_usuarios = AdmissaoSalariosUnidades::create($input);
						}
					}

					if(!empty($input['und2'])){
						if($input['und2'] == "on"){
							$input['gestor']          = $input['nome'];
							$input['unidade_id']      = 3;
							$input['salario'] 	      = $input['salario_3'];
							$input['outras_verbas']   = $input['outras_verbas_3'];
							$input['cargo'] 		  = $input['cargo_3'];
							$input['centro_custo']    = $input['centro_custo_3'];
							$input['admissao_hcp_id'] = $idAdHCP; 
							$admissao_usuarios = AdmissaoSalariosUnidades::create($input);
						}
					}

					if(!empty($input['und3'])){
						if($input['und3'] == "on"){
							$input['gestor']          = $input['nome'];
							$input['unidade_id']      = 4;
							$input['salario'] 	      = $input['salario_4'];
							$input['outras_verbas']   = $input['outras_verbas_4'];
							$input['cargo'] 		  = $input['cargo_4'];
							$input['centro_custo']    = $input['centro_custo_4'];
							$input['admissao_hcp_id'] = $idAdHCP; 
							$admissao_usuarios = AdmissaoSalariosUnidades::create($input);
						}
					}

					if(!empty($input['und4'])){
						if($input['und4'] == "on"){
							$input['gestor']          = $input['nome'];
							$input['unidade_id']      = 5;
							$input['salario'] 	      = $input['salario_5'];
							$input['outras_verbas']   = $input['outras_verbas_5'];
							$input['cargo'] 		  = $input['cargo_5'];
							$input['centro_custo']    = $input['centro_custo_5'];
							$input['admissao_hcp_id'] = $idAdHCP; 
							$admissao_usuarios = AdmissaoSalariosUnidades::create($input);
						}
					}

					if(!empty($input['und5'])){
						if($input['und5'] == "on"){
							$input['gestor_id']       = $input['nome'];
							$input['unidade_id']      = 6;
							$input['salario'] 	      = $input['salario_6'];
							$input['outras_verbas']   = $input['outras_verbas_6'];
							$input['cargo'] 		  = $input['cargo_6'];
							$input['centro_custo']    = $input['centro_custo_6'];
							$input['admissao_hcp_id'] = $idAdHCP; 
							$admissao_usuarios = AdmissaoSalariosUnidades::create($input);
						}
					}

					if(!empty($input['und6'])){
						if($input['und6'] == "on"){
							$input['gestor']          = $input['nome'];
							$input['unidade_id']      = 7;
							$input['salario'] 	      = $input['salario_7'];
							$input['outras_verbas']   = $input['outras_verbas_7'];
							$input['cargo'] 		  = $input['cargo_7'];
							$input['centro_custo']    = $input['centro_custo_7'];
							$input['admissao_hcp_id'] = $idAdHCP; 
							$admissao_usuarios = AdmissaoSalariosUnidades::create($input);
						}
					}

					if(!empty($input['und7'])){
						if($input['und7'] == "on"){
							$input['gestor']          = $input['nome'];
							$input['unidade_id']      = 9;
							$input['salario'] 	      = $input['salario_8'];
							$input['outras_verbas']   = $input['outras_verbas_8'];
							$input['cargo'] 		  = $input['cargo_8'];
							$input['centro_custo']    = $input['centro_custo_8'];
							$input['admissao_hcp_id'] = $idAdHCP; 
							$admissao_usuarios = AdmissaoSalariosUnidades::create($input);
						}
					}

					$idG 	= 61;
					$gestor = Gestor::where('id', $idG)->get();
					$email  = $gestor[0]->email; /*
					Mail::send('email.emailMP', array($email), function($m) use ($email) {
						$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
						$m->subject('Validar MP!');
						$m->to($email);
					}); */
				} else {
					$validator = "Informe a Justificativa!";
					return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
			
				}
				$unidades 	   = Unidade::all();
				$admissao 	   = Admissao::where('mp_id', $idMP)->get(); 
				$demissao 	   = Demissao::where('mp_id', $idMP)->get();
				$alteracaoF    = Alteracao_Funcional::where('mp_id', $idMP)->get();
				$plantao       = Plantao::where('mp_id', $idMP)->get();
				$justificativa = Justificativa::where('mp_id', $idMP)->get();	
				$aprovacao 	   = Aprovacao::where('mp_id', $idMP)->get();		
				$idG 		   = $input['gestor_id'];
				$gestor 	   = Gestor::where('id', $idG)->get();				
				$a = 1;
				return view('home', compact('unidade','idMP','idG','mps','gestor','unidades','unidade','admissao','demissao','alteracaoF','plantao','justificativa','aprovacao','a'));
			}
		} else {
			$validator = "Escolha um Tipo de Movimentação!";
			return view('index', compact('unidade','gestores','tipo_mp','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		}
	}	
	
	// Tela para Alterar MP de Alteração Funcional //
	public function alterarMPAlteracao($id, $id_alt) {
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
		$idA = $id_alt;
		$idMP = $id;
		$cargos = Cargos::all();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
		return view('alterarMPAlteracao', compact('unidade','gestores','unidades','mps','alteracaoF','idA','idMP','centro_custos','setores','centro_custo_nv','cargos','justificativa','gestor'));
	}
	
	//GErar PDF
	public function mpPDF($idG, $idMP)
	{
		$unidades = Unidade::all();
		$admissao = Admissao::where('mp_id', $idMP)->get(); 
		$demissao = Demissao::where('mp_id', $idMP)->get();
		$alteracaoF = Alteracao_Funcional::where('mp_id', $idMP)->get();
		$justificativa = Justificativa::where('mp_id', $idMP)->get();	
		$aprovacao = Aprovacao::where('mp_id', $idMP)->get();		
		$gestor = Gestor::where('id', $idG)->get();				
		$mps = MP::where('id', $idMP)->get();
		$idU = $mps[0]->unidade_id;
		$unidade = Unidade::where('id', $idU)->get();
		$pdf = PDF::loadView('pdf.mpdf', compact('mps','gestor','unidades','unidade','admissao','demissao','alteracaoF','justificativa','aprovacao'));
		$pdf->setPaper('A4', 'landscape');
		return $pdf->download('mp.pdf');
	}
	
	// Tela para Alterar MP de Demissão //
	public function alterarMPDemissao($id, $id_dem) {
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
		$idA = $id_dem;
		$idMP = $id;
		return view('alterarMPDemissao', compact('unidade','gestores','unidades','mps','demissao','idA','idMP','justificativa','gestor'));
	}
	
	// Tela para Alterar MP de Admissão //
	public function alterarMPAdmissao($id, $id_adm) {
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
		$admissao = Admissao::where('mp_id',$mps[0]->id)->get();
		$idA = $id_adm;
		$idMP = $id;
		$cargos = Cargos::all();
		$centro_custos = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
		return view('alterarMPAdmissao', compact('unidade','gestores','unidades','mps','admissao','idA','idMP','cargos','centro_custos','justificativa','gestor'));
	}
	
	// Alterar MP de Alteração //
	public function updateMPAlteracao($id, $id_alt, Request $request){
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
		$gestores 	   = Gestor::all();
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
		if(strtotime($dataEmissao) >= strtotime($dataPrevista)){
			$validator 	   = "Data Prevista não pode ser Menor ou Igual a Data de Emissão!";
			return view('alterarMPAlteracao', compact('unidade','gestores','unidades','mps','alteracaoF','idA','idMP','aprovacao','justificativa','gestor','solicitante','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		} 
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
			$validator 	   = "Alteração Funcional Alterada com sucesso!";
			return view('index_', compact('mps','gestores','unidades','unidade','alteracaoF','justificativa','aprovacao','gestor'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		}
	}
	
	//Voltar para o fluxo
	public function salvarMPAlteracao($id, $idG, Request $request){
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
	}
	
	// Alterar MP de Demissão //
	public function updateMPDemissao($id, $id_dem, Request $request){
		$input = $request->all(); 
		$dataE = $input['data_emissao'];
		$dataP = $input['data_prevista'];
		$dataEmissao  = date('d-m-Y', strtotime($dataE));
		$dataPrevista = date('d-m-Y', strtotime($dataP));
		$gestores  	   = Gestor::all();
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
			$validator 	   = "Demissão Alterada com sucesso!";
			return view('index_', compact('mps','gestores','unidades','unidade','demissao','justificativa','aprovacao','gestor'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		}
	}
	
	public function salvarMPDemissao($id, $idG, Request $request){
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
	}
	
	// Alterar MP de Admissão //
	public function updateMPAdmissao($id, $id_adm, Request $request){
		$input 		   = $request->all();
		$dataE 		   = $input['data_emissao'];
		$dataP 		   = $input['data_prevista'];
		$dataEmissao   = date('d-m-Y', strtotime($dataE));
		$dataPrevista  = date('d-m-Y', strtotime($dataP));
		$gestores 	   = Gestor::all();
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
		$cargos 	   = Cargos::all();
		$centro_custos = DB::table('centro_custo')->where('centro_custo.unidade','like','%'.$unidade[0]->id.'%')->get();
		if(strtotime($dataEmissao) >= strtotime($dataPrevista)){
			$validator = "Data Prevista não pode ser Menor ou Igual a Data de Emissão!";
			return view('alterarMPAdmissao', compact('unidade','gestores','unidades','mps','admissao','idA','idMP','aprovacao','justificativa','gestor','solicitante'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		}
		$validator = Validator::make($request->all(), [
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
				'nome'						=> 'required|max:255',
				'departamento'				=> 'required|max:255',
				'data_prevista'				=> 'required'
		]);
		if ($validator->fails()) {
			return view('alterarMPAdmissao', compact('unidade','gestores','unidades','mps','admissao','idA','idMP','aprovacao','justificativa','gestor','solicitante'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		} else {
			if($input['horario_trabalho'] == "0")
				{
					$input['horario_trabalho'] = $input['horario_trabalho2'];
				}
				if($input['escala_trabalho'] == "outra")
				{
					$input['escala_trabalho'] = $input['escala_trabalho2'];
				}
				if($input['motivo'] != "substituicao_definitiva")
				{
					$input['motivo2'] = NULL;
				}
				if($input['tipo'] == "rpa")
				{
					$input['tipo'] = 'rpa';
					$missing = array();
					for($a = 1; $a <= 6; $a++){
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

					$periodo_inicio = date('m/Y', strtotime($input['mes_ano']));
					$periodo_fim	= date('m/Y', strtotime($input['mes_ano2']));
					$arr  = explode('/',$periodo_inicio);
					$arr2 = explode('/',$periodo_fim);
					$mes1 = $arr[0];	
					$ano1 = $arr[1];
					$mes2 = $arr2[0];
					$ano2 = $arr2[1];
					$a1 = ($ano2 - $ano1)*12;
					$m1 = ($mes2 - $mes1)+1;
					$m3 = ($m1 + $a1); 

					if($m3 < 0) {
						$validator = "Datas de RPA Inválidas!";
						return view('alterarMPAdmissao', compact('unidade','gestores','unidades','mps','admissao','idA','idMP','aprovacao','justificativa','gestor','solicitante'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						if($m3 > 3) {
							$validator = "Máximo 3 meses de RPA!";
							return view('alterarMPAdmissao', compact('unidade','gestores','unidades','mps','admissao','idA','idMP','aprovacao','justificativa','gestor','solicitante'))
								->withErrors($validator)
								->withInput(session()->flashInput($request->input()));
						}
					}
					$input['periodo_inicio'] = $periodo_inicio;
					$input['periodo_fim'] 	 = $periodo_fim;
				} else {
					$input['gratificacoes'] = 0;
				}
			$input['acesssorh3'] = 0;
			$input['usuario_acessorh3'] = '';	

			if(!empty($input['sim_impacto']) == "on") {
				$input['impacto_financeiro'] = 'sim';
			} else if (!empty($input['nao_impacto']) == "on") {
				$input['impacto_financeiro'] = 'nao';
			}

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
			$validator 	   = "Admissão Alterada com sucesso!";
			return view('index_', compact('mps','gestores','unidades','unidade','admissao','justificativa','aprovacao','gestor'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		}
	}
	
	public function salvarMPAdmissao($id, $idG, Request $request){
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
	}

	// Tela para Alterar MP de Plantão //
	public function alterarMPPlantao($id, $id_plan) {
		$gestores = Gestor::all();
		$unidades = Unidade::all();
		$mps = MP::where('id',$id)->get();
		$justificativa = Justificativa::where('mp_id', $mps[0]->id)->get();
		$solicitante   = $mps[0]->solicitante;
		$solic   = Gestor::where('nome',$solicitante)->get();
		$gestor  = $solic[0]->gestor_imediato;
		$gestor  = Gestor::where('nome', $gestor)->get();
		$unidade = $mps[0]->unidade_id;
		$unidade = Unidade::where('id',$unidade)->get();
		$plantao = Plantao::where('mp_id',$mps[0]->id)->get();
		$idA 	 = $id_plan;
		$idMP 	 = $id;
		$cargos  = Cargos::all();
		$centro_custos = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
		$setores 	   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->orderBy('nome','ASC')->get();
		return view('alterarMPPlantao', compact('unidade','gestores','unidades','mps','plantao','idA','idMP','justificativa','gestor','cargos','centro_custos','setores'));
	}

	// Alterar MP de Plantão //
	public function updateMPPlantao($id, $id_plan, Request $request){
		$input = $request->all(); 
		$dataE = $input['data_emissao'];
		$dataP = $input['data_prevista'];
		$dataEmissao  = date('d-m-Y', strtotime($dataE));
		$dataPrevista = date('d-m-Y', strtotime($dataP));
		$gestores  	   = Gestor::all();
		$unidades  	   = Unidade::all();
		$mps 		   = MP::where('id',$id)->get();
		$justificativa = Justificativa::where('mp_id', $mps[0]->id)->get();
		$solicitante   = $mps[0]->solicitante;
		$solic   	   = Gestor::where('nome',$solicitante)->get();
		$gestor  	   = $solic[0]->gestor_imediato;
		$gestor  	   = Gestor::where('nome', $gestor)->get();
		$unidade 	   = $mps[0]->unidade_id;
		$unidade 	   = Unidade::where('id',$unidade)->get();
		$plantao 	   = Plantao::where('mp_id',$mps[0]->id)->get();
		$idA 		   = $id_plan;
		$idMP 		   = $id;
		$aprovacao     = Aprovacao::where('mp_id',$id)->get();
		$cargos = Cargos::all(); 
		$centro_custos = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
		$setores 	   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->orderBy('nome','ASC')->get();
		if(strtotime($dataEmissao) >= strtotime($dataPrevista)){
			$validator = "Data Prevista não pode ser Menor ou Igual a Data de Emissão!";
			return view('alterarMPDemissao', compact('unidade','gestores','unidades','mps','plantao','idA','idMP','aprovacao','justificativa','gestor','solicitante','cargos','centro_custos','setores'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		}
		
		$validator = Validator::make($request->all(), [
				'setor_plantao' 	   => 'required|max:255',
				'cargo_plantao' 	   => 'required|max:255',
				'motivo_plantao' 	   => 'required|max:255',
				'substituto' 		   => 'required|max:255',
				'centro_custo_plantao' => 'required|max:225',
				'quantidade_plantao'   => 'required|max:255',
				'valor_plantao'        => 'required',
				'valor_pago_plantao'   => 'required|max:255'
		]);
		if ($validator->fails()) {
			return view('alterarMPPlantao', compact('unidade','gestores','unidades','mps','plantao','idA','idMP','aprovacao','justificativa','gestor','solicitante','cargos','centro_custos','setores'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		} else {
			$input['acesssorh3'] = 0;
			$input['usuario_acessorh3'] = '';
			$plantao 	   = Plantao::find($id_plan);
			$plantao->update($input);
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
			$plantao 	   = Plantao::where('mp_id',$id)->get();
			$justificativa = Justificativa::where('mp_id', $id)->get();
			$aprovacao 	   = Aprovacao::where('mp_id',$id)->get();
			$validator 	   = "Plantão Extra Alterado com sucesso!";
			return view('index_', compact('mps','gestores','unidades','unidade','plantao','justificativa','aprovacao','gestor'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		}
	}
	
	public function salvarMPPlantao($id, $idG, Request $request){
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
	}

	// Tela para Alterar MP de Plantão //
	public function alterarMPAdmissaoHCP($id, $id_adm_hcp) {
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
		$admissaoHCP = AdmissaoHCP::where('mp_id',$mps[0]->id)->get();
		$admissaoSalUnd = AdmissaoSalariosUnidades::where('admissao_hcp_id',$admissaoHCP[0]->id)->get();
		$idA = $id_adm_hcp;
		$idMP = $id;
		$cargos = Cargos::all();
		$centro_custos = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->orderBy('nome','ASC')->get();
		return view('alterarMPAdmissaoHCP', compact('unidade','gestores','unidades','mps','admissaoHCP','admissaoSalUnd','idA','idMP','justificativa','gestor','cargos','centro_custos','setores'));
	}

	// Alterar MP de Plantão //
	public function updateMPAdmissaoHCP($id, $id_adm_hcp, Request $request){
		$input = $request->all(); 
		$dataE = $input['data_emissao'];
		$dataP = $input['data_prevista'];
		$dataEmissao  = date('d-m-Y', strtotime($dataE));
		$dataPrevista = date('d-m-Y', strtotime($dataP));
		$gestores  	   = Gestor::all();
		$unidades  	   = Unidade::all();
		$mps 		   = MP::where('id',$id)->get();
		$justificativa = Justificativa::where('mp_id', $mps[0]->id)->get();
		$solicitante   = $mps[0]->solicitante;
		$solic   	   = Gestor::where('nome',$solicitante)->get();
		$gestor  	   = $solic[0]->gestor_imediato;
		$gestor  	   = Gestor::where('nome', $gestor)->get();
		$unidade 	   = $mps[0]->unidade_id;
		$unidade 	   = Unidade::where('id',$unidade)->get();
		$admissaoHCP   = AdmissaoHCP::where('mp_id',$mps[0]->id)->get();
		$admissaoSalUnd = AdmissaoSalariosUnidades::where('admissao_hcp_id',$admissaoHCP[0]->id)->get();
		$idA 		   = $id_adm_hcp;
		$idMP 		   = $id;
		$aprovacao     = Aprovacao::where('mp_id',$id)->get();
		if(strtotime($dataEmissao) >= strtotime($dataPrevista)){
			$validator = "Data Prevista não pode ser Menor ou Igual a Data de Emissão!";
			return view('alterarMPDemissao', compact('unidade','gestores','unidades','mps','admissaoHCP','admissaoSalUnd','idA','idMP','aprovacao','justificativa','gestor','solicitante'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		}
		$validator = Validator::make($request->all(), [
			'jornadahcp' 	   			=> 'required|max:255',
			'tipohcp'   	   			=> 'required|max:255',
			'motivohcp'   	   			=> 'required|max:255',
			'possibilidade_contratacao' => 'required|max:255',
			'necessidade_email' 		=> 'required|max:255',
		]);
		if ($validator->fails()) {
			return view('alterarMPAdmissaoHCP', compact('unidade','gestores','unidades','mps','admissaoHCP','idA','idMP','aprovacao','justificativa','gestor','solicitante'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		} else {
			$input['acesssorh3'] = 0;
			$input['usuario_acessorh3'] = '';
			
			if($input['tipohcp'] == "rpa"){
				$input['periodo_contrato'] = $input['periodo_contratohcp'];
			} else {
				$input['periodo_contrato'] = "";
			}

			if($input['motivohcp'] == "substituicao_definitiva") {
				$input['motivo2'] = $input['motivo6hcp'];
			} else {
				$input['motivo2'] = "";
			}

			$input['jornada'] = $input['jornadahcp'];
			$input['tipo']    = $input['tipohcp'];
			$input['motivo']  = $input['motivohcp'];

			if(!empty($input['salario_2'])){
				$input['gestor']          = $input['nome'];
				$input['unidade_id']      = 2;
				$input['salario'] 	      = $input['salario_2'];
				$input['outras_verbas']   = $input['outras_verbas_2'];
				$input['cargo'] 		  = $input['cargo_2'];
				$input['centro_custo']    = $input['centro_custo_2'];
				$input['admissao_hcp_id'] = $id_adm_hcp; 
				$idASU = AdmissaoSalariosUnidades::where('admissao_hcp_id',$id_adm_hcp)
												 ->where('unidade_id',2)->get('id');
				$admissao_usuarios = AdmissaoSalariosUnidades::find($idASU[0]->id);
				$admissao_usuarios->update($input);
			}

			if(!empty($input['salario_3'])){
				$input['gestor']          = $input['nome'];
				$input['unidade_id']      = 3;
				$input['salario'] 	      = $input['salario_3'];
				$input['outras_verbas']   = $input['outras_verbas_3'];
				$input['cargo'] 		  = $input['cargo_3'];
				$input['centro_custo']    = $input['centro_custo_3'];
				$input['admissao_hcp_id'] = $id_adm_hcp; 
				$idASU = AdmissaoSalariosUnidades::where('admissao_hcp_id',$id_adm_hcp)
												 ->where('unidade_id',3)->get('id');
				$admissao_usuarios = AdmissaoSalariosUnidades::find($idASU[0]->id);
				$admissao_usuarios->update($input);
			}

			if(!empty($input['salario_4'])){
				$input['gestor']          = $input['nome'];
				$input['unidade_id']      = 4;
				$input['salario'] 	      = $input['salario_4'];
				$input['outras_verbas']   = $input['outras_verbas_4'];
				$input['cargo'] 		  = $input['cargo_4'];
				$input['centro_custo']    = $input['centro_custo_4'];
				$input['admissao_hcp_id'] = $id_adm_hcp; 
				$idASU = AdmissaoSalariosUnidades::where('admissao_hcp_id',$id_adm_hcp)
												 ->where('unidade_id',4)->get('id');
				$admissao_usuarios = AdmissaoSalariosUnidades::find($idASU[0]->id);
				$admissao_usuarios->update($input);
			}

			if(!empty($input['salario_5'])){
				$input['gestor']          = $input['nome'];
				$input['unidade_id']      = 5;
				$input['salario'] 	      = $input['salario_5'];
				$input['outras_verbas']   = $input['outras_verbas_5'];
				$input['cargo'] 		  = $input['cargo_5'];
				$input['centro_custo']    = $input['centro_custo_5'];
				$input['admissao_hcp_id'] = $id_adm_hcp; 
				$idASU = AdmissaoSalariosUnidades::where('admissao_hcp_id',$id_adm_hcp)
												 ->where('unidade_id',5)->get('id');
				$admissao_usuarios = AdmissaoSalariosUnidades::find($idASU[0]->id);
				$admissao_usuarios->update($input);
			}

			if(!empty($input['salario_6'])){
				$input['gestor_id']       = $input['nome'];
				$input['unidade_id']      = 6;
				$input['salario'] 	      = $input['salario_6'];
				$input['outras_verbas']   = $input['outras_verbas_6'];
				$input['cargo'] 		  = $input['cargo_6'];
				$input['centro_custo']    = $input['centro_custo_6'];
				$input['admissao_hcp_id'] = $id_adm_hcp; 
				$idASU = AdmissaoSalariosUnidades::where('admissao_hcp_id',$id_adm_hcp)
												 ->where('unidade_id',6)->get('id');
				$admissao_usuarios = AdmissaoSalariosUnidades::find($idASU[0]->id);
				$admissao_usuarios->update($input);
			}

			if(!empty($input['salario_7'])){
				$input['gestor']          = $input['nome'];
				$input['unidade_id']      = 7;
				$input['salario'] 	      = $input['salario_7'];
				$input['outras_verbas']   = $input['outras_verbas_7'];
				$input['cargo'] 		  = $input['cargo_7'];
				$input['centro_custo']    = $input['centro_custo_7'];
				$input['admissao_hcp_id'] = $id_adm_hcp; 
				$idASU = AdmissaoSalariosUnidades::where('admissao_hcp_id',$id_adm_hcp)
												 	 ->where('unidade_id',7)->get();
				$admissao_usuarios = AdmissaoSalariosUnidades::find($idASU[0]->id);
				$admissao_usuarios->update($input);
			}

			if(!empty($input['salario_8'])){
				$input['gestor']          = $input['nome'];
				$input['unidade_id']      = 9;
				$input['salario'] 	      = $input['salario_8'];
				$input['outras_verbas']   = $input['outras_verbas_8'];
				$input['cargo'] 		  = $input['cargo_8'];
				$input['centro_custo']    = $input['centro_custo_8'];
				$input['admissao_hcp_id'] = $id_adm_hcp; 
				$idASU = AdmissaoSalariosUnidades::where('admissao_hcp_id',$id_adm_hcp)
												 	 ->where('unidade_id',9)->get();
				$admissao_usuarios = AdmissaoSalariosUnidades::find($idASU[0]->id);
				$admissao_usuarios->update($input);
			}
			if(!empty($input['sim_impacto']) == "on") {
				$input['impacto_financeiro'] = 'sim';
			} else if (!empty($input['nao_impacto']) == "on") {
				$input['impacto_financeiro'] = 'nao';
			}
			$input['unidade_id'] = 1;
			$input['gestor_id'] = 61;
			$admissaoHCP   = AdmissaoHCP::find($id_adm_hcp);
			$admissaoHCP->update($input);
			$mp			   = MP::find($id);
			$mp->update($input);
			$J   		   = Justificativa::where('mp_id', $id)->get();
			$idJ 		   = $J[0]->id; 
			$justificativa = Justificativa::find($idJ);
			$justificativa->update($input);
			$mps 		    = MP::where('id', $id)->get();
			$solicitante    = $mps[0]->solicitante;
			$solic    	    = Gestor::where('nome',$solicitante)->get();
			$gestor   	    = $solic[0]->gestor_imediato;
			$gestor   	    = Gestor::where('nome', $gestor)->get();
			$gestores 	    = Gestor::all();
			$unidades 	    = Unidade::all();
			$idU 		    = $mps[0]->unidade_id;
			$unidade 	    = Unidade::where('id', $idU)->get();
			$admissaoHCP    = AdmissaoHCP::where('mp_id',$id)->get();
			$admissaoSalUnd = AdmissaoSalariosUnidades::where('admissao_hcp_id',$admissaoHCP[0]->id)->get();
			$justificativa  = Justificativa::where('mp_id', $id)->get();
			$aprovacao 	    = Aprovacao::where('mp_id',$id)->get();
			$validator 	    = "Admissão HCPGESTÃO Alterado com sucesso!";
			return view('index_', compact('mps','gestores','unidades','unidade','admissaoHCP','admissaoSalUnd','justificativa','aprovacao','gestor'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		}
	}
	
	public function salvarMPAdmissaoHCP($id, $idG, Request $request){
		$input 	  = $request->all();
		$mp 	  = MP::where('id',$id)->get();
		$idMP 	  = $id;
		$idU      = $mp[0]->unidade_id;
		$unidade  = Unidade::where('id', $idU)->get();
		$numeroMP = $mp[0]->numeroMP;
		$gestor   = Gestor::where('id', 61)->get();
		$nome     = $mp[0]->solicitante;
		$email 	  = $gestor[0]->email;
		DB::statement('UPDATE mp SET gestor_id = 61 WHERE id = '.$id.';');
		/*Mail::send([], [], function($m) use ($email,$numeroMP,$nome) {
			$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
			$m->subject('MP - '.$numeroMP.' Alterada!');
			$m->setBody('A MP: '. $numeroMP.' foi alterada por: '.$nome.' e precisa da sua validação! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
			$m->to($email);
		});*/
		$a = 0;
		return view('home', compact('unidade','idMP','idG','a'));
	}

	public function excluirMPs()
	{
		$mps = MP::where('solicitante',Auth::user()->name)->where('inativa',0)->paginate(20);
		return view('excluirMPs', compact('mps'));
	}

	public function excluirMP($id)
	{
		$mps     = MP::where('id', $id)->get();
		$idU     = $mps[0]->unidade_id;
		$unidade = Unidade::where('id',$idU)->get();
		$idG     = $mps[0]->solicitante;
		$gestor  = Gestor::where('nome',$idG)->get();
		return view('excluirMP', compact('mps','unidade','gestor'));
	}

	public function pesquisaMPsExclusao(Request $request)
	{
		$input = $request->all();
		$solicitante = Auth::user()->name;
		if(empty($input['unidade_id'])){ $input['unidade_id'] = 0;  }
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$unidade_id = $input['unidade_id'];
		$pesq 	    = $input['pesq'];
		$pesq2      = $input['pesq2'];
		$funcao = Auth::user()->funcao;
		if($funcao == "Administrador" || Auth::user()->id == 198) {
			if($pesq2 == "numero") {
				if($unidade_id == "0"){
					$mps = DB::table('mp')->where('mp.numeroMP','like','%'.$pesq.'%')->where('inativa',0)->paginate(20);
				} else {
					$mps = DB::table('mp')->where('mp.numeroMP','like','%'.$pesq.'%')->where('inativa',0)
								->where('mp.unidade_id',$unidade_id)->paginate(20);
				}
			} else if($pesq2 == "funcionario"){
				if($unidade_id == "0"){
					$mps = DB::table('mp')->where('mp.nome','like','%'.$pesq.'%')->where('inativa',0)->paginate(20);
				} else {
					$mps = DB::table('mp')->where('mp.nome','like','%'.$pesq.'%')->where('inativa',0)
								->where('mp.unidade_id',$unidade_id)->paginate(20);
				}
			} else if($pesq2 == "solicitante"){
				if($unidade_id == "0"){
					$mps = DB::table('mp')->where('mp.solicitante','like','%'.$pesq.'%')->where('inativa',0)->paginate(20);
				} else {
					$mps = DB::table('mp')->where('mp.solicitante','like','%'.$pesq.'%')->where('inativa',0)
								->where('mp.unidade_id',$unidade_id)->paginate(20);
				}
			} else if($pesq2 == ""){
				if($unidade_id == "0"){
					$mps = MP::where('inativa',0)->orderby('unidade_id','ASC')->paginate(20);
				} else {
					$mps = MP::where('unidade_id',$unidade_id)->where('inativa',0)->paginate(20);
				}
			}
		} else {
			if($pesq2 == "numero") {
				if($unidade_id == "0"){
					$mps = DB::table('mp')->where('mp.numeroMP','like','%'.$pesq.'%')
						->where('solicitante',$solicitante)->where('inativa',0)->paginate(20);
				} else {
					$mps = DB::table('mp')->where('mp.numeroMP','like','%'.$pesq.'%')->where('inativa',0)
					->where('solicitante',$solicitante)->where('mp.unidade_id',$unidade_id)->paginate(20);
				}
			} else if($pesq2 == "funcionario"){
				if($unidade_id == "0"){
					$mps = DB::table('mp')->where('mp.nome','like','%'.$pesq.'%')
						->where('solicitante',$solicitante)->where('inativa',0)->paginate(20);
				} else {
					$mps = DB::table('mp')->where('mp.nome','like','%'.$pesq.'%')->where('inativa',0)
						->where('solicitante',$solicitante)->where('mp.unidade_id',$unidade_id)->paginate(20);
				}
			} else if($pesq2 == ""){
				if($unidade_id == "0"){
					$mps = MP::where('inativa',0)->where('solicitante',$solicitante)->paginate(20);
				} else {
					$mps = MP::where('unidade_id',$unidade_id)->where('solicitante',$solicitante)
						->where('inativa',0)->paginate(20);
				}
			}
		} 
		return view('excluirMPs', compact('mps','unidade_id','pesq2','pesq'));
	}

	public function deleteMP($id, Request $request)
	{
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
		$admissao_hcp = AdmissaoHCP::where('mp_id',$idMP)->get();
		$qtdAdmHCP    = sizeof($admissao_hcp);
		$admUnidadesSalarios = AdmissaoSalariosUnidades::where('admissao_hcp_id',$admissao_hcp[0]->id)->get();
		$qtdAdmUndSal        = sizeof($admUnidadesSalarios);
		if($qtdAdmUndSal > 0){
			DB::statement('delete from admissao_salarios_unidades where admissao_hcp_id = '.$admissao_hcp[0]->id);
		}
		if($qtdAdmHCP > 0){
			DB::statement('delete from admissao_hcp where mp_id = '.$idMP);
		}
		$plantao = Plantao::where('mp_id',$idMP)->get();
		$qtdPla  = sizeof($plantao);
		if($qtdPla > 0){
			DB::statement('delete from plantao where mp_id = '.$idMP);
		} 
		DB::statement('delete from mp where id = '.$idMP);
		$mps = MP::where('id',0)->get();
		$loggers   = Loggers::create($input);
		$validator = "MP Excluída com sucesso!";
		return view('excluirMPs', compact('mps'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
	}

	public function duvidas()
	{
		return view('duvidas');
	}
}