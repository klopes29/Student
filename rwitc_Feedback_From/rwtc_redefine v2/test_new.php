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

$last_id=0;
if(isset($_GET['last_id'])){
	$last_id=$_GET['last_id'];
} 


$venue ="";
if(isset($_POST['venue'])){
	$venue  =$_POST['venue'];
		if($venue=="Others"){
		$venue=$_POST["venue_txtarea"];
	}	
}

//$sql = "INSERT INTO oc_feedback (about_venue)
//VALUES ('".$venue."')";

$sql = "UPDATE `oc_feedback` SET `about_venue`='".$venue."' WHERE `feedback_id`='".$last_id."' ";
//echo $sql;//exit;

if(mysqli_query($conn,$sql)){
    echo 'Records added successfully.';
} else{
	//echo 'bbbb';exit;
	//echo '<pre>';
	//print_r(mysqli_error($conn));
	//exit;
    echo "<script>alert('ERROR: Could not able to execute $sql.')</script>" . mysqli_error($conn);
}


//$last_id= $conn->insert_id;  
//echo($last_id);exit;

$url="fb_4.php?last_id=".$last_id."&code=".$_GET["code"];
 header('Location: '.$url);
//echo "<pre>";
//print_r($_POST);

?>
