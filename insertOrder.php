<?php
require_once('connect.php');
$oemployee = intval($_GET["oemployee"]);
$ovendor = intval($_GET["ovendor"]);
$oponumber = intval($_GET["oponumber"]);
$datepicker = mysql_real_escape_string($_GET["datepicker"]);
$onotes = mysql_real_escape_string($_GET["onotes"]);
$osubtotal = mysql_real_escape_string($_GET["osubtotal"]);
$ostatus = mysql_real_escape_string($_GET["ostatus"]);

$query =
"INSERT INTO pdiDB.Order
VALUE(0,$oemployee,$ovendor,$oponumber,'$datepicker','$onotes','$osubtotal','$ostatus')";

$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>