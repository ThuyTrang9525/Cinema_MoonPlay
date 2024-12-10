<?php
include_once "../model/connect.php";


// Lấy ID phim từ GET
$movie_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy danh sách bình luận
$sql_comments = "
    SELECT comments.content, comments.commented_at, users.username, users.avatar
    FROM comments
    JOIN users ON comments.user_id = users.user_id
    WHERE comments.movie_id = ?
";
$stmt_comments = $conn->prepare($sql_comments);
$stmt_comments->bind_param("i", $movie_id);
$stmt_comments->execute();
$result_comments = $stmt_comments->get_result();

// Xử lý thêm bình luận
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_content'])) {
    // Kiểm tra xem user_id có tồn tại không (Giả sử user_id có sẵn từ session)
    session_start();  // Khởi tạo session để lấy user_id
    if (!isset($_SESSION['user_id'])) {
        die("Bạn cần đăng nhập để bình luận.");
    }

    $user_id = $_SESSION['user_id'];
    $content = trim($_POST['comment_content']);
    
    if (!empty($content)) {
        // Chuẩn bị câu lệnh SQL
        $sql_insert_comment = "INSERT INTO comments (movie_id, user_id, content) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert_comment);

        // Kiểm tra nếu câu lệnh chuẩn bị không thành công
        if ($stmt_insert === false) {
            die("Lỗi khi chuẩn bị câu lệnh SQL: " . $conn->error);
        }

        // Gắn các tham số vào câu lệnh SQL
        $stmt_insert->bind_param("iis", $movie_id, $user_id, $content);

        // Kiểm tra nếu câu lệnh execute không thành công
        if ($stmt_insert->execute()) {
            // Kiểm tra số hàng bị ảnh hưởng (kiểm tra xem có dòng nào bị thêm vào không)
            if ($stmt_insert->affected_rows > 0) {
                echo "Thêm bình luận thành công!";
                header("Location: movie_showing.php?id=$movie_id");
                exit();
            } else {
                die("Không có bình luận nào được thêm vào cơ sở dữ liệu.");
            }
        } else {
            // Nếu execute không thành công, lấy thông báo lỗi chi tiết
            die("Lỗi khi chèn bình luận: " . $stmt_insert->error . " - " . $stmt_insert->errno);
        }
    } else {
        die("Nội dung bình luận không được để trống.");
    }
}
?>
