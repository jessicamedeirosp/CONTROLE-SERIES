<?php

namespace App\Services;

use App\{Serie, Temporada, Episodio};
use App\Events\SerieApagada;
use App\Jobs\ExcluirCapaSerie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RemovedorDeSerie
{
  public function removerSerie(int $serieId): string
  {
    $nomeSerie = '';
    DB::transaction(function () use ($serieId, &$nomeSerie) {
      $serie = Serie::find($serieId);
      $serieObj = (object) $serie->toArray();
      $nomeSerie = $serie->nome;
      $this->removerTemporadas($serie);
      $serie->delete();
      // $evento = new SerieApagada($serieObj);
      // event($evento);
      ExcluirCapaSerie::dispatch($serieObj);
    });
    return $nomeSerie;
  }
  private function removerTemporadas(Serie $serie): void
  {
    $serie->temporadas->each(function (Temporada $temporada) {
      $this->removerEpisodios($temporada);
      $temporada->delete();
    });
   
  }
  private function removerEpisodios($temporada): void
  {
    $temporada->episodios->each(function (Episodio $episodio) {
      $episodio->delete();
    });   
  }
}
