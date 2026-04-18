@include('partials.header')

<style>
    /* =======================================================
       GIAO DIỆN CHUẨN: CARD NẰM NGANG, POSTER ĐỨNG, FULL LINK
       ======================================================= */
    .list-layout { display: flex; flex-direction: column; gap: 15px; padding: 0; list-style: none; width: 100%; }
    
    .card-horizontal { 
        position: relative; /* Rất quan trọng để làm Link tàng hình */
        display: flex; 
        flex-direction: row; 
        background-color: #171d21; 
        border: 1px solid #2a343b; 
        border-radius: 8px; 
        overflow: hidden; 
        width: 100%; 
        transition: 0.3s ease;
    }
    
    /* Hiệu ứng viền vàng khi đưa chuột vào (giữ cả trên Win & Mobile) */
    .card-horizontal:hover { border-color: #e2d703; box-shadow: 0 4px 15px rgba(226, 215, 3, 0.15); }
    
    /* TUYỆT CHIÊU: Link tàng hình bọc kín cả cái Card */
    .full-card-link { position: absolute; inset: 0; z-index: 1; }

    /* Ảnh Poster - Hình chữ nhật đứng (2/3) */
    .card-horizontal .img-box { width: 140px; flex-shrink: 0; } 
    .card-horizontal .img-box img { width: 100%; height: 100%; object-fit: cover; aspect-ratio: 2/3; display: block; }
    
    /* Khu vực thông tin */
    .card-horizontal .info-box { padding: 15px; display: flex; flex-direction: column; width: 100%; justify-content: space-between; gap: 10px; }
    
    .card-horizontal .top-info h4 { 
        color: #fff; font-size: 20px; margin: 0 0 5px 0; 
        /* Cắt chữ nếu dài quá 2 dòng */
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .card-horizontal .year { color: #888; font-size: 13px; }
    
    .card-horizontal .meta-info { display: flex; gap: 12px; color: #ccc; font-size: 12px; margin: 0; align-items: center; flex-wrap: wrap;}
    .card-horizontal .quality { border: 1px solid #e2d703; color: #e2d703; padding: 2px 6px; border-radius: 4px; font-size: 11px;}
    .card-horizontal .description { color: #888; font-size: 13px; margin: 0; }

    /* Nút bấm */
    .card-horizontal .action-buttons { margin-top: auto; display: flex; justify-content: flex-end; } /* Đẩy nút qua góc phải */
    
    /* Nút Bỏ thích phải có z-index: 2 để đè lên cái link tàng hình, bấm không bị nhảy trang */
    .card-horizontal .btn-remove { 
        position: relative; z-index: 2; 
        background-color: rgba(255, 77, 77, 0.1); color: #ff4d4d; border: 1px solid #ff4d4d; 
        padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 13px; font-weight: 600; 
        display: inline-flex; align-items: center; gap: 6px; transition: 0.2s;
    }
    .card-horizontal .btn-remove:hover { background-color: #ff4d4d; color: #fff; }

    /* =======================================================
       MOBILE OPTIMIZATION (Co gọn tối đa)
       ======================================================= */
    @media (max-width: 600px) {
        .card-horizontal .img-box { width: 100px; } /* Ảnh nhỏ lại nhưng vẫn là hình chữ nhật đứng */
        .card-horizontal .info-box { padding: 10px; gap: 5px; }
        .card-horizontal .top-info h4 { font-size: 16px; margin-bottom: 2px; }
        .card-horizontal .meta-info span:nth-child(2) { display: none; } /* Giấu chữ "120 min" đi cho thoáng */
        .card-horizontal .description { font-size: 12px; }
        
        .card-horizontal .btn-remove { padding: 6px 10px; font-size: 12px; }
    }
</style>

<section class="top-movie same favorites-page" style="padding-top: 40px; padding-bottom: 60px; min-height: 80vh; background-color: #11141d;">
  <div class="header" style="margin-bottom: 20px; padding: 0 15px;">
    <h4 style="color: #fff; font-size: 24px; margin: 0; border-left: 4px solid #e2d703; padding-left: 10px;">Phim đã thích</h4>
  </div>

  <div class="top-movie-main" style="padding: 0 15px;">
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
                    <span class="year">{{ $movie->year }}</span>
                </div>
                
                <div class="meta-info">
                    <span class="quality">{{ $movie->resolution ?? 'HD' }}</span>
                    <span><i class="fa-regular fa-clock"></i> 120 min</span>
                    <span class="rating"><i class="fa-solid fa-star" style="color: #e2d703;"></i> 8.5</span>
                </div>

                <p class="description">Đã thích: {{ $movie->pivot->created_at->format('d/m/Y') ?? 'Gần đây' }}</p>

                <div class="action-buttons">
                    <button class="btn-remove" data-movie-id="{{ $movie->id }}" title="Xóa khỏi danh sách">
                        <i class="fa-solid fa-trash"></i> Bỏ thích
                    </button>
                </div>
            </div>
          </li>
        @empty
          <div style="width: 100%; text-align: center; padding: 50px 0; background: #171d21; border-radius: 8px;">
            <i class="fa-regular fa-heart" style="font-size: 40px; color: #555; margin-bottom: 15px;"></i>
            <h5 style="color: #ccc; font-size: 16px;">Danh sách trống.</h5>
          </div>
        @endforelse

    </ul>
  </div>
</section>

@include('partials.footer')

<button class="back-to-top"><i class="fa-solid fa-chevron-up"></i></button>

<script src="{{ asset('js/script.js')}}"></script>
<script src="{{ asset('js/navbar.js')}}"></script>