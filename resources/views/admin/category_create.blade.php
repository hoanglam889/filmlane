@extends('admin.layouts.app')

@section('title', 'Thêm Thể Loại Mới')

@section('content')
<div class="header-table" style="margin-bottom: 25px;">
    <h3 style="color: #fff; font-size: 24px;">Thêm Thể Loại Mới</h3>
</div>

@if ($errors->any())
    <div class="alert alert-danger" style="background-color: #ff4d4d; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.category.store') }}" method="POST">
    @csrf
    
    <div style="max-width: 700px;"> 
        
        <div class="form-group">
            <label>Tên Thể Loại</label>
            <input type="text" name="title" class="form-control" placeholder="VD: Hành Động, Tình Cảm..." required>
        </div>
        
        <div class="form-group" style="margin-top: 20px;">
            <label>Đường dẫn (Slug)</label>
            <input type="text" name="slug" class="form-control" placeholder="VD: hanh-dong (Nếu để trống hệ thống sẽ tự tạo)">
        </div>

        <div class="form-group" style="margin-top: 25px; background: rgba(46, 204, 113, 0.1); padding: 15px; border-radius: 6px; border-left: 4px solid #2ecc71;">
            <p style="margin: 0; color: #2ecc71; font-size: 15px;">
                <i class="fa-solid fa-circle-info"></i> <strong>Lưu ý:</strong> Danh mục khi được tạo sẽ luôn ở trạng thái <strong>Đang hiện</strong> trên website. Để ẩn danh mục, vui lòng bấm nút "Xóa" ở trang Danh sách.
            </p>
        </div>

        <div class="form-group" style="margin-top: 30px;">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-plus"></i> TẠO THỂ LOẠI
            </button>
            <a href="{{ route('admin.category') }}" class="btn-cancel">
                Quay lại danh sách
            </a>
        </div>
        
    </div>
</form>

@endsection