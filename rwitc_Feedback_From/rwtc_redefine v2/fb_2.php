
<!-- Check if Authorise  -->
<?php include 'check_au.php'; ?>
<?php
//echo "<pre>";
//print_r($_GET);exit;
if(isset($_GET['last_id'])){
	$action="test2.php?last_id=".$_GET['last_id']."&code=".$code;
} else{
	$action="test2.php";
}

?>
<!DOCTYPE html>
<html>

<head> <title>Home - RWITC</title>
 <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>

<article>
  <header align="center">
  	<img src="logo.jpeg" alt="logo" />
    <h1>ROYAL WESTERN INDIA TURF CLUB, LTD.</h1>
    <p>Race Course, Mahalakshmi, Mumbai – 400034.</p>
    <p>E-mail : secretary@rwitc.com, Website – <a href="http://www.rwitc.com">www.rwitc.com</a></p>
  </header>
  <script type="text/javascript"></script>

 
</article>

<h1 align="center"><u>Feedback Form</u><hr/></h1>

<p class="p" align="center">Thank you for organising your function / event at the Mumbai Race Course.We would request you to kindly spare few minutes to give your very valuable feedback which will go a long way in further improvements.<i>(Please tick “&#x2714;” the appropriate boxes).</i> </p>
<br/>

<Form action="<?php echo $action; ?>" id="" Method="POST">

2.	When was your function / event held ?
<br><br>
Function : <input type="text" name="name" placeholder="Function Name" required> </input>&nbsp;
Event Date:<input id="datefield" type="date" name="date"  required > </input>
<br>

<p class="q" ><b>NOTE :</b> Your  feedback will be kept as confidential.</p>

<input type="submit" value="NEXT >>" > </input> &nbsp;<button type="reset" value="Reset">Reset</button>
</Form>
<script>
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();
			 if(dd<10){
			        dd='0'+dd
			    } 
			    if(mm<10){
			        mm='0'+mm
			    } 

			today = yyyy+'-'+mm+'-'+dd;
			document.getElementById("datefield").setAttribute("max", today);

</script>
</body>

</html>