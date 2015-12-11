<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="./demo/styles.css">

<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>

<link rel="stylesheet" type="text/css" href="./css/jquery.dataTables.css">

<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="./js/jquery.dataTables.js"></script>
<script>
$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>



</head>
<body>
<?php 
    $Used_OrderID = $_GET['Used_OrderID'];
    require_once('connect.php');
    //$query ="SELECT * From pdiDB.Order Where OrderID = '$OrderID'";
    $query = "SELECT
                    Used_OrderID,
                    CONCAT_WS(' ',EmployeeFirstName,EmployeeLastName) AS Used_By,
                    CONCAT_WS(' ',ToolType,ToolOption,ToolSize,ToolPulsePolarity,ToolNumber) AS Tool_Info,
                    Used_OrderDate,
                    Used_OrderNotes,
                    Used_OrderSubTotal,
                    Used_OrderStatus
                FROM
                    Used_Order
                    LEFT JOIN
                    Employee
                    ON
                    Used_OrderEmployeeID = EmployeeID
                    LEFT JOIN
                    Tool
                    ON
                    Used_OrderToolID = ToolID
                WHERE
                    Used_OrderID = '$Used_OrderID';";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    echo'
        <h1>Usage Order #'.$Used_OrderID.' Details</h1>
        <nav id="nav01"></nav>
        <div class = "signupButton2">
        <button type = "button" hidden id = "editUsageOrder" onClick="window.location.href = \'./editUsed_Order.php?Used_OrderID='.$Used_OrderID.'\'">Edit Usage Order</button>
        <button type = "button" id = "generateReport" onClick= generateUsedOrderDetailsReport('.$Used_OrderID.'); >Generate Used Order Details Report</button>
        <button type = "button" style ="float:right;" id = "addNewUsageLine" onClick="window.location.href = \'./newUsed_Line.php?Used_OrderID='.$Used_OrderID.'\'">Add New Used_Line</button>
    </div>
    <table id = "t01">
        <thead>
            <tr align="left">
                <th>Usage Order #</th>
                <th>Used By</th>
                <th>For Tool</th>
                <th>Date</th>
                <th>Notes</th>
                <th>Subtotal</th>
                <th>Status</th>
            </tr>
        </thead>
        <div>
        <tbody>
            <tr class = "clickable-row" data-href = "./editUsed_Order.php?Used_OrderID='.$Used_OrderID.'">
                    <td>' . $result['Used_OrderID'] . '</td>
                    <td>' . $result['Used_By'] . '</td>
                    <td>' . $result['Tool_Info'] . '</td>
                    <td>' . $result['Used_OrderDate'] . '</td>
                    <td>' . $result['Used_OrderNotes'] . '</td>
                    <td>' . $result['Used_OrderSubTotal'] . '</td>
                    <td>' . $result['Used_OrderStatus'] . '</td>
            </tr>
        </tbody>
        </div>
    </table>
'?>

    <table id = "table_id" class = "display">
        <thead>
            <tr align="left">
                <th>Component Used</th>
                <th>Quantity Used</th>
                <th>Cost</th>
                <th>Status</th>
                <th>Date Used</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <div>
        <tbody>
            <?php
            $query = "SELECT
                    CONCAT_WS(' ',ComponentReference,ComponentValue,ComponentPartNumber,ComponentManufacturer) AS ComponentSpecs,
                    Used_LineQuantity,
                    Used_LineCost,
                    Used_LineStatus,
                    Used_LineDate,
                    Used_LineSubTotal,
                    ComponentID
                FROM
                    Used_Line
                    JOIN
                    Used_Order
                    JOIN
                    Component
                WHERE
                    Used_LineUsed_OrderID = '$Used_OrderID'
                    AND
                    Used_OrderID = '$Used_OrderID'
                    AND
                    Used_LineComponentID = ComponentID;";
            $stmt = $conn->prepare($query);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
            }
            while ( $result = $stmt->fetch() ) {
                echo '<tr class = "clickable-row" data-href = "./editUsed_Line.php?Used_LineUsed_OrderID='.$Used_OrderID.'&Used_LineComponentID='.$result['ComponentID'].'&ulquantity='.$result['Used_LineQuantity'].'&ulcost='.$result['Used_LineCost'].'&ulstatus='.$result['Used_LineStatus'].'&datepicker='.$result['Used_LineDate'].'&ulsubtotal='.$result['Used_LineSubTotal'].'">
                    <td>' . $result['ComponentSpecs'] . '</td>
                    <td>' . $result['Used_LineQuantity'] . '</td>
                    <td>' . $result['Used_LineCost'] . '</td>
                    <td>' . $result['Used_LineStatus'] . '</td>
                    <td>' . $result['Used_LineDate'] . '</td>
                    <td>' . $result['Used_LineSubTotal'] . '</td>
                </tr>';
            }

            ?>

        </tbody>
        </div>
    </table>
    <h2 id="footer"><a href="./Used_Order.php">Go Back To Usage Order &raquo;</a></h2>
</body>
<script>

function generateUsedOrderDetailsReport(usedorderid) {
   window.open('usedOrderDetailsReport.php?Used_OrderID='+usedorderid,'name','width=900,height=700');
    } 
    
    $(document).ready(function($) {
       $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
        });
    });

    document.getElementById("nav01").innerHTML =
        "<ul id='menu'>" +
            "<li><a href='index.html'>Home</a></li>" +
            "<li><a href='inventory.php'>Inventory</a></li>" +
            "<li><a href='Order.php'>Orders</a></li>" +
            "<li><a href='Used_Order.php'>Usage Orders</a></li>" +
            "<li><a href='Tool.php'>Tools</a></li>" +
            "<li><a href='Component.php'>Components</a></li>" +
            "<li><a href='Vendor.php'>Vendors</a></li>" +
            "<li><a href='Employee.php'>Employees</a></li>" +
        "</ul>";
</script>
<?php $conn = null; ?>
</body>
</html>