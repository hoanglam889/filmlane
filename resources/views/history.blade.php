@include('partials.header')

<section class="top-movie same history-page" style="padding-top: 60px; padding-bottom: 80px; min-height: 80vh; background-color: #11141d;">
  <div class="header" style="margin-bottom: 40px; padding: 0 30px;">
    <small style="color: #e2d703;">Tài khoản của tôi</small>
    <h4 style="color: #fff; font-size: 36px;">Lịch sử xem phim</h4>
  </div>

  <div class="top-movie-main" style="padding: 0 30px;">
    <div class="movie-card">
      <ul class="wrapper list-layout">

        @forelse ($movies as $movie) 
          <li class="card-horizontal">
            <div class="img-box">
                <a href="{{ url('/movie-detail/' . $movie->slug) }}">
                    <img src="{{ asset($movie->image) }}" alt="{{ $movie->title }}" />
                </a>
            </div>

            <div class="info-box">
                <div class="top-info">
                    <a href="{{ url('/movie-detail/' . $movie->slug) }}">
                        <h4 style="color: #fff; font-size: 22px; margin-bottom: 5px;">{{ $movie->title }}</h4>
                    </a>
                    <span class="year" style="color: #888; font-size: 14px;">{{ $movie->year }}</span>
                </div>
                
                <div class="meta-info" style="display: flex; gap: 15px; color: #ccc; font-size: 13px; margin: 10px 0;">
                    <span class="quality" style="border: 1px solid #e2d703; color: #e2d703; padding: 2px 6px; border-radius: 4px;">{{ $movie->resolution ?? 'HD' }}</span>
                    <span><i class="fa-regular fa-clock"></i> 120 min</span>
                    <span class="rating"><i class="fa-solid fa-star" style="color: #e2d703;"></i> 8.5</span>
                </div>

                <p class="description" style="color: #888; font-size: 14px; margin-bottom: 15px;">
                    Xem gần nhất: {{ $movie->pivot->updated_at->diffForHumans() ?? 'Vừa xong' }}
                </p>

                <div class="action-buttons" style="display: flex; gap: 15px; margin-top: auto;">
                    <a href="{{ url('/movie-detail/' . $movie->slug) }}" class="btn-watch" style="background-color: #e2d703; color: #111; padding: 8px 20px; border-radius: 5px; text-decoration: none; font-weight: 600; font-size: 14px;">
                        <i class="fa-solid fa-play"></i> Xem tiếp
                    </a>
                    <button class="btn-remove" data-movie-id="{{ $movie->id }}" style="background-color: transparent; color: #ff4d4d; border: 1px solid #ff4d4d; padding: 8px 20px; border-radius: 5px; cursor: pointer; font-weight: 600;">
                        <i class="fa-solid fa-trash"></i> Xóa lịch sử
                    </button>
                </div>
            </div>
          </li>
        @empty
          <div style="width: 100%; text-align: center; padding: 100px 0;">
            <i class="fa-solid fa-clock-rotate-left" style="font-size: 60px; color: #333; margin-bottom: 20px;"></i>
            <h5 style="color: #ccc; font-size: 18px;">Bạn chưa xem bộ phim nào gần đây.</h5>
            <a href="{{ url('/') }}" style="color: #e2d703; text-decoration: none; margin-top: 10px; display: inline-block;">Quay lại trang chủ để khám phá phim ngay!</a>
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