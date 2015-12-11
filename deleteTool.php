<?php
require_once('connect.php');
$tid = intval($_GET["tid"]);
$query =
"DELETE FROM Tool
WHERE
ToolID = $tid";
echo $query;
$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>