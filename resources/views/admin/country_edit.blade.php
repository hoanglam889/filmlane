@extends('admin.layouts.app')

@section('title', 'Sửa Quốc gia')

@section('content')
<div class="header-table" style="margin-bottom: 25px;">
    <h3 style="color: #fff; font-size: 24px;">Sửa Quốc gia: <span style="color: #e2d703;">{{ $country->title }}</span></h3>
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

<form action="{{ route('admin.country.update', $country->id) }}" method="POST">
    @csrf
    @method('PUT') 
    
    <div style="max-width: 700px;"> 
        
        <div class="form-group">
            <label>Tên Quốc gia</label>
            <input type="text" name="title" class="form-control" value="{{ $country->title }}" required>
        </div>
        
        <div class="form-group" style="margin-top: 20px;">
            <label>Đường dẫn (Slug)</label>
            <input type="text" name="slug" class="form-control" value="{{ $country->slug }}">
        </div>

        <div class="form-group" style="margin-top: 25px; background: rgba(52, 152, 219, 0.1); padding: 15px; border-radius: 6px; border-left: 4px solid #3498db;">
            <p style="margin: 0; color: #3498db; font-size: 15px;">
                <i class="fa-solid fa-circle-info"></i> <strong>Ghi chú:</strong> Nếu ông đổi Tên Quốc gia mà lười sửa lại Slug, hãy <strong>xóa trắng ô Slug</strong>, hệ thống sẽ tự động cập nhật Slug mới theo Tên Quốc gia.
            </p>
        </div>

        <div class="form-group" style="margin-top: 30px;">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-floppy-disk"></i> LƯU CẬP NHẬT
            </button>
            <a href="{{ route('admin.country') }}" class="btn-cancel">
                Quay lại danh sách
            </a>
        </div>
        
    </div>
</form>

@endsection
