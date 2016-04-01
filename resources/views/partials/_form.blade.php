{!! Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Título', 'required' => '', 'maxlength' => '255')) !!}
{!! Form::textarea('body', null, array('class'=> 'form-control', 'placeholder' => 'Publicação', 'required' => '')) !!}
{!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}

@section('footer')
  <script type="text/javascript">
    $('#tag_list').select2({
      placeholder: 'Escolha uma tag',
      tags: true
    });
  </script>
@endsection
