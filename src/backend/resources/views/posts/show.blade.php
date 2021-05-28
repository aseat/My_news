@component('components.header')
@endcomponent


<div class="album py-5 bg-light">
    <div class="container">
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
      <p class="card-text" style="text-align: center; font-size: 30px;"><b>{{ $post->title }}</b></p>
      <div class="row" style="width: 80%; margin-left: auto; margin-right: auto;">
        <div class="col">
          <div class="card shadow-sm" style="border-radius: 10px 10px 10px 10px; background-color: #fff0f5;">
            @if($post->image_path == null)
            @else
            <img src="{{ $post->image_path }}" alt="画像" style="border-radius: 10px 10px 0px 0px;">
        @endif
            <div class="card-body">
              <b><p class="card-text" style="font-size: 20px">今日の出来事</p></b>
              
              <p class="card-text"></p>
              <example-component><p class="card-text">{{ $post->text }}</example-component></p>
              
              @auth
              @if( ( $post->user_id ) !== ( Auth::user()->id ) )
              @if($post->is_liked_by_auth_user())
                <a href="{{ route('post.unlike', ['id' => $post->id]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
               
              @else
                <a href="{{ route('post.like', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
               
                @endif
                @endif
                @endauth
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
            </div>
            <div>
              

         </div> 

          
            </div> 
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <small class="text-muted">投稿日時：{{ $post->created_at->format('Y/m/d') }}</small>
                </div>
                <div class="btn-group">
                <small class="text-muted">投稿者：{{ $post->user->name }}</small>
              </div>
              </div>
            </div>
          </div>
        </div>
