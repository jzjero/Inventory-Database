<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./demo/styles.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!-- <link rel="stylesheet" href="./css/jquery-ui-timepicker-addon.css"> -->
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- <script src="./js/jquery-ui-timepicker-addon.js"></script> -->
<script>
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
</script>
<title>Edit Tool</title>
</head>
<body>
<?php 
$ToolID = $_GET['ToolID'];
require_once('connect.php');
$query = "Select * from Tool Where ToolID = '$ToolID'";
$stmt = $conn->prepare($query);
if ($stmt->execute()) {
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
}

$size = $result['ToolSize'];
$polarity = $result['ToolPulsePolarity'];
$status = $result['ToolStatus'];

echo '
<div id="carbonForm">
    <h1>Edit Tool</h1>
    <input type = "hidden" id = "tid" value = "'. $result['ToolID'] .'">
    <div class = "fieldContainer">
        <div class = "formRow">
            <div class = "label">
                <label for = "ttype">Type</label>
            </div>
            <div class = "field">
                <input type = "text" id = "ttype" value = "'. $result['ToolType'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "toption">Option</label>
            </div>
            <div class = "field">
                <input type = "text" id = "toption" value = "'. $result['ToolOption'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "tsize">Size</label>
            </div>
            <div class = "field">
                <select id = "tsize">
                    <option value = ""></option>
                    <option '.(($size==114)?'selected="selected"':"").'value = 114 >114</option>
                    <option '.(($size==118)?'selected="selected"':"").'value = 118 >118</option>
                    <option '.(($size==138)?'selected="selected"':"").'value = 138 >138</option>
                    <option '.(($size==178)?'selected="selected"':"").'value = 178 >178</option>
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
                    <option '.(($polarity=="Negative")?'selected="selected"':"").'value = "Negative" >Negative</option>
                    <option '.(($polarity=="Positive")?'selected="selected"':"").'value = "Positive" >Positive</option>
                </select>
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "tnumber">Number</label>
            </div>
            <div class = "field">
                <input type = "text" id = "tnumber" value = "'. $result['ToolNumber'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "datepicker">Make Date</label>
            </div>
            <div class = "field">
                <input type="text" id="datepicker" value = "'. $result['ToolDateMade'] .'">
                
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "tstatus">Status</label>
            </div>
            <div class = "field">
                <select id = "tstatus">
                <option value = ""></option>
                <option '.(($status=='Active')?'selected="selected"':"").'value = "Active">Active</option>
                <option '.(($status=='Discontinued')?'selected="selected"':"").' value = "Discontinued">Discontinued</option>
                </select>
            </div>
        </div>
    </div>
    <div class = "signupButton">
        <button type = "button" id = "update" onclick = updateTool()>Update</button>
    </div>
    <div class = "signupButton">
        <button type = "button" id = "delete" onclick = deleteTool()>Delete</button>
    </div>

</div>
<h2 id="footer"><a href="./Tool.php">Go Back To Tool &raquo;</a></h2>
'
 //value = "'. $result['ToolYearMade'] .'"
?>
<script>
function updateTool() {
    var tid = document.getElementById('tid').value;
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
    req.open("GET", "updateTool.php?tid=" + tid 
    + "&ttype=" + ttype 
    + "&toption=" + toption 
    + "&tsize=" + tsize
    + "&tpolarity=" + tpolarity 
    + "&tnumber=" + tnumber
    + "&datepicker=" + datepicker
    + "&tstatus=" + tstatus
    ); 

    req.send();
    alert("Tool Updated Successfully");
    location.replace("./Tool.php");
}

function deleteTool() {
    if(confirm("Are you sure you want to permanently delete this Tool?") == true ) {
        var tid = document.getElementById('tid').value;
        var req = new XMLHttpRequest();

        req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200)
        {
            req.responseText;
        }
        }
        req.open("GET", "deleteTool.php?tid=" + tid 
        ); 

        req.send();
        alert("Tool Deleted Successfully");
        location.replace("./Tool.php");
    }
}
</script>


<?php $conn = null; ?>
</body>
</html>


