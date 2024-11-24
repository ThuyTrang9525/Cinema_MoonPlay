<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">   <!--sửa lại icon -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="detail-movie">
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
        <p>
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
