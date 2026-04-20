@include('partials.header')

<section class="top-movie same history-page">
  <div class="top-movie-main" style="padding: 0 15px;">

    {{-- Page Header --}}
    <div class="user-page-header">
        <h4><i class="fa fa-history"></i> Lịch sử xem phim</h4>
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
                    <span><i class="fa-solid fa-star" style="color:#e2d703;"></i> 8.5</span>
                </div>

                <div class="watched-at">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span>Xem gần nhất: {{ \Carbon\Carbon::parse($movie->pivot->updated_at)->diffForHumans() }}</span>
                </div>

                <div class="action-buttons">
                    <a href="{{ url('/movie-detail/' . $movie->slug) }}" class="btn-watch-cont">
                        <i class="fa-solid fa-play"></i>
                        <span>Xem tiếp</span>
                    </a>
                    <button class="btn-remove" data-movie-id="{{ $movie->id }}" title="Xóa khỏi lịch sử">
                        <i class="fa-solid fa-trash"></i>
                        <span>Xóa</span>
                    </button>
                </div>
            </div>
          </li>
        @empty
          <div class="empty-state">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <h5>Bạn chưa xem bộ phim nào gần đây.</h5>
            <a href="{{ url('/') }}">Khám phá phim ngay &rarr;</a>
          </div>
        @endforelse
    </ul>

  </div>
</section>

@include('partials.footer')

<button class="back-to-top"><i class="fa-solid fa-chevron-up"></i></button>

<script>
document.querySelectorAll('.btn-remove').forEach(btn => {
    btn.addEventListener('click', function () {
        const movieId = this.dataset.movieId;
        const card    = this.closest('.card-horizontal');
        const token   = document.querySelector('meta[name="csrf-token"]')?.content;

        fetch(`/user/remove-history/${movieId}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'success') {
                card.style.transition = 'opacity 0.3s, transform 0.3s';
                card.style.opacity    = '0';
                card.style.transform  = 'translateX(20px)';
                setTimeout(() => {
                    card.remove();
                    const remaining = document.querySelectorAll('.card-horizontal').length;
                    const badge = document.querySelector('.count-badge');
                    if (badge) badge.textContent = remaining > 0 ? `${remaining} phim` : '';
                    if (remaining === 0) {
                        document.querySelector('.list-layout').innerHTML = `
                            <div class="empty-state">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <h5>Bạn chưa xem bộ phim nào gần đây.</h5>
                                <a href="/">Khám phá phim ngay &rarr;</a>
                            </div>`;
                    }
                }, 300);
            }
        })
        .catch(err => console.error('Lỗi xóa lịch sử:', err));
    });
});
</script>

<script src="{{ asset('js/navbar.js')}}"></script>