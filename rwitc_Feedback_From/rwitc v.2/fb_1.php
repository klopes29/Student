<!DOCTYPE html>
<html>

<head> <title>Home - RWITC</title>
<script src="script/jquery-3.1.1.min.js"></script>

 <link rel="stylesheet" type="text/css" href="main.css">

 <script type="text/javascript">
function validateForm()
{
    if( $('input[name="event[]"]:checked').length == 0 )
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

<h1 align="center"><u>Feedback Form</u><hr/></h1><br>

<p class="p" align="center">Thank you for organising your function / event at the Mumbai Race Course.We would request you to kindly spare few minutes to give your very valuable feedback which will go a long way in further improvements.<i>(Please tick “&#x2714;” the appropriate boxes).</i> </p>
<br/>

<Form action="test1.php" id="" Method="POST" onsubmit="return validateForm()">

1.	Where was your function / event held ?
<br><br>
<input type="checkbox" name="event[]" value="Members Pavillion" > Members Pavillion <br>
<input type="checkbox" name="event[]" value="First Enclosure Lawn" > First Enclosure Lawn<br>
<input type="checkbox" name="event[]" value="Second Enclosure Lawn" > Second Enclosure Lawn (Far Pavillion)
<br><br>

<p><b>NOTE :</b> Your  feedback will be kept as confidential.</p>

<input type="submit" value="NEXT >>" id="checkBtn" > </input> &nbsp;<button type="reset" value="Reset">Reset</button>
</Form>
<br>

</html>