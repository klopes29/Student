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

if ($result->num_rows > 0) {
    echo "<table ><tr><th>Name</th><th>Address</th><th>Rollno</th><th>Gender</th><th>D.O.B</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["address"]."</td><td>".$row["rollno"]."</td><td>".$row["gender"]."</td><td>".$row["bday"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
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

<div id="image">
    <img src="logo.jpeg" alt="..." />
</div>

</body>
</html>
<?php

mysqli_close($conn);
?>