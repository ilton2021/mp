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
        return view('welcome_', compact('unidades','gestor'));
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
		$und 	   = explode(" ",$und);
		$funcao    = Auth::user()->funcao; 
		if($funcao == "Administrador" || $funcao == "Gestor Imediato"){
			$mps = MP::where('solicitante',Auth::user()->name)->where('concluida',0)->get();
		} else {
			$mps = DB::table('mp')->whereIN('unidade_id', $und)
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
		$und 	   = explode(" ",$und);
		$funcao    = Auth::user()->funcao; 
		$nome      = Auth::user()->name;
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
	
	public function reprovadasMPs()
	{
		$unidades  = Unidade::all();
		$und 	   = Auth::user()->unidade; 
		$und 	   = explode(" ",$und);
		$funcao    = Auth::user()->funcao; 
		$nome      = Auth::user()->name;
		if($funcao == "Gestor" || $funcao == "Gestor Imediato"){
			$mps = MP::where('solicitante',$nome)->orderBy('unidade_id', 'ASC')->where('concluida',1)
					 ->where('aprovada',0)->get();
		} else {
			$mps = DB::table('mp')->whereIN('unidade_id', $und)->where('aprovada',0)
			->where('concluida',1)->orderby('mp.unidade_id', 'ASC')->paginate(20);
		} 		
		$aprovacao = Aprovacao::all();
		$gestores  = Gestor::all();
		return view('reprovadasMPs', compact('unidades','mps','aprovacao','gestores'));
	}
	
	public function pesquisaMPs(Request $request)
	{
		$unidades   = Unidade::all();
		$mps 	    = MP::all();
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
		$und 	   = explode(" ",$und);
		$funcao    = Auth::user()->funcao; 
		$nome      = Auth::user()->name;
		if($pesq2 == "numero") {
			if($unidade_id == "0") {
				if($funcao == "Administrador" || $funcao == "Gestor Imediato"){
					$mps = MP::where('solicitante',$nome)->where('mp.numeroMP','like','%'.$pesq.'%')
					->orderBy('unidade_id', 'ASC')->where('concluida',0)->get();
				} else {
					$mps = DB::table('mp')->where('mp.numeroMP','like','%'.$pesq.'%')
					->whereIN('unidade_id', $und)->where('concluida',0)
					->orderby('mp.unidade_id', 'ASC')->paginate(20);
				}
			} else {
				$mps = DB::table('mp')->where('mp.numeroMP', 'like', '%' . $pesq . '%')
				 ->whereIN('unidade_id', $und)->where('concluida',0)
			     ->orderby('mp.unidade_id', 'ASC')->paginate(20);
			}
		} else if($pesq2 == "solicitante") {
			$mps = DB::table('mp')->where('mp.solicitante', 'like', '%' . $pesq . '%')
				->where('concluida', 0)->get();
		} else if($pesq2 == "funcionario"){
			$mps = DB::table('mp')->where('mp.nome', 'like', '%' . $pesq . '%')
				->where('concluida', 0)->get();
		} else if($pesq2 == "rpa") {
			$adms = DB::table('admissao')->where('tipo','rpa')->get();  
			$qtd  = sizeof($adms); 
			for($a = 0; $a < $qtd; $a++){
				$ids[] = $adms[$a]->mp_id;
			} 
			if($unidade_id == "0" && $pesq == ""){
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->get();
			} else if($unidade_id == "0" && $pesq != ""){
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('numeroMP',$pesq)->get();
			} else if($unidade_id != "0" && $pesq == ""){
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('unidade_id',$unidade_id)->get();
			} else {
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('numeroMP',$pesq)
				->where('unidade_id',$unidade_id)->get();
			}
		} else if($pesq2 == "admissao") {
			$admissao = Admissao::all();
			$qtd = sizeof($admissao); 
			for($a = 0; $a < $qtd; $a++){ 
				$ids[] = $admissao[$a]->mp_id;
			} 
			if($unidade_id == "0" && $pesq == ""){
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->get(); 
			} else if($unidade_id == "0" && $pesq != ""){
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('numeroMP',$pesq)->get();
			} else if($unidade_id != "0" && $pesq == ""){
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('unidade_id',$unidade_id)->get();
			} else {
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('numeroMP',$pesq)
				->where('unidade_id',$unidade_id)->get();
			}
		} else if($pesq2 == "demissao") {
			$demissao = Demissao::all();
			$qtd = sizeof($demissao); 
			for($a = 0; $a < $qtd; $a++){
				$ids[] = $demissao[$a]->mp_id;
			} 
			if($unidade_id == "0" && $pesq == ""){
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->get(); 
			} else if($unidade_id == "0" && $pesq != ""){
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('numeroMP',$pesq)->get();
			} else if($unidade_id != "0" && $pesq == ""){
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('unidade_id',$unidade_id)->get();
			} else {
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('numeroMP',$pesq)
				->where('unidade_id',$unidade_id)->get();
			}
		} else if($pesq2 == "alteracao"){
			$alteracaoF = Alteracao_Funcional::all();
			$qtd = sizeof($alteracaoF); 
			for($a = 0; $a < $qtd; $a++){
				$ids[] = $alteracaoF[$a]->mp_id;
			}  
			if($unidade_id == "0" && $pesq == ""){
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->get(); 
			} else if($unidade_id == "0" && $pesq != ""){
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('numeroMP',$pesq)->get();
			} else if($unidade_id != "0" && $pesq == ""){
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('unidade_id',$unidade_id)->get();
			} else {
				$mps = DB::table('mp')->whereIn('id',$ids)->where('concluida',0)->where('numeroMP',$pesq)
				->where('unidade_id',$unidade_id)->get();
			}
		} else if($unidade_id != "0") {
			$mps = DB::table('mp')->where('mp.unidade_id', $unidade_id)
				->where('concluida', 0)->get();
		} 
		
		return view('criadasMPs', compact('unidades','mps','aprovacao','gestores'));
	}
	
	public function pesquisaMPsAp(Request $request)
	{
		$unidades   = Unidade::all();
		$gestores   = Gestor::all();
		$input 	    = $request->all();
		if(empty($input['unidade_id'])){ $input['unidade_id'] = 0;  }
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$unidade_id = $input['unidade_id'];
		$pesq 	    = $input['pesq'];
		$pesq2      = $input['pesq2'];
		if($pesq2 == "numero") {
			if($unidade_id == "0") {
				$mps = DB::table('mp')->where('mp.numeroMP', 'like', '%' . $pesq . '%')
				->where('aprovada',1)->where('concluida', 1)->get();
			} else {
				$mps = DB::table('mp')->where('mp.numeroMP', 'like', '%' . $pesq . '%')
				->where('unidade_id',$unidade_id)->where('aprovada',1)->where('concluida', 1)->get();
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "solicitante") {
			if($unidade_id == "0"){
				$mps = DB::table('mp')->where('mp.solicitante', 'like', '%' . $pesq . '%')
				->where('concluida', 1)->get();
			} else {
				$mps = DB::table('mp')->where('mp.solicitante', 'like', '%' . $pesq . '%')
				->where('unidade_id',$unidade_id)->where('concluida', 1)->get();
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "funcionario"){
			$mps = DB::table('mp')->where('mp.nome', 'like', '%' . $pesq . '%')
				->where('concluida', 1)->get();
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "rpa") { 
			if($unidade_id != "0" && $pesq == ""){
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.concluida',1)->where('admissao.tipo','rpa')
				->where('mp.unidade_id',$unidade_id)->get(); 
			} else if($unidade_id == "0" && $pesq != "") {
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')->where('admissao.tipo','rpa')
				->where('mp.concluida',1)->get(); 
			} else if ($unidade_id == "0" && $pesq == ""){
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')->where('admissao.tipo','rpa')
				->select('mp.*')->where('mp.concluida',1)->get(); 
			} else {
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')->where('admissao.tipo','rpa')
				->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)->get(); 
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "admissao") {
			if($unidade_id != "0" && $pesq == ""){
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.aprovada',1)->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)->get(); 
			} else if($unidade_id == "0" && $pesq != "") {
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.aprovada',1)->where('mp.numeroMP', 'like', '%' .$pesq. '%')->where('mp.concluida',1)->get(); 
			} else if ($unidade_id == "0" && $pesq == ""){
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.aprovada',1)->where('mp.concluida',1)->get(); 
			} else {
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')
				->where('mp.aprovada',1)->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)->get(); 
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "demissao") {
			if($unidade_id != "0" && $pesq == ""){
				$mps = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.aprovada',1)->where('mp.concluida',1)
				->where('mp.unidade_id',$unidade_id)->get(); 
			} else if($unidade_id == "0" && $pesq != "") {
				$mps = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.aprovada',1)->where('mp.numeroMP', 'like', '%' .$pesq. '%')
				->where('mp.concluida',1)->get(); 
			} else if ($unidade_id == "0" && $pesq == ""){
				$mps = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
				->where('mp.aprovada',1)->select('mp.*')->where('mp.concluida',1)->get(); 
			} else {
				$mps = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')
				->where('mp.aprovada',1)->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)->get(); 
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "alteracao"){
			if($unidade_id != "0" && $pesq == ""){
				$mps = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
				->select('mp.*')->where('mp.concluida',1)->where('mp.aprovada',1)
				->where('mp.unidade_id',$unidade_id)->get(); 
			} else if($unidade_id == "0" && $pesq != "") {
				$mps = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')->where('mp.aprovada',1)
				->where('mp.concluida',1)->get(); 
			} else if ($unidade_id == "0" && $pesq == ""){
				$mps = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
				->where('mp.aprovada',1)->select('mp.*')->where('mp.concluida',1)->get(); 
			} else {
				$mps = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')
				->where('mp.aprovada',1)->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)->get(); 
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "data"){
			$data_i = date('Y-m-d', strtotime($input['data_inicio']));
			$data_f = date('Y-m-d', strtotime($input['data_fim'])); 
			if($unidade_id != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")){
				$data_f = date('Y-m-d', strtotime('now')); 
				$mps = DB::table('mp')
							->join('aprovacao','mp.id','=','aprovacao.mp_id')
							->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
							->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)
							->where('aprovacao.resposta',3)
							->select('mp.*')->orderBy('mp.id')->get();
			}else if($unidade_id != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")){
				$mps = DB::table('mp')
							->join('aprovacao','mp.id','=','aprovacao.mp_id')
							->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
							->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)
							->where('aprovacao.resposta',3)
							->select('mp.*')->orderBy('mp.id')->get();  
			}else if($unidade_id == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")){
				$mps = DB::table('mp')
							->join('aprovacao','mp.id','=','aprovacao.mp_id')
							->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
							->where('mp.concluida',1)
							->where('aprovacao.resposta',3)
							->select('mp.*')->orderBy('mp.id')->get();
			}else if($unidade_id == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")){
				$data_f = date('Y-m-d', strtotime('now')); 
				$mps = DB::table('mp')
							->join('aprovacao','mp.id','=','aprovacao.mp_id')
							->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
							->where('mp.concluida',1)
							->where('aprovacao.resposta',3)
							->select('mp.*')->orderBy('mp.id')->get();
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($unidade_id != "0") {
			$mps = DB::table('mp')->where('mp.unidade_id', $unidade_id)
				->where('concluida', 1)->get();
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}	
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if(($unidade_id == "0" && $pesq2 == "") && ($pesq == "" || $pesq != "")){
			$mps = MP::where('aprovada',1)->where('concluida',1)->paginate(10);
			$aprovacao = Aprovacao::all();
		}
		return view('aprovadasMPs', compact('unidades','mps','aprovacao','gestores'));
	}
	
	public function pesquisaMPsRe(Request $request)
	{
		$unidades   = Unidade::all();
		$gestores   = Gestor::all();
		$input 	    = $request->all();
		if(empty($input['unidade_id'])){ $input['unidade_id'] = 0;  }
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$unidade_id = $input['unidade_id'];
		$pesq 	    = $input['pesq'];
		$pesq2      = $input['pesq2'];
		if($pesq2 == "numero") {
			if($unidade_id == "0") {
				$mps = DB::table('mp')->where('mp.numeroMP', 'like', '%' . $pesq . '%')
				->where('concluida', 1)->get();
			} else {
				$mps = DB::table('mp')->where('mp.numeroMP', 'like', '%' . $pesq . '%')
				->where('unidade_id',$unidade_id)->where('concluida', 1)->get();
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}	
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "solicitante") {
			if($unidade_id == "0"){
				$mps = DB::table('mp')->where('mp.solicitante', 'like', '%' . $pesq . '%')
				->where('concluida', 1)->get();
			} else {
				$mps = DB::table('mp')->where('mp.solicitante', 'like', '%' . $pesq . '%')
				->where('unidade_id',$unidade_id)->where('concluida', 1)->get();
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}	
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "funcionario"){
			$mps = DB::table('mp')->where('mp.nome', 'like', '%' . $pesq . '%')
				->where('concluida', 1)->get();
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}	
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "rpa") { 
			if($unidade_id != "0" && $pesq == ""){
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.concluida',1)->where('admissao.tipo','rpa')
				->where('mp.unidade_id',$unidade_id)->get(); 
			} else if($unidade_id == "0" && $pesq != "") {
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')->where('admissao.tipo','rpa')
				->where('mp.concluida',1)->get(); 
			} else if ($unidade_id == "0" && $pesq == ""){
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')->where('admissao.tipo','rpa')
				->select('mp.*')->where('mp.concluida',1)->get(); 
			} else {
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')->where('admissao.tipo','rpa')
				->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)->get(); 
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}	
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "admissao") {
			if($unidade_id != "0" && $pesq == ""){
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)->get(); 
			} else if($unidade_id == "0" && $pesq != "") {
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')->where('mp.concluida',1)->get(); 
			} else if ($unidade_id == "0" && $pesq == ""){
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.concluida',1)->get(); 
			} else {
				$mps = DB::table('mp')->join('admissao','admissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')
				->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)->get(); 
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}	
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "demissao") {
			if($unidade_id != "0" && $pesq == ""){
				$mps = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)->get(); 
			} else if($unidade_id == "0" && $pesq != "") {
				$mps = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')->where('mp.concluida',1)->get(); 
			} else if ($unidade_id == "0" && $pesq == ""){
				$mps = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.concluida',1)->get(); 
			} else {
				$mps = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')
				->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)->get(); 
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}	
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "alteracao"){
			if($unidade_id != "0" && $pesq == ""){
				$mps = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
				->select('mp.*')->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)->get(); 
			} else if($unidade_id == "0" && $pesq != "") {
				$mps = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')->where('mp.concluida',1)->get(); 
			} else if ($unidade_id == "0" && $pesq == ""){
				$mps = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
				->select('mp.*')->where('mp.concluida',1)->get(); 
			} else {
				$mps = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
				->select('mp.*')->where('mp.numeroMP', 'like', '%' .$pesq. '%')
				->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)->get(); 
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}	
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($pesq2 == "data"){
			$data_i = date('Y-m-d', strtotime($input['data_inicio']));
			$data_f = date('Y-m-d', strtotime($input['data_fim'])); 
			if($unidade_id != "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")){
				$data_f = date('Y-m-d', strtotime('now')); 
				$mps = DB::table('mp')
							->join('aprovacao','mp.id','=','aprovacao.mp_id')
							->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
							->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)
							->where('aprovacao.resposta',3)
							->select('mp.*')->orderBy('mp.id')->get();
			}else if($unidade_id != "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")){
				$mps = DB::table('mp')
							->join('aprovacao','mp.id','=','aprovacao.mp_id')
							->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
							->where('mp.concluida',1)->where('mp.unidade_id',$unidade_id)
							->where('aprovacao.resposta',3)
							->select('mp.*')->orderBy('mp.id')->get();  
			}else if($unidade_id == "0" && ($data_i != "1970-01-01" && $data_f != "1970-01-01")){
				$mps = DB::table('mp')
							->join('aprovacao','mp.id','=','aprovacao.mp_id')
							->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
							->where('mp.concluida',1)
							->where('aprovacao.resposta',3)
							->select('mp.*')->orderBy('mp.id')->get();
			}else if($unidade_id == "0" && ($data_i != "1970-01-01" && $data_f == "1970-01-01")){
				$data_f = date('Y-m-d', strtotime('now')); 
				$mps = DB::table('mp')
							->join('aprovacao','mp.id','=','aprovacao.mp_id')
							->whereBetween('aprovacao.data_aprovacao',[$data_i,$data_f])
							->where('mp.concluida',1)
							->where('aprovacao.resposta',3)
							->select('mp.*')->orderBy('mp.id')->get();
			}
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}	
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if($unidade_id != "0") {
			$mps = DB::table('mp')->where('mp.unidade_id', $unidade_id)
				->where('concluida', 1)->get();
			$qtd  = sizeof($mps); 
			if($qtd > 0) {
				for($a = 0; $a < $qtd; $a++){
					$ids[] = $mps[$a]->id;
				}
			} else {
				$ids[] = 0;
			}	
			$aprovacao = Aprovacao::whereIn('mp_id',$ids)->get();
		} else if(($unidade_id == "0" && $pesq2 == "") && ($pesq == "" || $pesq != "")){
			$mps = MP::where('aprovada',0)->where('concluida',1)->paginate(10);
			$aprovacao = Aprovacao::all();
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
		$demissao  = DB::table('mp')->join('demissao','demissao.mp_id','=','mp.id')
		->join('justificativa','justificativa.mp_id','=','mp.id')
		->select('mp.*','justificativa.descricao as just','demissao.*')
		->where('mp.concluida',0)->where('mp.gestor_id',$idG)->get();
		$alteracF  = DB::table('mp')->join('alteracao_funcional','alteracao_funcional.mp_id','=','mp.id')
		->join('justificativa','justificativa.mp_id','=','mp.id')
		->select('mp.*','justificativa.descricao as just','alteracao_funcional.*')
		->where('mp.concluida',0)->where('mp.gestor_id',$idG)->get(); 
		$aprovacao = Aprovacao::all();
		$text 	   = false;
		$gestores  = Gestor::all();
		return view('validar', compact('text','mps','aprovacao','gestores','admissao','demissao','alteracF'));
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
		$data_diretoria 		= null;
		$data_superintendencia  = null;
		$solicitante = $mps[0]->solicitante;
		$gestorData   = ""; $gestorDataId = "";
		$rh           = ""; $rhId    	  = "";
		$diretoriaT   = ""; $diretoriaTId = "";
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
				if($aprovacao[$i]->gestor_anterior == 65 || $aprovacao[$i]->gestor_anterior == 163){
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
				if($aprovacao[$i]->gestor_anterior == 59 || $aprovacao[$i]->gestor_anterior == 60 || $aprovacao[$i]->gestor_anterior == 61 
				|| $aprovacao[$i]->gestor_anterior == 155 || $aprovacao[$i]->gestor_anterior == 160 || $aprovacao[$i]->gestor_anterior == 165
				|| $aprovacao[$i]->gestor_anterior == 166){
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
		$text = false; 
		$justNA = JustificativaN_Autorizada::where('mp_id',$id)->get();
		if($qtdAdm > 0){
			return view('index_', compact('mps','gestores','unidades','unidade','admissao','alteracaoF','demissao','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria','data_superintendencia','aprovacao','text','justNA','solicitante','gestorData','rh','diretoriaT','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaId','superId','gestor'));
		} else if($qtdDem > 0) {
			return view('index_', compact('mps','gestores','unidades','unidade','admissao','alteracaoF','demissao','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria','data_superintendencia','aprovacao','text','justNA','solicitante','gestorData','rh','diretoriaT','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaId','superId','gestor'));
		} else if($qtdAlt > 0) {
			return view('index_', compact('mps','gestores','unidades','unidade','admissao','alteracaoF','demissao','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria','data_superintendencia','aprovacao','text','justNA','solicitante','gestorData','rh','diretoriaT','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaId','superId','gestor'));
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
		$data_diretoria 		= null;
		$data_superintendencia  = null;
		$solicitante = $mps[0]->solicitante;
		$gestorData   = ""; $gestorDataId = "";
		$rh           = ""; $rhId    	  = "";
		$diretoriaT   = ""; $diretoriaTId = "";
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
				if($aprovacao[$i]->gestor_anterior == 65 || $aprovacao[$i]->gestor_anterior == 163){
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
				if($aprovacao[$i]->gestor_anterior == 65 || $aprovacao[$i]->gestor_anterior == 163){
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
				if($aprovacao[$i]->gestor_anterior == 59  || $aprovacao[$i]->gestor_anterior == 60  || $aprovacao[$i]->gestor_anterior == 61 
				|| $aprovacao[$i]->gestor_anterior == 155 || $aprovacao[$i]->gestor_anterior == 160 || $aprovacao[$i]->gestor_anterior == 165
				|| $aprovacao[$i]->gestor_anterior == 166){
					$gestorD = $aprovacao[$i]->gestor_anterior;
				}
				if($gestorD != ""){
    				$diretoria = Gestor::where('id', $gestorD)->get('nome'); 
					$diretoriaId = Gestor::where('id', $gestorD)->get('id'); 
				}
			} else if ($aprovacao[$i]->resposta == 3 && $funcao == "Diretoria") {
				$data_diretoria = $aprovacao[$i]->data_aprovacao; 
				if($aprovacao[$i]->gestor_anterior == 59 || $aprovacao[$i]->gestor_anterior == 60 || $aprovacao[$i]->gestor_anterior == 61 
				|| $aprovacao[$i]->gestor_anterior == 155 || $aprovacao[$i]->gestor_anterior == 160){
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
			return view('visualizar', compact('mps','gestores','unidades','unidade','admissao','demissao','alteracaoF','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria','data_superintendencia','aprovacao','solicitante','gestorData','rh','diretoriaT','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaId','superId','gestor'));
		} else if($qtdDem > 0) {
			return view('visualizar', compact('mps','gestores','unidades','unidade','demissao','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria','data_superintendencia','aprovacao','solicitante','gestorData','rh','diretoriaT','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaId','superId','gestor'));
		} else if($qtdAlt > 0) {
		    return view('visualizar', compact('mps','gestores','unidades','unidade','alteracaoF','justificativa','data_aprovacao','data_gestor_imediato','data_rec_humanos','data_diretoria_tecnica','data_diretoria','data_superintendencia','aprovacao','solicitante','gestorData','rh','diretoriaT','diretoria','super','gestorDataId','rhId','diretoriaTId','diretoriaId','superId','gestor'));
		}
	}
	
	public function validarMPs(Request $request)
	{
		$input = $request->all();
		$mps   = MP::all();
		$idG   = Auth::user()->id;
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
		$aprovacao = Aprovacao::all();
		$text 	   = true;
		$gestores  = Gestor::all();
		if($ap == 0){
			$idG = Auth::user()->id;
			$text = 'nao';
			\Session::flash('mensagem', ['msg' => 'Selecione uma MP!','class'=>'green white-text']);
			return view('validar', compact('text','mps','aprovacao','gestores','admissao','demissao','alteracF'));
		} else {
			$idG = Auth::user()->id;
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
			$text = 'sim';
			\Session::flash('mensagem', ['msg' => 'Aprovação Realizada com Sucesso!','class'=>'green white-text']);
			return view('validar', compact('text','mps','aprovacao','gestores','admissao','demissao','alteracF'));
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
						if($idA == 30) {
							$idG = 62;
						} else {
							$idG = 30;
						}
					} else if($idG == 65) {
						if($idA == 30) {
							$idG = 59;
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
			$email3 = '';
			$email4 = '';
			$motivo   = $input['motivo'];
			$numeroMP = $mp[0]->numeroMP;
			/*if(Auth::user()->funcao == "Superintendencia"){
				Mail::send([], [], function($m) use ($email,$email2,$email3,$email4,$motivo,$numeroMP) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('MP - '.$numeroMP.' foi Assinada e está Concluída!!');
					$m->setBody($motivo .'! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
					$m->cc($email2);
					$m->cc($email3);
					$m->cc($email4);
				});
			} else {
				Mail::send([], [], function($m) use ($email,$motivo,$numeroMP) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('MP - '.$numeroMP.' Autorizada!');
					$m->setBody($motivo .'! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
				});
			}*/
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
		$text 			= false;
		return view('home_autorizado', compact('unidade','mp','gestores','text','admissao','alteracaoF','gestorImediato','gestoresUnd','aprovacao'));
	}
	
	public function storeAutMP($id, Request $request)
	{
		$mp = MP::where('id', $id)->get();
		$idU = $mp[0]->unidade_id;
		$idMP = $id;
		$unidade = Unidade::where('id',$idU)->get();
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
			return view('home_autorizado', compact('unidade','mp','gestores','text','gestoresUnd'));
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
			$motivo   = $input['motivo'];
			$numeroMP = $mp[0]->numeroMP;
			if(Auth::user()->funcao == "Superintendencia"){
				Mail::send([], [], function($m) use ($email,$email2,$email3,$email4,$motivo,$numeroMP) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('MP - '.$numeroMP.' foi Assinada e está Concluída!!');
					$m->setBody($motivo .'! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
					$m->cc($email2);
					$m->cc($email3);
					$m->cc($email4);
				});
			} else {
				Mail::send([], [], function($m) use ($email,$motivo,$numeroMP) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('MP - '.$numeroMP.' Autorizada!');
					$m->setBody($motivo .'! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
				});
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
			return view('home_autorizado', compact('unidade','mp','gestores','text'));
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
				Mail::send([], [], function($m) use ($email,$motivo,$numeroMP,$nome) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('O Gestor: '.$nome.' solicitou uma mudança na sua MP - '.$numeroMP.'!!!');
					$m->setBody($motivo .'! Acesse o portal da MP: www.hcpgestao-mprh.hcpgestao.org.br');
					$m->to($email);
				});
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
				Mail::send([], [], function($m) use ($email,$motivo,$numeroMP) {
					$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
					$m->subject('Sua MP - '.$numeroMP. 'Não foi Autorizada! Acesse: http:/www.hcpgestao-mprh.hcpgestao.org.br');
					$m->setBody($motivo);
					$m->to($email);
				});
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
		$text 	   = false;
		return view('home_nao_autorizado', compact('unidade','mp','gestores','text'));
	}
}