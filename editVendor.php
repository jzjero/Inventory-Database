<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./demo/styles.css">
<title>Edit Vendor</title>
</head>
<body>
<?php 
$VendorID = $_GET['VendorID'];
require_once('connect.php');
$query = "Select * from Vendor Where VendorID = '$VendorID'";
$stmt = $conn->prepare($query);
if ($stmt->execute()) {
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
}
$selected = $result['VendorBOMtype'];
echo '
<div id="carbonForm">
    <h1>Edit Vendor</h1>
    <input type = "hidden" id = "vid" value = "'. $result['VendorID'] .'">
    <div class = "fieldContainer">
        <div class = "formRow">
            <div class = "label">
                <label for = "vname">Name</label>
            </div>
            <div class = "field">
                <input type = "text" id = "vname" value = "'. $result['VendorName'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "vaddress">Address</label>
            </div>
            <div class = "field">
                <input type = "text" id = "vaddress" value = "'. $result['VendorAddress'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "vphone">Phone</label>
            </div>
            <div class = "field">
                <input type = "text" id = "vphone" value = "'. $result['VendorPhone'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "vemail">Email</label>
            </div>
            <div class = "field">
                <input type = "text" id = "vemail" value = "'. $result['VendorEmail'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "vwebsite">Website</label>
            </div>
            <div class = "field">
                <input type = "text" id = "vwebsite" value = "'. $result['VendorWebsite'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "vcontact">Contact</label>
            </div>
            <div class = "field">
                <input type = "text" id = "vcontact" value = "'. $result['VendorContactName'] .'">
            </div>
        </div>
        <div class = "formRow">
            <div class = "label">
                <label for = "vbom">BOM Type</label>
            </div>
            <div class = "field">
                <select id = "vbom">
                <option value = ""></option>
                <option '.(($selected=='.CSV')?'selected="selected"':"").'value = ".CSV" >.CSV</option>
                <option '.(($selected=='.XML')?'selected="selected"':"").' value = ".XML">.XML</option>
                <option '.(($selected=='.PDF')?'selected="selected"':"").' value = ".PDF">.PDF</option>
                </select>
            </div>
        </div>
    </div>
    <div class = "signupButton">
        <button type = "button" id = "update" onclick = updateVendor()>Update</button>
    </div>
    <div class = "signupButton">
        <button type = "button" id = "delete" onclick = deleteVendor()>Delete</button>
    </div>

</div>
<h2 id="footer"><a href="./Vendor.php">Go Back To Vendor &raquo;</a></h2>
'
//<input type = "text" id = "vbom" value = "'. $result['VendorBOMtype'] .'">
?>
<script>
function updateVendor() {
    var vid = document.getElementById('vid').value;
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
    req.open("GET", "updateVendor.php?vid=" + vid 
    + "&vname=" + vname 
    + "&vaddress=" + vaddress 
    + "&vphone=" + vphone 
    + "&vemail=" + vemail
    + "&vwebsite=" + vwebsite
    + "&vcontact=" + vcontact
    + "&vbom=" + vbom 
    ); 

    req.send();
    alert("Vendor Updated Successfully");
    location.replace("./Vendor.php");
}

function deleteVendor() {
    if(confirm("Are you sure you want to permanently delete this Vendor?") == true ) {
        var vid = document.getElementById('vid').value;
        var req = new XMLHttpRequest();

        req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200)
        {
            req.responseText;
        }
        }
        req.open("GET", "deleteVendor.php?vid=" + vid 
        ); 

        req.send();
        alert("Vendor Deleted Successfully");
        location.replace("./Vendor.php");
    }
}
</script>
<?php $conn = null; ?>
</body>
</html>


