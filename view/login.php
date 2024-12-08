<?php
if (isset($_GET['message']) && $_GET['message'] == 'success') {
    echo 'Đăng ký thành công! Vui lòng đăng nhập.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="../assets/css/login_register.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="login" >
    <div class="container"> 
        <div class="card"> 
            <form action="../controllers/login-back.php" method="post" class="box"> 
            <h1 style ="font-size: 35px;">Chào mừng quay trở lại</h1>
                <h1 style ="font-size: 30px;">Đăng nhập</h1>
                    <p class="text-muted"> Vui lòng nhập thông tin đăng nhập của bạn!</p> 
                    <input type="text" name="username" placeholder="Tên đăng nhập"> 
                    <input type="password" name="password" placeholder="Mật khẩu"> 
                    <a class="forgot text-muted" href="forgot_pass.php">Quên mật khẩu?</a> 
                    <input type="submit" name="login" value="Đăng nhập"> 
                    <P class="registers" name="registers" style="color: white;">Không có tài khoản? <a style="color: white;" href="register.php">Đăng ký</a></P>
                    <div class="col-md-12"> 
                        <ul class="social-network social-circle"> 
                            <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li> 
                            <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li> 
                            <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a></li> 
                        </ul> 
                    </div> 
            </form> 
        </div>  
    </div>
</body>
</html>