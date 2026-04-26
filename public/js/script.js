// Responsive carousel or card slider
const wrapper = document.querySelector(".wrapper");
const carousel = document.querySelector(".movie-carousel");

// Kiểm tra xem có carousel không để tránh lỗi ở trang detail
if (wrapper && carousel) {
    const firstCardWidth = carousel.querySelector(".card").offsetWidth;
    const carouselChildrens = [...carousel.children];

    let isDragging = false,
      isAutoPlay = true,
      startX,
      startScrollLeft,
      timeoutId;

    // Lấy số lượng thẻ hiển thị trên màn hình hiện tại
    let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

    // Copy thẻ vào đầu và cuối để tạo hiệu ứng lặp vô tận (Infinite Scroll)
    carouselChildrens
      .slice(-cardPerView)
      .reverse()
      .forEach((card) => {
        carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
      });

    carouselChildrens.slice(0, cardPerView).forEach((card) => {
      carousel.insertAdjacentHTML("beforeend", card.outerHTML);
    });

    carousel.classList.add("no-transition");
    carousel.scrollLeft = carousel.offsetWidth;
    carousel.classList.remove("no-transition");

    // ================= XỬ LÝ KÉO / VUỐT =================
    const dragStart = (e) => {
      isDragging = true;
      carousel.classList.add("dragging");
      // Hỗ trợ cả chuột (pageX) và ngón tay (touches[0].pageX)
      startX = e.pageX || e.touches[0].pageX;
      startScrollLeft = carousel.scrollLeft;
    };

    const dragging = (e) => {
      if (!isDragging) return; 
      const currentX = e.pageX || e.touches[0].pageX;
      carousel.scrollLeft = startScrollLeft - (currentX - startX);
    };

    const dragStop = () => {
      isDragging = false;
      carousel.classList.remove("dragging");
    };

    const infiniteScroll = () => {
      if (carousel.scrollLeft === 0) {
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.scrollWidth - 2 * carousel.offsetWidth;
        carousel.classList.remove("no-transition");
      }
      else if (Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth) {
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.offsetWidth;
        carousel.classList.remove("no-transition");
      }

      clearTimeout(timeoutId);
      if (!wrapper.matches(":hover")) autoPlay();
    };

    // ================= SỬA LỖI ĐƠ AUTOPLAY TRÊN MOBILE =================
    const autoPlay = () => {
      if (!isAutoPlay) return; 
      // XÓA cái chặn < 800px đi rồi, giờ màn nào nó cũng tự trượt hết
      timeoutId = setTimeout(() => (carousel.scrollLeft += firstCardWidth), 2500);
    };
    
    autoPlay();

    // Sự kiện cho CHUỘT (PC)
    carousel.addEventListener("mousedown", dragStart);
    carousel.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);
    
    // Sự kiện cho CẢM ỨNG (MOBILE/TABLET)
    carousel.addEventListener("touchstart", dragStart);
    carousel.addEventListener("touchmove", dragging);
    document.addEventListener("touchend", dragStop);

    carousel.addEventListener("scroll", infiniteScroll);
    wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
    wrapper.addEventListener("mouseleave", autoPlay);
    
    // Chạm vào điện thoại thì tạm dừng autoplay cho người ta đọc
    wrapper.addEventListener("touchstart", () => clearTimeout(timeoutId));
    wrapper.addEventListener("touchend", autoPlay);
}

// ================= BACK TO TOP =================
let backbtn = document.querySelector(".back-to-top");
if (backbtn) {
    const scrollBtnDisplay = function () {
      window.scrollY > 100
        ? backbtn.classList.add("show")
        : backbtn.classList.remove("show");
    };
    window.addEventListener("scroll", scrollBtnDisplay);

    const scrollWindow = function () {  
      if (window.scrollY != 0) {
        setTimeout(function () {
          window.scrollTo(0, window.scrollY - 50);
          scrollWindow();
        }, 10);
      }
    };
    backbtn.addEventListener("click", scrollWindow);
}

// ================= LIKE/SAVE MOVIE FUNCTIONALITY =================
document.querySelectorAll(".like-btn").forEach(btn => {
    btn.addEventListener("click", async (e) => {
        e.preventDefault();
        const movieId = btn.dataset.movieId;
        const isLiked = btn.classList.contains("liked");
        
        // Check if user is logged in
        try {
            const response = await fetch("/api/check-auth");
            const data = await response.json();
            
            if (!data.authenticated) {
                alert("Vui lòng đăng nhập để lưu phim!");
                window.location.href = "/login";
                return;
            }
            
            // Send like/unlike request
            const likeResponse = await fetch("/api/toggle-like", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    movie_id: movieId,
                    action: isLiked ? "unlike" : "like"
                })
            });
            
            const likeData = await likeResponse.json();
            
            if (likeData.success) {
                btn.classList.toggle("liked");
                // Solid heart if liked, regular if not
                const icon = btn.querySelector("i");
                if (isLiked) {
                    icon.classList.remove("fa-solid");
                    icon.classList.add("fa-regular");
                } else {
                    icon.classList.remove("fa-regular");
                    icon.classList.add("fa-solid");
                }
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Có lỗi xảy ra. Vui lòng thử lại!");
        }
    });
});


//SAVE HISTORY
document.addEventListener("DOMContentLoaded", function() {
    let isSaved = false;

    document.body.addEventListener('click', function(event) {
        // 1. Tìm xem sếp có click trúng 1 trong 3 thằng này không:
        // - Nút Xem phim (.btn-save-history)
        // - Tab Server (.server-tab-custom)
        // - Icon tròn trên ảnh (.fa-circle-play)
        const target = event.target.closest('.btn-save-history, .server-tab-custom, .fa-circle-play');

        if (target) {
            if (isSaved) return;

            // 2. Kỹ thuật lấy ID "Xuyên thấu": 
            // Nếu thằng vừa bấm không có data-movie-id, nó sẽ tìm ở thằng con hoặc thằng bố gần nhất
            let movieId = target.getAttribute('data-movie-id') || 
                          target.querySelector('[data-movie-id]')?.getAttribute('data-movie-id');

            if (!movieId) {
                console.error("❌ Không tìm thấy ID phim! Sếp check lại HTML xem đã gắn data-movie-id chưa.");
                return;
            }

            const token = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!token) {
                console.error("❌ Thiếu Token CSRF trên Header!");
                return;
            }

            console.log("🚀 Đã tóm được phim ID: " + movieId + ". Chờ 5 giây để lưu...");

            setTimeout(() => {
                // Gửi request thẳng lên server (Server sẽ tự check auth bên trong)
                fetch('/user/save-history', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ 
                        movie_id: movieId,
                        episode_id: window.currentEpisodeId || null // Gửi thêm ID tập phim nếu đang xem
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        console.log("✅ HOÀN TẤT: " + data.message);
                        isSaved = true;
                    }
                })
                .catch(err => console.error("❌ LỖI KHI GỬI ACTIVITY:", err));
            }, 5000);
        }
    });
});