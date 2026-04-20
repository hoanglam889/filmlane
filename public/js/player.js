function changeVideo(url, epId, btn) {
    const player = document.getElementById('player');
    
    // 1. Đổi nguồn iframe
    player.src = url;

    // 2. Cập nhật ID tập phim vào biến toàn cục
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
        // Khi modal MỞ: nạp tập đầu tiên nếu chưa có src
        movieModal.addEventListener('shown.bs.modal', function () {
            if (!player.src || player.src === window.location.href || player.src === 'about:blank') {
                const firstSrc = player.getAttribute('data-first-src');
                const firstEpId = firstBtn ? firstBtn.getAttribute('data-episode-id') : null;

                if (firstSrc) {
                    changeVideo(firstSrc, firstEpId, firstBtn);
                }
            }
        });

        // Khi modal ĐÓNG: xóa src hoàn toàn để dừng video, không chạy ngầm
        movieModal.addEventListener('hide.bs.modal', function () {
            player.src = 'about:blank';
            setTimeout(() => { player.src = ''; }, 100);
        });
    }
});