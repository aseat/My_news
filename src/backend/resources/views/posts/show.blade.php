@component('components.header')
@endcomponent

<div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
          
            <div class="card-body">
              <p class="card-text">{{ $post->title }}</p>
              <p class="card-text">{{ $post->text }}</p>
              
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a type="button" class="btn btn-sm btn-outline-secondary" href='{{ route("post.list") }}'>戻る</a>
                  @auth
              @if( ( $post->user_id ) === ( Auth::user()->id ) )
                  <a type="button" class="btn btn-sm btn-outline-secondary" href='{{ route("post.edit", ["id" => $post->id]) }}'>編集</a>
                </div>
                {{ Form::open(['method' => 'delete', 'route' => ['post.delete', $post->id]]) }}
                {{ Form::button('<a class="btn btn-sm btn-outline-secondary">削除</a>', ['class' => "btn", 'type' => 'submit']) }}
                {{ Form::close() }}
              @endif
                @endauth
              </div>
                <small class="text-muted">{{ $post->created_at }}</small>
                <small class="text-muted">{{ $post->user_name }}</small>
                
              </div>
            </div>
          </div>
        </div>
