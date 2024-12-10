<?php
session_start();
// Kiểm tra xem người dùng đã đăng nhập hay chưa
$isLoggedIn = isset($_SESSION['user_id']) && isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : null;
 
// var_dump($isLoggedIn, $username); 

?>
<style>
    /*=======================================Header===============================================*/
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: black;
    /* padding: 0 30px; */
    box-shadow: 0px 15px 10px rgb(58, 58, 58) ;
    color: white;
}
.header .list{
    display:flex;
}
/* .header-logo {
    display: flex;
    align-items: center;
} */

.header-logo img {
    width: 110px;
    height: 100px;
}

.header-left {
    display: flex;
    justify-content: flex-start;
    list-style: none;
    padding: 35px 0;
    margin: 0;
}


.header-left a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    font-weight: bold;
    margin: 0 15px;
    border-radius: 5px;
    transition: all 0.5s ease;

}

.header-left a:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.header-right {
    background-color: #000;
    color: white;
    display: flex;
    justify-content: flex-end;

    /* Center items vertically */
}

.header-right form {
    display: flex;
    /* Use flexbox for alignment */
    margin: 20px 50px;
    /* Space between form and login button */
    gap: 20px;
}

.header-right input[type="text"] {
    padding-left: 10px;
    /* Space inside the input */
    border: 2px solid #000306;
    /* Border color */
    border-radius: 8px;
    /* Rounded corners */
    font-size: 16px;
    /* Font size */
    outline: none;
    /* Remove default outline */
    transition: border-color 0.3s;
    /* Smooth transition for border color */
}

.header-right input[type="text"]:focus {
    border-color: #000306;
    /* Darker blue when focused */
}

.header-right button[type="submit"] {
    padding: 10px 15px;
    /* Space inside the button */
    border: 2px solid #000306;
    /* Remove default border */
    border-radius: 8px;
    /* Rounded corners */
    background-color: white;
    /* Button color */
    color: #000306;
    /* Text color */
    font-size: 16px;
    /* Font size */
    cursor: pointer;
    gap: 50px;
}

.header-right button[type="submit"]:hover{
    transform: scale(1.05);
    background-color: grey;
    color: white;
}

.search { 
    background: white;
    border: 1px solid transparent;
    border-radius: 50px;
    padding-right: 50px; 
}
.search input {
    border: none;
    outline: none;
    padding: 15px 60px 15px 10px;
    border-radius: 50px;
    font-size: 16px;
    margin-right: 20px;

}
.login-btn {
    padding: 15px;
    font-size: 12px;
    color: white;
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid white;
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.5s ease;
    width: 100px;
    height: 50px;
    margin-top: 19px;
}

.login-btn:hover {
    background-color: white;
    color: black;
}
/* CSS cho nút Profile và Logout */
.profile-btn, .logout-btn {
    font-size: 16px;
    color: white;
    margin-top: 37px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    margin-left: 10px;
}

.login-section {
    display: flex;
    align-items: center;
}

.logout-button {
    padding-right: 15px;
    transition: all 0.3s ease; 
    cursor: pointer;
    
}

.logout-button a {
    text-decoration: none; 
    color: white;
    background-color: rgba(255, 255, 255, 0.1); 
    font-size: 45px;
     
}

.logout-button:hover {
    transform: scale(1.1); 
}



/*=======================================End Header===============================================*/
    </style>

<link rel="stylesheet" href="../assets/css/header.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<header class="header">
    <div class="header-logo">
        <img src="../assets/image/logo.png" alt="Logo">
    </div>
    <div class="header-right">
            <form method="POST" action="../controllers/search-back.php">
                <div class="container-search" style="position: relative;">
                <input class="searchmovienow"style="border:2px grey solid;width:250px;height: 40px; border-radius: 100px;" type="text" name="search_query" placeholder="Nhập tên phim cần tìm..." required>
                    <div style="height: 47px; align-items:center;border-radius:100px; position: absolute;bottom: 2px; right:0px;width: 47px; background-color: #222222;">
                        <i style=" font-size: 20px; color:grey; margin-top:13px; margin-left: 14px;" class="fas fa-search"></i>
                    </div>
                </div>
                <button style="border:2px grey solid; height:50px; width:100px; font-size: 15px;border-radius: 100px;" type="submit">Tìm kiếm</button>
            </form>
        </div>
    <nav class="list">
        <ul class="header-left">
            <li><a href="../view/Intro.php">Giới thiệu</a></li>
            <li><a href="../view/main.php">Trang chủ</a></li>
            <li><a href="../model/category.php">Kho phim</a></li>
            <li><a href="../view/package.php">Gói dịch vụ</a></li>
            <li><a href="../view/favorite.php">Yêu thích</a></li>
            <li><a href="../view/histori.php">Lịch sử</a></li>
            <li><a href="../view/contact.php">Liên hệ</a></li>
        </ul>
        
        <?php 
            // Kiểm tra trạng thái đăng nhập
        if ($isLoggedIn): ?>
                <!-- Hiển thị thông tin người dùng nếu đã đăng nhập -->
                <div class="profile-btn">
                    <i><a href="../view/profile.php" class="fa fa-user" style="font-size: 20px; color: white;"></a></i>
                </div>
            <?php else: ?>
                <!-- Nút đăng nhập nếu chưa đăng nhập -->
                <button class="login-btn" id="loginButton">Đăng nhập</button>
            <?php endif; 
            ?>
    </nav>
    <div style="background-color: black;" class = "logout-button"><a href="../view/login.php"><i style="font-size: 30px; margin-bottom: 15px;" class="fa-solid fa-right-from-bracket"></i></a></div>    
</header>
    <script>
    document.getElementById('loginButton').addEventListener('click', function() {
        window.location.href = '../view/login.php'; // Đường dẫn tới trang đăng nhập
    });
</script>

