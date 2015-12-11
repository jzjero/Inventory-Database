<?php
require_once('header2.html');
?>
<body>
<div id="carbonForm1">
    <h1>Edit Usage Line</h1>
        <div class = "fieldContainer">
            <div class = "formRow">
                <div class = "label">
                    <label for = "ulorder">Used OrderID</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "ulorder" value = <?php echo $_GET['Used_LineUsed_OrderID']; ?> readonly >
                </div>
            </div>
            
            <div class = "formRow">
                <div class = "label">
                    <label for = "ulcomponent">ComponentID</label>
                </div>
                <div class = "field">
                    <input type = "text" onclick = showComponentTable(); id = "ulcomponent" value = <?php echo $_GET['Used_LineComponentID']; ?> readonly>
                </div>
            </div>
            
            <span id="ulctable" hidden>
            
            <h4>Select Component</h4>
                <table id = "table_id" class = "display">
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
                            echo '<tr class = "clickable-row" data-href = '. $result['ComponentID'] .'>
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
            </span>

            <div class = "formRow">
                <div class = "label">
                    <label for = "ulquantity">Used Quantity</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "ulquantity" onchange = calcSubtotal(); value = <?php echo $_GET['ulquantity']; ?> >
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "ulcost">Used Cost</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "ulcost" onchange = calcSubtotal(); value = <?php echo $_GET['ulcost']; ?> >
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "ulstatus">Used Status</label>
                </div>
                
                <?php echo'
                <div class = "field">
                    <select id = "ulstatus">
                    <option value = ""></option>
                    <option '.(($_GET['ulstatus'] == "Used")?'selected="selected"':"").'value = "Used" >Used</option>
                    <option '.(($_GET['ulstatus'] == "Defective")?'selected="selected"':"").'value = "Defective" >Defective</option>
                    <option '.(($_GET['ulstatus'] == "Salvaged")?'selected="selected"':"").'value = "Salvaged" >Salvaged</option>
                    <option '.(($_GET['ulstatus'] == "Cancelled")?'selected="selected"':"").'value = "Cancelled" >Cancelled</option>
                    </select>
                </div>
                '?>
            </div>
            
            <div class = "formRow">
                <div class = "label">
                    <label for = "datepicker">Date Used</label>
                </div>
                <div class = "field">
                    <input type="text" readonly id="datepicker" value = <?php echo $_GET['datepicker']; ?> >
                </div>
            </div>

            

            <div class = "formRow">
                <div class = "label">
                    <label for = "ulsubtotal">Subtotal</label>
                </div>
                <div class = "field">
                    <input type = "text" readonly id = "ulsubtotal" value = <?php echo $_GET['ulsubtotal']; ?> >
                </div>
            </div>


        </div>

        <div class = "signupButton">
            <button type = "button" id = "update" onclick = updateUsedLine()>Update Usage Line</button>
        </div>
</div>

    <h2 id="footer"><a href="./Used_Line.php?Used_OrderID=<?php echo $_GET['Used_LineUsed_OrderID']; ?>">Go Back To Usage Details &raquo;</a></h2>
</body>
<script> 

function updateUsedLine() {
    var ulorder = document.getElementById('ulorder').value;
    var ulcomponent = document.getElementById('ulcomponent').value;
    var ulquantity = document.getElementById('ulquantity').value;
    var ulcost = document.getElementById('ulcost').value;
    var ulstatus = document.getElementById('ulstatus').value;
    var datepicker = document.getElementById('datepicker').value;
    var ulsubtotal = document.getElementById('ulsubtotal').value;
    
    
    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
    if (req.readyState == 4 && req.status == 200)
    {
        req.responseText;
    }
    }
    req.open("GET", "updateUsed_Line.php?ulorder=" + ulorder
    + "&ulcomponent=" + ulcomponent
    + "&ulquantity=" + ulquantity 
    + "&ulcost=" + ulcost
    + "&ulstatus=" + ulstatus
    + "&datepicker=" + datepicker
    + "&ulsubtotal=" + ulsubtotal
    );

    req.send();
    alert("Usage Line Updated Successfully");
    location.replace("./Used_Line.php?Used_OrderID=<?php echo $_GET['Used_LineUsed_OrderID']; ?>");
    }
    
    function showComponentTable() {
        $("#ulctable").toggle();
    };

    $(document).ready(function($) {
       $(".clickable-row").click(function() {
        document.getElementById("ulcomponent").value = $(this).data("href");
        $("#ulctable").hide();
        });
    });

    function calcSubtotal() {
        var ulquantity = document.getElementById('ulquantity').value;
        var ulcost = document.getElementById('ulcost').value;
        var ulsubtotal;
        if(ulquantity == "" || ulcost == "") {
            ulsubtotal = "";
            document.getElementById('ulsubtotal').value = ulsubtotal;
        }
        else {
            ulsubtotal = ulquantity * ulcost;
            document.getElementById('ulsubtotal').value = ulsubtotal.toFixed(2);
        }
    }

</script>
<?php $conn = null; ?>
</body>
</html>