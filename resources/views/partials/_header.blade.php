<div class="header">
  <h1><a href="/">Marco Gil</a></h1>
  <p><em>frase bastante sexy sobre cenas e viagens e assim</em></p>
</div>
<div class="login-logout">
  @if (!Auth::check())
    <a href="/login">Entrar</a>
  @else
    Autenticado como {{ Auth::user()->name }}.
    <a href="/posts">Publicações</a>,
    <a href="/logout">Sair</a>
  @endif
</div>
