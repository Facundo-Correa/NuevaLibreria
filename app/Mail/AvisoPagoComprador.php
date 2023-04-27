<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AvisoPagoComprador extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public $subject = '| Ya recibimos el pago de tu compra! |';
    public $info = [];

    public function build()
    {        
        $data = $this->info;
        return $this->view('pages::public.emails.pagorealizadocomprador', compact('data'));
    }
}
