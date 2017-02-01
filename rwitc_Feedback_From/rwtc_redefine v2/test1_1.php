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

$sql = "INSERT INTO oc_feedback (cust_name,email,phone,address)
VALUES ('".$cust_name."','".$email."','".$phone."','".$address."')";

if(mysqli_query($conn,$sql)){
    echo "<script>alert('Records added successfully.')</script>";
} else{
    echo "<script>alert('ERROR: Could not able to execute $sql.')</script>" . mysqli_error($conn);
}

$last_id= $conn->insert_id;  //echo($last_id);

$url="fb_1.php?last_id=".$last_id."&code=".$_GET["code"];
 header('Location: '.$url);
?>
