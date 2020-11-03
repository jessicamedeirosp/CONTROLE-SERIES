<?php

namespace Tests\Feature;

use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemovedorDeSeriesTest extends TestCase
{
  
    use RefreshDatabase;

    protected $serie;
    protected function setUp():void {
        parent::setUp();
        $criadorDeSerie = new CriadorDeSerie();
        $this->serie = $criadorDeSerie->criarSerie('teste delete', 1,1);
        
    }
    public function testRemoverUmaSerie()
    {
        $removedorDeSerie = new RemovedorDeSerie();
        $nomeSerie = $removedorDeSerie->removerSerie($this->serie->id);
        $this->assertIsString($nomeSerie);
        $this->assertEquals('teste delete', $this->serie->nome);
        $this->assertDatabaseMissing('series', ['id'=> $this->serie->id]);
    }
}
