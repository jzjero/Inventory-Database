<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./demo/styles.css">
<title>New Employee</title>
</head>
<body>
<div id="carbonForm">
	<h1>New Employee</h1>
	<div class = "fieldContainer">
		<div class = "formRow">
			<div class = "label">
				<label for = "fname">First Name</label>
			</div>
			<div class = "field">
				<input type = "text" id = "fname">
			</div>
		</div>
		<div class = "formRow">
			<div class = "label">
				<label for = "lname">Last Name</label>
			</div>
			<div class = "field">
				<input type = "text" id = "lname">
			</div>
		</div>
		<div class = "formRow">
			<div class = "label">
				<label for = "phone">Phone</label>
			</div>
			<div class = "field">
				<input type = "text" id = "phone">
			</div>
		</div>
		<div class = "formRow">
			<div class = "label">
				<label for = "email">Email</label>
			</div>
			<div class = "field">
				<input type = "text" id = "email">
			</div>
		</div>
	</div>
	<div class = "signupButton">
		<button type = "button" id = "submit" onclick = insertEmployee()>Add New Employee</button>
	</div>
</div>
<h2 id="footer"><a href="./Employee.php">Go Back To Employee &raquo;</a></h2>


<script>
function insertEmployee() {
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
    req.open("GET", "insertEmployee.php?fname=" + fname 
    + "&lname=" + lname 
    + "&phone=" + phone 
    + "&email=" + email 
    ); 

    req.send();
    alert("Added New Employee Successfully");
    location.replace("./Employee.php");
    
}
</script>
</body>
</html>