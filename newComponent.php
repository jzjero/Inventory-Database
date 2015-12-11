<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./demo/styles.css">
<title>New Component</title>
</head>
<body>
<div id="carbonForm">
    <h1>New Component</h1>
    <div class = "fieldContainer">
        <div class = "formRow">
            <div class = "label">
                <label for = "creference">Reference</label>
            </div>
            <div class = "field">
                <input type = "text" id = "creference">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cvalue">Value</label>
            </div>
            <div class = "field">
                <input type = "text" id = "cvalue">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cpartnumber">Part Number</label>
            </div>
            <div class = "field">
               <input type = "text" id = "cpartnumber">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cmanufacturer">Manufacturer</label>
            </div>
            <div class = "field">
               <input type = "text" id = "cmanufacturer">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cfootprint">Foot Print</label>
            </div>
            <div class = "field">
               <input type = "text" id = "cfootprint">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cprice">Price</label>
            </div>
            <div class = "field">
               <input type = "text" id = "cprice">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cdatasheet">Data Sheet</label>
            </div>
            <div class = "field">
               <input type = "text" id = "cdatasheet">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cdescription">Description</label>
            </div>
            <div class = "field">
               <input type = "text" id = "cdescription">
            </div>
        </div>
    </div>
    <div class = "signupButton">
		<button type = "button" id = "submit" onclick = insertComponent()>Add New Component</button>
	</div>
</div>
<h2 id="footer"><a href="./Component.php">Go Back To Component &raquo;</a></h2>

<script>
function insertComponent() {
	var creference = document.getElementById('creference').value;
    var cvalue = document.getElementById('cvalue').value;
    var cpartnumber = document.getElementById('cpartnumber').value;
    var cmanufacturer = document.getElementById('cmanufacturer').value;
    var cfootprint = document.getElementById('cfootprint').value;
    var cprice = document.getElementById('cprice').value;
    var cdatasheet = document.getElementById('cdatasheet').value;
    var cdescription = document.getElementById('cdescription').value;

    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
    if (req.readyState == 4 && req.status == 200)
    {
        req.responseText;
    }
    }
    req.open("GET", "insertComponent.php?creference=" + creference 
    + "&cvalue=" + cvalue 
    + "&cpartnumber=" + cpartnumber
    + "&cmanufacturer=" + cmanufacturer 
    + "&cfootprint=" + cfootprint
    + "&cprice=" + cprice
    + "&cdatasheet=" + cdatasheet
    + "&cdescription=" + cdescription
    );

    req.send();
    alert("Added New Component Successfully");
    location.replace("./Component.php");
}
</script>
</body>
</html>