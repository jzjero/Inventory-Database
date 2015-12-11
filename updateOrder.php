<?php
require_once('connect.php');
$orderid = intval($_GET["orderid"]);
$oemployee = intval($_GET["oemployee"]);
$ovendor = intval($_GET["ovendor"]);
$oponumber = intval($_GET["oponumber"]);
$datepicker = mysql_real_escape_string($_GET["datepicker"]);
$onotes = mysql_real_escape_string($_GET["onotes"]);
$osubtotal = mysql_real_escape_string($_GET["osubtotal"]);
$ostatus = mysql_real_escape_string($_GET["ostatus"]);

$query =
"UPDATE pdiDB.Order
SET
OrderEID = $oemployee,
OrderVID = $ovendor,
OrderPONumber = $oponumber,
OrderDate = '$datepicker',
OrderNotes = '$onotes',
OrderSubTotal = '$osubtotal',
OrderStatus = '$ostatus'
WHERE
OrderID = $orderid";

$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>