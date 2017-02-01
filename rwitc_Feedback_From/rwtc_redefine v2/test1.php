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

//update data
//echo ($_GET['last_id']);
$id=0;
if(isset($_GET['last_id'])){
	$id=$_GET['last_id'];
} 
//echo($id);
$nevent="";
if (isset($_POST['event'])) {
	$event =$_POST['event'];
	$nevent=implode(",", $event);
}


$sql = "UPDATE `oc_feedback` SET `function_held`='".$nevent."' WHERE `feedback_id`='".$id."' " ;


if(mysqli_query($conn,$sql)){
    echo "<script>alert('Records added successfully.')</script>";
} else{
    echo "<script>alert('ERROR: Could not able to execute $sql.')</script>" . mysqli_error($conn);
}

$last_id= $conn->insert_id;  //echo($last_id);

$url="fb_2.php?last_id=".$id."&code=".$_GET["code"];
 header('Location: '.$url);

?>
