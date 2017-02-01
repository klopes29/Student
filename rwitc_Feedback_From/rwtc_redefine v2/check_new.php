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
//echo $_GET['code']; exit;


$code="";
if (isset($_GET['code'])) {

  $code =$_GET['code'];
  $sql ="Select `url` from `oc_url` where `url`='".$code."' " ;
  $result = $conn->query($sql);
  
        // echo $sql; 

  	if ($result->num_rows > 0) {
  		// output data of each row
        
      $sql1 = "Select `code` from `oc_feedback` where `code`='".$code."'  ";
         //echo $sql1;
         $compare = $conn->query($sql1);

        //echo $compare->num_rows; 


        if($compare->num_rows > 0){

         echo "Link has Expired";

          exit;

        }else{

          $sql2 = "INSERT INTO  `oc_feedback` SET `code`= '".$code."' ";
          $result = $conn->query($sql2);
        //echo $sql;
        //echo $code; //exit;
        }

$last_id= $conn->insert_id;  
//echo $last_id;//exit;
   		 
	} else {
    	echo " YOU ARE NOT AUTHORIZE !!!";
      exit;
	}
}
else{

  echo " YOU ARE NOT AUTHORIZE !!!";
  exit;

}
?>