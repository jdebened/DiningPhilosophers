<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<!DOCTYPE html>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<div class="container">

<?php
$pageNum =5;
include 'nav.php';

?>


<div>
Now that we understand the Dining Philosophers Problem, we need to figure out a solution.
Our optimal solution will ensure that each philosopher has an equal time to eat and think.
Ideally, we would also want to maximize the amount of time each philosopher can spend on both tasks.
We also want to make sure no philosophers starve or wait too long to eat.
Please click on either button to learn more about the common solutions to the Dining Philosophers Problem.
</div>

<br>

<div>
The Dining Philosophers Problem has two common solutions:
<br>
<br>
<div class="row">
	<div class="col-md-4">
	<button id="rscHierarchy" type="button" onclick="showHierarchy(0)" class="btn btn-lg btn-primary">1. Resource Hierarchy</button><br>
</div>
	<div class="col-md-8">
<button id="arbitrator" type="button" onclick="showArbitrator(0)" class="btn btn-lg btn-primary">2. Arbitrator</button>
</div>
</div>
<div id="rscHierarchySol" style="display:none">
<p>
The resource hierarchy solution establishes an ordering to the chopsticks. Each chopstick is numbered (order does not matter). The philosophers will pick up the lower numbered chopstick adjacent to them then pick up the one numbered higher. Regardless of how you number the chopsticks, you are guaranteed to have at least two philosphers who will reach for the same chopstick. Thus, only one of those two philosophers will be able to get that chopstick and proceed to grab the second. For example, if we number the chopsticks in counter-clockwise order with five philosophers around the table, the fifth philosopher will find that the lower numbered chopstick is to their right while every other philosopher's lower numbered chopstick is to their left. When reaching for the chopsticks, in this case, two of the philosophers will reach for the same one. Obviously, only one philosopher can hold a chopstick at any given time.
</p>
<p>
Let us assume, keeping our example from before, that the philosopher 1 beats the philosopher 5 to their shared chopstick. This keeps philosopher 5 waiting until philosopher 1 is done eating. However, philosopher 1 must wait for philosopher 2 to finish eating because they have philosopher 1's higher numbered chopstick. The same is true with philosopher 2 waiting on philosopher 3 and philosopher 3 waiting on philosopher 4. Philosopher 4, however, is good to go. Since philosopher 5 is waiting on philosopher 1, they have not picked up their higher numbered chopstick which is shared with philosopher 4. Philosopher 4 claims this chopstick and is able to eat. Once they are finished, they will set down their chopsticks which allows philosopher 3 to eat and so on. The resource hierarchy method guarantees at least one philosopher is able to eat at any given time while the others wait.
</p>
<p>
If we wanted to make sure all philosophers have a fair shot at eating (maybe one is very hungry and will not stop eating for a few hours), we can place a time limit on each philosopher when they begin eating. This prevents the philosophers from encountering resource starvation.
</p>
<button id="rscUpdate" type="button" onclick="updateHierarchy()" class="btn btn-lg btn-primary">Next Animation Step</button>
</div>
<div id="arbitratorSol" style="display:none">
<p>
The arbitrator solution adds a new construct to the problem: a waiter. Instead of having a strict ordering to the chopsticks, we place a waiter in charge of ensuring only one philosopher has permission to eat at any given time. Our waiter will process each request to eat on a first-come-first-served basis. The waiter construct can be implemented as something called a mutex, meaning mutual exclusion. We ensure that only one philosopher can eat at a time by making the permission to eat a mutually exclusive resource. This by definition means that only one member of a group can access that resource at any given time. We might implement this as a lock meaning the first philosopher who asks for permission to eat is granted their request and claims the resource (permission to eat). Nobody else can obtain permission to eat until the currently eating philosopher finishes and gives it up. The waiter then gives permission to the next philosopher who requested permission to eat.
</p>
<p>
We can implement a timer scheme to ensure some degree of fair play. The waiter will give each philospher requesting permission a certain amount of time to eat before they must relinquish their permission and it is passed on to the next request. Essentially, the mutex lock they have on the permission to eat will time out and they must give up their lock. This constraint prevents the philosophers from encountering resource starvation.
</p>
<button id="arbUpdate" type="button" onclick="updateArbitrator()" class="btn btn-lg btn-primary">Next Animation Step</button>
</div>
<div style="position:relative; width:560px; height:504px;">
<canvas id="animation" style="z-index: 1; position:absolute; left:0px; top:0px;" height="504px" width="560px"></canvas>
<canvas id="num_layer" style="z-index: 1; position:absolute; left:0px; top:0px;" height="504px" width="560px"></canvas>
</div>
</div>
<script>
'use strict';
var arbCount = 0;
var rscCount = 0;
var check = 0;
var check2 = 0;

var rscImage = new Image();
rscImage.src = "code_block_assets/success_scaled.png";
var arbImage = new Image();
arbImage.src = "code_block_assets/arbitrator_layer_scaled.png";
var numbersImage = new Image();
numbersImage.src = "code_block_assets/number_layer_scaled.png";

function showHierarchy(frame) {
	var r = "rscHierarchySol";
	var a = "arbitratorSol";
	var canvas = document.getElementById('animation').getContext('2d');
	canvas.clearRect(0, 0, canvas.width, canvas.height);
	var canvas2 = document.getElementById('animation').getContext('2d');
	canvas2.clearRect(0, 0, canvas2.width, canvas2.height);
	document.getElementById(a).style.display = "none";
	document.getElementById(r).style.display = "inline";
	arbCount = 0;
	rscCount = 0;
	updateHierarchy();
	return 0;
}

function showArbitrator(frame) {
	var r = "rscHierarchySol";
	var a = "arbitratorSol";
	var canvas = document.getElementById('animation').getContext('2d');
	canvas.clearRect(0, 0, canvas.width, canvas.height);
	var canvas2 = document.getElementById('animation').getContext('2d');
	canvas2.clearRect(0, 0, canvas2.width, canvas2.height);
	document.getElementById(r).style.display = "none";
	document.getElementById(a).style.display = "inline";
	arbCount = 0;
	rscCount = 0;
	updateArbitrator();
	return 0;
}

function updateHierarchy() {
	var canvas = document.getElementById('num_layer');
	var canvas2 = document.getElementById('animation')
	var context = canvas2.getContext('2d');
	var num_context = canvas.getContext('2d');
	context.clearRect(0, 0, canvas2.width, canvas2.height);
	num_context.clearRect(0, 0, canvas.width, canvas.height);
	context.drawImage(rscImage, 560 * rscCount, 0, 560, 504, 0, 0, 560, 504);	
	num_context.drawImage(numbersImage, 0, 0);	
	if(rscCount < 6) {
		rscCount++;
	}
	else {
		rscCount = 0;
	}

	return 0;
}

function updateArbitrator() {
	var canvas = document.getElementById('num_layer');
	var canvas2 = document.getElementById('animation');
	var context = canvas2.getContext('2d');
	var num_context = canvas.getContext('2d');
	num_context.clearRect(0, 0, canvas.width, canvas.height);
	context.clearRect(0, 0, canvas2.width, canvas2.height);
	context.drawImage(arbImage, 560 * arbCount, 0, 560, 504, 0, 0, 560, 504);
	if(arbCount < 7) {
		arbCount++;
	}
	else {
		arbCount = 0;
	}

	return 0;
}
</script>

<div class="row">

<div class="row">
  <div class="col-md-10"></div>
  <div class="col-md-2">
    <a href = "code.php"><button type="button" class="btn btn-lg btn-primary">Next</button></a>
  </div>
</div>

</div>
</body>
</html>
