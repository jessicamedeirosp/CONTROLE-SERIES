@extends('layout')

@section('cabecalho')
Séries
@endsection

@section('conteudo')
{{-- @includeWhen(!empty($mensagem), 'mensagem', ['mensagem' => $mensagem]) --}}
@include('mensagem', ['mensagem' => $mensagem])
@auth    
<a href="{{ route('form_criar_serie') }}" class="btn btn-dark mb-2">Adicionar</a>
@endauth
<ul class="list-group">
    @foreach($series as $serie)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <img src="{{ $serie->capa_url }}" class="img-thumbnail" height="100" width="100" alt="">
          <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>
        </div>

        <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
            <input type="text" class="form-control" value="{{ $serie->nome }}">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>
        <span class="d-flex">
          @auth              
          <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $serie->id }})">
            <i class="fas fa-edit"></i>
          </button>
          @endauth
          <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm mr-1">
            <i class="fas fa-external-link-alt"></i>
          </a>        
          @auth              
          <form method="POST" action="/series/{{$serie->id}}" onsubmit="return confirm('Tem certeza que desja remover {{ addslashes($serie->nome)}}?');">
            @csrf 
            @method("DELETE")
            <button class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
          </form>
          @endauth
        </span>
       
      </li>
    @endforeach
<ul>
    <script>
      function toggleInput(serieId) {
        const inputNomeSerieEl =  document.getElementById(`input-nome-serie-${serieId}`);
        const nomeSerieEl =  document.getElementById(`nome-serie-${serieId}`);
        if(inputNomeSerieEl.hasAttribute('hidden')){
          inputNomeSerieEl.removeAttribute('hidden');
          nomeSerieEl.hidden = true;
        } else {   
          inputNomeSerieEl.hidden = true; 
          nomeSerieEl.removeAttribute('hidden');
        }
      }
      function editarSerie(serieId) {
        let formData = new FormData;
        const nome =  document
          .querySelector(`#input-nome-serie-${serieId} > input`)
          .value;
        const token = document.querySelector(`input[name="_token"]`).value;
        formData.append('nome', nome);
        formData.append('_token', token);
        const url = `/series/${serieId}/editaNome`;
        fetch(url, {
          body: formData,
          method: 'POST'
        }).then(() => {
          const nomeSerieEl =  document
            .getElementById(`nome-serie-${serieId}`).textContent = nome;
          toggleInput(serieId);
         
        });
      }
    </script>
@endsection
