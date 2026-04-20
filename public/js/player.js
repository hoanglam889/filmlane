function changeVideo(url, epId, btn) {
    const player = document.getElementById('player');
    
    // 1. Đổi nguồn iframe
    player.src = url;

    // 2. CẬP NHẬT ID TẬP PHIM VÀO BIẾN TOÀN CỤC
    // Để khi bấm "Xem phim" nó biết sếp đang ở tập nào
    window.currentEpisodeId = epId;

    // 3. Cập nhật UI nút bấm
    document.querySelectorAll('.episode-btn').forEach(b => {
        b.classList.remove('active');
    });
    if (btn) btn.classList.add('active');
}

// Xử lý khi mở/đóng Modal
document.addEventListener("DOMContentLoaded", function () {
    const movieModal = document.getElementById('movieModal');
    const player = document.getElementById('player');
    const firstBtn = document.querySelector('.episode-btn');

    if (movieModal && player) {
        movieModal.addEventListener('shown.bs.modal', function () {
            if ((!player.getAttribute('src') || player.getAttribute('src') === '') && firstBtn) {
                // Lấy ID tập 1 từ thuộc tính data-episode-id của cái nút đầu tiên
                const firstEpId = firstBtn.getAttribute('data-episode-id');
                const firstUrl = firstBtn.getAttribute('onclick').match(/'([^']+)'/)[1];
                
                // Gọi hàm changeVideo xịn có kèm ID
                changeVideo(firstUrl, firstEpId, firstBtn);
            }
        });

        movieModal.addEventListener('hidden.bs.modal', function () {
            player.src = ''; 
        });
    }
});