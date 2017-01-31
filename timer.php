<!DOCTYPE html>
<html>

<head><title>Sample Form </title>


</head>

<body>
<script type="text/javascript"></script>
<script src="script/jquery-3.1.1.min.js"></script>
<script >
	function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  console.log(id);
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days + "<B> : </B>";
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2) + "<B> : </B>";
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2) + "<B> : </B>";
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

$( document ).ready(function() {
    console.log( "ready!" );
	var deadline = new Date(Date.parse(new Date()) + 12 * 24 * 60 * 60 * 1000);
	initializeClock('clockdiv', deadline);
});

</script>

<div id="clockdiv">
  <p><b>Starts in</b></p>
  <div>
    <span class="days"></span>
    <div class="smalltext"><b>DAYS</b></div>
  </div>
  <div>
    <span class="hours"></span>
    <div class="smalltext"><b>HOURS</b></div>
  </div>
  <div>
    <span class="minutes"></span>
    <div class="smalltext"><b>MIN</b></div>
  </div>
  <div>
    <span class="seconds"></span>
    <div class="smalltext"><b>SEC</b></div>
  </div>
</div>
<style type="text/css">

	#clockdiv {
  font-family: "Arial Black", Gadget, sans-serif;
  text-align: right;
  font-size: 13px;
  margin-right: 110px;
}

p {
  margin-top: 5px;
  margin-bottom:1px;
  margin-right: 110px;
}

#clockdiv > div {
  padding: 5px;
  display: inline-block;
}

#clockdiv div > span {
  display: inline-block;
}

.smalltext {
  font-size: 10px;
}

</style>
</body>
</html>