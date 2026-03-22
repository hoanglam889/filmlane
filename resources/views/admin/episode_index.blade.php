@extends('admin.layouts.app')

@section('title', 'Quản lý Tập phim')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark text-white shadow-sm" style="border: 1px solid #333;">
                <div class="card-header" style="border-bottom: 1px solid #333;">
                    <h4 class="card-title mb-0">Danh sách tập phim</h4>
                </div>
                <div class="card-body p-0">
                    <div style="overflow-x: auto;">
                        <table class="table table-dark table-striped table-hover mb-0" style="vertical-align: middle;">
                            <thead>
                                <tr>
                                    <th style="width: 45%; padding-left: 20px;">PHIM</th>
                                    <th style="width: 30%;">TRẠNG THÁI</th>
                                    <th style="width: 25%; text-center" class="text-center">HÀNH ĐỘNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movies as $movie)
                                <tr>
                                    <td style="display: flex; align-items: center; gap: 15px; border-bottom: none; padding-left: 20px; padding-top: 15px; padding-bottom: 15px;">
                                        <img src="{{ asset($movie->image) }}" 
                                             style="width: 50px; height: 72px; object-fit: cover; border-radius: 6px; border: 1px solid #444; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                                        <span style="font-weight: 500; color: #eee; font-size: 15px;">{{ $movie->title }}</span>
                                    </td>
                                    
                                    <td>
                                        @if($movie->status == 'active')
                                            <span class="badge" style="background-color: rgba(40, 167, 69, 0.2); color: #28a745; border: 1px solid #28a745; padding: 6px 12px; border-radius: 20px;">Đang hiện</span>
                                        @else
                                            <span class="badge" style="background-color: rgba(108, 117, 125, 0.2); color: #6c757d; border: 1px solid #6c757d; padding: 6px 12px; border-radius: 20px;">Đang ẩn</span>
                                        @endif
                                    </td>
                                    
                                    <td class="text-center">
                                        <div style="display: flex; justify-content: center; gap: 12px; align-items: center;">
                                            <a href="{{ route('admin.movie.edit', $movie->id) }}" 
                                               style="color: #17a2b8; font-size: 18px; transition: all 0.2s;"
                                               onmouseover="this.style.color='#138496'" 
                                               onmouseout="this.style.color='#17a2b8'"
                                               title="Sửa">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <form action="{{ route('admin.movie.destroy', $movie->id) }}" method="POST" 
                                                  onsubmit="return confirm('Ông có chắc chắn muốn xóa bộ phim này không?');" 
                                                  style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        style="background: none; border: none; padding: 0; color: #dc3545; font-size: 18px; cursor: pointer; transition: all 0.2s;"
                                                        onmouseover="this.style.color='#a71d2a'" 
                                                        onmouseout="this.style.color='#dc3545'"
                                                        title="Xóa">
                                                    <i class="fa-solid fa-trash-can"></i>
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
        // Tìm tất cả các link trong Sidebar
        const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
        
        sidebarLinks.forEach(link => {
            // Kiểm tra xem link đó có chứa chữ "Tập phim" không (hoặc check href tương ứng)
            if (link.innerText.includes('Quản lý Tập phim')) {
                // Thêm class 'active' vào thẻ LI cha của nó
                link.closest('.nav-item').classList.add('active');
            }
        });
    });
</script>
@endsection