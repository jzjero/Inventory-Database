<?php
require_once('header1.html');
?>
<body>
    <h1>Order</h1>
    <nav id="nav01"></nav>
    <table id = "table_id" class = "display">
    <div class = "signupButton1">
        <button type = "button" id = "createNewOrder" onClick="window.location.href = './newOrder.php';">Add New Order</button>
    </div>
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
            <?php
            require_once('connect.php');

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
                    OrderVID = VendorID
                    AND
                    OrderEID = EmployeeID;";
            $OrderID = 
            $stmt = $conn->prepare($query);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
            }
            while ( $result = $stmt->fetch() ) {
                echo '<tr class = "clickable-row" data-href = "./Order_Line.php?OrderID='. $result['OrderID'] .'">
                    <td>' . $result['OrderPONumber'] . '</td>
                    <td>' . $result['Ordered_By'] . '</td>
                    <td>' . $result['Vendor_Name'] . '</td>
                    <td>' . $result['OrderDate'] . '</td>
                    <td>' . $result['OrderNotes'] . '</td>
                    <td>' . $result['OrderSubTotal'] . '</td>
                    <td>' . $result['OrderStatus'] . '</td>
    	       </tr>';
            }

            ?>

        </tbody>
        </div>
    </table>
    <h2 id="footer"><a href="./">Go Back To Home &raquo;</a></h2>
</body>
<script> 
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