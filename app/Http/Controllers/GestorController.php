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
		$text = false;
		$gestores = Gestor::all();
		$unidades = Unidade::all();
		return view('gestor.gestor_cadastro', compact('text','gestores','unidades'));
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
		$text = false;
		$unidades = Unidade::all();
		return view('gestor.gestor_cadastro', compact('text','unidades','gestores'));
	}
	
	public function gestorNovo()
	{
		$text = false;
		$unidades = Unidade::all();
		return view('gestor.gestor_novo', compact('text','unidades'));
	}
	
	public function storeGestor(Request $request)
	{
		$input = $request->all();
		$v = \Validator::make($request->all(), [
			'nome'   => 'required|max:255',
			'email'  => 'required|email|max:255',
			'cpf'    => 'required|max:11',
			'cargo'  => 'required|max:255',
			'funcao' => 'required'
		]);
		if ($v->fails()) {
			$failed = $v->failed();
			if ( !empty($failed['nome']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo nome é obrigatório!','class'=>'green white-text']);
			} else if ( !empty($failed['nome']['Max']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo nome possui no máximo 255 caracteres!','class'=>'green white-text']);
			} else if ( !empty($failed['email']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo e-mail é obrigatório!','class'=>'green white-text']);
			} else if ( !empty($failed['email']['Email']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo e-mail tem que ser válido!','class'=>'green white-text']);
			} else if ( !empty($failed['email']['Max']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo e-mail possui no máximo 255 caracteres!','class'=>'green white-text']);
			} else if ( !empty($failed['funcao']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo função é obrigatório!','class'=>'green white-text']);
			} else if ( !empty($failed['cpf']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo cpf é obrigatório!','class'=>'green white-text']);
			} else if ( !empty($failed['cpf']['Max']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo cpf possui no máximo 11 caracteres!','class'=>'green white-text']);
			} else if ( !empty($failed['cargo']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo cargo é obrigatório!','class'=>'green white-text']);
			} else if ( !empty($failed['cargo']['Max']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo cargo possui no máximo 255 caracteres!','class'=>'green white-text']);
			}
			$text = true;
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
		return view('gestor.gestor_alterar', compact('text','gestor'));
	}
	
	public function updateGestor($id, Request $request)
	{
		$input = $request->all();
		$v = \Validator::make($request->all(), [
			'nome'   => 'required|max:255',
			'email'  => 'required|email|max:255',
			'cpf'    => 'required|max:11',
			'cargo'  => 'required|max:255',
			'funcao' => 'required'
		]);
		if ($v->fails()) {
			$failed = $v->failed();
			if ( !empty($failed['nome']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo nome é obrigatório!','class'=>'green white-text']);
			} else if ( !empty($failed['nome']['Max']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo nome possui no máximo 255 caracteres!','class'=>'green white-text']);
			} else if ( !empty($failed['email']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo e-mail é obrigatório!','class'=>'green white-text']);
			} else if ( !empty($failed['email']['Email']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo e-mail tem que ser válido!','class'=>'green white-text']);
			} else if ( !empty($failed['email']['Max']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo e-mail possui no máximo 255 caracteres!','class'=>'green white-text']);
			} else if ( !empty($failed['funcao']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo função é obrigatório!','class'=>'green white-text']);
			} else if ( !empty($failed['cpf']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo cpf é obrigatório!','class'=>'green white-text']);
			} else if ( !empty($failed['cpf']['Max']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo cpf possui no máximo 11 caracteres!','class'=>'green white-text']);
			} else if ( !empty($failed['cargo']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo cargo é obrigatório!','class'=>'green white-text']);
			} else if ( !empty($failed['cargo']['Max']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo cargo possui no máximo 255 caracteres!','class'=>'green white-text']);
			}
			$text = true;
			return view('gestor.gestor_alterar', compact('text'));
		}else {
			$gestor = Gestor::find($id);
			$gestor->update($input);
			$gestores = Gestor::all();
			$text = true;
			\Session::flash('mensagem', ['msg' => 'Gestor Alterado com Sucesso!','class'=>'green white-text']);
			return view('gestor.gestor_cadastro', compact('text','gestores'));
		}
	}
	
	public function gestorExcluir($id)
	{
		$text = false;
		$gestor = Gestor::where('id',$id)->get();
		return view('gestor.gestor_excluir', compact('text','gestor'));
	}
	
	public function destroyGestor($id, Request $request)
	{
		Gestor::find($id)->delete();
		$input = $request->all();
		$gestores = Gestor::all();
        \Session::flash('mensagem', ['msg' => 'Gestor excluído com sucesso!','class'=>'green white-text']);
		$text = true;
		return view('gestor.gestor_cadastro', compact('gestores','text'));
	}
}