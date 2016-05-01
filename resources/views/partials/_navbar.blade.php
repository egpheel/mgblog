<section class="navbar">
  <hr>
  <ul>
    <a href="/">
      <li>Blog</li>
    </a>
    <a href="/arquivo">
      <li>Arquivo</li>
    </a>
    <a href="http://marcogil.pt">
      <li>Sobre</li>
    </a>
    <a href="/pesquisar">
      <li>Pesquisar</li>
    </a>
    <li class="pointer">
      <div class="dropdown">
        @if (Auth::check())
          <a href="" id="userMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            {{ Auth::user()->name }}
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" aria-labelleby="userMenu">
            <li><a href="/logout">Sair</a></li>
          </ul>
        @else
          <a href="" id="userMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Conta
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" aria-labelleby="userMenu">
            <li><a href="/login">Iniciar sessão</a></li>
            <li><a href="/register">Criar conta</a></li>
          </ul>
        @endif
      </div>
    </li>
  </ul>
  <hr>
</section>
