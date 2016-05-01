<div class="header-bar">
</div>
<div class="header">
  <h1><a href="/">Marco Gil</a></h1>
  <p><em>frase bastante sexy sobre cenas e viagens e assim</em></p>
</div>
<div class="login-logout">
  @if (!Auth::check())
    <a href="/login">Iniciar sessão</a>
    <a href="/register">Criar conta</a>
  @else
    Autenticado como {{ Auth::user()->name }}.
    @if(Auth::user()->hasRole('admin'))
      <a href="/posts">Publicações</a>,
    @endif
    <a href="/logout">Sair</a>
  @endif
</div>
