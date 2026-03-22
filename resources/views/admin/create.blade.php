@extends('admin.layouts.app')

@section('title', 'Thêm Phim Mới')

@section('content')
<div class="header-table" style="margin-bottom: 25px;">
    <h3 style="color: #fff; font-size: 24px;">Thêm Phim Mới</h3>
</div>

<form action="{{ route('admin.movie.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-layout">
        
        <div class="form-column left-column">
            <div class="form-group">
                <label>Tên Phim</label>
                <input type="text" name="title" class="form-control" placeholder="Nhập tên phim..." required>
            </div>
            
            <div class="form-group">
                <label>Đường dẫn (Slug)</label>
                <input type="text" name="slug" class="form-control" placeholder="nhap-ten-phim">
            </div>
            
            <div class="form-group">
                <label>Mô tả phim</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Nhập nội dung phim..."></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Năm phát hành</label>
                    <input type="number" name="year" class="form-control" placeholder="VD: 2024">
                </div>
                <div class="form-group">
                    <label>Chất lượng</label>
                    <select name="resolution" class="form-control">
                        <option value="FHD">FHD (1080p)</option>
                        <option value="HD">HD (720p)</option>
                        <option value="SD">SD (480p)</option>
                        <option value="Cam">Bản Cam</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Loại Vietsub</label>
                    <select name="subtitle_type" class="form-control">
                        <option value="Vietsub">Vietsub</option>
                        <option value="Thuyết minh">Thuyết minh</option>
                        <option value="Bản gốc">Bản gốc</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="active">Đang hiện (Active)</option>
                        <option value="draft">Bản nháp (Draft)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-column right-column">
            <div class="form-group">
                <label>Ảnh Bìa (Poster)</label>
                <input type="file" name="image" class="form-control" style="padding: 9px 15px;">
            </div>

            <div class="form-group">
                <label>Danh mục (Thể loại)</label>
                <select name="category_id" class="form-control">
                    @foreach ($categories as $category)
                    {
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    }
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Quốc gia</label>
                <select name="country_id" class="form-control">
                    @foreach ($countries as $country)
                    {
                        <option value="{{ $country->id }}">{{ $country->title }}</option>
                    }
                    @endforeach
                </select>
            </div>

            <div class="form-group" style="margin-top: 25px;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_trending" value="1" style="width: 18px; height: 18px;"> Phim đang Trending
                </label>
            </div>

            <div class="form-group" style="margin-top: 30px;">
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> LƯU PHIM
                </button>
                <a href="{{ route('admin.movie.index') }}" class="btn-cancel">
                    Quay lại danh sách
                </a>
            </div>
        </div>
        
    </div>
</form>
@endsection