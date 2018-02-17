<?php
	
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
  class validation {
  public $firstName, $lastName, $contact, $email, $errorFirstName = '', $errorLastName = '', $errorContact = '',
					$errorEmail='';
  function __construct($fName, $lName, $contact, $email){
    $this->firstName = $fName;
    $this->lastName = $lName;
	$this->contact = $contact;
	$this->email = $email;
  }

  function check(){
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($this->firstName)){
        $this->errorFirstName = '* First name is required';
       } else {
        $this->errorFirstName = ' ';
       }
     
	 if(empty($this->lastName)){
         $this->errorLastName = 'Last name is required';
      }  else {
       $this->errorLastName = ' ';
      }
	  
	  if(empty($this->contact)){
         $this->errorContact = 'contact is required';
      }  else if(strlen($this->contact)<10){
		  $this->errorContact = 'Length is less than 10';
	  } else{
       $this->errorContact = ' ';
      }
	  
	  $this->email=test_input($this->email);
	  
	  if (empty($this->email)) {
		$this->errorEmail = 'Email is required';
	  } else {
		// check if e-mail address is well-formed
		if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
		  $this->errorEmail = 'Invalid email format'; 
		} else {
		  $this->errorEmail = ' ';
		}
	  }
	  
    }
   }
}
$errorF=" ";
$errorL=" ";
$errorC=" ";
$errorE=" ";
if($_SERVER["REQUEST_METHOD"] == "POST"){
 $obj = new validation($_POST['fname'], $_POST['lname'], $_POST['contact'], $_POST['email']);
 $obj->check();	
 $errorF = $obj->errorFirstName;
 $errorL = $obj->errorLastName;
 $errorC = $obj->errorContact;
 $errorE = $obj->errorEmail;
 
 
 
/*
include("pdfGenerator.php");
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->display_Name($obj->firstName,$obj->lastName);

$pdf->Output();
*/


/*

$myfile = fopen("data.csv", "a");
$txt = $obj->firstName.",".$obj->lastName."\n";
fwrite($myfile, $txt);

*/

 
 
}



	
	
	
	


?> 