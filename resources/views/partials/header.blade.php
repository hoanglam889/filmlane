<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FilmLane - Movie Streaming Website</title>
    
    @yield('bootstrap')

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
  </head>
  <body>
    <header>
      <nav class="site-navbar">
        <div class="logo">
          <a href="/"><img src="{{ asset('images/logo.svg') }}" alt="" /></a>
        </div>

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" id="liveSearch" placeholder="Tìm kiếm phim..." autocomplete="off">
            <div class="search-dropdown" id="searchDropdown"></div>
        </div>

        <ul class="site-nav-list">
          <div class="logo">
              <a href=""><img src="{{ asset('images/logo.svg') }}" alt=""></a>
              <button class="close"><i class="fa-solid fa-xmark"></i></button>
          </div>
          
          <li class="home"><a href="/">Home</a></li>
          
          <li class="has-dropdown">
              <a href="javascript:void(0)">Thể loại <i class="fa-solid fa-angle-down" style="font-size: 12px; margin-left: 3px;"></i></a>
              <ul class="dropdown-menu">
                  @if(isset($categories) && $categories->count() > 0)
                      @foreach($categories as $cate)
                          <li><a href="/the-loai/{{ $cate->slug }}">{{ $cate->title }}</a></li>
                      @endforeach
                  @else
                      <li><a href="">Hành Động</a></li>
                      <li><a href="#">Tình Cảm</a></li>
                      <li><a href="#">Kinh Dị</a></li>
                  @endif
              </ul>
          </li>

          <li class="has-dropdown">
              <a href="javascript:void(0)">Quốc gia <i class="fa-solid fa-angle-down" style="font-size: 12px; margin-left: 3px;"></i></a>
              <ul class="dropdown-menu">
                  @if(isset($countries) && $countries->count() > 0)
                      @foreach($countries as $country)
                          <li><a href="/quoc-gia/{{ $country->slug }}">{{ $country->title }}</a></li>
                      @endforeach
                  @else
                      <li><a href="#">Việt Nam</a></li>
                      <li><a href="#">Hàn Quốc</a></li>
                      <li><a href="#">Mỹ</a></li>
                  @endif
              </ul>
          </li>

          <li><a href="/phim-le">Phim lẻ</a></li>
          <li><a href="/phim-bo">Phim bộ</a></li>
          
          <a href="{{ url('/login')}}"><button class="site-btn">SIGN IN</button></a>
      </ul>
        <div class="hamburger">
          <div class="line"></div>
          <div class="line"></div>
          <div class="line"></div>
        </div>
      </nav>
    </header>