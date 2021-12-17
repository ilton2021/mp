<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Unidade;
use App\Model\Loggers;
use Illuminate\Support\Facades\Storage;
use Validator;
use DB;

class UnidadeController extends Controller
{
	public function cadastroUnidade()
	{
		$unidades = Unidade::all();
		return view('unidade.unidade_cadastro', compact('unidades'));
	}
	
	public function unidadeNovo()
	{
		return view('unidade.unidade_novo');
	}
	
	public function pesquisarUnidade(Request $request)
	{
		$input = $request->all();
		$id    = $input['id'];
		$pesq  = $input['pesq'];
		
		if($id == 1) {
			$unidades = DB::table('unidade')->where('unidade.nome','like','%'.$pesq.'%')->get();
		} else if($id == 2) {
			$unidades = DB::table('unidade')->where('unidade.sigla','like','%'.$pesq.'%')->get();
		}
		return view('unidade/unidade_cadastro', compact('unidades'));
	}

	public function storeUnidade(Request $request){
		$input = $request->all();
		$nome = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if($request->file('imagem') === NULL) {	
			$validator = 'Selecione a imagem da Unidade!';
			return view('unidade.unidade_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
		} else {
			if($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
				$validator = Validator::make($request->all(), [
					'nome'  => 'required|max:255',
					'sigla' => 'required|max:10'
				]);
				if ($validator->fails()) {
					return view('unidade.unidade_novo', compact('text'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					$request->file('imagem')->move('../public/storage/unidade/', $nome);
					$input['imagem'] = $nome; 
					$input['caminho'] = 'unidade/'.$nome; 
					$unidade = Unidade::create($input);
					$loggers = Loggers::create($input);
					$unidades = Unidade::all();
					$validator = 'Unidade Cadastrada com Sucesso!';
					return view('unidade.unidade_cadastro', compact('unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';		
				return view('unidade.unidade_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
	}
	
	public function unidadeAlterar($id)
	{
		$unidade = Unidade::where('id',$id)->get();
		return view('unidade.unidade_alterar', compact('unidade'));
	}
	
	public function updateUnidade($id, Request $request) {
		$input = $request->all();
		$nome1 = "";
		if($request->file('imagem') === NULL && $input['imagem_'] == "") {	
			$validator = 'Selecione a imagem da Unidade!!';		
			return view('unidade.unidade_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
		} else {
			if($request->file('imagem') !== null) {
			   $nome1 = $_FILES['imagem']['name'];
			   $extensao = pathinfo($nome1, PATHINFO_EXTENSION);
			} else {
			   $nome2 = $input['imagem_'];	
			   $extensao = pathinfo($nome2, PATHINFO_EXTENSION);
			}			
			if($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
				$validator = Validator::make($request->all(), [
					'nome'  => 'required|max:255',
					'sigla' => 'required|max:10'
				]);
				if ($validator->fails()) {
					return view('unidade.unidade_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					if($nome1 != "") {
					  $request->file('imagem')->move('../public/storage/unidade/', $nome1);
					  $input['imagem'] = $nome1; 
					  $input['caminho'] = 'unidade/'.$nome1; 
					} 
					$unidade = Unidade::find($id); 
					$unidade->update($input);
					$loggers = Loggers::create($input);
					$unidades = Unidade::all();
					$validator ='Unidade Alterada com Sucesso!';
					return view('unidade.unidade_cadastro', compact('unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
				return view('unidade.unidade_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
	}
	
	public function unidadeExcluir($id)
	{
		$unidade = Unidade::where('id',$id)->get();
		return view('unidade.unidade_excluir', compact('unidade'));
	}
	
	public function destroyUnidade($id, Request $request){
		Unidade::find($id)->delete();
		$input = $request->all();
		$nome = $input['imagem'];
		$pasta = 'public/storage/unidade/'.$nome; 
		Storage::delete($pasta);
		$loggers = Loggers::create($input);
		$unidades = Unidade::all();
        $validator = 'Unidade excluída com sucesso!';
		return view('unidade.unidade_cadastro', compact('unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
	}
}