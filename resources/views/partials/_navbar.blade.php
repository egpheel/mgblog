<section class="navbar">
  <hr>
  <ul class="menu">
    <a href="/">
      <li class="menu-btn">Início</li>
    </a>
    <a href="/arquivo">
      <li class="menu-btn">Arquivo</li>
    </a>
    <a href="http://marcogil.pt">
      <li class="menu-btn">Sobre</li>
    </a>
    <a href="/pesquisar">
      <li class="menu-btn">Pesquisar</li>
    </a>
    <li class="menu-btn pointer">
      <div class="dropdown">
        @if (Auth::check())
          <a href="" class="dropdown-toggle" id="userMenu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            {{ Auth::user()->name }}
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="userMenu">
            @if (Auth::user()->hasRole('admin'))
              <li><a href="/posts/create">Nova publicação</a></li>
              <li><a href="/posts">Publicações</a></li>
              <li role="separator" class="divider"></li>
            @endif
            <li><a href="/perfil/{{ Auth::user()->id }}">Perfil</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/logout">Sair</a></li>
          </ul>
        @else
          <a href="" class="dropdown-toggle" id="userMenu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Conta
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="userMenu">
            <li><a href="/login">Iniciar sessão</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/register">Criar conta</a></li>
          </ul>
        @endif
      </div>
    </li>
  </ul>
  <hr>
</section>
<section class="navbar-mobile">
  <div class="mobile-menu-wrap">
    <span class="box-shadow-menu mobile-menu"></span>
  </div>
  <ul class="menu">
    <a href="/">
      <li class="menu-btn">Início</li>
    </a>
    <a href="/arquivo">
      <li class="menu-btn">Arquivo</li>
    </a>
    <a href="http://marcogil.pt">
      <li class="menu-btn">Sobre</li>
    </a>
    <a href="/pesquisar">
      <li class="menu-btn">Pesquisar</li>
    </a>
    <li class="menu-btn">
      <div class="dropdown">
        @if (Auth::check())
          <a href="" class="dropdown-toggle" id="userMenu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            {{ Auth::user()->name }}
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="userMenu">
            @if (Auth::user()->hasRole('admin'))
              <li><a href="/posts/create">Nova publicação</a></li>
              <li><a href="/posts">Publicações</a></li>
              <li role="separator" class="divider"></li>
            @endif
            <li><a href="/perfil/{{ Auth::user()->id }}">Perfil</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/logout">Sair</a></li>
          </ul>
        @else
          <a href="" class="dropdown-toggle" id="userMenu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Conta
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="userMenu">
            <li><a href="/login">Iniciar sessão</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/register">Criar conta</a></li>
          </ul>
        @endif
      </div>
    </li>
  </ul>
</section>
