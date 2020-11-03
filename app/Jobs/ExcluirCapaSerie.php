<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class ExcluirCapaSerie //implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $serie;

    public function __construct($serie)
    {
        $this->serie = $serie;
    }

   
    public function handle()
    {
        $serie = $this->serie;
        if($serie->capa)
            Storage::delete($serie->capa);
    }
}
