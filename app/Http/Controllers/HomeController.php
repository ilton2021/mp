<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Unidade;
use App\Model\MP;
use App\Model\Gestor;
use App\Model\Admissao;
use App\Model\Demissao;
use App\Model\Alteracao_Funcional;
use App\Model\Cargos;
use App\Model\CentroCusto;
use App\Model\Justificativa;
use App\Model\JustificativaN_Autorizada;
use App\Model\Aprovacao;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use DB;
use Validator;
use \PDF;
use Barryvdh\DomPDF\Facade;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index2()
    {
		$unidades   = Unidade::all();
		$usuario_id = Auth::user()->id;
		$gestor 	= Gestor::where('id',$usuario_id)->get();	
		$und = Auth::user()->unidade_abertura;
		$und = explode(",",$und);
		$unidades2 = Unidade::whereIn('id',$und)->get(); 
        return view('welcome_', compact('unidades','unidades2','gestor'));
    }
	
	public function mp($id_un)
    {
		$unidades   = Unidade::where('id',$id_un)->get();
		$usuario_id = Auth::user()->id;
		$gestor 	= Gestor::where('id',$usuario_id)->get();
		return view('mp', compact('unidades','gestor'));
    }
	
	public function graphicsIndex()
    {
		return view('graphics_index');
    }
	
	public function graphics()
    {
		if(Auth::user()->id == 5){
			$row5 = MP::where('unidade_id', 3)->get();
		} else if(Auth::user()->id == 1){
			$row5 = MP::where('unidade_id', 4)->get();
		} else if(Auth::user()->id == 34){
			$row5 = MP::where('unidade_id', 5)->get();
		} else if(Auth::user()->id == 48){
			$row5 = MP::where('unidade_id', 6)->get();
		} else if(Auth::user()->id == 60){
			$row5 = MP::where('unidade_id', 7)->get();
		} else if(Auth::user()->id == 61){
			$row5 = MP::where('unidade_id', 8)->get();
		} else if(Auth::user()->id == 59){
			$row5 = MP::where('unidade_id', 2)->get();
		} else if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$row5 = MP::all();
		} 
		$qtd = sizeof($row5); 
		for($a = 0; $a < $qtd; $a++){
			$ids[] = $row5[$a]->id;
		}
		$admissao   = Admissao::whereIn('mp_id',$ids)->get();
		$qtdAd      = sizeof($admissao);
		$demissao   = Demissao::whereIn('mp_id',$ids)->get();
		$qtdDem     = sizeof($demissao);
		$alteracaoF = Alteracao_Funcional::whereIn('mp_id',$ids)->get();
		$qtdAlt     = sizeof($alteracaoF);
		$unidades   = Unidade::all();
		return view('/graphics/graphics', compact('row5','qtd','qtdAd','qtdDem','qtdAlt','unidades'));
    }
	
	public function pesquisarGrafico1(Request $request)
    { 
		$input  = $request->all();
		$idU    = $input['unidade_id']; 
		$data_i = date('Y-m-d', strtotime($input['data_inicio']));
		$data_f = date('Y-m-d', strtotime($input['data_fim']));
		if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			if($idU == "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::all();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$data_i = "1970-01-01";
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			}
		} 
		$qtd  = sizeof($row5); 
		if($qtd > 0) {
			for($a = 0; $a < $qtd; $a++){
				$ids[] = $row5[$a]->id;
			}
		} else {
			$ids[] = 0;
		}
		$admissao   = Admissao::whereIn('mp_id',$ids)->get();
		$qtdAd      = sizeof($admissao);
		$demissao   = Demissao::whereIn('mp_id',$ids)->get();
		$qtdDem     = sizeof($demissao);
		$alteracaoF = Alteracao_Funcional::whereIn('mp_id',$ids)->get();
		$qtdAlt     = sizeof($alteracaoF);
		$unidades   = Unidade::all();
		session()->flashInput($request->input());
		return view('/graphics/graphics', compact('row5','qtd','qtdAd','qtdDem','qtdAlt','unidades'));
    }
	
	public function graphics2()
    {
		if(Auth::user()->id == 5){
			$row5 = MP::where('unidade_id', 3)->get();
		} else if(Auth::user()->id == 1){
			$row5 = MP::where('unidade_id', 4)->get();
		} else if(Auth::user()->id == 34){
			$row5 = MP::where('unidade_id', 5)->get();
		} else if(Auth::user()->id == 48){
			$row5 = MP::where('unidade_id', 6)->get();
		} else if(Auth::user()->id == 60){
			$row5 = MP::where('unidade_id', 7)->get();
		} else if(Auth::user()->id == 61){
			$row5 = MP::where('unidade_id', 8)->get();
		} else if(Auth::user()->id == 59){
			$row5 = MP::where('unidade_id', 2)->get();
		} else if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$row5 = MP::all();
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
		return view('/graphics/graphics2', compact('row5','qtd','qtd1','qtd2','qtd3','qtd4','qtd5','qtd6','qtd7','qtd8'));
    }
	
	public function graphics3()
    {
		if(Auth::user()->id == 5){
			$row5 = MP::where('unidade_id', 3)->get();
		} else if(Auth::user()->id == 1){
			$row5 = MP::where('unidade_id', 4)->get();
		} else if(Auth::user()->id == 34){
			$row5 = MP::where('unidade_id', 5)->get();
		} else if(Auth::user()->id == 48){
			$row5 = MP::where('unidade_id', 6)->get();
		} else if(Auth::user()->id == 60){
			$row5 = MP::where('unidade_id', 7)->get();
		} else if(Auth::user()->id == 61){
			$row5 = MP::where('unidade_id', 8)->get();
		} else if(Auth::user()->id == 59){
			$row5 = MP::where('unidade_id', 2)->get();
		} else if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$row5 = MP::all();
		}
		$qtd = sizeof($row5);
		for($a = 0; $a < $qtd; $a++){
			$ids[] = $row5[$a]->id;
		} 
		$admissao = Admissao::whereIn('mp_id',$ids)->get();
		$qtdAd    = sizeof($admissao);
		$totalSal = 0; $totalOutrasVerbas = 0;
		for($a = 0; $a < $qtdAd; $a++)
		{
			$totalSal 		   += $admissao[$a]->salario;
			$totalOutrasVerbas += $admissao[$a]->outras_verbas;
		} 
		$unidades   = Unidade::all();
		return view('/graphics/graphics3', compact('row5','qtd','qtdAd','totalSal','totalOutrasVerbas','unidades'));
    }
	
	public function pesquisarGrafico3(Request $request)
    {
		$input = $request->all();
		$idU   = $input['unidade_id'];
		$data_i = date('Y-m-d', strtotime($input['data_inicio']));
		$data_f = date('Y-m-d', strtotime($input['data_fim']));
		if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			if($idU == "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::all();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$data_i = "1970-01-01";
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			}
		} 
		$qtd = sizeof($row5);
		if($qtd > 0) {
			for($a = 0; $a < $qtd; $a++){
				$ids[] = $row5[$a]->id;
			} 
		} else {
			$ids[] = 0;
		}
		$admissao = Admissao::whereIn('mp_id',$ids)->get();
		$qtdAd    = sizeof($admissao);
		$totalSal = 0; $totalOutrasVerbas = 0;
		for($a = 0; $a < $qtdAd; $a++)
		{
			$totalSal 		   += $admissao[$a]->salario;
			$totalOutrasVerbas += $admissao[$a]->outras_verbas;
		} 
		
		$unidades   = Unidade::all();
		return view('/graphics/graphics3', compact('row5','qtd','qtdAd','totalSal','totalOutrasVerbas','unidades'));
    }
	
	public function graphics4()
    {
		if(Auth::user()->id == 5){
			$row5 = MP::where('unidade_id', 3)->get();
		} else if(Auth::user()->id == 1){
			$row5 = MP::where('unidade_id', 4)->get();
		} else if(Auth::user()->id == 34){
			$row5 = MP::where('unidade_id', 5)->get();
		} else if(Auth::user()->id == 48){
			$row5 = MP::where('unidade_id', 6)->get();
		} else if(Auth::user()->id == 60){
			$row5 = MP::where('unidade_id', 7)->get();
		} else if(Auth::user()->id == 61){
			$row5 = MP::where('unidade_id', 8)->get();
		} else if(Auth::user()->id == 59){
			$row5 = MP::where('unidade_id', 2)->get();
		} else if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$row5 = MP::all();
		}
		$qtd  = sizeof($row5);
		for($a = 0; $a < $qtd; $a++){
			$ids[] = $row5[$a]->id;
		}
		$alteracaoF = Alteracao_Funcional::whereIn('mp_id',$ids)->get();
		$qtdAlt     = sizeof($alteracaoF);
		$totalAltSA = 0; $totalAltSN = 0;
		for($c = 0; $c < $qtdAlt; $c++)
		{
			$totalAltSA += $alteracaoF[$c]->salario_atual;
			$totalAltSN += $alteracaoF[$c]->salario_novo;
		}
		$unidades = Unidade::all();
		return view('/graphics/graphics4', compact('row5','qtd','qtdAlt','totalAltSA','totalAltSN','unidades'));
    }
	
	public function pesquisarGrafico4(Request $request)
    {
		$input = $request->all();
		$idU   = $input['unidade_id'];
		$data_i = date('Y-m-d', strtotime($input['data_inicio']));
		$data_f = date('Y-m-d', strtotime($input['data_fim']));
		if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			if($idU == "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::all();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$data_i = "1970-01-01";
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			}
		} 
		$qtd  = sizeof($row5);
		if($qtd > 0) {
			for($a = 0; $a < $qtd; $a++){
				$ids[] = $row5[$a]->id;
			} 
		} else {
			$ids[] = 0;
		}
		$alteracaoF = Alteracao_Funcional::whereIn('mp_id',$ids)->get();
		$qtdAlt     = sizeof($alteracaoF);
		$totalAltSA = 0; $totalAltSN = 0;
		for($c = 0; $c < $qtdAlt; $c++)
		{
			$totalAltSA += $alteracaoF[$c]->salario_atual;
			$totalAltSN += $alteracaoF[$c]->salario_novo;
		}
		$unidades = Unidade::all();
		return view('/graphics/graphics4', compact('row5','qtd','qtdAlt','totalAltSA','totalAltSN','unidades'));
    }
	
	public function graphics5()
    {
		if(Auth::user()->id == 5){
			$row5 = MP::where('unidade_id', 3)->get();
		} else if(Auth::user()->id == 1){
			$row5 = MP::where('unidade_id', 4)->get();
		} else if(Auth::user()->id == 34){
			$row5 = MP::where('unidade_id', 5)->get();
		} else if(Auth::user()->id == 48){
			$row5 = MP::where('unidade_id', 6)->get();
		} else if(Auth::user()->id == 60){
			$row5 = MP::where('unidade_id', 7)->get();
		} else if(Auth::user()->id == 61){
			$row5 = MP::where('unidade_id', 8)->get();
		} else if(Auth::user()->id == 59){
			$row5 = MP::where('unidade_id', 2)->get();
		} else if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$row5 = MP::all();
		}
		$qtd  		= sizeof($row5);
		for($a = 0; $a < $qtd; $a++){
			$ids[] = $row5[$a]->id;
		} 
		$demissao   = Demissao::whereIn('mp_id',$ids)->get();
		$qtdDem     = sizeof($demissao);
		$totalDem   = 0;
		for($b = 0; $b < $qtdDem; $b++)
		{
			$totalDem += $demissao[$b]->custo_recisao;
		}
		$unidades = Unidade::all();
		return view('/graphics/graphics5', compact('row5','qtd','qtdDem','totalDem','unidades'));
    }
	
	public function pesquisarGrafico5(Request $request)
    {
		$input = $request->all();
		$idU   = $input['unidade_id'];
		$data_i = date('Y-m-d', strtotime($input['data_inicio']));
		$data_f = date('Y-m-d', strtotime($input['data_fim']));
		if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			if($idU == "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::all();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$data_i = "1970-01-01";
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			}
		} 
		$qtd = sizeof($row5);
		if($qtd > 0) {
			for($a = 0; $a < $qtd; $a++){
				$ids[] = $row5[$a]->id;
			} 
		} else {
			$ids[] = 0;
		}
		$demissao   = Demissao::whereIn('mp_id',$ids)->get();
		$qtdDem     = sizeof($demissao);
		$totalDem   = 0;
		for($b = 0; $b < $qtdDem; $b++)
		{
			$totalDem += $demissao[$b]->custo_recisao;
		}
		$unidades = Unidade::all();
		return view('/graphics/graphics5', compact('row5','qtd','qtdDem','totalDem','unidades'));
    }
	
	public function graphics6()
    {
		if(Auth::user()->id == 5){
			$row5 	  = MP::where('unidade_id', 3)->get();
			$admissao = Admissao::where('unidade_id',3)->get();
			$centro_custo = DB::select("SELECT Sum(`salario`) as soma, `centro_custo`, COUNT(`centro_custo`) AS qtd FROM admissao WHERE unidade_id = 3 GROUP BY `centro_custo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 1){
			$row5 	  = MP::where('unidade_id', 4)->get();
			$admissao = Admissao::where('unidade_id',4)->get();
			$centro_custo = DB::select("SELECT Sum(`salario`) as soma, `centro_custo`, COUNT(`centro_custo`) AS qtd FROM admissao WHERE unidade_id = 4 GROUP BY `centro_custo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 34){
			$row5 	  = MP::where('unidade_id', 5)->get();
			$admissao = Admissao::where('unidade_id',5)->get();
			$centro_custo = DB::select("SELECT Sum(`salario`) as soma, `centro_custo`, COUNT(`centro_custo`) AS qtd FROM admissao WHERE unidade_id = 5 GROUP BY `centro_custo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 48){
			$row5 	  = MP::where('unidade_id', 6)->get();
			$admissao = Admissao::where('unidade_id',6)->get();
			$centro_custo = DB::select("SELECT Sum(`salario`) as soma, `centro_custo`, COUNT(`centro_custo`) AS qtd FROM admissao WHERE unidade_id = 6 GROUP BY `centro_custo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 60){
			$row5 	  = MP::where('unidade_id', 7)->get();
			$admissao = Admissao::where('unidade_id',7)->get();
			$centro_custo = DB::select("SELECT Sum(`salario`) as soma, `centro_custo`, COUNT(`centro_custo`) AS qtd FROM admissao WHERE unidade_id = 7 GROUP BY `centro_custo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 61){
			$row5 	  = MP::where('unidade_id', 8)->get();
			$admissao = Admissao::where('unidade_id',8)->get();
			$centro_custo = DB::select("SELECT Sum(`salario`) as soma, `centro_custo`, COUNT(`centro_custo`) AS qtd FROM admissao WHERE unidade_id = 8 GROUP BY `centro_custo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 59){
			$row5 	  = MP::where('unidade_id', 2)->get();
			$admissao = Admissao::where('unidade_id',2)->get();
			$centro_custo = DB::select("SELECT Sum(`salario`) as soma, `centro_custo`, COUNT(`centro_custo`) AS qtd FROM admissao WHERE unidade_id = 2 GROUP BY `centro_custo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$row5 = MP::all();
			$admissao = Admissao::all();
			$centro_custo = DB::select("SELECT Sum(`salario`) as soma, `centro_custo`, COUNT(`centro_custo`) AS qtd FROM admissao GROUP BY `centro_custo` ORDER BY qtd DESC");
		}
		$qtdAd 	  = sizeof($admissao);
		$unidades = Unidade::all();
		return view('/graphics/graphics6', compact('row5','qtdAd','unidades','centro_custo'));
    }
	
	public function pesquisarGrafico6(Request $request)
    { 
		$input = $request->all();
		$idU   = $input['unidade_id'];
		$data_i = date('Y-m-d', strtotime($input['data_inicio']));
		$data_f = date('Y-m-d', strtotime($input['data_fim']));
		if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$a = 0;
			if($idU == "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$a = 0;
				$row5 	  = MP::all();
				$admissao = Admissao::all();
		 		$centro_custo = DB::select("SELECT Sum(`salario`) as soma, `centro_custo`, COUNT(`centro_custo`) AS qtd FROM admissao GROUP BY `centro_custo` ORDER BY qtd DESC");
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now')); $a = 1;
				$row5 	= MP::whereBetween('data_emissao', [$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::whereBetween('data_emissao', [$data_i,$data_f])->get(); $a = 1;
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::whereBetween('data_emissao', [$data_i,$data_f])->get(); $a = 1;
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::where('unidade_id',$idU)->get(); $a = 1;
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now')); $a = 1;
				$row5 	= MP::where('unidade_id',$idU)->whereBetween('data_emissao', [$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id',$idU)->whereBetween('data_emissao', [$data_i,$data_f])->get(); $a = 1;
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id',$idU)->whereBetween('data_emissao', [$data_i,$data_f])->get(); $a = 1;
			}
		}
		$qtd = sizeof($row5);
		if($a == 1){
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $row5[$a]->id;
				} 
			} else {
				$ids[] = 0;
			}
			$admissao = Admissao::whereIN('mp_id',$ids)->get();
			$centro_custo = DB::select("SELECT SUM(`salario`) as soma, `centro_custo`, COUNT(`centro_custo`) 
			AS qtd FROM admissao WHERE unidade_id = $idU GROUP BY `centro_custo` ORDER BY qtd DESC");
		}
		
		$qtdAd    = sizeof($admissao); 
		$unidades = Unidade::all();
		return view('/graphics/graphics6', compact('row5','qtd','centro_custo','unidades','qtdAd'));
    } 
	
	public function graphics7()
    {
		if(Auth::user()->id == 5){
			$row5       = MP::where('unidade_id', 3)->get();
			$alteracaoF = Alteracao_Funcional::where('unidade_id',3)->get();
			$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = 3 GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 1){
			$row5 	    = MP::where('unidade_id', 4)->get();
			$alteracaoF = Alteracao_Funcional::where('unidade_id',4)->get();
			$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = 4 GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 34){
			$row5 		= MP::where('unidade_id', 5)->get();
			$alteracaoF = Alteracao_Funcional::where('unidade_id',5)->get();
			$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = 5 GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 48){
			$row5 		= MP::where('unidade_id', 6)->get();
			$alteracaoF = Alteracao_Funcional::where('unidade_id',6)->get();
			$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = 6 GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 60){
			$row5 		= MP::where('unidade_id', 7)->get();
			$alteracaoF = Alteracao_Funcional::where('unidade_id',7)->get();
			$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = 7 GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 61){
			$row5 		= MP::where('unidade_id', 8)->get();
			$alteracaoF = Alteracao_Funcional::where('unidade_id',8)->get();
			$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = 8 GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 59){
			$row5 		= MP::where('unidade_id', 2)->get();
			$alteracaoF = Alteracao_Funcional::where('unidade_id',2)->get();
			$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = 2 GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
		} else if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$row5 = MP::all();
			$alteracaoF = Alteracao_Funcional::all();
			$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
		}
		$qtd  = sizeof($alteracaoF);
		$unidades = Unidade::all();
		return view('/graphics/graphics7', compact('row5','qtd','centro_custo2','unidades'));
    }
	
	public function pesquisarGrafico7(Request $request)
    {
		$input  = $request->all();
		$idU    = $input['unidade_id'];
		$data_i = date('Y-m-d', strtotime($input['data_inicio']));
		$data_f = date('Y-m-d', strtotime($input['data_fim']));
		if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			if($idU == "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::all();
				$alteracaoF = Alteracao_Funcional::all();
				$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now')); 
				$row5 	= MP::whereBetween('data_emissao', [$data_i,$data_f])->get();
				$alteracaoF    = Alteracao_Funcional::where('unidade_id',$idU)->get();
				$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = $idU GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
			} else if ($idU == "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::whereBetween('data_emissao', [$data_i,$data_f])->get();
				$alteracaoF    = Alteracao_Funcional::where('unidade_id',$idU)->get();
				$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = $idU GROUP BY `centro_custo_novo` ORDER BY qtd DESC");				
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::whereBetween('data_emissao', [$data_i,$data_f])->get(); 
				$alteracaoF    = Alteracao_Funcional::where('unidade_id',$idU)->get();
				$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = $idU GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::where('unidade_id',$idU)->get(); 
				$alteracaoF    = Alteracao_Funcional::where('unidade_id',$idU)->get();
				$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = $idU GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now')); 
				$row5 	= MP::where('unidade_id',$idU)->whereBetween('data_emissao', [$data_i,$data_f])->get();
				$alteracaoF    = Alteracao_Funcional::where('unidade_id',$idU)->get();
				$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = $idU GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id',$idU)->whereBetween('data_emissao', [$data_i,$data_f])->get(); 
				$alteracaoF    = Alteracao_Funcional::where('unidade_id',$idU)->get();
				$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = $idU GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id',$idU)->whereBetween('data_emissao', [$data_i,$data_f])->get(); 
				$alteracaoF    = Alteracao_Funcional::where('unidade_id',$idU)->get();
				$centro_custo2 = DB::select("SELECT Sum(`salario_novo` - `salario_atual`) as soma, `centro_custo_novo`, COUNT(`centro_custo_novo`) AS qtd FROM alteracao_funcional WHERE unidade_id = $idU GROUP BY `centro_custo_novo` ORDER BY qtd DESC");
			}
		}
		
		$qtd  		   = sizeof($alteracaoF);
		$unidades 	   = Unidade::all();
		return view('/graphics/graphics7', compact('row5','qtd','centro_custo2','unidades'));
    }
	
	public function graphics8()
    {
		if(Auth::user()->id == 5){
			$row5 = MP::where('unidade_id', 3)->get();
		} else if(Auth::user()->id == 1){
			$row5 = MP::where('unidade_id', 4)->get();
		} else if(Auth::user()->id == 34){
			$row5 = MP::where('unidade_id', 5)->get();
		} else if(Auth::user()->id == 48){
			$row5 = MP::where('unidade_id', 6)->get();
		} else if(Auth::user()->id == 60){
			$row5 = MP::where('unidade_id', 7)->get();
		} else if(Auth::user()->id == 61){
			$row5 = MP::where('unidade_id', 8)->get();
		} else if(Auth::user()->id == 59){
			$row5 = MP::where('unidade_id', 2)->get();
		} else if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$row5 = MP::all();
		}
		$qtd  = sizeof($row5);
		for($a = 0; $a < $qtd; $a++){
			$ids[] = $row5[$a]->id;
		}
		$rpa = Admissao::whereIn('mp_id',$ids)->where('tipo','rpa')->get();
		$qtdAlt     = sizeof($rpa);
		$totalRPA_SAL = 0; $totalRPA_OV = 0;
		for($c = 0; $c < $qtdAlt; $c++)
		{
			$totalRPA_SAL += $rpa[$c]->salario;
			$totalRPA_OV  += $rpa[$c]->outras_verbas;
		}
		$unidades = Unidade::all();
		return view('/graphics/graphics8', compact('row5','qtd','qtdAlt','rpa','totalRPA_SAL','totalRPA_OV','unidades'));
    }
	
	public function pesquisarGrafico8(Request $request)
    {
		$input = $request->all();
		$idU   = $input['unidade_id'];
		$data_i = date('Y-m-d', strtotime($input['data_inicio']));
		$data_f = date('Y-m-d', strtotime($input['data_fim']));
		if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			if($idU == "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::all();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$data_i = "1970-01-01";
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			}
		} 
		$qtd  = sizeof($row5);
		if($qtd > 0) {
			for($a = 0; $a < $qtd; $a++){
				$ids[] = $row5[$a]->id;
			} 
		} else {
			$ids[] = 0;
		}
		$rpa = Admissao::whereIn('mp_id',$ids)->where('tipo','rpa')->get();
		$qtdAlt     = sizeof($rpa);
		$totalRPA_SAL = 0; $totalRPA_OV = 0;
		for($c = 0; $c < $qtdAlt; $c++)
		{
			$totalRPA_SAL += $rpa[$c]->salario;
			$totalRPA_OV  += $rpa[$c]->outras_verbas;
		}
		$unidades = Unidade::all();
		return view('/graphics/graphics8', compact('row5','qtd','qtdAlt','totalRPA_SAL','totalRPA_OV','unidades'));
    }

	public function graphics9()
    {
		if(Auth::user()->id == 5){
			$row5 = MP::where('unidade_id', 3)->get();
		} else if(Auth::user()->id == 1){
			$row5 = MP::where('unidade_id', 4)->get();
		} else if(Auth::user()->id == 34){
			$row5 = MP::where('unidade_id', 5)->get();
		} else if(Auth::user()->id == 48){
			$row5 = MP::where('unidade_id', 6)->get();
		} else if(Auth::user()->id == 60){
			$row5 = MP::where('unidade_id', 7)->get();
		} else if(Auth::user()->id == 61){
			$row5 = MP::where('unidade_id', 8)->get();
		} else if(Auth::user()->id == 59){
			$row5 = MP::where('unidade_id', 2)->get();
		} else if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			$row5 = MP::all();
		}
		$qtd  = sizeof($row5);
		for($a = 0; $a < $qtd; $a++){
			$ids[] = $row5[$a]->id;
		}
		$adm = Admissao::whereIn('mp_id',$ids)->where('motivo','aumento_quadro')->get();
		$qtdAlt     = sizeof($adm);
		$totalRPA_SAL = 0; $totalRPA_OV = 0;
		for($c = 0; $c < $qtdAlt; $c++)
		{
			$totalRPA_SAL += $adm[$c]->salario;
			$totalRPA_OV  += $adm[$c]->outras_verbas;
		}
		$unidades = Unidade::all();
		return view('/graphics/graphics9', compact('row5','qtd','qtdAlt','adm','totalRPA_SAL','totalRPA_OV','unidades'));
    }
	
	public function pesquisarGrafico9(Request $request)
    {
		$input = $request->all();
		$idU   = $input['unidade_id'];
		$data_i = date('Y-m-d', strtotime($input['data_inicio']));
		$data_f = date('Y-m-d', strtotime($input['data_fim']));
		if(Auth::user()->id == 30 || Auth::user()->id == 62 || Auth::user()->id == 71){
			if($idU == "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::all();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$data_i = "1970-01-01";
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f == "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")) {
				$data_f = date('Y-m-d', strtotime('now'));
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i == "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			} else if ($idU != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")) {
				$row5 = MP::where('unidade_id', $idU)->whereBetween('data_emissao',[$data_i,$data_f])->get();
			}
		} 
		$qtd  = sizeof($row5);
		if($qtd > 0) {
			for($a = 0; $a < $qtd; $a++){
				$ids[] = $row5[$a]->id;
			} 
		} else {
			$ids[] = 0;
		}
		$adm = Admissao::whereIn('mp_id',$ids)->where('motivo','aumento_quadro')->get();
		$qtdAlt     = sizeof($adm);
		$totalRPA_SAL = 0; $totalRPA_OV = 0;
		for($c = 0; $c < $qtdAlt; $c++)
		{
			$totalRPA_SAL += $adm[$c]->salario;
			$totalRPA_OV  += $adm[$c]->outras_verbas;
		}
		$unidades = Unidade::all();
		return view('/graphics/graphics9', compact('row5','qtd','qtdAlt','totalRPA_SAL','totalRPA_OV','unidades'));
    }
	
	public function visualizarMPs()
	{
		$unidades  = Unidade::all();
		$mps 	   = MP::all();
		$aprovacao = Aprovacao::all();
		$gestores  = Gestor::all();
		return view('visualizarMPs', compact('unidades','mps','aprovacao','gestores'));
	}
	
	public function criadasMPs()
	{
		$unidades  = Unidade::all();
		$und 	   = Auth::user()->unidade;
		$und = explode(",",$und); 
		$funcao    = Auth::user()->funcao;
		if($funcao == "Gestor" || $funcao == "Gestor Imediato" || $funcao == "Administrador"){
			$mps = MP::where('solicitante',Auth::user()->name)->where('concluida',0)->get();
		} else {
			$mps = DB::table('mp')->whereIn('unidade_id',$und)
			->where('concluida',0)->orderby('mp.unidade_id', 'ASC')->get();
		} 
		$aprovacao = Aprovacao::all();
		$gestores  = Gestor::all();
		return view('criadasMPs', compact('unidades','mps','aprovacao','gestores'));
	}
	
	public function aprovadasMPs()
	{
		$unidades  = Unidade::all();
		$und 	   = Auth::user()->unidade; 
		$und 	   = explode(",",$und);
		$funcao    = Auth::user()->funcao; 
		$nome      = Auth::user()->name;
		if($funcao == "Gestor" || $funcao == "Gestor Imediato" || $funcao == "Administrador"){
			$mps = MP::where('solicitante',$nome)->orderBy('unidade_id', 'ASC')->where('concluida',1)
					 ->where('aprovada',1)->get();
		} else {
			$mps = DB::table('mp')->whereIn('unidade_id', $und)->where('aprovada',1)
			->where('concluida',1)->orderby('mp.unidade_id', 'ASC')->paginate(20);
		} 
		$aprovacao = Aprovacao::all();
		$gestores  = Gestor::all();
		return view('aprovadasMPs', compact('unidades','mps','aprovacao','gestores'));
	}
	
	public function reprovadasMPs()
	{
		$unidades  = Unidade::all();
		$und 	   = Auth::user()->unidade; 
		$und 	   = explode(",",$und);
		$funcao    = Auth::user()->funcao; 
		$nome      = Auth::user()->name;
		if($funcao == "Gestor" || $funcao == "Gestor Imediato"){
			$mps = MP::where('solicitante',$nome)->orderBy('unidade_id', 'ASC')->where('concluida',1)
					 ->where('aprovada',0)->get();
		} else {
			$mps = DB::table('mp')->whereIn('unidade_id', $und)->where('aprovada',0)
			->where('concluida',1)->orderby('mp.unidade_id', 'ASC')->paginate(20);
		} 		
		$aprovacao = Aprovacao::all();
		$gestores  = Gestor::all();
		return view('reprovadasMPs', compact('unidades','mps','aprovacao','gestores'));
	}
	
	public function pesquisaMPs(Request $request)
	{
		$unidades   = Unidade::all();
		$aprovacao  = Aprovacao::all();
		$gestores   = Gestor::all();
		$input 	    = $request->all();
		if(empty($input['unidade_id'])){ $input['unidade_id'] = 0;  }
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$unidade_id = $input['unidade_id'];
		$pesq 	    = $input['pesq'];
		$pesq2      = $input['pesq2']; 
		$und 	   = Auth::user()->unidade; 
		$und 	   = explode(",",$und);
		$funcao    = Auth::user()->funcao; 
		$nome      = Auth::user()->name;	
		if($pesq2 == "demissao"){
			$pesquisa = Demissao::all();
			$qtd = sizeof($pesquisa); 
		} else if($pesq2 == "alteracao") {
			$pesquisa = Alteracao_Funcional::all();
			$qtd = sizeof($pesquisa); 
		} else if($pesq2 == "admissao") {
			$pesquisa = Admissao::all();
			$qtd = sizeof($pesquisa); 
		} else if($pesq2 == "rpa"){
			$pesquisa = Admissao::where('tipo','rpa')->get();
			$qtd = sizeof($pesquisa); 
		} else { $qtd = 0; } 
		
		if($funcao == "Gestor" || $funcao == "Gestor Imediato") {	
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $pesquisa[$a]->mp_id; 
				} 
				if($unidade_id != 0){
					if($pesq2 != "") {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('solicitante',Auth::user()->name)
						->where('mp.numeroMP','like','%'.$pesq.'%')->whereIn('unidade_id',$und)->get();	  
					} else {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)
						->where('solicitante',Auth::user()->name)->whereIn('unidade_id',$und)->get();	  
					}
				} else { 
					if($pesq2 != ""){
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->whereIn('unidade_id',$und)
						 ->where('solicitante',Auth::user()->name)->where('mp.numeroMP','like','%'.$pesq.'%')->get();
					} else {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->whereIn('unidade_id',$und)
						->where('solicitante',Auth::user()->name)->get();
					}
				}
			} else {
				if($unidade_id != 0){
					if($pesq != ""){
						$mps = DB::table('mp')->where($pesq2,'like','%'.$pesq.'%')->where('concluida', 0)
						->where('solicitante',Auth::user()->name)->where('unidade_id',$und)->get();
					} else {
						$mps = DB::table('mp')->where('concluida', 0)
						->where('solicitante',Auth::user()->name)->where('unidade_id',$und)->get();
					}
				} else {
					if($pesq != ""){
						$mps = DB::table('mp')->where($pesq2,'like','%'.$pesq.'%')->where('concluida', 0)
						->where('solicitante',Auth::user()->name)->where('unidade_id',$und)->get();
					} else {
						$mps = DB::table('mp')->where('concluida', 0)->where('unidade_id',$und)
						->where('solicitante',Auth::user()->name)->get();
					}
				}
			}
		} else {
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $pesquisa[$a]->mp_id; 
				} 
				if($unidade_id != 0){
					if($pesq2 != ""){
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)
						->where('mp.numeroMP','like','%'.$pesq.'%')->whereIn('unidade_id',$und)
						->where('unidade_id',$unidade_id)->get();	  
					} else {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)
						->where('mp.numeroMP','like','%'.$pesq.'%')->where('unidade_id',$und)->get();	  
					}
				} else {
					if($pesq2 != ""){
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->whereIn('unidade_id',$und)
						->where('mp.numeroMP','like','%'.$pesq.'%')->get();
					} else {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('unidade_id',$und)
						->where('mp.numeroMP','like','%'.$pesq.'%')->get();
					}
				}
			} else { 
				if($unidade_id != 0){
					if($pesq2 != ""){
						$mps = DB::table('mp')->where($pesq2,'like','%'.$pesq.'%')->where('concluida', 0)
						->whereIn('unidade_id',$und)->where('unidade_id',$unidade_id)->get();
					} else {
						$mps = DB::table('mp')->whereIn('unidade_id',$und)->where('concluida', 0)
						->where('unidade_id',$unidade_id)->get();
					}
				} else {
					if($pesq2 != ""){
						$mps = DB::table('mp')->where($pesq2,'like','%'.$pesq.'%')->where('concluida', 0)
						->where('unidade_id',$und)->get();
					} else {
						$mps = DB::table('mp')->where('concluida', 0)->whereIn('unidade_id',$und)
						->orderBy('unidade_id','ASC')->get();
					}
				}
			}
		}
		return view('criadasMPs', compact('unidades','mps','aprovacao','gestores'));
	}
	
	public function pesquisaMPsAp(Request $request)
	{
		$unidades   = Unidade::all();
		$aprovacao  = Aprovacao::all();
		$gestores   = Gestor::all();
		$input 	    = $request->all();
		if(empty($input['unidade_id'])){ $input['unidade_id'] = 0;  }
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$unidade_id = $input['unidade_id'];
		$pesq 	    = $input['pesq'];
		$pesq2      = $input['pesq2']; 
		$und 	   = Auth::user()->unidade; 
		$und 	   = explode(",",$und);
		$funcao    = Auth::user()->funcao; 
		$nome      = Auth::user()->name;	
		if($pesq2 == "demissao"){
			$pesquisa = Demissao::all();
			$qtd = sizeof($pesquisa); 
		} else if($pesq2 == "alteracao") {
			$pesquisa = Alteracao_Funcional::all();
			$qtd = sizeof($pesquisa); 
		} else if($pesq2 == "admissao") {
			$pesquisa = Admissao::all();
			$qtd = sizeof($pesquisa); 
		} else if($pesq2 == "rpa"){
			$pesquisa = Admissao::where('tipo','rpa')->get();
			$qtd = sizeof($pesquisa); 
		} else { $qtd = 0; } 
		
		if($funcao == "Gestor" || $funcao == "Gestor Imediato" || $funcao == "Administrador") {	
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $pesquisa[$a]->mp_id; 
				} 
				if($unidade_id != 0){
					if($pesq2 != "") {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)->where('solicitante',Auth::user()->name)
						->where('aprovada',1)->where('mp.numeroMP','like','%'.$pesq.'%')->whereIn('unidade_id',$und)
						->where('unidade_id',$unidade_id)->get();	  
					} else {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)
						->where('aprovada',1)->where('solicitante',Auth::user()->name)->whereIn('unidade_id',$und)->get();	  
					}
				} else { 
					if($pesq2 != ""){
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)->whereIn('unidade_id',$und)
						->where('aprovada',1)->where('solicitante',Auth::user()->name)->where('mp.numeroMP','like','%'.$pesq.'%')->get();
					} else {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)->whereIn('unidade_id',$und)
						->where('aprovada',1)->where('solicitante',Auth::user()->name)->get();
					}
				}
			} else {
				if($pesq2 == "data"){ 
					$data_i = date('Y-m-d', strtotime($input['data_inicio']));
					$data_f = date('Y-m-d', strtotime($input['data_fim'])); 
					if($unidade_id != "0"){ 
						$mps = DB::table('mp')->join('aprovacao','mp.id','=','aprovacao.mp_id')
								->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
								->where('mp.concluida',1)->whereIn('mp.unidade_id',$und)
								->where('mp.unidade_id',$unidade_id)
								->where('mp.aprovada',1)->select('mp.*')->orderby('mp.id')->distinct()->get();
					}else { 
						$mps = DB::table('mp')->join('aprovacao','mp.id','=','aprovacao.mp_id')
								->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
								->where('mp.solicitante',Auth::user()->name)
								->where('mp.concluida',1)->whereIn('mp.unidade_id',$und)
								->where('mp.aprovada',1)->select('mp.*')->groupby('mp.id')->orderby('mp.id')->get();
					}
				} else if($unidade_id != 0){
					if($pesq != ""){
						$mps = DB::table('mp')->where($pesq2,'like','%'.$pesq.'%')->where('concluida',1)->where('unidade_id',$unidade_id)
						->where('aprovada',1)->where('solicitante',Auth::user()->name)->where('unidade_id',$und)->get();
					} else {
						$mps = DB::table('mp')->where('concluida',1)->where('unidade_id',$unidade_id)
						->where('aprovada',1)->where('solicitante',Auth::user()->name)->where('unidade_id',$und)->get();
					}
				} else {
					if($pesq != ""){
						$mps = DB::table('mp')->where($pesq2,'like','%'.$pesq.'%')->where('concluida',1)
						->where('aprovada',1)->where('solicitante',Auth::user()->name)->where('unidade_id',$und)->get();
					} else {
						$mps = DB::table('mp')->where('concluida',1)->where('unidade_id',$und)
						->where('aprovada',1)->where('solicitante',Auth::user()->name)->get();
					}
				}
			}
		} else {
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $pesquisa[$a]->mp_id; 
				} 
				if($unidade_id != 0){
					if($pesq2 != ""){
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)
						->where('mp.numeroMP','like','%'.$pesq.'%')->whereIn('unidade_id',$und)
						->where('aprovada',1)->where('unidade_id',$unidade_id)->get();	  
					} else {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)
						->where('aprovada',1)->where('mp.numeroMP','like','%'.$pesq.'%')->where('unidade_id',$und)->get();	  
					}
				} else {
					if($pesq2 != ""){
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)->whereIn('unidade_id',$und)
						->where('aprovada',1)->where('mp.numeroMP','like','%'.$pesq.'%')->get();
					} else {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)->where('unidade_id',$und)
						->where('aprovada',1)->where('mp.numeroMP','like','%'.$pesq.'%')->get();
					}
				}
			} else { 
				if($pesq2 == "data"){ 
					$data_i = date('Y-m-d', strtotime($input['data_inicio']));
					$data_f = date('Y-m-d', strtotime($input['data_fim'])); 
					if($unidade_id != "0"){
						$mps = DB::table('mp')->join('aprovacao','mp.id','=','aprovacao.mp_id')
								->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
								->where('mp.concluida',1)->whereIn('mp.unidade_id',$und)
								->where('mp.unidade_id',$unidade_id)
								->where('mp.aprovada',1)->select('mp.*')->orderby('mp.id')->distinct()->get();
					}else {
						$mps = DB::table('mp')->join('aprovacao','mp.id','=','aprovacao.mp_id')
								->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
								->where('mp.concluida',1)->whereIn('mp.unidade_id',$und)
								->where('mp.aprovada',1)->select('mp.*')->orderby('mp.id')->distinct()->get();
					}
				} else if($unidade_id != 0){
					if($pesq2 != ""){
						$mps = DB::table('mp')->where($pesq2,'like','%'.$pesq.'%')->where('concluida',1)
						->where('aprovada',1)->whereIn('unidade_id',$und)->where('unidade_id',$unidade_id)->get();
					} else {
						$mps = DB::table('mp')->whereIn('unidade_id',$und)->where('concluida',1)
						->where('aprovada',1)->where('unidade_id',$unidade_id)->get();
					}
				} else {
					if($pesq2 != ""){
						$mps = DB::table('mp')->where($pesq2,'like','%'.$pesq.'%')->where('concluida',1)
						->where('aprovada',1)->whereIn('unidade_id',$und)->get();
					} else {
						$mps = DB::table('mp')->where('concluida',1)->whereIn('unidade_id',$und)
						->where('aprovada',1)->orderBy('unidade_id','ASC')->get();
					}
				}
			}
		}
		return view('aprovadasMPs', compact('unidades','mps','aprovacao','gestores'));
	}
	
	public function pesquisaMPsRe(Request $request)
	{
		$unidades   = Unidade::all();
		$aprovacao  = Aprovacao::all();
		$gestores   = Gestor::all();
		$input 	    = $request->all();
		if(empty($input['unidade_id'])){ $input['unidade_id'] = 0;  }
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$unidade_id = $input['unidade_id'];
		$pesq 	    = $input['pesq'];
		$pesq2      = $input['pesq2']; 
		$und 	   = Auth::user()->unidade; 
		$und 	   = explode(",",$und);
		$funcao    = Auth::user()->funcao; 
		$nome      = Auth::user()->name;	
		if($pesq2 == "demissao"){
			$pesquisa = Demissao::all();
			$qtd = sizeof($pesquisa); 
		} else if($pesq2 == "alteracao") {
			$pesquisa = Alteracao_Funcional::all();
			$qtd = sizeof($pesquisa); 
		} else if($pesq2 == "admissao") {
			$pesquisa = Admissao::all();
			$qtd = sizeof($pesquisa); 
		} else if($pesq2 == "rpa"){
			$pesquisa = Admissao::where('tipo','rpa')->get();
			$qtd = sizeof($pesquisa); 
		} else { $qtd = 0; } 
		
		if($funcao == "Gestor" || $funcao == "Gestor Imediato" || $funcao == "Administrador") {	
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $pesquisa[$a]->mp_id; 
				} 
				if($unidade_id != 0){
					if($pesq2 != "") {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)->where('solicitante',Auth::user()->name)
						->where('aprovada',0)->where('mp.numeroMP','like','%'.$pesq.'%')->whereIn('unidade_id',$und)
						->where('unidade_id',$unidade_id)->get();	  
					} else {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)
						->where('aprovada',0)->where('solicitante',Auth::user()->name)->whereIn('unidade_id',$und)->get();	  
					}
				} else { 
					if($pesq2 != ""){
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)->whereIn('unidade_id',$und)
						->where('aprovada',0)->where('solicitante',Auth::user()->name)->where('mp.numeroMP','like','%'.$pesq.'%')->get();
					} else {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)->whereIn('unidade_id',$und)
						->where('aprovada',0)->where('solicitante',Auth::user()->name)->get();
					}
				}
			} else {
				if($unidade_id != 0){
					if($pesq != ""){
						$mps = DB::table('mp')->where($pesq2,'like','%'.$pesq.'%')->where('concluida',1)->where('unidade_id',$unidade_id)
						->where('aprovada',0)->where('solicitante',Auth::user()->name)->where('unidade_id',$und)->get();
					} else {
						$mps = DB::table('mp')->where('concluida',1)->where('unidade_id',$unidade_id)
						->where('aprovada',0)->where('solicitante',Auth::user()->name)->where('unidade_id',$und)->get();
					}
				} else {
					if($pesq != ""){
						$mps = DB::table('mp')->where($pesq2,'like','%'.$pesq.'%')->where('concluida',1)
						->where('aprovada',0)->where('solicitante',Auth::user()->name)->where('unidade_id',$und)->get();
					} else {
						$mps = DB::table('mp')->where('concluida',1)->where('unidade_id',$und)
						->where('aprovada',0)->where('solicitante',Auth::user()->name)->get();
					}
				}
			}
		} else {
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $pesquisa[$a]->mp_id; 
				} 
				if($unidade_id != 0){
					if($pesq2 != ""){
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)
						->where('mp.numeroMP','like','%'.$pesq.'%')->whereIn('unidade_id',$und)
						->where('aprovada',0)->where('unidade_id',$unidade_id)->get();	  
					} else {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)
						->where('aprovada',0)->where('mp.numeroMP','like','%'.$pesq.'%')->where('unidade_id',$und)->get();	  
					}
				} else {
					if($pesq2 != ""){
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)->whereIn('unidade_id',$und)
						->where('aprovada',0)->where('mp.numeroMP','like','%'.$pesq.'%')->get();
					} else {
						$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',1)->where('unidade_id',$und)
						->where('aprovada',0)->where('mp.numeroMP','like','%'.$pesq.'%')->get();
					}
				}
			} else { 
				if($pesq2 == "data"){ 
					$data_i = date('Y-m-d', strtotime($input['data_inicio']));
					$data_f = date('Y-m-d', strtotime($input['data_fim'])); 
					if($unidade_id != "0"){
						$mps = DB::table('mp')->join('aprovacao','mp.id','=','aprovacao.mp_id')
								->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
								->where('mp.concluida',1)->whereIn('mp.unidade_id',$und)
								->where('mp.unidade_id',$unidade_id)
								->where('mp.aprovada',0)->select('mp.*')->orderBy('mp.id')->distinct()->get();
					}else {
						$mps = DB::table('mp')->join('aprovacao','mp.id','=','aprovacao.mp_id')
								->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
								->where('mp.concluida',1)->whereIn('mp.unidade_id',$und)
								->where('mp.aprovada',0)->select('mp.*')->orderBy('mp.id')->distinct()->get();
					}
				} else if($unidade_id != 0){
					if($pesq2 != ""){
						$mps = DB::table('mp')->where($pesq2,'like','%'.$pesq.'%')->where('concluida',1)
						->where('aprovada',0)->whereIn('unidade_id',$und)->where('unidade_id',$unidade_id)->get();
					} else {
						$mps = DB::table('mp')->whereIn('unidade_id',$und)->where('concluida',1)
						->where('aprovada',0)->where('unidade_id',$unidade_id)->get();
					}
				} else {
					if($pesq2 != ""){
						$mps = DB::table('mp')->where($pesq2,'like','%'.$pesq.'%')->where('concluida',1)
						->where('aprovada',0)->whereIn('unidade_id',$und)->get();
					} else {
						$mps = DB::table('mp')->where('concluida',1)->whereIn('unidade_id',$und)
						->where('aprovada',0)->orderBy('unidade_id','ASC')->get();
					}
				}
			}
		}
		return view('reprovadasMPs', compact('unidades','mps','aprovacao','gestores'));
	}
	
	public function indexValida()
	{
		$idG = Auth::user()->id;
		$mps 	   = MP::all();
		$admissao  = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
		->join('justificativa','justificativa.mp_id','=','mp.id')
		->select('mp.*','justificativa.descricao as just','admissao.*')
		->where('mp.concluida',0)->where('mp.gestor_id',$idG)->get();
		$qtdAd = sizeof($admissao);
		$demissao  = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
		->join('justificativa','justificativa.mp_id','=','mp.id')
		->select('mp.*','justificativa.descricao as just','demissao.*')
		->where('mp.concluida',0)->where('mp.gestor_id',$idG)->get();
		$qtdDe = sizeof($demissao);
		$alteracF  = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
		->join('justificativa','justificativa.mp_id','=','mp.id')
		->select('mp.*','justificativa.descricao as just','alteracao_funcional.*')
		->where('mp.concluida',0)->where('mp.gestor_id',$idG)->get(); 
		$qtdAl = sizeof($alteracF);
		if($qtdAd > 0){
			for($a = 0; $a < $qtdAd; $a++){
				$ids[] = $admissao[$a]->mp_id; 
			} 
			$aprovacaoAd = Aprovacao::whereIn('mp_id',$ids)->get();
		} else { $aprovacaoAd = NULL; }
		if($qtdDe > 0){
			for($a = 0; $a < $qtdDe; $a++){
				$ids[] = $demissao[$a]->mp_id; 
			} 
			$aprovacaoDe = Aprovacao::whereIn('mp_id',$ids)->get();
		} else { $aprovacaoDe = NULL; }
		if($qtdAl > 0){
			for($a = 0; $a < $qtdAl; $a++){
				$ids[] = $alteracF[$a]->mp_id; 
			} 
			$aprovacaoAl = Aprovacao::whereIn('mp_id',$ids)->get();
		} else { $aprovacaoAl = NULL; }
		$gestores  = Gestor::all();
		return view('validar', compact('mps','aprovacaoAd','aprovacaoDe','aprovacaoAl','gestores','admissao','demissao','alteracF'));	
	}
	
	public function validarMP($id)
	{
		$mps  	   = MP::where('id', $id)->get();
		$solicitante = $mps[0]->solicitante;
		$solic    = Gestor::where('nome',$solicitante)->get();
		$gestor   = $solic[0]->gestor_imediato; 
		$gestor   = Gestor::where('nome', $gestor)->get();
		$gestores = Gestor::all();
		$unidades = Unidade::all();  
		$idU 		   = $mps[0]->unidade_id;
		$unidade 	   = Unidade::where('id', $idU)->get();
		$admissao 	   = Admissao::where('mp_id',$id)->get();
		$qtdAdm 	   = sizeof($admissao);
		$demissao 	   = Demissao::where('mp_id',$id)->get();
		$qtdDem   	   = sizeof($demissao);
		$alteracaoF    = Alteracao_Funcional::where('mp_id',$id)->get();
		$qtdAlt 	   = sizeof($alteracaoF);
		$justificativa = Justificativa::where('mp_id', $id)->get();
		$aprovacao 	   = Aprovacao::where('mp_id',$id)->get();
		$qtdA 		   = sizeof($aprovacao); 
		$data_aprovacao 		= null;
		$data_gestor_imediato 	= null;
		$data_rec_humanos 		= null;
		$data_diretoria_tecnica = null;
		$data_diretoria_financeira = null;
		$data_diretoria 		= null;
		$data_superintendencia  = null;
		$solicitante = $mps[0]->solicitante;
		$gestorData   = ""; $gestorDataId = "";
		$rh           = ""; $rhId    	  = "";
		$diretoriaT   = ""; $diretoriaTId = ""; 
		$diretoriaF   = ""; $diretoriaFId = "";
		$diretoria    = ""; $diretoriaId  = "";
		$super        = ""; $superId      = "";
		$data_aprovacao = $mps[0]->created_at; 	
		for($i = 0; $i < $qtdA; $i++) {
			$idU = $aprovacao[$i]->gestor_anterior;
			if($idU == 48 || $idU == 1 || $idU == 116 || $idU == 34 || $idU == 55){ 
			    $funcao = "Gestor Imediato"; 
			} else {
			    $funcao = User::where('id', $idU)->get(); 
			    $funcao = $funcao[0]['funcao'];
			}
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
				if($aprovacao[$i]->gestor_anterior == 30){
				    $gestorB = $aprovacao[$i]->gestor_anterior;  
				}
				if($gestorB != ""){
    			    $rh = Gestor::where('id', $gestorB)->get('nome'); 
					$rhId = Gestor::where('id', $gestorB)->get('id'); 
    			} else {
    			    $rh = ""; 
    			}    
			}
			if($aprovacao[$i]->resposta == 1 && $funcao == "Diretoria Tecnica"){
				$data_diretoria_tecnica = $aprovacao[$i]->data_aprovacao; 
				if($aprovacao[$i]->gestor_anterior == 65 || $aprovacao[$i]->gestor_anterior == 93){
				    $gestorC = $aprovacao[$i]->gestor_anterior;  
				} 
    			if($gestorC != ""){
    			    $diretoriaT = Gestor::where('id', $gestorC)->get('nome'); 
					$diretoriaTId = Gestor::where('id', $gestorC)->get('id'); 
    			} else {
    			    $diretoriaT = ""; 
    			}
			} 
			if($aprovacao[$i]->resposta == 1 && $funcao == "Diretoria Financeira"){
				$data_diretoria_financeira = $aprovacao[$i]->data_aprovacao;
				if($aprovacao[$i]->gestor_anterior == 174){
					$gestorC2 = $aprovacao[$i]->gestor_anterior;
				}
				if($gestorC2 != ""){
					$diretoriaF   = Gestor::where('id',$gestorC2)->get('nome');
					$diretoriaFId = Gestor::where('id',$gestorC2)->get('id');
				} else {
					$diretoriaF = "";
				}
			}
			if($aprovacao[$i]->resposta == 1 && $funcao == "Diretoria"){
				$data_diretoria = $aprovacao[$i]->data_aprovacao;
				if($aprovacao[$i]->gestor_anterior == 59 || $aprovacao[$i]->gestor_anterior == 60 || $aprovacao[$i]->gestor_anterior == 61 || $aprovacao[$i]->gestor_anterior == 42 
				|| $aprovacao[$i]->gestor_anterior == 155 || $aprovacao[$i]->gestor_anterior == 160 || $aprovacao[$i]->gestor_anterior == 167){
				    $gestorD = $aprovacao[$i]->gestor_anterior;  
				}
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
		$justNA = JustificativaN_Autorizada::where('mp_id',$id)->get();
		if($qtdAdm > 0){
			return view('index_', compact('mps','gestores','unidades','unidade','admissao','alteracaoF','demissao','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria_financeira','data_diretoria','data_superintendencia','aprovacao','justNA','solicitante','gestorData','rh','diretoriaT','diretoriaF','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaFId','diretoriaId','superId','gestor'));
		} else if($qtdDem > 0) {
			return view('index_', compact('mps','gestores','unidades','unidade','admissao','alteracaoF','demissao','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria_financeira','data_diretoria','data_superintendencia','aprovacao','justNA','solicitante','gestorData','rh','diretoriaT','diretoriaF','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaFId','diretoriaId','superId','gestor'));
		} else if($qtdAlt > 0) {
			return view('index_', compact('mps','gestores','unidades','unidade','admissao','alteracaoF','demissao','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria_financeira','data_diretoria','data_superintendencia','aprovacao','justNA','solicitante','gestorData','rh','diretoriaT','diretoriaF','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaFId','diretoriaId','superId','gestor'));
		}	
	}
	
	public function visualizarMP($id)
	{
		$mps = MP::where('id', $id)->get(); 
		$solicitante = $mps[0]->solicitante;
		$solic    = Gestor::where('nome',$solicitante)->get();
		$gestor   = $solic[0]->gestor_imediato;
		$gestor   = Gestor::where('nome', $gestor)->get();
		$gestores = Gestor::all();
		$unidades = Unidade::all();
		$idU = $mps[0]->unidade_id;
		$unidade = Unidade::where('id', $idU)->get();
		$admissao = Admissao::where('mp_id',$id)->get();
		$qtdAdm = sizeof($admissao);
		$demissao = Demissao::where('mp_id',$id)->get();
		$qtdDem = sizeof($demissao);
		$alteracaoF = Alteracao_Funcional::where('mp_id',$id)->get();
		$qtdAlt = sizeof($alteracaoF);
		$justificativa = Justificativa::where('mp_id', $id)->get();
		$aprovacao = Aprovacao::where('mp_id',$id)->get();
		$qtdA = sizeof($aprovacao); 
		$data_aprovacao 		= null;
		$data_gestor_imediato 	= null;
		$data_rec_humanos 		= null;
		$data_diretoria_tecnica = null; 
		$data_diretoria_financeira = null;
		$data_diretoria 		= null;
		$data_superintendencia  = null;
		$solicitante = $mps[0]->solicitante;
		$gestorData   = ""; $gestorDataId = "";
		$rh           = ""; $rhId    	  = "";
		$diretoriaT   = ""; $diretoriaTId = "";
		$diretoriaF   = ""; $diretoriaFId = "";
		$diretoria    = ""; $diretoriaId  = "";
		$super        = ""; $superId      = "";
		$data_aprovacao = $mps[0]->created_at;		
		
		for($i = 0; $i < $qtdA; $i++) {
			$idU = $aprovacao[$i]->gestor_anterior;
			if($idU == 48 || $idU == 1 || $idU == 116 || $idU == 5 || $idU == 34){ 
			    $funcao = "Gestor Imediato"; 
			} else {
			    $funcao = User::where('id', $idU)->get(); 
			    $funcao = $funcao[0]['funcao']; 
			}
			if($aprovacao[$i]->resposta == 1 && $funcao == "Gestor Imediato") {
				$data_gestor_imediato = $aprovacao[$i]->data_aprovacao;
				$gestorA = $aprovacao[$i]->gestor_anterior;  
    				if($gestorA != ""){
    				    $gestorData = Gestor::where('id', $gestorA)->get('nome');
						$gestorDataId = Gestor::where('id', $gestorA)->get('id');
    				} else {
    				    $gestorData = ""; 
    				}
			} else if ($aprovacao[$i]->resposta == 3 && $funcao == "Gestor Imediato"){
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
				if($aprovacao[$i]->gestor_anterior == 30){
				    $gestorB = $aprovacao[$i]->gestor_anterior;  
				}
				if($gestorB != ""){
    			    $rh = Gestor::where('id', $gestorB)->get('nome'); 
					$rhId = Gestor::where('id', $gestorB)->get('id'); 
    			} else {
    			    $rh = ""; 
    			}    
			} else if ($aprovacao[$i]->resposta == 3 && $funcao == "RH"){
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
			}
			if($aprovacao[$i]->resposta == 1 && $funcao == "Diretoria Tecnica"){
				$data_diretoria_tecnica = $aprovacao[$i]->data_aprovacao;
				if($aprovacao[$i]->gestor_anterior == 65 || $aprovacao[$i]->gestor_anterior == 163 || $aprovacao[$i]->gestor_anterior == 93){
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
				if($aprovacao[$i]->gestor_anterior == 65 || $aprovacao[$i]->gestor_anterior == 163 || $aprovacao[$i]->gestor_anterior == 93){
				    $gestorC = $aprovacao[$i]->gestor_anterior;   
				}
    			if($gestorC != ""){
    			    $diretoriaT = Gestor::where('id', $gestorC)->get('nome'); 
					$diretoriaTId = Gestor::where('id', $gestorC)->get('id'); 
    			} else {
    			    $diretoriaT = ""; 
    			}
			}
			if($aprovacao[$i]->resposta == 1 && $funcao == "Diretoria Financeira"){
				$data_diretoria_financeira = $aprovacao[$i]->data_aprovacao;
				if($aprovacao[$i]->gestor_anterior == 174){
					$gestorC2 = $aprovacao[$i]->gestor_anterior;
				}
				if($gestorC2 != ""){
					$diretoriaF   = Gestor::where('id',$gestorC2)->get('nome');
					$diretoriaFId = Gestor::where('id',$gestorC2)->get('id');
				} else {
					$diretoriaF = "";
				}
			} else if($aprovacao[$i]->resposta == 3 && $funcao == "Diretoria Financeira"){
				$data_diretoria_financeira = $aprovacao[$i]->data_aprovacao;
				if($aprovacao[$i]->gestor_anterior == 174){
					$gestorC2 = $aprovacao[$i]->gestor_anterior;
				}
				if($gestorC2 != ""){
					$diretoriaF   = Gestor::where('id',$gestorC2)->get('nome');
					$diretoriaFId = Gestor::where('id',$gestorC2)->get('id');
				} else {
					$diretoriaF = "";
				}
			}
			if($aprovacao[$i]->resposta == 1 && $funcao == "Diretoria"){
				$data_diretoria = $aprovacao[$i]->data_aprovacao; 
				if($aprovacao[$i]->gestor_anterior == 59  || $aprovacao[$i]->gestor_anterior == 60  || $aprovacao[$i]->gestor_anterior == 61 
				|| $aprovacao[$i]->gestor_anterior == 155 || $aprovacao[$i]->gestor_anterior == 160 || $aprovacao[$i]->gestor_anterior == 165
				|| $aprovacao[$i]->gestor_anterior == 167 || $aprovacao[$i]->gestor_anterior == 42) {
					$gestorD = $aprovacao[$i]->gestor_anterior;
				}
				if($gestorD != ""){
    				$diretoria = Gestor::where('id', $gestorD)->get('nome'); 
					$diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
				}
			} else if ($aprovacao[$i]->resposta == 3 && $funcao == "Diretoria") {
				$data_diretoria = $aprovacao[$i]->data_aprovacao; 
				if($aprovacao[$i]->gestor_anterior == 59 || $aprovacao[$i]->gestor_anterior == 60 || $aprovacao[$i]->gestor_anterior == 61 
				|| $aprovacao[$i]->gestor_anterior == 155 || $aprovacao[$i]->gestor_anterior == 160 || $aprovacao[$i]->gestor_anterior == 42){
					$gestorD = $aprovacao[$i]->gestor_anterior;
				}
				if($gestorD != ""){
    			    $diretoria = Gestor::where('id', $gestorD)->get('nome'); 
					$diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
    			}	
			}
			if($aprovacao[$i]->resposta == 3 && $funcao == "Superintendencia"){
				$data_superintendencia = $aprovacao[$i]->data_aprovacao;
				if($aprovacao[$i]->gestor_anterior == 62){
					$gestorE = $aprovacao[$i]->gestor_anterior;
				}
				if($gestorE != ""){
    			    $super = Gestor::where('id', $gestorE)->get('nome');
					$superId = Gestor::where('id', $gestorE)->get('id');	
    			} else {
    			    $super = ""; 
    			}		    
			}
		} 
		
		if($qtdAdm > 0){
			return view('visualizar', compact('mps','gestores','unidades','unidade','admissao','demissao','alteracaoF','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria_financeira','data_diretoria','data_superintendencia','aprovacao','solicitante','gestorData','rh','diretoriaT','diretoriaF','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaFId','diretoriaId','superId','gestor'));
		} else if($qtdDem > 0) {
			return view('visualizar', compact('mps','gestores','unidades','unidade','demissao','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria','data_diretoria_financeira','data_superintendencia','aprovacao','solicitante','gestorData','rh','diretoriaT','diretoriaF','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaFId','diretoriaId','superId','gestor'));
		} else if($qtdAlt > 0) {
		    return view('visualizar', compact('mps','gestores','unidades','unidade','alteracaoF','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria','data_diretoria_financeira','data_superintendencia','aprovacao','solicitante','gestorData','rh','diretoriaT','diretoriaF','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaFId','diretoriaId','superId','gestor'));
		}
	}
	
	public function validarMPs(Request $request)
	{
		$input = $request->all();
		$idG = Auth::user()->id;
		$mps 	   = MP::all();
		$admissao  = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
		->join('justificativa','justificativa.mp_id','=','mp.id')
		->select('mp.*','justificativa.descricao as just','admissao.*')
		->where('mp.concluida',0)->where('mp.gestor_id',$idG)->get();
		$qtdAdm = sizeof($admissao);
		$demissao  = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
		->join('justificativa','justificativa.mp_id','=','mp.id')
		->select('mp.*','justificativa.descricao as just','demissao.*')
		->where('mp.concluida',0)->where('mp.gestor_id',$idG)->get();
		$qtdDem = sizeof($demissao);
		$alteracF  = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
		->join('justificativa','justificativa.mp_id','=','mp.id')
		->select('mp.*','justificativa.descricao as just','alteracao_funcional.*')
		->where('mp.concluida',0)->where('mp.gestor_id',$idG)->get(); 
		$qtdAlt = sizeof($alteracF);
		if($qtdAdm > 0){
			for($a = 0; $a < $qtdAdm; $a++){
				$ids[] = $admissao[$a]->mp_id; 
			} 
			$aprovacaoAd = Aprovacao::whereIn('mp_id',$ids)->get();
		}
		if($qtdDem > 0){
			for($a = 0; $a < $qtdDem; $a++){
				$ids[] = $demissao[$a]->mp_id; 
			} 
			$aprovacaoDe = Aprovacao::whereIn('mp_id',$ids)->get();
		}
		if($qtdAlt > 0){
			for($a = 0; $a < $qtdAlt; $a++){
				$ids[] = $alteracF[$a]->mp_id; 
			} 
			$aprovacaoAl = Aprovacao::whereIn('mp_id',$ids)->get();
		}
		$gestores  = Gestor::all();
		
		$ap = 0;
		for($a = 1; $a <= $qtdAdm; $a++){
			if(!empty($input['check_'.$a])){
				if($input['check_'.$a] == "on"){
					$id_mp = $input['id_mp_'.$a];
					if(Auth::user()->id == 30){
						$idG   = $input['gestor_id_'.$a]; 
						HomeController::aprovar($id_mp,$idG);
					} else {
						$idG   = 0; 
						HomeController::aprovar($id_mp,$idG);
					}
					$ap += 1;
				}
			}
		}

		for($b = 1; $b <= $qtdDem; $b++){
			if(!empty($input['check2_'.$b])){
				if($input['check2_'.$b] == "on"){
					$id_mp = $input['id_mp2_'.$b];
					if(Auth::user()->id == 30){
						$idG   = $input['gestor_id2_'.$b]; 
						HomeController::aprovar($id_mp,$idG);
					} else {
						$idG   = 0; 
						HomeController::aprovar($id_mp,$idG);
					}
					$ap += 1;
				}
			}
		}

		for($c = 1; $c <= $qtdAlt; $c++){
			if(!empty($input['check3_'.$c])){
				if($input['check3_'.$c] == "on"){
					$id_mp = $input['id_mp3_'.$c];
					if(Auth::user()->id == 30) {
						$idG   = $input['gestor_id3_'.$c]; 
						HomeController::aprovar($id_mp,$idG);
					} else {
						$idG   = 0; 
						HomeController::aprovar($id_mp,$idG);
					}
					$ap += 1;
				}
			}
		}
		if($ap == 0){
			$idG = Auth::user()->id;
			$validator = 'Selecione uma MP!';
			return view('validar', compact('mps','aprovacaoAd','aprovacaoAl','aprovacaoDe','gestores','admissao','demissao','alteracF','qtdAlt','qtdAdm','qtdDem'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input())); 
		} else {
			$idG = Auth::user()->id;
			$mps 	   = MP::all();
			$admissao  = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
			->join('justificativa','justificativa.mp_id','=','mp.id')
			->select('mp.*','justificativa.descricao as just','admissao.*')
			->where('mp.concluida',0)->where('mp.gestor_id',$idG)->get();
			$qtdAdm = sizeof($admissao);
			$demissao  = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
			->join('justificativa','justificativa.mp_id','=','mp.id')
			->select('mp.*','justificativa.descricao as just','demissao.*')
			->where('mp.concluida',0)->where('mp.gestor_id',$idG)->get();
			$qtdDem = sizeof($demissao);
			$alteracF  = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
			->join('justificativa','justificativa.mp_id','=','mp.id')
			->select('mp.*','justificativa.descricao as just','alteracao_funcional.*')
			->where('mp.concluida',0)->where('mp.gestor_id',$idG)->get(); 
			$qtdAlt = sizeof($alteracF);
			if($qtdAdm > 0){
				for($a = 0; $a < $qtdAdm; $a++){
					$ids[] = $admissao[$a]->mp_id; 
				} 
				$aprovacaoAd = Aprovacao::whereIn('mp_id',$ids)->get();
			} else { $aprovacaoAd = NULL; }
			if($qtdDem > 0){
				for($a = 0; $a < $qtdDem; $a++){
					$ids[] = $demissao[$a]->mp_id; 
				} 
				$aprovacaoDe = Aprovacao::whereIn('mp_id',$ids)->get();
			} else { $aprovacaoDe = NULL; }
			if($qtdAlt > 0){
				for($a = 0; $a < $qtdAlt; $a++){
					$ids[] = $alteracF[$a]->mp_id; 
				} 
				$aprovacaoAl = Aprovacao::whereIn('mp_id',$ids)->get();
			} else { $aprovacaoAl = NULL; }
			$validator = 'Aprovação Realizada com Sucesso!';
			return view('validar', compact('mps','aprovacaoAd','aprovacaoAl','aprovacaoDe','gestores','admissao','demissao','alteracF','qtdAlt','qtdAdm','qtdDem'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input())); 
		}
	}

	function aprovar($id_mp, $idG){
		$mp    = MP::where('id',$id_mp)->get();
		$id	   = $mp[0]->id;
		if(Auth::user()->name == $mp[0]->solicitante){
			$idG 	 = Auth::user()->id; 
			$gestor  = Gestor::where('id',$idG)->get();
			$gestorI = $gestor[0]->gestor_imediato;
			$gestorI = Gestor::where('nome',$gestorI)->get();
			$idGI    = $gestorI[0]->id;
			DB::statement('UPDATE mp SET gestor_id = '.$idGI.' WHERE id = '.$id.';');
		} else {
			if(Auth::user()->funcao == "Superintendencia"){
				$input['resposta'] = 3;
				DB::statement('UPDATE mp SET concluida = 1 WHERE id  = '.$id.';');
				DB::statement('UPDATE mp SET aprovada  = 1 WHERE id  = '.$id.';');
				DB::statement('UPDATE mp SET gestor_id = 30 WHERE id = '.$id.';');
				$input['gestor_id'] = 30;
				$idG = 30;
			} else if (Auth::user()->funcao == "RH") {
				$input['resposta']  = 1; 
				$input['gestor_id'] = $idG;
				DB::statement('UPDATE aprovacao SET ativo = 0 WHERE mp_id  = '.$id.';');
				DB::statement('UPDATE mp SET gestor_id = '.$idG.' WHERE id = '.$id.';');
			} else {
				$input['resposta'] = 1;
				$idMP = $mp[0]->id;
				$idG  = Auth::user()->id;
				$aprovacao = Aprovacao::where('mp_id',$idMP)->get();
				$qtdAP 	   = sizeof($aprovacao); 
				if($qtdAP > 0){
					$idAp = DB::table('aprovacao')->where('mp_id', $idMP)->max('id');
					$ap   = Aprovacao::where('id',$idAp)->get(); 
					$idA  = $ap[0]->gestor_anterior;	
					if($idG == 61){
						if($idA == 30 || $idA == 163) {
							$idG = 62;
						} else {
							$idG = 30;
						}
					} else if($idG == 60 || $idG == 5 || $idG == 48 || $idG == 1 || $idG == 34 || $idG == 59 
					|| $idG == 155 || $idG == 165 || $idG == 160 || $idG == 166){
						if($idA == 30 || $idA == 174) {
							$idG = 62;
						} else {
							$idG = 30;
						}
					} else if($idG == 65) {
						if($idA == 30) {
							$idG = 174;
						} else {
							$idG = 30;
						}
					} else if($idG == 163){ 
						if($idA == 30){
							$idG = 61;
						} else {
							$idG = 30;
						}
					} else if($idG == 19 || $idG == 39 || $idG == 99){
						$idG = 30;
					} else if($idG == 174) {
					    $idG = 59;
					} else if($idG == 173) {
					    if($idA == 30) {
					        $idG = 61;    
					    } else {
					        $idG = 30;
					    }
					} else {
					    $idG = 30;
					}
				} else {
					$idG = 30;
				}
				$input['gestor_id'] = $idG;
				DB::statement('UPDATE aprovacao SET ativo = 0 WHERE mp_id  = '.$id.';');
				DB::statement('UPDATE mp SET gestor_id = '.$idG.' WHERE id = '.$id.';');
			}
			$input['data_aprovacao']  = date('Y-m-d',(strtotime('now')));
			$input['gestor_anterior'] = Auth::user()->id;
			$input['unidade_id'] 	  = $mp[0]->unidade_id;
			$input['mp_id'] 	  	  = $mp[0]->id;
			$input['motivo'] 	  	  = "Autorizado";
			$input['ativo'] 	  	  = 1;
			$aprovacao = Aprovacao::create($input);
			$gestor = Gestor::where('id', $idG)->get();
			$email  = $gestor[0]->email;
			$solicitante = $mp[0]->solicitante;
			$sol = Gestor::where('nome', $solicitante)->get();
			$email2 = $sol[0]->email;
			$email3 = 'janaina.lima@hcpgestao.org.br';
			$email4 = 'rogerio.reis@hcpgestao.org.br';
			$motivo  = $input['motivo'];
			$tipo = "";
			$admissao  = DB::table('admissao')->where('mp_id',$mp[0]->id)->get();
			$qtdAD 	   = sizeof($admissao);
			$demissao  = DB::table('demissao')->where('mp_id',$mp[0]->id)->get();
			$qtdDE 	   = sizeof($demissao);
			$alteracao = DB::table('alteracao_funcional')->where('mp_id',$mp[0]->id)->get();
			$qtdAL 	   = sizeof($alteracao); $email7 = '';
			if($qtdAD > 0) {
				if($admissao[0]->tipo == "rpa"){
					$tipo = 'RPA';
				} else {
					$tipo = 'CLT';
				}
			}
			if($qtdDE > 0) {
				$tipo = 'CLT';
			}
			if($qtdAL > 0) {
				if($alteracao[0]->motivo == "mudanca_horaria"){
					$tipo = 'PONTO';
				} else {
					$tipo = 'CLT';
				}
			}
			if($mp[0]->unidade_id == 2) {
				if($tipo == 'RPA'){
					$email5 = 'angela.hermida@hcpgestao.org.br';
					$email6 = 'ana.soares@hcpgestao.org.br';
				} else if($tipo == 'PONTO') {
					$email5 = 'tatiana.silva@hcpgestao.org.br';
					$email6 = 'mylena.silva@hcpgestao.org.br';
					$email7 = 'erica.santos@hcpgestao.org.br';  
				} else if($tipo == 'CLT'){
					if($qtdAD > 0){
						$email5 = 'ana.soares@hcpgestao.org.br';
						$email6 = 'laura.lopes@hcpgestao.org.br';
						$email7 = 'mylena.silva@hcpgestao.org.br'; 
					} else if($qtdDE > 0){
						$email5 = 'ana.soares@hcpgestao.org.br';
						$email6 = 'laura.lopes@hcpgestao.org.br';
					} else if($qtdAL > 0){
						$email5 = 'ana.soares@hcpgestao.org.br';
						$email6 = 'laura.lopes@hcpgestao.org.br';
					}
				}
			} else if($mp[0]->unidade_id == 3) {
				$email5 = 'alexandre.siqueira@hcpgestao.org.br';
				$email6 = 'dp@upaebelojardim.org.br'; 
			} else if($mp[0]->unidade_id == 4) {
				$email5 = 'angela.hermida@hcpgestao.org.br';
				$email6 = 'mayara.silva@hcpgestao.org.br';
			} else if($mp[0]->unidade_id == 5) {
				$email5 = 'joao.alves@hcpgestao.org.br';
				$email6 = 'tatiana.silva@hcpgestao.org.br';
			} else if($mp[0]->unidade_id == 6) {
				$email5 = 'laura.lopes@hcpgestao.org.br';
				$email6 = 'antonio.edison@upaecaruaru.org.br';
			} else if($mp[0]->unidade_id == 7) {
				$email5 = 'ana.soares@hcpgestao.org.br';
				$email6 = 'dh@hss.org.br';
			} else if($mp[0]->unidade_id == 8) {
				$email5 = 'fabio.souza@hcpgesao.org.br';
				$email6 = 'rayonara.bento@hcpgestao.org.br';
			}
			$numeroMP = $mp[0]->numeroMP;
			if(Auth::user()->funcao == "Superintendencia"){
				/*Mail::send([], [], function($m) use ($email,$email2,$email3,$email4,$email5,$email6,$email7,$motivo,$numeroMP,$tipo) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('MP - '.$numeroMP.' do Tipo: '.$tipo.' foi Assinada e está Concluída!!');
					$m->setBody($motivo .'! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
					$m->cc($email2); $m->cc($email3); $m->cc($email4);  
					$m->cc($email5); $m->cc($email6); $m->cc($email7); 
				});*/
			} else {
				/*Mail::send([], [], function($m) use ($email,$motivo,$numeroMP) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('MP - '.$numeroMP.' Autorizada!');
					$m->setBody($motivo .'! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
				});*/
			}
		}
	}
	
	public function autorizarMP($id)
	{
		$mp  	  = MP::where('id',$id)->get();
		$idU 	  = $mp[0]->unidade_id;
		$unidade  = Unidade::where('id',$idU)->get();
		$idMP 	  = $mp[0]->id;
		$admissao = Admissao::where('mp_id',$idMP)->get();
		$qtd 	  = sizeof($admissao);
		if($qtd == 0) {
			$admissao = NULL;
		} 
	    $alteracaoF = Alteracao_Funcional::where('mp_id', $idMP)->get();
	    $qtdA = sizeof($alteracaoF);
	    if($qtdA == 0) {
	        $alteracaoF = NULL;
	    }
		$aprovacao 		= Aprovacao::where('mp_id', $idMP)->get();
		$email 			= Auth::user()->email; 
		$gestores 		= Gestor::where('email',$email)->get();
		$gestorImediato = $gestores[0]->gestor_imediato;
		$gestores 	    = Gestor::where('nome',$gestorImediato)->get();
		$gestoresUnd    = DB::select("SELECT * FROM gestor WHERE (unidade_id = ".$idU.") AND id <> 60 AND id <> 59 AND id <> 61 AND id <> 15 AND id <> 65 ORDER BY nome");
		return view('home_autorizado', compact('unidade','mp','gestores','admissao','alteracaoF','gestorImediato','gestoresUnd','aprovacao'));
	}
	
	public function storeAutMP($id, Request $request)
	{
		$mp = MP::where('id', $id)->get();
		$idU = $mp[0]->unidade_id;
		$idMP = $id;
		$unidade = Unidade::where('id',$idU)->get();
		$gestores = Gestor::all();
		$gestoresUnd = Gestor::where('unidade_id', $idU)->orderby('nome','ASC')->get();
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'motivo' => 'required|max:1000'
		]);
		if ($validator->fails()) {
			$aprovacao = Aprovacao::all();
			return view('home_autorizado', compact('unidade','mp','gestores','gestoresUnd','aprovacao'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			if(Auth::user()->funcao == "Superintendencia") {
				$input['resposta'] = 3;
				DB::statement('UPDATE mp SET concluida = 1 WHERE id = '.$id.';');
				DB::statement('UPDATE mp SET aprovada = 1 WHERE id = '.$id.';');
			} else {
				$input['resposta'] = 1;	
			}
			$input['data_aprovacao'] = date('Y-m-d',(strtotime('now')));
			$idG = $input['gestor_id'];
			DB::statement('UPDATE aprovacao SET ativo = 0 WHERE mp_id = '.$id.';');
			DB::statement('UPDATE mp SET gestor_id = '.$idG.' WHERE id = '.$id.';');
			$input['gestor_anterior'] = Auth::user()->id;
			$aprovacao = Aprovacao::create($input);
			$gestor = Gestor::where('id', $idG)->get();
			$email = $gestor[0]->email;
			$solicitante = $mp[0]->solicitante;
			$sol = Gestor::where('nome', $solicitante)->get();
			$email2 = $sol[0]->email;
			$email3 = 'janaina.lima@hcpgestao.org.br';
			$email4 = 'rogerio.reis@hcpgestao.org.br';
			$email7 = '';
			$tipo = "";
			$admissao  = DB::table('admissao')->where('mp_id',$mp[0]->id)->get();
			$qtdAD 	   = sizeof($admissao);
			$demissao  = DB::table('demissao')->where('mp_id',$mp[0]->id)->get();
			$qtdDE 	   = sizeof($demissao);
			$alteracao = DB::table('alteracao_funcional')->where('mp_id',$mp[0]->id)->get();
			$qtdAL 	   = sizeof($alteracao); $email7 = '';
			if($qtdAD > 0) {
				if($admissao[0]->tipo == "rpa"){
					$tipo = 'RPA';
				} else {
					$tipo = 'CLT';
				}
			}
			if($qtdDE > 0) {
				$tipo = 'CLT';
			}
			if($qtdAL > 0) {
				if($alteracao[0]->motivo == "mudanca_horaria"){
					$tipo = 'PONTO';
				} else {
					$tipo = 'CLT';
				}
			}
			if($mp[0]->unidade_id == 2) {
				if($tipo == 'RPA'){
					$email5 = 'angela.hermida@hcpgestao.org.br';
					$email6 = 'ana.soares@hcpgestao.org.br';
				} else if($tipo == 'PONTO') {
					$email5 = 'tatiana.silva@hcpgestao.org.br';
					$email6 = 'mylena.silva@hcpgestao.org.br';
					$email7 = 'erica.santos@hcpgestao.org.br';  
				} else if($tipo == 'CLT'){
					if($qtdAD > 0){
						$email5 = 'ana.soares@hcpgestao.org.br';
						$email6 = 'laura.lopes@hcpgestao.org.br';
						$email7 = 'mylena.silva@hcpgestao.org.br'; 
					} else if($qtdDE > 0){
						$email5 = 'ana.soares@hcpgestao.org.br';
						$email6 = 'laura.lopes@hcpgestao.org.br';
					} else if($qtdAL > 0){
						$email5 = 'ana.soares@hcpgestao.org.br';
						$email6 = 'laura.lopes@hcpgestao.org.br';
					}
				}
			} else if($mp[0]->unidade_id == 3) {
				$email5 = 'alexandre.siqueira@hcpgestao.org.br';
				$email6 = 'dp@upaebelojardim.org.br'; 
			} else if($mp[0]->unidade_id == 4) {
				$email5 = 'angela.hermida@hcpgestao.org.br';
				$email6 = 'mayara.silva@hcpgestao.org.br';
			} else if($mp[0]->unidade_id == 5) {
				$email5 = 'joao.alves@hcpgestao.org.br';
				$email6 = 'tatiana.silva@hcpgestao.org.br';
			} else if($mp[0]->unidade_id == 6) {
				$email5 = 'laura.lopes@hcpgestao.org.br';
				$email6 = 'antonio.edison@upaecaruaru.org.br';
			} else if($mp[0]->unidade_id == 7) {
				$email5 = 'ana.soares@hcpgestao.org.br';
				$email6 = 'dh@hss.org.br';
			} else if($mp[0]->unidade_id == 8) {
				$email5 = 'fabio.souza@hcpgesao.org.br';
				$email6 = 'rayonara.bento@hcpgestao.org.br';
			}
			$motivo   = $input['motivo'];
			$numeroMP = $mp[0]->numeroMP;
			if(Auth::user()->funcao == "Superintendencia"){
				/*Mail::send([], [], function($m) use ($email,$email2,$email3,$email4,$motivo,$numeroMP) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('MP - '.$numeroMP.' Tipo: '.$tipo.' foi Assinada e está Concluída!!');
					$m->setBody($motivo .'! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
					$m->cc($email2); $m->cc($email3); $m->cc($email4);
					$m->cc($email5); $m->cc($email6); $m->cc($email7);
				});*/
			} else {
				/*Mail::send([], [], function($m) use ($email,$motivo,$numeroMP) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('MP - '.$numeroMP.' Autorizada!');
					$m->setBody($motivo .'! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
				});*/
			}
			$a = 0;
			return view('home', compact('unidade','idG','idMP','a'));
		}
	}
	
	public function storeNAutMP($id, Request $request)
	{
		$input = $request->all();
		$mp    = MP::where('id', $id)->get();
		$idMP  = $mp[0]->id;
		$idU   = $mp[0]->unidade_id;
		$unidade = Unidade::where('id',$idU)->get();
		$input['unidade_id'] = $unidade[0]->id;
		$idG   = $input['gestor_anterior'];
		$validator = Validator::make($request->all(), [
			'motivo' => 'required|max:1000'
		]);
		if ($validator->fails()) {
			return view('home_autorizado', compact('unidade','mp','gestores'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			if(!empty($input['voltarMP'])){
				$check = $input['voltarMP'];
				DB::statement('UPDATE mp SET concluida = 0 WHERE id = '.$id.';');
				DB::statement('UPDATE mp SET aprovada = 0 WHERE id = '.$id.';');
				DB::statement('UPDATE aprovacao SET ativo = 0 WHERE mp_id = '.$id.';');
				DB::statement('UPDATE mp SET gestor_id = '.$idG.' WHERE id = '.$id.';');
				$input['mp_id'] 		  = $idMP;
				$input['resposta'] 		  = 1;
				$input['data_aprovacao']  = date('Y-m-d',(strtotime('now')));
				$input['gestor_anterior'] = Auth::user()->id;
				$input['ativo']           = 1;
				$aprovacao = Aprovacao::create($input);
				$idGA     = $input['gestor_id'];
				$gestor   = Gestor::where('id', $idGA)->get();
				$idG      = Auth::user()->id;
				if($idG == 41){
				    if($idU == 7) {
				        $idG = 41;
				        DB::statement('UPDATE mp SET gestor_id = '.$idG.' WHERE id = '.$id.';');
				    } else {
				        $idG = 50;
				        DB::statement('UPDATE mp SET gestor_id = '.$idG.' WHERE id = '.$id.';');
				    }
				}
				$gestorA  = Gestor::where('id', $idG)->get();
				$nome     = $gestorA[0]->nome;
				$email    = $gestor[0]->email;
				$motivo   = $input['motivo'];
				$numeroMP = $mp[0]->numeroMP;
				/*Mail::send([], [], function($m) use ($email,$motivo,$numeroMP,$nome) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('O Gestor: '.$nome.' solicitou uma mudança na sua MP - '.$numeroMP.'!!!');
					$m->setBody($motivo .'! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
				});*/
			} else {
				$input['resposta'] = 3;
				DB::statement('UPDATE mp SET concluida = 1 WHERE id = '.$id.';');
				DB::statement('UPDATE mp SET aprovada = 0 WHERE id = '.$id.';');
				$input['data_aprovacao'] = date('Y-m-d',(strtotime('now')));
				DB::statement('UPDATE aprovacao SET ativo = 0 WHERE mp_id = '.$id.';');
				DB::statement('UPDATE mp SET gestor_id = '.$idG.' WHERE id = '.$id.';');
				$input['gestor_id'] = $input['gestor_anterior'];
				$input['gestor_anterior'] = Auth::user()->id;
				$aprovacao = Aprovacao::create($input);
				$gestor = Gestor::where('id', $idG)->get();
				$email = $gestor[0]->email;
				$motivo = $input['motivo'];
				$numeroMP = $mp[0]->numeroMP;
				/*Mail::send([], [], function($m) use ($email,$motivo,$numeroMP) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('Sua MP - '.$numeroMP. 'Não foi Autorizada! Acesse: http:/www.hcpgestao-mprh.hcpgestao.org.br');
					$m->setBody($motivo);
					$m->to($email);
				});*/
			}
			$a = 0;
			return view('home', compact('unidade', 'idG', 'idMP','a'));
		}
	}
	
	public function n_autorizarMP($id)
	{
		$mp  = MP::where('id',$id)->get();
		$idU = $mp[0]->unidade_id;
		$unidade   = Unidade::where('id',$idU)->get();
		$aprovacao = Aprovacao::where('mp_id', $id)->where('ativo',1)->get();
		$qtdAp 	   = sizeof($aprovacao);
 		$idG 	   = $mp[0]->solicitante;
		$gestores  = Gestor::where('nome',$idG)->get();
		return view('home_nao_autorizado', compact('unidade','mp','gestores'));
	}

	public function minhasMPS(Request $request)
	{
		$users 	   = Auth::user()->id;
		$unidades  = Unidade::all();
		$gestores  = Gestor::all();
		$nome      = Auth::user()->name;
		$input 	   = $request->all();
		$admissao  = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
		->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
		->where('mp.solicitante',$nome)
		->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
		->orderby('mp.unidade_id')->get();
		$qtdAdm = sizeof($admissao);
		$demissao  = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
		->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
		->where('mp.solicitante',$nome)
		->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
		->orderby('mp.unidade_id')->get();
		$qtdDem = sizeof($demissao);
		$alteracao  = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
		->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
		->where('mp.solicitante',$nome)
		->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
		->orderby('mp.unidade_id')->get();
		$qtdAlt = sizeof($alteracao); 
		if($qtdDem > 0 || $qtdAdm > 0 || $qtdAlt > 0) { 
			return view('minhasMPs', compact('unidades','admissao','qtdAdm','demissao','qtdDem','alteracao','qtdAlt'));
		} else {
			$validator = 'Você nunca fez nenhuma MP!';
			return view('minhasMPs', compact('unidades','mps'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} 
	}

	public function pesquisaHistMPs(Request $request)
	{
		$input = $request->all();
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$pesq  = $input['pesq']; 
		$pesq2 = $input['pesq2'];
		$admissao = NULL; $demissao = NULL; $alteracao = NULL;
		$qtdAdm = 0; $qtdDem = 0; $qtdAlt = 0;
		$unidades = Unidade::all();
		$nome     = Auth::user()->name; $a = 0;
		if($pesq2 == "numeroMP"){
			$mp = MP::where('numeroMP','like','%'.$pesq.'%')->get();
			$a  = 1;
		} elseif($pesq2 == "nome"){
			$mp = MP::where('nome','like','%'.$pesq.'%')->get();
			$a  = 1;
		} elseif($pesq2 == "admissao"){
			$admissao  = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
			->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->where('mp.solicitante',$nome)
			->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->orderby('mp.unidade_id')->get();
			$qtdAdm = sizeof($admissao);
		} elseif($pesq2 == "demissao"){
			$demissao  = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
			->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->where('mp.solicitante',$nome)
			->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->orderby('mp.unidade_id')->get();
			$qtdDem = sizeof($demissao);
		} elseif($pesq2 == "alteracao"){
			$alteracao  = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
			->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->where('mp.solicitante',$nome)
			->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->orderby('mp.unidade_id')->get();
			$qtdAlt = sizeof($alteracao);
		} elseif($pesq2 == "status") {
			$status = $input['status'];
			if($status == 0){
				$concluida = 0;
				$aprovada  = 0;
			} else if($status == 1){
				$concluida = 1;
				$aprovada  = 1;
			} else if($status == 2){
				$concluida = 1;
				$aprovada  = 0;
			}
			$mp = MP::where('concluida',$concluida)->where('aprovada',$aprovada)
					->where('solicitante',$nome)->get();
			$qtd = sizeof($mp); 
			if($qtd > 0){
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mp[$a]->id;
				}	
			} else {
				$ids[] = 0;
			}
			$a  = 2;
		} else {
			$a = 3;
		}

		if($a == 1){
			$admissao  = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
			->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->where('mp.solicitante',$nome)->where('mp.id',$mp[0]->id)
			->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->orderby('mp.unidade_id')->get();
			$qtdAdm = sizeof($admissao);
			$demissao  = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
			->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->where('mp.solicitante',$nome)->where('mp.id',$mp[0]->id)
			->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->orderby('mp.unidade_id')->get();
			$qtdDem = sizeof($demissao);
			$alteracao  = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
			->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->where('mp.solicitante',$nome)->where('mp.id',$mp[0]->id)
			->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->orderby('mp.unidade_id')->get();
			$qtdAlt = sizeof($alteracao);
		} else if($a == 2){
			$admissao  = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
			->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->where('mp.solicitante',$nome)->whereIn('mp.id',$ids)
			->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->orderby('mp.unidade_id')->get();
			$qtdAdm = sizeof($admissao);
			$demissao  = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
			->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->where('mp.solicitante',$nome)->whereIn('mp.id',$ids)
			->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->orderby('mp.unidade_id')->get();
			$qtdDem = sizeof($demissao);
			$alteracao  = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
			->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->where('mp.solicitante',$nome)->whereIn('mp.id',$ids)
			->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->orderby('mp.unidade_id')->get();
			$qtdAlt = sizeof($alteracao);
		} else if($a == 3){
			$admissao  = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
			->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->where('mp.solicitante',$nome)
			->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->orderby('mp.unidade_id')->get();
			$qtdAdm = sizeof($admissao);
			$demissao  = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
			->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->where('mp.solicitante',$nome)
			->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->orderby('mp.unidade_id')->get();
			$qtdDem = sizeof($demissao);
			$alteracao  = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
			->select('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->where('mp.solicitante',$nome)
			->groupby('mp.id','mp.nome','mp.data_emissao','mp.data_prevista','mp.numeroMP','mp.concluida','mp.aprovada','mp.unidade_id')
			->orderby('mp.unidade_id')->get();
			$qtdAlt = sizeof($alteracao); 			
		}

		return view('minhasMPs', compact('unidades','admissao','qtdAdm','demissao','qtdDem','alteracao','qtdAlt'));
	}
}