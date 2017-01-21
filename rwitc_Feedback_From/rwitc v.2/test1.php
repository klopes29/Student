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

$sql = "INSERT INTO oc_feedback (function_held)
VALUES ('".$nevent."')";

if(mysqli_query($conn,$sql)){
    echo "<script>alert('Records added successfully.')</script>";
} else{
    echo "<script>alert('ERROR: Could not able to execute $sql.')</script>" . mysqli_error($conn);
}

$last_id= $conn->insert_id;  //echo($last_id);

$url="fb_2.php?last_id=".$last_id."&code=".$_GET["code"];
 header('Location: '.$url);

?>
