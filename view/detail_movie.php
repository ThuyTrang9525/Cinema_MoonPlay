<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">   <!--sửa lại icon -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* =============================Start detail  movie ======================================================= */
body.detailMovie{
    background-color: black;
}
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
    top: 400px;
    padding-left: 70px;
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
</head>
<body class="detailMovie">
    <?php include('../model/header.php'); ?>
    <!-- Background -->
    <div class="background">
        <img src="../assets/image/Background.gif" alt="">
        <div class="type">
            <div>Hài kinh dị</div>
            <div>Hành động</div>
            <div>Kỳ ảo đen tối</div>
        </div>
    </div>
    <!-- Thông tin film -->
    <div class="infor-movie">
        <div class="poster">
            <div class="poster-img">
                <img src="../assets/image/poster.png" alt="">
            </div>
            <button><i class="fa-solid fa-play"></i> Xem ngay</button>                  
        </div>
        <div class="infor">
            <div class="name">
                <h1>Chainsaw Man</h1>
                <p class="n1">Thợ Săn Quỷ - Chainsaw Man</p>
                <p class="time"><i class="fa-regular fa-clock"></i> 1 giờ 41 phút</p>
            </div>
            <div class="detail">
                <p>Đạo diễn: Ryuu Nakayama</p>
                <p>Quốc gia: Nhật bản </p>
                <p>Khởi chiếu: 12/10/2022 </p>
            </div>
        </div>
    </div>
    <!-- Mô tả phim -->
     <div class="describe-movie">
        <p class="describe-movie-infomation" >
            Chainsaw Man là câu chuyện về Denji, một chàng trai nghèo khổ làm thợ săn quỷ để trả nợ, sống cùng chú chó quỷ cưa máy Pochita. 
            Sau khi bị phản bội và giết chết, Pochita hy sinh bản thân để cứu Denji, biến cậu thành Chainsaw Man với sức mạnh quỷ cưa máy. 
            Denji sau đó gia nhập tổ chức săn quỷ công, chiến đấu với quỷ dữ và khám phá ý nghĩa của tự do, tình yêu, cũng như khát vọng sống. 
            Bộ truyện nổi bật với sự kết hợp giữa hành động, kinh dị, hài hước và những khoảnh khắc xúc động sâu sắc.
        </p>
     </div>
    <!-- Diễn viên lồng tiếng hoặc diễn viên -->
    <div class="title-film"><p>DIỄN VIÊN</p></div>
    <div class="actor">
        <div class="performer">
            <div class="img">
                <img src="../assets/image/Kikunosuke_Toya.webp" alt="">
            </div>
            <div class="voiceover" >
                <p>Kikunosuke Toya</p>
                <p>Denji</p>
            </div>
        </div>

        <div class="performer">
            <div class="img">
                <img src="../assets/image/Tomori_Kusunoki.webp" alt="">
            </div>
            <div class="voiceover">
                <p>Tomori Kusunoki</p>
                <p>Makima</p>
            </div>
        </div>

        <div class="performer">
            <div class="img">
                <img src="../assets/image/Ai_Fairouz.webp" alt="">
            </div>
            <div class="voiceover">
                <p>Fairouz Ai</p>
                <p>Power</p>
            </div>
        </div>

        <div class="performer">
            <div class="img">
                <img src="../assets/image/Shogo_Sakata.webp" alt="">
            </div>
            <div class="voiceover">
                <p>Shogo Sakata</p>
                <p>Aki Hayakawa</p>
            </div>
        </div>

        <div class="performer">
            <div class="img">
                <img src="../assets/image/Ise_Mariya.webp" alt="">
            </div>
            <div class="voiceover">
                <p>Mariya Ise</p>
                <p>Himeno</p>
            </div>
        </div>
    </div>

    <!-- Phim tương tự -->
    <div class="title-film"><p>Phim tương tự</p></div>
    <div class="movies">
        <div><img src="../assets/image/kaiju-no-8.avif" alt=""></div>
        <div><img src="../assets/image/demon-slayer.avif" alt=""></div>
        <div><img src="../assets/image/attack-on-titan-eren-yeager-i195752.jpg" alt=""></div>
        <div><img src="../assets/image/61L74z3bhXS._AC_UF894,1000_QL80_.jpg" alt=""></div>
    </div>
    <!-- Footer -->
    <?php include('../model/footer.php'); ?>
</body>
</html>
