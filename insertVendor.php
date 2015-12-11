<?php
require_once('connect.php');
$vname = mysql_real_escape_string($_GET["vname"]);
$vaddress = mysql_real_escape_string($_GET["vaddress"]);
$vphone = mysql_real_escape_string($_GET["vphone"]);
$vemail = mysql_real_escape_string($_GET["vemail"]);
$vwebsite = mysql_real_escape_string($_GET["vwebsite"]);
$vcontact = mysql_real_escape_string($_GET["vcontact"]);
$vbom = mysql_real_escape_string($_GET["vbom"]);

$query =
"INSERT INTO Vendor
VALUE(0,'$vname','$vaddress','$vphone','$vemail','$vwebsite','$vcontact','$vbom')";

$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>