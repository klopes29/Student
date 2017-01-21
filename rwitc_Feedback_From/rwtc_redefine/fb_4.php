<!-- Check if Authorise  -->
<?php include 'check_au.php'; ?>
<?php
//echo "<pre>";
//print_r($_GET);
if(isset($_GET['last_id'])){
	$action="test4.php?last_id=".$_GET['last_id']."&code=".$code;
} else{
	$action="test4.php";
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
    if( $('input[name="venuereason"]:checked').length == 0 )
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


4.	You chose this venue because of
<br><br>
<input type="radio" name="venuereason" value="Brand Image"> Brand Image <br>
<input type="radio" name="venuereason" value="Value for money"> Value for money<br>
<input type="radio" name="venuereason" value="Location / Proximity"> Location / Proximity<br>
<input type="radio" name="venuereason" value="Infrastructure / Facilities / Ambience"> Infrastructure / Facilities / Ambience<br>
<input type="radio" name="venuereason" value="Recommendations"> Recommendations<br>
<input type="radio" name="venuereason" value="Others"> Other – Please Specify<br>
<textarea style="display:none;"  name="venuereason_txtarea" id="venuereason_txtarea"></textarea>
<br>
<script type="text/javascript">
 $("input[type='radio']").change(function(){
   
if($(this).val()=="Others")
{
    $("#venuereason_txtarea").show();
}
else
{
       $("#venuereason_txtarea").hide(); 
}
    
});
</script>
<p class="q"><b>NOTE :</b> Your  feedback will be kept as confidential.</p>

<input type="submit" value="NEXT >>" > </input> &nbsp;<button type="reset" value="Reset">Reset</button>
</Form>

</html>