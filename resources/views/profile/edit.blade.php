@include('partials.header')

<style>
    .profile-page { padding: 100px 15px; background-color: #11141d; color: #fff; min-height: 80vh; }
    .profile-container { max-width: 800px; margin: 0 auto; }
    
    .profile-header { text-align: center; margin-bottom: 40px; }
    .profile-header h2 { font-size: 32px; color: #fff; font-weight: 700; margin-bottom: 10px; }
    .profile-header h2 span { color: #e2d703; }
    
    .profile-card { background: #171d21; border: 1px solid #2a343b; border-radius: 8px; padding: 35px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
    .profile-card h3 { color: #e2d703; font-size: 20px; margin-bottom: 10px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
    .profile-card p.desc { color: #cecaca; font-size: 14px; margin-bottom: 25px; }
    
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; color: #fff; font-size: 14px; font-weight: 600; }
    .form-group input { width: 100%; background: #11141d; border: 1px solid #2a343b; color: #fff; padding: 12px 15px; border-radius: 6px; font-size: 14px; transition: border-color 0.3s; }
    .form-group input:focus { border-color: #e2d703; outline: none; }
    
    .btn-save { background: #e2d703; color: #111; font-weight: 700; border: none; padding: 12px 25px; border-radius: 4px; cursor: pointer; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; }
    .btn-save:hover { background: #fff; }
    
    .btn-danger-custom { background: transparent; color: #dc3545; font-weight: 700; border: 1px solid #dc3545; padding: 12px 25px; border-radius: 4px; cursor: pointer; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; }
    .btn-danger-custom:hover { background: #dc3545; color: #fff; }
    
    .status-msg { color: #28a745; font-size: 14px; font-weight: 600; margin-left: 15px; display: inline-flex; align-items: center; gap: 5px; }
    .error-msg { color: #dc3545; font-size: 13px; margin-top: 5px; display: block; }
</style>

<section class="profile-page">
    <div class="profile-container">
        
        <div class="profile-header">
            <h2>Hồ sơ <span>cá nhân</span></h2>
            <p style="color: #cecaca;">Quản lý thông tin và bảo mật tài khoản của bạn</p>
        </div>
        
        <!-- THÔNG TIN CÁ NHÂN -->
        <div class="profile-card">
            <h3><i class="fa-solid fa-user-pen"></i> Thông tin cá nhân</h3>
            <p class="desc">Cập nhật tên hiển thị và địa chỉ email của bạn để mọi người dễ dàng nhận ra.</p>
            
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
                
                <div class="form-group">
                    <label for="name">Tên hiển thị</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? Auth::user()->name) }}" required autofocus>
                    @error('name')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                
                <div class="form-group">
                    <label for="email">Địa chỉ Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? Auth::user()->email) }}" required>
                    @error('email')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                
                <div style="display: flex; align-items: center; margin-top: 30px;">
                    <button type="submit" class="btn-save"><i class="fa-solid fa-check"></i> Lưu thay đổi</button>
                    @if (session('status') === 'profile-updated')
                        <span class="status-msg" id="status-profile"><i class="fa-solid fa-circle-check"></i> Đã lưu thành công!</span>
                        <script>setTimeout(() => document.getElementById('status-profile').style.display = 'none', 3000);</script>
                    @endif
                </div>
            </form>
        </div>

        <!-- ĐỔI MẬT KHẨU -->
        <div class="profile-card">
            <h3><i class="fa-solid fa-lock"></i> Đổi mật khẩu</h3>
            <p class="desc">Đảm bảo tài khoản của bạn sử dụng mật khẩu đủ dài và phức tạp để giữ an toàn.</p>
            
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                
                <div class="form-group">
                    <label for="current_password">Mật khẩu hiện tại</label>
                    <input type="password" id="current_password" name="current_password" required autocomplete="current-password">
                    @error('current_password', 'updatePassword')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Mật khẩu mới</label>
                    <input type="password" id="password" name="password" required autocomplete="new-password">
                    @error('password', 'updatePassword')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation', 'updatePassword')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                
                <div style="display: flex; align-items: center; margin-top: 30px;">
                    <button type="submit" class="btn-save"><i class="fa-solid fa-key"></i> Cập nhật mật khẩu</button>
                    @if (session('status') === 'password-updated')
                        <span class="status-msg" id="status-password"><i class="fa-solid fa-circle-check"></i> Đã đổi mật khẩu!</span>
                        <script>setTimeout(() => document.getElementById('status-password').style.display = 'none', 3000);</script>
                    @endif
                </div>
            </form>
        </div>

        <!-- XÓA TÀI KHOẢN -->
        <div class="profile-card" style="border-color: #3f191e; background: #1c1516;">
            <h3 style="color: #dc3545;"><i class="fa-solid fa-user-xmark"></i> Xóa tài khoản</h3>
            <p class="desc" style="color: #c78d92;">Một khi tài khoản của bạn bị xóa, toàn bộ dữ liệu, lịch sử xem phim và bình luận sẽ bị xóa vĩnh viễn. Hành động này không thể hoàn tác.</p>
            
            <button class="btn-danger-custom" onclick="document.getElementById('deleteAccountModal').style.display='flex'">
                <i class="fa-solid fa-trash-can"></i> Xóa tài khoản vĩnh viễn
            </button>
            
            <!-- Modal Xóa -->
            <div id="deleteAccountModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
                <div style="background: #171d21; border: 1px solid #dc3545; padding: 40px; border-radius: 12px; max-width: 500px; width: 90%; box-shadow: 0 10px 30px rgba(220,53,69,0.2);">
                    <h4 style="color: #fff; margin-bottom: 15px; font-size: 22px;">Bạn có chắc chắn?</h4>
                    <p style="color: #cecaca; font-size: 15px; margin-bottom: 25px; line-height: 1.5;">Vui lòng nhập mật khẩu của bạn để xác nhận hành động này. Dữ liệu sẽ <strong>không thể khôi phục</strong> sau khi xóa.</p>
                    
                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')
                        
                        <div class="form-group">
                            <input type="password" id="password_delete" name="password" placeholder="Nhập mật khẩu để xác nhận..." required style="border-color: #444;">
                            @error('password', 'userDeletion')<span class="error-msg">{{ $message }}</span>@enderror
                        </div>
                        
                        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 30px;">
                            <button type="button" class="btn-save" style="background: #2a343b; color: #fff;" onclick="document.getElementById('deleteAccountModal').style.display='none'">Hủy bỏ</button>
                            <button type="submit" class="btn-danger-custom" style="background: #dc3545; color: #fff;">Xóa tài khoản</button>
                        </div>
                    </form>
                </div>
            </div>
            
            @if($errors->userDeletion->isNotEmpty())
            <script>document.getElementById('deleteAccountModal').style.display='flex';</script>
            @endif
        </div>

    </div>
</section>

@include('partials.footer')
<script src="{{ asset('js/script.js')}}"></script>
<script src="{{ asset('js/navbar.js')}}"></script>
