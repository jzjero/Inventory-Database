<?php
require_once('connect.php');
$ttype = mysql_real_escape_string($_GET["ttype"]);
$toption = mysql_real_escape_string($_GET["toption"]);
$tsize = intval($_GET["tsize"]);
$tpolarity = mysql_real_escape_string($_GET["tpolarity"]);
$tnumber = intval($_GET["tnumber"]);
$datepicker = mysql_real_escape_string($_GET["datepicker"]);
$tstatus = mysql_real_escape_string($_GET["tstatus"]);

$query =
"INSERT INTO Tool
VALUE(0,'$ttype','$toption',$tsize,'$tpolarity',$tnumber,'$datepicker','$tstatus')";

$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>