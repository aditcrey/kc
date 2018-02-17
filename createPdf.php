<?php


include("fpdf.php");
	
$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();


//$pdf->display_Name($obj->firstName,$obj->lastName);

$pdf->Output();


?>