<?php
require_once('connect.php');
$vid = intval($_GET["vid"]);
$vname = mysql_real_escape_string($_GET["vname"]);
$vaddress = mysql_real_escape_string($_GET["vaddress"]);
$vphone = mysql_real_escape_string($_GET["vphone"]);
$vemail = mysql_real_escape_string($_GET["vemail"]);
$vwebsite = mysql_real_escape_string($_GET["vwebsite"]);
$vcontact = mysql_real_escape_string($_GET["vcontact"]);
$vbom = mysql_real_escape_string($_GET["vbom"]);

$query =
"Update Vendor
SET
VendorName = '$vname',
VendorAddress =  '$vaddress',
VendorPhone = '$vphone',
VendorEmail = '$vemail',
VendorWebsite = '$vwebsite',
VendorContactName = '$vcontact',
VendorBOMtype = '$vbom'
WHERE
VendorID = $vid";

$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>