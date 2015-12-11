<?php
require('fpdf.php');
global $date;
class myPDF extends FPDF {
		//public $date = date("d/m/Y @ G:i");
		
        public $title = "Inventory Report";
        //Page header method
        function Header() {
        $this->SetFont('Arial','B',16);
        $w = $this->GetStringWidth($this->title)+205;
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

        function BuildTable($header,$data) {
        //Colors, line width and bold font
        $this->SetFillColor(255,255,255);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        //Header
        // make an array for the column widths
        $w=array(30,30,50,50,30,60);
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
	     	$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
	        $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
	        $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
	        $this->Cell($w[4],6,$row[4],'LR',0,'L',$fill);
	        $this->Cell($w[5],6,number_format($row[5]),'LR',0,'R',$fill);
	        $this->Ln();
	        $fill =! $fill;
        }
        $this->Cell(array_sum($w),0,'','T');
        }
}

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
            $data[] = array($result['ComponentReference'],
               	$result['ComponentValue'],
                $result['ComponentPartNumber'],
                $result['ComponentManufacturer'],
                $result['ComponentFootPrint'],
                $result['quantity']);
            }

date_default_timezone_set('America/Los_Angeles');
$pdf = new myPDF('L','mm','Letter');
$date = date("m/d/Y h:i A");
$pdf->date = $date;
$header = array('Reference',
               'Value',
               'Part Number',
               'Manufacturer',
               'Foot Print',
               'Quantity On Hand');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->BuildTable($header,$data);
$pdf->Output();
$conn = null;
?>