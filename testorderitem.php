<?php
session_set_cookie_params(99999999,"/");
session_start();
require 'connection.php';

// $userid = 0;
// $result=mysqli_query($conn, "select userid from webtokens where sid = '" . session_id() . "'");
// $result=mysqli_query($conn, "select userid from users where userid = 2");
$arrlist = [];

$res_orderdet=mysqli_query($conn, "SELECT ordersdet.detid, ordersdet.quantity, items.itemstring,items.barcode, ordersdet.status, items.itemtype,items.itemparent,items.itemid ,items.prop1 ,items.prop2 FROM ordersdet INNER JOIN items ON ordersdet.theitemid=items.itemid ORDER BY items.itemid;");
while($res= mysqli_fetch_assoc($res_orderdet)){
    array_push($arrlist, array($res["detid"],abs($res["quantity"]),$res["itemstring"],$res["barcode"],$res["status"], $res["itemtype"], $res["itemparent"], $res["itemid"], $res["prop1"], $res["prop2"]));
}
echo json_encode($arrlist);
?>