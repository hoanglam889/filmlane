@extends('admin.layouts.app')

@section('title', 'Thêm Quốc gia Mới')

@section('content')
<div class="header-table" style="margin-bottom: 25px;">
    <h3 style="color: #fff; font-size: 24px;">Thêm Quốc gia Mới</h3>
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

<form action="{{ route('admin.country.store') }}" method="POST">
    @csrf
    
    <div style="max-width: 700px;"> 
        
        <div class="form-group">
            <label>Tên Quốc gia</label>
            <input type="text" name="title" class="form-control" placeholder="VD: Việt Nam, Mỹ, Hàn Quốc..." required>
        </div>
        
        <div class="form-group" style="margin-top: 20px;">
            <label>Đường dẫn (Slug)</label>
            <input type="text" name="slug" class="form-control" placeholder="VD: viet-nam (Nếu để trống hệ thống sẽ tự tạo)">
        </div>

        <div class="form-group" style="margin-top: 30px;">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-plus"></i> TẠO QUỐC GIA
            </button>
            <a href="{{ route('admin.country') }}" class="btn-cancel">
                Quay lại danh sách
            </a>
        </div>
        
    </div>
</form>

@endsection
