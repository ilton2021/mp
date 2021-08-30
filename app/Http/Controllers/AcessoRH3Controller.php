<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Model\MP;
use App\Model\Unidade;
use App\Model\Aprovacao;
use App\Model\Gestor;

class AcessoRH3Controller extends Controller
{
    public function acessoRH3($id)
    {
        $acesso  = 1;
        $usuario = Auth::user()->name;
        $acesso   = DB::statement("UPDATE mp SET acessorh3 = '$acesso' ,usuario_acessorh3 = '$usuario' WHERE id = '$id' ");
        $unidades = Unidade::all();
		$und 	  = Auth::user()->unidade; 
		$und 	  = explode(",",$und);
		$funcao   = Auth::user()->funcao; 
		$nome     = Auth::user()->name;
		if(Auth::user()->funcao == "DP" || Auth::user()->funcao == "RH") {
			$mps = DB::table('mp')->whereIn('unidade_id',$und)->where('aprovada',1)
			  ->where('concluida',1)->orderby('mp.unidade_id', 'ASC')->paginate(20);
			$qtd = sizeof($mps);
			if($qtd == 0){
			    $ids = NULL;
			    $aprovacao = Aprovacao::all();
			} else {
    			for($a = 0; $a < $qtd; $a++){
    				$ids[] = $mps[$a]->id; 
    			}
    			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
			}
		}
		$gestores  = Gestor::all();
		return view('aprovadasMPs', compact('unidades','mps','aprovacao','gestores'));
    }

	public function acessoRH3Desabilita($id)
    {
        $acesso  = 1;
        $usuario = Auth::user()->name;
		$unidades = Unidade::all();
		$und 	  = Auth::user()->unidade; 
		$und 	  = explode(",",$und);
		$funcao   = Auth::user()->funcao; 
		$nome     = Auth::user()->name;
		if(Auth::user()->funcao == "DP" || Auth::user()->funcao == "RH") {
			$mps = DB::table('mp')->whereIn('unidade_id',$und)->where('aprovada',1)
			  ->where('concluida',1)->orderby('mp.unidade_id', 'ASC')->paginate(20);
			$qtd = sizeof($mps);
			if($qtd == 0){
			    $ids = NULL;
			    $aprovacao = Aprovacao::all();
			} else {
    			for($a = 0; $a < $qtd; $a++){
    				$ids[] = $mps[$a]->id; 
    			}
    			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
			}
		}
		$gestores  = Gestor::all();
		$acesso = MP::where('usuario_acessorh3',$usuario)->where('acessorh3',1)->where('id',$id)->get();
		$qtd = sizeof($acesso);
		if($qtd > 0){
        	$acesso = DB::statement("UPDATE mp SET acessorh3 = '0' , usuario_acessorh3 = '' WHERE id = '$id' ");
		} else {
			$validator = "Só quem pode desmarcar esta opção é o Usuário que cadastrou esta MP no RH3!";
			return view('aprovadasMPs', compact('unidades','mps','aprovacao','gestores'))
					  ->withErrors($validator);
		}
		if(Auth::user()->funcao == "DP" || Auth::user()->funcao == "RH") {
			$mps = DB::table('mp')->whereIn('unidade_id',$und)->where('aprovada',1)
			  ->where('concluida',1)->orderby('mp.unidade_id', 'ASC')->paginate(20);
			$qtd = sizeof($mps);
			if($qtd == 0){
			    $ids = NULL;
			    $aprovacao = Aprovacao::all();
			} else {
    			for($a = 0; $a < $qtd; $a++){
    				$ids[] = $mps[$a]->id; 
    			}
    			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
			}
		}
		return view('aprovadasMPs', compact('unidades','mps','aprovacao','gestores'));
    }
}
