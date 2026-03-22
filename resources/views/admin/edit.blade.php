@extends('admin.layouts.app')

@section('title', 'Sửa Phim')

@section('content')
<div class="header-table" style="margin-bottom: 25px;">
    <h3 style="color: #fff; font-size: 24px;">Sửa Phim: {{ $movie->title }}</h3>
</div>

<form action="{{ route('admin.movie.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <div class="form-layout">
        <div class="form-column left-column">
            <div class="form-group">
                <label>Tên Phim</label>
                <input type="text" name="title" class="form-control" value="{{ $movie->title }}" required>
            </div>
            
            <div class="form-group">
                <label>Đường dẫn (Slug)</label>
                <input type="text" name="slug" class="form-control" value="{{ $movie->slug }}">
            </div>
            
            <div class="form-group">
                <label>Mô tả phim</label>
                <textarea name="description" class="form-control" rows="5">{{ $movie->description }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Năm phát hành</label>
                    <input type="number" name="year" class="form-control" value="{{ $movie->year }}">
                </div>
                <div class="form-group">
                    <label>Chất lượng</label>
                    <select name="resolution" class="form-control">
                        <option value="FHD" {{ $movie->resolution == 'FHD' ? 'selected' : '' }}>FHD (1080p)</option>
                        <option value="HD" {{ $movie->resolution == 'HD' ? 'selected' : '' }}>HD (720p)</option>
                        <option value="SD" {{ $movie->resolution == 'SD' ? 'selected' : '' }}>SD (480p)</option>
                        <option value="Cam" {{ $movie->resolution == 'Cam' ? 'selected' : '' }}>Bản Cam</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $movie->status == 'active' ? 'selected' : '' }}>Đang hiện (Active)</option>
                        <option value="draft" {{ $movie->status == 'draft' ? 'selected' : '' }}>Bản nháp (Draft)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-column right-column">
            <div class="form-group">
                <label>Ảnh Bìa Hiện Tại</label>
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset($movie->image) }}" alt="" style="width: 100px; border-radius: 5px;">
                </div>
                <label>Đổi ảnh bìa mới (Bỏ trống nếu giữ nguyên ảnh cũ)</label>
                <input type="file" name="image" class="form-control" style="padding: 9px 15px;">
            </div>

            <div class="form-group">
                <label>Danh mục (Thể loại)</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $cate)
                        <option value="{{ $cate->id }}" {{ $movie->category_id == $cate->id ? 'selected' : '' }}>
                            {{ $cate->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-top: 25px; background: rgba(255,255,255,0.02); padding: 15px; border-radius: 6px; border: 1px solid #2a2a2a;">
                <label style="margin-bottom: 12px; color: #e2d703; font-weight: 600;">Gắn Nhãn Phim</label>

                <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_trending" value="1" {{ $movie->is_trending ? 'checked' : '' }} style="width: 18px; height: 18px;"> 
                    Phim Đang Trending
                </label>

                <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_top_rated" value="1" {{ $movie->is_top_rated ? 'checked' : '' }} style="width: 18px; height: 18px;"> 
                    Phim Đánh Giá Cao
                </label>

                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_upcoming" value="1" {{ $movie->is_upcoming ? 'checked' : '' }} style="width: 18px; height: 18px;"> 
                    Phim Sắp Chiếu (Trailer)
                </label>
            </div>
            <div class="form-group" style="margin-top: 30px;">
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> LƯU CẬP NHẬT
                </button>
                <a href="{{ route('admin.movie.index') }}" class="btn-cancel">
                    Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</form>
@endsection