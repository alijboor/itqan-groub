<?php
session_set_cookie_params(99999999,"/");
session_start();

require '../../connection.php';

$itemid = $_GET['idnonDisplay'];
$status = $_GET['state'];
$order_id = $_GET['orderid'];
// $quan = $_POST['quantity'];

$res_orderdet=mysqli_query($conn, "UPDATE ordersdet SET  `status`= '$status' where detid = $itemid AND theorderid = $order_id");
// $addtional = $status + $quan;
// $data = json_decode(stripslashes($_POST['data']));

// $ctr =0;
// foreach($data as $d){
//     echo $d;
//     $id = $d[$ctr][0];
//     $status = $d[$ctr][4];
//     $addtional = $d[$ctr][4] +"█" + $d[$ctr][1];
//     if($status.substr(0,1) == 'M'){
//         $res_orderdet=mysqli_query($conn, "UPDATE ordersdet SET  `status`= '$addtional' where detid = $id");
//     }
//     else{
//         $res_orderdet=mysqli_query($conn, "UPDATE ordersdet SET  `status`= '$status' where detid = $id");
//     }
//     $ctr+=1;
// };

	echo 'OK';
?>