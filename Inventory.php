<?php
require_once('header1.html');
?>
<body>
    <h1>PDI Component Inventory</h1>
    <nav id="nav01"></nav>
    <div class = "signupButton2">
        <button type = "button" style ="float:Center;" id = "generateReport" onClick= generateInventoryReport(); >Inventory Report</button>
    </div>
    <table id = "table_id" class = "display">
        <thead>
            <tr align="left">
                <th>Reference</th>
                <th>Value</th>
                <th>Part Number</th>
                <th>Manufacturer</th>
                <th>Foot Print</th>
                <th>Quantity On Hand</th>
            </tr>
        </thead>
        <div>
        <tbody>
            <?php
            require_once('connect.php');
            $query = 
            "select
            C.ComponentReference,
            C.ComponentValue,
            C.ComponentPartNumber,
            C.ComponentManufacturer,
            C.ComponentFootPrint,
            IFNULL(I.quantity,0) AS quantity
            from 
            Inventory as I
            Right Join
            Component as C
            ON
            C.ComponentID = I.ComponentID
            ";
            $stmt = $conn->prepare($query);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
            }
            while ( $result = $stmt->fetch() ) {
                echo '<tr>
                
                    <td>' . $result['ComponentReference'] . '</td>
                    <td>' . $result['ComponentValue'] . '</td>
                    <td>' . $result['ComponentPartNumber'] . '</td>
                    <td>' . $result['ComponentManufacturer'] . '</td>
                    <td>' . $result['ComponentFootPrint'] . '</td>
                    <td>' . $result['quantity'] . '</td>
                    

    	       </tr>';
            }

            ?>
        </tbody>
        </div>
    </table>
    <h2 id="footer"><a href="./">Go Back To Home &raquo;</a></h2>
</body>
<script> 
    function generateInventoryReport() {
        /*var req = new XMLHttpRequest();

        req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200)
        {
            req.responseText;
        }
        }
        req.open("GET", "inventoryReport.php"
        ); 

        req.send();*/
        window.open('inventoryReport.php','name','width=900,height=700');
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