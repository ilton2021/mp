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
		$und 	  = explode(" ",$und);
		$funcao   = Auth::user()->funcao; 
		$nome     = Auth::user()->name;
		if($funcao == "Gestor" || $funcao == "Gestor Imediato"){
			$mps = MP::where('solicitante',$nome)->orderBy('unidade_id', 'ASC')->where('concluida',1)
					 ->where('aprovada',1)->get();
		} else {
			$mps = DB::table('mp')->whereIN('unidade_id', $und)->where('aprovada',1)
			->where('concluida',1)->orderby('mp.unidade_id', 'ASC')->paginate(20);
		} 
		$aprovacao = Aprovacao::all();
		$gestores  = Gestor::all();
		return view('aprovadasMPs', compact('unidades','mps','aprovacao','gestores'));
    }
}
