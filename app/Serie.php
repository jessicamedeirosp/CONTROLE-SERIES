<?php
namespace App;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Serie extends Model
{
  // laravel sempre pega o nome da classe no caso Serie e deixa em minusculo e add s
  //resultado = series
  //ou seja linha a baixo não é necessária só se quiser outro formato
  //protected $table = 'series'; 
  
  // diz que não é necessario criar os campos de data criação e data alteração
  public $timestamps = false; 
  protected $fillable = ['nome', 'capa']; // define quais paramentros são aceitos

  public function getCapaUrlAttribute() {
    if($this->capa) {
      return Storage::url($this->capa);
    } else {
      return Storage::url('serie/sem-imagem.png');
    }
  }
  public function temporadas() {
    return $this->hasMany(Temporada::class);
  }
}