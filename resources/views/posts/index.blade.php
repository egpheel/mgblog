<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!--parsleyjs-->
    <script src="/js/parsley/parsley.js"></script>
    <script src="/js/parsley/pt-pt.js"></script>
    <link rel="stylesheet" href="/css/parsley.css">
    <!--my CSS-->
    <link rel="stylesheet" href="/css/layout.css">
    <title>Marco Gil - Blog</title>
  </head>
  <body>
    <div class="header">
      <h1>Marco Gil</h1>
      <p><em>frase bastante sexy sobre cenas e viagens e assim</em></p>
    </div>
    <div class="container">@if (Session::has('success'))
      <div role="alert" class="alert alert-success"><strong>Successo: </strong>{{ Session::get('success') }}</div>@endif
      @if (count($errors) > 0)
      <div role="alert" class="alert alert-danger"><strong>Erros:</strong>
        <ul>@foreach ($errors->all() as $error)
          <li>{{ $error }}</li>@endforeach
        </ul>
      </div>@endif
    </div>
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
                  <td>{{ substr($post->body, 0, 50) }}{{ strlen($post->body)>50 ? '...' : '' }}</td>
                  <td>{{ date('d M Y \à\s H:i', strtotime($post->created_at)) }}</td>
                  <td> <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default">Ver</a> <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default">Editar</a></td>
                </tr>@endforeach
              </tbody>
            </table>
            <div class="text-center">{!! $posts->links() !!}</div>
          </div>
        </div>
      </div>
      <hr>
    </div>
    <div id="footer"></div>
  </body>
</html>