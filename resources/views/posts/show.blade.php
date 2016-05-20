@extends ('layout')

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
  <div id="content">
    <div class="row">
      <div class="container-fluid">
        <div class="posts-wrap row">
          <div class="col-md-9">
            <div class="posts">
              <div class="post">
                <div class="post-info">
                  <p class="date">
                    <time datetime="{{ $post->created_at->toAtomString() }}">{{ $post->date }}</time>
                  </p>
                  <h2>{{ $post->title }}</h2>
                </div>
                <div class="post-img-full">
                  <img src="/{{ $post->photo }}" alt="Publicação">
                </div>
                <div class="post-info">
                  <div class="post-paragraph">
                    {!! html_entity_decode(nl2br(e($post->body))) !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="col-md-3">
          <div class="sidebar">
            <dl>
              <dt>Criada em:</dt>
              <dd>{{ date('d/m/Y \à\s H:i:s', strtotime($post->created_at)) }}</dd>
            </dl>
            <dl>
              <dt>Última edição em:</dt>
              <dd>{{ date('d/m/Y \à\s H:i:s', strtotime($post->updated_at)) }}</dd>
            </dl>
            <hr>
            <div class="row">
              <div class="col-md-6">{!! Html::linkRoute('posts.edit', 'Editar', array($post->id), array('class' => 'btn btn-primary')) !!}</div>
              <div class="col-md-6">
                {!! Form::open(array('route' => ['posts.destroy', $post->id], 'method' => 'DELETE')) !!}
                {!! Form::submit('Apagar', array('class' => 'btn btn-danger')) !!}
                {!! Form::close() !!}
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">{!! Html::linkRoute('posts.index', 'Todas as publicações', array(), array('class' => 'btn btn-default margin-top-20')) !!}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div id="footer"></div>
@endsection
