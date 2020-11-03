<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnviarEmailNovaSerie implements ShouldQueue
{
    
    public function __construct()
    {
        //
    }

    
    public function handle(NovaSerie $event)
    {
        // $user = $request->user();
        User::all()->each(function(User $user, $indice) use ($event) {
            $multiplicador = $indice + 1 ;
            $email = new \App\Mail\NovaSerie(
                $event->nomeSerie,
                $event->qtdTemporadas,
                $event->qtdEpisodios
            );
            $email->subject('Nova Série Adicionada');
            $when = now()->addSecond($multiplicador * 5);
            Mail::to($user)->later($when,$email);
        });
    
    }
}
