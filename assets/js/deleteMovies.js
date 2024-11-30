document.querySelectorAll('.btn.delete').forEach(button => {
    button.addEventListener('click', function () {
        if (confirm('Bạn có chắc chắn muốn xóa phim?')) {
            const movie_id = this.closest('tr').cells[0].innerText;
            fetch(`../model/delete_movie.php?movie_id=${movie_id}`, { method: 'GET' })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(error => console.error(error));
        }
    });
});
