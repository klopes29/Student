<?php
//echo "<pre>";
//print_r($_GET);
if(isset($_GET['last_id'])){
	$action="test9.php?last_id=".$_GET['last_id'];
} else{
	$action="test9.php";
}

?>
<!DOCTYPE html>
<html>

<head> <title>Home - RWITC</title>
<script src="script/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="main.css">
<script>
function validateForm()
{
    if( $('input[name="lawn"]:checked').length == 0 )
    {
        alert("Please select one Option");
        return false;
    }
    else
        return true;
}
</script>
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

<Form action="<?php echo $action; ?>" id="" Method="POST" onsubmit="return validateForm()">


9.	Lawns (in the First / Second Enclosure, (if used)
<br><br>
<input type="radio" name="lawn" value="Excellent"> Excellent <br>
<input type="radio" name="lawn" value="Good"> Good<br>
<input type="radio" name="lawn" value="Average"> Average<br>
<input type="radio" name="lawn" value="Below Average"> Below Average<br>
<input type="radio" name="lawn" value="Poor"> Poor<br>
<input type="radio" name="lawn" value="Not applicable"> Not applicable<br>


<p class="q"><b>NOTE :</b> Your  feedback will be kept as confidential.</p>

<input type="submit" value="NEXT >>" > </input> &nbsp;<button type="reset" value="Reset">Reset</button>
</Form>


</html>