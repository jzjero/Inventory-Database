<?php
require_once('header2.html');
?>
<body>
<script>
  $(function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
</script>
<?php 
$Used_OrderID = $_GET['Used_OrderID'];
require_once('connect.php');
$query = "Select Used_OrderEmployeeID from Used_Order Where Used_OrderID = '$Used_OrderID'";
$stmt = $conn->prepare($query);
if ($stmt->execute()) {
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
}
echo '
<div id="carbonForm1">
    <h1>Edit Usage Order</h1>
        <input type = "text" id = "uoorder" value = '.$Used_OrderID.' hidden>
        <div class = "fieldContainer">
            <div class = "formRow">
            <div class = "label">
                <label for = "uoemployee">EmployeeID</label>
            </div>
            <div class = "field">
                <input type = "text" readonly onclick = showEmployeeTable(); id = "uoemployee" value = '.$result['Used_OrderEmployeeID'].'>
                
            </div>
            </div>
            
            <span id="etable" hidden>
            <h4>Select Employee</h4>
            <table id = "etable_id" class = "display">
            <thead>
            <tr align="left">
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Email</th>
            </tr>
            </thead>
            '?>
            <div>
            <tbody>
                <?php
                require_once('connect.php');
                $query = "select * from Employee";
                $stmt = $conn->prepare($query);
                if ($stmt->execute()) {
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                }
                while ( $result = $stmt->fetch() ) {
                //echo '<tr class = "clickable-row" data-href = "./editEmployee.php?EmployeeID='. $result['EmployeeID'] .'">
                echo '<tr class = "eclickable-row" data-href = '.$result['EmployeeID'].'>
                    <td>' . $result['EmployeeFirstName'] . '</td>
                    <td>' . $result['EmployeeLastName'] . '</td>
                    <td>' . $result['EmployeePhone'] . '</td>
                    <td>' . $result['EmployeeEmail'] . '</td>
    	       </tr>';
                }

                ?>

            </tbody>
            </div>
            </table>
            </span>
            <div class = "formRow">
            <div class = "label">
                <label for = "uotool">ToolID</label>
            </div>
            <?php 
                $query = "Select Used_OrderToolID from Used_Order Where Used_OrderID = '$Used_OrderID'";
                $stmt = $conn->prepare($query);
                if ($stmt->execute()) {
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result = $stmt->fetch();
                }
            echo '
            <div class = "field">
                <input type = "text" readonly onclick = showToolTable(); id = "uotool" value = '.$result['Used_OrderToolID'].' >
            </div>
            '?>
            </div>
            
            <span id="ttable" hidden>
            <h4>Select Tool</h4>


            <table id = "ttable_id" class = "display">
                <thead>
                    <tr align="left">
                        <th>Type</th>
                        <th>Option</th>
                        <th>Size</th>
                        <th>Polarity</th>
                        <th>Number</th>
                        <th>Make Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <div>
                <tbody>
                    <?php
                    require_once('connect.php');
                    $query = "select * from Tool";
                    $stmt = $conn->prepare($query);
                    if ($stmt->execute()) {
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    }
                    while ( $result = $stmt->fetch() ) {
                        //echo '<tr class = "clickable-rowvendor" data-href = "./editVendor.php?VendorID='. $result['VendorID'] .'">
                        echo '<tr class = "tclickable-row" data-href = '. $result['ToolID'] .'>
                            <td>' . $result['ToolType'] . '</td>
                            <td>' . $result['ToolOption'] . '</td>
                            <td>' . $result['ToolSize'] . '</td>
                            <td>' . $result['ToolPulsePolarity'] . '</td>
                            <td>' . $result['ToolNumber'] . '</td>
                            <td>' . $result['ToolDateMade'] . '</td>
                            <td>' . $result['ToolStatus'] . '</td>
                       </tr>';
                    }

                    ?>
                </tbody>
                </div>

            </table>
            </span>
            <?php 
                $query = "Select Used_OrderDate,Used_OrderNotes,Used_OrderSubTotal,Used_OrderStatus from Used_Order Where Used_OrderID = '$Used_OrderID'";
                $stmt = $conn->prepare($query);
                if ($stmt->execute()) {
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result = $stmt->fetch();
                }
            echo '
            <div class = "formRow">
                <div class = "label">
                    <label for = "datepicker1">Used Date</label>
                </div>
                <div class = "field">
                    <input type="text" readonly id="datepicker1" value = "'.$result['Used_OrderDate'].'" >
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "uonotes">Usage Notes</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "uonotes" value = "'.$result['Used_OrderNotes'].'">
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "uosubtotal">Subtotal</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "uosubtotal" value = "'.$result['Used_OrderSubTotal'].'">
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "uostatus">Status</label>
                </div>

                <div class = "field">
                    <select id = "uostatus">
                    <option value = ""></option>
                    <option '.(($result['Used_OrderStatus'] == "Open")?'selected="selected"':"").' value = "Open" >Open</option>
                    <option '.(($result['Used_OrderStatus'] == "Closed")?'selected="selected"':"").' value = "Closed" >Closed</option>
                    </select>
                </div>
            </div>
        </div>

        <div class = "signupButton">
            <button type = "button" id = "update" onclick = updateUsedOrder()>Update Used Order</button>
        </div>
</div>

    <h2 id="footer"><a href="./Used_Line.php?Used_OrderID='.$Used_OrderID.'">Go Back To Usage Order Details &raquo;</a></h2>
</body>
'?>
<script> 

function updateUsedOrder() {
    var uoorder = document.getElementById('uoorder').value;
    var uoemployee = document.getElementById('uoemployee').value;
    if(uoemployee == "") {uoemployee = "NULL";}
    var uotool = document.getElementById('uotool').value;
    if(uotool == "") {uotool = "NULL";}
    var datepicker1 = document.getElementById('datepicker1').value;
    var uonotes = document.getElementById('uonotes').value;
    var uosubtotal = document.getElementById('uosubtotal').value;
    var uostatus = document.getElementById('uostatus').value;
    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
    if (req.readyState == 4 && req.status == 200)
    {
        req.responseText;
    }
    }
    req.open("GET", "updateUsed_Order.php?uoorder=" + uoorder
    + "&uoemployee=" + uoemployee 
    + "&uotool=" + uotool 
    + "&datepicker1=" + datepicker1 
    + "&uonotes=" + uonotes
    + "&uosubtotal=" + uosubtotal
    + "&uostatus=" + uostatus
    );


    req.send();
    alert("Updated Usage Order Successfully");
    location.replace("./Used_Line.php?Used_OrderID=" + uoorder);
}
    
    function showEmployeeTable() {
        $("#etable").toggle();
    };
    
    function showToolTable() {
        $("#ttable").toggle();
    };
    /*$(document).ready(function($) {
       $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
        });
    });*/

    $(document).ready(function($) {
       $(".eclickable-row").click(function() {
        document.getElementById("uoemployee").value = $(this).data("href");
        $("#etable").hide();
        });
    });
    
    $(document).ready(function($) {
       $(".tclickable-row").click(function() {
        document.getElementById("uotool").value = $(this).data("href");
        $("#ttable").hide();
        });
    });

    $(document).ready(function() {
        $('table.display').DataTable();
    });

</script>
<?php $conn = null; ?>
</body>
</html>