@extends('layout')

@section('title', '- Criar nova publicação')

@section('stylesheets')
  <link rel="stylesheet" href="/css/parsley.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
@endsection

@section('scripts')
  <script src="/js/parsley/parsley.js"></script>
  <script src="/js/parsley/pt-pt.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
@endsection

@section('content')

  <div id="create">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Criar nova publicação</h1>
        <hr>
      </div>
      <div class="col-md-6 col-md-offset-3">
        <div class="form-wrap">
          {!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '')) !!}
          @include('partials._form')
          {{ Form::submit('Publicar', array('class' => 'btn btn-lg btn-block btn-success')) }}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

@endsection
