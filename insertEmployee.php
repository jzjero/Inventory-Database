<?php
require_once('connect.php');
$fname = $_GET["fname"];
$fname = mysql_real_escape_string($fname);
$lname = $_GET["lname"];
$lname = mysql_real_escape_string($lname);
$phone = $_GET["phone"];
$phone = mysql_real_escape_string($phone);
$email = $_GET["email"];
$email = mysql_real_escape_string($email);

$query =
"INSERT into Employee
Value(0, '$fname', '$lname', '$phone', '$email')";
echo $query;
$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>