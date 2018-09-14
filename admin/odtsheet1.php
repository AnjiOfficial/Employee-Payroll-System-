<?php
session_start();
if($_SESSION['user']!='admin') {
    header('location:../checklogin/error.php');
}

header('Content-type: application/pdf');
 
header('Cache-Control: private, max-age=0, must-revalidate'); 
header('Pragma: public');



require_once('../library2/fpdf.php');

include '../dbfiles/config.php';
$pdf= new FPDF('l','mm','A4');
$pdf->addPage();
$pdf->SetFont('Arial','B',14);
$pdf->cell(20,10,"Sno.",1,0,'C');
$pdf->cell(40,10,"NAME",1,0,'C');
$pdf->cell(40,10,"DA",1,0,'C');
$pdf->cell(40,10,"HRA",1,0,'C');
$pdf->cell(40,10,"RATE/DAY",1,0,'C');
$pdf->cell(40,10,"WORKDAYS",1,0,'C');
$pdf->cell(40,10,"CALCULATED-SALARY",1,0,'C');
$pdf->cell(40,10,"CC",1,0,'C');
$pdf->Output('file.pdf','I');
?>