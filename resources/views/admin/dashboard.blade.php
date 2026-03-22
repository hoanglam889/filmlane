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
                        <th>Năm</th>
                        <th>Chất lượng</th>
                        <th>Lượt xem</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                    <tr>
                        <td>
                            <img src="{{ asset($movie->image) }}" class="poster-img">
                            {{ $movie->title }}
                        </td>
                        <td>{{ $movie->year }}</td>
                        <td>{{ $movie->resolution }}</td>
                        <td>1,240</td>
                        
                        @if($movie->status == 'active')
                            <td><span class="status active">Đang hiện</span></td>
                        @else
                            <td><span class="status draft">Đang ẩn</span></td>
                        @endif
                        
                        <td class="actions">
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