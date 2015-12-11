<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./demo/styles.css">
<title>Edit Component</title>
</head>
<body>
<?php 
$ComponentID = $_GET['ComponentID'];
require_once('connect.php');
$query = "Select * from Component Where ComponentID = '$ComponentID'";
$stmt = $conn->prepare($query);
if ($stmt->execute()) {
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
}

echo '
<div id="carbonForm">
    <h1>Edit Component</h1>
    <input type = "hidden" id = "cid" value = "'. $result['ComponentID'] .'">
    <div class = "fieldContainer">
        <div class = "formRow">
            <div class = "label">
                <label for = "creference">Reference</label>
            </div>
            <div class = "field">
                <input type = "text" id = "creference" value = "'. $result['ComponentReference'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cvalue">Value</label>
            </div>
            <div class = "field">
                <input type = "text" id = "cvalue" value = "'. $result['ComponentValue'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cpartnumber">Part Number</label>
            </div>
            <div class = "field">
                <input type = "text" id = "cpartnumber" value = "'. $result['ComponentPartNumber'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cmanufacturer">Manufacturer</label>
            </div>
            <div class = "field">
                <input type = "text" id = "cmanufacturer" value = "'. $result['ComponentManufacturer'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cfootprint">Foot Print</label>
            </div>
            <div class = "field">
                <input type = "text" id = "cfootprint" value = "'. $result['ComponentFootPrint'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cprice">Price</label>
            </div>
            <div class = "field">
                <input type = "text" id = "cprice" value = "'. $result['ComponentPrice'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cdatasheet">Data Sheet</label>
            </div>
            <div class = "field">
                <input type = "text" id = "cdatasheet" value = "'. $result['ComponentDataSheet'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "cdescription">Description</label>
            </div>
            <div class = "field">
                <input type = "text" id = "cdescription" value = "'. $result['ComponentDescription'] .'">
            </div>
        </div>
    </div>    
    <div class = "signupButton">
        <button type = "button" id = "update" onclick = updateComponent()>Update</button>
    </div>
    <div class = "signupButton">
        <button type = "button" id = "delete" onclick = deleteComponent()>Delete</button>
    </div>

</div>
<h2 id="footer"><a href="./Component.php">Go Back To Component &raquo;</a></h2>
'
?>
<script>
function updateComponent() {
    var cid = document.getElementById('cid').value;
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
    req.open("GET", "updateComponent.php?cid=" + cid 
    + "&creference=" + creference 
    + "&cvalue=" + cvalue 
    + "&cpartnumber=" + cpartnumber
    + "&cmanufacturer=" + cmanufacturer 
    + "&cfootprint=" + cfootprint
    + "&cprice=" + cprice
    + "&cdatasheet=" + cdatasheet
    + "&cdescription=" + cdescription
    ); 

    req.send();
    alert("Component Updated Successfully");
    location.replace("./Component.php");
}

function deleteComponent() {
    if(confirm("Are you sure you want to permanently delete this Component?") == true ) {
        var cid = document.getElementById('cid').value;
        var req = new XMLHttpRequest();

        req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200)
        {
            req.responseText;
        }
        }
        req.open("GET", "deleteComponent.php?cid=" + cid 
        ); 

        req.send();
        alert("Component Deleted Successfully");
        location.replace("./Component.php");
    }
}
</script>


<?php $conn = null; ?>
</body>
</html>


