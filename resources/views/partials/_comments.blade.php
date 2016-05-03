<div class="comments-wrap">
  <h2>Comentários</h2>
  <div class="single-comment-wrap">
    @if ($post->comments->count())
      @foreach ($post->comments as $comment)
        <div class="single-comment {{ Auth::check() ? (Auth::user()->id == $comment->user->id ? 'owned' : 'not-owned') : 'not-owned' }}">
          <div class="img">
            <img src="{{ $comment->user->avatar }}">
          </div>
          <div class="info">
            <div class="name {{ $comment->user->hasRole('admin') ? 'admin' : 'user' }}">
              {{ $comment->user->name }}
            </div>
            <div class="date">
              &#8211; <time datetime="{{ $comment->updated_at->toAtomString() }}">{{ $comment->created_at->format('d/m/Y, H:i') }}</time>
            </div>
            <div class="comment">
              {{ $comment->text }}
            </div>
          </div>
          @if (Auth::check())
            @if(Auth::user()->id == $comment->user->id)
              <div class="edit-comment-wrap">
                <div class="edit-btns">
                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
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
      <input type="hidden" class="user" data-name="{{ Auth::user()->name }}" data-img="{{ Auth::user()->avatar }}" data-userid="{{ Auth::user()->id }}" data-postid="{{ $post->id }}">
      {!! Form::textarea('body', null, array('class'=> 'form-control', 'placeholder' => 'Escrever comentário', 'required' => '')) !!}
      {!! Form::submit('Enviar', ['class' => 'read-more btn-block btn comment-btn']) !!}
      {!! Form::close() !!}
    </div>
  @endif
</div>
