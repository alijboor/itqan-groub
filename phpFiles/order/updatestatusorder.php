<?php
session_set_cookie_params(99999999,"/");
session_start();

require '../../connection.php';

$status = $_GET['state'];
$order_id = $_GET['orderid'];
echo $status;
echo $order_id;

$res_orderdet=mysqli_query($conn, "UPDATE orders SET orderstatus= $status where orderid = $order_id");

	echo 'OK';
?>