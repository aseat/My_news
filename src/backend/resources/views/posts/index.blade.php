@component('components.header')
@endcomponent
<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">MyNews</h1>
        <p class="lead text-muted">最近あった出来事を共有するサービスです！</p>
       
      </div>
    </div>
  </section>
 
      
  <div class="album py-5 bg-light">
    <div class="container">
      <h1 style="text-align: center;">@include('posts/search')</h1>
      <p>  
      <h1 style="text-align: center;">  新着投稿</h1>
      <p>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
     
        @foreach ($posts as $post)
        <div class="col">
          <div class="card shadow-sm">
        
            <img src="{{ $post->image_path }}" alt="画像">
            <div class="card-body">
              <a class="card-text" href="{{ route("post.show", ["id" =>  $post->id]) }}">{{ $post->title }}</a>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <small class="text-muted">{{ $post->created_at->format('Y/m/d')  }}</small>
                </div>
                <small class="text-muted">投稿者:{{ $post->user->name }}</small>
                
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

