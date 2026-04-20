@include('partials.header')

<section class="top-movie same favorites-page">
  <div class="top-movie-main" style="padding: 0 15px;">

    {{-- Page Header --}}
    <div class="user-page-header">
        <h4><i class="fa fa-heart"></i> Phim đã thích</h4>
        @if($movies->count() > 0)
            <span class="count-badge">{{ $movies->count() }} phim</span>
        @endif
    </div>

    {{-- Card List --}}
    <ul class="list-layout">
        @forelse ($movies as $movie)
          <li class="card-horizontal">
            <a href="{{ url('/movie-detail/' . $movie->slug) }}" class="full-card-link" title="Xem phim {{ $movie->title }}"></a>

            <div class="img-box">
                <img src="{{ asset($movie->image) }}" alt="{{ $movie->title }}" />
            </div>

            <div class="info-box">
                <div class="top-info">
                    <h4>{{ $movie->title }}</h4>
                    <span class="year">
                        <i class="fa-solid fa-calendar-days" style="color:#e2d703; margin-right:4px;"></i>
                        {{ $movie->year }}
                    </span>
                </div>

                <div class="meta-info">
                    <span class="quality">{{ $movie->resolution ?? 'HD' }}</span>
                    <span><i class="fa-regular fa-clock"></i> 120 min</span>
                    <span class="rating"><i class="fa-solid fa-star" style="color:#e2d703;"></i> 8.5</span>
                </div>

                <p class="description" style="color:#888; font-size:13px; margin:0;">
                    Đã thích: {{ \Carbon\Carbon::parse($movie->pivot->created_at)->format('d/m/Y') }}
                </p>

                <div class="action-buttons">
                    <button class="btn-remove" data-movie-id="{{ $movie->id }}" title="Xóa khỏi danh sách">
                        <i class="fa-solid fa-trash"></i>
                        <span>Bỏ thích</span>
                    </button>
                </div>
            </div>
          </li>
        @empty
          <div class="empty-state">
            <i class="fa-regular fa-heart"></i>
            <h5>Danh sách trống.</h5>
            <a href="{{ url('/') }}">Khám phá phim ngay &rarr;</a>
          </div>
        @endforelse
    </ul>

  </div>
</section>

@include('partials.footer')

<button class="back-to-top"><i class="fa-solid fa-chevron-up"></i></button>

<script src="{{ asset('js/script.js')}}"></script>
<script src="{{ asset('js/navbar.js')}}"></script>