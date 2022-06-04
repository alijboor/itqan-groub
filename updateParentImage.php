<?php
    session_set_cookie_params(99999999,"/");
    session_start();
    header('Content-Type: text/html; charset=utf-8');

    require 'connection.php';

    $target_dir = "imgs/";
    $id = $_POST["orderid"];
    $image_ctr = 0;
    $query = mysqli_query($conn, "SELECT imagescount FROM orders WHERE orderid = $id");
    $filename = basename($_FILES["image"]["name"]);

    $tempname = $_FILES["image"]["tmp_name"];  

    while($res= mysqli_fetch_assoc($query) )
    {
        $image_ctr = $res[imagescount];
    }
    $target_file = $target_dir . $id . "_" . $image_ctr . '.png';

    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
        $image_ctr+=1;
        $query = mysqli_query($conn, "UPDATE orders SET imagescount = $image_ctr  WHERE orderid = $id");
        echo json_encode(array('success' => 1));
    }
    else {
        echo json_encode(array('success' => 0 , 'filename' => $filename, 'query' => $target_file));
    }


?>


