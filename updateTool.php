<?php
require_once('connect.php');
$tid = intval($_GET["tid"]);
$ttype = mysql_real_escape_string($_GET["ttype"]);
$toption = mysql_real_escape_string($_GET["toption"]);
$tsize = intval($_GET["tsize"]);
$tpolarity = mysql_real_escape_string($_GET["tpolarity"]);
$tnumber = intval($_GET["tnumber"]);
$datepicker = mysql_real_escape_string($_GET["datepicker"]);
$tstatus = mysql_real_escape_string($_GET["tstatus"]);

$query =
"Update Tool
SET
ToolType = '$ttype',
ToolOption =  '$toption',
ToolSize = $tsize,
ToolPulsePolarity = '$tpolarity',
ToolNumber = $tnumber,
ToolDateMade = '$datepicker',
ToolStatus = '$tstatus'
WHERE
ToolID = $tid";

$stmt = $conn->prepare($query);
$stmt->execute();
$conn = null;
?>