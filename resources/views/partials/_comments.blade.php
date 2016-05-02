<div class="comments-wrap">
  <h2>Comentários</h2>
  <div class="single-comment-wrap">
    @if ($post->comments)
      @foreach ($post->comments as $comment)
        <div class="single-comment">
          <div class="img">
            <img src="{{ $comment->user->avatar }}">
          </div>
          <div class="info">
            <div class="name">
              {{ $comment->user->name }}
            </div>
            <div class="date">
              &#8211; <time datetime="{{ $comment->updated_at->toAtomString() }}">{{ $comment->created_at->format('d/m/Y, H:i') }}</time>
            </div>
            <div class="comment">
              {{ $comment->text }}
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>
  @if (Auth::check())
    <div class="comment-form">
      {!! Form::open(['route' => ['comments.store', $post->id], 'data-parsley-validate' => '']) !!}
      <input type="hidden" class="user" data-name="{{ Auth::user()->name }}" data-img="{{ Auth::user()->avatar }}" data-userid="{{ Auth::user()->id }}" data-postid="{{ $post->id }}">
      {!! Form::textarea('body', null, array('class'=> 'form-control', 'placeholder' => 'Escrever comentário', 'required' => '')) !!}
      {!! Form::submit('Enviar', ['class' => 'read-more btn-block btn comment-btn']) !!}
      {!! Form::close() !!}
    </div>
  @endif
</div>
