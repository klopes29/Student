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

$name="";
if (isset($_POST['name'])) {
	$name	=$_POST['name'];
}

$date="";
if (isset($_POST['date'])) {
	$date	=$_POST['date'];
}

$sql = "UPDATE `oc_feedback` SET `function_name`='".$name."', `event_date`='".$date."' WHERE `feedback_id`='".$id."' " ;
//echo $sql;exit;
if(mysqli_query($conn,$sql)){
	//echo 'aaaaa';exit;
    echo "<script>alert('Records added successfully.')</script>";
} else{
	//echo 'bbbb';exit;
	//echo '<pre>';
	//print_r(mysqli_error($conn));
	//exit;
    //echo "<script>alert('ERROR: Could not able to execute $sql.')</script>" . mysqli_error($conn);
}

//$last_id= $conn->insert_id;  //echo($last_id);

$url="fb_3.php?last_id=".$id;
 header('Location: '.$url);
//echo "<pre>";
//print_r($_POST);

?>
