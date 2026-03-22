@section('bootstrap')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@include('partials.header')

    <section class="movie-detail">
        <div class="main">
            <div class="img">
                <a href=""><img src="{{ asset($movie -> image) }}" alt=""></a>
                <i class="fa-regular fa-circle-play" 
                  data-bs-toggle="modal" 
                  data-bs-target="#movieModal" 
                  style="cursor: pointer; z-index: 3;">
                </i>
            </div>
            <div class="content">
                <strong>New Episodes</strong>
                <h4>{{ $movie -> title}}</h4>
                <div class="badge-genre">
                    <div class="badge">
                        <span>PG 13</span>
                        <span>{{ $movie -> resolution}}  </span>
                    </div>
                    <div class="genre">
                        <a href="">Comedy</a>,
                        <a href="">Action</a>,
                        <a href="">Adventure</a>,
                        <a href="">Science Fiction</a>
                    </div>
                </div>
                <div class="date-time">
                    <span><i class="fa-solid fa-calendar-days"></i> {{ $movie -> year}}</span>
                    <span><i class="fa-regular fa-clock"></i> 115 min</span>
                </div>
                <p>{{ $movie -> description}}</p>
                <div class="detail-actions">
                  <button>
                    <i class="bi bi-share-fill"></i>
                    <span>Share</span>
                  </button>
                  <div class="prime">
                    <h5>Prime Video</h5>
                    <small>Streaming Channels</small>
                  </div>
                  <div class="btn">
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#movieModal"><i class="fa-solid fa-play"></i> Xem phim</button>
                  </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .movie-detail{ background: url(../images/movie-detail-bg.png) no-repeat; background-size: cover; background-position: center; padding: 100px 30px; }
        .movie-detail .main{ display: flex; align-items: center; gap: 3rem; }
        .movie-detail .img{ position: relative; }
        .movie-detail .img i{ position: absolute; left: 36%; top: 39%; font-size: 80px; color: #fff; }
        .movie-detail .main .img img{ width: 300px; border-radius: 6px; }
        .movie-detail .content{ max-width: 600px; }
        .movie-detail .content strong{ font-size: 25px; font-weight: 800; color: #e2d703; }
        .movie-detail .content h4{ font-size: 50px; font-weight: 700; color: #fff; margin: 0.5rem 0rem; }
        .movie-detail .content h4 span{ color: #e2d703; }
        .movie-detail .content .badge-genre{ display: flex; align-items: center; flex-wrap: wrap; gap: 1.5rem; color: #fff; }
        .movie-detail .badge-genre .badge span:nth-child(1){ background-color: #fff; color: black; font-size: 13px; font-weight: 800; padding: 4px 10px; margin-right: 0.5rem; }
        .movie-detail .badge-genre .badge span:nth-child(2){ border: 2px solid #fff; font-size: 13px; font-weight: 700; padding: 2px 10px; }
        .movie-detail .badge-genre .genre a{ text-decoration: none; color: #cecaca; font-size: 14px; font-weight: 600; transition: 0.3s ease-in-out; }
        .movie-detail .badge-genre .genre a:hover{ color: #e2d703; }
        .movie-detail .date-time{ display: flex; gap: 1rem; margin-top: 1rem; }
        .movie-detail .date-time span{ color: #cecaca; font-size: 14px; font-weight: 500; }
        .movie-detail .date-time i{ color: #e2d703; }
        .movie-detail .content p{ color: #cecaca; margin-top: 1.5rem; font-size: 14px; font-weight: 500; }
        .movie-detail .content .detail-actions{ display: flex; padding: 25px; margin-top: 2.5rem; flex-wrap: wrap ; align-items: center; border-radius: 5px; justify-content: center; gap: 2rem; max-width: 400px; background-color: #242c38; border: 1px solid #333333; }
        .movie-detail .detail-actions button{ display: flex; flex-direction: column; align-items: center; background-color: transparent; cursor: pointer; border: none; }
        .movie-detail .detail-actions button:hover span{ color: #e2d703; }
        .movie-detail .detail-actions button i{ color: #fff; font-size: 20px; }
        .movie-detail .detail-actions button span{ transition: 0.3s ease-in-out; color: #cecaca; font-size: 12px; }
        .movie-detail .detail-actions .prime h5{ color: #fff; font-size: 16px; }
        .movie-detail .detail-actions .prime small{ color: #cecaca; font-size: 12px; }
        .movie-detail .detail-actions .btn button{ display: flex; flex-direction: row; gap: 1rem; background-color: transparent; color: #fff; font-size: 11px; text-transform: uppercase; font-weight: 600; border: 2px solid #e2d703; border-radius: 30px; transition: 0.3s ease-in-out; padding: 13px 30px; }
        .movie-detail .detail-actions .btn button:hover{ background-color: #e2d703; color: #242c38; font-weight: 700; }
        .movie-detail .detail-actions .btn button:hover i{ color: #242c38; }
        .movie-detail .detail-actions .btn button i{ font-size: 13px; transition: 0.3s ease-in-out; }

        .player-wrapper { width: 100%; background: #000; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        #player { width: 100%; aspect-ratio: 16/9; object-fit: contain; display: block; }
        .episode-list { width: 100%; max-height: 450px; overflow-y: auto; padding-right: 5px; }
        .episode-btn { display: block; width: 100%; margin-bottom: 10px; padding: 12px 15px; background: #242c38; border: 1px solid #333; color: #fff; border-radius: 6px; transition: all 0.3s ease; text-align: left; cursor: pointer; font-size: 14px; }
        .episode-btn:hover { background: #3a4556; }
        .episode-btn.active { background: #e2d703; color: #111; font-weight: 700; border-color: #e2d703; }
        .episode-list::-webkit-scrollbar { width: 5px; }
        .episode-list::-webkit-scrollbar-thumb { background: #666; border-radius: 10px; }
        .episode-list::-webkit-scrollbar-track { background: transparent; }
        .video-container { height: 100vh; }
        .episode-sidebar { height: 100vh; }
        .server-tab-custom { background-color: #3f3f46; }
        .close-btn-custom { opacity: 0.8; }

        /* ================= BẮT BUỘC CÓ ĐỂ FIX LỖI MODAL MOBILE ================= */
        @media (max-width: 991.98px) {
            .modal-fullscreen .row { flex-direction: column !important; flex-wrap: nowrap !important; background-color: #000; }
            .video-container { height: auto !important; aspect-ratio: 16/9; width: 100%; flex: 0 0 auto !important; }
            .video-container > .btn-close.position-absolute { display: none !important; }
            .episode-sidebar { height: auto !important; flex: 1 1 auto !important; width: 100%; background-color: #262626 !important; border-top-left-radius: 16px; border-top-right-radius: 16px; border-left: none; padding-top: 10px; overflow: hidden; }
            .close-btn-custom { border: 2px solid #0d6efd !important; border-radius: 50%; padding: 8px !important; opacity: 1; transform: scale(0.85); }
            .episode-btn { border-radius: 8px; font-weight: 600; }
            .episode-btn.active { background-color: #007bff; border-color: #007bff; color: #fff;}
        }
    </style>

    <div class="modal fade" id="movieModal" tabindex="-1">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark border-0 rounded-0">
          
          <div class="modal-body p-0 overflow-hidden">
            <div class="row g-0 h-100">
              
              <div class="col-lg-9 col-xl-9 col-12 video-container bg-black position-relative d-flex flex-column justify-content-center h-100">
            
                <div class="player-wrapper w-100 h-100 d-flex align-items-center justify-content-center">
                  <iframe id="player" 
                          src="{{ $episodes[0]->link_embed ?? '' }}" 
                          width="100%" 
                          height="100%" 
                          frameborder="0" 
                          allow="autoplay; fullscreen" 
                          allowfullscreen 
                          style="background: black;">
                  </iframe>
                </div>
              </div>

              <div class="col-lg-3 col-xl-3 col-12 episode-sidebar d-flex flex-column h-100">
                <div class="sidebar-header d-flex justify-content-between align-items-start p-3 p-lg-4 pb-2">
                  <div>
                    <h5 class="text-white fw-bold mb-1">
                      <span class="d-lg-none">Danh sách tập phim - </span>{{ $movie->title }}
                    </h5>
                    <small class="text-secondary">{{ count($episodes) }} Tập</small>
                  </div>
                  <button type="button" class="btn-close btn-close-white close-btn-custom" data-bs-dismiss="modal"></button>
                </div>

                <div class="px-3 px-lg-4 mb-3 mt-2">
                  <div class="server-tab-custom d-inline-flex align-items-center px-3 py-2 rounded">
                      <i class="fa-regular fa-circle-play text-white me-2 d-none d-lg-inline"></i> <span class="text-white fw-semibold me-2" style="font-size: 14px;">Vietsub #1</span>
                      <span class="badge" style="background-color: #5a4b33; color: #f3b23e;">1 Link</span>
                  </div>
                </div>

                <div class="episode-grid px-3 px-lg-4 pb-4 flex-grow-1 overflow-auto" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; align-content: start;">
                  @foreach($episodes as $index => $ep)
                    <button 
                      class="episode-btn {{ $index == 0 ? 'active' : '' }}"
                      onclick="changeVideo('{{ $ep->video_link }}', this)">
                      {{ $ep->episode_number == 'Full' ? 'Full' : $ep->episode_number }} 
                    </button>
                  @endforeach
                </div>

                <div class="d-lg-none text-end px-4 pb-3 mt-auto">
                  <span class="text-danger" style="cursor: pointer; font-size: 15px;" data-bs-dismiss="modal">Đóng</span>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>

    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/player.js') }}"></script>
    <script src="{{ asset('js/navbar.js')}}"></script>

  </body>
</html>