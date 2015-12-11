<?php
require_once('header1.html');
?>
<body>
    <h1>Employee</h1>
    <nav id="nav01"></nav>
    <table id = "table_id" class = "display">
    <div class = "signupButton1">
        <button type = "button" id = "createNewEmployee" onClick="window.location.href = './newEmployee.php';">Add New Employee</button>
    </div>
        <!-- <input type="submit" class="button" onClick="window.location.href = './newEmployee.php';" name="newEmployee" value="Create New Employee" /> -->

        <thead>
            <tr align="left">
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Email</th>
            </tr>
        </thead>
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
                echo '<tr class = "clickable-row" data-href = "./editEmployee.php?EmployeeID='. $result['EmployeeID'] .'">
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