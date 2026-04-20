<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>FilmLane - Movie Streaming Website</title>
    
    @yield('bootstrap')

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/user.css') }}" />

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
          
          @if(Auth::check())
    <li class="user-menu-dropdown">
        <button class="btn-user-logged" id="userMobileBtn"> 
            @if(Auth::user()->avatar)
                <img src="{{ asset(Auth::user()->avatar) }}" alt="avatar" class="user-avatar-img">
            @else
                <i class="fa fa-user-circle" style="color: #e2d703; font-size: 20px;"></i> 
            @endif
            
            <span>{{ Auth::user()->name }}</span>
            <i class="fa fa-angle-down" style="font-size: 12px; opacity: 0.6;"></i>
        </button>
        
        <div class="dropdown-content" id="userDropdownContent"> 
            @if(Auth::user()->role == 1)
                <a href="{{ route('indexAdmin') }}"><i class="fa fa-dashboard"></i> Quản trị</a>
            @endif
            
            <a href="{{ route('profile.edit') }}"><i class="fa fa-id-card"></i> Thông tin cá nhân</a>
            <a href="{{ route('favorites') }}"><i class="fa fa-heart"></i> Phim đã thích</a>
            <a href="{{ route('history') }}"><i class="fa fa-history"></i> Lịch sử xem phim</a>
            
            <hr style="border-color: #333; margin: 5px 0;">
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fa fa-sign-out"></i> Đăng xuất
                </a>
            </form>
        </div>
    </li>
@else
    <li><a href="{{ route('login') }}" class="site-btn">Đăng nhập</a></li>
@endif
          
      </ul>
        <div class="hamburger">
          <div class="line"></div>
          <div class="line"></div>
          <div class="line"></div>
        </div>
      </nav>
    </header>