<?php

namespace App\Http\Controllers;

use App\Model\Cargos;
use App\Model\Loggers;
use Validator;
use Illuminate\Http\Request;

class CargosController extends Controller
{
    public function cadastroCargo()
	{
        $cargos = Cargos::All();
		return view('cargos/cargos_cadastro', compact('cargos'));
	}
	
	public function cargoNovo()
	{
		return view('cargos/cargos_novo');
	}
	
	public function storeCargo(Request $request){
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'nome'  => 'required|max:255',
		]);
		if ($validator->fails()) {
					return view('cargos/cargos_novo', compact('text'));
		} else {
			$cargo   = Cargos::create($input);
			$loggers = Loggers::create($input);
			$cargos  = Cargos::all();
			$validator = 'Cargo Cadastrado com Sucesso!';
			return view('cargos/cargos_cadastro', compact('cargos'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
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
			$cargos  = Cargos::all();
			$validator = 'Cargo Alterado com Sucesso!';
			return view('cargos/cargos_cadastro', compact('cargos'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
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
		$cargos  = Cargos::all();
        $validator = 'Cargo excluído com sucesso!';
		return view('cargos.cargos_cadastro', compact('cargos'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
	}
}