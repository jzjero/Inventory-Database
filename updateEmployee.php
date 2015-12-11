<?php
require_once('connect.php');
$eid = intval($_GET["eid"]);
$fname = $_GET["fname"];
$fname = mysql_real_escape_string($fname);
$lname = $_GET["lname"];
$lname = mysql_real_escape_string($lname);
$phone = $_GET["phone"];
$phone = mysql_real_escape_string($phone);
$email = $_GET["email"];
$email = mysql_real_escape_string($email);

$query =
"Update Employee
SET
EmployeeFirstName = '$fname',
EmployeeLastName =  '$lname',
EmployeePhone = '$phone',
EmployeeEmail = '$email'
WHERE
EmployeeID = $eid";

$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>