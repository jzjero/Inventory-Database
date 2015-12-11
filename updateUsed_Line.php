<?php
require_once('connect.php');
$ulorder = intval($_GET["ulorder"]);
$ulcomponent = intval($_GET["ulcomponent"]);
$ulquantity = intval($_GET["ulquantity"]);
$ulcost = mysql_real_escape_string($_GET["ulcost"]);
$ulstatus = mysql_real_escape_string($_GET["ulstatus"]);
$datepicker = mysql_real_escape_string($_GET["datepicker"]);
$ulsubtotal = mysql_real_escape_string($_GET["ulsubtotal"]);

$query =
"UPDATE Used_Line
SET
Used_LineQuantity = $ulquantity,
Used_LineCost = '$ulcost',
Used_LineStatus = '$ulstatus',
Used_LineDate = '$datepicker',
Used_LineSubtotal = '$ulsubtotal'
WHERE
Used_LineUsed_OrderID = $ulorder
AND
Used_LineComponentID = $ulcomponent;

CALL UpdateUsed_OrderSubTotal($ulorder);
";
$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>