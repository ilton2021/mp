<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CargosRPA;
use Validator;
use App\Model\Unidade;
use App\Model\Loggers;
use DB;

class CargosRPAController extends Controller
{
    public function cadastroRPACargo()
	{
		$cargos   = CargosRPA::paginate(6);
		$unidades = Unidade::all();
		return view('cargosRPA/cargosRPA_cadastro', compact('cargos','unidades'));
	}

    public function cargoRPANovo()
	{
		$unidades = Unidade::all();
		return view('cargosRPA/cargosRPA_novo', compact('unidades'));
	}

    public function pesquisarRPACargo(Request $request)
	{
		$input = $request->all();
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$pesq2 = $input['pesq2'];
		$pesq  = $input['pesq'];
		if($pesq2 == 1) {
			$cargos = DB::table('cargos_rpa')->where('cargo','like','%'.$pesq.'%')->paginate(6);
		} 
		return view('cargosRPA/cargosRPA_cadastro', compact('cargos','pesq','pesq2'));
	}

    public function storeRPACargo(Request $request){
		$input = $request->all();
		$unidades  = Unidade::all();
		$validator = Validator::make($request->all(), [
			'cargo'   => 'required|max:255',
            'valor'   => 'required',
			'unidade' => 'required'
		]);
		if ($validator->fails()) {
			return view('cargosRPA/cargosRPA_novo', compact('unidades'))
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
			$cargo   = CargosRPA::create($input);
			$loggers = Loggers::create($input);
			$cargos  = CargosRPA::paginate(5);
			$validator = 'Cargo RPA Cadastrado com Sucesso!';
			return redirect()->route('cadastroRPACargo')->withErrors($validator)->with('cargos');
		}
	}
	
	public function cargoRPAAlterar($id)
	{
		$cargos   = CargosRPA::where('id',$id)->get();
		$und_atuais = explode(',', $cargos[0]->unidade);
		$unidades = Unidade::all();
		return view('cargosRPA/cargosRPA_alterar', compact('cargos','und_atuais','unidades'));
	}	
	
	public function updateRPACargo(Request $request, $id) {   
		$input     = $request->all(); 
		$unidades  = Unidade::all();
		$validator = Validator::make($request->all(), [
			'cargo'   => 'required|max:255',
            'valor'   => 'required',
			'unidade' => 'required'
		]);
		if ($validator->fails()) {
			return view('cargosRPA/cargosRPA_alterar', compact('unidades'))
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
			$cargos = CargosRPA::find($id); 
			$cargos->update($input);
			$loggers = Loggers::create($input);
			$cargos  = CargosRPA::paginate(4);
			$validator = 'Cargo RPA Alterado com Sucesso!';
			return redirect()->route('cadastroRPACargo')->withErrors($validator)->with('cargos');
		}
	}
	
	public function cargoRPAExcluir($id)
	{
		$cargos 	= CargosRPA::where('id',$id)->get();
		$und_atuais = explode(',', $cargos[0]->unidade);
		$unidades   = Unidade::all();
		return view('cargosRPA/cargosRPA_excluir', compact('cargos','und_atuais','unidades'));
	}
	
	public function destroyRPACargo(Request $request, $id){
		CargosRPA::find($id)->delete();
		$input   = $request->all();
		$loggers = Loggers::create($input);
		$cargos  = CargosRPA::paginate(4);
        $validator = 'Cargo RPA excluído com sucesso!';
		return redirect()->route('cadastroRPACargo')->withErrors($validator)->with('cargos');
	}
}