<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - FilmLane</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="admin-container">
        
        <aside class="sidebar" id="sidebar">
            <div class="logo">
                <h2>Film<span>Admin</span></h2>
                <i class="fa-solid fa-xmark close-sidebar" id="closeSidebar"></i>
            </div>
            <ul class="menu">
                <li class="{{ Request::is('admin') ? 'active' : '' }}" ><a href="/admin"><i class="fa-solid fa-gauge"></i> Tổng quan</a></li>
                <li class="{{ Request::is('admin/movie*') ? 'active' : '' }}">
                    <a href="{{ route('admin.movie.index') }}"><i class="fa-solid fa-film"></i> Quản lý Phim</a>
                </li>
                <li><a href="#"><i class="fa-solid fa-list"></i> Danh mục</a></li>
                <li class="{{ Request::is('admin/episode*') ? 'active' : '' }}"><a href="{{ route('admin.episode_index') }}"><i class="fa-solid fa-play"></i> Quản lý Tập phim</a></li>
                <li><a href="#"><i class="fa-solid fa-users"></i> Người dùng</a></li>
            </ul>
            <div class="logout">
                <a href="#"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
            </div>
        </aside>

        <main class="main-content">
            
            <header class="topbar">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <i class="fa-solid fa-bars hamburger-menu" id="hamburgerMenu"></i>
                    <!-- <div class="search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Tìm kiếm phim, người dùng...">
                    </div> -->
                </div>

                <div class="user-profile">
                    <span>Chào sếp, Admin!</span>
                    <img src="https://ui-avatars.com/api/?name=Admin&background=e2d703&color=111" alt="Admin">
                </div>
            </header>

            <div class="content-wrapper">
                @yield('content')
            </div>

        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const hamburger = document.getElementById('hamburgerMenu');
            const sidebar = document.getElementById('sidebar');
            const closeBtn = document.getElementById('closeSidebar');
            const overlay = document.getElementById('sidebarOverlay');

            function toggleSidebar() {
                sidebar.classList.toggle('active');
                if (sidebar.classList.contains('active')) {
                    overlay.style.display = 'block';
                    setTimeout(() => overlay.classList.add('show'), 10);
                } else {
                    overlay.classList.remove('show');
                    setTimeout(() => overlay.style.display = 'none', 300);
                }
            }

            if(hamburger) hamburger.addEventListener('click', toggleSidebar);
            if(closeBtn) closeBtn.addEventListener('click', toggleSidebar);
            if(overlay) overlay.addEventListener('click', toggleSidebar);
        });
    </script>

</body>
</html>