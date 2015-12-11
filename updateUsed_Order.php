<?php
require_once('connect.php');
$uoorder = intval($_GET["uoorder"]);
$uoemployee = $_GET["uoemployee"];
$uotool = $_GET["uotool"];
$datepicker1 = mysql_real_escape_string($_GET["datepicker1"]);
$uonotes = mysql_real_escape_string($_GET["uonotes"]);
$uosubtotal = mysql_real_escape_string($_GET["uosubtotal"]);
$uostatus = mysql_real_escape_string($_GET["uostatus"]);

$query =
"UPDATE Used_Order
SET
Used_OrderEmployeeID = $uoemployee,
Used_OrderToolID = $uotool,
Used_OrderDate = '$datepicker1',
Used_OrderNotes = '$uonotes',
Used_OrderSubTotal = '$uosubtotal',
Used_OrderStatus = '$uostatus'
WHERE
Used_OrderID = $uoorder";
$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>