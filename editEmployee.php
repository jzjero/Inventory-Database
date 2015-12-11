<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./demo/styles.css">
<title>Edit Employee</title>
</head>
<body>
<?php 
$EmployeeID = $_GET['EmployeeID'];
require_once('connect.php');
$query = "Select * from Employee Where EmployeeID = '$EmployeeID'";
$stmt = $conn->prepare($query);
if ($stmt->execute()) {
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
}

echo '
<div id="carbonForm">
    <h1>Edit Employee</h1>
    <input type = "hidden" id = "eid" value = "'. $result['EmployeeID'] .'">
    <div class = "fieldContainer">
        <div class = "formRow">
            <div class = "label">
                <label for = "fname">First Name</label>
            </div>
            <div class = "field">
                <input type = "text" id = "fname" value = "'. $result['EmployeeFirstName'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "lname">Last Name</label>
            </div>
            <div class = "field">
                <input type = "text" id = "lname" value = "'. $result['EmployeeLastName'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "phone">Phone</label>
            </div>
            <div class = "field">
                <input type = "text" id = "phone" value = "'. $result['EmployeePhone'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "email">Email</label>
            </div>
            <div class = "field">
                <input type = "text" id = "email" value = "'. $result['EmployeeEmail'] .'">
            </div>
        </div>
    </div>
    <div class = "signupButton">
        <button type = "button" id = "update" onclick = updateEmployee()>Update</button>
    </div>
    <div class = "signupButton">
        <button type = "button" id = "delete" onclick = deleteEmployee()>Delete</button>
    </div>

</div>
<h2 id="footer"><a href="./Employee.php">Go Back To Employee &raquo;</a></h2>
'
?>
<script>
function updateEmployee() {
    var eid = document.getElementById('eid').value;
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;

    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
    if (req.readyState == 4 && req.status == 200)
    {
        req.responseText;
    }
    }
    req.open("GET", "updateEmployee.php?eid=" + eid 
    + "&fname=" + fname 
    + "&lname=" + lname 
    + "&phone=" + phone 
    + "&email=" + email 
    ); 

    req.send();
    alert("Employee Updated Successfully");
    location.replace("./Employee.php");
}

function deleteEmployee() {
    if(confirm("Are you sure you want to permanently delete this Employee?") == true ) {
        var eid = document.getElementById('eid').value;
        var req = new XMLHttpRequest();

        req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200)
        {
            req.responseText;
        }
        }
        req.open("GET", "deleteEmployee.php?eid=" + eid 
        ); 

        req.send();
        alert("Employee Deleted Successfully");
        location.replace("./Employee.php");
    }
}
</script>
<?php $conn = null; ?>
</body>
</html>


