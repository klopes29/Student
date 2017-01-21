<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname="rwitc";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//Display Data

//cho $_GET['code']; //exit;
$code="";
if (isset($_GET['code'])) {

  $code =$_GET['code'];
  $sql ="Select `url` from `oc_url` where `url`='".$code."' " ;
  $result = $conn->query($sql);

  	if ($result->num_rows > 0) {
  		// output data of each row
   		 
	} else {
    	echo " YOU ARE NOT AUTHORISE !!!";exit;
	}
}
else{

  echo " YOU ARE NOT AUTHORISE !!!";
  exit;

}
?>