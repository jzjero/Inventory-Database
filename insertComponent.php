<?php
require_once('connect.php');
$creference = mysql_real_escape_string($_GET["creference"]);
$cvalue = mysql_real_escape_string($_GET["cvalue"]);
$cpartnumber = mysql_real_escape_string($_GET["cpartnumber"]);
$cmanufacturer = mysql_real_escape_string($_GET["cmanufacturer"]);
$cfootprint = mysql_real_escape_string($_GET["cfootprint"]);
$cprice = mysql_real_escape_string($_GET["cprice"]);
$cdatasheet = mysql_real_escape_string($_GET["cdatasheet"]);
$cdescription = mysql_real_escape_string($_GET["cdescription"]);

$query =
"Insert INTO Component
Value(0,'$creference','$cvalue','$cpartnumber','$cmanufacturer','$cfootprint','$cprice','$cdatasheet','$cdescription')";

$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>