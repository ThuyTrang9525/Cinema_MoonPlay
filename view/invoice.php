<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
     <!-- Header -->
     <?php include('../model/header.php'); ?>

     <!-- Main Content -->
    <section class="intro">
        <h2>MoonPlay</h2>
        <p>Chúng tôi rất biết ơn sự quan tâm của bạn đến MoonPlay. Tuy nhiên, để nhận được những ưu đãi đặc biệt và
            trải nghiệm
            phong phú hơn, chúng tôi muốn khuyên bạn nên mua phim trực tiếp từ trang web chính thức của MoonPlay.
            Khi mua trực tiếp
            từ chúng tôi, bạn sẽ được hưởng nhiều lợi ích.</p>
    </section>

    <!-- First Content Section -->
    <section class="first-content">
        <div class="info-hoadon">
            <label for="name">Họ tên</label>
            <input type="text" id="name" placeholder="Họ tên bạn là">

            <label for="sdt">Sđt</label>
            <input type="text" id="sdt" placeholder="Số điện thoại bạn là">
    
            <label for="email">Email:</label>
            <input type="text" id="email" placeholder="Email bạn là">
    
            <div class="payment-method-options">
                <label><input type="radio" name="payment" value="credit"> Trực tiếp</label>
                <label><input type="radio" name="payment" value="paypal"> MoMo</label>
                <label><input type="radio" name="payment" value="paypal"> ZaloPay</label>
                <label><input type="radio" name="payment" value="paypal"> Ngân hàng</label>
            </div>

            <label for="maxn">Mã xác nhận</label>
            <input type="text" id="maxn" placeholder="Số điện thoại bạn là">
    
            <button>Thanh toán</button>
        </div>
        <div class="suggessted-movies">
            <a href="#"><img src="../assets/image/Hình ảnh/image 31.jpg" alt="Movie Suggestion 1"></a>
            <a href="#"><img src="../assets/image/Hình ảnh/image 29.jpg" alt="Movie Suggestion 3"></a>
            <a href="#"><img src="../assets/image/Hình ảnh/image 7.jpg" alt="Movie Suggestion 4"></a>
            <a href="#"><img src="../assets/image/Hình ảnh/image 53.jpg" alt="Movie Suggestion 5"></a>
            <a href="#"><img src="../assets/image/Hình ảnh/image 49.jpg" alt="Movie Suggestion 6"></a>
            <a href="#"><img src="../assets/image/Hình ảnh/image 51.jpg" alt="Movie Suggestion 7"></a>
        </div>
    </section>

     <?php include('../model/useMore.php')?>


      <!-- Footer -->
    <?php include('../model/footer.php'); ?>
    
</body>
</html>