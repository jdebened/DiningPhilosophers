<?php
session_start();
?>
<!DOCTYPE html>
<html>

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
  $pageNum = 0;
  include 'nav.php';
  ?>





<div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">What is Placating Plato?</h3>
            </div>
            <div class="panel-body">
              Placating Plato with Plates of Pasta is an online, interactive tutorial for the Dining Philosphers Problem. In the tutorial we will:
              <ul>
                <li> Explain the Problem </li>
                <li> Highlight where things can go wrong </li>
                <li> Show you some real world examples </li>
                <li> Show some potential solutions </li>
                <li> Let you practice those solutions </li>
              </ul>
            </div>
          </div>

 <!--        <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h3 class="panel-title">Do I need an account?</h3>
                      </div>
                      <div class="panel-body">
                        No, you can run through our tutorial without an account. Just click 'Get Started' to get underway.
                      </div>
                    </div>*/

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">How do I get started?</h3>
        </div>
        <div class="panel-body">
            It's easy, you just click 'Get Started' which is obvious, so you probably are not reading this.
        </div>
    </div>-->

      <div class="row">

        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <a href = "intro.php"><button type="button" class="btn btn-lg btn-primary">Get Started</button></a>
          </div>
        </div>

      </div>

</div>
</body>
</html>
