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
    <style>
        :root {
            --bg-header: #222831;
            --bg-main: #393E46;
            --text-main: #EEEEEE;
            --highlight: #00ADB5;
            --danger: #FF5722;
            --font-main: 'Roboto', sans-serif;
        }

        body {
            margin: 0;
            font-family: var(--font-main);
            background-color: var(--bg-main);
            color: var(--text-main);
        }

        .sidebar {
            width: 240px;
            background: var(--bg-header);
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .sidebar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: var(--highlight);
        }

        .sidebar .menu a {
            text-decoration: none;
            color: var(--text-main);
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar .menu a:hover {
            background-color: var(--highlight);
            color: #000;
        }

        .main {
            margin-left: 260px;
            padding: 20px;
        }

        .header {
            background: var(--bg-header);
            padding: 20px;
            border-radius: 10px;
            font-size: 1.5rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: var(--text-main);
        }

        .table th,
        .table td {
            border: 1px solid #444;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background: var(--highlight);
            color: #000;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .btn.edit {
            background-color: var(--highlight);
            color: #000;
        }

        .btn.delete {
            background-color: var(--danger);
            color: #FFF;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            padding: 10px;
            background: var(--bg-header);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">Movie Admin</div>
        <nav class="menu">
            <a href="#" class="active"><i class="fa-solid fa-film"></i> Manage Movies</a>
            <a href="#"><i class="fa-solid fa-users"></i> Manage Users</a>
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
            <p>Movie Admin Dashboard © 2024</p>
        </footer>
    </main>
</body>
</html>
