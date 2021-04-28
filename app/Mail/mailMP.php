<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Model\Gestor;

class mailMP extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }
	
    public function build()
    {
		$gestores = Gestor::all();
        return $this->view('email.emailMP', compact('gestores'));
    }
}
