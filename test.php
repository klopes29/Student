<!DOCTYPE html>
<html>

<head> <title>Sample Form</title>
 <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
<h1>Student Registration Form</h1>
<h3> Please enter Following Details</h3>

<Form action="test_1.php" id="stu" Method="POST">

Name: <br><input type="text" name="name" placeholder="First & Last" required> </input>
<br><br>
Address:<br><textarea form="stu" placeholder="Address" required name="add"></textarea>
</body>
<br><br>

Roll No:<br> <input type="number" name="rollno" min="1" placeholder="ONLY Numbers" required>
</input>
<br><br>

Gender:<br> <select name="gender">
  <option value="M">Male</option>
  <option value="F">Female</option>
  </select>
<br><br>

Date OF Birth:<br>
<input type="date" name="bday" max="2015-05-31" required ></input>
<br><br>

<input type="Submit"> </input>
</Form>
<br>

</html>