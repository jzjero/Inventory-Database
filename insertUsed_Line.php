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
"INSERT INTO Used_Line
VALUE($ulorder,$ulcomponent,$ulquantity,'$ulcost','$ulstatus','$datepicker','$ulsubtotal');
CALL UpdateUsed_OrderSubTotal($ulorder);
";
$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>