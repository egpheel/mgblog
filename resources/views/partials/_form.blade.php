{!! Form::file('photo', ['class' => 'form-control']) !!}
{!! Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Título', 'required' => '', 'maxlength' => '255')) !!}
{!! Form::textarea('body', null, array('class'=> 'form-control', 'placeholder' => 'Publicação', 'required' => '')) !!}
{!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}

<div class="form-group form-margin-top">
  {!! Form::checkbox('featured') !!} Em destaque
</div>
{!! Form::label('publish_at', 'Publicar em:', ['class' => 'form-margin-top']) !!}
{!! Form::input('datetime', 'publish_at', $post->publish_at->format('Y-m-d H:i:s'), ['class' => 'form-control']) !!}

@section('footer')
  <script type="text/javascript">
    $('textarea').trumbowyg({
      lang: 'pt'
    });
    $('#tag_list').select2({
      placeholder: 'Escolha uma tag',
      tags: true
    });
  </script>
@endsection
