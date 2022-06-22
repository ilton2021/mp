<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\MP;
use App\Model\Vaga;
use App\Model\Gestor;
use App\Model\Aprovacao;
use App\Model\AprovacaoVaga;
use DB;
use Illuminate\Support\Facades\Mail;

class MPsNCorrigidas extends Command
{
    protected $signature = 'mps:cron';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $mpsNoFluxo = DB::table('mp')
				->select('mp.id as id','mp.solicitante as solicitante','mp.numeroMP','mp.gestor_id')
				->where('mp.concluida',0)->where('mp.aprovada',0)
				->where('mp.inativa',0)->groupby('mp.id','mp.numeroMP','solicitante','gestor_id')->get();
		$qtd = sizeof($mpsNoFluxo); 
		$vagasNoFluxo = DB::table('vaga')
				->select('vaga.id as id','vaga.solicitante as solicitante','vaga.numeroVaga','vaga.gestor_id')
				->where('vaga.concluida',0)->where('vaga.aprovada',0)
				->where('vaga.inativa',0)->groupby('vaga.id','vaga.numeroVaga','solicitante','gestor_id')->get();
		$qtdVagas = sizeof($vagasNoFluxo);
		for($b = 0; $b < $qtdVagas; $b++){
			$gestor   = $vagasNoFluxo[$b]->solicitante;
			$idGestor = Gestor::where('nome',$gestor)->get();
			if($vagasNoFluxo[$b]->gestor_id == $idGestor[0]->id){
				$id 	   = $vagasNoFluxo[$b]->id;
				$idAp 	   = DB::table('aprovacao_vaga')->where('vaga_id',$id)->where('ativo',1)->max('id');
				$aprovacao = AprovacaoVaga::where('id',$idAp)->get();
				$data_apro = $aprovacao[0]->data_aprovacao;
				$data_ini  = strtotime($data_apro);
				$dia_semana = date("N", $data_ini); 
				if($dia_semana == 1 || $dia_semana == 2 || $dia_semana == 7){
					$date = date("Y-m-d", strtotime($data_apro. '+ 3 days'));
				} else if($dia_semana == 3 || $dia_semana == 4 || $dia_semana == 5) {
					$date = date("Y-m-d", strtotime($data_apro. '+ 5 days'));
				} else if($dia_semana == 6) {
					$date = date("Y-m-d", strtotime($data_apro. '+ 4 days'));
				}
				$hoje = date("Y-m-d", strtotime("now"));
				if(strtotime($date) == strtotime($hoje)) {
					$email 		= 'ilton.albuquerque@hcpgestao.org.br';
					$numeroVaga = $vagasNoFluxo[$b]->numeroVaga;
					$nome 		= $vagasNoFluxo[$b]->solicitante;
					DB::statement('UPDATE vaga SET concluida = 1 WHERE id = '.$id.';');
					Mail::send([],[], function($m) use ($email,$numeroVaga,$nome) {
						$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
						$m->subject('VAGA - '.$numeroVaga.' Cancelada!');
						$m->setBody('A VAGA: '. $numeroVaga.' foi cancelada! Passou às 48h do tempo de correção.! Refaça esta VAGA!');
						$m->to($email);
					});
				}
			}  
		}
		for($a = 0; $a < $qtd; $a++){
			$gestor   = $mpsNoFluxo[$a]->solicitante;
			$idGestor = Gestor::where('nome',$gestor)->get();			
			if($mpsNoFluxo[$a]->gestor_id == $idGestor[0]->id) { 
				$id = $mpsNoFluxo[$a]->id;  
				$idAp 	    = DB::table('aprovacao')->where('mp_id',$id)->where('ativo',1)->max('id'); 
				$aprovacao  = Aprovacao::where('id',$idAp)->get();
				$data_apro  = $aprovacao[0]->data_aprovacao;
				$data_ini   = strtotime($data_apro); 
				$dia_semana = date("N", $data_ini); 
				if($dia_semana == 1 || $dia_semana == 2 || $dia_semana == 7){
					$date = date("Y-m-d", strtotime($data_apro. '+ 3 days'));
				} else if($dia_semana == 3 || $dia_semana == 4 || $dia_semana == 5) {
					$date = date("Y-m-d", strtotime($data_apro. '+ 5 days'));
				} else if($dia_semana == 6) {
					$date = date("Y-m-d", strtotime($data_apro. '+ 4 days'));
				}
				$hoje = date("Y-m-d", strtotime("now"));
				if(strtotime($date) == strtotime($hoje)){
					$email    = 'ilton.albuquerque@hcpgestao.org.br';
					$numeroMP = $mpsNoFluxo[$a]->numeroMP;
					$nome     = $mpsNoFluxo[$a]->solicitante; 
					DB::statement('UPDATE mp SET concluida = 1 WHERE id  = '.$id.';');
					Mail::send([], [], function($m) use ($email,$numeroMP,$nome) {
						$m->from('portal@hcpgestao.org.br', 'Movimentação de Pessoal');
						$m->subject('MP - '.$numeroMP.' Cancelada!');
						$m->setBody('A MP: '. $numeroMP.' foi cancelada! Passou às 48h do tempo de correção.! Refaça esta MP!');
						$m->to($email);
					}); 
				}
			}
		}
    }
}
