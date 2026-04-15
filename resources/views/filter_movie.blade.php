@include('partials.header')

<section class="top-movie same category-page" style="padding-top: 60px; padding-bottom: 80px; min-height: 80vh; background-color: #11141d;">
  <div class="header" style="margin-bottom: 40px;">
    <small style="color: #e2d703;">Danh sách phim</small>
    <h4 style="color: #fff; font-size: 36px;">Thể loại: {{ $category_name ?? 'Đang cập nhật' }}</h4>
  </div>

  <div class="top-movie-main">
    <div class="movie-card">
      <ul class="wrapper grid-layout">

        @forelse ($movies as $movie) 
          <li class="card">
            <div class="img">
              <a href="{{ url('/movie-detail/' . $movie->slug) }}">
                <img src="{{ asset($movie->image) }}" alt="{{ $movie->title }}" />
              </a>
            </div>
            <div class="title">
              <a href="{{ url('/movie-detail/' . $movie->slug) }}">
                <h4>{{ $movie->title }}</h4>
              </a>
              <span>{{ $movie->year }}</span>
            </div>
            <div class="footer">
              <div class="left-content">
                <span>{{ $movie->resolution ?? 'HD' }}</span>
                <div class="time-rating">
                  <span><i class="fa-regular fa-clock"></i> 120 min</span>
                  <span><i class="fa-solid fa-star"></i> 8.5</span>
                </div>
              </div>
              <button class="like-btn" data-movie-id="{{ $movie->id }}" title="Lưu phim này">
                <i class="fa-regular fa-heart"></i>
              </button>
            </div>
          </li>
        @empty
          <div style="width: 100%; text-align: center; padding: 50px 0;">
            <i class="fa-solid fa-film" style="font-size: 50px; color: #333; margin-bottom: 20px;"></i>
            <h5 style="color: #ccc;">Hiện chưa có phim nào thuộc thể loại này.</h5>
          </div>
        @endforelse

      </ul>
    </div>
  </div>
</section>

@include('partials.footer')

<button class="back-to-top"><i class="fa-solid fa-chevron-up"></i></button>

<script src="{{ asset('js/script.js')}}"></script>
<script src="{{ asset('js/navbar.js')}}"></script>


</body>
</html>