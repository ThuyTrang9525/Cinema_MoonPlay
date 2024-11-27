<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Nếu người dùng đã đăng nhập, hiển thị nội dung trang chính
// echo "Chào mừng, " . $_SESSION['username'] . "! Bạn đã đăng nhập thành công.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Streaming Website</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include('../model/header.php'); ?>
    <?php include('../model/banner.php'); ?>
    <?php include('../model/typeMovie.php'); ?>


    <?php include('../model/category.php'); ?>
    <?php include('../model/movieTop.php'); ?>

    <?php include('../model/footer.php'); ?>
</body>
</html>
