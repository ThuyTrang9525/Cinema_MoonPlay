
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
            <form action="forgot_pass.php" method="post" class="box"> 
            <h1 style ="font-size: 35px;"></h1>
                <h1 style ="font-size: 30px;">Quên mật khẩu</h1>
                    <p class="text-muted"> Vui lòng nhập thông tin đăng nhập của bạn!</p> 
                    <input type="text" name="username" placeholder="Tên đăng nhập"> 
                    <input type="password" name="password" placeholder="Mật khẩu mới"> 
                    <input type="password" name="password" placeholder="Xác nhận mật khẩu mới">  
                    <input type="submit" name="login" value="Hoàn thành"> 
            </form> 
        </div>  
    </div>
</body>
</html>