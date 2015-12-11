<?php
require_once('header1.html');
?>
<body>
    <h1>Usage Order</h1>
    <nav id="nav01"></nav>
    <table id = "table_id" class = "display">
    <div class = "signupButton1">
        <button type = "button" id = "createNewUsageOrder" onClick="window.location.href = './newUsed_Order.php';">Add New Used_Order</button>
    </div>
        <thead>
            <tr align="left">
                <th>Usage Number</th>
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
            <?php
            require_once('connect.php');
            $query = "SELECT
                    Used_OrderID,
                    CONCAT_WS(' ',EmployeeFirstName,EmployeeLastName) AS Used_By,
                    CONCAT_WS(' ',ToolType,ToolOption,ToolSize, ToolPulsePolarity,ToolNumber) AS For_Tool,
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
                    Used_OrderToolID = ToolID;";
            $stmt = $conn->prepare($query);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
            }
            while ( $result = $stmt->fetch() ) {
                echo '<tr class = "clickable-row" data-href = "./Used_Line.php?Used_OrderID='. $result['Used_OrderID'] .'">
                    <td>' . $result['Used_OrderID'] . '</td>
                    <td>' . $result['Used_By'] . '</td>
                    <td>' . $result['For_Tool'] . '</td>
                    <td>' . $result['Used_OrderDate'] . '</td>
                    <td>' . $result['Used_OrderNotes'] . '</td>
                    <td>' . $result['Used_OrderSubTotal'] . '</td>
                    <td>' . $result['Used_OrderStatus'] . '</td>
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