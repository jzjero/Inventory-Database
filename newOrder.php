<?php
require_once('header2.html');
?>
<body>
<div id="carbonForm1">
    <h1>New Order</h1>

        <div class = "fieldContainer">
            <div class = "formRow">
            <div class = "label">
                <label for = "oemployee">EmployeeID</label>
            </div>
            <div class = "field">
                <input type = "text" onclick = showEmployeeTable(); id = "oemployee" readonly>
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
                echo '<tr class = "eclickable-row" data-href = '. $result['EmployeeID'] .'>
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
                <label for = "ovendor">VendorID</label>
            </div>
            <div class = "field">
                <input type = "text" onclick = showVendorTable(); id = "ovendor" readonly>
            </div>
            </div>
            
            <span id="vtable" hidden>
            <h4>Select Vendor</h4>


            <table id = "vtable_id" class = "display">
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
                        //echo '<tr class = "clickable-rowvendor" data-href = "./editVendor.php?VendorID='. $result['VendorID'] .'">
                        echo '<tr class = "vclickable-row" data-href = '. $result['VendorID'] .'>
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
            </span>
            <div class = "formRow">
                <div class = "label">
                    <label for = "oponumber">P.O. Number</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "oponumber">
                </div>
            </div>
            
            <div class = "formRow">
                <div class = "label">
                    <label for = "datepicker">Order Date</label>
                </div>
                <div class = "field">
                    <input type="text" id="datepicker" readonly>
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "onotes">Order Notes</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "onotes">
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "osubtotal">Subtotal</label>
                </div>
                <div class = "field">
                    <input type = "text" readonly id = "osubtotal">
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "ostatus">Status</label>
                </div>
                 <div class = "field">
                    <select id = "ostatus">
                    <option value = ""></option>
                    <option value = "Open" >Open</option>
                    <option value = "Closed" >Closed</option>
                    </select>
                </div>
            </div>


        </div>

        <div class = "signupButton">
            <button type = "button" id = "submit" onclick = insertOrder()>Add New Order</button>
        </div>
</div>

    <h2 id="footer"><a href="./Order.php">Go Back To Order &raquo;</a></h2>
</body>
<script> 

function insertOrder() {
    var oemployee = document.getElementById('oemployee').value;
    var ovendor = document.getElementById('ovendor').value;
    var oponumber = document.getElementById('oponumber').value;
    var datepicker = document.getElementById('datepicker').value;
    var onotes = document.getElementById('onotes').value;
    var osubtotal = document.getElementById('osubtotal').value;
    var ostatus = document.getElementById('ostatus').value;
    
    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
    if (req.readyState == 4 && req.status == 200)
    {
        req.responseText;
    }
    }
    req.open("GET", "insertOrder.php?oemployee=" + oemployee 
    + "&ovendor=" + ovendor 
    + "&oponumber=" + oponumber
    + "&datepicker=" + datepicker 
    + "&onotes=" + onotes
    + "&osubtotal=" + osubtotal
    + "&ostatus=" + ostatus
    );

    req.send();
    alert("Added New Order Successfully");
    location.replace("./Order.php");
}
    
    function showEmployeeTable() {
        $("#etable").toggle();
    };
    
    function showVendorTable() {
        $("#vtable").toggle();
    };
    /*$(document).ready(function($) {
       $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
        });
    });*/

    $(document).ready(function($) {
       $(".eclickable-row").click(function() {
        document.getElementById("oemployee").value = $(this).data("href");
        $("#etable").hide();
        });
    });
    
    $(document).ready(function($) {
       $(".vclickable-row").click(function() {
        document.getElementById("ovendor").value = $(this).data("href");
        $("#vtable").hide();
        });
    });

    $(document).ready(function() {
        $('table.display').DataTable();
    });

</script>
<?php $conn = null; ?>
</body>
</html>