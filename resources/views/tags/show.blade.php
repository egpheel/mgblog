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
    @include('partials._beautybar', ['page' => ucfirst($tags->name)])
    <div class="posts-wrap row">
      <div class="col-md-9">
        <div class="posts">

          @include('partials._posts')

        </div>
      </div>
      <div class="col-md-3 sidebar-show">
        @include('partials._sidebar')
      </div>
    </div>
  </section>

@endsection
