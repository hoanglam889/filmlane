@extends('admin.layouts.app')

@section('title', 'Quản lý Tập phim')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('admin.episode.create', $movie->id) }}" class="btn-add-new">
                <i class="fa-solid fa-plus-circle"></i> Thêm tập mới
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark text-white shadow-sm" style="border: 1px solid #333;">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách tập phim: {{ $movie->title }}</h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-dark table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="padding-left: 20px;">TẬP SỐ</th>
                                <th>LINK VIDEO</th>
                                <th>TRẠNG THÁI</th>
                                <th class="text-center">HÀNH ĐỘNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($episodes as $episode)
                            <tr>
                                <td style="padding-left: 20px; color: #f1c40f; font-weight: bold;">Tập {{ $episode->episode_number }}</td>
                                <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #888;">
                                    {{ $episode->video_link }}
                                </td>
                                <td>
                                    @if($episode->status == 'active')
                                        <span class="badge bg-success">Hiện</span>
                                    @else
                                        <span class="badge bg-secondary">Ẩn</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-3">
                                        <button class="btn-edit-inline" 
                                                data-id="{{ $episode->id }}" 
                                                data-link="{{ $episode->video_link }}" 
                                                data-status="{{ $episode->status }}"
                                                onclick="openEditModal(this)">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        <form action="{{ route('admin.episode.destroy', $episode->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-delete" onclick="return confirm('Xóa thiệt hả ông?')">
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

<div id="editModal" class="modal-custom">
    <div class="modal-content-dark">
        <h5>Sửa Tập Phim</h5>
        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Link Video</label>
                <textarea name="video_link" id="modal_video_link" class="form-control bg-secondary text-white border-0" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label>Trạng thái</label>
                <select name="status" id="modal_status" class="form-select bg-secondary text-white border-0">
                    <option value="active">Hiển thị</option>
                    <option value="draft">Ẩn</option>
                </select>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <button type="button" onclick="closeModal()" class="btn btn-sm btn-outline-light">Hủy</button>
                <button type="submit" class="btn btn-sm btn-warning">Cập nhật</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* CSS cho nút và Modal */
    .btn-edit-inline { background: none; border: none; color: #3498db; font-size: 1.2rem; cursor: pointer; }
    .btn-delete { background: none; border: none; color: #e74c3c; font-size: 1.2rem; cursor: pointer; }
    
    .modal-custom {
        display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.8); align-items: center; justify-content: center;
    }
    .modal-content-dark {
        background: #222; padding: 25px; border-radius: 10px; width: 400px; border: 1px solid #444;
    }
    .btn-add-new {
        background-color: #f1c40f; color: #000; padding: 10px 20px; border-radius: 8px;
        font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    }
</style>

<script>
    function openEditModal(btn) {
        const id = btn.getAttribute('data-id');
        const link = btn.getAttribute('data-link');
        const status = btn.getAttribute('data-status');

        document.getElementById('editForm').action = `/admin/episode/update/${id}`;
        document.getElementById('modal_video_link').value = link;
        document.getElementById('modal_status').value = status;
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }
</script>
@endsection