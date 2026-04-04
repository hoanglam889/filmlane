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
    // 2. XỬ LÝ THANH TÌM KIẾM (REAL DATA TỪ DATABASE)
const liveSearch = document.getElementById('liveSearch');
if (liveSearch) {
    let timeoutId = null; // Biến này để chống spam gọi API (Debounce)

    liveSearch.addEventListener('input', function() {
        const dropdown = document.getElementById('searchDropdown');
        const keyword = this.value.trim();

        // Xóa bộ đếm cũ nếu khách vẫn đang gõ liên tục
        clearTimeout(timeoutId);

        if (keyword.length > 0) {
            dropdown.classList.add('active'); 
            dropdown.innerHTML = `<div style="padding: 15px; color: #ccc; text-align: center;">Đang tìm kiếm...</div>`;

            // Đợi khách ngừng gõ 0.5s (500ms) rồi mới bắn Request xuống Database
            timeoutId = setTimeout(() => {
                fetch(`/tim-kiem-ajax?keyword=${encodeURIComponent(keyword)}`)
                    .then(response => response.json())
                    .then(data => {
                        dropdown.innerHTML = ''; // Xóa chữ "Đang tìm kiếm"
                        
                        if (data.length > 0) {
                            // Duyệt qua từng phim và in ra HTML
                            data.forEach(movie => {
                                // Xử lý đường dẫn ảnh (nếu lưu dạng uploads/... thì thêm dấu / phía trước)
                                let imgPath = movie.image.startsWith('http') ? movie.image : `/${movie.image}`;
                                
                                dropdown.innerHTML += `
                                    <a href="/movie-detail/${movie.slug}" class="search-item">
                                        <img src="${imgPath}" alt="${movie.title}">
                                        <div class="info">
                                            <h5>${movie.title}</h5>
                                            <span>${movie.year || 'Đang cập nhật'} • ${movie.resolution || 'HD'}</span>
                                        </div>
                                    </a>
                                `;
                            });
                        } else {
                            // Nếu tìm không ra phim
                            dropdown.innerHTML = `<div style="padding: 15px; color: #ff4d4d; text-align: center;">Không tìm thấy phim: "${keyword}"</div>`;
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi tìm kiếm:', error);
                    });
            }, 500);

        } else {
            dropdown.classList.remove('active'); 
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
//click vào lại chữ thì đóng
document.addEventListener('click', function(e) {
    const searchBox = document.querySelector('.search-box');
    const dropdown = document.getElementById('searchDropdown');
    if (searchBox && dropdown && !searchBox.contains(e.target)) {
        dropdown.classList.remove('active');
    }
});
});