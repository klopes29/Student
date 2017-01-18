<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname="kevin";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//echo "Connected successfully to insert";

//Display Data
$sql ="Select * from student";
$result = $conn->query($sql);
?>
<html>
<head><title>table data</title></head>
<style>
body {
    background-color: lightblue;

}
p{
	text-align: center;
	font-size: 50px;
	font-family: TimesNewRoman;
	 color: white;
}
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
th{
	background-color: #4CAF50;
	color: white;
}
tr:hover{background-color:#f5f5f5}

</style>
<body>
<p>Student Database</p><br>
<table align="Center">
<tr>
<th>Name</th>
<th>Address</th>
<th>Rollno</th>
<th>Gender</th>
<th>Date Of Birth</th>
</tr>


<?php
//print_r($result->fetch_assoc());
while($row=$result->fetch_assoc()){

?>
<tr>
	<td><?php echo $row['name'] ;?></td>
	<td><?php echo $row['address'] ;?></td>
	<td><?php echo $row['rollno'] ;?></td>
	<td><?php echo $row['gender'] ;?></td>
	<td><?php echo $row['bday'] ;?></td>
</tr>
<?php

}
//echo 'result->fetch_assoc()';

?>
</table>
</body>
</html>
<?php

mysqli_close($conn);
?>