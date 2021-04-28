<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Unidade;
use App\Model\Gestor;
use App\Model\Cargos;
use Illuminate\Support\Facades\Auth;

class THomeOfficeController extends Controller
{
    public function inicioHomeOffice(){
		$unidades   = Unidade::all();
		$usuario_id = Auth::user()->id;
		$gestor     = Gestor::all();
		return view('welcome_o', compact('unidades','gestor'));
	}
	
	public function form_office($id){
		$unidade = Unidade::where('id', $id)->get();
		$unidades = Unidade::all();
		$cargos  = Cargos::all();
		return view('home_office', compact('unidade','cargos','unidades'));
	}
	
	public function store($id, Request $request){
		$input = $request->all();
		
		$validator = Validator::make($request->all(), [
			'vaga'                      => 'required|max:255',
			'codigo_vaga' 				=> 'required|max:255',
			'area' 						=> 'required|max:255',
			'edital_disponivel'			=> 'required|max:255',
			'data_prevista'				=> 'required',
			'cargo'						=> 'required|max:255',
			'salario' 					=> 'required|max:255',
			'horario_trabalho'  		=> 'required|max:255',
            'escala_trabalho'			=> 'required|max:255',
			'centro_custo'				=> 'required|max:255',
			'jornada'					=> 'required|max:255',
			'turno'						=> 'required|max:255',
			'tipo'              		=> 'required|max:255',
			'motivo'            		=> 'required|max:255',
			'contratacao_deficiente'    => 'required|max:255',
			'email'			            => 'required|max:255',
			'conhecimento_tecnico'		=> 'required|max:255',
			'conhecimento_desejado'		=> 'required|max:255',
			'formacao'					=> 'required|max:255',
			'idiomas'					=> 'required|max:255',
			'justificativa'				=> 'required|max:1000'
        ]);
		$text = true;
		if ($validator->fails()) {
            return view('vaga', compact('unidade','gestores','tipo_vaga','text','unidades','email','cargos','centro_custos','setores','centro_custo_nv'))
                        ->withErrors($validator)
                        ->withInput(session()->flashInput($request->input()));
        }
		
	}
}
