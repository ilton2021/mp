<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\JustificativaVaga;
use App\Model\Vaga;
use App\Model\Comportamental;
use App\Model\Competencias;
use App\Model\AprovacaoVaga;
use App\Model\Aprovacao;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use DB;
use Validator;
use \PDF;
use Barryvdh\DomPDF\Facade;
use App\Model\Unidade;
use App\Model\Gestor;
use App\Model\Cargos;
use App\Model\CentroCusto;


class VagaController extends Controller
{
	public function inicioVaga(){
		$unidades  = Unidade::all();
		$vagas 	   = Vaga::all();
		$aprovacao = Aprovacao::all();
		$gestores  = Gestor::all();
		return view('/welcome_vaga', compact('unidades','vagas','aprovacao','gestores'));
	}
	
    public function indexVaga2() {
		$unidades   = Unidade::all();
		$usuario_id = Auth::user()->id;
		$gestor     = Gestor::where('id',$usuario_id)->get();	
        return view('welcome_v', compact('unidades','gestor'));
    }
	
	public function vaga($id_vaga)
    {
		$unidades   = Unidade::where('id',$id_vaga)->get();
		$usuario_id = Auth::user()->id;
		$gestor 	= Gestor::where('id',$usuario_id)->get();
		return view('vaga', compact('unidades','gestor'));
    }
	
	public function visualizarVagas()
	{
		$unidades  = Unidade::all();
		$vagas 	   = Vaga::all();
		$aprovacao = Aprovacao::all();
		$gestores  = Gestor::all();
		return view('visualizarVagas', compact('unidades','vagas','aprovacao','gestores'));
	}
	
	public function criadasVagas()
	{
		$unidades  = Unidade::all();
		$vagas 	   = Vaga::orderBy('id', 'ASC')->get();
		$aprovacao = Aprovacao::all();
		$gestores  = Gestor::all();
		return view('criadasVagas', compact('unidades','vagas','aprovacao','gestores'));
	}
	
	public function aprovadasVagas()
	{
		$unidades  = Unidade::all();
		$vagas 	   = Vaga::orderBy('id', 'ASC')->get();
		$aprovacao = AprovacaoVaga::all();
		$gestores  = Gestor::all();
		return view('aprovadasVagas', compact('unidades','vagas','aprovacao','gestores'));
	}
	
	public function reprovadasVagas()
	{
		$unidades  = Unidade::all();
		$vagas 	   = Vaga::orderBy('id', 'ASC')->get();
		$aprovacao = AprovacaoVaga::all();
		$gestores  = Gestor::all();
		return view('reprovadasVagas', compact('unidades','vagas','aprovacao','gestores'));
	}
	
	public function pesquisaVagas(Request $request)
	{
		$unidades   = Unidade::all();
		$vagas 	    = Vaga::all();
		$aprovacao  = AprovacaoVaga::all();
		$gestores   = Gestor::all();
		$input 	    = $request->all();
		if(empty($input['unidade_id'])){ $input['unidade_id'] = 0;  }
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$unidade_id = $input['unidade_id'];
		$pesq 	    = $input['pesq'];
		$pesq2      = $input['pesq2'];
		if($unidade_id != "0" && $pesq == "") {
			$vagas = DB::table('vaga')->where('vaga.unidade_id', $unidade_id)
			->where('concluida', 0)->get();	
		} else if ($unidade_id == 0 && $pesq != "") {
			if($pesq2 == "vaga"){
				$vagas = DB::table('vaga')->where('vaga.vaga', 'like', '%' . $pesq . '%')
				->where('concluida', 0)->get();	
			} else if($pesq2 == "solicitante") {
				$vagas = DB::table('vaga')->where('vaga.solicitante', 'like', '%' . $pesq . '%')
				->where('concluida', 0)->get();
			}
		} else if($unidade_id != "0" && $pesq != "") {
			if($pesq2 == "vaga"){
				$vagas = DB::table('vaga')
				->where('vaga.vaga', 'like', '%' . $pesq . '%')
				->where('vaga.unidade_id', $unidade_id)
				->where('vaga.concluida', 0)->get();
			} else if($pesq2 == "solicitante") {
				$vagas = DB::table('vaga')
				->where('vaga.solicitante', 'like', '%' . $pesq . '%')
				->where('vaga.unidade_id', $unidade_id)
				->where('vaga.concluida', 0)->get();
			}
		} else {
			$vagas = Vaga::orderBy('vaga', 'ASC')->get();
		}
		return view('criadasVagas', compact('unidades','vagas','aprovacao','gestores'));
	}
	
	public function pesquisaVagasAp(Request $request)
	{
		$unidades   = Unidade::all();
		$vagas 	    = Vaga::all();
		$aprovacao  = AprovacaoVaga::all();
		$gestores   = Gestor::all();
		$input 	    = $request->all();
		if(empty($input['unidade_id'])){ $input['unidade_id'] = 0;  }
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$unidade_id = $input['unidade_id'];
		$pesq 	    = $input['pesq'];
		$pesq2      = $input['pesq2'];
		if($unidade_id != "0" && $pesq == "") {
			$vagas = DB::table('vaga')->where('vaga.unidade_id', $unidade_id)
			->where('concluida', 1)->where('aprovada', 1)->get();	
		} else if ($unidade_id == 0 && $pesq != "") {
			if($pesq2 == "vaga"){
				$vagas = DB::table('vaga')->where('vaga.vaga', 'like', '%' . $pesq . '%')
				->where('concluida', 1)->where('aprovada', 1)->get();	
			} else if($pesq2 == "solicitante") {
				$mps = DB::table('vaga')->where('vaga.solicitante', 'like', '%' . $pesq . '%')
				->where('concluida', 1)->where('aprovada', 1)->get();
			}
		} else if($unidade_id != "0" && $pesq != "") {
			if($pesq2 == "vaga"){
				$vagas = DB::table('vaga')
				->where('vaga.numeroMP', 'like', '%' . $pesq . '%')
				->where('vaga.unidade_id', $unidade_id)
				->where('vaga.concluida', 1)->where('aprovada', 1)->get();
			} else if($pesq2 == "solicitante") {
				$vagas = DB::table('vaga')
				->where('vaga.solicitante', 'like', '%' . $pesq . '%')
				->where('vaga.unidade_id', $unidade_id)
				->where('vaga.concluida', 1)->where('aprovada', 1)->get();
			}
		} else {
			$vagas = Vaga::orderBy('vaga', 'ASC')->get();
		}
		return view('aprovadasVagas', compact('unidades','vagas','aprovacao','gestores'));
	}
	
	public function pesquisaVagasRe(Request $request)
	{
		$unidades   = Unidade::all();
		$vagas 	    = Vaga::all();
		$aprovacao  = AprovacaoVaga::all();
		$gestores   = Gestor::all();
		$input 	    = $request->all();
		if(empty($input['unidade_id'])){ $input['unidade_id'] = 0;  }
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$unidade_id = $input['unidade_id'];
		$pesq 	    = $input['pesq'];
		$pesq2      = $input['pesq2'];
		if($unidade_id != "0" && $pesq == "") {
			$vagas = DB::table('vaga')->where('vaga.unidade_id', $unidade_id)
			->where('concluida', 1)->where('aprovada', 0)->get();	
		} else if ($unidade_id == 0 && $pesq != "") {
			if($pesq2 == "vaga"){
				$vagas = DB::table('vaga')->where('vaga.vaga', 'like', '%' . $pesq . '%')
				->where('concluida', 1)->where('aprovada', 0)->get();	
			} else if($pesq2 == "solicitante") {
				$vagas = DB::table('vaga')->where('vaga.solicitante', 'like', '%' . $pesq . '%')
				->where('concluida', 1)->where('aprovada', 0)->get();
			}
		} else if($unidade_id != "0" && $pesq != "") {
			if($pesq2 == "vaga"){
				$vagas = DB::table('vaga')
				->where('vaga.vaga', 'like', '%' . $pesq . '%')
				->where('vaga.unidade_id', $unidade_id)
				->where('vaga.concluida', 1)->where('aprovada', 0)->get();
			} else if($pesq2 == "solicitante") {
				$vagas = DB::table('vaga')
				->where('vaga.solicitante', 'like', '%' . $pesq . '%')
				->where('vaga.unidade_id', $unidade_id)
				->where('vaga.concluida', 1)->where('aprovada', 0)->get();
			}
		} else {
			$vagas = Vaga::orderBy('vaga', 'ASC')->get();
		}
		return view('reprovadasVagas', compact('unidades','vagas','aprovacao','gestores'));
	}
	
	public function indexValidaVaga()
	{
		$vagas 	   = Vaga::all();
		$aprovacao = Aprovacao::all();
		$text 	   = false;
		$gestores  = Gestor::all();
		return view('validar_vaga', compact('text','vagas','aprovacao','gestores'));
	}
	
	public function validarVaga($id) {
		$vagas  	 = Vaga::where('id', $id)->get();
		$solicitante = $vagas[0]->solicitante;
		$solic    = Gestor::where('nome',$solicitante)->get();
		$gestor   = $solic[0]->gestor_imediato;
		$gestor   = Gestor::where('nome', $gestor)->get();
		$gestores = Gestor::all();
		$unidades = Unidade::all();
		$idU 		   = $vagas[0]->unidade_id;
		$unidade 	   = Unidade::where('id', $idU)->get();
		$justificativa = JustificativaVaga::where('vaga_id', $id)->get();
		$aprovacao 	   = AprovacaoVaga::where('vaga_id',$id)->get();
		$qtdA 		   = sizeof($aprovacao);
		$data_aprovacao 		= null;
		$data_gestor_imediato 	= null;
		$data_rec_humanos 		= null;
		$data_diretoria_tecnica = null;
		$data_diretoria 		= null;
		$data_superintendencia  = null;
		$solicitante = $vagas[0]->solicitante;
		$gestorData   = ""; $gestorDataId = "";
		$rh           = ""; $rhId    	  = "";
		$diretoriaT   = ""; $diretoriaTId = "";
		$diretoria    = ""; $diretoriaId  = "";
		$super        = ""; $superId      = "";
		$data_aprovacao = $vagas[0]->created_at; 	
		for($i = 0; $i < $qtdA; $i++) {
			$idU = $aprovacao[$i]->gestor_anterior;
			$funcao = User::where('id', $idU)->get();
			$funcao = $funcao[0]['funcao'];
			if($aprovacao[$i]->resposta == 1 && $funcao == "Gestor Imediato") {
				$data_gestor_imediato = $aprovacao[$i]->data_aprovacao;
				$gestorA = $aprovacao[$i]->gestor_anterior;  
    				if($gestorA != ""){
    				    $gestorData = Gestor::where('id', $gestorA)->get('nome');
						$gestorDataId = Gestor::where('id', $gestorA)->get('id');
    				} else {
    				    $gestorData = ""; 
    				}
			}		
			if($aprovacao[$i]->resposta == 1 && $funcao == "RH"){
				$data_rec_humanos = $aprovacao[$i]->data_aprovacao;
				$gestorB = $aprovacao[$i]->gestor_anterior;  
				if($gestorB != ""){
    			   $rh = Gestor::where('id', $gestorB)->get('nome'); 
				   $rhId = Gestor::where('id', $gestorB)->get('id'); 
    			} else {
    			   $rh = ""; 
    			}
			}
			if($aprovacao[$i]->resposta == 1 && $funcao == "Diretoria Tecnica"){
				$data_diretoria_tecnica = $aprovacao[$i]->data_aprovacao;
				$gestorC = $aprovacao[$i]->gestor_anterior;  
    			if($gestorC != ""){
    			    $diretoriaT = Gestor::where('id', $gestorC)->get('nome'); 
					$diretoriaTId = Gestor::where('id', $gestorC)->get('id'); 
    			} else {
    			    $diretoriaT = ""; 
    			}
			} 
			if($aprovacao[$i]->resposta == 1 && $funcao == "Diretoria"){
				$data_diretoria = $aprovacao[$i]->data_aprovacao;
				$gestorD = $aprovacao[$i]->gestor_anterior;  
			    if($gestorD != ""){
    			   $diretoria = Gestor::where('id', $gestorD)->get('nome'); 
				   $diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
    			} else {
    			   $diretoria = ""; 
    			}
			}
			if($aprovacao[$i]->resposta == 3 && $funcao == "Superintendencia"){
				$data_superintendencia = $aprovacao[$i]->data_aprovacao;
				$gestorE = $aprovacao[$i]->gestor_anterior;  
			    if($gestorE != ""){
					$super = Gestor::where('id', $gestorE)->get('nome');
					$superId = Gestor::where('id', $gestorE)->get('id');	
    			} else {
    				$super = ""; 
    			}    
			}
		}
		$text = false;
		$comportamental = Comportamental::where('vaga_id', $id)->get();
		$competencias   = Competencias::where('vaga_id', $id)->get();
		return view('visualizar_vagas', compact('vagas','gestores','unidades','unidade','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria','data_superintendencia','aprovacao','text','solicitante','gestorData','rh','diretoriaT','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaId','superId','gestor','comportamental','competencias'));
	}
	
	public function visualizarVaga($id)
	{
		$vagas  = Vaga::where('id', $id)->get();
		$idVaga = $vagas[0]->id; 
		$solicitante = $vagas[0]->solicitante;
		$solic    = Gestor::where('nome',$solicitante)->get();
		$gestor   = $solic[0]->gestor_imediato;
		$gestor   = Gestor::where('nome', $gestor)->get();
		$gestores = Gestor::all();
		$unidades = Unidade::all();
		$idU = $vagas[0]->unidade_id;
		$unidade = Unidade::where('id', $idU)->get();
		$justificativa = JustificativaVaga::where('vaga_id', $id)->get();
		$aprovacao = AprovacaoVaga::where('vaga_id',$id)->get();
		$qtdA = sizeof($aprovacao);
		$data_aprovacao 		= null;
		$data_gestor_imediato 	= null;
		$data_rec_humanos 		= null;
		$data_diretoria_tecnica = null;
		$data_diretoria 		= null;
		$data_superintendencia  = null;
		$gestorData   = ""; $gestorDataId = "";
		$rh           = ""; $rhId    	  = "";
		$diretoriaT   = ""; $diretoriaTId = "";
		$diretoria    = ""; $diretoriaId  = "";
		$super        = ""; $superId      = "";
		$data_aprovacao = $vagas[0]->created_at;		
		for($i = 0; $i < $qtdA; $i++) {
			$idU = $aprovacao[$i]->gestor_anterior;
			$funcao = User::where('id', $idU)->get();
			$funcao = $funcao[0]['funcao'];
			
			if($aprovacao[$i]->resposta == 1 && $funcao == "Gestor Imediato") {
				$data_gestor_imediato = $aprovacao[$i]->data_aprovacao;
				$gestorA = $aprovacao[0]->gestor_anterior;  
    				if($gestorA != ""){
    				    $gestorData = Gestor::where('id', $gestorA)->get('nome');
						$gestorDataId = Gestor::where('id', $gestorA)->get('id');
    				} else {
    				    $gestorData = ""; 
    				}
			}		
			if($aprovacao[$i]->resposta == 1 && $funcao == "RH" || (Auth::user()->id == 32 || Auth::user()->id == 23)){
				$data_rec_humanos = $aprovacao[$i]->data_aprovacao;
				
				    if($aprovacao[$i]->gestor_anterior == 30){
				        $gestorB = $aprovacao[$i]->gestor_anterior;  
				    }
				    if($gestorB != ""){
    				    $rh = Gestor::where('id', $gestorB)->get('nome'); 
						$rhId = Gestor::where('id', $gestorB)->get('id'); 
    				} else {
    				    $rh = ""; 
    				}
				    
			} else if ($aprovacao[$i]->resposta == 3 && $funcao == "RH" || (Auth::user()->id == 32 || Auth::user()->id == 23)){
			    $data_rec_humanos = $aprovacao[$i]->data_aprovacao;
				if($qtdA == 1) {
				    $gestorB = $aprovacao[0]->gestor_anterior;  
				    if($gestorB != ""){
    				    $rh = Gestor::where('id', $gestorB)->get('nome'); 
						$rhId = Gestor::where('id', $gestorB)->get('id'); 
    				} else {
    				    $rh = ""; 
    				}
				} else if ($qtdA == 2) {
				    $gestorB = $aprovacao[1]->gestor_anterior;  
				    if($gestorB != ""){
    				    $rh = Gestor::where('id', $gestorB)->get('nome'); 
						$rhId = Gestor::where('id', $gestorB)->get('id'); 
    				} else {
    				    $rh = ""; 
    				}
				} else if ($qtdA == 3) {
				    $gestorB = $aprovacao[2]->gestor_anterior;  
				    if($gestorB != ""){
    				    $rh = Gestor::where('id', $gestorB)->get('nome'); 
						$rhId = Gestor::where('id', $gestorB)->get('id'); 
    				} else {
    				    $rh = ""; 
    				}
				}
			    
			}
			if($aprovacao[$i]->resposta == 1 && $funcao == "Diretoria Tecnica"){
				$data_diretoria_tecnica = $aprovacao[$i]->data_aprovacao;
				if($aprovacao[$i]->gestor_anterior == 65){
				    $gestorC = $aprovacao[$i]->gestor_anterior;
				} 
					if($gestorC != ""){
    				    $diretoriaT = Gestor::where('id', $gestorC)->get('nome'); 
						$diretoriaTId = Gestor::where('id', $gestorC)->get('id'); 
    				} else {
    				    $diretoriaT = ""; 
    				}
			} else if($aprovacao[$i]->resposta == 3 && $funcao == "Diretoria Tecnica") {
				$data_diretoria_tecnica = $aprovacao[$i]->data_aprovacao;
				if($aprovacao[$i]->gestor_anterior == 65){
				    $gestorC = $aprovacao[$i]->gestor_anterior;
				}
    				if($gestorC != ""){
    				    $diretoriaT = Gestor::where('id', $gestorC)->get('nome'); 
						$diretoriaTId = Gestor::where('id', $gestorC)->get('id'); 
    				} else {
    				    $diretoriaT = ""; 
    				}
			}
			if($aprovacao[$i]->resposta == 1 && $funcao == "Diretoria"){
				$data_diretoria = $aprovacao[$i]->data_aprovacao; 
				if($qtdA == 1) {
					$gestorD = $aprovacao[0]->gestor_anterior;  
				    if($gestorD != ""){
    				    $diretoria = Gestor::where('id', $gestorD)->get('nome'); 
						$diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
    				} else {
    				    $diretoria = ""; 
    				}
				}
				if($qtdA == 2) {
					$gestorD = $aprovacao[0]->gestor_anterior;  
				    if($gestorD != ""){
    				    $diretoria = Gestor::where('id', $gestorD)->get('nome'); 
						$diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
    				} else {
    				    $diretoria = ""; 
    				}
				} else if($qtdA == 3) {
				    if(($aprovacao[$i]->gestor_anterior == 60) || ($aprovacao[$i]->gestor_anterior == 59) || ($aprovacao[$i]->gestor_anterior == 61)){
				        $gestorD = $aprovacao[$i]->gestor_anterior;
				    }
				    if($gestorD != ""){
    				    $diretoria = Gestor::where('id', $gestorD)->get('nome'); 
						$diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
    				} else {
    				    $diretoria = ""; 
    				}
				} else if($qtdA == 4) {
					$gestorD = $aprovacao[2]->gestor_anterior;  
				    if($gestorD != ""){
    				    $diretoria = Gestor::where('id', $gestorD)->get('nome'); 
						$diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
    				} else {
    				    $diretoria = ""; 
    				}
				} else if($qtdA == 5) {
					$gestorD = $aprovacao[2]->gestor_anterior;  
				    if($gestorD != ""){
    				    $diretoria = Gestor::where('id', $gestorD)->get('nome'); 
						$diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
    				} else {
    				    $diretoria = ""; 
    				}
				}
			} else if ($aprovacao[$i]->resposta == 3 && $funcao == "Diretoria") {
				$data_diretoria = $aprovacao[$i]->data_aprovacao; 
				if($qtdA == 1) {
					$gestorD = $aprovacao[0]->gestor_anterior;  
				    if($gestorD != ""){
    				    $diretoria = Gestor::where('id', $gestorD)->get('nome'); 
						$diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
    				} else {
    				    $diretoria = ""; 
    				}
				}
				if($qtdA == 2) {
					$gestorD = $aprovacao[1]->gestor_anterior;  
				    if($gestorD != ""){
    				    $diretoria = Gestor::where('id', $gestorD)->get('nome'); 
						$diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
    				} else {
    				    $diretoria = ""; 
    				}
				} else if($qtdA == 3) {
					$gestorD = $aprovacao[2]->gestor_anterior;  
				    if($gestorD != ""){
    				    $diretoria = Gestor::where('id', $gestorD)->get('nome'); 
						$diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
    				} else {
    				    $diretoria = ""; 
    				}
				} else if($qtdA == 4) {
					$gestorD = $aprovacao[3]->gestor_anterior;  
				    if($gestorD != ""){
    				    $diretoria = Gestor::where('id', $gestorD)->get('nome'); 
						$diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
    				} else {
    				    $diretoria = ""; 
    				}
				}	
			}
			if($aprovacao[$i]->resposta == 3 && $funcao == "Superintendencia"){
				$data_superintendencia = $aprovacao[$i]->data_aprovacao;
				if($qtdA == 2) {
					$gestorE = $aprovacao[1]->gestor_anterior;  
				    if($gestorE != ""){
    				    $super = Gestor::where('id', $gestorE)->get('nome');
						$superId = Gestor::where('id', $gestorE)->get('id');	
    				} else {
    				    $super = ""; 
    				}
				} else if($qtdA == 3) {
					$gestorE = $aprovacao[2]->gestor_anterior;  
				    if($gestorE != ""){
    				    $super = Gestor::where('id', $gestorE)->get('nome');
						$superId = Gestor::where('id', $gestorE)->get('id');	
    				} else {
    				    $super = ""; 
    				}
				} else if($qtdA == 4) {
					$gestorE = $aprovacao[3]->gestor_anterior;  
				    if($gestorE != ""){
    				    $super = Gestor::where('id', $gestorE)->get('nome');
						$superId = Gestor::where('id', $gestorE)->get('id');	
    				} else {
    				    $super = ""; 
    				}
				} else if($qtdA == 5) {
					$gestorE = $aprovacao[4]->gestor_anterior;  
				    if($gestorE != ""){
    				    $super = Gestor::where('id', $gestorE)->get('nome');
						$superId = Gestor::where('id', $gestorE)->get('id');	
    				} else {
    				    $super = ""; 
    				}
				}   
			}
		}
		$comportamental = Comportamental::where('vaga_id', $idVaga)->get();
		$competencias   = Competencias::where('vaga_id', $idVaga)->get();
		return view('visualizar_vagas', compact('vagas','gestores','unidades','unidade','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria','data_superintendencia','aprovacao','solicitante','gestorData','rh','diretoriaT','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaId','superId','gestor','comportamental','competencias'));
	}
	
	public function autorizarVaga($id)
	{
		$vaga      = Vaga::where('id',$id)->get();
		$idU 	   = $vaga[0]->unidade_id;
		$unidade   = Unidade::where('id',$idU)->get();
		$idMP 	   = $vaga[0]->id;
		$aprovacao = AprovacaoVaga::where('vaga_id', $idMP)->get();
		$email 	   = Auth::user()->email; 
		$gestores  = Gestor::where('email',$email)->get();
		$gestorImediato = $gestores[0]->gestor_imediato;
		$gestores	 = Gestor::where('nome',$gestorImediato)->get();
		$gestoresUnd = DB::select("SELECT * FROM gestor WHERE (unidade_id = ".$idU.") AND id <> 60 AND id <> 59 AND id <> 61 AND id <> 15 AND id <> 65 ORDER BY nome");
		$text 		 = false;
		return view('home_autorizado_vaga', compact('unidade','vaga','gestores','text','gestorImediato','gestoresUnd','aprovacao'));
	}
	
	public function storeAutVaga($id, Request $request)
	{
		$vaga 	  = Vaga::where('id', $id)->get();
		$idU  	  = $vaga[0]->unidade_id;
		$idVaga   = $id;
		$unidade  = Unidade::where('id',$idU)->get();
		$gestores = Gestor::all();
		$gestoresUnd = Gestor::where('unidade_id', $idU)->get();
		$input = $request->all();
		$v = \Validator::make($request->all(), [
			'motivo' => 'required|max:1000'
		]);
		if ($v->fails()) {
			$failed = $v->failed();
			if ( empty($failed['motivo']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo justificativa é obrigatório!','class'=>'green white-text']);
			}
			$text = true;
			return view('home_autorizado_vaga', compact('unidade','vaga','gestores','text','gestoresUnd'));
		} else {
			if(Auth::user()->funcao == "Superintendencia") {
			$input['resposta'] = 3;
			DB::statement('UPDATE vaga SET concluida = 1 WHERE id = '.$id.';');
			DB::statement('UPDATE vaga SET aprovada = 1 WHERE id = '.$id.';');
			} else {
				$input['resposta'] = 1;	
			}
			$input['data_aprovacao'] = date('Y-m-d',(strtotime('now')));
			$idG = $input['gestor_id'];
			DB::statement('UPDATE aprovacao_vaga SET ativo = 0 WHERE vaga_id = '.$id.';');
			DB::statement('UPDATE vaga SET gestor_id = '.$idG.' WHERE id = '.$id.';');
			$input['gestor_anterior'] = Auth::user()->id;
			$aprovacao   = AprovacaoVaga::create($input);
			$gestor      = Gestor::where('id', $idG)->get();
			$email 	     = $gestor[0]->email;
			$solicitante = $vaga[0]->solicitante;
			$sol 	= Gestor::where('nome', $solicitante)->get();
			$email2 = $sol[0]->email;
			//$email3 = 'janaina.lima@hcpgestao.org.br'; 
			$email3 = "";
			//$email4 = 'rogerio.reis@hcpgestao.org.br';
			$email4 = "";
			$motivo   = $input['motivo'];
			$vaga 	  = $vaga[0]->vaga;
			if(Auth::user()->funcao == "Superintendencia"){
				Mail::send([], [], function($m) use ($email,$email2,$email3,$email4,$motivo,$vaga) {
					$m->from('portal@hcpgestao.org.br', 'Solicitação de Vaga');
					$m->subject('Vaga - '.$vaga.' foi Assinada e está Concluída!!');
					$m->setBody($motivo .'! Acesse o portal da Solicitação de Vaga: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
					$m->cc($email2);
					$m->cc($email3);
					$m->cc($email4);
				});
			} else {
				Mail::send([], [], function($m) use ($email,$motivo,$vaga) {
					$m->from('portal@hcpgestao.org.br', 'Solicitação de Vaga');
					$m->subject('Vaga - '.$vaga.' Autorizada!');
					$m->setBody($motivo .'! Acesse o Portal da Solicitação de Vaga: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
				});
			}
			return view('home_vaga', compact('unidade','idG','idVaga'));
		}
	}
	
	public function storeNAutVaga($id, Request $request)
	{
		$input   = $request->all();
		$vaga    = Vaga::where('id', $id)->get();
		$idVaga  = $vaga[0]->id;
		$idU     = $vaga[0]->unidade_id;
		$unidade = Unidade::where('id',$idU)->get();
		$input['unidade_id'] = $unidade[0]->id;
		$idG = $input['gestor_anterior'];
		$v = \Validator::make($request->all(), [
			'motivo' => 'required|max:1000'
		]);
		if ($v->fails()) {
			$failed = $v->failed();
			if ( empty($failed['motivo']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo justificativa é obrigatório!','class'=>'green white-text']);
			} else if ( empty($failed['motivo']['Max']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo justificativa possui no máximo 1000 caracteres!','class'=>'green white-text']);
			}
			$text = true;
			return view('home_autorizado_vaga', compact('unidade','vaga','gestores','text'));
		} else {
			if(!empty($input['voltarVaga'])){
				$check = $input['voltarVaga'];
				DB::statement('UPDATE vaga SET concluida = 0 WHERE id = '.$id.';');
				DB::statement('UPDATE vaga SET aprovada = 0 WHERE id = '.$id.';');
				DB::statement('UPDATE aprovacao_vaga SET ativo = 0 WHERE vaga_id = '.$id.';');
				DB::statement('UPDATE vaga SET gestor_id = '.$idG.' WHERE id = '.$id.';');
				$input['vaga_id'] 		  = $idVaga;
				$input['resposta'] 		  = 1;
				$input['data_aprovacao']  = date('Y-m-d',(strtotime('now')));
				$input['gestor_anterior'] = Auth::user()->id;
				$input['ativo']           = 1;
				$aprovacao = AprovacaoVaga::create($input);
				$idGA   = $input['gestor_id'];
				$gestor = Gestor::where('id', $idGA)->get();
				$nome   = Auth::user()->name;
				$idG    = Auth::user()->id;
				if($idG == 41){
				    if($idU == 7) {
				        $idG = 41;
				        DB::statement('UPDATE vaga SET gestor_id = '.$idG.' WHERE id = '.$id.';');
				    } else {
				        $idG = 50;
				        DB::statement('UPDATE vaga SET gestor_id = '.$idG.' WHERE id = '.$id.';');
				    }
				}
				$email  = $gestor[0]->email;
				$motivo = $input['motivo'];
				$vaga 	= $vaga[0]->vaga;
				Mail::send([], [], function($m) use ($email,$motivo,$vaga,$nome) {
					$m->from('portal@hcpgestao.org.br', 'Solicitação de Vaga');
					$m->subject('O Gestor: '.$nome.' solicitou uma mudança na sua Vaga solicitada - '.$vaga.'!!!');
					$m->setBody($motivo .'! Acesse o portal da Solicitação de Vaga: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
				});
			} else {
				$input['resposta'] = 3;
				DB::statement('UPDATE vaga SET concluida = 1 WHERE id = '.$id.';');
				DB::statement('UPDATE vaga SET aprovada = 0 WHERE id = '.$id.';');
				$input['data_aprovacao'] = date('Y-m-d',(strtotime('now')));
				DB::statement('UPDATE aprovacao_vaga SET ativo = 0 WHERE vaga_id = '.$id.';');
				DB::statement('UPDATE vaga SET gestor_id = '.$idG.' WHERE id = '.$id.';');
				$input['gestor_id'] 	  = $input['gestor_anterior'];
				$input['gestor_anterior'] = Auth::user()->id;
				$aprovacao = AprovacaoVaga::create($input);
				$gestor = Gestor::where('id', $idG)->get();
				$email  = $gestor[0]->email;
				$motivo = $input['motivo'];
				$vaga   = $vaga[0]->vaga;
				Mail::send([], [], function($m) use ($email,$motivo,$vaga) {
					$m->from('portal@hcpgestao.org.br', 'Solicitação de Vaga');
					$m->subject('Sua Vaga - '.$vaga. ' Não foi Autorizada!');
					$m->setBody($motivo .'! Acesse: http:/www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
				});
			}
			return view('home_vaga', compact('unidade', 'idG', 'idVaga'));
		}
	}
	
	public function n_autorizarVaga($id)
	{
		$vaga = Vaga::where('id',$id)->get();
		$idU  = $vaga[0]->unidade_id;
		$unidade   = Unidade::where('id',$idU)->get();
		$aprovacao = AprovacaoVaga::where('vaga_id', $id)->where('ativo',1)->get();
		$qtdAp 	   = sizeof($aprovacao);
 		$idG 	   = $vaga[0]->solicitante;
		$gestores  = Gestor::where('nome',$idG)->get();
		$text 	   = false;
		return view('home_nao_autorizado_vaga', compact('unidade','vaga','gestores','text'));
	}
	
	public function escolha_vaga($id)
	{
		$id = $id;
		$unidades = Unidade::all();
		return view('vaga_escolha', compact('id','unidades'));
	}
	
	public function homeVaga($id)
	{
		$id = $id;
		$unidades = Unidade::all();
		return view('home_vaga', compact('id','unidades'));
	}
	
	public function cadastrarVaga($id_unidade, $i, Request $request)
	{  
		$unidade = Unidade::where('id', $id_unidade)->get();
		$unidades = Unidade::all();
		$email = Auth::user()->email;  
		$tipo_vaga = $i;
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
		$cargos = Cargos::all();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
		$text = false;
		
		return view('vaga', compact('unidade','gestores','tipo_vaga','text','unidades','email','cargos','centro_custos','setores','centro_custo_nv'));
	}
	
	public function storeVaga($id_unidade, $i, Request $request){
		$input 	   = $request->all();
		$unidade   = Unidade::where('id', $id_unidade)->get();
		$unidades  = Unidade::all();
		$email 	   = Auth::user()->email;  
		$tipo_vaga = $i;
		$data_prevista = date('d-m-Y', strtotime($input['data_prevista']));
		$hoje   = date('d-m-Y', strtotime('now'));
		$cargos = Cargos::all();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
		$setores 	   	 = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
		$centro_custo_nv = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $id_unidade . '%')->get();
		if($id_unidade == 1){
		    $gestores = Gestor::where('funcao','=','rh')->where('gestor_sim',1)->get(); 
		} else {
		    if(Auth::user()->funcao == "Gestor Imediato"){
		        $nome = Auth::user()->name;
		        $gestores = DB::select("SELECT * FROM gestor WHERE (funcao = 'rh' OR funcao = 'gestor imediato') AND (unidade_id = 0 OR unidade_id = ".$id_unidade.") AND nome != '$nome'");
		    }else {
		        if(Auth::user()->id == 149){
		            $gestores = DB::select("SELECT * FROM gestor WHERE id = 26");       
		        } else if(Auth::user()->id == 14) {
		            $gestores = DB::select("SELECT * FROM gestor WHERE id = 13");       
		        } else {
		            $gestores = DB::select("SELECT * FROM gestor WHERE (funcao = 'rh' OR funcao = 'gestor imediato') AND (unidade_id = 0 OR unidade_id = ".$id_unidade.")");       
		        }   
		    }
		} 
		if(strtotime($data_prevista) <= strtotime($hoje)){
			$text = true;
			\Session::flash('mensagem', ['msg' => 'Data Prevista tem que ser maior que a data de Hoje!','class'=>'green white-text']);
			session()->flashInput($request->input());
			return view('vaga', compact('unidade','gestores','tipo_vaga','text','unidades','email','cargos','centro_custos','setores','centro_custo_nv'));
		}  
		$validator = Validator::make($request->all(), [
			'vaga'                      => 'required|max:255',
			'codigo_vaga' 				=> 'required|max:255',
			'area' 						=> 'required|max:255',
			'edital_disponivel'			=> 'required|max:255',
			'data_prevista'				=> 'required',
			'cargo'						=> 'required|max:255',
			'salario' 					=> 'required|max:255',
			'horario_trabalho'  		=> 'required|max:255',
            'escala_trabalho'			=> 'required|max:255',
			'centro_custo'				=> 'required|max:255',
			'jornada'					=> 'required|max:255',
			'turno'						=> 'required|max:255',
			'tipo'              		=> 'required|max:255',
			'motivo'            		=> 'required|max:255',
			'contratacao_deficiente'    => 'required|max:255',
			'email'			            => 'required|max:255',
			'conhecimento_tecnico'		=> 'required|max:255',
			'conhecimento_desejado'		=> 'required|max:255',
			'formacao'					=> 'required|max:255',
			'idiomas'					=> 'required|max:255',
			'justificativa'				=> 'required|max:1000'
        ]);
		$text = true;
		if ($validator->fails()) {
            return view('vaga', compact('unidade','gestores','tipo_vaga','text','unidades','email','cargos','centro_custos','setores','centro_custo_nv'))
                        ->withErrors($validator)
                        ->withInput(session()->flashInput($request->input()));
        } else {
			if($input['horario_trabalho'] == "0") {
				$input['horario_trabalho'] = $input['horario_trabalho2'];
			}
			if($input['escala_trabalho'] == "outra") {
				if(!empty($input['escala_trabalho6'])){
					$input['escala_trabalho'] = $input['escala_trabalho6'];	
				}
			}
			if($input['tipo'] == "rpa") {
				$input['periodo_contrato'] = $input['periodo_contrato'];
			} else {
				$input['periodo_contrato'] = NULL;
			}
			if($input['motivo'] != "substituicao_definitiva"){
				$input['motivo2'] = NULL;
			} else {
				$input['motivo2'] = $input['motivo6'];
			}
			$input['concluida'] = 0;
			$input['aprovada']  = 0;
			$vaga = Vaga::create($input);
			$vaga    = DB::table('vaga')->max('id');
			$id_vaga = $vaga;
			$input['vaga_id'] = $id_vaga;
			$idU 			  = $input['unidade_id'];
			$unidade = Unidade::where('id', $idU)->get(); 
			for($j = 1; $j <= 9; $j++) {
				if(!empty($input['motivoA' .$j])) {
					$input['descricao'] = $input['motivoA' .$j];
					$competencias = Competencias::create($input);
				}
			}
			for($i = 1; $i <= 11; $i++) {
				if(!empty($input['comportamental' .$i])) {
					$input['descricao'] = $input['comportamental' .$i];
					$comportamental = Comportamental::create($input);
				}
			}
			$input['descricao'] = $input['justificativa'];
			$justificativa = JustificativaVaga::create($input);
			$vaga 		   = Vaga::where('id',$vaga)->get();
			$numeroVaga  = $vaga[0]->vaga;
			$gestorID 	 = $vaga[0]->gestor_id;
			$gestor 	 = Gestor::where('id', $gestorID)->get();
			$email       = $gestor[0]->email;
			$idG 		 = $gestor[0]->id;
			$idVaga		 = $id_vaga;
			Mail::send([], [], function($m) use ($email,$numeroVaga) {
				$m->from('portal@hcpgestao.org.br', 'Solicitação de Vaga');
				$m->subject('Foi criada uma Solicitação de Vaga: '.$numeroVaga.'!');
				$m->setBody('A Solicitação de Vaga: '. $numeroVaga.' foi criada e precisa da sua validação! Acesse o portal da Solicitação de Vaga: www.hcpgestao-mprh.hcpgestao.org.br');
				$m->to($email);
			});
			return view('home_vaga', compact('unidade','idG','idVaga'));
		}
	}
	
	public function vagaPDF($idG, $idVaga)
	{
		$unidades 	    = Unidade::all();
		$justificativa  = JustificativaVaga::where('vaga_id', $idVaga)->get();	
		$aprovacao 	    = AprovacaoVaga::where('vaga_id', $idVaga)->get();		
		$gestor 	    = Gestor::where('id', $idG)->get();
		$gestor_nome    = $gestor[0]->nome;
		$vagas 		    = Vaga::where('id', $idVaga)->get();
		$idU 		    = $vagas[0]->unidade_id;
		$unidades       = Unidade::all();
		$unidade 	    = Unidade::where('id', $idU)->get();
		$comportamental = Comportamental::where('vaga_id', $vagas[0]->id)->get();
		$competencias   = Competencias::where('vaga_id', $vagas[0]->id)->get();
		$pdf = PDF::loadView('pdf.vagapdf', compact('vagas','gestor','unidades','unidade','justificativa','aprovacao','comportamental','competencias','gestor_nome'));
		$pdf->setPaper('A4', 'landscape');
		return $pdf->download('vaga.pdf');
	}
	
	public function salvarVaga($id, $idG, Request $request){
		$input 	  = $request->all();
		$vaga 	  = Vaga::where('id',$id)->get();
		$idVaga   = $id;
		$idU      = $vaga[0]->unidade_id;
		$unidade  = Unidade::where('id', $idU)->get();
		$vaga 	  = $vaga[0]->vaga;
		$gestor   = Gestor::where('id', $idG)->get();
		$email 	  = $gestor[0]->email;
		DB::statement('UPDATE vaga SET gestor_id = '.$idG.' WHERE id = '.$id.';');
		Mail::send([], [], function($m) use ($email,$vaga) {
			$m->from('portal@hcpgestao.org.br', 'Solicitação de Vaga');
			$m->subject('Vaga - '.$vaga.' Alterada!');
			$m->setBody('A Vaga: '. $vaga.' foi alterada e precisa da sua validação! Acesse o portal da Solicitação de Vaga: www.hcpgestao-mprh.hcpgestao.org.br');
			$m->to($email);
		});
		
		return view('home_vaga', compact('unidade','idVaga','idG'));
	}
	
	public function alterarVaga($id) {
		$gestores = Gestor::all();
		$unidades = Unidade::all();
		$vagas    = Vaga::where('id',$id)->get();
		$justificativa = JustificativaVaga::where('vaga_id', $vagas[0]->id)->get();
		$solicitante   = $vagas[0]->solicitante;
		$solic    = Gestor::where('nome',$solicitante)->get();
		$gestor   = $solic[0]->gestor_imediato;
		$gestor   = Gestor::where('nome', $gestor)->get();
		$unidade  = $vagas[0]->unidade_id;
		$unidade  = Unidade::where('id',$unidade)->get();
		$text 	  = false;
		$idVaga   = $id;
		$comportamental = Comportamental::where('vaga_id',$vagas[0]->id)->get();
		$competencias 	= Competencias::where('vaga_id',$vagas[0]->id)->get();
		$cargos   = Cargos::all();
		$centro_custos = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
		return view('alterar_vaga', compact('unidade','text','gestores','unidades','vagas','idVaga','cargos','centro_custos','justificativa','gestor','comportamental','competencias'));
   }
   
   public function updateVaga($id, Request $request){
	    $input = $request->all(); 
		$vagas = Vaga::where('id',$id)->get();
		$unidade = $vagas[0]->unidade_id;
		$unidade = Unidade::where('id',$unidade)->get();
		$cargos = Cargos::all();
		$centro_custos   = DB::table('centro_custo')->where('centro_custo.unidade', 'like', '%' . $unidade[0]->id . '%')->get();
		$dataP = $input['data_prevista'];
		$dataPrevista = date('d-m-Y', strtotime($dataP));
		$hoje 		  = date('d-m-Y', strtotime('now'));
		if(strtotime($hoje) >= strtotime($dataPrevista)){
			$text = true;
			$gestores = Gestor::all();
			$unidades = Unidade::all();
			$justificativa = JustificativaVaga::where('vaga_id', $vagas[0]->id)->get();
			$solicitante = $vagas[0]->solicitante;
			$solic   = Gestor::where('nome',$solicitante)->get();
			$gestor  = $solic[0]->gestor_imediato;
			$gestor  = Gestor::where('nome', $gestor)->get();
			$text = true;
			$idVaga = $id;
			$aprovacao = AprovacaoVaga::where('vaga_id',$id)->get();
			$comportamental = Comportamental::where('vaga_id', $id)->get();
			$competencias   = Competencias::where('vaga_id', $id)->get();
			session()->flashInput($request->input());
			$validator = "Data Prevista não pode ser Menor ou Igual a Data de Hoje!";
			return view('alterar_vaga', compact('unidade','text','gestores','unidades','vagas','idVaga','aprovacao','justificativa','gestor','solicitante','cargos','centro_custos','comportamental','competencias'))
					    ->withErrors($validator);
		} 
		$validator = Validator::make($request->all(), [
			'vaga'                      => 'required|max:255',
			'codigo_vaga' 				=> 'required|max:255',
			'area' 						=> 'required|max:255',
			'edital_disponivel'			=> 'required|max:255',
			'data_prevista'				=> 'required',
			'cargo'						=> 'required|max:255',
			'salario' 					=> 'required|max:255',
			'horario_trabalho'  		=> 'required|max:255',
            'escala_trabalho'			=> 'required|max:255',
			'centro_custo'				=> 'required|max:255',
			'jornada'					=> 'required|max:255',
			'turno'						=> 'required|max:255',
			'tipo'              		=> 'required|max:255',
			'motivo'            		=> 'required|max:255',
			'contratacao_deficiente'    => 'required|max:255',
			'email'			            => 'required|max:255',
			'conhecimento_tecnico'		=> 'required|max:255',
			'conhecimento_desejado'		=> 'required|max:255',
			'formacao'					=> 'required|max:255',
			'idiomas'					=> 'required|max:255',
			'justificativa'				=> 'required|max:1000'
        ]);
		$text = true;
		if ($validator->fails()) {
            $gestores = Gestor::all(); 
			$unidades = Unidade::all();
			$vagas   = Vaga::where('id',$id)->get();
			$unidade = $vagas[0]->unidade_id;
			$unidade = Unidade::where('id',$unidade)->get();
			$solicitante = $vagas[0]->solicitante;
			$solic    = Gestor::where('nome',$solicitante)->get();
			$gestor   = $solic[0]->gestor_imediato;
			$gestor   = Gestor::where('nome', $gestor)->get();
			$text 	  = true;
			$idVaga   = $id;
			$justificativa = JustificativaVaga::where('vaga_id', $id)->get();
			$aprovacao     = AprovacaoVaga::where('vaga_id',$id)->get();
			$tipo_vaga 	   = 0;
			$comportamental = Comportamental::where('vaga_id', $id)->get();
			$competencias   = Competencias::where('vaga_id', $id)->get();
			return view('alterar_vaga', compact('unidade','gestores','tipo_vaga','text','vagas','gestor','unidades','cargos','centro_custos','comportamental','competencias','justificativa','idVaga'))
                        ->withErrors($validator)
                        ->withInput(session()->flashInput($request->input()));
        } else {
			if($input['escala_trabalho'] == "outra") {
				$input['escala_trabalho'] = $input['escala_trabalho6'];
			}
			if($input['horario_trabalho'] == "0") {
				$input['horario_trabalho'] = $input['horario_trabalho2'];
			}
			if($input['motivo'] == "substituicao_definitiva"){
				$input['motivo2'] = $input['motivo6'];	
			}
			$vaga = Vaga::find($id);
			$vaga->update($input);
			$J   = JustificativaVaga::where('vaga_id', $id)->get();
			$idJ = $J[0]->id; 
			$input['descricao'] = $input['justificativa'];
			$justificativa = JustificativaVaga::find($idJ);
			$justificativa->update($input);
			$b = 0;
			for($j = 1; $j <= 9; $j++) {
				if(!empty($input['motivoB' .$j]) && $b == 0) {
					$comp = DB::statement("DELETE FROM competencias WHERE vaga_id = ".$id);
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
					$competencias = Competencias::create($input);
				}
			}
			$a = 0;
			for($i = 1; $i <= 11; $i++) {
				if(!empty($input['comportamentalB' .$i]) && $a == 0) {
					$comp = DB::statement("DELETE FROM perfil_comportamental WHERE vaga_id = ".$id);
					$a = 1;
				}
				if(!empty($input['comportamentalB' .$i]) && $a == 1){
					if($input['comportamentalB' .$i] == "outros"){
						$input['outros'] = $input['perfil'];
						$input['descricao'] = "outros";
					} else {
						$input['descricao'] = $input['comportamentalB' .$i];
					}
					$input['vaga_id'] = $id;
					$comportamental = Comportamental::create($input);
				}
			}
			$vagas 	  = Vaga::where('id', $id)->get();
			$solicitante = $vagas[0]->solicitante;
			$solic    = Gestor::where('nome',$solicitante)->get();
			$gestor   = $solic[0]->gestor_imediato;
			$gestor   = Gestor::where('nome', $gestor)->get();
			$gestores = Gestor::all();
			$unidades = Unidade::all();
			$idU = $vagas[0]->unidade_id;
			$unidade = Unidade::where('id', $idU)->get();
			$justificativa = JustificativaVaga::where('vaga_id', $id)->get();
			$text = true;
			$idVaga = $id;
			$aprovacao = AprovacaoVaga::where('vaga_id',$id)->get();
			$comportamental = Comportamental::where('vaga_id', $id)->get();
			$competencias   = Competencias::where('vaga_id', $id)->get();
			$tipo_vaga = 0;
			$validator = "Vaga Alterada com sucesso!";
			return view('visualizar_vagas', compact('vagas','gestores','unidades','unidade','justificativa','text','aprovacao','gestor','competencias','comportamental','idVaga'))
						->withErrors($validator);
		}
   }
   
   public function graphicsVagaIndex()
   {
	   return view('graphics_vaga_index');
   }
   
   public function graphicsVaga()
   {
		if(Auth::user()->id == 5){
			$row5 = Vaga::where('unidade_id', 3)->get();
		} else if(Auth::user()->id == 1){
			$row5 = Vaga::where('unidade_id', 4)->get();
		} else if(Auth::user()->id == 34){
			$row5 = Vaga::where('unidade_id', 5)->get();
		} else if(Auth::user()->id == 48){
			$row5 = Vaga::where('unidade_id', 6)->get();
		} else if(Auth::user()->id == 60){
			$row5 = Vaga::where('unidade_id', 7)->get();
		} else if(Auth::user()->id == 61){
			$row5 = Vaga::where('unidade_id', 8)->get();
		} else if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$row5 = Vaga::all();
		}
		$qtd  = sizeof($row5);		
		
		return view('graphics/graphics_vaga', compact('row5','qtd'));
   }
   
   public function graphicsVaga2()
   {
		if(Auth::user()->id == 5){
			$row5 = Vaga::where('unidade_id', 3)->get();
		} else if(Auth::user()->id == 1){
			$row5 = Vaga::where('unidade_id', 4)->get();
		} else if(Auth::user()->id == 34){
			$row5 = Vaga::where('unidade_id', 5)->get();
		} else if(Auth::user()->id == 48){
			$row5 = Vaga::where('unidade_id', 6)->get();
		} else if(Auth::user()->id == 60){
			$row5 = Vaga::where('unidade_id', 7)->get();
		} else if(Auth::user()->id == 61){
			$row5 = Vaga::where('unidade_id', 8)->get();
		} else if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$row5 = Vaga::all();
		}
		$qtd  = sizeof($row5);
		$qtd1=0;$qtd2=0;$qtd3=0;$qtd4=0;$qtd5=0;$qtd6=0;$qtd7=0;$qtd8=0;
		for($c = 0; $c < $qtd; $c++) {
			if($row5[$c]->unidade_id == 1) {
				$qtd1 += 1;	
			} else if($row5[$c]->unidade_id == 2) {
				$qtd2 += 1;
			} else if($row5[$c]->unidade_id == 3) {
				$qtd3 += 1;
			} else if($row5[$c]->unidade_id == 4) {
				$qtd4 += 1;
			} else if($row5[$c]->unidade_id == 5) {
				$qtd5 += 1;
			} else if($row5[$c]->unidade_id == 6) {
				$qtd6 += 1;
			} else if($row5[$c]->unidade_id == 7) {
				$qtd7 += 1;
			} else if($row5[$c]->unidade_id == 8) {
				$qtd8 += 1;
			}
		}
		$unidades = Unidade::all();
		return view('graphics/graphics_vaga2', compact('row5','qtd','qtd1','qtd2','qtd3','qtd4','qtd5','qtd6','qtd7','qtd8','unidades'));
   }
   
   public function pesquisarGrafico9(Request $request)
   {
	   $input = $request->all();
	   $idU   = $input['unidade_id'];
	   $data_i = date('Y-m-d', strtotime($input['data_inicio']));
	   $data_f = date('Y-m-d', strtotime($input['data_fim']));
	   if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			if($idU == "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = Vaga::all();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = Vaga::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$data_i = "1970-01-01";
				$row5 = Vaga::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = Vaga::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = Vaga::where('unidade_id', $idU)->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = Vaga::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = Vaga::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = Vaga::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			}
		}
		$qtd  = sizeof($row5);
		if($qtd > 0) {
			$qtd1=0;$qtd2=0;$qtd3=0;$qtd4=0;$qtd5=0;$qtd6=0;$qtd7=0;$qtd8=0;
			for($c = 0; $c < $qtd; $c++) {
				if($row5[$c]->unidade_id == 1) {
					$qtd1 += 1;	
				} else if($row5[$c]->unidade_id == 2) {
					$qtd2 += 1;
				} else if($row5[$c]->unidade_id == 3) {
					$qtd3 += 1;
				} else if($row5[$c]->unidade_id == 4) {
					$qtd4 += 1;
				} else if($row5[$c]->unidade_id == 5) {
					$qtd5 += 1;
				} else if($row5[$c]->unidade_id == 6) {
					$qtd6 += 1;
				} else if($row5[$c]->unidade_id == 7) {
					$qtd7 += 1;
				} else if($row5[$c]->unidade_id == 8) {
					$qtd8 += 1;
				}
			}
		} else {
			$qtd1=0;$qtd2=0;$qtd3=0;$qtd4=0;$qtd5=0;$qtd6=0;$qtd7=0;$qtd8=0;
		}
		$unidades = Unidade::all();
		return view('graphics/graphics_vaga2', compact('row5','qtd','qtd1','qtd2','qtd3','qtd4','qtd5','qtd6','qtd7','qtd8','unidades'));
   }
   
   public function graphicsVaga3()
   {
	   if(Auth::user()->id == 5){
			$row5 = Vaga::where('unidade_id', 3)->get();
		} else if(Auth::user()->id == 1){
			$row5 = Vaga::where('unidade_id', 4)->get();
		} else if(Auth::user()->id == 34){
			$row5 = Vaga::where('unidade_id', 5)->get();
		} else if(Auth::user()->id == 48){
			$row5 = Vaga::where('unidade_id', 6)->get();
		} else if(Auth::user()->id == 60){
			$row5 = Vaga::where('unidade_id', 7)->get();
		} else if(Auth::user()->id == 61){
			$row5 = Vaga::where('unidade_id', 8)->get();
		} else if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$row5 = Vaga::all();
		}
	   $qtd  = sizeof($row5);
	   $totalSA = 0;
	   for($a = 0; $a < $qtd; $a++) {
			$totalSA += $row5[$a]->salario;
	   }
	   $unidades = Unidade::all();
	   return view('graphics/graphics_vaga3', compact('row5','qtd','totalSA','unidades'));
   }
   
   public function pesquisarGrafico10(Request $request)
   {
	   $input = $request->all();
	   $idU   = $input['unidade_id'];
	   $data_i = date('Y-m-d', strtotime($input['data_inicio']));
	   $data_f = date('Y-m-d', strtotime($input['data_fim']));
	   if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			if($idU == "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = Vaga::all();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = Vaga::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$data_i = "1970-01-01";
				$row5 = Vaga::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = Vaga::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = Vaga::where('unidade_id', $idU)->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = Vaga::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = Vaga::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = Vaga::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			}
	   }
	   $qtd  	= sizeof($row5);
	   $totalSA = 0;
	   for($a = 0; $a < $qtd; $a++) {
			$totalSA += $row5[$a]->salario;
	   }
	   $unidades = Unidade::all();
	   return view('graphics/graphics_vaga3', compact('row5','qtd','totalSA','unidades'));
   }
}