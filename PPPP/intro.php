<?php
session_start();
?>
<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="jquery-2.1.4.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<body>
<div class="container">


  <?
  $pageNum = 1;
  include 'nav.php';
  $SESSION['started'] = "t";
  ?>

<h1>Getting Started</h1>
<p>The Dining Philosophers Problem is a popular way of thinking about concurrency issues in computers.  Throughout this lesson you will learn how this problem is at work behind the scenes every time you use your computer.<br>
<br>
Suppose we have five philosophers sitting around a table.  Each philosopher has a plate of food in front of them.  Between each pair of philosophers is a single chopstick.  How do we get the philosophers to share the chopsticks without communicating and such that no philosopher starves?<br>
<br>
</p>

<h3> Main problems to avoid:</h3>
<p>
<br>
There are several problems that arise when we try to find a solution to the Dining Philosophers Problem.  One such problem is called <q>deadlock</q>.  This occurs when philosophers have claimed one chopstick each but there are no more chopsticks for any of them to claim.  Thus no philosopher is able to eat as all are waiting for a second chopstick.
<br>

</p>
<h2>Deadlock:<br>
</h2>

<div>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="800" height="600" id="DeadlockWithTitle">
		<param name="movie" value="DeadlockWithTitle.swf" />
		<param name="play" value="true" />
		<param name="loop" value="true" />
		<!--[if !IE]>-->
		<object type="application/x-shockwave-flash" data="DeadlockWithTitle.swf" width="800" height="600">
			<param name="play" value="true" />
			<param name="loop" value="true" />
		<!--<![endif]-->
			<a href="http://www.adobe.com/go/getflashplayer">
				<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
			</a>
		<!--[if !IE]>-->
		</object>
		<!--<![endif]-->
	</object>
</div>

<p>
<br>
Another major issue that arises in this problem is called <q>starvation</q>.  Starvation occurs when one philosopher never gets the chopsticks because they are claimed every time that philosopher attempts to claim one.
<br>
</p>
<h2>Starvation: </h2>

<div>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="800" height="600" id="StarvationWithTitle">
		<param name="movie" value="StarvationWithTitle.swf" />
		<param name="play" value="true" />
		<param name="loop" value="true" />
		<!--[if !IE]>-->
		<object type="application/x-shockwave-flash" data="StarvationWithTitle.swf" width="800" height="600">
			<param name="play" value="true" />
			<param name="loop" value="true" />
		<!--<![endif]-->
			<a href="http://www.adobe.com/go/getflashplayer">
				<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
			</a>
		<!--[if !IE]>-->
		</object>
		<!--<![endif]-->
	</object>
</div>

      <div class="row">

        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <a href = "realWorld.php"><button type="button" class="btn btn-lg btn-primary">Next</button></a>
          </div>
        </div>

</div>

</body>
</html>
