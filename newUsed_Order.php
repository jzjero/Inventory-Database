<?php
require_once('header2.html');
?>
<body>
<script>
  $(function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
</script>
<div id="carbonForm1">
    <h1>New Usage Order</h1>

        <div class = "fieldContainer">
            <div class = "formRow">
            <div class = "label">
                <label for = "uoemployee">EmployeeID</label>
            </div>
            <div class = "field">
                <input type = "text" onclick = showEmployeeTable(); id = "uoemployee" readonly>
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
                <label for = "uotool">ToolID</label>
            </div>
            <div class = "field">
                <input type = "text" onclick = showToolTable(); id = "uotool" readonly>
            </div>
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
            
            <div class = "formRow">
                <div class = "label">
                    <label for = "datepicker1">Used Date</label>
                </div>
                <div class = "field">
                    <input type="text" id="datepicker1" readonly>
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "uonotes">Usage Notes</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "uonotes">
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "uosubtotal">Subtotal</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "uosubtotal">
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "uostatus">Status</label>
                </div>

                <div class = "field">
                    <select id = "uostatus">
                    <option value = ""></option>
                    <option value = "Open" >Open</option>
                    <option value = "Closed" >Closed</option>
                    </select>
                </div>
            </div>


        </div>

        <div class = "signupButton">
            <button type = "button" id = "submit" onclick = insertUsedOrder()>Add New Used Order</button>
        </div>
</div>

    <h2 id="footer"><a href="./Used_Order.php">Go Back To Usage Order &raquo;</a></h2>
</body>
<script> 

function insertUsedOrder() {
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
    req.open("GET", "insertUsed_Order.php?uoemployee=" + uoemployee 
    + "&uotool=" + uotool 
    + "&datepicker1=" + datepicker1 
    + "&uonotes=" + uonotes
    + "&uosubtotal=" + uosubtotal
    + "&uostatus=" + uostatus
    );

    req.send();
    alert("Added New Usage Order Successfully");
    location.replace("./Used_Order.php");
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