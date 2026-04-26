@section('bootstrap')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Thêm meta token ở đây cho chắc cú nếu header sếp lỗi --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@include('partials.header')

    <section class="movie-detail">
        <div class="main">
            <div class="img">
                <a href=""><img src="{{ asset($movie->image) }}" alt=""></a>
                {{-- FIX 1: Thêm class btn-save-history và data-movie-id vào icon tròn --}}
                <i class="fa-regular fa-circle-play btn-save-history" 
                  data-movie-id="{{ $movie->id }}"
                  data-bs-toggle="modal" 
                  data-bs-target="#movieModal" 
                  style="cursor: pointer; z-index: 3;">
                </i>
            </div>
            <div class="content">
                <strong>New Episodes</strong>
                <h4>{{ $movie->title }}</h4>
                <div class="badge-genre">
                    <div class="badge">
                        <span>PG 13</span>
                        <span>{{ $movie->resolution }}  </span>
                    </div>
                    <div class="genre">
                        <a href="">Comedy</a>,
                        <a href="">Action</a>,
                        <a href="">Adventure</a>,
                        <a href="">Science Fiction</a>
                    </div>
                </div>
                <div class="date-time">
                    <span><i class="fa-solid fa-calendar-days"></i> {{ $movie->year }}</span>
                    <span><i class="fa-solid fa-eye"></i> {{ number_format($movie->views) }} views</span>
                </div>
                <p>{{ $movie->description }}</p>
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
                      {{-- FIX 2: Nút đỏ đã có class và data-id --}}
                      <button class="btn btn-danger btn-save-history" 
                              data-movie-id="{{ $movie->id }}" 
                              data-bs-toggle="modal" 
                              data-bs-target="#movieModal">
                          <i class="fa-solid fa-play"></i> Xem phim
                      </button>
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
                          src="" 
                          width="100%" 
                          height="100%" 
                          frameborder="0" 
                          allow="autoplay; fullscreen" 
                          allowfullscreen 
                          style="background: black;"
                          data-first-src="{{ $episodes[0]->video_link ?? '' }}">
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
                  {{-- FIX 3: Server Tab cũng dán class btn-save-history --}}
                  <div class="server-tab-custom btn-save-history d-inline-flex align-items-center px-3 py-2 rounded" 
                       style="cursor: pointer;" 
                       data-movie-id="{{ $movie->id }}">
                    <i class="fa-regular fa-circle-play text-white me-2 d-none d-lg-inline"></i> 
                    <span class="text-white fw-semibold me-2" style="font-size: 14px;">Vietsub #1</span>
                    <span class="badge" style="background-color: #5a4b33; color: #f3b23e;">1 Link</span>
                  </div>
                </div>

                <div class="episode-grid px-3 px-lg-4 pb-4 flex-grow-1 overflow-auto" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; align-content: start;">
                  @foreach($episodes as $index => $ep)
                    <button 
                        class="episode-btn {{ $index == 0 ? 'active' : '' }}"
                        data-episode-id="{{ $ep->id }}"
                        onclick="changeVideo('{{ $ep->video_link }}', '{{ $ep->id }}', this)">
                        {{ $ep->episode_number }} 
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
    <!-- ============================================== -->
    <!-- BẮT ĐẦU KHU VỰC BÌNH LUẬN VÀ GỢI Ý PHIM          -->
    <!-- ============================================== -->
    <section class="comments-section-wrapper" style="background-color: #171d21; padding: 60px 0; border-top: 1px solid #2a343b;">
        <div class="container" style="max-width: 1200px;">
            <div class="row">
                
                <!-- CỘT TRÁI: BÌNH LUẬN -->
                <div class="col-lg-8 col-12 mb-5 mb-lg-0">
                    <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 20px; color: #fff;">Bình luận</h3>

                    @if(session('success'))
                        <div class="alert alert-success" style="background: rgba(226, 215, 3, 0.2); color: #e2d703; border: 1px solid #e2d703;">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger" style="background: rgba(220, 53, 69, 0.2); color: #ff6b6b; border: 1px solid #ff6b6b;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Form bình luận chính -->
                    @auth
                    <form class="ajax-comment-form" action="{{ route('comment.store', $movie->id) }}" method="POST" data-is-reply="0" style="margin-bottom: 30px;">
                        @csrf
                        <textarea name="content" placeholder="Viết bình luận của bạn..." rows="3" style="width: 100%; background: #11141d; border: 1px solid #2a343b; color: white; padding: 15px; border-radius: 6px; resize: none; font-size: 14px;" required></textarea>
                        <div style="text-align: right; margin-top: 10px;">
                            <button type="submit" style="background: #e2d703; color: #111; border: none; padding: 8px 24px; border-radius: 4px; font-weight: 600; font-size: 14px; cursor: pointer;">Đăng bình luận</button>
                        </div>
                    </form>
                    @else
                    <div style="background: #11141d; border: 1px solid #2a343b; border-radius: 6px; padding: 15px; margin-bottom: 30px; text-align: center;">
                        <p style="color: #cecaca; margin-bottom: 10px;">Vui lòng đăng nhập để bình luận.</p>
                        <a href="{{ url('login') }}" style="background: #e2d703; color: #111; padding: 8px 20px; border-radius: 4px; font-weight: 600; text-decoration: none; display: inline-block;">Đăng nhập</a>
                    </div>
                    @endauth

                    <!-- Danh sách bình luận -->
                    <div class="comments-list" id="comments-container">
                        @forelse($comments as $comment)
                        <!-- Comment Item -->
                        <div class="comment-item {{ $loop->index >= 5 ? 'd-none hidden-comment' : '' }}" id="comment-item-{{ $comment->id }}" style="background: #11141d; border: 1px solid #2a343b; border-radius: 6px; padding: 15px; margin-bottom: 12px;">
                            <div style="display: flex; gap: 15px;">
                                <div style="width: 38px; height: 38px; border-radius: 50%; background: #{{ substr(md5($comment->user->name), 0, 6) }}; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px; color: #fff; flex-shrink: 0;">
                                    {{ mb_strtoupper(mb_substr($comment->user->name, 0, 1)) }}
                                </div>
                                <div style="flex-grow: 1;">
                                    <div style="margin-bottom: 8px; display: flex; align-items: center; justify-content: space-between;">
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <strong style="font-size: 14px; color: #fff; line-height: 1;">{{ $comment->user->name }}</strong> 
                                            <span style="color: #cecaca; font-size: 12px; line-height: 1;">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        @if(Auth::check() && Auth::id() == $comment->user_id)
                                        <div class="dropdown">
                                            <button class="btn btn-link p-0 text-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" style="min-width: 100px; font-size: 13px;">
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="editComment({{ $comment->id }})"><i class="fa-solid fa-pen"></i> Sửa</a></li>
                                                <li><a class="dropdown-item text-danger" href="javascript:void(0)" onclick="deleteComment({{ $comment->id }})"><i class="fa-solid fa-trash"></i> Xóa</a></li>
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                    <div id="comment-content-{{ $comment->id }}" style="color: #cecaca; font-size: 14px; margin-bottom: 12px; line-height: 1.5;">{{ $comment->content }}</div>
                                    <button onclick="toggleReplyForm({{ $comment->id }})" style="background: transparent; border: 1px solid #444; color: #cecaca; padding: 3px 12px; border-radius: 4px; font-size: 12px; cursor: pointer; transition: 0.2s;" onmouseover="this.style.color='#e2d703'; this.style.borderColor='#e2d703';" onmouseout="this.style.color='#cecaca'; this.style.borderColor='#444';">Trả lời</button>
                                </div>
                            </div>

                            <!-- Hiển thị các replies -->
                            <div class="replies-list" id="replies-list-{{ $comment->id }}" style="margin-left: 53px; margin-top: 15px; border-left: 2px solid #2a343b; padding-left: 15px; {{ $comment->replies->count() > 0 ? '' : 'display: none;' }}">
                                @foreach($comment->replies as $reply)
                                <div class="reply-item" id="comment-item-{{ $reply->id }}" style="margin-bottom: 15px;">
                                    <div style="display: flex; gap: 12px;">
                                        <div style="width: 30px; height: 30px; border-radius: 50%; background: #{{ substr(md5($reply->user->name), 0, 6) }}; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 12px; color: #fff; flex-shrink: 0;">
                                            {{ mb_strtoupper(mb_substr($reply->user->name, 0, 1)) }}
                                        </div>
                                        <div style="flex-grow: 1;">
                                            <div style="margin-bottom: 5px; display: flex; align-items: center; justify-content: space-between;">
                                                <div style="display: flex; align-items: center; gap: 8px;">
                                                    <strong style="font-size: 13px; color: #fff; line-height: 1;">{{ $reply->user->name }}</strong> 
                                                    <span style="color: #cecaca; font-size: 11px; line-height: 1;">{{ $reply->created_at->diffForHumans() }}</span>
                                                </div>
                                                @if(Auth::check() && Auth::id() == $reply->user_id)
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0 text-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" style="min-width: 100px; font-size: 13px;">
                                                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="editComment({{ $reply->id }})"><i class="fa-solid fa-pen"></i> Sửa</a></li>
                                                        <li><a class="dropdown-item text-danger" href="javascript:void(0)" onclick="deleteComment({{ $reply->id }})"><i class="fa-solid fa-trash"></i> Xóa</a></li>
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>
                                            <div id="comment-content-{{ $reply->id }}" style="color: #cecaca; font-size: 13px; margin-bottom: 0; line-height: 1.4;">{{ $reply->content }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Form Reply ẩn -->
                            <div class="reply-form" id="reply-form-{{ $comment->id }}" style="display: none; margin-left: 53px; margin-top: 15px;">
                                @auth
                                <form class="ajax-comment-form" action="{{ route('comment.store', $movie->id) }}" method="POST" data-is-reply="1" data-parent-id="{{ $comment->id }}">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <textarea name="content" placeholder="Viết trả lời..." rows="2" style="width: 100%; background: #171d21; border: 1px solid #2a343b; color: white; padding: 10px; border-radius: 6px; resize: none; font-size: 13px;" required></textarea>
                                    <div style="text-align: right; margin-top: 8px;">
                                        <button type="submit" style="background: #e2d703; color: #111; border: none; padding: 6px 16px; border-radius: 4px; font-weight: 600; font-size: 12px; cursor: pointer;">Gửi</button>
                                    </div>
                                </form>
                                @else
                                <div style="background: #171d21; border: 1px solid #2a343b; border-radius: 6px; padding: 10px; text-align: center;">
                                    <span style="color: #cecaca; font-size: 13px;">Bạn cần <a href="{{ url('login') }}" style="color: #e2d703;">đăng nhập</a> để trả lời.</span>
                                </div>
                                @endauth
                            </div>
                        </div>
                        @empty
                        <div id="empty-comment-msg" style="text-align: center; color: #cecaca; padding: 20px 0;">
                            Chưa có bình luận nào. Hãy là người đầu tiên bình luận!
                        </div>
                        @endforelse
                        
                        @if($comments->count() > 5)
                        <div class="text-center mt-3" id="load-more-container">
                            <button id="btn-load-more-comments" style="background: transparent; border: 1px solid #e2d703; color: #e2d703; padding: 8px 24px; border-radius: 4px; font-weight: 600; font-size: 14px; cursor: pointer; transition: 0.3s;" onmouseover="this.style.background='#e2d703'; this.style.color='#111';" onmouseout="this.style.background='transparent'; this.style.color='#e2d703';" onclick="showMoreComments()">Xem thêm bình luận</button>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- CỘT PHẢI: GỢI Ý PHIM -->
                <div class="col-lg-4 col-12">
                    <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 20px; color: #fff;">Có thể bạn sẽ thích</h3>
                    <div class="suggested-movies-list">
                        
                        <!-- Phim gợi ý 1 -->
                        <div style="display: flex; gap: 15px; background: #11141d; border: 1px solid #2a343b; border-radius: 6px; padding: 10px; margin-bottom: 15px; cursor: pointer; transition: 0.3s;" onmouseover="this.style.borderColor='#e2d703'" onmouseout="this.style.borderColor='#2a343b'">
                            <img src="https://via.placeholder.com/80x110/242c38/cecaca?text=Phim+1" style="width: 70px; height: 100px; object-fit: cover; border-radius: 4px;" alt="movie">
                            <div style="display: flex; flex-direction: column; justify-content: center;">
                                <h4 style="color: #fff; font-size: 15px; margin-bottom: 5px; font-weight: 600;">The Dark Knight</h4>
                                <div style="color: #e2d703; font-size: 12px; margin-bottom: 5px;"><i class="fa-solid fa-star"></i> 9.0</div>
                                <div><span style="border: 1px solid #444; color: #cecaca; font-size: 11px; padding: 2px 6px; border-radius: 3px;">Hành Động</span></div>
                            </div>
                        </div>

                        <!-- Phim gợi ý 2 -->
                        <div style="display: flex; gap: 15px; background: #11141d; border: 1px solid #2a343b; border-radius: 6px; padding: 10px; margin-bottom: 15px; cursor: pointer; transition: 0.3s;" onmouseover="this.style.borderColor='#e2d703'" onmouseout="this.style.borderColor='#2a343b'">
                            <img src="https://via.placeholder.com/80x110/242c38/cecaca?text=Phim+2" style="width: 70px; height: 100px; object-fit: cover; border-radius: 4px;" alt="movie">
                            <div style="display: flex; flex-direction: column; justify-content: center;">
                                <h4 style="color: #fff; font-size: 15px; margin-bottom: 5px; font-weight: 600;">Inception</h4>
                                <div style="color: #e2d703; font-size: 12px; margin-bottom: 5px;"><i class="fa-solid fa-star"></i> 8.8</div>
                                <div><span style="border: 1px solid #444; color: #cecaca; font-size: 11px; padding: 2px 6px; border-radius: 3px;">Viễn Tưởng</span></div>
                            </div>
                        </div>

                        <!-- Phim gợi ý 3 -->
                        <div style="display: flex; gap: 15px; background: #11141d; border: 1px solid #2a343b; border-radius: 6px; padding: 10px; margin-bottom: 15px; cursor: pointer; transition: 0.3s;" onmouseover="this.style.borderColor='#e2d703'" onmouseout="this.style.borderColor='#2a343b'">
                            <img src="https://via.placeholder.com/80x110/242c38/cecaca?text=Phim+3" style="width: 70px; height: 100px; object-fit: cover; border-radius: 4px;" alt="movie">
                            <div style="display: flex; flex-direction: column; justify-content: center;">
                                <h4 style="color: #fff; font-size: 15px; margin-bottom: 5px; font-weight: 600;">Interstellar</h4>
                                <div style="color: #e2d703; font-size: 12px; margin-bottom: 5px;"><i class="fa-solid fa-star"></i> 8.6</div>
                                <div><span style="border: 1px solid #444; color: #cecaca; font-size: 11px; padding: 2px 6px; border-radius: 3px;">Khám Phá</span></div>
                            </div>
                        </div>

                        <!-- Phim gợi ý 4 -->
                        <div style="display: flex; gap: 15px; background: #11141d; border: 1px solid #2a343b; border-radius: 6px; padding: 10px; margin-bottom: 15px; cursor: pointer; transition: 0.3s;" onmouseover="this.style.borderColor='#e2d703'" onmouseout="this.style.borderColor='#2a343b'">
                            <img src="https://via.placeholder.com/80x110/242c38/cecaca?text=Phim+4" style="width: 70px; height: 100px; object-fit: cover; border-radius: 4px;" alt="movie">
                            <div style="display: flex; flex-direction: column; justify-content: center;">
                                <h4 style="color: #fff; font-size: 15px; margin-bottom: 5px; font-weight: 600;">Avengers</h4>
                                <div style="color: #e2d703; font-size: 12px; margin-bottom: 5px;"><i class="fa-solid fa-star"></i> 8.0</div>
                                <div><span style="border: 1px solid #444; color: #cecaca; font-size: 11px; padding: 2px 6px; border-radius: 3px;">Hành Động</span></div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        function toggleReplyForm(commentId) {
            let form = document.getElementById('reply-form-' + commentId);
            if (form) {
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }
        }

        function showMoreComments() {
            document.querySelectorAll('.hidden-comment').forEach(function(el) {
                el.classList.remove('d-none');
            });
            let loadMoreContainer = document.getElementById('load-more-container');
            if (loadMoreContainer) {
                loadMoreContainer.style.display = 'none';
            }
        }

        function handleAjaxSubmit(e) {
            e.preventDefault();
            e.stopPropagation();
            let form = e.target;
            let submitBtn = form.querySelector('button[type="submit"]');
            let originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Đang gửi...';
            submitBtn.disabled = true;

            let formData = new FormData(form);
            let actionUrl = form.getAttribute('action');
            let isReply = form.getAttribute('data-is-reply') === '1';
            let parentId = form.getAttribute('data-parent-id');

            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                if(data.success) {
                    form.reset();
                    if(isReply) {
                        toggleReplyForm(parentId);
                    } else {
                        let emptyMsg = document.getElementById('empty-comment-msg');
                        if(emptyMsg) emptyMsg.remove();
                    }

                    if(!isReply) {
                        let newHtml = `
                        <div class="comment-item" id="comment-item-${data.comment.id}" style="background: #11141d; border: 1px solid #2a343b; border-radius: 6px; padding: 15px; margin-bottom: 12px;">
                            <div style="display: flex; gap: 15px;">
                                <div style="width: 38px; height: 38px; border-radius: 50%; background: #${data.comment.color_hash}; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px; color: #fff; flex-shrink: 0;">
                                    ${data.comment.user_initial}
                                </div>
                                <div style="flex-grow: 1;">
                                    <div style="margin-bottom: 8px; display: flex; align-items: center; justify-content: space-between;">
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <strong style="font-size: 14px; color: #fff; line-height: 1;">${data.comment.user_name}</strong> 
                                            <span style="color: #cecaca; font-size: 12px; line-height: 1;">${data.comment.time}</span>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-link p-0 text-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" style="min-width: 100px; font-size: 13px;">
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="editComment(${data.comment.id})"><i class="fa-solid fa-pen"></i> Sửa</a></li>
                                                <li><a class="dropdown-item text-danger" href="javascript:void(0)" onclick="deleteComment(${data.comment.id})"><i class="fa-solid fa-trash"></i> Xóa</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="comment-content-${data.comment.id}" style="color: #cecaca; font-size: 14px; margin-bottom: 12px; line-height: 1.5;">${data.comment.content}</div>
                                    <button onclick="toggleReplyForm(${data.comment.id})" style="background: transparent; border: 1px solid #444; color: #cecaca; padding: 3px 12px; border-radius: 4px; font-size: 12px; cursor: pointer; transition: 0.2s;">Trả lời</button>
                                </div>
                            </div>
                            
                            <div class="replies-list" id="replies-list-${data.comment.id}" style="margin-left: 53px; margin-top: 15px; border-left: 2px solid #2a343b; padding-left: 15px; display: none;">
                            </div>

                            <div class="reply-form" id="reply-form-${data.comment.id}" style="display: none; margin-left: 53px; margin-top: 15px;">
                                <form class="ajax-comment-form" action="${actionUrl}" method="POST" data-is-reply="1" data-parent-id="${data.comment.id}">
                                    <input type="hidden" name="_token" value="${form.querySelector('input[name="_token"]').value}">
                                    <input type="hidden" name="parent_id" value="${data.comment.id}">
                                    <textarea name="content" placeholder="Viết trả lời..." rows="2" style="width: 100%; background: #171d21; border: 1px solid #2a343b; color: white; padding: 10px; border-radius: 6px; resize: none; font-size: 13px;" required></textarea>
                                    <div style="text-align: right; margin-top: 8px;">
                                        <button type="submit" style="background: #e2d703; color: #111; border: none; padding: 6px 16px; border-radius: 4px; font-weight: 600; font-size: 12px; cursor: pointer;">Gửi</button>
                                    </div>
                                </form>
                            </div>
                        </div>`;
                        
                        document.getElementById('comments-container').insertAdjacentHTML('afterbegin', newHtml);
                        let newForm = document.getElementById(`reply-form-${data.comment.id}`).querySelector('form');
                        newForm.addEventListener('submit', handleAjaxSubmit);
                    } else {
                        let newHtml = `
                        <div class="reply-item" id="comment-item-${data.comment.id}" style="margin-bottom: 15px;">
                            <div style="display: flex; gap: 12px;">
                                <div style="width: 30px; height: 30px; border-radius: 50%; background: #${data.comment.color_hash}; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 12px; color: #fff; flex-shrink: 0;">
                                    ${data.comment.user_initial}
                                </div>
                                <div style="flex-grow: 1;">
                                    <div style="margin-bottom: 5px; display: flex; align-items: center; justify-content: space-between;">
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <strong style="font-size: 13px; color: #fff; line-height: 1;">${data.comment.user_name}</strong> 
                                            <span style="color: #cecaca; font-size: 11px; line-height: 1;">${data.comment.time}</span>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-link p-0 text-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" style="min-width: 100px; font-size: 13px;">
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="editComment(${data.comment.id})"><i class="fa-solid fa-pen"></i> Sửa</a></li>
                                                <li><a class="dropdown-item text-danger" href="javascript:void(0)" onclick="deleteComment(${data.comment.id})"><i class="fa-solid fa-trash"></i> Xóa</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="comment-content-${data.comment.id}" style="color: #cecaca; font-size: 13px; margin-bottom: 0; line-height: 1.4;">${data.comment.content}</div>
                                </div>
                            </div>
                        </div>`;
                        
                        let repliesList = document.getElementById('replies-list-' + parentId);
                        repliesList.style.display = 'block';
                        repliesList.insertAdjacentHTML('beforeend', newHtml);
                    }
                } else {
                    alert(data.message || 'Có lỗi xảy ra');
                }
            })
            .catch(error => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                alert('Lỗi kết nối. Vui lòng thử lại!');
                console.error(error);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.addEventListener('submit', function (e) {
                if (e.target.classList.contains('ajax-comment-form')) {
                    handleAjaxSubmit(e);
                }
            });
        });

        // Edit Comment
        function editComment(id) {
            let contentDiv = document.getElementById('comment-content-' + id);
            if (!contentDiv) return;
            
            // Xóa khoảng trắng thừa và html để lấy text
            let currentContent = contentDiv.innerText.trim();
            
            let html = `
                <textarea id="edit-input-${id}" class="form-control bg-dark text-white mb-2 mt-2" rows="2" style="border: 1px solid #444; font-size: 13px;">${currentContent}</textarea>
                <div class="text-end">
                    <button class="btn btn-sm" style="background: #444; color: #fff; margin-right: 5px;" onclick="cancelEdit(${id}, \`${currentContent.replace(/`/g, '\\`')}\`)">Hủy</button>
                    <button class="btn btn-sm" style="background: #e2d703; color: #111; font-weight: 600;" onclick="saveComment(${id})">Lưu</button>
                </div>
            `;
            contentDiv.innerHTML = html;
        }

        function cancelEdit(id, originalContent) {
            let contentDiv = document.getElementById('comment-content-' + id);
            if (contentDiv) contentDiv.innerText = originalContent;
        }

        function saveComment(id) {
            let input = document.getElementById('edit-input-' + id);
            let content = input.value;
            if (!content.trim()) {
                alert('Nội dung không được để trống!'); return;
            }
            
            fetch('/comment/' + id, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ content: content })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('comment-content-' + id).innerText = data.content;
                } else {
                    alert(data.message);
                }
            })
            .catch(err => {
                alert('Lỗi kết nối!');
                console.error(err);
            });
        }

        function deleteComment(id) {
            if (!confirm('Bạn có chắc chắn muốn xóa bình luận này?')) return;
            
            fetch('/comment/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    let item = document.getElementById('comment-item-' + id);
                    if (item) {
                        item.style.transition = '0.3s';
                        item.style.opacity = '0';
                        setTimeout(() => item.remove(), 300);
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(err => {
                alert('Lỗi kết nối!');
                console.error(err);
            });
        }
    </script>
    <!-- ============================================== -->
    <!-- KẾT THÚC KHU VỰC BÌNH LUẬN                      -->
    <!-- ============================================== -->

    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Đảm bảo thứ tự load: Bootstrap -> Script riêng --}}
    <script src="{{ asset('js/player.js') }}"></script>
    <script src="{{ asset('js/navbar.js')}}"></script>
    <script src="{{ asset('js/script.js')}}"></script>