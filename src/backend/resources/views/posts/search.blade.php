{{ Form::open(['method' => 'get']) }}
  {{ csrf_field() }}

  <div class='form-group'>
    {{ Form::label('keyword', 'タイトル：') }}
    {{ Form::text('keyword', null, ['class' => 'form-control' ,'style' => "width: 526px;"], ['placeholder'=>'キーワードから記事を検索できます']) }}
    
    {{ Form::submit('検索', ['class' => 'btn btn-outline-primary']) }}
    <a href='{{ route("post.list") }}'>クリア</a>
  </div>
{{ Form::close() }}