<?php 
namespace App\Services;

use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;
class CriadorDeSerie {
  public function criarSerie(
    string $nomeSerie,
    int $qtdTemporadas,
    int $epPorTemporada,
    ?string $capa

  ): Serie {
  
    DB::begintransaction() ;
    $serie = Serie::create(['nome' => $nomeSerie, 'capa' => $capa]);
    $this->criarTemporada($serie, $qtdTemporadas, $epPorTemporada);
    Db::commit();
 
    return $serie;
  }
  private function criarTemporada(
    Serie $serie,
    int $qtdTemporadas,
    int $epPorTemporada
    ) {
    for ($i = 1; $i <= $qtdTemporadas; $i++) {
      $temporada = $serie->temporadas()->create(['numero' => $i]);
      $this->criarEpisodio($temporada,$epPorTemporada);
    }
  }
  private function criarEpisodio(Temporada $temporada, int $epPorTemporada) {
    for($j = 1; $j <= $epPorTemporada; $j++) {
      $temporada->episodios()->create(['numero' => $j]);
    }
  }
}
