<?php
function showpayment(){
    if(isset($_SESSION['package'])&&(is_array($_SESSION['package']))){
      $sum=0;
      $package = $_SESSION['package'];
        echo '<p>Tên Gói: ' . $package[0] . '</p>';
        $sum += $package[1];
    }
    echo '<p>Giá: <span class="price">' . $sum . '</span></p>';
}
if( ($_SERVER['REQUEST_METHOD'] == 'POST')){
    if(!isset($_SESSION['package'])) {
      $_SESSION['package']=[];
    }
    if (isset($_SESSION['totalmoney'])) {
      unset($_SESSION['totalmoney']);  
  }
   
   
    $name=$_POST['package_name'];
    // echo '$name'; 
    $price=$_POST['package_price'];
    // echo '$price';
    $quality=$_POST['package_quality'];
    // echo '$quality';


    if ($name && $price > 0 && $quality > 0) {
      $packages=[$name,$price,$quality];
      $_SESSION['package']=$packages;
  } else {
      echo "Dữ liệu không hợp lệ. Vui lòng nhập lại.";
    // Lưu gói vào session
}
}
?>