<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./demo/styles.css">
<title>New Vendor</title>
</head>
<body>
<div id="carbonForm">
	<h1>New Vendor</h1>
	<div class = "fieldContainer">
		<div class = "formRow">
			<div class = "label">
				<label for = "vname">Name</label>
			</div>
			<div class = "field">
				<input type = "text" id = "vname">
			</div>
		</div>
		<div class = "formRow">
			<div class = "label">
				<label for = "vaddress">Address</label>
			</div>
			<div class = "field">
				<input type = "text" id = "vaddress">
			</div>
		</div>
		<div class = "formRow">
			<div class = "label">
				<label for = "vphone">Phone</label>
			</div>
			<div class = "field">
				<input type = "text" id = "vphone">
			</div>
		</div>
		<div class = "formRow">
			<div class = "label">
				<label for = "vemail">Email</label>
			</div>
			<div class = "field">
				<input type = "text" id = "vemail">
			</div>
		</div>
		<div class = "formRow">
			<div class = "label">
				<label for = "vwebsite">Website</label>
			</div>
			<div class = "field">
				<input type = "text" id = "vwebsite">
			</div>
		</div>
		<div class = "formRow">
			<div class = "label">
				<label for = "vcontact">Contact</label>
			</div>
			<div class = "field">
				<input type = "text" id = "vcontact">
			</div>
		</div>
		<div class = "formRow">
			<div class = "label">
				<label for = "vbom">BOM Type</label>
			</div>
			<div class = "field">
				<select id = "vbom">
				<option value = ""></option>
				<option value = ".CSV">.CSV</option>
				<option value = ".XML">.XML</option>
				<option value = ".PDF">.PDF</option>
				</select>

			</div>
		</div>
	</div>
	<div class = "signupButton">
		<button type = "button" id = "submit" onclick = insertVendor()>Add New Vendor</button>
	</div>
</div>
<h2 id="footer"><a href="./Vendor.php">Go Back To Vendor &raquo;</a></h2>


<script>
function insertVendor() {
    var vname = document.getElementById('vname').value;
    var vaddress = document.getElementById('vaddress').value;
    var vphone = document.getElementById('vphone').value;
    var vemail = document.getElementById('vemail').value;
    var vwebsite = document.getElementById('vwebsite').value;
    var vcontact = document.getElementById('vcontact').value;
    var vbom = document.getElementById('vbom').value;

    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
    if (req.readyState == 4 && req.status == 200)
    {
        req.responseText;
    }
    }
    req.open("GET", "insertVendor.php?vname=" + vname 
    + "&vaddress=" + vaddress 
    + "&vphone=" + vphone 
    + "&vemail=" + vemail
    + "&vwebsite=" + vwebsite
    + "&vcontact=" + vcontact
    + "&vbom=" + vbom 
    ); 

    req.send();
    alert("Added New Vendor Successfully");
    location.replace("./Vendor.php");
}
</script>
</body>
</html>