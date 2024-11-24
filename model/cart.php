<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="cart">
    <div class="container">
        <h2 class="title">MoonPlay</h2>
        <p class="introduce">
            Chào mừng bạn đến với trang minigame tuyệt vời của MoonPlay - nền tảng phim trực tuyến đa dạng và thú vị!
            Chúng tôi không chỉ mang đến cho bạn những bộ phim đỉnh cao mà còn cung cấp một trải nghiệm giải trí hoàn chỉnh.
            Đặc biệt, trang minigame của chúng tôi sẽ làm bạn phấn khích hơn bao giờ hết.
        </p>

        <!-- Giỏ Hàng -->
        <h2 class="cart">Giỏ Hàng</h2>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên Phim</th>
                    <th>Giá</th>
                    <th>Chọn</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Dynamic items will be added here -->
            </tbody>
        </table>

        <!-- Voucher -->
        <h2 class="voucher">Voucher</h2>
        <table class="voucher-table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên Gói</th>
                    <th>Giá</th>
                    <th>Chọn</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody id="voucher-items">
                <!-- Dynamic items will be added here -->
            </tbody>
        </table>

        <!-- Tổng Tiền -->
        <div class="cart-summary">
            <div class="price">
                <p>Tổng Giá:</p>
                <span id="total-price">0 VND</span>
            </div>
            <div class="total">
                <p>Tổng Số Lượng: </p>
                <span id="total-quantity">0</span>

            </div>

           
        </div>
    </div>
</body>
</html>
