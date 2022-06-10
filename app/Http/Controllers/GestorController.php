<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Gestor;
use App\Model\Unidade;
use App\Model\Cargos;
use App\Model\Loggers;
use DB;
use Validator;

class GestorController extends Controller
{
    public function cadastroGestor()
	{
		$gestores = DB::table('gestor')->paginate(8);
		$unidades = Unidade::all();
		return view('gestor.gestor_cadastro', compact('gestores','unidades'));
	}
	
	public function pesquisarGestor(Request $request)
	{
		$input = $request->all();
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		$pesq2 = $input['pesq2'];
		$pesq  = $input['pesq'];
		if($pesq2 == 1) {
			$gestores = DB::table('gestor')->where('gestor.nome', 'like', '%' . $pesq . '%')->paginate(8);
		} else if($pesq2 == 2) {
			$gestores = DB::table('gestor')->where('gestor.email', 'like', '%' . $pesq . '%')->paginate(8);
		} 
		$unidades = Unidade::all();
		return view('gestor.gestor_cadastro', compact('unidades','gestores','pesq2','pesq'));
	}
	
	public function gestorNovo()
	{	
		$unidades = Unidade::all();
		$cargos = Cargos::all();
		$gestor_imediat = Gestor::where('gestor_sim','1')->get();
		return view('gestor.gestor_novo', compact('unidades','gestor_imediat','cargos'));
	}
	
	public function storeGestor(Request $request)
	{
		$input = $request->all();
		$unidades = Unidade::all();
		$validator = Validator::make($request->all(), [
			'nome'   => 'required|max:255',
			'email'  => 'required|email|max:255|unique:gestor,email',
			'cpf'    => 'required|max:11',
			'cargo'  => 'required|max:255',
			'funcao' => 'required'
		]);
		if ($validator->fails()) {
			return view('gestor.gestor_novo', compact('unidades'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		}else {
			$gestor    = Gestor::create($input);
			$gestores  = DB::table('gestor')->paginate(6);
			$loggers   = Loggers::create($input);
			$validator = 'Gestor Cadastrado com Sucesso!';
			return redirect()->route('cadastroGestor')->withErrors($validator)->with('gestores');
		}
	}
	
	public function gestorAlterar($id)
	{
		$unidades = unidade::all();
		$cargos   = Cargos::all();
		$gestor   = Gestor::where('id',$id)->get();
		$gestor_imediat = Gestor::where('gestor_sim','1')->get();
		return view('gestor.gestor_alterar', compact('gestor','unidades','cargos','gestor_imediat'));
	}
	
	public function updateGestor($id, Request $request)
	{
		$input = $request->all();
		$gestor = Gestor::where('id',$id)->get();
		$cargos = Cargos::all();
		$gestor_imediat = Gestor::where('gestor_sim','1')->get();
		$unidades = unidade::all();
		$validator = Validator::make($request->all(), [
			'nome'   => 'required|max:255',
			'email'  => 'required|email|max:255',
			'cpf'    => 'required|max:11',
			'cargo'  => 'required|max:255',
			'funcao' => 'required'
		]);
		if ($validator->fails()) {
			return view('gestor.gestor_alterar', compact('gestor','cargos','gestor_imediat','unidades'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}else {
			$gestor = Gestor::find($id);
			$gestor->update($input);
			$gestores = Gestor::paginate(6);
			$loggers = Loggers::create($input);
			$validator = 'Gestor Alterado com Sucesso!';
			return redirect()->route('cadastroGestor')->withErrors($validator)->with('gestores');
		}
	}
	
	public function gestorExcluir($id)
	{
		$gestor = Gestor::where('id',$id)->get();
		return view('gestor.gestor_excluir', compact('gestor'));
	}
	
	public function destroyGestor($id, Request $request)
	{
		Gestor::find($id)->delete();
		$input = $request->all();
		$gestores = Gestor::paginate(6);
		$loggers = Loggers::create($input);
        $validator = 'Gestor excluído com sucesso!';
		return redirect()->route('cadastroGestor')->withErrors($validator)->with('gestores');
	}
}