<?php
require_once('connect.php');
$olorder = intval($_GET["olorder"]);
$olcomponent = intval($_GET["olcomponent"]);
$olquantity = intval($_GET["olquantity"]);
$olcost = mysql_real_escape_string($_GET["olcost"]);
$olstatus = mysql_real_escape_string($_GET["olstatus"]);
$datepicker = mysql_real_escape_string($_GET["datepicker"]);
$olsubtotal = mysql_real_escape_string($_GET["olsubtotal"]);

$query =
"UPDATE Order_Line
SET
Order_LineQuantity = $olquantity,
Order_LineCost = '$olcost',
Order_LineStatus = '$olstatus',
Order_LineReceivedDate = '$datepicker',
Order_LineSubTotal = '$olsubtotal'
WHERE
Order_LineOrderID = $olorder
AND
Order_LineComponentID = $olcomponent;

CALL UpdateOrderSubTotal($olorder);
";
try { 
$stmt = $conn->prepare($query);
$stmt->execute();
}
catch (PDOException $e)
{
	$e->getMessage();
	die("Error Has Occured");
}
$conn = null;
?>