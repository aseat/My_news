@component('components.header')
@endcomponent

<div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
           
            <img src="{{ $post->image_path }}" alt="画像">
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
                <div class="btn-group">
                {{ Form::open(['method' => 'delete', 'route' => ['post.delete', $post->id]]) }}
                {{ Form::button('<a class="btn btn-sm btn-outline-secondary">削除</a>', ['class' => "btn", 'type' => 'submit']) }}
                {{ Form::close() }}
              @endif
                @endauth
              </div> 
              <div>
                @auth
                @if( ( $post->user_id ) !== ( Auth::user()->id ) )
                @if($post->is_liked_by_auth_user())
                  <a href="{{ route('post.unlike', ['id' => $post->id]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                
                @else
                  <a href="{{ route('post.like', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                
                  @endif
                  @endif
                  @endauth

           </div>
            </div> 
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <small class="text-muted">{{ $post->created_at->format('Y/m/d') }}</small>
                </div>
                <div class="btn-group">
                <small class="text-muted">投稿者:{{ $post->user->name }}</small>
              </div>
              </div>
            </div>
          </div>
        </div>
