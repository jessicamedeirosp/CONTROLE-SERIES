<?php

namespace App\Listeners;

use App\Events\SerieApagada;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class ExcluirCapaSerie implements ShouldQueue
{

    public function __construct()
    {
        //
    }

    public function handle(SerieApagada $event)
    {
        $serie = $event->serie;
        if($serie->capa)
            Storage::delete($serie->capa);
    }
}
