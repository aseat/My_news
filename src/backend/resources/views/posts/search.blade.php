{{ Form::open(['method' => 'get']) }}
  {{ csrf_field() }}
  {{ Form::text('keyword', null, ['placeholder'=>'記事を検索できます']) }}
  {{ Form::submit('検索', ['class' => 'btn btn-sm btn-outline-secondary']) }}
  <a href="/" class="btn btn-sm btn-outline-secondary">キャンセル</a>
{{ Form::close() }}