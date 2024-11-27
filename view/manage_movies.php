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
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">Admin MoonPlay Cinema</div>
        <nav class="menu">
            <a href="manage_movies.php" class="active"><i class="fa-solid fa-film"></i> Manage Movies</a>
            <a href="manage_users.php"><i class="fa-solid fa-users"></i> Manage Users</a>
            <a href="#"><i class="fa-solid fa-comments"></i> Reviews</a>
            <a href="#" class="logout"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
        <header class="header">
            <h1>Movie Management</h1>
        </header>

        <!-- Section: Movies -->
        <section id="movies" class="section">
            <h2>List of Movies</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Release Year</th>
                        <th>Poster</th>
                        <th>Duration (min)</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($movie = $movie_result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $movie['movie_id'] ?></td>
                            <td><?= $movie['title'] ?></td>
                            <td><?= substr($movie['description'], 0, 50) . '...' ?></td>
                            <td><?= $movie['release_year'] ?></td>
                            <td>
                                <?php if (!empty($movie['poster_url'])): ?>
                                    <img src="<?= $movie['poster_url'] ?>" alt="Poster" style="width: 60px; height: auto;">
                                <?php else: ?>
                                    <span>No Image</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $movie['duration'] ?> mins</td>
                            <td><?= $movie['type'] ?></td>
                            <td>
                                <button class="btn edit">Edit</button>
                                <button class="btn delete">Delete</button>
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
