<? 
/* Date format:  
    Day of the month, 2 digits with leading zeros    01 to 31 
    then 
    Numeric representation of a month, with leading zeros    01 through 12 
    then 
    A full numeric representation of a year, 4 digits    Examples: 1999 or 2003 
    example: 01022005 First of Feb 2005 
*/ 

// These dates will display the link for a month, between 1 Jan 06 and 1 Feb 06 
$startdate = 01012006; 
$enddate = 01022006; 
$today = date(d,m,Y); 

if(($startdate < $today) && ($enddate > $today)){ 
    echo '<a href="link.htm">link<a>'; //The links to be displayed 
} 
?>