@extends('admin.layouts.app')

@section('title', 'Quản lý Tập phim')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark text-white shadow-sm">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách tập phim</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive"> <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="padding-left: 20px;">PHIM</th>
                                    <th>TRẠNG THÁI</th>
                                    <th class="text-center">HÀNH ĐỘNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movies as $movie)
                                <tr>
                                    <td class="d-flex align-items: center; gap: 15px; padding-left: 20px;">
                                        <img src="{{ asset($movie->image) }}" class="poster-img" style="width: 50px; height: 72px; object-fit: cover; border-radius: 6px;">
                                        <span class="movie-title">{{ $movie->title }}</span>
                                    </td>
                                    
                                    <td>
                                        @if($movie->status == 'active')
                                            <span class="status active">Đang hiện</span>
                                        @else
                                            <span class="status draft">Đang ẩn</span>
                                        @endif
                                    </td>
                                    
                                    <td class="text-center">
                                        <div class="actions" style="display: flex; justify-content: center; gap: 15px; align-items: center;">
                                            
                                            <a href="{{ route('admin.episode.get_episodes', $movie->id) }}" class="btn-edit" title="Sửa">
                                                <i class="fa-solid fa-pen-to-square" style="color: #3498db; font-size: 1.1rem;"></i>
                                            </a>

                                            <form action="{{ route('admin.movie.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Ông có chắc chắn muốn xóa không?');" style="margin: 0; display: inline-flex;">
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
        // Tìm đúng mục Quản lý Tập phim trong menu dựa trên href
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