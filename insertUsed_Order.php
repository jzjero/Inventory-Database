<?php
require_once('connect.php');
$uoemployee = $_GET["uoemployee"];
$uotool = $_GET["uotool"];
$datepicker1 = mysql_real_escape_string($_GET["datepicker1"]);
$uonotes = mysql_real_escape_string($_GET["uonotes"]);
$uosubtotal = mysql_real_escape_string($_GET["uosubtotal"]);
$uostatus = mysql_real_escape_string($_GET["uostatus"]);

$query =
"INSERT INTO Used_Order
VALUE(0,$uoemployee,$uotool,'$datepicker1','$uonotes','$uosubtotal','$uostatus')";

echo $query;

$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>