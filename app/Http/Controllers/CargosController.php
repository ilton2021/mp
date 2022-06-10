<?php

namespace App\Http\Controllers;

use App\Model\Cargos;
use App\Model\Loggers;
use Validator;
use Illuminate\Http\Request;
use DB;

class CargosController extends Controller
{
    public function cadastroCargo()
	{
        $cargos = Cargos::paginate(5);
		return view('cargos/cargos_cadastro', compact('cargos'));
	}
	
	public function cargoNovo()
	{
		return view('cargos/cargos_novo');
	}

	public function pesquisarCargo(Request $request)
	{
		$input = $request->all();
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$pesq2 = $input['pesq2'];
		$pesq  = $input['pesq'];
		
		if($pesq2 == 1) {
			$cargos = DB::table('cargos')->where('cargos.nome','like','%'.$pesq.'%')->paginate(6);
		} 
		return view('cargos/cargos_cadastro', compact('cargos','pesq','pesq2'));
	}
	
	public function storeCargo(Request $request){
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'nome'  => 'required|max:255',
		]);
		if ($validator->fails()) {
			return view('cargos/cargos_novo')
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$cargo   = Cargos::create($input);
			$loggers = Loggers::create($input);
			$cargos  = Cargos::paginate(4);
			$validator = 'Cargo Cadastrado com Sucesso!';
			return redirect()->route('cadastroCargo')->withErrors($validator)->with('cargos');
		}
	}
	
	public function cargoAlterar($id)
	{
		$cargos = Cargos::where('id',$id)->get();
		return view('cargos/cargos_alterar', compact('cargos'));
	}	
	
	public function updateCargo(Request $request, $id) {   
		$input = $request->all(); 
		$validator = Validator::make($request->all(), [
			'nome'  => 'required|max:255'
		]);
		if ($validator->fails()) {
			return view('cargos/cargos_novo')
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		} else {
			$cargos = Cargos::find($id); 
			$cargos->update($input);
			$loggers = Loggers::create($input);
			$cargos  = Cargos::paginate(4);
			$validator = 'Cargo Alterado com Sucesso!';
			return redirect()->route('cadastroCargo')->withErrors($validator)->with('cargos');
		}
	}
	
	public function cargoExcluir($id)
	{
		$cargos = Cargos::where('id',$id)->get();
		return view('cargos/cargos_excluir', compact('cargos'));
	}
	
	public function destroyCargo(Request $request, $id){
		Cargos::find($id)->delete();
		$input   = $request->all();
		$loggers = Loggers::create($input);
		$cargos  = Cargos::paginate(4);
        $validator = 'Cargo excluído com sucesso!';
		return redirect()->route('cadastroCargo')->withErrors($validator)->with('cargos');
	}
}