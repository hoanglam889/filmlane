@extends('admin.layouts.app')

@section('title', 'Quản lý Người dùng')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            
            @if(session('success'))
                <div class="alert alert-success" style="background-color: #2ecc71; color: #fff; border: none; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" style="background-color: #e74c3c; color: #fff; border: none; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card bg-dark text-white shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Danh sách Người dùng</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive"> 
                        <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="padding-left: 20px; width: 60px;">AVATAR</th>
                                    <th>THÔNG TIN</th>
                                    <th>QUYỀN</th>
                                    <th>NGÀY ĐĂNG KÝ</th>
                                    <th class="text-center">HÀNH ĐỘNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td style="padding-left: 20px; vertical-align: middle;">
                                        @if($user->avatar)
                                            <img src="{{ asset($user->avatar) }}" alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                        @else
                                            <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #333; display: flex; justify-content: center; align-items: center; font-weight: bold; color: #e2d703;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </td>
                                    
                                    <td style="vertical-align: middle;">
                                        <div style="font-weight: 600; font-size: 1rem; color: #fff;">{{ $user->name }}</div>
                                        <div style="font-size: 0.85rem; color: #aaa;">{{ $user->email }}</div>
                                    </td>

                                    <td style="vertical-align: middle;">
                                        @if($user->role == 1)
                                            <span class="status active" style="background-color: rgba(46, 213, 115, 0.1); color: #2ed573; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">Admin</span>
                                        @else
                                            <span class="status draft" style="background-color: rgba(170, 170, 170, 0.1); color: #aaa; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">User</span>
                                        @endif
                                    </td>

                                    <td style="vertical-align: middle; color: #ccc;">
                                        {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    
                                    <td class="text-center" style="vertical-align: middle;">
                                        <div class="actions" style="display: flex; justify-content: center; gap: 15px; align-items: center;">
                                            
                                            <!-- Toggle Role -->
                                            @if(auth()->id() != $user->id)
                                                <form action="{{ route('admin.user.update_role', $user->id) }}" method="POST" style="margin: 0; display: inline-flex;" onsubmit="return confirm('Bạn muốn đổi quyền của người dùng này?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;" title="Đổi quyền">
                                                        <i class="fa-solid fa-user-shield" style="color: {{ $user->role == 1 ? '#e2d703' : '#7f8c8d' }}; font-size: 1.1rem;"></i>
                                                    </button>
                                                </form>

                                                <!-- Delete -->
                                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng [{{ $user->name }}] không?');" style="margin: 0; display: inline-flex;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-delete" style="background: none; border: none; padding: 0; cursor: pointer;" title="Xóa">
                                                        <i class="fa-solid fa-trash-can" style="color: #e74c3c; font-size: 1.1rem;"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span style="font-size: 0.85rem; color: #888; font-style: italic;">Bạn</span>
                                            @endif
                                            
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

@endsection
