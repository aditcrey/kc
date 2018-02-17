<?php

require("fpdf.php");

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
   
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(40);
    // Title
    $this->Cell(0,20,'Indian Institute of Technology(Indian School of Mines),Dhanbad',0,1,'C');

    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}



  function display_Name($first_name,$last_name){
    $this->SetFont('Times','B',12);
    $this->Cell(50,10,'Name:',1,0,'C');
    $this->SetFont('Times','',12);
    $this->Cell(0,10,$first_name." ".$last_name,1,1,'C');
  }
  
  function display_Contact($email,$contact){
	  $this->SetFont('Times','B',12);
    $this->Cell(50,10,'Email id:',1,0,'C');
	  $this->Cell(0,10,$email,1,1,'C');
	  $this->Cell(50,10,'Contact number: ',1,0,'C');
	  $this->Cell(0,10,$contact,1,1,'C');
	  
	  
	  
  }

}

?>