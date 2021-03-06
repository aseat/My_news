<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>My News</title>

    <link rel="canonical" href="https://getbootstrap.jp/docs/5.0/examples/album/">

    

<link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
  </head>
  <body>
    
<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">撮影者や撮影した背景など、アルバムに関する情報を追加しましょう。いくつかの文を書いておくと、友達が写真を選ぶ手助けになるかもしれません。また、写真は SNS や連絡先へとリンクしておきましょう。</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">Twitter でフォローする</a></li>
            <li><a href="#" class="text-white">Facebook でいいねする</a></li>
            <li><a href="#" class="text-white">Email を送る</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark  shadow-sm" style="background-color: #0000ff;">

    <div class="container">
      <a href="/" class="navbar-brand d-flex align-items-center">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><img src="/images/browser.png" style="height: 30px; width: 30px;"></svg>
        <strong><img src="/images/mynews.png" style="height: 32px; width: 102px;"></strong>
      </a>
      
      @guest
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
      <div class="col-4 d-flex justify-content-end align-items-center">
         <a class="btn btn-sm btn-outline-secondary" href="register" style="color: #ffffff; border-color: #ffffff;">新規登録</a>
         <a class="btn btn-sm btn-outline-secondary" href="login" style="color: #ffffff; border-color: #ffffff;">ログイン</a>
         <a class="btn btn-sm btn-outline-secondary" href="guest" style="color: #ffffff; border-color: #ffffff;">ゲストログイン</a>

   
         @else
         <div class="col-4 d-flex justify-content-end align-items-center"> 
      <a class="btn" style="color: #ffffff;">{{ Auth::user()->name }}さん</a> 
      <a class="btn btn-sm btn-outline-secondary" href="{{ route("post.new") }}" style="color: #ffffff; border-color: #ffffff;">新規投稿</a>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" style="color: #ffffff; border-color: #ffffff;">
            {{ ('ログアウト') }} 
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        @endguest
      
      </button>
    </div>
  </div>
</header>