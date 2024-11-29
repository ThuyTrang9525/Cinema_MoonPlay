<?php
// Kết nối cơ sở dữ liệu
include '../model/connect.php';

// Kiểm tra nếu có dữ liệu POST từ form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $release_year = $_POST['release_year'];
    $poster_url = $_POST['poster_url'] ?? null; // Giá trị có thể NULL
    $trailer_url = $_POST['trailer_url'] ?? null; // Giá trị có thể NULL
    $thumb_url = $_POST['thumb_url'] ?? null; // Giá trị có thể NULL
    $duration = $_POST['duration'];
    $type = $_POST['type'];

    // Validate dữ liệu cơ bản
    if (empty($title) || empty($description) || empty($release_year) || empty($duration) || empty($type)) {
        alert("Vui lòng điền đủ thông tin") ;
        exit;
    }

    // Thêm dữ liệu vào database
    $sql = "INSERT INTO movies (title, description, release_year, poster_url,trailer_url, thumb_url, duration, type) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Kiểm tra lỗi prepare
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit;
    }

    // Bind và execute
    $stmt->bind_param("ssissssi", $title, $description, $release_year, $poster_url,$trailer_url,$thumb_url, $duration, $type);

    if ($stmt->execute()) {
        header("Location: ../view/manage_movies.php?success=1");
        exit;  // Đảm bảo không có mã nào khác chạy sau khi chuyển hướng
    } else {
        echo "Error adding movie: (" . $stmt->errno . ") " . $stmt->error;
    }
    
    // Đóng kết nối
    $stmt->close();
    $conn->close();
}
?>
