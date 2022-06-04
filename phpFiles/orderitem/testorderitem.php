<?php
session_set_cookie_params(99999999,"/");
session_start();
require '../../connection.php';
$arrlist = [];
$id = $_GET["orderid"];

$res_orderdet=mysqli_query($conn, "SELECT ordersdet.detid, ordersdet.quantity, items.itemstring,items.barcode, ordersdet.status, items.itemtype,items.itemparent,items.itemid ,items.prop1 ,items.prop2, ordersdet.theorderid FROM ordersdet
                                                    INNER JOIN items ON ordersdet.theitemid=items.itemid
                                                    where ordersdet.theorderid = $id
                                                    ORDER BY ordersdet.detid;");
while($res= mysqli_fetch_assoc($res_orderdet)){
    array_push($arrlist, array($res["detid"],abs($res["quantity"]),$res["itemstring"],$res["barcode"],$res["status"], $res["itemtype"], $res["itemparent"], $res["itemid"], $res["prop1"], $res["prop2"], $res["theorderid"]));
}
echo json_encode($arrlist);
?>