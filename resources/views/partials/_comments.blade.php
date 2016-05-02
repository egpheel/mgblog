<div class="comments-wrap">
  <h2>Comentários</h2>
  <div class="single-comment-wrap">
    <div class="single-comment">
      <div class="img">
        <img src="/img/avatar.png">
      </div>
      <div class="info">
        <div class="name">
          Utilizador
        </div>
        <div class="date">
          &#8211; <time>01/05/2016, 17:00</time>
        </div>
        <div class="comment">
          Isto é um comentário de teste. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </div>
    </div>

    <div class="single-comment">
      <div class="img">
        <img src="/img/avatar.png">
      </div>
      <div class="info">
        <div class="name">
          Utilizador
        </div>
        <div class="date">
          &#8211; <time>01/05/2016, 17:28</time>
        </div>
        <div class="comment">
          Outro comentário de teste.
        </div>
      </div>
    </div>
  </div>
  <div class="comment-form">
    {!! Form::open(['route' => 'comments.store', 'data-parsley-validate' => '']) !!}
    {!! Form::textarea('body', null, array('class'=> 'form-control', 'placeholder' => 'Escrever comentário', 'required' => '')) !!}
    {!! Form::submit('Enviar', ['class' => 'read-more btn-block btn']) !!}
    {!! Form::close() !!}
  </div>
</div>
