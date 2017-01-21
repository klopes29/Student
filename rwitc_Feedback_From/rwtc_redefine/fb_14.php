<!-- Check if Authorise  -->
<?php include 'check_au.php'; ?>
<?php
//echo "<pre>";
//print_r($_GET);
if(isset($_GET['last_id'])){
	$action="test14.php?last_id=".$_GET['last_id']."&code=".$code;
} else{
	$action="test14.php";
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
 
</article>

<h1 align="center"><u>Feedback Form</u><hr/></h1>

<p class="p" align="center">Thank you for organising your function / event at the Mumbai Race Course.We would request you to kindly spare few minutes to give your very valuable feedback which will go a long way in further improvements.<i>(Please tick “&#x2714;” the appropriate boxes).</i> </p>
<br/>

<Form action="<?php echo $action; ?>" id="" Method="POST">


14.	Any other comments & suggestions 
<br><br>
<textarea  name="comments"></textarea>
<br>


<p class="q"><b>NOTE :</b> Your  feedback will be kept as confidential.</p>

<input type="submit" value="NEXT >>" > </input> &nbsp;<button type="reset" value="Reset">Reset</button>
</Form>


</html>