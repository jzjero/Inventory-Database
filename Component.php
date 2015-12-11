<?php
require_once('header1.html');
?>
<body>
    <h1>Component</h1>
    <nav id="nav01"></nav>
    <table id = "table_id" class = "display">
    <div class = "signupButton1">
        <button type = "button" id = "createNewComponent" onClick="window.location.href = './newComponent.php';">Add New Component</button>
    </div>
        <thead>
            <tr align="left">
                <th>Reference</th>
                <th>Value</th>
                <th>Part Number</th>
                <th>Manufacturer</th>
                <th>Foot Print</th>
                <th>Price</th>
                <th>Data Sheet</th>
                <th>Description</th>
            </tr>
        </thead>
        <div>
        <tbody>
            <?php
            require_once('connect.php');
            $query = "select * from Component";
            $stmt = $conn->prepare($query);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
            }
            while ( $result = $stmt->fetch() ) {
                echo '<tr class = "clickable-row" data-href = "./editComponent.php?ComponentID='. $result['ComponentID'] .'">
                    <td>' . $result['ComponentReference'] . '</td>
                    <td>' . $result['ComponentValue'] . '</td>
                    <td>' . $result['ComponentPartNumber'] . '</td>
                    <td>' . $result['ComponentManufacturer'] . '</td>
                    <td>' . $result['ComponentFootPrint'] . '</td>
                    <td>' . $result['ComponentPrice'] . '</td>
                    <td>' . $result['ComponentDataSheet'] . '</td>
                    <td>' . $result['ComponentDescription'] . '</td>
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