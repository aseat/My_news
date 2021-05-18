@component('components.header')
@endcomponent
<main>
<div class="album py-5 bg-light">
    <div class="container" >
      <h1 style="text-align: center; font-size: 20px;">@include('posts/search')</h1>
      <p>  
      <h1 style="text-align: center; font-family: Impact;">📰新着記事</h1>
      <p>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
     
        @foreach ($posts as $post)
        <div class="col">
          <div class="card shadow-sm" style="border-radius: 10px 10px 10px 10px; background-color: #FEDCBD;">
            <img src="{{ $post->image_path }}" alt="画像" style="border-radius: 10px 10px 0px 0px;" >
            <div class="card-body">
             <p style="font-size: 30px;">{{ $post->title }}</p>
              <a class="card-text" style="text-decoration: none;" href="{{ route("post.show", ["id" =>  $post->id]) }}" >>>続きを読む</a>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <small class="text-muted">投稿日時：{{ $post->created_at->format('Y/m/d')  }}</small>
                </div>
                <small class="text-muted">投稿者：{{ $post->user->name }}</small>
                
              </div>
            </div>
          </div>
        </div>
        @endforeach
        </div>
      </div>
    </div>
  </div>

</main>

