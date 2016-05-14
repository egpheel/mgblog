<div id="comentarios" class="comments-wrap">
  <h2>Comentários</h2>
  <div class="single-comment-wrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if ($post->comments->count())
      @foreach ($post->comments as $comment)
        <div class="single-comment {{ Auth::check() ? (Auth::user()->id == $comment->user->id ? 'owned' : 'not-owned') : 'not-owned' }}">
          <a href="{{ route('profile.show', ['id' => $comment->user->id])}}">
            <div class="img">
              <img src="/{{ $comment->user->avatar }}">
            </div>
          </a>
          <div class="info">
            <a href="{{ route('profile.show', ['id' => $comment->user->id])}}">
              <div class="name {{ $comment->user->hasRole('admin') ? 'admin' : 'user' }}">
                {{ $comment->user->name }}
              </div>
            </a>
            <div class="date">
              &#8211; <time datetime="{{ $comment->updated_at->toAtomString() }}">{{ $comment->updated_at->format('d/m/Y, H:i') }}</time>
              @if ($comment->created_at != $comment->updated_at)
                <em class="edited">(editado)</em>
              @endif
            </div>
            <div class="comment">{{ $comment->text }}</div>
            <textarea class="form-control edit-comment" rows="5" data-id="{{ $comment->id }}"></textarea>
          </div>
          @if (Auth::check())
            @if(Auth::user()->id == $comment->user->id || Auth::user()->hasRole('admin'))
              <div class="edit-comment-wrap">
                @if (Auth::user()->id == $comment->user->id)
                  <div class="btn edit-btn" data-toggle="tooltip" data-placement="top" title="Editar">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                  </div>
                @endif
                <div class="btn delete-btn" data-toggle="tooltip" data-placement="top" title="Apagar">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </div>
              </div>
            @endif
          @endif
        </div>
      @endforeach
      @if (!Auth::check())
        <div class="single-comment not-owned">
          <div class="no-comment">
            <p class="no-comment-desc">Para comentar é necessário <a href="/login">iniciar sessão</a>.</p>
          </div>
        </div>
      @endif
    @else
      <div class="single-comment no-comment-wrap not-owned">
        <div class="no-comment">
          <p class="no-comment-header">Seja o primeiro a comentar este artigo.</p>
          @if (!Auth::check())
            <p class="no-comment-desc">Para comentar é necessário <a href="/login">iniciar sessão</a>.</p>
          @endif
        </div>
      </div>
    @endif
  </div>
  @if (Auth::check())
    <div class="comment-form">
      {!! Form::open(['route' => ['comments.store', $post->id], 'data-parsley-validate' => '']) !!}
      <input type="hidden" class="req-details" data-name="{{ Auth::user()->name }}" data-img="{{ Auth::user()->avatar }}" data-userid="{{ Auth::user()->id }}" data-postid="{{ $post->id }}" data-admin="{{ Auth::user()->hasRole('admin') ? 'true' : 'false' }}">
      {!! Form::textarea('body', null, array('class'=> 'form-control new-comment', 'placeholder' => 'Escrever comentário', 'required' => '')) !!}
      {!! Form::submit('Enviar', ['class' => 'read-more btn-block btn comment-btn']) !!}
      {!! Form::close() !!}
    </div>
  @endif
</div>
