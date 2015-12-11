<?php
require_once('connect.php');
$cid = intval($_GET["cid"]);
$creference = mysql_real_escape_string($_GET["creference"]);
$cvalue = mysql_real_escape_string($_GET["cvalue"]);
$cpartnumber = mysql_real_escape_string($_GET["cpartnumber"]);
$cmanufacturer = mysql_real_escape_string($_GET["cmanufacturer"]);
$cfootprint = mysql_real_escape_string($_GET["cfootprint"]);
$cprice = mysql_real_escape_string($_GET["cprice"]);
$cdatasheet = mysql_real_escape_string($_GET["cdatasheet"]);
$cdescription = mysql_real_escape_string($_GET["cdescription"]);

$query =
"Update Component
SET
ComponentReference = '$creference',
ComponentValue =  '$cvalue',
ComponentPartNumber = '$cpartnumber',
ComponentManufacturer = '$cmanufacturer',
ComponentFootPrint = '$cfootprint',
ComponentPrice = '$cprice',
ComponentDataSheet = '$cdatasheet',
ComponentDescription = '$cdescription'
WHERE
ComponentID = $cid";

$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>