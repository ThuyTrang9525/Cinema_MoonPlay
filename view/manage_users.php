<?php
// Kết nối database
include '../model/connect.php';

// Lấy danh sách người dùng
$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<?php if (isset($_GET['message']) && $_GET['message'] == 'deleted'): ?>
    <div class="alert-success">User deleted successfully!</div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Management</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">Admin MoonPlay Cinema</div>
        <nav class="menu">
            <a href="manage_movies.php"><i class="fa-solid fa-film"></i> Manage Movies</a>
            <a href="manage_users.php" class="active"><i class="fa-solid fa-users"></i> Manage Users</a>
            <a href="#"><i class="fa-solid fa-comments"></i> Reviews</a>
            <a href="#" class="logout"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
        <header class="header">
            <h1>User Management</h1>
        </header>

        <section id="users" class="section">
            <h2>List of Users</h2>
            <?php if (isset($_GET['message']) && $_GET['message'] == 'deleted'): ?>
                <p style="color: green;">User deleted successfully!</p>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Avatar</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $user['user_id'] ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['role']) ?></td>
                            <td>
                                <?php if ($user['avatar']): ?>
                                    <img src="<?= $user['avatar'] ?>" alt="Avatar" class="avatar">
                                <?php else: ?>
                                    <img src="default-avatar.jpg" alt="Default Avatar" class="avatar">
                                <?php endif; ?>
                            </td>
                            <td>
                            <a href="/PHP_Project/controllers/delete_user.php?id=<?= $user['user_id'] ?>" class="btn delete">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <p>Admin MoonPlay Cinema Dashboard © 2024</p>
        </footer>
    </main>
</body>
</html>
