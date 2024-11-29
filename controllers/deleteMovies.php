<?php
include '../model/connect.php';

if (isset($_GET['movie_id'])) {
    $movie_id = $_GET['movie_id'];
    $sql = "DELETE FROM movies WHERE movie_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $movie_id);
    if ($stmt->execute()) {
        header("Location: ../view/manage_movies.php?message=deleted");
        exit();
    } else {
        echo json_encode(['message' => 'Lỗi không xóa phim được']);
    }
}
?>
<?php if (isset($_GET['message']) && $_GET['message'] === 'deleted'): ?>
    <script>
        alert('Movie deleted successfully!');
    </script>
<?php endif; ?>
