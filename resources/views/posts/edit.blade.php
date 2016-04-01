@extends('layout')

@section('title', '- Editar publicação')

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

  <div id="content">
    <div class="row">
      {!! Form::model($post, array('route' => ['posts.update', $post->id], 'method' => 'PUT')) !!}
        <div class="container-fluid">
          <div class="col-md-9">
            <div class="edit-form">
              <h2>Editar publicação</h2>
              @include('partials._form')
            </div>
          </div>
          <div class="col-md-3">
            <div class="sidebar">
              <dl>
                <dt>Criada em:</dt>
                <dd>{{ date('d M Y \à\s H:i:s', strtotime($post->created_at)) }}</dd>
              </dl>
              <dl>
                <dt>Última edição em:</dt>
                <dd>{{ date('d M Y \à\s H:i:s', strtotime($post->updated_at)) }}</dd>
              </dl>
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  {!! Html::linkRoute('posts.show', 'Cancelar', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
                </div>
                <div class="col-sm-6">
                  {{ Form::submit('Guardar', array('class' => 'btn btn-success btn-block')) }}
                </div>
              </div>
            </div>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>

@endsection
