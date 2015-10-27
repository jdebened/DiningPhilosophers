<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<body>
<div class="container">


  <?
  include 'nav.php';
  $SESSION['started'] = "t";
  ?>

<h1>Introduction</h1>
<p>The Dining Philosophers Problem is a popular way of thinking about concurrency issues in computers.  Throughout this lesson you will learn how this problem is at work behind the scenes every time you use your computer.<br>
<br>
ALRIGHT!<br>
<br>
Suppose we have five philosophers sitting around a table.  Each philosopher has a plate of food in front of them.  Between each pair of philosophers is a single chopstick.  How do we get the philosophers to share the chopsticks without communicating and such that no philosopher starves?<br>
<br>
</p>

<p>INSERT PRETTY PICTURES HERE</p>

<p> Main problems to avoid:<br>
<br>
</p>
<h2>Deadlock:<br>
</h2>

<div>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="800" height="600" id="Deadlock">
		<param name="movie" value="Deadlock.swf" />
		<param name="play" value="true" />
		<param name="loop" value="true" />
		<!--[if !IE]>-->
		<object type="application/x-shockwave-flash" data="Deadlock.swf" width="800" height="600">
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

<p>  <br></p>
<h2>Starvation: </h2>

<div>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="800" height="600" id="Starvation">
		<param name="movie" value="Starvation.swf" />
		<param name="play" value="true" />
		<param name="loop" value="true" />
		<!--[if !IE]>-->
		<object type="application/x-shockwave-flash" data="Starvation.swf" width="800" height="600">
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

</div>

</body>
</html>
