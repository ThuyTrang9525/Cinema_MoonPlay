<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../model/connect.php';

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $movie_id = $_POST['movie_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $release_year = $_POST['release_year'];
    $poster_url = $_POST['poster_url'];
    // Lấy thêm dữ liệu từ form
    $trailer_url = $_POST['trailer_url'];
    $video_url = $_POST['video_url'];

    $duration = $_POST['duration'];
    $type = $_POST['type'];

    // Cập nhật dữ liệu trong cơ sở dữ liệu
    $sql = "UPDATE movies SET title = ?, description = ?, release_year = ?, poster_url = ?, duration = ?, type = ? WHERE movie_id = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssisssi", $title, $description, $release_year, $poster_url, $duration, $type, $movie_id);

    // Kiểm tra nếu câu lệnh update thành công
    if ($stmt->execute()) {
        // Nếu thành công, chuyển hướng về manage_movies.php
        header("Location: ../view/manage_movies.php?success=1");
        exit;
    } else {
        // Nếu thất bại, trả về thông báo lỗi
        echo json_encode(['message' => 'Chỉnh sửa không thành công']);
    }
    $sql = "UPDATE movies 
        SET title = ?, 
            description = ?, 
            release_year = ?, 
            poster_url = ?, 
            trailer_url = ?, 
            video_url = ?, 
            duration = ?, 
            type = ? 
        WHERE movie_id = ?";
$stmt = $conn->prepare($sql);

// Bind thêm các tham số
$stmt->bind_param("ssisssisi", $title, $description, $release_year, $poster_url, $trailer_url, $video_url, $duration, $type, $movie_id);

    // Đóng kết nối
    $stmt->close();
    $conn->close();
}
?>
