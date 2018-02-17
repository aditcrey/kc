<?php
$redir = false;
	
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
  class validation {
  public $firstName, $lastName, $contact, $email, $errorFirstName = ' ', $errorLastName = ' ', $errorContact = ' ',
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
       } else if(!preg_match("/^[a-zA-Z ]*$/",$this->firstName)){
        $this->errorFirstName = 'Only letters and white spaces allowed';
       }
     
	 if(empty($this->lastName)){
         $this->errorLastName = 'Last name is required';
      }  else if(!preg_match("/^[a-zA-Z ]*$/",$this->lastName)){
        $this->errorLastName = 'Only letters and white spaces allowed';
       }
	  
	  if(empty($this->contact)){
         $this->errorContact = 'contact is required';
      }  else if(strlen($this->contact)<10 || strlen($this->contact)>10){
		  $this->errorContact = 'Length should be equal to 10';
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
 
 
 
if($errorF==' ' && $errorL==' ' && $errorC==' ' && $errorE==' '){
	
	
include("pdfGenerator.php");
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->display_Name($obj->firstName,$obj->lastName);
$pdf->display_Contact($obj->email,$obj->contact);

$pdf->Output("registration.pdf","F");







$myfile = fopen("data2.xls", "a");
$txt = $obj->firstName.",".$obj->lastName.",".$obj->email.",".$obj->contact."\n";
fwrite($myfile, $txt);
$redir = true;

include "thankyou.php";








}







 
}




	
	
	
	


?> 


<html>
<title>

My Form
</title>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="formstyle.css" type="text/css" rel="stylesheet" media="screen">

</head>
<body>
<div class="container">

    <h1 class="well" align="center" >Aditya's Registration Form</h1>
	
	<div class="col-lg-12 well">
	<div class="row">
				<form action="index.php" method="post">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>First Name</label>
								<font color=red>*</font>
								<input type="text" name="fname" placeholder="Enter First Name Here.." class="form-control">
								<font color=red><?php echo $errorF ?></font>
							</div>
							<div class="col-sm-6 form-group">
								<label>Last Name</label>
								<font color=red>*</font>
								<!--<input type="text" name="lname" placeholder="Enter Last Name Here.." class="form-control">-->
								<input type = "text" class="form-control" name = "lname" placeholder = "Surname" 
		value="<?php 
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			echo $_POST['lname'];
		} else {
			
		}
		?>"/>
		<?php echo $errorL ?>
							</div>
						</div>	
<div class="form-group">
						<label>Email Id</label>
						<font color=red>*</font>
						<input type="text" name="email" placeholder="Enter Email Address Here.." class="form-control">
						<?php echo $errorE ?>
					</div>							
						<div class="form-group">
							<label>Address</label>
							<textarea placeholder="Enter Address Here.." rows="3" class="form-control"></textarea>
						</div>	
						<div class="row">

							<div class="col-sm-4 form-group">
							<label>City</label>
								<select class="form-control">
								  <option value="delhi">Delhi</option>
								  <option value="mumbai">Mumbai</option>
								  <option value="jaipur">Jaipur</option>
								  <option value="hyderabad">Hyderabad</option>
								</select>
							</div>	
							
							<div class="col-sm-4 form-group">
								<label>State</label>
								<input type="text" placeholder="Enter State Name Here.." class="form-control">
							</div>	
							<div class="col-sm-4 form-group">
								<label>Zip</label>
								<input type="tel" placeholder="Enter Zip Code Here.." class="form-control">
							</div>		
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>Title</label><br>
								<input type="checkbox" name="vehicle" value="Bike" >I have a bike<br>
<input type="checkbox" name="vehicle" value="Car" >I have a car<br>
							</div>		
							<div class="col-sm-6 form-group">
								<label>Date</label>	
								<input type="date" placeholder="Date" class="form-control">
							</div>	
						</div>						
					<div class="form-group">
						<label>Phone Number</label>
						<input type="tel" name="contact" placeholder="Enter Phone Number Here.." class="form-control">
						<?php echo $errorC ?>
					</div>		
					
					<div class="form-group">
						<label>Website</label>
						<input type="text" placeholder="Enter Website Name Here.." class="form-control">
					</div>
					<input type="submit" class="col-sm-12 btn btn-lg btn-info" ></input>
									
					</div>
				</form> 
				</div>
	</div>
	</div>
	</body>
	</html>