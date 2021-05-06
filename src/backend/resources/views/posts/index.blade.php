@component('components.header')
@endcomponent
<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">News</h1>
        <p class="lead text-muted">最近あった出来事を共有するサービスです！</p>
       
      </div>
    </div>
  </section>
      <h1 style="text-align: center;">新着投稿</h1>
      
      @include('posts/search')
  <div class="album py-5 bg-light">
    <div class="container">
     
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
     
        @foreach ($posts as $post)
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

            <div class="card-body">
              <a class="card-text" href="{{ route("post.show", ["id" =>  $post->id]) }}">{{ $post->title }}</a>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  
                </div>
                <small class="text-muted">{{ $post->created_at }}</small>
                <small class="text-muted">{{ $post->user_name }}</small>
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

