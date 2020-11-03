<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Séries</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between">
  <a href="{{ route('listar_series') }}" class="navbar-brand">Home</a>
  @auth
    <a href="/sair" class="text-danger">Sair</a>
  @endauth
  @guest
    <a href="/entrar">Entrar</a>
  @endguest
  </nav>
  <div class="container">
    <div class="jumbotron">
      <h1>@yield('cabecalho')</h1>
    </div>
    @yield('conteudo')
  </div>
</body>
</html>