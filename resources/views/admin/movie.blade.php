@extends('admin.layouts.app')

@section('title', 'Quản lý Phim')

@section('content')
<div class="data-table-wrapper">
    <div class="header-table">
        <h3>Kho Phim Của Sếp</h3>
        
        <div style="display: flex; gap: 15px; align-items: center;">
            <a href="{{ route('admin.movie.create') }}" class="btn-add">
                <i class="fa-solid fa-plus"></i> Thêm phim mới
            </a>
        </div>
    </div>
    
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Phim</th>
                    <th class="hide-on-mobile">Năm</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($movies as $movie)
                <tr>
                    <td class="movie-cell">
                        <div class="movie-info-cell">
                            <img src="{{ asset($movie->image) }}" alt="Poster" class="poster-img" style="margin: 0; width: 45px; height: 65px; object-fit: cover; border-radius: 4px; flex-shrink: 0;">
                            <div style="display: flex; flex-direction: column;">
                                <span class="movie-title-text" title="{{ $movie->title }}" style="font-weight: 700;">
                                    {{ $movie->title }}
                                </span>
                                <small style="color: #e2d703; font-size: 11px;">
                                    <i class="fa-solid fa-eye"></i> {{ number_format($movie->views) }} | 
                                    <i class="fa-solid fa-star"></i> {{ number_format($movie->ratings()->avg('rating') ?: 0, 1) }}
                                </small>
                            </div>
                        </div>
                    </td>
                    <td class="hide-on-mobile" style="white-space: nowrap;">
                        {{ $movie->year }}
                        <br>
                        <small style="color: {{ $movie->is_series ? '#e2d703' : '#aaa' }}; font-weight: 600;">
                            {{ $movie->is_series ? 'Phim Bộ' : 'Phim Lẻ' }}
                        </small>
                    </td>
                    
                    <td style="white-space: nowrap; text-align: center;">
                        <div style="font-weight: 700; color: #fff;">{{ $movie->episodes->count() }} tập</div>
                        @if($movie->status == 'active')
                            <span class="status active" style="font-size: 10px; padding: 2px 6px;">Công khai</span>
                        @else
                            <span class="status draft" style="font-size: 10px; padding: 2px 6px;">Nháp</span>
                        @endif
                    </td>
                    
                    <td class="actions" style="white-space: nowrap;">
                        <!-- Phím tắt quản lý tập phim -->
                        <a href="{{ route('admin.episode.get_episodes', $movie->id) }}" class="btn-edit" title="Danh sách tập phim" style="background: #2a343b; color: #e2d703;">
                            <i class="fa-solid fa-list-ol"></i>
                        </a>
                        <a href="{{ route('admin.episode.create', $movie->id) }}" class="btn-edit" title="Thêm tập mới" style="background: #2a343b; color: #00d4ff;">
                            <i class="fa-solid fa-plus-circle"></i>
                        </a>
                        
                        <!-- Nút sửa/xóa gốc -->
                        <a href="{{ route('admin.movie.edit', $movie->id) }}" class="btn-edit" title="Chỉnh sửa phim">
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