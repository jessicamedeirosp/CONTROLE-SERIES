<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovaSerie extends Mailable
{
    use Queueable, SerializesModels;

    public $nomeSerie;
    public $qtdTemporadas;
    public $qtdEpisodios;
    public function __construct(
        string $nomeSerie, 
        int $qtdTemporadas, 
        int $qtdEpisodios)
    {
        $this->nomeSerie = $nomeSerie;
        $this->qtdTemporadas = $qtdTemporadas;
        $this->qtdEpisodios = $qtdEpisodios;
    }

   
    public function build()
    {
        return $this->markdown('mail.serie.nova-serie');
    }
}
