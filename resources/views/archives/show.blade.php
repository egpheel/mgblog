@extends('layout')

@section('title', '- Arquivo de '. $archive_date)

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
    <div class="posts-wrap">
      <div class="posts">
        <h1>Arquivo de {{ $archive_date }}</h1>

        @include('partials._posts')

      </div>
      @include('partials._sidebar')
    </div>
  </section>

@endsection
