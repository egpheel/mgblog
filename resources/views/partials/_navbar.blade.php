<section class="navbar">
  <hr>
  <ul>
    <a href="/">
      <li>Blog</li>
    </a>
    <a href="/tags">
      <li>Categorias</li>
    </a>
    <a href="/arquivo">
      <li>Arquivo</li>
    </a>
    <a href="#">
      <li>Sobre</li>
    </a>
    <li>
      {!! Form::open(['route' => 'search.results', 'method' => 'GET', 'class' => 'searchForm form-inline']) !!}
      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
      {!! Form::text('pesquisa', null, ['class' => 'searchBox', 'placeholder' => 'Pesquisa']) !!}
      {!! Form::submit('Ir', ['class' => 'btn btn-default']) !!}
      {!! Form::close() !!}
    </li>
  </ul>
  <hr>
</section>
