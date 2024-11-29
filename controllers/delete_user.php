<?php
// Kết nối database
include '../model/connect.php';

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']); // Đảm bảo $user_id là số nguyên

    // Thực hiện xóa người dùng
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Chuyển hướng với thông báo thành công
        header("Location: ../view/manage_users.php?message=deleted");
        exit();
    } else {
        // Thông báo lỗi nếu xóa không thành công
        alert( "Error: Could not delete user. Please try again.");
    }
} else {
    alert("Invalid Request: No user ID provided.") ;
}
?>
