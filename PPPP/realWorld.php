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


  <?
  $pageNum =2;
  include 'nav.php';
  $SESSION['started'] = "t";
  ?>

<h2> So we've seen the problem... </h2>
  But what does it mean?

  The Dining Philosphers Problem is an interesting representation of a concurrency problem in Operating Systems.
  There are many different guises of the problem, for example

  <? include 'example.html' ?>

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
