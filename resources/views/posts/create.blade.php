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
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script type="text/javascript">
    tinymce.init({  selector: 'textarea',
                    setup: function (editor) {
                          editor.on('change', function () {
                              editor.save();
                          });
                      },
                    menubar: false,
                    plugins: 'image',
                    content_style: "p {text-align: justify; font-family: 'Open Sans', sans-serif; font-size: 20px; font-weight: 300}"
    });
  </script>
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
          {!! Form::model($post = new \App\Post, array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true)) !!}
          @include('partials._form')
          {{ Form::submit('Publicar', array('class' => 'btn btn-lg btn-block btn-success')) }}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

@endsection
