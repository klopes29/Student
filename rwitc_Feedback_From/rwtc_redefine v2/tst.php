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



$sql = "Select cust_name from oc_feedback WHERE `feedback_id`='".$id."' ";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "customer name " . $row["cust_name"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();



//$url="thank_u.php?last_id=".$id;
// header('Location: '.$url);
//echo "<pre>";
//print_r($_POST);

?>
