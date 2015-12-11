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
"INSERT INTO Order_Line
VALUE($olorder,$olcomponent,$olquantity,'$olcost','$olstatus','$datepicker','$olsubtotal');
CALL UpdateOrderSubTotal($olorder);
";
$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>