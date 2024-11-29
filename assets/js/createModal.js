// Mở modal khi nhấn nút Create
document.querySelector('.btn.create').addEventListener('click', function () {
    document.getElementById('createModal').style.display = 'block';
});

// Đóng modal khi nhấn nút Close
document.querySelectorAll('.modal .close').forEach(closeButton => {
    closeButton.addEventListener('click', function () {
        this.closest('.modal').style.display = 'none';
    });
});

// Đóng modal khi nhấn bên ngoài modal
window.addEventListener('click', function (event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
document.getElementById('createMovieButton').addEventListener('click', function () {
    const formData = new FormData(document.getElementById('createMovieForm'));

    fetch('../controller/createMovie.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.message === 'Tạo mới phim thành công') {
                location.reload(); // Reload để cập nhật danh sách phim
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Chưa điền đủ thông tin. Ban có muốn tiếp tuc?');
        });
});
