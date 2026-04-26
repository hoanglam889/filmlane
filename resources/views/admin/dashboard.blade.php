@extends('admin.layouts.app')

@section('title', 'Tổng quan Admin')

@section('content')

    <h2 class="page-title">Bảng Điều Khiển</h2>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="info">
                <h3>1,254</h3>
                <p>Tổng số phim</p>
            </div>
            <i class="fa-solid fa-clapperboard"></i>
        </div>
        <div class="stat-card">
            <div class="info">
                <h3>8,500</h3>
                <p>Lượt xem tuần này</p>
            </div>
            <i class="fa-solid fa-eye"></i>
        </div>
        <div class="stat-card">
            <div class="info">
                <h3>420</h3>
                <p>Thành viên đăng ký</p>
            </div>
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="stat-card">
            <div class="info">
                <h3>15</h3>
                <p>Bình luận mới</p>
            </div>
            <i class="fa-solid fa-comments"></i>
        </div>
    </div>

    <div class="data-table-wrapper">
        <div class="header-table">
            <h3>Phim vừa cập nhật</h3>
            <a href="{{ route('admin.movie.create') }}" class="btn-add">
                <i class="fa-solid fa-plus"></i> Thêm phim mới
            </a>
        </div>
        
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Phim</th>
                        <th class="hide-on-mobile">Năm</th>
                        <th class="hide-on-mobile">Chất lượng</th>
                        <th class="hide-on-mobile">Lượt xem</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                    <tr>
                        <td class="movie-cell">
                            <div class="movie-info-cell">
                                <img src="{{ asset($movie->image) }}" class="poster-img" style="margin: 0; width: 45px; height: 65px; object-fit: cover; border-radius: 4px; flex-shrink: 0;">
                                <span class="movie-title-text" title="{{ $movie->title }}">
                                    {{ $movie->title }}
                                </span>
                            </div>
                        </td>
                        <td class="hide-on-mobile" style="white-space: nowrap;">{{ $movie->year }}</td>
                        <td class="hide-on-mobile" style="white-space: nowrap;">{{ $movie->resolution }}</td>
                        <td class="hide-on-mobile" style="white-space: nowrap;">1,240</td>
                        
                        <td style="white-space: nowrap;">
                        @if($movie->status == 'active')
                            <span class="status active">Đang hiện</span>
                        @else
                            <span class="status draft">Đang ẩn</span>
                        @endif
                        </td>
                        
                        <td class="actions" style="white-space: nowrap;">
                            <a href="{{ route('admin.movie.edit', $movie->id) }}" class="btn-edit" title="Sửa">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('admin.movie.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Ông có chắc chắn muốn xóa bộ phim này không?');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Xóa">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection