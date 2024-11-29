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
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo"> MoonPlay Cinema</div>
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
            <button class="btn create">
                <p>Insert new Movie</p> 
            </button>
            
            <div id="createModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Insert Movie</h2>
                    <form id="createMovieForm" action="../controllers/createMovies.php" method="POST">
                        <label>Title:</label>
                        <input type="text" name="title" id="create_title" required>
                        
                        <label>Description:</label>
                        <textarea name="description" id="create_description" required></textarea>
                        
                        <label>Release Year:</label>
                        <input type="number" name="release_year" id="create_release_year" required>
                        
                        <label>Poster URL:</label>
                        <input type="text" name="poster_url" id="create_poster_url">
                        <label>Trailer URL:</label>
                        <input type="text" name="poster_url" id="create_trailer_url">
                        <label>Video URL:</label>
                        <input type="text" name="poster_url" id="create_video_url">
                        
                        <label>Duration (min):</label>
                        <input type="number" name="duration" id="create_duration" required>
                        
                        <label>Type:</label>
                        <input type="text" name="type" id="create_type" required>
                        
                        <!-- Đổi type="submit" để gửi dữ liệu -->
                        <button type="submit" id="createMovieButton">Add Movie</button>
                    </form>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Release Year</th>
                        <th>Poster</th>
                        <th>Trailer</th>
                        <th>Video</th>
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
                            <td>
                                <?php if (!empty($movie['trailer_url'])): ?>
                                    <a href="<?= $movie['trailer_url'] ?>" target="_blank">Trailer</a>
                                <?php else: ?>
                                    <span>No Trailer</span>
                                <?php endif; ?>
                                
                            </td>
                            <td>
                                <?php if (!empty($movie['thumb_url'])): ?>
                                    <a href="<?= $movie['thumb_url'] ?>" target="_blank">Video</a>
                                <?php else: ?>
                                    <span>No Video</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $movie['duration'] ?> mins</td>
                            <td><?= $movie['type'] ?></td>
                            <td>
                                <!-- Nút Edit -->
                                <button class="btn edit">Edit</button>

                                <!-- Modal (đặt bên ngoài nút Edit) -->
                                <div id="editModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <h2>Edit Movie</h2>
                                        <form id="editMovieForm" action="../controllers/editMovies.php" method="POST">
                                            <!-- Hidden field for movie ID -->
                                            <input type="hidden" name="movie_id" id="movie_id">

                                            <label>Title:</label>
                                            <input type="text" name="title" id="title" required>

                                            <label>Description:</label>
                                            <textarea name="description" id="description" required></textarea>

                                            <label>Release Year:</label>
                                            <input type="number" name="release_year" id="release_year" required>

                                            <label>Poster URL:</label>
                                            <input type="text" name="poster_url" id="poster_url">

                                            <label>Trailer URL:</label>
                                            <input type="text" name="trailer_url" id="trailer_url">

                                            <label>Video URL:</label>
                                            <input type="text" name="video_url" id="video_url">

                                            <label>Duration (min):</label>
                                            <input type="number" name="duration" id="duration" required>

                                            <label>Type:</label>
                                            <input type="text" name="type" id="type" required>

                                            <button type="submit" id="saveChanges">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                                <a href="../controllers/deleteMovies.php?movie_id=<?= $movie['movie_id'] ?>" class="btn delete">Delete</a>
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
    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/createModal.js"></script>
</body>
</html>
