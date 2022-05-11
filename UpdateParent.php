<?php 
    session_set_cookie_params(99999999,"/");
    session_start();
    require 'connection.php';
    $target = "imgs/";
    $Img_ctr = mysqli_query($conn, "SELECT imagescount FROM orders orders.orderid=".$_POST["orderid"]);
    echo $Img_ctr;
    echo "jajs";
    echo $_POST["orderid"];

?>