<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../controllers/invoice-back.php">
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
         <form method="POST" action="/controllers/invoice-back.php">
        <div class="info-hoadon">
            <label for="name">Họ tên</label>
            <input type="text" id="name" name="name" placeholder="Họ tên bạn là" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">

            <label for="sdt">Sđt</label>
            <input type="text" id="sdt" name="sdt" placeholder="Số điện thoại bạn là" value="<?php echo htmlspecialchars($_POST['sdt'] ?? ''); ?>">

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Email bạn là" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">

            <div class="payment-method-options">
                <label><input type="radio" name="payment" value="credit" <?php if (!empty($_POST['payment']) && $_POST['payment'] === 'credit') echo 'checked'; ?>> Trực tiếp</label>
                <label><input type="radio" name="payment" value="momo" <?php if (!empty($_POST['payment']) && $_POST['payment'] === 'momo') echo 'checked'; ?>> MoMo</label>
                <label><input type="radio" name="payment" value="paypal" <?php if (!empty($_POST['payment']) && $_POST['payment'] === 'paypal') echo 'checked'; ?>> ZaloPay</label>
                <label><input type="radio" name="payment" value="bank" <?php if (!empty($_POST['payment']) && $_POST['payment'] === 'bank') echo 'checked'; ?>> Ngân hàng</label>
            </div>

            <?php if (!isset($_SESSION['confirmation_code'])): ?>
                <button type="submit" name="send_code">Gửi mã xác nhận</button>
            <?php else: ?>
                <label for="maxn">Mã xác nhận</label>
                <input type="text" id="maxn" name="maxn" placeholder="Mã xác nhận của bạn là">
                <button type="submit" name="confirm_payment">Xác nhận thanh toán</button>
            <?php endif; ?>
        </div>
    </form>
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