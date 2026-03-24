@extends('admin.layouts.app')

@section('title', 'Thêm Tập Phim Mới')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-dark text-white shadow-sm" style="border: 1px solid #333; border-radius: 10px;">
                <div class="card-header" style="border-bottom: 1px solid #333; padding: 15px 20px;">
                    <h4 class="card-title mb-0" style="font-weight: 600; color: #f1c40f;">
                        <span style="color: #f1c40f;;">{{ $movie->title }}</span>
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.episode.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="movie_id" value="{{ $movie->id }}">

                        <div class="mb-3">
                            <label class="form-label">Số tập (Episode Number)</label>
                            <input type="number" name="episode_number" class="form-control bg-secondary text-white border-0" 
                                   placeholder="Ví dụ: 1, 2, 3..." required style="padding: 12px;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Link Video (Iframe/URL)</label>
                            <textarea name="video_link" class="form-control bg-secondary text-white border-0" 
                                      rows="4" placeholder="Dán link Upstream hoặc Embed code vào đây..." required style="padding: 12px;"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" style="color: #999;">Trạng thái</label>
                            <select name="status" class="form-select bg-secondary text-white border-0" style="padding: 12px;">
                                <option value="active" selected>Hiển thị ngay</option>
                                <option value="draft">Tạm ẩn (Bản nháp)</option>
                            </select>
                        </div>

                        <hr style="border-top: 1px solid #444;">

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ url()->previous() }}" class="text-decoration-none" style="color: #666;">
                                <i class="fa-solid fa-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn-submit-gold">
                                <i class="fa-solid fa-save"></i> Lưu tập phim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-submit-gold {
        background-color: #f1c40f;
        color: #000;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .btn-submit-gold:hover {
        background-color: #d4ac0d;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(241, 196, 15, 0.3);
    }
    /* Chỉnh màu cho input khi focus */
    .form-control:focus, .form-select:focus {
        background-color: #444 !important;
        color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(241, 196, 15, 0.2);
        border: 1px solid #f1c40f !important;
    }
</style>
@endsection