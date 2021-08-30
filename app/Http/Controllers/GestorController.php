<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Gestor;
use App\Model\Unidade;
use DB;

class GestorController extends Controller
{
    public function cadastroGestor()
	{
		$gestores = Gestor::all();
		$unidades = Unidade::all();
		return view('gestor.gestor_cadastro', compact('gestores','unidades'));
	}
	
	public function pesquisarGestor(Request $request)
	{
		$input = $request->all();
		$id    = $input['id'];
		$pesq  = $input['pesq'];
		
		if($id == 1) {
			$gestores = DB::table('gestor')->where('gestor.nome', 'like', '%' . $pesq . '%')->get();
		} else if($id == 2) {
			$gestores = DB::table('gestor')->where('gestor.email', 'like', '%' . $pesq . '%')->get();
		} else if($id == 3) {
		    $gestores = DB::table('gestor')->where('gestor.funcao', 'like', '%' . $pesq . '%')->get();
		} else if($id == 4) {
		    $gestores = DB::table('gestor')->join('unidade','unidade.id','=','gestor.unidade_id')
			->where('unidade.nome', 'like', '%' . $pesq . '%')->get();
		}
		$unidades = Unidade::all();
		return view('gestor.gestor_cadastro', compact('unidades','gestores'));
	}
	
	public function gestorNovo()
	{
		$unidades = Unidade::all();
		return view('gestor.gestor_novo', compact('unidades'));
	}
	
	public function storeGestor(Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'nome'   => 'required|max:255',
			'email'  => 'required|email|max:255',
			'cpf'    => 'required|max:11',
			'cargo'  => 'required|max:255',
			'funcao' => 'required'
		]);
		if ($validator->fails()) {
			return view('gestor.gestor_novo', compact('text'));
		}else {
			$gestor   = Gestor::create($input);
			$gestores = Gestor::all();
			$unidades = Unidade::all();
			$text = true;
			\Session::flash('mensagem', ['msg' => 'Gestor Cadastrado com Sucesso!','class'=>'green white-text']);
			return view('gestor.gestor_cadastro', compact('text','gestores','unidades'));
		}
	}
	
	public function gestorAlterar($id)
	{
		$text = false;
		$gestor = Gestor::where('id',$id)->get();
		return view('gestor.gestor_alterar', compact('gestor'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
	}
	
	public function updateGestor($id, Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'nome'   => 'required|max:255',
			'email'  => 'required|email|max:255',
			'cpf'    => 'required|max:11',
			'cargo'  => 'required|max:255',
			'funcao' => 'required'
		]);
		if ($validator->fails()) {
			return view('gestor.gestor_alterar')
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}else {
			$gestor = Gestor::find($id);
			$gestor->update($input);
			$gestores = Gestor::all();
			$validator = 'Gestor Alterado com Sucesso!';
			return view('gestor.gestor_cadastro', compact('gestores'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
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
		$gestores = Gestor::all();
        $validator = 'Gestor excluído com sucesso!';
		return view('gestor.gestor_cadastro', compact('gestores'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
	}
}