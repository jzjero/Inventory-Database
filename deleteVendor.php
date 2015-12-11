<?php
require_once('connect.php');
$vid = intval($_GET["vid"]);
echo $eid;
$query =
"DELETE FROM Vendor
WHERE
VendorID = $vid";
echo $query;
$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>