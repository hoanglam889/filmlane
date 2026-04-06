@extends('admin.layouts.app')

@section('title', 'Quản lý Thể loại')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            
            @if(session('success'))
                <div class="alert alert-success" style="background-color: #2ecc71; color: #fff; border: none;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card bg-dark text-white shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Danh sách Thể loại</h4>
                    <a href="{{ route('admin.category.create') }}" class="btn btn-sm" style="background-color: #e2d703; color: #111; font-weight: 600; padding: 8px 15px; border-radius: 5px; text-decoration: none;">
                        <i class="fa-solid fa-plus"></i> Thêm Thể Loại
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive"> 
                        <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="padding-left: 20px;">TÊN THỂ LOẠI</th>
                                    <th>TRẠNG THÁI</th>
                                    <th class="text-center">HÀNH ĐỘNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td style="padding-left: 20px; vertical-align: middle;">
                                        <span class="category-title" style="font-weight: 600; font-size: 1.1rem; color: #fff;">{{ $category->title }}</span>
                                    </td>
                                    
                                    <td style="vertical-align: middle;">
                                        @if(!$category->trashed())
                                            <span class="status active">Đang hiện</span>
                                        @else
                                            <span class="status draft">Đang ẩn</span>
                                        @endif
                                    </td>
                                    
                                    <td class="text-center" style="vertical-align: middle;">
                                        <div class="actions" style="display: flex; justify-content: center; gap: 15px; align-items: center;">
                                            
                                            <a href="{{ route('admin.category.edit', $category->id) }}" class="btn-edit" title="Sửa">
                                                <i class="fa-solid fa-pen-to-square" style="color: #3498db; font-size: 1.1rem;"></i>
                                            </a>

                                            <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Ông có chắc chắn muốn xóa thể loại [{{ $category->title }}] không?');" style="margin: 0; display: inline-flex;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete" style="background: none; border: none; padding: 0; cursor: pointer;">
                                                    <i class="fa-solid fa-trash-can" style="color: #e74c3c; font-size: 1.1rem;"></i>
                                                </button>
                                            </form>
                                            
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Tìm đúng mục Quản lý Thể loại trong menu dựa trên href
        const currentUrl = window.location.href;
        const menuLinks = document.querySelectorAll('.menu a');
        
        menuLinks.forEach(link => {
            if (currentUrl.includes(link.getAttribute('href'))) {
                link.parentElement.classList.add('active');
            } else {
                link.parentElement.classList.remove('active');
            }
        });
    });
</script>
@endsection