@component('components.header')
@endcomponent
<main>

  

      <img src="/images/4353519_m.jpg" style="height: 70vh; width: 100%;">
      <div class="col-lg-6 col-md-8 mx-auto">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <h1 class="fw-light" style="position: absolute;
        color: #39f520;
        top: 0;
        left: 0;
        top: 40%;
        left: 50%;
        -ms-transform: translate(-50%,-50%);
        -webkit-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);
        margin:0;
        padding:0;
        text-align: center;
        font-size: 120vh;
        text-shadow: 3px 4px 5px #808080;
        font-size: 7.5vw;">MyNews</h1>
        <p>
        <h1 class="fw-light" style="position: absolute;
        color: #39f520;
        top: 0;
        left: 0;
        top: 55%;
        left: 50%;
        -ms-transform: translate(-50%,-50%);
        -webkit-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);
        margin:0;
        padding:0;
        text-align: center;
        font-size: 40vh;
        width: 1000vh;
        text-shadow: 3px 4px 5px #808080;
        font-size: 2.5vw;">最近の出来事や話題を共有するサイト</h1>
      
       
      </div>
   
 
 
      
  <div class="album py-5 bg-light">
    <div class="container">
      <h1 style="text-align: center; font-size: 20px;">@include('posts/search')</h1>
      <p>  
      <h1 style="text-align: center;"> 新着記事</h1>
      <p>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
     
        @foreach ($posts as $post)
        <div class="col">
          <div class="card shadow-sm">
            <img src="{{ $post->image_path }}" alt="画像" >
            <div class="card-body">
              {{ $post->title }}
            <p>
              <a class="card-text" href="{{ route("post.show", ["id" =>  $post->id]) }}">続きを読む</a>
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

