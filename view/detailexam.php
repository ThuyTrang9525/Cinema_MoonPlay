
<style>
        /* =============================Start detail  movie ======================================================= */
/* background */
.background {
    height: 700px;
    width: 100%;
    padding-top: 50px;
    position: absolute;
}
.background img {
    width: 100%;
    height: 100%;
}

.type {
    display: flex;
    justify-content: flex-end; 
    color: aliceblue;
    position: absolute;
    bottom: 10px; 
    right: 20px; 
    gap: 15px; 
}

.type div {
    border: 1px solid white;
    border-radius: 10px;
    padding: 10px 15px;
    margin-top: 20px;
}

/* container*/

.infor-movie {
    display: flex;
    position: relative;
    padding-left: 70px;
    background-color: black;
    margin-bottom: 100px;
}
.poster {
    position: relative; 
    width: 400px;
    height: 600px;
    margin-top: 20px;
}

.poster-img img {
    width: 400px;
    height: 600px;
    border-radius: 10px;
}
.poster button {
    padding: 13px 20px;
    margin-top: 20px;
    font-size: 26px;
    color: white;
    background-color: red;
    border-radius: 10px;
    width: 100%;
    height: 60px;
    border: none;
    cursor: pointer;
    position: relative; 
    z-index: 10; 
    transition: transform 0.3s ease;

}
.poster button:hover {
    background-color: rgb(137, 137, 137);
    transition: all 0.3s ease;
    color: black;
    transform: scale(1.1);
}


.infor {
    padding-left: 80px;
}
.name {
    font-size: 40px;
    color: white;
}
.name h1 {
    margin-top: 20px;
    margin-bottom: 0;
}
.name .n1 {
    margin-top: 0;
    margin-bottom: 40px;
    font-size: 26px;
}

.name .time {
    margin-bottom: 10px;
    font-size: 35px;
}
.detail {
    padding-top: 100px;
    font-size: 26px;
    color: white;
}

/* describe-movie */
.describe-movie{
    color: aliceblue;
    position: relative; 
    font-size: 20px;
    padding: 500px 75px 0px 75px;
}
.describe-movie-infomation {
    margin-top: 100px;
}
/* actor */
.title-film {
    font-size: 26px;
    color: aliceblue;
    padding: 30px 70px ;

}
.actor {
    display: flex;
}

.performer {
    padding: 0px 50px 0px 70px;
}

.performer .img {
    width: 180px;
    height: 160px;
    
}

.performer .img img {
    border-radius: 100%;
    width: 100%;
    height: 100%;
}

.voiceover {
    font-size: 20px;
    color: aliceblue;
    text-align: center;
}

/* Movies */
.movies {
    display: flex;
}
.movies div {
    width: 1600px;
    height: 400px;
    padding: 10px 50px;
    transition: transform 0.3s ease;
    cursor: pointer;
}
.movies div:hover {
    transform: scale(1.1);
}
.movies img {
    width: 100%;
    height: 100%;
    border-radius: 15px;
}

/* ============================= End detail  movie ======================================================= */
    </style>
<?php
require_once('../model/connect.php');

// Get and sanitize input
$movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 1;

// Correct the query
$query = "SELECT * FROM movies WHERE movie_id = $movie_id";
$result = mysqli_query($conn, $query);

// Check if the query succeeded
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch and display the data
$row = mysqli_fetch_assoc($result);


if ($row && mysqli_num_rows($result) > 0) {
    // $movie = mysqli_fetch_assoc($row);
    $movie = $row;

    // Gán dữ liệu phim vào biến
    $poster = $movie['poster_url'];
    $thumb = $movie['thumb_url'];
    $title = $movie['title'];
    $type = $movie['type'];
    $duration = $movie['duration'];
    $release_year = $movie['release_year'];
    $description = $movie['description'];
    $actor = $movie['actor'];
} else {
    die("Không tìm thấy phim.");
}
?>

<div class="infor-movie">
        <div class="poster">
            <div class="poster-img">
            <img src="<?php echo $poster; ?>" alt="<?php echo $title; ?>">
            </div>
            <button><i class="fa-solid fa-play"></i> Xem ngay</button>                  
        </div>
        <div class="infor">
            <div class="name">
                <h1><?php echo $title; ?></h1>
            </div>
            <div class="detail">
                <p>Diễn viên: <?php echo $actor; ?></p>
                <p>Thể loại: <?php echo $type; ?> </p>
                <p >Thời gian  <?php echo $duration; ?> phút</p>
                <p>Khởi chiếu: <?php echo $release_year; ?> </p>
            </div>
        </div>
    </div>
<?php
    $sql_related = "SELECT * FROM movies WHERE type LIKE '%{$movie['type']}%' AND movie_id != $movie_id LIMIT 4";
    $result_related = mysqli_query($conn, $sql_related);
    ?>
    <div class="movies">
        <?php
        while ($related = mysqli_fetch_assoc($result_related)) {
            echo '
            <div>
                <img src="' . htmlspecialchars($related['poster_url']) . '" alt="' . htmlspecialchars($related['title']) . '">
                <p>' . htmlspecialchars($related['title']) . '</p>
            </div>';
        }
        ?>
    </div>