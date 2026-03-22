function changeVideo(url, btn) {
    const player = document.getElementById('player');
    
    // 1. Đổi nguồn của iframe sang tập mới
    player.src = url;

    // 2. Cập nhật UI nút bấm (xóa active cũ, thêm active mới)
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
        // KHI MỞ MODAL: Tự động bấm tập 1 nếu chưa chiếu gì
        movieModal.addEventListener('shown.bs.modal', function () {
            if ((!player.getAttribute('src') || player.getAttribute('src') === '') && firstBtn) {
                firstBtn.click();
            }
        });

        // KHI ĐÓNG MODAL: Rút phích cắm điện, tắt 100% âm thanh
        movieModal.addEventListener('hidden.bs.modal', function () {
            player.src = ''; // Xóa sạch src, cắt đứt hoàn toàn iframe
        });
    }
});