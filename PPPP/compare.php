<?php
session_start();
?>
<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
var clicks = 0;

var pseudocode = [
	`function startDinnerParty(){<br>
&nbsp;&nbsp;//seat philosophers<br>
&nbsp;&nbsp;P1, P2, P3, P4, P5 = new philosopher<br>
&nbsp;&nbsp;startTimer()<br>	
&nbsp;&nbsp;waiter()<br>	
&nbsp;&nbsp;while(dinnerParty == 'going well'){<br>
&nbsp;&nbsp;&nbsp;&nbsp;if(totalSeconds == 30){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print('successful party!')<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;}<br>
}<br>
function philosopher(){<br>
&nbsp;&nbsp;hunger = 10<br>
&nbsp;&nbsp;chopsticks = false<br>
&nbsp;&nbsp;if(chopsticks == true){<br>
&nbsp;&nbsp;&nbsp;&nbsp;hunger = 10;<br>
&nbsp;&nbsp;}<br>
&nbsp;&nbsp;if(hunger == 0){<br>
&nbsp;&nbsp;&nbsp;&nbsp;dinnerParty = 'starved philosopher'<br>
&nbsp;&nbsp;&nbsp;&nbsp;print('party ruined')<br>
&nbsp;&nbsp;&nbsp;&nbsp;end<br>
&nbsp;&nbsp;}<br>
}<br>
function startTimer(){<br>
&nbsp;&nbsp;eachSecond{<br>
&nbsp;&nbsp;&nbsp;&nbsp;P1.hunger--;<br>
&nbsp;&nbsp;&nbsp;&nbsp;P2.hunger--;<br>
&nbsp;&nbsp;&nbsp;&nbsp;P3.hunger--;<br>
&nbsp;&nbsp;&nbsp;&nbsp;P4.hunger--;<br>
&nbsp;&nbsp;&nbsp;&nbsp;P5.hunger--;<br>
&nbsp;&nbsp;&nbsp;&nbsp;totalSeconds++;<br>
	}<br>
}<br>
//correct<br>
function waiter(){<br>
&nbsp;&nbsp;while(dinnerParty == 'going well'){}<br>
&nbsp;&nbsp;&nbsp;&nbsp;for i in ([P1, P2, P3, P4, P5]){<br>
&nbsp;&nbsp;&nbsp;&nbsp;serve(i)<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;}<br>
}<br>

function serve(i){<br>
&nbsp;&nbsp;//allow philosopher to eat<br>
&nbsp;&nbsp;i.chopsticks = true<br>
&nbsp;&nbsp;waitOneSecond()<br>
&nbsp;&nbsp;i.chopsticks = false<br>
}<br>

`, 
	`function startDinnerParty(){<br>
&nbsp;&nbsp;//seat philosophers<br>
&nbsp;&nbsp;P1, P2, P3, P4, P5 = new philosopher<br>
&nbsp;&nbsp;startTimer()<br>	
&nbsp;&nbsp;waiter()<br>	
&nbsp;&nbsp;while(dinnerParty == 'going well'){<br>
&nbsp;&nbsp;&nbsp;&nbsp;if(totalSeconds == 30){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print('successful party!')<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;end<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;}<br>
}<br>
function philosopher(){<br>
&nbsp;&nbsp;hunger = 10<br>
&nbsp;&nbsp;chopsticks = false<br>
&nbsp;&nbsp;if(chopsticks == true){<br>
&nbsp;&nbsp;&nbsp;&nbsp;hunger = 10;<br>
&nbsp;&nbsp;}<br>
&nbsp;&nbsp;if(hunger == 0){<br>
&nbsp;&nbsp;&nbsp;&nbsp;dinnerParty = 'starved philosopher'<br>
&nbsp;&nbsp;&nbsp;&nbsp;print('party ruined')<br>
&nbsp;&nbsp;&nbsp;&nbsp;end<br>
&nbsp;&nbsp;}<br>
}<br>
function startTimer(){<br>
&nbsp;&nbsp;eachSecond{<br>
&nbsp;&nbsp;&nbsp;&nbsp;P1.hunger--;<br>
&nbsp;&nbsp;&nbsp;&nbsp;P2.hunger--;<br>
&nbsp;&nbsp;&nbsp;&nbsp;P3.hunger--;<br>
&nbsp;&nbsp;&nbsp;&nbsp;P4.hunger--;<br>
&nbsp;&nbsp;&nbsp;&nbsp;P5.hunger--;<br>
&nbsp;&nbsp;&nbsp;&nbsp;totalSeconds++;<br>
	}<br>
}<br>

//incorrect
function waiter(){<br>
&nbsp;&nbsp;	while(dinnerParty == 'going well'){}<br>
&nbsp;&nbsp;&nbsp;&nbsp;		for i in ([P1, P2, P3, P4, P5]){<br>
&nbsp;&nbsp;&nbsp;&nbsp;			if(P1.hunger < 9){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				serve(P1)<br>
&nbsp;&nbsp;&nbsp;&nbsp;			}<br>
&nbsp;&nbsp;&nbsp;&nbsp;			if(P2.hunger < 9){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				serve(P2)<br>
&nbsp;&nbsp;&nbsp;&nbsp;			}<br>
&nbsp;&nbsp;&nbsp;&nbsp;			if(P3.hunger < 9){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				serve(P3)<br>
&nbsp;&nbsp;&nbsp;&nbsp;			}<br>
&nbsp;&nbsp;&nbsp;&nbsp;			if(P4.hunger < 9){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				serve(P4)<br>
&nbsp;&nbsp;&nbsp;&nbsp;			}<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			serve(i)<br>
&nbsp;&nbsp;&nbsp;&nbsp;		}<br>
&nbsp;&nbsp;	}<br>
}

function serve(i){<br>
&nbsp;&nbsp;//allow philosopher to eat<br>
&nbsp;&nbsp;i.chopsticks = true<br>
&nbsp;&nbsp;waitOneSecond()<br>
&nbsp;&nbsp;i.chopsticks = false<br>
}<br>`
		];

var answers = ["Right", "Wrong"];



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
	document.getElementById("pseudobox1").innerHTML=pseudocode[count];
	document.getElementById("pseudobox2").innerHTML=pseudocode[count + 1];
	document.getElementById("answer1").innerHTML=answers[(count* 2)];
	document.getElementById("answer2").innerHTML=answers[(count * 2) + 1];
	document.getElementById('answer1').setAttribute("style", "display: none");
	document.getElementById('answer2').setAttribute("style", "display: none");
	return 0;
}
</script>
<style>
div[class="outline"] {border:3px solid #000000}
p[class="border"] {border:1px solid #000000}
</style>
<body>
<div class="container">


  <?
	$pageNum=7;
  include 'nav.php';
  $SESSION['started'] = "t";
  ?>

	<script>

	function clickUp() {
		if(clicks < 1) {
			changeText(clicks);
			clicks++;
		}
		else {
			var next = document.getElementById('next_button');
			next.setAttribute("href", "thankyou.php?PID=<?=$PID?>");
		}
		return 0;
	}

	</script>

<div>
<table>
<tr>
<td>
<div class="outline">
<p id="pseudobox1">
Function main{<br>
&nbsp;&nbsp;numberSticks();<br>
&nbsp;&nbsp;Host philosophers;<br>
&nbsp;&nbsp;while(philosophers dine){<br>
&nbsp;&nbsp;&nbsp;&nbsp;If(stick request given){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;giveSticksInOrder();<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;runTimer(5);<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;}<br>
}<br>
Function philosopher{<br>
&nbsp;&nbsp;MAX = 10;<br>
&nbsp;&nbsp;Full = False;<br>
&nbsp;&nbsp;Hunger = 1;<br>
&nbsp;&nbsp;hasSticks = False;<br>
&nbsp;&nbsp;while(full == False){<br>
&nbsp;&nbsp;&nbsp;&nbsp;if(hunger == MAX){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Return “starved”;<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;if(hasSticks == True){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;while(timer > 0 AND full == False){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// eat<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hunger--;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(hunger == 0){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Full = True;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;}else{<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hunger++;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;requestSticksInOrder();<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;}<br>
&nbsp;&nbsp;while(doneThinking == False){<br>
&nbsp;&nbsp;&nbsp;&nbsp;think(randomTime);<br>
&nbsp;&nbsp;}<br>
&nbsp;&nbsp;Return “success”;<br>
}<br>
</p>
</div>
</td>

<td>
<div class="outline">
<p id="pseudobox2">
Function main{<br>
&nbsp;&nbsp;hostPhilosophers();<br>
&nbsp;&nbsp;while(philosophersReturned == False){<br>
&nbsp;&nbsp;&nbsp;&nbsp;If(sticksRequested == True){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;giveSticks();<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;}<br>
}<br>
Function philosopher{<br>
&nbsp;&nbsp;MAX = 10;<br>
&nbsp;&nbsp;Full = False;<br>
&nbsp;&nbsp;Hunger = 1;<br>
&nbsp;&nbsp;hasSticks = False;<br>
&nbsp;&nbsp;while(full == False){<br>
&nbsp;&nbsp;&nbsp;&nbsp;if(hunger == MAX){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Return “starved”;<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;if(hasSticks == True){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;while(full == False){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// eat<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hunger--;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(hunger == 0){<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Full = True;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;}else{<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hunger++;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;requestSticks();<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;}<br>
&nbsp;&nbsp;while(doneThinking == False){<br>
&nbsp;&nbsp;&nbsp;&nbsp;think(randomTime);<br>
&nbsp;&nbsp;}<br>
&nbsp;&nbsp;Return “success”;<br>
}
</p>
</div>
</td>
</tr>
<tr>
<td>
<div>
<button type="button" class="btn btn-lg btn-primary" onclick="showAnswer(1)">Code 1</button>
<p id="answer1" class="border" style="display: none">
Right
</p>
</div>
</td>
<td>
<div>
<button type="button" class="btn btn-lg btn-primary" onclick="showAnswer(2)">Code 2</button>
<p id="answer2" class="border" style="display: none">
Wrong
</p>
</div>
</td>
</tr>
</table>
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
>>>>>>> 310bd78a2dd91f2f7422cd76e46498a2385f6e58
