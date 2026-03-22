document.addEventListener("DOMContentLoaded", function() {
    // 1. XỬ LÝ MENU HAMBURGER MOBILE
    let hamburgerbtn = document.querySelector(".hamburger");
    let nav_list = document.querySelector(".site-nav-list"); // Đã update tên class mới
    let closebtn = document.querySelector(".site-nav-list .close"); // Đã update tên class mới

    if (hamburgerbtn && nav_list) {
        hamburgerbtn.addEventListener("click", () => {
            nav_list.classList.add("active");
        });
    }

    if (closebtn && nav_list) {
        closebtn.addEventListener("click", () => {
            nav_list.classList.remove("active");
        });
    }

    // 2. XỬ LÝ THANH TÌM KIẾM
    const liveSearch = document.getElementById('liveSearch');
    if (liveSearch) {
        liveSearch.addEventListener('input', function() {
            const dropdown = document.getElementById('searchDropdown');
            const keyword = this.value.trim();

            if (keyword.length > 0) {
                dropdown.classList.add('active'); // Mở dropdown
                
                // Cục HTML data ảo để test giao diện
                dropdown.innerHTML = `
                    <a href="#" class="search-item">
                        <img src="https://image.tmdb.org/t/p/w200/hLhB8aB8qM16sYw2Q2E5c6h5V8Q.jpg" alt="">
                        <div class="info">
                            <h5>Ma Cà Rồng Morbius</h5>
                            <span>Morbius • 2022 <i class="fa-solid fa-star"></i> 5.1</span>
                        </div>
                    </a>
                    <a href="#" class="search-item">
                        <img src="https://image.tmdb.org/t/p/w200/7WsyChQLEftFiDOVTGkv3hFpyyt.jpg" alt="">
                        <div class="info">
                            <h5>Doctor Strange 2</h5>
                            <span>HD • Full <i class="fa-solid fa-star"></i> 8.5</span>
                        </div>
                    </a>
                `;
            } else {
                dropdown.classList.remove('active'); // Đóng dropdown nếu xóa hết chữ
            }
        });
    }

    // Click ra ngoài thì tự động ẩn bảng kết quả
    document.addEventListener('click', function(e) {
        const searchBox = document.querySelector('.search-box');
        const dropdown = document.getElementById('searchDropdown');
        if (searchBox && dropdown && !searchBox.contains(e.target)) {
            dropdown.classList.remove('active');
        }
    });
});