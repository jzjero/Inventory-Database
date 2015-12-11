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
    $OrderID = $_GET['OrderID'];
    require_once('connect.php');
    //$query ="SELECT * From pdiDB.Order Where OrderID = '$OrderID'";
    $query = "SELECT
                    OrderID,
                    OrderPONumber,
                    CONCAT_WS(' ',EmployeeFirstName,EmployeeLastName) AS Ordered_By,
                    VendorName AS Vendor_Name,
                    OrderDate,
                    OrderNotes,
                    OrderSubTotal,
                    OrderStatus
                FROM
                    pdiDB.Order
                    JOIN
                    Employee
                    JOIN
                    Vendor
                WHERE
                    OrderID = '$OrderID'
                    AND
                    OrderVID = VendorID
                    AND
                    OrderEID = EmployeeID;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    echo'
        <h1>Order Details '.$result['OrderPONumber'].' </h1>
        <nav id="nav01"></nav>
        <div class = "signupButton2">
        <button type = "button" hidden id = "editOrder" onClick="window.location.href = \'./editOrder.php?OrderID='.$OrderID.'\'">Edit Order</button>
        <button type = "button" id = "generateReport" onClick= generateOrderDetailsReport('.$OrderID.'); >Generate Order Details Report</button>
        <button type = "button" style ="float:right;" id = "addNewOrderLine" onClick="window.location.href = \'./newOrder_Line.php?OrderID='.$OrderID.'\'">Add New Order_Line</button>
    </div>
    <table id = "t01">
        <thead>
            <tr align="left">
                <th>P.O. Number</th>
                <th>Ordered By</th>
                <th>Ordered From</th>
                <th>Date</th>
                <th>Notes</th>
                <th>Subtotal</th>
                <th>Status</th>
            </tr>
        </thead>
        <div>
        <tbody>
            <tr class = "clickable-row" data-href = "./editOrder.php?OrderID='.$OrderID.'">
                    <td>' . $result['OrderPONumber'] . '</td>
                    <td>' . $result['Ordered_By'] . '</td>
                    <td>' . $result['Vendor_Name'] . '</td>
                    <td>' . $result['OrderDate'] . '</td>
                    <td>' . $result['OrderNotes'] . '</td>
                    <td>' . $result['OrderSubTotal'] . '</td>
                    <td>' . $result['OrderStatus'] . '</td>
            </tr>
        </tbody>
        </div>
    </table>
'?>
    <table id = "table_id" class = "display">
        <thead>
            <tr align="left">
                <th>Component</th>
                <th>Order Quantity</th>
                <th>Order Price</th>
                <th>Order Status</th>
                <th>Date Received</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <div>
        <tbody>
            <?php
            $query = "SELECT
                    CONCAT_WS(' ',ComponentReference,ComponentValue,ComponentPartNumber,ComponentManufacturer) AS ComponentSpecs,
                    Order_LineQuantity,
                    Order_LineCost,
                    Order_LineStatus,
                    Order_LineReceivedDate,
                    Order_LineSubTotal,
                    Order_LineComponentID
                FROM
                    Order_Line
                    JOIN
                    pdiDB.Order
                    JOIN
                    Component
                WHERE
                    Order_LineOrderID = '$OrderID'
                    AND
                    OrderID = '$OrderID'
                    AND
                    Order_LineComponentID = ComponentID;";
            $stmt = $conn->prepare($query);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
            }
            while ( $result = $stmt->fetch() ) {
                echo '<tr class = "clickable-row" data-href = "./editOrder_Line.php?OrderID='.$OrderID.'&ComponentID='.$result['Order_LineComponentID'].'&olquantity='.$result['Order_LineQuantity'].'&olcost='.$result['Order_LineCost'].'&olstatus='.$result['Order_LineStatus'].'&datepicker='.$result['Order_LineReceivedDate'].'&olsubtotal='.$result['Order_LineSubTotal'].'">
                    <td>' . $result['ComponentSpecs'] . '</td>
                    <td>' . $result['Order_LineQuantity'] . '</td>
                    <td>' . $result['Order_LineCost'] . '</td>
                    <td>' . $result['Order_LineStatus'] . '</td>
                    <td>' . $result['Order_LineReceivedDate'] . '</td>
                    <td>' . $result['Order_LineSubTotal'] . '</td>
                </tr>';
            }

            ?>

        </tbody>
        </div>
    </table>
    <h2 id="footer"><a href="./Order.php">Go Back To Order &raquo;</a></h2>
</body>
<script>
function generateOrderDetailsReport(orderid) {
   window.open('orderDetailsReport.php?OrderID='+orderid,'name','width=900,height=700');
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