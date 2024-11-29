<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/login_register.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body class="register">
    <div class="container"> 
        <div class="card"> 
            <form action="../controllers/register-back.php" method="post" class="box"> 
                <h1>Đăng ký</h1>
                    <p class="text-muted"></p> 
                    <input type="text" name="username" placeholder="Tên đăng nhập"> 
                    <input type="password" name="password" placeholder="Mật khẩu"> 
                    <input type="email" name="email" placeholder="Email"> 
                    <input type="submit" name="signup" value="Sign Up"> 
                    <P class="registers" name="registers" style="color: white;">Đã có tài khoản? <a style="color:white;" href="login.php">Đăng nhập</a></P>
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