<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname="kevin";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);
} 

//echo "<script>alert('Connected successfully')</script>";

//insert data
$name	=$_POST['name'];
$address=$_POST['add'];
$rollno	=$_POST['rollno'];
$gender =$_POST['gender'];
$bday	=$_POST['bday'];

$sql = "INSERT INTO student (name, address, rollno, gender, bday)
VALUES ('".$name."','".$address."','".$rollno."','".$gender."','".$bday."')";

if(mysqli_query($conn,$sql)){
    echo "<script>alert('Records added successfully.')</script>";
} else{
    echo "<script>alert('ERROR: Could not able to execute $sql.')</script>" . mysqli_error($conn);
}



//echo "<pre>";
//print_r($_POST);

?>

<?php include 'select.php' ;?>