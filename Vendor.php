<?php
require_once('header1.html');
?>
<body>
    <h1>Vendor</h1>
    <nav id="nav01"></nav>
    <table id = "table_id" class = "display">
    <div class = "signupButton1">
        <button type = "button" id = "createNewVendor" onClick="window.location.href = './newVendor.php';">Add New Vendor</button>
    </div>
        <thead>
            <tr align="left">
                <th>Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Website</th>
                <th>Contact</th>
                <th>BOM Type</th>
            </tr>
        </thead>
        <div>
        <tbody>
            <?php
            require_once('connect.php');
            $query = "select * from Vendor";
            $stmt = $conn->prepare($query);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
            }
            while ( $result = $stmt->fetch() ) {
                echo '<tr class = "clickable-row" data-href = "./editVendor.php?VendorID='. $result['VendorID'] .'">
                    <td>' . $result['VendorName'] . '</td>
                    <td>' . $result['VendorAddress'] . '</td>
                    <td>' . $result['VendorPhone'] . '</td>
                    <td>' . $result['VendorEmail'] . '</td>
                    <td>' . $result['VendorWebsite'] . '</td>
                    <td>' . $result['VendorContactName'] . '</td>
                    <td>' . $result['VendorBOMtype'] . '</td>
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