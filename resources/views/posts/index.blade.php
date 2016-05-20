@extends ('layout')

@section('navbar')
  @include('partials._navbar')
@endsection

@section('content')
  <div id="content">
    <div class="row">
      <div class="container">
        <div class="col-md-10">
          <h1>Todas as publicações</h1>
        </div>
        <div class="col-md-2"><a href="{{ route('posts.create') }}" class="margin-top-20 btn btn-lg btn-primary">Nova publicação</a></div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="container">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <th>#</th>
              <th>Título</th>
              <th>Publicação</th>
              <th>Criada em</th>
              <th> </th>
            </thead>
            <tbody>@foreach ($posts as $post)
              <tr>
                <th>{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ strip_tags(substr($post->body, 0, 50)) }}{{ strip_tags(strlen($post->body))>50 ? '...' : '' }}</td>
                <td>{{ date('d/m/Y \à\s H:i', strtotime($post->created_at)) }}</td>
                <td> <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default">Ver</a> <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default">Editar</a></td>
              </tr>@endforeach
            </tbody>
          </table>
          <div class="text-center">{!! $posts->links() !!}</div>
        </div>
      </div>
    </div>
  </div>
  <div id="footer"></div>
@endsection
