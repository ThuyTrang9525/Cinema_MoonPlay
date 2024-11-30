document.querySelectorAll('.btn.edit').forEach(button => {
    button.addEventListener('click', function () {
        const row = this.closest('tr');
        document.getElementById('movie_id').value = row.cells[0].innerText;
        document.getElementById('title').value = row.cells[1].innerText;
        document.getElementById('description').value = row.cells[2].innerText.slice(0, -3); // Loại bỏ '...'
        document.getElementById('release_year').value = row.cells[3].innerText;
        document.getElementById('poster_url').value = row.querySelector('img')?.src || '';
        document.getElementById('duration').value = row.cells[5].innerText.split(' ')[0];
        document.getElementById('type').value = row.cells[6].innerText;
        document.getElementById('editModal').style.display = 'block';
    });
});

document.querySelector('.close').addEventListener('click', () => {
    document.getElementById('editModal').style.display = 'none';
});

document.getElementById('saveChanges').addEventListener('click', function () {
    const formData = new FormData(document.getElementById('editMovieForm'));
    fetch('../model/edit_movie.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        location.reload(); // Tải lại trang sau khi chỉnh sửa
    })
    .catch(error => console.error(error));
});

// Hiển thị modal khi nhấn nút Edit
document.querySelector('.btn.edit').addEventListener('click', function () {
    document.getElementById('editModal').style.display = 'block';
});

// Ẩn modal khi nhấn vào nút Close
document.querySelector('.close').addEventListener('click', function () {
    document.getElementById('editModal').style.display = 'none';
});

// Ẩn modal khi nhấn bên ngoài modal
window.addEventListener('click', function (event) {
    const modal = document.getElementById('editModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});
// Lấy nút Save Changes
document.getElementById('saveChanges').addEventListener('click', function () {
    // Thu thập dữ liệu từ form
    const movieId = document.getElementById('movie_id').value;
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const releaseYear = document.getElementById('release_year').value;
    const posterUrl = document.getElementById('poster_url').value;
    const duration = document.getElementById('duration').value;
    const type = document.getElementById('type').value;

    // Gửi dữ liệu qua AJAX
    fetch('../controller/editMovie.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            movie_id: movieId,
            title: title,
            description: description,
            release_year: releaseYear,
            poster_url: posterUrl,
            duration: duration,
            type: type,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert('Movie updated successfully!');
                // Cập nhật lại bảng nếu cần thiết hoặc reload trang
                location.reload(); // Tải lại trang để thấy thay đổi
            } else {
                alert('Failed to update movie. Please try again.');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Bạn có muốn tiếp tục?.');
        });

    // Đóng modal
    document.getElementById('editModal')})

    document.querySelectorAll('.btn.edit').forEach((button) => {
        button.addEventListener('click', function () {
            // Giả sử `data-movie` chứa thông tin phim (thêm thuộc tính này vào nút)
            const movieData = JSON.parse(this.getAttribute('data-movie'));
            document.getElementById('movie_id').value = movieData.movie_id;
            document.getElementById('title').value = movieData.title;
            document.getElementById('description').value = movieData.description;
            document.getElementById('release_year').value = movieData.release_year;
            document.getElementById('poster_url').value = movieData.poster_url;
            document.getElementById('duration').value = movieData.duration;
            document.getElementById('type').value = movieData.type;
    
            // Hiển thị modal
            document.getElementById('editModal').style.display = 'block';
        });
    });
    
    document.addEventListener('DOMContentLoaded', () => {
        const editButtons = document.querySelectorAll('.btn.edit');
        const editModal = document.getElementById('editModal');
        const closeEditModal = editModal.querySelector('.close');
    
        // Các trường trong form
        const movieIdField = document.getElementById('movie_id');
        const titleField = document.getElementById('title');
        const descriptionField = document.getElementById('description');
        const releaseYearField = document.getElementById('release_year');
        const posterUrlField = document.getElementById('poster_url');
        const trailerUrlField = document.getElementById('trailer_url');
        const videoUrlField = document.getElementById('video_url');
        const durationField = document.getElementById('duration');
        const typeField = document.getElementById('type');
    
        // Mở modal và điền dữ liệu
        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const row = button.closest('tr');
                const movieId = row.querySelector('td:nth-child(1)').textContent;
                const title = row.querySelector('td:nth-child(2)').textContent;
                const description = row.querySelector('td:nth-child(3)').textContent.replace('...', '');
                const releaseYear = row.querySelector('td:nth-child(4)').textContent;
                const posterUrl = row.querySelector('td:nth-child(5) img')?.src || '';
                const trailerUrl = row.querySelector('td:nth-child(6) a')?.href || '';
                const videoUrl = row.querySelector('td:nth-child(7) a')?.href || '';
                const duration = row.querySelector('td:nth-child(8)').textContent.split(' ')[0];
                const type = row.querySelector('td:nth-child(9)').textContent;
    
                // Điền dữ liệu vào form
                movieIdField.value = movieId;
                titleField.value = title;
                descriptionField.value = description;
                releaseYearField.value = releaseYear;
                posterUrlField.value = posterUrl;
                trailerUrlField.value = trailerUrl;
                videoUrlField.value = videoUrl;
                durationField.value = duration;
                typeField.value = type;
    
                // Hiển thị modal
                editModal.style.display = 'block';
            });
        });
    
        // Đóng modal
        closeEditModal.addEventListener('click', () => {
            editModal.style.display = 'none';
        });
    
        // Đóng modal khi click bên ngoài
        window.addEventListener('click', event => {
            if (event.target === editModal) {
                editModal.style.display = 'none';
            }
        });
    });
    