<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Unidade;
use Illuminate\Support\Facades\Storage;

class UnidadeController extends Controller
{
	public function cadastroUnidade()
	{
		$text = false;
		$unidades = Unidade::all();
		return view('unidade.unidade_cadastro', compact('text','unidades'));
	}
	
	public function unidadeNovo()
	{
		$text = false;
		return view('unidade.unidade_novo', compact('text'));
	}
	
	public function storeUnidade(Request $request){
		$input = $request->all();
		$nome = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if($request->file('imagem') === NULL) {	
			\Session::flash('mensagem', ['msg' => 'Selecione a imagem da Unidade!','class'=>'green white-text']);		
			$text = true;
			return view('unidade.unidade_novo', compact('text'));
		} else {
			if($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
				$v = \Validator::make($request->all(), [
					'nome'  => 'required|max:255',
					'sigla' => 'required|max:10'
				]);
				if ($v->fails()) {
					$failed = $v->failed();
					if ( !empty($failed['nome']['Required']) ) {
						\Session::flash('mensagem', ['msg' => 'O campo nome é obrigatório!','class'=>'green white-text']);
					} else if ( !empty($failed['nome']['Max']) ) {
						\Session::flash('mensagem', ['msg' => 'O campo nome possui no máximo 255 caracteres!','class'=>'green white-text']);
					} else if ( !empty($failed['sigla']['Required']) ) {
						\Session::flash('mensagem', ['msg' => 'O campo sigla é obrigatório!','class'=>'green white-text']);
					} else if ( !empty($failed['sigla']['Max']) ) {
						\Session::flash('mensagem', ['msg' => 'O campo sigla possui no máximo 10 caracteres!','class'=>'green white-text']);
					}
					$text = true;
					return view('unidade.unidade_novo', compact('text'));
				}else {
					$request->file('imagem')->move('../public/storage/unidade/', $nome);
					$input['imagem'] = $nome; 
					$input['caminho'] = 'unidade/'.$nome; 
					$unidade = Unidade::create($input);
					$unidades = Unidade::all();
					$text = true;
					\Session::flash('mensagem', ['msg' => 'Unidade Cadastrada com Sucesso!','class'=>'green white-text']);
					return view('unidade.unidade_cadastro', compact('text','unidades'));
				}
			} else {
				\Session::flash('mensagem', ['msg' => 'Só é permitido imagens: .jpg, .jpeg ou .png!','class'=>'green white-text']);		
				$text = true;
				return view('unidade.unidade_novo', compact('text'));
			}
		}
	}
	
	public function unidadeAlterar($id)
	{
		$unidade = Unidade::where('id',$id)->get();
		$text = false;
		return view('unidade.unidade_alterar', compact('text','unidade'));
	}
	
	public function updateUnidade($id, Request $request) {
		$input = $request->all();
		$nome1 = "";
		if($request->file('imagem') === NULL && $input['imagem_'] == "") {	
			\Session::flash('mensagem', ['msg' => 'Selecione a imagem da Unidade!!','class'=>'green white-text']);		
			$text = true;
			return view('unidade.unidade_novo', compact('text'));
		} else {
			if($request->file('imagem') !== null) {
			   $nome1 = $_FILES['imagem']['name'];
			   $extensao = pathinfo($nome1, PATHINFO_EXTENSION);
			} else {
			   $nome2 = $input['imagem_'];	
			   $extensao = pathinfo($nome2, PATHINFO_EXTENSION);
			}			
			if($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
				$v = \Validator::make($request->all(), [
					'nome'  => 'required|max:255',
					'sigla' => 'required|max:10'
				]);
				if ($v->fails()) {
					$failed = $v->failed();
					if ( !empty($failed['nome']['Required']) ) {
						\Session::flash('mensagem', ['msg' => 'O campo nome é obrigatório!','class'=>'green white-text']);
					} else if ( !empty($failed['nome']['Max']) ) {
						\Session::flash('mensagem', ['msg' => 'O campo nome possui no máximo 255 caracteres!','class'=>'green white-text']);
					} else if ( !empty($failed['sigla']['Required']) ) {
						\Session::flash('mensagem', ['msg' => 'O campo sigla é obrigatório!','class'=>'green white-text']);
					} else if ( !empty($failed['sigla']['Max']) ) {
						\Session::flash('mensagem', ['msg' => 'O campo sigla possui no máximo 10 caracteres!','class'=>'green white-text']);
					}
					$text = true;
					return view('unidade.unidade_novo', compact('text'));
				}else {
					if($nome1 != "") {
					  $request->file('imagem')->move('../public/storage/unidade/', $nome1);
					  $input['imagem'] = $nome1; 
					  $input['caminho'] = 'unidade/'.$nome1; 
					} 
					$unidade = Unidade::find($id); 
					$unidade->update($input);
					$unidades = Unidade::all();
					$text = true;
					\Session::flash('mensagem', ['msg' => 'Unidade Alterada com Sucesso!','class'=>'green white-text']);
					return view('unidade.unidade_cadastro', compact('text','unidades'));
				}
			} else {
				\Session::flash('mensagem', ['msg' => 'Só é permitido imagens: .jpg, .jpeg ou .png!','class'=>'green white-text']);		
				$text = true;
				return view('unidade.unidade_novo', compact('text'));
			}
		}
	}
	
	public function unidadeExcluir($id)
	{
		$unidade = Unidade::where('id',$id)->get();
		$text = false;
		return view('unidade.unidade_excluir', compact('text','unidade'));
	}
	
	public function destroyUnidade($id, Request $request){
		Unidade::find($id)->delete();
		$input = $request->all();
		$nome = $input['imagem'];
		$pasta = 'public/storage/unidade/'.$nome; 
		Storage::delete($pasta);
		$unidades = Unidade::all();
        \Session::flash('mensagem', ['msg' => 'Unidade excluída com sucesso!','class'=>'green white-text']);
		$text = true;
		return view('unidade.unidade_cadastro', compact('unidades','text'));
	}
}
