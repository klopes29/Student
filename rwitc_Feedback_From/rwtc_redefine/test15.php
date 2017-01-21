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
echo "<script>alert('Connected successfully')</script>";

//insert data

$id=0;
if(isset($_GET['last_id'])){
	$id=$_GET['last_id'];
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

$sql = "UPDATE `oc_feedback` SET `cust_name`='".$cust_name."',`email`='".$email."',`phone`='".$phone."',`address`='".$address."' WHERE `feedback_id`='".$id."' ";

if(mysqli_query($conn,$sql)){
    echo "<script>alert('Records added successfully.')</script>";
} else{
	//echo 'bbbb';exit;
	//echo '<pre>';
	//print_r(mysqli_error($conn));
	//exit;
    echo "<script>alert('ERROR: Could not able to execute $sql.')</script>" . mysqli_error($conn);
}


$url="fb_16.php?last_id=".$id."&code=".$_GET["code"];
 header('Location: '.$url);
//echo "<pre>";
//print_r($_POST);

?>
