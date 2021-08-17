<?php

namespace App\Http\Controllers;

use App\Model\CentroCusto;
use Illuminate\Http\Request;
use Validator;

class CentroCustoController extends Controller
{
    public function cadastroCentrocusto()
	{
        $centrocustos = CentroCusto::All();
		return view('centrocusto/centrocusto_cadastro', compact('centrocustos'));
	}
	
	public function centrocustoNovo()
	{
		return view('centrocusto/centrocusto_novo');
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
			$missing = array();
			for($a = 1; $a <= 8; $a++){
				if(!empty($input['unidade_'.$a])){
					$missing[] = $a;
				}
			}
			if( is_array($missing) && count($missing) > 0 )
			{
				$result = '';
				$total = count($missing) - 1;
				for($i = 0; $i <= $total; $i++)
				{ 
					$result .= $missing[$i];

					if($i < $total)
						$result .= ", ";
				}
			} else {
				$result = "";
			}	
			$input['unidade'] = $result;
			$centrocustos = CentroCusto::create($input);
            $centrocustos = CentroCusto::All();
			$validator = 'Cargo Cadastrado com Sucesso!';
			return view('centrocusto/centrocusto_cadastro', compact('centrocustos'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
		}	
	}
	
	public function centrocustoAlterar($id)
	{
		$centrocustos = CentroCusto::where('id',$id)->get();
		return view('centrocusto/centrocusto_alterar', compact('centrocustos'));
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
			$missing = array();
			for($a = 1; $a <= 8; $a++){
				if(!empty($input['unidade_'.$a])){
					$missing[] = $a;
				}
			}
			if( is_array($missing) && count($missing) > 0 )
			{
				$result = '';
				$total = count($missing) - 1;
				for($i = 0; $i <= $total; $i++)
				{ 
					$result .= $missing[$i];
					if($i < $total)
						$result .= ", ";
				}
			} else {
				$result = "";
			}
			$input['unidade'] = $result;
			$centrocustos = CentroCusto::find($id); 
			$centrocustos ->update($input);
		 	$centrocustos = CentroCusto::all();
			$validator = 'Cargo Alterado com Sucesso!';
			return view('centrocusto/centrocusto_cadastro', compact('centrocustos'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
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
		$centrocustos = CentroCusto::all();
        $validator = 'Cargo excluído com sucesso!';
		return view('centrocusto/centrocusto_cadastro', compact('centrocustos'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));
	}
}