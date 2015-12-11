<?php
require_once('header2.html');
?>
<body>
<div id="carbonForm1">
    <h1>Edit Order Line</h1>
        <div class = "fieldContainer">
            <div class = "formRow">
                <div class = "label">
                    <label for = "olorder">OrderID</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "olorder" value = <?php echo $_GET['OrderID']; ?> readonly >
                </div>
            </div>
            
            <div class = "formRow">
                <div class = "label">
                    <label for = "olcomponent">ComponentID</label>
                </div>
                <div class = "field">
                    <input type = "text" onclick = showComponentTable(); id = "olcomponent" value = <?php echo $_GET['ComponentID']; ?> readonly>
                </div>
            </div>
            
            <span id="olctable" hidden>
            
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
                    <label for = "olquantity">Quantity</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "olquantity" onchange = calcSubtotal(); value = <?php echo $_GET['olquantity']; ?> >
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "olcost">Price</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "olcost" onchange = calcSubtotal(); value = <?php echo $_GET['olcost']; ?> >
                </div>
            </div>

            <div class = "formRow">
                <div class = "label">
                    <label for = "olstatus">Order Status</label>
                </div>
                <?php echo'
                <div class = "field">
                    <select id = "olstatus">
                    <option value = ""></option>
                    <option '.(($_GET['olstatus'] == "Ordered")?'selected="selected"':"").' value = "Ordered" >Ordered</option>
                    <option '.(($_GET['olstatus'] == "Shipped")?'selected="selected"':"").' value = "Shipped" >Shipped</option>
                    <option '.(($_GET['olstatus'] == "Received")?'selected="selected"':"").' value = "Received" >Received</option>
                    <option '.(($_GET['olstatus'] == "Cancelled")?'selected="selected"':"").' value = "Cancelled" >Cancelled</option>
                    </select>
                </div>
                '?>
            </div>
            
            <div class = "formRow">
                <div class = "label">
                    <label for = "datepicker">Received Date</label>
                </div>
                <div class = "field">
                    <input type="text" id="datepicker" readonly value = <?php echo $_GET['datepicker']; ?> >
                </div>
            </div>

            

            <div class = "formRow">
                <div class = "label">
                    <label for = "olsubtotal">Subtotal</label>
                </div>
                <div class = "field">
                    <input type = "text" id = "olsubtotal" readonly value = <?php echo $_GET['olsubtotal']; ?> >
                </div>
            </div>


        </div>

        <div class = "signupButton">
            <button type = "button" id = "update" onclick = updateOrderLine()>Update Order Line</button>
        </div>
</div>

    <h2 id="footer"><a href="./Order_Line.php?OrderID=<?php echo $_GET['OrderID']; ?>">Go Back To Order Details &raquo;</a></h2>
</body>
<script> 

function updateOrderLine() {
    var olorder = document.getElementById('olorder').value;
    var olcomponent = document.getElementById('olcomponent').value;
    var olquantity = document.getElementById('olquantity').value;
    var olcost = document.getElementById('olcost').value;
    var olstatus = document.getElementById('olstatus').value;
    var datepicker = document.getElementById('datepicker').value;
    var olsubtotal = document.getElementById('olsubtotal').value;
    
    
    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
    if (req.readyState == 4 && req.status == 200)
    {
        req.responseText;
    }
    }
    req.open("GET", "updateOrder_Line.php?olorder=" + olorder
    + "&olcomponent=" + olcomponent
    + "&olquantity=" + olquantity 
    + "&olcost=" + olcost
    + "&olstatus=" + olstatus
    + "&datepicker=" + datepicker
    + "&olsubtotal=" + olsubtotal
    );

    req.send();
    alert("Added New Order_Line Successfully");
    location.replace("./Order_Line.php?OrderID=<?php echo $_GET['OrderID']; ?>");
    }
    
function showComponentTable() {
    $("#olctable").toggle();
};

$(document).ready(function($) {
    $(".clickable-row").click(function() {
    document.getElementById("olcomponent").value = $(this).data("href");
    $("#olctable").hide();
    });
});

    function calcSubtotal() {
        var olquantity = document.getElementById('olquantity').value;
        var olcost = document.getElementById('olcost').value;
        var olsubtotal;
        if(olquantity == "" || olcost == "") {
            olsubtotal = "";
            document.getElementById('olsubtotal').value = olsubtotal;
        }
        else {
            olsubtotal = olquantity * olcost;
            document.getElementById('olsubtotal').value = olsubtotal.toFixed(2);
        }
    }

</script>
<?php $conn = null; ?>
</body>
</html>