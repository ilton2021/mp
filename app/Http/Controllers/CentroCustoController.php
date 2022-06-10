<?php

namespace App\Http\Controllers;

use App\Model\CentroCusto;
use App\Model\Unidade;
use App\Model\Loggers;
use Illuminate\Http\Request;
use Validator;
use DB;

class CentroCustoController extends Controller
{
    public function cadastroCentrocusto()
	{
        $centrocustos = CentroCusto::paginate(8);
		return view('centrocusto/centrocusto_cadastro', compact('centrocustos'));
	}
	
	public function centrocustoNovo()
	{
		$unidades = Unidade::all();
		return view('centrocusto/centrocusto_novo', compact('unidades'));
	}

	public function pesquisarCentroCusto(Request $request)
	{
		$input = $request->all();
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$pesq2 = $input['pesq2'];
		$pesq  = $input['pesq'];
		if($pesq2 == 1) {
			$centrocustos = DB::table('centro_custo')->where('centro_custo.nome','like','%'.$pesq.'%')->paginate(8);
		} 
		return view('centrocusto/centrocusto_cadastro', compact('centrocustos','pesq2','pesq'))
					->withInput(session()->flashInput($request->input()));
	}
	
	public function storeCentrocusto(Request $request){
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'nome'  => 'required|max:255',
		]);
		if ($validator->fails()) {
			return view('centrocusto/centrocusto_novo')
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$Und = isset($input['unidade']);
			if ($Und == true) {
				$unidades = implode(',', $input['unidade']);
			} else {
				$unidades = "";
			}
			$input['unidade'] = $unidades;
			$centrocustos = CentroCusto::create($input);
			$loggers = Loggers::create($input);
			$centrocustos = CentroCusto::paginate(6);
			$validator = 'Cargo Cadastrado com Sucesso!';
			return redirect()->route('cadastroCentrocusto')->withErrors($validator)->with('centrocustos');
		}
	}
	
	public function centrocustoAlterar($id)
	{
		$centrocustos = CentroCusto::where('id',$id)->get();
		$und_atuais = explode(',', $centrocustos[0]->unidade);
		$unidade = Unidade::all();
		return view('centrocusto/centrocusto_alterar', compact('centrocustos','unidade','und_atuais'));
	}
	
	public function updateCentrocusto(Request $request, $id) {   
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'nome'  => 'required|max:255',
		]);
		if ($validator->fails()) {
			return view('centrocusto/centrocusto_novo', compact('centrocustos'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$Und = isset($input['unidade']);
			if ($Und == true) {
				$unidades = implode(',', $input['unidade']);
			} else {
				$unidades = "";
			}
			$input['unidade'] = $unidades;
			$centrocustos = CentroCusto::find($id);
			$centrocustos->update($input);
			$loggers = Loggers::create($input);
			$centrocustos = CentroCusto::paginate(6);
			$validator = 'Cargo Alterado com Sucesso!';
			return redirect()->route('cadastroCentrocusto')->withErrors($validator)->with('centrocustos');
		}
	}
	
	public function centrocustoExcluir($id)
	{
		$centrocustos = CentroCusto::where('id',$id)->get();
		return view('centrocusto/centrocusto_excluir', compact('centrocustos'));
	}
	
	public function destroyCentrocusto(Request $request, $id){
		CentroCusto::find($id)->delete();
		$input = $request->all();
		$loggers = Loggers::create($input);
		$centrocustos = CentroCusto::paginate(6);
        $validator = 'Cargo excluído com sucesso!';
		return redirect()->route('cadastroCentrocusto')->withErrors($validator)->with('centrocustos');
	}
}