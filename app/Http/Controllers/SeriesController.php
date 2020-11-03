<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Events\NovaSerie;
use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Temporada;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{
  // public function _construct(){
  //   $this->middleware('auth');
  // }
  public function index(Request $request)
  {
    $series = Serie::query()->orderBy('nome')->get(); // ordena a-z  
    // Serie::all() traz todos os dados do bd
    $mensagem = $request->session()->get('mensagem');
    //$request->session()->remove('mensagem'); //remove da session
    return view('series.index', compact('series', 'mensagem'));
    // return view('series.index', array(
    //   'series' =>  $series
    // ));
  }

  public function create()
  {
    return view('series.create');
  }

  public function store(
    SeriesFormRequest $request, 
    CriadorDeSerie $criadorDeSerie
    ) {
  //   $request->validate([
  //     'nome' => 'required|min:3'
  //   ]);
  //  // $nome = $request->nome; // $request->get('nome');
    // $serie = Serie::create($request->all()); // recebe todas as request do form
    $capa = null;
    if($request->hasFile('capa'))
      $capa = $request->file('capa')->store('serie');



    $serie = $criadorDeSerie->criarSerie(
      $request->nome,
      $request->qtd_temporadas,
      $request->ep_por_temporada,
      $capa
    );

    //email
    $eventoNovaSerie = new NovaSerie(
      $request->nome,
      $request->qtd_temporadas,
      $request->ep_por_temporada
    );
    event($eventoNovaSerie);
    

    // $request->session()
    //   ->put("mensagem", "Série {$serie->id} criada com sucesso {$serie->nome}"); //envia pra session
    $request->session()
      ->flash("mensagem", "Série {$serie->id} e suas temporadas e episódios criadas com sucesso {$serie->nome}"); //para mensagem
    return redirect()->route('listar_series');
   
  }
  public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie){
    $nomeSerie = $removedorDeSerie->removerSerie($request->id);
    $request->session()
      ->flash("mensagem", "Série $nomeSerie removida com sucesso"); //para mensagem
    return redirect()->route('listar_series');;
  }

  public function editaNome(int $id, Request $request) {
    $novoNome = $request->nome;
    $serie = Serie::find($id);
    $serie->nome = $novoNome;
    $serie->save();
  }
}
