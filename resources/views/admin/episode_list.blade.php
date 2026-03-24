@extends('admin.layouts.app')

@section('title', 'Danh sách Tập phim')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark text-white shadow-sm" style="border: 1px solid #333; border-radius: 10px;">
                <div class="card-header d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #333; padding: 15px 20px;">
                    <h4 class="card-title mb-0" style="font-weight: 600;">Danh sách tập phim</h4>
                    <a href="#" class="btn-add" style="font-weight: 600; color: #000;">
                        <i class="fa-solid fa-plus"></i> Thêm tập mới
                    </a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0" style="vertical-align: middle;">
                            <thead>
                                <tr style="border-bottom: 2px solid #444;">
                                    <th style="width: 40%; padding-left: 25px; color: #999;">PHIM</th>
                                    <th style="width: 20%; color: #999;">SỐ TẬP({{ $count_episodes }})</th>
                                    <th style="width: 20%; color: #999;">TRẠNG THÁI</th>
                                    <th style="width: 20%; color: #999;" class="text-center">HÀNH ĐỘNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($episodes as $episode)
                                <tr style="border-bottom: 1px solid #333;">
                                    <td style="padding-left: 25px; padding-top: 15px; padding-bottom: 15px;">
                                        <div style="display: flex; align-items: center; gap: 15px;">
                                            <img src="{{ asset($episode->movie->image) }}" 
                                                 style="width: 50px; height: 70px; object-fit: cover; border-radius: 6px; border: 1px solid #444;">
                                            <div>
                                                <div style="font-weight: 600; color: #eee;">{{ $episode ->movie->title }}</div>
                                                <small style="color: #666;">Cập nhật: {{ $episode->updated_at->format('d/m/Y') }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span style="color: #f1c40f; font-weight: 600;">Tập {{ $episode->episode_number }}</span>
                                    </td>
                                    
                                    <td>
                                        @if($episode->status == 'active')
                                            <span style="background: rgba(40, 167, 69, 0.15); color: #28a745; padding: 4px 12px; border-radius: 20px; font-size: 12px; border: 1px solid #28a745;">Đang hiện</span>
                                        @else
                                            <span style="background: rgba(220, 53, 69, 0.15); color: #dc3545; padding: 4px 12px; border-radius: 20px; font-size: 12px; border: 1px solid #dc3545;">Đang ẩn</span>
                                        @endif
                                    </td>
                                    
                                    <td class="text-center">
                                        <div style="display: flex; justify-content: center; gap: 15px; align-items: center;">
                                            <a href="" title="Sửa" style="color: #3498db; font-size: 1.2rem; transition: 0.2s;">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <form action="" method="POST" 
                                                  onsubmit="return confirm('Ông có chắc chắn muốn xóa tập phim này không?');" style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: none; border: none; padding: 0; color: #e74c3c; font-size: 1.2rem; cursor: pointer; transition: 0.2s;">
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
        // --- LOGIC NHUỘM VÀNG SIDEBAR THEO URL ---
        // Lấy đúng mục Quản lý tập phim để làm vàng, xóa vàng mấy mục khác
        const currentUrl = window.location.href;
        const menuItems = document.querySelectorAll('.menu li');

        menuItems.forEach(li => {
            const link = li.querySelector('a');
            if (link && (currentUrl.includes('episode_list') || currentUrl.includes('admin/episode'))) {
                // Kiểm tra nếu link này đúng là link dẫn tới episode_list
                if (link.href.includes('episode_list') || link.innerText.includes('Quản lý Tập phim')) {
                    li.classList.add('active'); // Thêm class để ăn CSS template
                    li.style.backgroundColor = '#f1c40f'; // Ép màu vàng cho chắc
                    li.style.borderRadius = '8px';
                    li.style.margin = '5px 10px';
                    link.style.color = '#000';
                    link.style.fontWeight = 'bold';
                } else {
                    // Gỡ class active của những thằng khác (như Quản lý phim)
                    li.classList.remove('active');
                    li.style.backgroundColor = '';
                }
            }
        });
    });
</script>
@endsection