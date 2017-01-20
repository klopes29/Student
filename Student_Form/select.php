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


#image img {
/* the actual 'watermark' */
position: fixed;
align: center;
top: 30%; /* or whatever */
left: 30%; /* or whatever, position according to taste */
opacity: 0.3; /* Firefox, Chrome, Safari, Opera, IE >= 9 (preview) */
filter:alpha(opacity=50); /* for <= IE 8 */
width: 30%;
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
<div id="image">
    <img src="logo.jpeg" alt="..." />
</div>
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