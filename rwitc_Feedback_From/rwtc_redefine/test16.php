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


$pro ="";
if (isset($_POST['pro'])) {
	$pro  =$_POST['pro'];
}


$sql = "UPDATE `oc_feedback` SET `promotional`='".$pro."' WHERE `feedback_id`='".$id."' ";

if(mysqli_query($conn,$sql)){
    echo "<script>alert('Records added successfully.')</script>";
} else{
	//echo 'bbbb';exit;
	//echo '<pre>';
	//print_r(mysqli_error($conn));
	//exit;
    echo "<script>alert('ERROR: Could not able to execute $sql.')</script>" . mysqli_error($conn);
}


$url="thank_u.php?last_id=".$id."&code=".$_GET["code"];
 header('Location: '.$url);
//echo "<pre>";
//print_r($_POST);

?>
