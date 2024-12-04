<?php
session_start();

// Xóa toàn bộ session
session_unset();
session_destroy();

header("Location: ../view/main.php");
exit();

// Chuyển hướng về trang login
// header("Location: ../view/login.php");
// exit();
?>
