<?php
require_once('connect.php');
$eid = intval($_GET["eid"]);
$query =
"DELETE FROM Employee
WHERE
EmployeeID = $eid";
echo $query;
$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>