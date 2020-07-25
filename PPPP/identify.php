<?php
session_start();
?>
<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
var clicks = 0;

var pseudocode = ["Fred recently moved to Indiana.  He has to register to vote and get his driver's license.  In order to register to vote, they need to see his Indiana driver's license as a photo ID.  In order to get his license, he needs to show his voter registration as proof of residence.  This is an example of:", 
				  "Power is out at an intersection.  As a result, one direction has a blinking yellow light (proceed with caution), the other direction is blinking red light (stop, then proceed if clear).  Cars proceed slowly but steadily through the blinking yellow.  Cars occasionally proceed through the blinking red when clear.  This is an example of:"];
	
var answers = ["<div class='border' style='background-color:#f45d01'><b>Incorrect.</b> The reasoning behind Fred's inability to register is not due to others registering. An example would be if Fred waited in line at the DMV to explain his predicament. However, teenagers keep cutting in line to fail their driving tests, so Fred never makes it to a representative.</div>", 
			   "<div class='border' style='background-color:#97cc04'><b>Correct!</b> Fred requires two separate resources to vote, but because obtaining either of these resources requires the other, Fred is left in a state of <b>Deadlock</b>.", 
			   "<div class='border' style='background-color:#f45d01'><b>Incorrect.</b> Fred is unable register to vote or get his driver's license because obtaining either of the two resources requires already owning one of them. This is an example of <b>Deadlock</b>.</div>", 
			   "<div class='border' style='background-color:#f45d01'><b>Incorrect.</b> All cars are still able to move through the intersection even if they are going slowly. An example of <b>Starvation</b> would be if one lane continuously has a green light while the other is stuck on red.  Cars can drive freely through the green while others wait indefinitely for their light to change from red to green.</div>", 
			   "<div class='border' style='background-color:#f45d01'><b>Incorrect.</b> All cars are still able to move through the intersection even if they are going slowly. An example of <b>Deadlock</b> would be if both lights are flashing red. Four student drivers pull up to the stoplights and are unsure of what to do. They each wait for the others to go through. Because no cars will move through until a different car has, no cars make it through the intersection.</div>", 
			   "<div class='border' style='background-color:#97cc04'><b>Correct!</b> While cars traveling through the yellow light are given a higher priority, some cars do make it through the flashing red light as they are able to pass when the coast is clear.</div>"];

function showAnswer(num) {
	var show;
	var hide1;
	var hide2;
	switch(num) {
		case 1:
			show = document.getElementById('answer1');
			show.setAttribute("style", "");
			hide1 = document.getElementById('answer2');
			hide1.setAttribute("style", "display: none");
			hide2 = document.getElementById('answer3');
			hide2.setAttribute("style", "display: none");
			break;
		case 2:
			show = document.getElementById('answer2');
			show.setAttribute("style", "");
			hide1 = document.getElementById('answer1');
			hide1.setAttribute("style", "display: none");
			hide2 = document.getElementById('answer3');
			hide2.setAttribute("style", "display: none");
			break;
		case 3:
			show = document.getElementById('answer3');
			show.setAttribute("style", "");
			hide1 = document.getElementById('answer1');
			hide1.setAttribute("style", "display: none");
			hide2 = document.getElementById('answer2');
			hide2.setAttribute("style", "display: none");
			break;
		default:
			break;
	}
	return 0;
}

function changeText(count) {
	document.getElementById("pseudobox").innerHTML=pseudocode[count];
	document.getElementById("answer1").innerHTML=answers[(count* 3)];
	document.getElementById("answer2").innerHTML=answers[(count * 3) + 1];
	document.getElementById("answer3").innerHTML=answers[(count * 3) + 2];
	document.getElementById('answer1').setAttribute("style", "display: none");
	document.getElementById('answer2').setAttribute("style", "display: none");
	document.getElementById('answer3').setAttribute("style", "display: none");
	return 0;
}
</script>
<style>
div[class="outline"] {border:3px solid #000000}
div[class="border"] {border:1px solid #000000}
</style>
<body>
<div class="container">


  <?php
	$pageNum = 3;
  include 'nav.php';
  $SESSION['started'] = "t";
  ?>

<script>
function clickUp() {
	if(clicks < 2) {
		changeText(clicks);
		clicks++;
	}
	else {
		var next = document.getElementById('next_button');
		next.setAttribute("href", "interactiveExplanation.php");
	}
	return 0;
}

</script>


<h2> Identifying Deadlock and Starvation Activity </h2>

Below we present a few real life examples of potential deadlock and starvation. For each example, please select whether you think it is a case of deadlock, starvation, or neither.<br/><br/>

<div class="outline">
<p id="pseudobox">
In airport security there are two lines: one for TSA pre-check and one for all other passengers.  TSA pre-check passengers go through security first.  Every time a pre-check passenger is taken through security, another one arrives in the pre-check line.  The other passengers wait and never get to go through security.  This is an example of:
</p>
</div>

<div>
<button type="button" class="btn btn-lg btn-primary" onclick="showAnswer(1)">Starvation</button>
<div id="answer1" class="border" style="display: none">
<div class='border' style="background-color:#97cc04">
<b>Correct!</b> Since pre-check passengers are always given priority and there is always at least one pre-check passenger in line, regular passengers are never given the opportunity to move through the line.
</div>
</div>				   
</div>

<div>
<button type="button" class="btn btn-lg btn-primary" onclick="showAnswer(2)">Deadlock</button>
<div id="answer2" class="border" style="display: none">
<div class='border' style="background-color:#f45d01">
<b>Incorrect.</b> Since pre-check passengers are always going through security, only one type of passenger is recieving service. An example of <b>Deadlock</b> in this case would be two unbelievably nice passengers, both a pre-check and regular. The pre-check sees a regular in line and offers for them to go first. Appreciative of the offer, the regular insists the pre-check go first, which the pre-check brushes off and again offers the regular go through security first. This back-and-forth exchange continues indefinitely.
</div>
</div>
</div>

<div>
<button type="button" class="btn btn-lg btn-primary" onclick="showAnswer(3)">Neither</button>
<div id="answer3" class="border" style="display: none">
<div class='border' style="background-color:#f45d01">
<b>Incorrect.</b> Because there is a constant stream of pre-check passengers, and since pre-check passengers are given priority, regular passengers are unable to move through security.
</div>
</div>
</div>

<div class="row">

<div class="row">
  <div class="col-md-10"></div>
  <div class="col-md-2">
    <a id="next_button" href = "#"><button type="button" class="btn btn-lg btn-primary" onclick="clickUp()">Next</button></a>
  </div>
</div>
</div>

</body>
</html>
