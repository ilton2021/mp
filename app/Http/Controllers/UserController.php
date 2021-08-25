<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Auth;
use App\Model\Unidade;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Validator;


class UserController extends Controller
{
	public function __construct(Unidade $unidade)
	{
		$this->unidade = $unidade;
	}
	
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

	public function cadastroUsuario()
	{
		$users = User::all();
		return view('users/users_cadastro', compact('users'));
	}

	public function cadastroUsuarioNovo()
	{
		return view('users/users_cadastro_novo');
	}

	public function cadastroUsuarioAlterar($id)
	{
		$users = User::where('id',$id)->get();
		return view('users/users_cadastro_alterar', compact('users')); 
	}

	public function cadastroUsuarioExcluir($id)
	{
		$users = User::where('id',$id)->get();
		return view('users/users_cadastro_excluir', compact('users'));
	}
	
	public function alterarSenhaUsuario($id)
	{
		$users = User::where('id',$id)->get();
		return view('users/users_resetar_senha', compact('users'));
	}

	public function telaLogin()
	{
		$text = false;
		return view('auth.login', compact('text'));
	}

	public function telaRegistro()
	{
		$text = false;
		return view('auth.register', compact('text'));
	}
	
	public function telaEmail()
	{
		return view('auth.passwords.email');
	}
	
	public function telaReset()
	{
		$token = '';
		$text = false;
		return view('auth.passwords.reset', compact('token','text'));
	}
	
	public function Login(Request $request)
	{
		$input = $request->all(); 		
		$v = \Validator::make($request->all(), [
			'email'    => 'required|email',
            'password' => 'required'
		]);		
		if ($v->fails()) {
			$failed = $v->failed(); 
			if ( !empty($failed['email']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo e-mail é obrigatório!','class'=>'green white-text']);
			} else if ( !empty($failed['email']['Email']) ) {
				\Session::flash('mensagem', ['msg' => 'Este e-mail é inválido!','class'=>'green white-text']);
			} else if ( !empty($failed['password']['Required']) ) {
				\Session::flash('mensagem', ['msg' => 'O campo nome é obrigatório!','class'=>'green white-text']);
			}
			$text = false;
			return view('auth.login', compact('text')); 
		} else {
			$email = $input['email'];
			$senha = $input['password'];		
			$user = User::where('email', $email)->get();
			$qtd = sizeof($user); 			
			if ( empty($qtd) ) {
				\Session::flash('mensagem', ['msg' => 'Login Inválido!','class'=>'green white-text']);
				$text = true;
				return view('auth.login', compact('text')); 	
			} else {
				$text = true;
				$unidades = $this->unidade->all();
				Auth::login($user);
				return view('home', compact('unidades','user')); 						
			}
		}
	}
	
	public function resetarSenha(Request $request)
	{
		$input = $request->all();		
		$validator = Validator::make($request->all(), [
			'email'    => 'required|email',
            'password' => 'required|same:password_confirmation',
			'password_confirmation' => 'required'
    	]);		
		if ($validator->fails()) {
			return view('auth.passwords/reset')
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));						
		} else {
			if(!empty($input['password'])){ 
				$input['password'] = Hash::make($input['password']);
			}else{
				$input = array_except($input,array('password'));    
			}
			$email = $input['email'];
			$user = User::where('email',$email)->get();
			$qtd = sizeof($user);
			
			if($qtd > 0){
			    $user = User::find($user[0]->id);
				$user->update($input);
				$validator = 'Senha alterada com sucesso!';
				$unidades  = $this->unidade->all();
				return view('auth.login', compact('unidades','user'))						
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));								
			} else {
				$validator = 'Usuário não existe!';
				$unidades  = Unidade::all();
				$token = '';
				return view('auth.passwords.reset', compact('unidades','user','token'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));								
			}
		}
	}
	
    public function store(Request $request)
    {
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'name'     		   => 'required',
            'email'    		   => 'required|email|unique:users,email',
            'password' 		   => 'required|same:password_confirmation',
			'password_confirmation' => 'required',
			'funcao' => 'required'
    	]);			 
		if ($validator->fails()) {
			return view('users/users_cadastro_novo')
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));						
		} else {
			$missing = array();
			$missing2 = array();
			for($a = 1; $a <= 8; $a++){
				if(!empty($input['unidade_'.$a])){
					$missing[] = $a;
				}
				if(!empty($input['unidade_abertura_'.$a])){
					$missing2[] = $a;
				}
			}
			if( is_array($missing) && count($missing) > 0 ) {
				$result = '';
				$total = count($missing) - 1;
				for($i = 0; $i <= $total; $i++){ 
					$result .= $missing[$i];
					if($i < $total)
						$result .= ", ";
				}
			} else {
				$result = "";
			}
			if( is_array($missing2) && count($missing2) > 0 ) {
				$result2 = '';
				$total2 = count($missing2) - 1;
				for($i = 0; $i <= $total2; $i++){ 
					$result2 .= $missing2[$i];
					if($i < $total2)
						$result2 .= ", ";
				}
			} else {
				$result2 = "";
			}
			$input['unidade']  		   = $result;
			$input['unidade_abertura'] = $result2; 
			$input['password'] = Hash::make($input['password']);
			$user = User::create($input);
			$validator = 'Usuário cadastrado com sucesso!';
			$unidades  = Unidade::all();
			$users     = User::all();
			return view('users/users_cadastro', compact('users'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));						
		}
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
    }

    public function alterarUsuario(Request $request, $id)
    {
        $input = $request->all();
		$validator = Validator::make($request->all(), [
            'name'   => 'required',
            'email'  => 'required|email',
			'funcao' => 'required'
        ]);
		if($validator->fails()) {
			$users = User::where('id',$id)->get();
			return view('users/users_cadastro_alterar', compact('users'))
			->withErrors($validator)
			->withInput(session()->flashInput($request->input()));						
		} else {
			$missing = array();
			$missing2 = array();
			for($a = 1; $a <= 8; $a++){
				if(!empty($input['unidade_'.$a])){
					$missing[] = $a;
				}
				if(!empty($input['unidade_abertura_'.$a])){
					$missing2[] = $a;
				}
			}
			if( is_array($missing) && count($missing) > 0 ) {
				$result = '';
				$total = count($missing) - 1;
				for($i = 0; $i <= $total; $i++){ 
					$result .= $missing[$i];
					if($i < $total)
						$result .= ", ";
				}
			} else {
				$result = "";
			}
			if( is_array($missing2) && count($missing2) > 0 ) {
				$result2 = '';
				$total2 = count($missing2) - 1;
				for($i = 0; $i <= $total2; $i++){ 
					$result2 .= $missing2[$i];
					if($i < $total2)
						$result2 .= ", ";
				}
			} else {
				$result2 = "";
			}
			$input['unidade']  		   = $result;
			$input['unidade_abertura'] = $result2; 
			$user = User::find($id);
			$user->update($input);
			$users = User::all();
			$validator = "Usuário alterado com sucesso!!";
			return view('users/users_cadastro', compact('users'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));						
		}
    }

	public function updateSenha(Request $request, $id)
	{
		$input = $request->all(); 
		$users = User::where('id',$id)->get();
		$validator = Validator::make($request->all(), [
			'password' 		   		=> 'required|same:password_confirmation',
			'password_confirmation' => 'required'
    	]);			 
		if ($validator->fails()) {
			return view('users/users_resetar_senha', compact('users'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));						
		} else {
			$input['password'] = Hash::make($input['password']); 
			$users = User::find($id);
			$users->update($input);
			$users = User::where('id',$id)->get();
			$validator = "Senha alterada com sucesso!!";
			return redirect()->route('alterarUsuario',[$id])
					->withErrors($validator)
					->with('users','validator');
		}	
	}

	public function deleteUsuario($id)
    {
        User::find($id)->delete();
		$validator = "Usuário excluído com sucesso!!";
		$users = User::all();
        return view('users/users_cadastro', compact('users'))
					->withErrors($validator);
    }
}