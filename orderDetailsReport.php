<?php
$OrderID = $_GET['OrderID'];
require('fpdf.php');
global $date;
class myPDF extends FPDF {
		public $title = "Order Details Report";
        //Page header method
        function Header() {
        $this->SetFont('Arial','B',16);
        $w = $this->GetStringWidth($this->title)+195;
        $this->SetLineWidth(1);
        $this->image('./demo/img/pdi.png',10,10,24.1,16);
        $this->Cell($w,16,$this->title . " " . $this->date,1,1,'C');
        $this->Ln(10);
        }
        //Page footer method
        function Footer()       {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '
        .$this->PageNo().'/{nb}',0,0,'C');
        }

        function BuildTable1($header,$data) {
        //Colors, line width and bold font
        $this->SetFillColor(255,255,255);
        $this->SetLineWidth(1);
        $this->SetFont('Arial','B',14);
        //Header
        // make an array for the column widths
        $w=array(35,35,35,50,75,20);
        // send the headers to the PDF document
        for($i=0; $i < count($header); $i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',1);
        $this->Ln();
        //Color and font restoration
        $this->SetFillColor(175);
        $this->SetTextColor(0);
        $this->SetFont('');
        //now spool out the data from the $data array
        $fill=true; // used to alternate row color backgrounds
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row[1],'LR',0,'C',$fill);
            $this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
            $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
            $this->Cell($w[4],6,$row[4],'LR',0,'L',$fill);
            $this->Cell($w[5],6,$row[5],'LR',0,'C',$fill);
            $this->Ln();
            $fill =! $fill;
        }
        $this->Cell(array_sum($w),0,'','T');
        }

        function BuildTable($header,$data) {
        //Colors, line width and bold font
        $this->SetFillColor(255,255,255);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial','',12);
        //Header
        // make an array for the column widths
        $w=array(90,30,30,30,50,20);
        // send the headers to the PDF document
        for($i=0; $i < count($header); $i++)
        	$this->Cell($w[$i],7,$header[$i],1,0,'C',1);
        $this->Ln();
        //Color and font restoration
        $this->SetFillColor(175);
        $this->SetTextColor(0);
        $this->SetFont('');
        //now spool out the data from the $data array
        $fill=true; // used to alternate row color backgrounds
        foreach($data as $row)
        {
	        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
	     	$this->Cell($w[1],6,number_format($row[1]),'LR',0,'R',$fill);
	        $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
	        $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
	        $this->Cell($w[4],6,$row[4],'LR',0,'L',$fill);
	        $this->Cell($w[5],6,$row[5],'LR',0,'R',$fill);
	        $this->Ln();
	        $fill =! $fill;
        }
        $this->Cell(array_sum($w),0,'','T');
        }
}

require_once('connect.php');

$query1 = "SELECT
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
                    OrderID = '$OrderID'
                    AND
                    OrderVID = VendorID
                    AND
                    OrderEID = EmployeeID;";
    $stmt1 = $conn->prepare($query1);
    $stmt1->execute();
    $result1 = $stmt1->fetch();
        $data1[] = array($result1['OrderPONumber'],
            $result1['Ordered_By'],
            $result1['Vendor_Name'],
            $result1['OrderDate'],
            $result1['OrderNotes'],
            $result1['OrderStatus']);
        $subtotal = $result1['OrderSubTotal'];
               
               $query = "SELECT
                    CONCAT_WS(' ',ComponentReference,ComponentValue,ComponentPartNumber,ComponentManufacturer) AS ComponentSpecs,
                    Order_LineQuantity,
                    Order_LineCost,
                    Order_LineStatus,
                    Order_LineReceivedDate,
                    Order_LineSubTotal,
                    Order_LineComponentID
                FROM
                    Order_Line
                    JOIN
                    pdiDB.Order
                    JOIN
                    Component
                WHERE
                    Order_LineOrderID = '$OrderID'
                    AND
                    OrderID = '$OrderID'
                    AND
                    Order_LineComponentID = ComponentID;";
            $stmt = $conn->prepare($query);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
            }
            while ( $result = $stmt->fetch() ) {
                $data[] = array($result['ComponentSpecs'],
                    $result['Order_LineQuantity'],
                    $result['Order_LineCost'],
                    $result['Order_LineStatus'],
                    $result['Order_LineReceivedDate'],
                    $result['Order_LineSubTotal']);
            }




date_default_timezone_set('America/Los_Angeles');
$pdf = new myPDF('L','mm','Letter');
$date = date("m/d/Y h:i A");
$pdf->date = $date;
$header1 = array('P.O. Number',
               'Ordered By',
               'Ordered From',
               'Date',
               'Notes',
               'Status');

$header = array('Component',
               'Order Quantity',
               'Order Price',
               'Order Status',
               'Date Received',
               'Subtotal');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetY(35);
$pdf->BuildTable1($header1,$data1);
$pdf->SetY(55);
$pdf->BuildTable($header,$data);
$pdf->Ln(6);
$substring = " Total Subtotal: $".$subtotal." ";
$substrwidth = $pdf->GetStringWidth($substring);
$substrX = 260 - $substrwidth;
$pdf->SetX($substrX);
$pdf->Cell($substrwidth,6,$substring,1,1,'C');
$tax = $subtotal * .075;
$tax = round($tax,2);
$tax = number_format((float)$tax, 2, '.', '');
$taxstring = " Tax (7.5%): $".$tax." ";
$taxstrwidth = $pdf->GetStringWidth($taxstring);
$taxstrX = 260 - $taxstrwidth;
$pdf->SetX($taxstrX);
$pdf->Cell($taxstrwidth,6,$taxstring,1,1,'C');
$pdf->SetFont('','B',12);
$grandtotal = $tax + $subtotal;
$grandtotal = round($grandtotal,2);
$grandtotal = number_format((float)$grandtotal, 2, '.', '');
$grandtotalstring = " Grand Total: $".$grandtotal." ";
$grandtotstrwidth = $pdf->GetStringWidth($grandtotalstring);
$grandtotstrX = 260 - $grandtotstrwidth;
$pdf->SetX($grandtotstrX);
$pdf->Cell($grandtotstrwidth,6,$grandtotalstring,1,1,'C');
$pdf->Output();
$conn = null;
?>