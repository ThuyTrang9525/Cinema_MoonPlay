
<?php
    session_start();
    error_reporting(E_ALL ^ E_DEPRECATED);
    require_once '../model/connect.php';

    if (isset($_POST['sign up']))
    {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
        }

        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }

        // if (isset($_POST['phone'])) {
        //     $phone = $_POST['phone'];
        // }

        $sql = "INSERT INTO users ( username, password, email, role)
                VALUES ('$username', md5('$password'), '$email', 1)";
        $res = mysqli_query($conn,$sql);
        if ($res) 
        {
            header("location:login.php?rs=success");
            exit();
        }
        else 
        {
            header("location:login.php?rf=fail");
            exit();
        }
    }
?>

