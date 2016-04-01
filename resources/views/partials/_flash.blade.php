<div class="container">
  @if (Session::has('success'))
    <div role="alert" class="alert alert-success">
      <strong>Successo: </strong>{{ Session::get('success') }}
    </div>
  @endif

  @if (count($errors) > 0)
    <div role="alert" class="alert alert-danger">
      <strong>Erros:</strong>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</div>
