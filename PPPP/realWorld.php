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


<body>
<div class="container">


  <?php
  $pageNum =2;
  include 'nav.php';
  $SESSION['started'] = "t";
  ?>

<h2> So we've seen the problem... </h2>
  But what does it mean?

  The Dining Philosphers Problem is an interesting representation of a concurrency problem in Operating Systems.
  There are many different guises of the problem, for example

<h2>Real Life Example&nbsp;</h2>

<p>ND has the best football program in the whole country. But during their first season in 1887, Notre Dame could not afford enough jerseys and helmets for each player.* There were 100 players on the team, but with only 50 helmets and jerseys available. Each player needs to put on a helmet and a jersey in order to play.</p>
<p><img alt="" src="NDFootball.jpg" style="width: 400px; height: 280px;"align="right" /></p>

<p>Why would it be bad:</p>

<ul>
<li>There could be only 50 people at most playing at the same time.</li>
<li>If someone played for a lot of time, then others would have limited playing time.</li>
<li>Anyone Could not enter the game without a helmet or jersey.</li>
<li>Deadlock happened if someone had only a helmet or a jersey.&nbsp;</li>
<li>Starvation happened when no more helmets or jerseys were available.</li>
</ul>

<p>Soultion:</p>
<ul>
<li>We can set up a rule that each player plays for a certain amount of time then gives his gear to another person; this rotation then repeats.&nbsp;</li>
<li>If a player only has a helmet, he needs to pass his helmet on to someone who only has a jersey to avoid deadlock.&nbsp;</li>
<li>Every ND player should play hard and respectfully.&nbsp;</li>
</ul>

* This scenario is not historically accurate

  <h2> But what does this mean for operating systems? </h2>

  In an operating systems situation we can think of the following:

  <ul>
    <li> Philosophers are processes</li>
    <li> Chopsticks are resources that the processes need, for example, certain files</li>
    <li> All processes need to run correctly</li>
 </ul>

These problems have parallels for operating systems.

 <ul>
    <li> Deadlock would mean nothing would run or processes would not complete </li>
    <li> Starvation would mean certain porcesses would never finish </li>
</ul>

Either of these conditions would result in the operating system failing to perform it's task.

So how do we solve it?

<div class="row">

<div class="row">
  <div class="col-md-10"></div>
  <div class="col-md-2">
    <a href = "identify.php"><button type="button" class="btn btn-lg btn-primary">Next</button></a>
  </div>
</div>

</div>
</body>
</html>
