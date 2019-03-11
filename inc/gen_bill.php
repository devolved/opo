<?php
require_once('db.php');
require_once('../fpdf/fpdf.php');

// get data

$werdz = 'Would only do this in exchange for cash, not to prove a point ... templating for this is soooooo boring';









// make PDF
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Helvetica','B',16);
$pdf->Cell(40,10,$werdz);

$pdf->Output(f, '../bill.pdf', true);
?>