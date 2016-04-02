@extends('layout')

@section('scripts')
  <!--infinitescroll-->
  <script src="/js/infinitescroll/infinitescroll.js"></script>
  <!--my js-->
  <script src="/js/functions.js"></script>
@endsection

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
  <section class="content">
    <div class="row">
      <div class="featured">
        <hr>
        <div class="img-wrap">
          <img src="/img/featured-temp.jpg" alt="Publicação em destaque">
        </div>
        <hr>
        <div class="featured-post-wrap">
          <h2>Pelas ruas de Amesterdão</h2>
          <p>As ruas de Amesterdão são na sua maioria compostas por bicicletas, ou veículos de duas rodas. Mas esta é uma via de carros e tram´s...tive por isso a sorte de apanhar Roger a pedalar pela vida e pela cidade.</p>
          <a href="#" class="read-more">Ler mais</a>
        </div>
      </div>
      <div class="posts-wrap row">
        <div class="col-md-9">
          <div class="posts">

            @include('partials._posts')

          </div>
        </div>
        <div class="col-md-3">
          @include('partials._sidebar')
        </div>
      </div>
    </div>
  </section>

@endsection
