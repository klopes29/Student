<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname="rwitc";//db Name in HP labtop 

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);
} 
//Connection OK 
//echo "<script>alert('Connected successfully')</script>";

//insert data
$nevent="";
if (isset($_POST['event'])) {
	$event =$_POST['event'];
	$nevent=implode(",", $event);
}

$name="";
if (isset($_POST['name'])) {
	$name	=$_POST['name'];
}

$date="";
if (isset($_POST['date'])) {
	$date	=$_POST['date'];
}

$venue ="";
if(isset($_POST['venue'])){
	$venue  =$_POST['venue'];
		if($venue=="Others"){
		$venue=$_POST["venue_txtarea"];
	}	
}

$venuereason="";
if(isset($_POST['venuereason'])){
	$venuereason  =$_POST['venuereason'];
	if($venuereason=="Others"){
		$venuereason=$_POST["venuereason_txtarea"];
	}	
}

$rate ="";
if(isset($_POST['rate'])){
	$rate  =$_POST['rate'];
		
}

$booking="";
if (isset($_POST['booking'])) {
	$booking  =$_POST['booking'];
}

$changeroom="";
if (isset($_POST['changeroom'])) {
	$changeroom  =$_POST['changeroom'];
}

$rstroom="";
if (isset($_POST['rstroom'])) {
	$rstroom  =$_POST['rstroom'];
}

$lawn ="";
if (isset($_POST['lawn'])) {
	$lawn  =$_POST['lawn'];
}

$clean="";
if (isset($_POST['clean'])) {
	$clean  =$_POST['clean'];
}

$bill="";
if (isset($_POST['bill'])) {
	$bill  =$_POST['bill'];
}

$exp ="";
if (isset($_POST['exp'])) {
	$exp  =$_POST['exp'];
}

$recommend="";
if (isset($_POST['recommend'])) {
	$recommend  =$_POST['recommend'];
}

$comments="";
if (isset($_POST['comments'])) {
	$comments  =$_POST['comments'];
}

$cust_name="";
if (isset($_POST['cust_name'])) {
	$cust_name  =$_POST['cust_name'];
}

$email ="";
if (isset($_POST['email'])) {
	$email  =$_POST['email'];
}

$phone="";
if (isset($_POST['phone'])) {
	$phone  =$_POST['phone'];
}

$address="";
if (isset($_POST['address'])) {
	$address  =$_POST['address'];
}

$pro ="";
if (isset($_POST['pro'])) {
	$pro  =$_POST['pro'];
}



$sql = "INSERT INTO oc_feedback (function_held,function_name,event_date,about_venue,choice_venue,staff_courtesy,booking_process,change_rooms,rest_rooms,lawns,cleanliness,billing_process,experience,recommend,comments,cust_name,email,phone,address,promotional)
VALUES ('".$nevent."','".$name."','".$date."','".$venue."','".$venuereason."','".$rate."','".$booking."','".$changeroom."','".$rstroom."','".$lawn."','".$clean."','".$bill."','".$exp."','".$recommend."','".$comments."','".$cust_name."','".$email."','".$phone."','".$address."','".$pro."')";

if(mysqli_query($conn,$sql)){
//    echo "<script>alert('Records added successfully.')</script>";
} else{
    echo "<script>alert('ERROR: Could not able to execute $sql.')</script>" . mysqli_error($conn);
}

//echo "<pre>";
//print_r($_POST);

?>
