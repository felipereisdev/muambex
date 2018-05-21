<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RastrearEncomendaCronSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $dados;
    private $muamba;

    public function __construct($dados, $muamba)
    {
        $this->dados = $dados;
        $this->muamba = $muamba;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('ExampleEmail')
                    ->from($this->muamba->users->email)
                    ->with(['dados' => $this->dados, 'muamba' => $this->muamba]);
    }
}
