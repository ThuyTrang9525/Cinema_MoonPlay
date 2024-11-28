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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="login" >
    <div class="container"> 
        <div class="card"> 
            <form action="../controllers/login-back.php" method="post" class="box"> 
            <h1>Wellcome back</h1>
                <h1>Login</h1>
                    <p class="text-muted"> Please enter your login and password!</p> 
                    <input type="text" name="username" placeholder="Username"> 
                    <input type="password" name="password" placeholder="Password"> 
                    <input type="password" name="password" placeholder="Password"> 
                    <a class="forgot text-muted" href="#">Forgot password?</a> 
                    <input type="submit" name="login" value="Login"> 
                    <P class="registers" name="registers" style="color: white;">Don't have an account? <a style="color: white;" href="register.php">Signup</a></P>
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