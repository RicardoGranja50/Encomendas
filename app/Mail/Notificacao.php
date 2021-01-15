<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notificacao extends Mailable
{
    use Queueable, SerializesModels;
    public $clientes;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    //public function __construct()
    //{
        //$this->clientes=$cliente;
    //}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('1a66220c6f-7bb7a4@inbox.mailtrap.io')->subject('Novo registo')->view('email');
    }
}
