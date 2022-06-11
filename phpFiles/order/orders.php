<?php
    session_set_cookie_params(99999999,"/");
    session_start();
    require '../../connection.php';

    $arrlist = [];
    $order_status = $_GET['status'];

    $res_orderdet=mysqli_query($conn, "SELECT accounts.accountstring, orders.ordertype, COUNT(*) Totalorders, orders.orderid FROM orders
                                                JOIN accounts ON orders.theaccountid=accounts.accountid
                                                JOIN ordersdet ON orders.orderid = ordersdet.theorderid
                                                WHERE orders.orderstatus = $order_status
                                                GROUP BY ordersdet.theorderid");

    while($res= mysqli_fetch_assoc($res_orderdet)){
        array_push($arrlist, array($res["accountstring"],abs($res["ordertype"]),$res["Totalorders"], $res["orderid"]));
    }

    echo json_encode($arrlist);
?>