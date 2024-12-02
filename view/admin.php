<?php
// Kết nối database
include '../model/connect.php';

// Lấy dữ liệu phim
$movie_sql = "SELECT * FROM movies";
$movie_stmt = $conn->prepare($movie_sql);
$movie_stmt->execute();
$movie_result = $movie_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Movie Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<?php include('../view/manage_movies.php'); ?>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">MoonPlay Cinema</div>
        <nav class="menu">
            <a href="manage_movies.php" class="active"><i class="fa-solid fa-film"></i> Manage Movies</a>
            <a href="manage_users.php"><i class="fa-solid fa-users"></i> Manage Users</a>
            <a href="#"><i class="fa-solid fa-comments"></i> Reviews</a>
            <a href="#" class="logout" onclick="showLogoutConfirmation(event)"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <!-- Logout Confirmation Modal -->
    <div id="logout-modal" class="modal hidden">
    <div class="modal-content">
        <p>Bạn có muốn đăng xuất không?</p>
        <div class="modal-buttons">
            <button onclick="logout()">Đồng ý</button>
            <button onclick="hideLogoutConfirmation()">Hủy</button>
        </div>
    </div>
</div>

    <script>
       function showLogoutConfirmation(event) {
            event.preventDefault(); // Ngừng hành động mặc định của liên kết
            document.getElementById('logout-modal').classList.remove('hidden'); // Hiển thị modal
        }

        function hideLogoutConfirmation() {
            document.getElementById('logout-modal').classList.add('hidden'); // Ẩn modal
        }

        function logout() {
            // Gửi yêu cầu logout đến server
            window.location.href = "../controller/logout.php"; // Điều hướng đến controller logout
        }
    </script>
</body>
</html>
