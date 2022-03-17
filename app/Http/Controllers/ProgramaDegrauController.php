<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Gestor;
use App\Model\Unidade;
use App\Model\VagaInterna;
use App\Model\JustificativaVagaInterna;
use App\Model\AprovacaoVagaInterna;
use App\Model\PerfilComportamentalVagaInterna;
use App\Model\CompetenciasVagaInterna;
use App\Model\InscricaoVagaInterna;
use App\Model\Vaga;
use \PDF;
use Barryvdh\DomPDF\Facade;
use App\Model\Cargos;
use DB;
use Illuminate\Support\Facades\Mail;
use Validator;
use Redirect;

class ProgramaDegrauController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicioDegrau()
    {
        $unidades = Unidade::all();
		$usuario_id = Auth::user()->id;
		$gestor 	= Gestor::where('id',$usuario_id)->get();	
		$aprovacao  = AprovacaoVagaInterna::all();
		$pd  = VagaInterna::all();
        return view('welcome_degrau', compact('unidades','gestor','aprovacao','pd'));
    }

    public function index3()
    {
		$unidades   = Unidade::all();
		$usuario_id = Auth::user()->id;
		$gestor 	= Gestor::where('id',$usuario_id)->get();	
        return view('programaDegrau/welcome_degrau_', compact('unidades','gestor'));
    }

    public function cadastroPD($id_unidade)
	{
		$unidade  = Unidade::where('id', $id_unidade)->get();
		$unidades = Unidade::all();
		$cargos = Cargos::orderBy('nome','ASC')->get();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'));
	}

    public function storePD($id_unidade, Request $request)
	{
		$input = $request->all(); 	 
		$unidade  = Unidade::where('id', $id_unidade)->get();
		$unidades = Unidade::all();
		$cargos = Cargos::orderBy('nome','ASC')->get();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$dataEmissao  = date('d-m-Y', strtotime($input['data_emissao']));
		$dataP 		  = $input['data_prevista'];
		$dataPrevista = date('d-m-Y', strtotime($dataP));
		if(strtotime($dataEmissao) == strtotime($dataPrevista)){
			$validator = "Data Prevista não pode ser Igual a Data de Emissão!";
			return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		} else if(strtotime($dataPrevista) < strtotime($dataEmissao)) {
			$validator = "Data Prevista não pode ser Menor que a Data de Emissão!";
			return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		}
		$validator = Validator::make($request->all(), [
			'vaga'                   => 'required|max:255',
			'departamento' 			 => 'required|max:255',
			'data_prevista'			 => 'required',
			'cargo'					 => 'required|max:255',
			'salario' 				 => 'required|max:255',
			'horario_trabalho'  	 => 'required|max:255',
            'escala_trabalho'		 => 'required|max:255',
			'centro_custo'			 => 'required|max:255',
			'jornada'				 => 'required|max:255',
			'turno'					 => 'required|max:255',
			'tipo'              	 => 'required|max:255',
			'motivo'            	 => 'required|max:255',
			'contratacao_deficiente' => 'required|max:255',
			'email'			         => 'required|max:255',
			'conhecimento_tecnico'	 => 'required|max:500',
			'conhecimento_desejado'	 => 'required|max:500',
			'formacao'				 => 'required|max:400',
			'idiomas'				 => 'required|max:400',
			'descricao'				 => 'required|max:1000'
		]);
		if ($validator->fails()) {
			return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
        } else { 
			if($input['horario_trabalho'] == "0") {
			  if(!empty($input['horario_trabalho2'])){		
				if($input['horario_trabalho2'] == "0"){
					$validator = "Informe qual é o Horário de Trabalho!";
				    return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
			  	     ->withErrors($validator)
                     ->withInput(session()->flashInput($request->input()));
				} else {
					$input['horario_trabalho'] = $input['horario_trabalho2'];
				}
			  } else {
				$validator = "Informe qual é o Horário de Trabalho!";
				return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
				   ->withErrors($validator)
				   ->withInput(session()->flashInput($request->input()));
			  } 
			}
			if($input['escala_trabalho'] == "outra") { 
			  if(!empty($input['escala_trabalho6'])){	
				if($input['escala_trabalho6'] == ""){
					$validator = "Informe qual é a Escala de Trabalho!";
				    return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
				     ->withErrors($validator)
                     ->withInput(session()->flashInput($request->input()));
				} else {
					$input['escala_trabalho'] = $input['escala_trabalho6'];
				}
			  } else {
				$validator = "Informe qual é a Escala de Trabalho!";
				return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
				 ->withErrors($validator)
				 ->withInput(session()->flashInput($request->input()));
			  }
			}
			if($input['tipo'] == "rpa") {
			  if(!empty($input['periodo_contrato'])){		
				if($input['periodo_contrato'] == ""){
					$validator = "Informe qual é o Período do Contrato do RPA!";
				    return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
			 	     ->withErrors($validator)
                     ->withInput(session()->flashInput($request->input()));
				}
			  } else {
				$validator = "Informe qual é o Período do Contrato do RPA!";
				return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
				  ->withErrors($validator)
				  ->withInput(session()->flashInput($request->input()));
			  } 
		    	$input['tipo'] = 'rpa';
			}
			if($input['motivo'] == "substituicao_definitiva") {
			  if(!empty($input['motivo6'])){			
				if($input['motivo6'] == ""){
					$validator = "Informe qual é o Funcionário que vai ser substituído!";
				    return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
				      ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
				} else {
					$input['motivo2'] = $input['motivo6'];
				}
			  } else {
				$validator = "Informe qual é o Funcionário que vai ser substituído!";
				return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
				  ->withErrors($validator)
				  ->withInput(session()->flashInput($request->input()));
			  }
			} 
			$input['data_emissao']  = date('Y-m-d',(strtotime($dataEmissao)));
			$input['data_prevista'] = date('Y-m-d',(strtotime($dataPrevista)));
			$input['concluida'] = 0;
			$input['aprovada']  = 0;
			$input['vinculo']   = 0;
			if($input['codigo_vaga'] == ""){
				$input['codigo_vaga'] = '0000';
			} 
			$pd = VagaInterna::create($input);
			$id = DB::table('vaga_interna')->max('id');
			$input['vaga_interna_id'] = $id;
			$just_vaga = JustificativaVagaInterna::create($input);
			$a = 0; 
			for($j = 1; $j <= 9; $j++) {
				if(!empty($input['motivoA' .$j])) {
					if($input['motivoA' .$j] == "outros"){
						$input['descricao'] = 'outros';
						$input['outros']    = $input['outras_competencias'];
					} else {
						$input['descricao'] = $input['motivoA' .$j];
						$input['outros']    = NULL;
					}
					$competencias = CompetenciasVagaInterna::create($input);
					$a += 1;
				}
			}
			if($a == 0){
				$jv = DB::select('DELETE FROM JUSTIFICATIVA_VAGA_INTERNA WHERE vaga_interna_id = '.$id);
				$pd = DB::select('DELETE FROM VAGA_INTERNA WHERE id = '.$id);
				$validator = "Informe Qual Perfil(s) Comportamental(s) sua Vaga Necessita!";
				return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
				  ->withErrors($validator)
				  ->withInput(session()->flashInput($request->input()));
			}
			$b = 0;
			for($i = 1; $i <= 11; $i++) {
				if(!empty($input['comportamental' .$i])) {
					if($input['comportamental' .$i] == "outros"){
						$input['descricao'] = 'outros';
						$input['outros']    = $input['perfil'];
					} else {
						$input['descricao'] = $input['comportamental' .$i];
						$input['outros']	= NULL;
					}
					$comportamental = PerfilComportamentalVagaInterna::create($input);
					$b += 1;
				}
			}
			if($b == 0){
				$jv = DB::select('DELETE FROM JUSTIFICATIVA_VAGA_INTERNA WHERE vaga_interna_id = '.$id);
				$pd = DB::select('DELETE FROM VAGA_INTERNA WHERE id = '.$id);
				$validator = "Informe Qual Competencência(s) sua Vaga Necessita!";
				return view('programaDegrau/programaDegrau', compact('unidade','unidades','cargos','centro_custos','setores','centro_custo_nv'))
				 ->withErrors($validator)
				  ->withInput(session()->flashInput($request->input()));
			}
			$gestor = Gestor::where('id', $input['gestor_id'])->get();
			$email  = 'janaina.lima@hcpgestao.org.br';
			/*Mail::send('email.emailPD', array($email), function($m) use ($email) {
				$m->from('portal@hcpgestao.org.br', 'Program Degrau');
				$m->subject('Validar Vaga do Programa Degrau!');
				$m->to($email);
			});*/
			$unidades = Unidade::all();
			$unidade  = Unidade::where('id',$id_unidade)->get();
			$usuario_id = Auth::user()->id;
			$gestor 	= Gestor::where('id',$usuario_id)->get();	
			$idVI 	    = $id;
			$idG  = Auth::user()->id;
			return view('programaDegrau/home_vaga_degrau', compact('unidade','idVI','idG','gestor','unidades','unidade'));
		}
	}

	public function degrauPDF($idG, $idVI)
	{
		$unidades = Unidade::all();
		$pd 	  = VagaInterna::where('id', $idVI)->get(); 
		$just_vaga_int = JustificativaVagaInterna::where('vaga_interna_id', $idVI)->get();	
		$aprovacaoVI   = AprovacaoVagaInterna::where('vaga_interna_id', $idVI)->get();		
		$gestor  = Gestor::where('id', $idG)->get();
		$idU     = $pd[0]->unidade_id;
		$unidade = Unidade::where('id', $idU)->get();
		$pdf = PDF::loadView('pdf.degraupdf', compact('pd','gestor','unidades','unidade','just_vaga_int','aprovacaoVI'));
		$pdf->setPaper('A4', 'landscape');
		return $pdf->download('degrau.pdf');
	}

	public function visualizarVagasPD()
	{
		$unidades  = Unidade::all();
		$pd        = VagaInterna::all();
		$aprovacao = AprovacaoVagaInterna::all();
		$gestores  = Gestor::all();
		return view('programaDegrau/visualizarPD', compact('unidades','pd','aprovacao','gestores'));
	}

	public function visualizarVagaPD($id)
	{
		$unidades   = Unidade::all();
		$pd 	    = VagaInterna::where('id',$id)->get();
		$id_unidade = $pd[0]->unidade_id;
		$unidade    = Unidade::where('id',$id_unidade)->get();
		$aprovacao  = AprovacaoVagaInterna::where('vaga_interna_id',$id)->get();
		$gestor     = Gestor::where('id',$pd[0]->gestor_id)->get();
		$just_vaga  = JustificativaVagaInterna::where('vaga_interna_id',$id)->get();
		$gestores   = Gestor::all();
		$comportamental = PerfilComportamentalVagaInterna::where('vaga_interna_id',$id)->get();
		$competencias   = CompetenciasVagaInterna::where('vaga_interna_id',$id)->get();
		$cargos = Cargos::orderBy('nome','ASC')->get();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		return view('programaDegrau/programaDegrauVisualizar', compact('unidades','unidade','pd','aprovacao','gestor','gestores','cargos','centro_custos','setores','centro_custo_nv','just_vaga','comportamental','competencias'));
	}

	public function pesquisaPD(Request $request)
	{
		$input = $request->all();
		if(empty($input['unidade_id'])){ $input['unidade_id'] = 0;  }
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$unidade = $input['unidade_id'];
		$pesq 	 = $input['pesq'];
		$pesq2   = $input['pesq2'];
		
		if($pesq2 == "solicitante"){
			if($unidade == "0"){
				$pd = DB::table('vaga_interna')->where('solicitante', 'like', '%' . $pesq . '%')->get();
			} else {
				$pd = DB::table('vaga_interna')->where('solicitante', 'like', '%' . $pesq . '%')
				->where('unidade_id',$unidade)->get();
			}
		} else if($pesq2 == "data"){
			$data_i = date('Y-m-d', strtotime($input['data_inicio']));
			$data_f = date('Y-m-d', strtotime($input['data_fim']));   
			if($unidade != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")){
				$data_f = date('Y-m-d', strtotime('now')); 
				$pd = DB::table('vaga_interna')
							->whereBetween('vaga_interna.data_emissao',[$data_i,$data_f])
							->where('vaga_interna.concluida',0)->where('vaga_interna.unidade_id',$unidade)
							->select('vaga_interna.*')->orderBy('vaga_interna.id')->get();
			}else if($unidade != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")){
				$pd = DB::table('vaga_interna')
							->whereBetween('vaga_interna.data_emissao',[$data_i,$data_f])
							->where('vaga_interna.concluida',0)->where('vaga_interna.unidade_id',$unidade)
							->select('vaga_interna.*')->orderBy('vaga_interna.id')->get();  
			}else if($unidade == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")){
				$pd = DB::table('vaga_interna')
							->whereBetween('vaga_interna.data_emissao',[$data_i,$data_f])
							->where('vaga_interna.concluida',0)
							->select('vaga_interna.*')->orderBy('vaga_interna.id')->get();
			}else if($unidade == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")){
				$data_f = date('Y-m-d', strtotime('now')); 
				$pd = DB::table('vaga_interna')
							->whereBetween('vaga_interna.data_emissao',[$data_i,$data_f])
							->where('vaga_interna.concluida',0)
							->select('vaga_interna.*')->orderBy('vaga_interna.id')->get();
			} else if($data_i == "1970-01-01" && $data_f == "1970-01-01") {
				$pd = VagaInterna::all();	
			}
		} else if($unidade != "0" && $pesq2 == ""){
			$pd = DB::table('vaga_interna')->where('unidade_id',$unidade)->get();
		} else {
			$pd = VagaInterna::all();
		}
		$unidades   = Unidade::all();
		$unidade    = Unidade::where('id',$unidade)->get();
		$gestores   = Gestor::all();
		$cargos = Cargos::orderBy('nome','ASC')->get();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade . '%')->orderBy('nome','ASC')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade . '%')->orderBy('nome','ASC')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade . '%')->orderBy('nome','ASC')->get();
		return view('programaDegrau/visualizarPD', compact('unidades','unidade','pd','gestores','cargos','centro_custos','setores','centro_custo_nv'));
	}

	public function validarPD()
	{
		$unidades = Unidade::all();
		$id = Auth::user()->id;
		if($id == 30) {
			$id = 198;
		}
		$aprovacao = AprovacaoVagaInterna::all();
		$vagas = DB::table('vaga_interna')
		->join('justificativa_vaga_interna','justificativa_vaga_interna.vaga_interna_id','=','vaga_interna.id')
		->select('vaga_interna.*','justificativa_vaga_interna.descricao as just')
		->where('vaga_interna.concluida',0)->where('vaga_interna.gestor_id',$id)->get();
		$gestores = Gestor::all();
		return view('programaDegrau/validarPD', compact('unidades','vagas','gestores','aprovacao'));
	}

	public function inscricaoPD()
	{
		$unidades  = Unidade::all();
		$id 	   = Auth::user()->id;
		$vagas 	   = DB::table('vaga_interna')->where('aprovada',1)->where('concluida',1)->get();
		$gestores  = Gestor::all();
		return view('programaDegrau/inscricaoPD', compact('unidades','vagas','gestores'));
	}

	public function vincularInscritosPD($id, Request $request)
	{
		$input = $request->all();
		$inscricao = DB::table('inscricao_vaga_interna')
		             ->join('vaga_interna','vaga_interna.id','=','inscricao_vaga_interna.vaga_interna_id')
					 ->join('unidade','unidade.id','=','inscricao_vaga_interna.unidade_id')
					 ->join('gestor','gestor.id','=','inscricao_vaga_interna.solicitante')
					 ->select('inscricao_vaga_interna.*','vaga_interna.vaga as vaga','gestor.nome as Nome','unidade.nome as nomeUnidade')
					 ->where('inscricao_vaga_interna.vaga_interna_id',$id)->where('inscricao_vaga_interna.concluida',1)->get();
		$vaga = VagaInterna::where('id',$id)->get(); 
		return view('programaDegrau/vincularInscritosPD', compact('inscricao','vaga'));
	}

	public function storeVincularInscricao($id, Request $request)
	{
		$input = $request->all();
		$input['vinculo']  = $input['nome_funcionario'];
		$pd = VagaInterna::find($id);
		$pd->update($input);
		$unidades = Unidade::all();
		$id 	  = Auth::user()->id;
		$vagas 	  = DB::table('vaga_interna')->where('aprovada',1)->where('concluida',1)->get();
		$gestores = Gestor::all();
		$validator = "Vínculo realizado com sucesso!!";
		$inscricao = InscricaoVagaInterna::all();
		return view('programaDegrau/inscricaoPD', compact('unidades','vagas','gestores','inscricao'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
	}

	public function inscricaoInscritosPD($id)
	{
		$unidades  = Unidade::all();
		$vagas 	   = DB::table('vaga_interna')->where('aprovada',1)->where('concluida',1)->get();
		$inscricao = DB::table('inscricao_vaga_interna')
					->join('vaga_interna','vaga_interna.id','=','inscricao_vaga_interna.vaga_interna_id')
					->select('inscricao_vaga_interna.*','vaga_interna.vaga as NomeVaga')
					->where('vaga_interna_id',$id)->get();
		$gestores  = Gestor::all();
		return view('programaDegrau/inscricaoInscritosPD', compact('unidades','vagas','gestores','inscricao'));
	}

	public function inscricaoPDs($id)
	{
		$unidades = Unidade::all();
		$pd       = VagaInterna::where('id',$id)->get();
		$unidade  = $pd[0]->unidade_id;
		$just_v   = JustificativaVagaInterna::where('vaga_interna_id',$id)->get();
		$comportamental = PerfilComportamentalVagaInterna::where('vaga_interna_id',$id)->get();
		$competencias   = CompetenciasVagaInterna::where('vaga_interna_id',$id)->get();
		$cargos = Cargos::orderBy('nome','ASC')->get();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade . '%')->orderBy('nome','ASC')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade . '%')->orderBy('nome','ASC')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade . '%')->orderBy('nome','ASC')->get();
		$unidade  = $pd[0]->unidade_id;
		$unidade  = Unidade::where('id',$unidade)->get();
		$gestores = Gestor::all();
		return view('programaDegrau/inscricaoPDs', compact('unidades','unidade','pd','gestores','just_v','comportamental','competencias','cargos','centro_custos'));
	}

	public function storeInscricaoPD($id, Request $request)
	{
		$input = $request->all();
		$validator = \Validator::make($request->all(), [
			'nome_funcionario' 	    => 'required|max:255',
			'matricula_funcionario' => 'required|max:255',
			'unidade_funcionario'   => 'required|max:255'
		]);
		if ($validator->fails()) {
			$unidades = Unidade::all();
			$pd       = VagaInterna::where('id',$id)->get();
			$unidade  = $pd[0]->unidade_id;
			$just_v   = JustificativaVagaInterna::where('vaga_interna_id',$id)->get();
			$comportamental = PerfilComportamentalVagaInterna::where('vaga_interna_id',$id)->get();
			$competencias   = CompetenciasVagaInterna::where('vaga_interna_id',$id)->get();
			$cargos = Cargos::orderBy('nome','ASC')->get();
			$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade . '%')->orderBy('nome','ASC')->get();
			$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade . '%')->orderBy('nome','ASC')->get();
			$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade . '%')->orderBy('nome','ASC')->get();
			$unidade  = $pd[0]->unidade_id;
			$unidade  = Unidade::where('id',$unidade)->get();
			$gestores = Gestor::all();
			return view('programaDegrau/inscricaoPDs', compact('unidades','unidade','pd','gestores','just_v','comportamental','competencias','cargos','centro_custos'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$input['data_emissao']    = date('Y-m-d', strtotime('now'));
			$input['data_aprovacao']  = NULL;
			$input['vaga_interna_id'] = $id;
			$inscricao = InscricaoVagaInterna::create($input);
			$email = 'janaina.lima@hcpgestao.org.br';
			$vaga = $input['vaga'];
			/*Mail::send('email.emailInscricaoPD', array($email), function($m) use ($email,$vaga) {
				$m->from('portal@hcpgestao.org.br', 'Program Degrau');
				$m->subject('Foi realizada uma Inscrição da Vaga: '.$vaga.' do Programa Degrau!!');
				$m->to($email);
			});*/
			$unidades = Unidade::all();
			$id 	  = Auth::user()->id;
			$vagas 	  = DB::table('vaga_interna')->where('aprovada',1)->where('concluida',1)->get();
			$gestores = Gestor::all();
			$validator = "Inscrição realizada com sucesso! Aguarde a aprovação final!";
			$inscricao = InscricaoVagaInterna::all();
			return view('programaDegrau/inscricaoPD', compact('unidades','vagas','gestores','inscricao'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		}
	}

	public function inscricaoAprovarPDs($id_inscricao,$id)
	{
		$unidades = Unidade::all();
		$pd       = VagaInterna::where('id',$id)->get();
		$unidade  = $pd[0]->unidade_id;
		$just_v   = JustificativaVagaInterna::where('vaga_interna_id',$id)->get();
		$comportamental = PerfilComportamentalVagaInterna::where('vaga_interna_id',$id)->get();
		$competencias   = CompetenciasVagaInterna::where('vaga_interna_id',$id)->get();
		$inscricao      = InscricaoVagaInterna::where('id',$id_inscricao)->get();
		$cargos = Cargos::orderBy('nome','ASC')->get();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade . '%')->orderBy('nome','ASC')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade . '%')->orderBy('nome','ASC')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade . '%')->orderBy('nome','ASC')->get();
		$unidade  = $pd[0]->unidade_id;
		$unidade  = Unidade::where('id',$unidade)->get();
		$gestores = Gestor::all();
		return view('programaDegrau/inscricaoAprovarPDs', compact('unidades','unidade','pd','gestores','just_v','comportamental','competencias','cargos','centro_custos','inscricao'));
	}

	public function aprovarInscricao($id_inscricao, $id, Request $request)
	{
		$unidades = Unidade::all();
		$pd = VagaInterna::where('id',$id)->get();
		$unidade   = $pd[0]->unidade_id;
		$inscricao = InscricaoVagaInterna::where('id',$id_inscricao)->get();
		$inscricao = DB::table('inscricao_vaga_interna')
					 ->join('vaga_interna','vaga_interna.id','=','inscricao_vaga_interna.vaga_interna_id')
					 ->join('gestor','gestor.id','=','inscricao_vaga_interna.solicitante')
					 ->select('inscricao_vaga_interna.*','gestor.nome as Nome','vaga_interna.vaga as vaga')
					 ->where('inscricao_vaga_interna.vaga_interna_id',$id)
					 ->where('inscricao_vaga_interna.id',$id_inscricao)
					 ->get();
		$gestores  = Gestor::all();
		return view('programaDegrau/aprovar_inscricao', compact('unidades','pd','unidade','inscricao','gestores'));
	}

	public function storeAprovarInscricao($id_inscricao, $id, Request $request)
	{
		$input = $request->all();
		$data  = date('Y-m-d', strtotime('now'));
		$input['concluida'] = 1;
		$input['aprovada'] = 1;
		$input['data_aprovacao'] = $data;
		$inscricao = InscricaoVagaInterna::find($id_inscricao);
		$inscricao->update($input);
		$inscricao = InscricaoVagaInterna::where('id',$id_inscricao)->get();
		$email = Gestor::where('id',$inscricao[0]->solicitante)->get();
		$vaga_id = $inscricao[0]->vaga_interna_id;
		$vaga  = VagaInterna::where('id',$vaga_id)->get();
		$vaga  = $vaga[0]->vaga;
		$email = 'janaina.lima@hcpgestao.org.br';
		/*Mail::send('email.emailAprovarInscricaoPD', array($email), function($m) use ($email,$vaga) {
			$m->from('portal@hcpgestao.org.br', 'Program Degrau');
			$m->subject('A Inscrição da Vaga: '.$vaga.' do Programa Degrau foi Aprovada!');
			$m->to($email);
		});*/
		$unidades  = Unidade::all();
		$vagas 	   = DB::table('vaga_interna')->where('id',$id)->get();
		$inscricao = DB::table('inscricao_vaga_interna')
					->join('vaga_interna','vaga_interna.id','=','inscricao_vaga_interna.vaga_interna_id')
					->select('inscricao_vaga_interna.*','vaga_interna.vaga as NomeVaga')
					->where('vaga_interna_id',$id)->get();
		$gestores  = Gestor::all();
		return view('programaDegrau/inscricaoInscritosPD', compact('unidades','vagas','gestores','inscricao'));
	}

	public function reprovarInscricao($id_inscricao, $id, Request $request)
	{
		$unidades = Unidade::all();
		$pd = VagaInterna::where('id',$id)->get();
		$unidade   = $pd[0]->unidade_id;
		$inscricao = InscricaoVagaInterna::where('id',$id_inscricao)->get();
		$inscricao = DB::table('inscricao_vaga_interna')
					 ->join('vaga_interna','vaga_interna.id','=','inscricao_vaga_interna.vaga_interna_id')
					 ->join('gestor','gestor.id','=','inscricao_vaga_interna.solicitante')
					 ->select('inscricao_vaga_interna.*','gestor.nome as Nome','vaga_interna.vaga as vaga')
					 ->where('inscricao_vaga_interna.vaga_interna_id',$id)
					 ->where('inscricao_vaga_interna.id',$id_inscricao)
					 ->get();
		$gestores  = Gestor::all();
		return view('programaDegrau/reprovar_inscricao', compact('unidades','pd','unidade','inscricao','gestores'));
	}

	public function storeReprovarInscricao($id_inscricao, $id, Request $request)
	{ 
		$input = $request->all();
		$data = date('Y-m-d', strtotime('now'));
		$input['concluida'] = 1;
		$input['aprovada'] = 0;
		$input['data_aprovacao'] = $data;
		$inscricao = InscricaoVagaInterna::find($id_inscricao);
		$inscricao->update($input);
		$inscricao = InscricaoVagaInterna::where('id',$id_inscricao)->get();
		$email = Gestor::where('id',$inscricao[0]->solicitante)->get();
		$vaga_id = $inscricao[0]->vaga_interna_id;
		$vaga = VagaInterna::where('id',$vaga_id)->get();
		$vaga = $vaga[0]->vaga;
		$email = 'janaina.lima@hcpgestao.org.br';
		/*Mail::send('email.emailReprovarInscricaoPD', array($email), function($m) use ($email,$vaga) {
			$m->from('portal@hcpgestao.org.br', 'Program Degrau');
			$m->subject('A Inscrição da Vaga: '.$vaga.' do Programa Degrau foi Reprovada!');
			$m->to($email);
		});*/
		$unidades  = Unidade::all();
		$vagas 	   = DB::table('vaga_interna')->where('id',$id)->get();
		$inscricao = DB::table('inscricao_vaga_interna')
					->join('vaga_interna','vaga_interna.id','=','inscricao_vaga_interna.vaga_interna_id')
					->select('inscricao_vaga_interna.*','vaga_interna.vaga as NomeVaga')
					->where('vaga_interna_id',$id)->get();
		$gestores  = Gestor::all();
		return view('programaDegrau/inscricaoInscritosPD', compact('unidades','vagas','gestores','inscricao'));
	}

	public function validarPDs(Request $request)
	{
		$input = $request->all();
		$id   = Auth::user()->id;
		if($id == 30){
			$id = 198;
		}
		$vagas = DB::table('vaga_interna')
		->join('justificativa_vaga_interna','justificativa_vaga_interna.vaga_interna_id','=','vaga_interna.id')
		->select('vaga_interna.*','justificativa_vaga_interna.descricao as just')
		->where('vaga_interna.concluida',0)->where('vaga_interna.gestor_id',$id)->get();
		$qtd = sizeof($vagas);
		$ap = 0;
		for($a = 1; $a <= $qtd; $a++){
			if(!empty($input['check_'.$a])){
				if($input['check_'.$a] == "on"){
					$id_vaga = $input['id_vaga_'.$a];
					if(Auth::user()->id == 198 || Auth::user()->id == 30){
						$idG = $input['gestor_id_'.$a]; 
						ProgramaDegrauController::aprovar($id_vaga,$idG);
					} else {
						$idG = 0; 
						ProgramaDegrauController::aprovar($id_vaga,$idG);
					}
					$ap += 1;
				}
			}
		}
		$unidades = Unidade::all();
		$vagas = DB::table('vaga_interna')
		->join('justificativa_vaga_interna','justificativa_vaga_interna.vaga_interna_id','=','vaga_interna.id')
		->select('vaga_interna.*','justificativa_vaga_interna.descricao as just')
		->where('vaga_interna.concluida',0)->where('vaga_interna.gestor_id',$id)->get();
		$gestores  = Gestor::all();
		$aprovacao = AprovacaoVagaInterna::all(); 
		if($ap == 0){
			$validator = 'Selecione uma Vaga!';
			return view('programaDegrau/validarPD', compact('unidades','vagas','gestores','aprovacao'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$validator = 'Vaga(s) Aprovada(s) com Sucesso!';
			return view('programaDegrau/validarPD', compact('unidades','vagas','gestores','aprovacao'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		}
	}

	function aprovar($id_vaga, $idG)
	{ 
		$vaga = VagaInterna::where('id',$id_vaga)->get();
		$id	  = $vaga[0]->id;
		$idU  = Auth::user()->id;
		if(Auth::user()->name == $vaga[0]->solicitante){
			$idGI = 198;
			$input['gestor_id'] = 198;
			$input['resposta']  = 1;
			$email = 'janaina.lima@hcpgestao.org.br';
			DB::statement('UPDATE vaga_interna SET gestor_id = '.$idGI.' WHERE id = '.$id.';');
			DB::statement('UPDATE aprovacao_vaga_interna SET ativo = 0 WHERE vaga_interna_id  = '.$id.';');
		} else {
			if($idU == 198 || $idU == 30){
				$input['resposta']  = 1; 	
				$input['gestor_id'] = $idG;	
				if($idG == 59){
					$email = 'isabela.coutinho@hmr.org.br';
				} else if($idG == 60) {
					$email = 'luciana.melo@hss.org.br';
				} else if($idG == 61) {
					$email = 'luciana.venancio@hcpgestao.org.br';
				} else if($idG == 155) {
					$email = 'joao.peixoto@upaecaruaru.org.br';
				} else if($idG == 160) {
					$email = 'luiz.gonzaga@upaearcoverde.org.br';
				} else if($idG == 5) { 
					$email = 'alexandra.silvestre@upaebelojardim.org.br';
				} else if($idG == 167) {
					$email = 'adriana.bezerra@upaearruda.org.br';
				}
				DB::statement('UPDATE vaga_interna SET gestor_id = '.$idG.' WHERE id = '.$id.';');
				DB::statement('UPDATE aprovacao_vaga_interna SET ativo = 0 WHERE vaga_interna_id  = '.$id.';');
			} else if($idU == 59 || $idU == 60 || $idU == 61 || $idU == 155 || $idU == 160 || $idU == 5 || $idU == 167 || $idU == 183) {
				$input['resposta'] = 3;
				$email = 'janaina.lima@hcpgestao.org.br';
				DB::statement('UPDATE vaga_interna SET concluida = 1 WHERE id  = '.$id.';');
				DB::statement('UPDATE vaga_interna SET aprovada  = 1 WHERE id  = '.$id.';');
				DB::statement('UPDATE vaga_interna SET gestor_id = 198 WHERE id = '.$id.';');
				DB::statement('UPDATE aprovacao_vaga_interna SET ativo = 0 WHERE vaga_interna_id  = '.$id.';');
				$input['gestor_id'] = 198;
				$idG = 198;
			}
		}
		$input['data_aprovacao']  = date('Y-m-d',(strtotime('now')));
		$input['gestor_anterior'] = Auth::user()->id;
		$input['unidade_id'] 	  = $vaga[0]->unidade_id;
		$input['vaga_interna_id'] = $vaga[0]->id;
		$input['motivo'] 	  	  = "Autorizado";
		$input['ativo'] 	  	  = 1;
		$aprovacao = AprovacaoVagaInterna::create($input);
		$email2 = 'leonardo.silva@hcpgestao.org.br';
		$email3 = 'ana.america@hcpgestao.org.br';
		$vaga = $vaga[0]->vaga;
		/*Mail::send('email.emailPD', array($email,$email2,$email3), function($m) use ($email,$email2,$email3,$vaga) {
			$m->from('portal@hcpgestao.org.br', 'Program Degrau');
			$m->subject('A Vaga: '.$vaga.' do Programa Degrau foi Aprovada!');
			$m->to($email);	
			$m->cc($email2);
			$m->cc($email3);
		});*/
	}

	public function n_autorizarPD($id)
	{
		$pd   = VagaInterna::where('id',$id)->get();
		$idU  = $pd[0]->unidade_id;
		$unidade   = Unidade::where('id',$idU)->get();
		$aprovacao = AprovacaoVagaInterna::where('vaga_interna_id', $id)->where('ativo',1)->get();
		$qtdAp 	   = sizeof($aprovacao);
 		$idG 	   = $pd[0]->solicitante;
		$gestores  = Gestor::where('nome',$idG)->get();
		return view('programaDegrau/home_nao_autorizado_degrau', compact('unidade','pd','gestores'));
	}

	public function storeNAutPD($id, Request $request)
	{
		$input   = $request->all();
		$vaga    = VagaInterna::where('id', $id)->get();
		$idVaga  = $vaga[0]->id;
		$idU     = $vaga[0]->unidade_id;
		$unidade = Unidade::where('id',$idU)->get();
		$input['unidade_id'] = $unidade[0]->id;
		$idG = $input['gestor_anterior'];
		$validator = Validator::make($request->all(), [
			'motivo' => 'required|max:1000'
		]);
		if ($validator->fails()) {
			return view('programaDegrau/home_autorizado_vaga', compact('unidade','vaga','gestores'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			if(!empty($input['voltarVaga'])){
				$check = $input['voltarVaga'];
				DB::statement('UPDATE vaga_interna SET concluida = 0 WHERE id = '.$id.';');
				DB::statement('UPDATE vaga_interna SET aprovada = 0 WHERE id = '.$id.';');
				DB::statement('UPDATE aprovacao_vaga_interna SET ativo = 0 WHERE vaga_interna_id = '.$id.';');
				DB::statement('UPDATE vaga_interna SET gestor_id = '.$idG.' WHERE id = '.$id.';');
				$input['vaga_id'] 		  = $idVaga;
				$input['resposta'] 		  = 1;
				$input['data_aprovacao']  = date('Y-m-d',(strtotime('now')));
				$input['gestor_anterior'] = Auth::user()->id;
				$input['ativo']           = 1;
				$aprovacao = AprovacaoVagaInterna::create($input);
				$idGA   = $input['gestor_id'];
				$gestor = Gestor::where('id', $idGA)->get();
				$nome   = Auth::user()->name;
				$idG    = Auth::user()->id;
				$email  = $gestor[0]->email;
				$motivo = $input['motivo'];
				$vaga 	= $vaga[0]->vaga;
				/*Mail::send([], [], function($m) use ($email,$motivo,$vaga,$nome) {
					$m->from('portal@hcpgestao.org.br', 'Programa Degrau');
					$m->subject('O Gestor: '.$nome.' solicitou uma mudança na sua Vaga solicitada - '.$vaga.'!!!');
					$m->setBody($motivo .'! Acesse o portal do Programa Degrau: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
				});*/
				$validator = 'Vaga voltou para o Solicitante Corrigir!!';		
			} else {
				$input['resposta'] = 3;
				DB::statement('UPDATE vaga_interna SET concluida = 1 WHERE id = '.$id.';');
				DB::statement('UPDATE vaga_interna SET aprovada = 0 WHERE id = '.$id.';');
				$input['data_aprovacao'] = date('Y-m-d',(strtotime('now')));
				DB::statement('UPDATE aprovacao_vaga_interna SET ativo = 0 WHERE vaga_interna_id = '.$id.';');
				DB::statement('UPDATE vaga_interna SET gestor_id = '.$idG.' WHERE id = '.$id.';');
				$input['gestor_id'] 	  = $input['gestor_anterior'];
				$input['gestor_anterior'] = Auth::user()->id;
				$aprovacao = AprovacaoVagaInterna::create($input);
				$gestor = Gestor::where('id', $idG)->get();
				$email  = $gestor[0]->email;
				$motivo = $input['motivo'];
				$vaga   = $vaga[0]->vaga;
				/*Mail::send([], [], function($m) use ($email,$motivo,$vaga) {
					$m->from('portal@hcpgestao.org.br', 'Programa Degrau');
					$m->subject('Sua Vaga - '.$vaga. ' Não foi Autorizada!');
					$m->setBody($motivo .'! Acesse: http:/www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
				});*/
				$validator = 'Vaga não Autorizada!!';		
			}
			$unidades = Unidade::all();
			$id = Auth::user()->id;
			$aprovacao = AprovacaoVagaInterna::all();
			$vagas = DB::table('vaga_interna')
			->join('justificativa_vaga_interna','justificativa_vaga_interna.vaga_interna_id','=','vaga_interna.id')
			->select('vaga_interna.*','justificativa_vaga_interna.descricao as just')
			->where('vaga_interna.concluida',0)->where('vaga_interna.gestor_id',$id)->get();
			$gestores = Gestor::all();
			return view('programaDegrau/validarPD', compact('unidades','vagas','gestores','aprovacao'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		}
	}

	public function autorizarPD($id)
	{
		$pd   = VagaInterna::where('id',$id)->get();
		$idU  = $pd[0]->unidade_id;
		$unidade   = Unidade::where('id',$idU)->get();
		$aprovacao = AprovacaoVagaInterna::where('vaga_interna_id', $id)->where('ativo',1)->get();
		$qtdAp 	   = sizeof($aprovacao);
 		$idG 	   = $pd[0]->solicitante;
		$gestores  = Gestor::where('nome',$idG)->get();
		return view('programaDegrau/home_autorizado_degrau', compact('unidade','pd','gestores','aprovacao'));
	}

	public function storeAutPD($id, Request $request)
	{
		$pd  = VagaInterna::where('id', $id)->get();
		$idU = $pd[0]->unidade_id;
		$unidade  = Unidade::where('id',$idU)->get();
		$aprovacao = AprovacaoVagaInterna::where('vaga_interna_id', $id)->where('ativo',1)->get();
		$qtdAp 	   = sizeof($aprovacao);
		$idG 	   = $pd[0]->solicitante;
		$gestores  = Gestor::where('nome',$idG)->get();
		$input     = $request->all();
		$validator = Validator::make($request->all(), [
			'motivo' => 'required|max:1000'
		]);
		if ($validator->fails()) {
			return view('programaDegrau/home_autorizado_degrau', compact('unidade','pd','gestores','aprovacao'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			if(Auth::user()->id == 59 || Auth::user()->id == 60 || Auth::user()->id == 61 || Auth::user()->id == 155 || Auth::user()->id == 160 || Auth::user()->id == 5 || Auth::user()->id == 167 || Auth::user()->id == 183) {
				$input['resposta'] = 3;
				DB::statement('UPDATE vaga_interna SET concluida = 1 WHERE id = '.$id.';');
				DB::statement('UPDATE vaga_interna SET aprovada = 1 WHERE id = '.$id.';');
			} else {
				$input['resposta'] = 1;	
			}
			$input['data_aprovacao'] = date('Y-m-d',(strtotime('now')));
			$idG = $input['gestor_id'];
			DB::statement('UPDATE aprovacao_vaga_interna SET ativo = 0 WHERE vaga_interna_id = '.$id.';');
			DB::statement('UPDATE vaga_interna SET gestor_id = '.$idG.' WHERE id = '.$id.';');
			$input['gestor_anterior'] = Auth::user()->id;
			$aprovacao   = AprovacaoVagaInterna::create($input);
			$gestor      = Gestor::where('id', $idG)->get();
			$email 	     = $gestor[0]->email;
			$solicitante = $pd[0]->solicitante;
			$sol = Gestor::where('nome', $solicitante)->get();
			$email = $sol[0]->email;
			$email3 = 'janaina.lima@hcpgestao.org.br';
			$email4 = 'leonadro.silva@hcpgestao.org.br';
			$motivo   = $input['motivo'];
			$vaga = $pd[0]->vaga;
			if(Auth::user()->id == 59 || Auth::user()->id == 60 || Auth::user()->id == 61 || Auth::user()->id == 155 || Auth::user()->id == 160 || Auth::user()->id == 5 || Auth::user()->id == 167 || Auth::user()->id == 183) {
				/*Mail::send([], [], function($m) use ($email,$email3,$email4,$motivo,$vaga) {
					$m->from('portal@hcpgestao.org.br', 'Programa Degrau');
					$m->subject('A Vaga: '.$vaga.' do Programa Degrau foi Assinada e está Concluída!!');
					$m->setBody($motivo .'! Acesse o portal do Programa Degrau: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
					$m->cc($email3);
					$m->cc($email4);
				});*/
			} else {
				/*Mail::send([], [], function($m) use ($email,$email4,$motivo,$vaga) {
					$m->from('portal@hcpgestao.org.br', 'Programa Degrau');
					$m->subject('A Vaga: '.$vaga.' do Programa Degrau foi Autorizada!');
					$m->setBody($motivo .'! Acesse o portal do Programa Degrau: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
					$m->cc($email4);
				});*/
			}
			$unidades = Unidade::all();
			$id = Auth::user()->id;
			$aprovacao = AprovacaoVagaInterna::all();
			$vagas = DB::table('vaga_interna')
			->join('justificativa_vaga_interna','justificativa_vaga_interna.vaga_interna_id','=','vaga_interna.id')
			->select('vaga_interna.*','justificativa_vaga_interna.descricao as just')
			->where('vaga_interna.concluida',0)->where('vaga_interna.gestor_id',$id)->get();
			$gestores = Gestor::all();
			$validator = 'Vaga(s) Aprovada(s) com Sucesso!!';		
			return view('programaDegrau/validarPD', compact('unidades','vagas','gestores','aprovacao'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		}
	}

	public function alterarPD($id) {
		$gestores  = Gestor::all();
		$unidades  = Unidade::all();
		$pd    	   = VagaInterna::where('id',$id)->get();
		$just_vaga = JustificativaVagaInterna::where('vaga_interna_id', $pd[0]->id)->get();
		$solicitante = $pd[0]->solicitante;
		$aprovacao = AprovacaoVagaInterna::where('vaga_interna_id',$id)->get();
		$comportamental = PerfilComportamentalVagaInterna::where('vaga_interna_id',$id)->get();
		$competencias   = CompetenciasVagaInterna::where('vaga_interna_id',$id)->get();
		$solic    = Gestor::where('nome',$solicitante)->get();
		$gestor   = $solic[0]->gestor_imediato;
		$gestor   = Gestor::where('nome', $gestor)->get();
		$id_unidade = $pd[0]->unidade_id;
		$unidade  = Unidade::where('id',$id_unidade)->get();
		$idVaga   = $id;
		$cargos   = Cargos::orderBy('nome','ASC')->get();
		$centro_custos = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		$setores 	   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
		return view('programaDegrau/programaDegrauAlterar', compact('unidade','gestores','unidades','pd','idVaga','cargos','centro_custos','just_vaga','gestor','aprovacao','setores','comportamental','competencias'));
   }

   public function alterarPDs($id, Request $request)
   {
	   $input = $request->all(); 
	   $validator = Validator::make($request->all(), [
			'vaga'                   => 'required|max:255',
			'departamento' 			 => 'required|max:255',
			'data_prevista'			 => 'required',
			'cargo'					 => 'required|max:255',
			'salario' 				 => 'required|max:255',
			'horario_trabalho'  	 => 'required|max:255',
			'escala_trabalho'		 => 'required|max:255',
			'centro_custo'			 => 'required|max:255',
			'jornada'				 => 'required|max:255',
			'turno'					 => 'required|max:255',
			'tipo'              	 => 'required|max:255',
			'motivo'            	 => 'required|max:255',
			'contratacao_deficiente' => 'required|max:255',
			'email'			         => 'required|max:255',
			'conhecimento_tecnico'	 => 'required|max:500',
			'conhecimento_desejado'	 => 'required|max:500',
			'formacao'				 => 'required|max:400',
			'idiomas'				 => 'required|max:400',
			'descricao'				 => 'required|max:3000'
		]);
		if ($validator->fails()) {
			$pd = VagaInterna::where('id',$id)->get();
			$just_vaga = JustificativaVagaInterna::where('vaga_interna_id', $pd[0]->id)->get();
			$aprovacao = AprovacaoVagaInterna::where('vaga_interna_id',$id)->get();
			$competencias   = CompetenciasVagaInterna::where('vaga_interna_id',$id)->get(); 
			$comportamental = PerfilComportamentalVagaInterna::where('vaga_interna_id',$id)->get();
			$id_unidade  = $pd[0]->unidade_id;
			$unidade  = Unidade::where('id',$id_unidade)->get();	
			$unidades = Unidade::all();
			$cargos   = Cargos::orderBy('nome','ASC')->get();
			$centro_custos = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
			$setores 	  = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->orderBy('nome','ASC')->get();
			return view('programaDegrau/programaDegrauAlterar', compact('unidade','pd','unidades','cargos','centro_custos','setores','just_vaga','aprovacao','competencias','comportamental'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		} else {
			$input['data_emissao']  = date('Y-m-d', strtotime($input['data_emissao']));
			$input['data_prevista'] = date('Y-m-d', strtotime($input['data_prevista']));
			$input['gestor_id'] = Auth::user()->id;
			$input['concluida'] = 0;
			$input['aprovada']  = 0;
			$input['vinculo']   = 0;
			$pd = VagaInterna::find($id);
			$pd->update($input);
			$just = JustificativaVagaInterna::where('vaga_interna_id',$id)->get();
			$id_j = $just[0]->id; 
			$input['vaga_interna_id'] = $id;
			$just = JustificativaVagaInterna::find($id_j);
			$just->update($input);
			$b = 0;
			for($j = 1; $j <= 9; $j++) {
				if(!empty($input['motivoB' .$j]) && $b == 0) {
					$comp = DB::statement("DELETE FROM competencias_vaga_interna WHERE vaga_interna_id = ".$id);
					$b = 1;
				}
				if(!empty($input['motivoB' .$j]) && $b == 1){
					if($input['motivoB' .$j] == "outros") {
						$input['outros']    = $input['outras_competencias'];
						$input['descricao'] = "outros";
					} else {
						$input['descricao'] = $input['motivoB' .$j];
					}
					$input['vaga_id'] = $id;
					$competencias = CompetenciasVagaInterna::create($input);
				}
			}
			$a = 0;
			for($i = 1; $i <= 11; $i++) {
				if(!empty($input['comportamentalB' .$i]) && $a == 0) {
					$comp = DB::statement("DELETE FROM perfil_comportamental_vaga_interna WHERE vaga_interna_id = ".$id);
					$a = 1;
				}
				if(!empty($input['comportamentalB' .$i]) && $a == 1){
					if($input['comportamentalB' .$i] == "outros"){
						$input['outros'] = $input['perfil'];
						$input['descricao'] = "outros";
					} else {
						$input['descricao'] = $input['comportamentalB' .$i];
					}
					$input['vaga_interna_id'] = $id;
					$comportamental = PerfilComportamentalVagaInterna::create($input);
				}
			}
			$email = 'janaina.lima@hcpgestao.org.br';
			$vaga  = $input['vaga'];
			/*Mail::send([], [], function($m) use ($email,$vaga) {
				$m->from('portal@hcpgestao.org.br', 'Programa Degrau');
				$m->subject('A Vaga: '.$vaga.' do Programa Degrau foi Alterada!');
				$m->setBody('Acesse o portal do Programa Degrau: www.hcpgestao-mprh.hcpgestao.org.br');
				$m->to($email);
			});*/
			$unidades = Unidade::all();
			$id = Auth::user()->id;
			$aprovacao = AprovacaoVagaInterna::all();
			$vagas = DB::table('vaga_interna')
			->join('justificativa_vaga_interna','justificativa_vaga_interna.vaga_interna_id','=','vaga_interna.id')
			->select('vaga_interna.*','justificativa_vaga_interna.descricao as just')
			->where('vaga_interna.concluida',0)->where('vaga_interna.gestor_id',$id)->get();
			$gestores = Gestor::all();
			$validator = 'Vaga Alterada com Sucesso!!';		
			return Redirect::to('homeProgramaDegrau/validarPD')->with('unidades','unidade','gestor','gestores','just_vaga','aprovacao','pd')
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		}
   }

   public function updatePDs($id, Request $request)
   {
	   $input = $request->all();
	   $input['gestor_id'] = 198;
	   $input['data_emissao']  = date('Y-m-d', strtotime($input['data_emissao']));
	   $input['data_prevista'] = date('Y-m-d', strtotime($input['data_prevista']));
	   $input['vinculo'] = 0;
	   $pd = VagaInterna::find($id); 
	   $pd->update($input);	   
	   $unidades = Unidade::all();
	   $id = Auth::user()->id;
	   $aprovacao = AprovacaoVagaInterna::all();
	   $vagas = DB::table('vaga_interna')
		->join('justificativa_vaga_interna','justificativa_vaga_interna.vaga_interna_id','=','vaga_interna.id')
		->select('vaga_interna.*','justificativa_vaga_interna.descricao as just')
		->where('vaga_interna.concluida',0)->where('vaga_interna.gestor_id',$id)->get();
	   $gestores = Gestor::all();
	   $validator = 'Vaga Alterada com Sucesso!!';		
	   return view('programaDegrau/validarPD', compact('unidades','vagas','gestores','aprovacao'))	
	   		->withErrors($validator)
			->withInput(session()->flashInput($request->input()));
   }
}