<?php

use Illuminate\Support\Facades\Auth;

Route::get('/series', 'SeriesController@index')
  ->name('listar_series');
  // ->middleware('autenticador');
Route::get('/series/criar', 'SeriesController@create')
  ->name('form_criar_serie')
  ->middleware('autenticador');
Route::post('/series/criar', 'SeriesController@store')
  ->middleware('autenticador');
// Route::post('/series/remover/{id}', 'SeriesController@destroy');
Route::delete('/series/{id}', 'SeriesController@destroy')
  ->middleware('autenticador');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')
  ->middleware('autenticador');
Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')
  ->middleware('autenticador');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');
Route::get('/sair', function(){
  \Illuminate\Support\Facades\Auth::logout();
  return redirect('/entrar');
});
Route::get('/visualizando-serie', function() {
  return new \App\Mail\NovaSerie(
    'Arrow',
    1,
    10
  );
});
Route::get('/enviando-serie', function() {});
Auth::routes();