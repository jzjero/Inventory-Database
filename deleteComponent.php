<?php
require_once('connect.php');
$cid = intval($_GET["cid"]);
$query =
"DELETE FROM Component
WHERE
ComponentID = $cid";
echo $query;
$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>