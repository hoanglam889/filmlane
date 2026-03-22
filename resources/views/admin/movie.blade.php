@extends('admin.layouts.app')

@section('title', 'Quản lý Phim')

@section('content')
<div class="data-table-wrapper">
    <div class="header-table">
        <h3>Kho Phim Của Sếp</h3>
        
        <div style="display: flex; gap: 15px; align-items: center;">
            <div class="search-box-movie">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Tìm tên phim...">
            </div>
            
            <a href="#" class="btn-add">
                <i class="fa-solid fa-plus"></i> Thêm phim mới
            </a>
        </div>
    </div>
    
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Phim</th>
                    <th>Năm</th>
                    <th>Chất lượng</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($movies as $movie)
                <tr>
                    <td>
                        <img src="{{ asset($movie->image) }}" alt="Poster" class="poster-img">
                        {{ $movie->title }}
                    </td>
                    <td>{{ $movie->year }}</td>
                    <td><span class="status">{{ $movie->resolution }}</span></td>
                    
                    <td>
                        @if($movie->status == 'active')
                            <span class="status active">Đang hiện</span>
                        @else
                            <span class="status draft">Bản nháp</span>
                        @endif
                    </td>
                    
                    <td class="actions">
                        <a href="{{ route('admin.movie.edit', $movie->id) }}" class="btn-edit" title="Chỉnh sửa">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.movie.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Ông có chắc chắn muốn xóa bộ phim này không?');" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" title="Xóa phim">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 40px 15px; text-align: center; color: #888;">
                        <i class="fa-solid fa-film" style="font-size: 40px; margin-bottom: 15px; opacity: 0.5;"></i>
                        <p>Kho phim đang trống. Hãy thêm bộ phim đầu tiên nhé!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($movies->hasMorePages())
    <div class="load-more-container">
        <a href="{{ $movies->nextPageUrl() }}" class="btn-load-more">
            Xem thêm <i class="fa-solid fa-angle-down"></i>
        </a>
    </div>
    @endif

</div>
@endsection