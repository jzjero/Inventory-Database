<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./demo/styles.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
</script>
<title>New Tool</title>
</head>
<body>
<div id="carbonForm">
    <h1>New Tool</h1>
    <div class = "fieldContainer">
        <div class = "formRow">
            <div class = "label">
                <label for = "ttype">Type</label>
            </div>
            <div class = "field">
                <input type = "text" id = "ttype">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "toption">Option</label>
            </div>
            <div class = "field">
                <input type = "text" id = "toption">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "tsize">Size</label>
            </div>
            <div class = "field">
                <select id = "tsize">
                    <option value = ""></option>
                    <option value = 114 >114</option>
                    <option value = 118 >118</option>
                    <option value = 138 >138</option>
                    <option value = 178 >178</option>
                </select>
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "tpolarity">Polarity</label>
            </div>
            <div class = "field">
                <select id = "tpolarity">
                    <option value = ""></option>
                    <option value = "Negative" >Negative</option>
                    <option value = "Positive" >Positive</option>
                </select>
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "tnumber">Number</label>
            </div>
            <div class = "field">
                <input type = "text" id = "tnumber">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "datepicker">Make Date</label>
            </div>
            <div class = "field">
                <input type="text" id="datepicker">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "tstatus">Status</label>
            </div>
            <div class = "field">
                <select id = "tstatus">
                <option value = ""></option>
                <option value = "Active">Active</option>
                <option value = "Discontinued">Discontinued</option>
                </select>
            </div>
        </div>
    </div>
    <div class = "signupButton">
		<button type = "button" id = "submit" onclick = insertTool()>Add New Tool</button>
	</div>
</div>
<h2 id="footer"><a href="./Tool.php">Go Back To Tool &raquo;</a></h2>

<script>
function insertTool() {
	var ttype = document.getElementById('ttype').value;
    var toption = document.getElementById('toption').value;
    var tsize = document.getElementById('tsize').value;
    var tpolarity = document.getElementById('tpolarity').value;
    var tnumber = document.getElementById('tnumber').value;
    var datepicker = document.getElementById('datepicker').value;
    var tstatus = document.getElementById('tstatus').value;

    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
    if (req.readyState == 4 && req.status == 200)
    {
        req.responseText;
    }
    }
    req.open("GET", "insertTool.php?ttype=" + ttype 
    + "&toption=" + toption 
    + "&tsize=" + tsize
    + "&tpolarity=" + tpolarity 
    + "&tnumber=" + tnumber
    + "&datepicker=" + datepicker
    + "&tstatus=" + tstatus
    ); 

    req.send();
    alert("Added New Tool Successfully");
    location.replace("./Tool.php");
}
</script>
</body>
</html>