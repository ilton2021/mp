<?php

namespace App\Http\Controllers;

use App\Model\Cargos;
use Illuminate\Http\Request;

class CargosController extends Controller
{
    public function cadastroCargo()
	{
		$text = false;
        $cargos = Cargos::All();
		return view('cargos/cargos_cadastro', compact('text','cargos'));
	}
	
	public function cargoNovo()
	{
		$text = false;
		return view('cargos/cargos_novo', compact('text'));
	}
	
	public function storeCargo(Request $request){
		$input = $request->all();

				$v = \Validator::make($request->all(), [
					'nome'  => 'required|max:255',
				]);
				if ($v->fails()) {
					$failed = $v->failed();
					if ( !empty($failed['nome']['Required']) ) {
						\Session::flash('mensagem', ['msg' => 'O campo cargo é obrigatório!','class'=>'green white-text']);
					} else if ( !empty($failed['nome']['Max']) ) {
						\Session::flash('mensagem', ['msg' => 'O campo cargo possui no máximo 255 caracteres!','class'=>'green white-text']);
                    }
					$text = true;
					return view('cargos/cargos_novo', compact('text'));
				} else {
					$cargo = Cargos::create($input);
					$cargos = Cargos::all();
					$text = true;
					\Session::flash('mensagem', ['msg' => 'Cargo Cadastrado com Sucesso!','class'=>'green white-text']);
					return view('cargos/cargos_cadastro', compact('text','cargos'));
				}
			 
		
	}
	
	public function cargoAlterar($id)
	{
		$cargos = Cargos::where('id',$id)->get();
		$text = false;
		return view('cargos/cargos_alterar', compact('text','cargos'));
	}
	
	public function updateCargo(Request $request, $id) {   
		$input = $request->all(); 
				$v = \Validator::make($request->all(), [
					'nome'  => 'required|max:255',
				]);
				if ($v->fails()) {
					$failed = $v->failed();
					if ( !empty($failed['nome']['Required']) ) {
						\Session::flash('mensagem', ['msg' => 'O campo nome é obrigatório!','class'=>'green white-text']);
					} else if ( !empty($failed['nome']['Max']) ) {
						\Session::flash('mensagem', ['msg' => 'O campo nome possui no máximo 255 caracteres!','class'=>'green white-text']);
					} 
					$text = true;
					return view('cargos/cargos_novo', compact('text'));
				} else {
					$cargos = Cargos::find($id); 
					$cargos ->update($input);
					$cargos = Cargos::all();
					$text = true;
					\Session::flash('mensagem', ['msg' => 'Cargo Alterado com Sucesso!','class'=>'green white-text']);
					return view('cargos/cargos_cadastro', compact('text','cargos'));
				}
			
		
	}
	
	public function cargoExcluir($id)
	{
		$cargos = Cargos::where('id',$id)->get();
		$text = false;
		return view('cargos/cargos_excluir', compact('text','cargos'));
	}
	
	public function destroyCargo(Request $request, $id){
		Cargos::find($id)->delete();
		$input = $request->all();
		$cargos = Cargos::all();
        \Session::flash('mensagem', ['msg' => 'Cargo excluído com sucesso!','class'=>'green white-text']);
		$text = true;
		return view('cargos.cargos_cadastro', compact('cargos','text'));
	}
}
