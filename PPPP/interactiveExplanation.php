<?php
session_start();
?>
<!DOCTYPE html>

<html>

<body onload="init();">

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://code.createjs.com/easeljs-0.8.2.min.js"></script>
  <script src="https://code.createjs.com/preloadjs-0.6.2.min.js"></script>
  <script src="https://code.createjs.com/tweenjs-0.6.2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>

<div class="container">

<?
$pageNum=4;
include 'nav.php';

?>

<h1> Interactive Explanation</h1>

<p>Having covered the basics, try out the following visualization.
</p>

<p>Click on a philosopher to change their state. As philosophers think, their health bar will begin to deplete until they are switched to an eating state. Be careful though, once a philosopher starves it'll be game over! Hint: Get a higher score by keeping all philosophers health bars as high as you can.
</p>

<center>

    <div style="position: relative;">
        <canvas id="canvas" width="701" height="650" style="border: 1px solid black;  background:url('assets/wall.jpg') "></canvas>
    </div>


</center>

      <div class="row">

        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <a href = "solutions.php"><button type="button" class="btn btn-lg btn-primary">Next</button></a>
          </div>
        </div>

</div>

<script>
        var start;
        var diag = [];
        var run = [];
        var stage;
        var p1, p1BarCommand, p2, p2BarCommand, p3, p3BarCommand, p4, p4BarCommand, p5, p5BarCommand;
        var c1, c1BarCommand, c2, c2BarCommand, c3, c3BarCommand, c4, c4BarCommand, c5, c5BarCommand;
        var score = 0;
        var scoreTotal;
        var queue = new createjs.LoadQueue();
        var speed = 20000;
        var scoreTimer;
        var ticker;
        var gameOverFlag = 0;
        var retry = 0;

        function init() {
            stage = new createjs.Stage("canvas");
            //Loading
            loadingText = new createjs.Text("Loading...", "50px Arial", "white");
            loadingText.x = 250; loadingText.y = 250;
            stage.addChild(loadingText);
            stage.update();
            queue.on("complete", handleComplete, this);
            queue.loadManifest([
                { id: "oneThinking", src: "assets/oneThinking.png" },
                { id: "oneEating", src: "assets/oneEating.png" },
                { id: "oneThinkOverlay", src: "assets/oneThinkOverlay.png" },
                { id: "oneEatOverlay", src: "assets/oneEatOverlay.png" },
                { id: "oneNoChopsticks", src: "assets/oneNoChopsticks.png" },
                { id: "oneStarving", src: "assets/oneStarving.png" },
                { id: "oneStarved", src: "assets/oneStarved.png" },
                { id: "twoThinking", src: "assets/twoThinking.png" },
                { id: "twoEating", src: "assets/twoEating.png" },
                { id: "twoThinkOverlay", src: "assets/twoThinkOverlay.png" },
                { id: "twoEatOverlay", src: "assets/twoEatOverlay.png" },
                { id: "twoNoChopsticks", src: "assets/twoNoChopsticks.png" },
                { id: "twoStarving", src: "assets/twoStarving.png"},
                { id: "twoStarved", src: "assets/twoStarved.png" },
                { id: "threeThinking", src: "assets/threeThinking.png" },
                { id: "threeEating", src: "assets/threeEating.png" },
                { id: "threeThinkOverlay", src: "assets/threeThinkOverlay.png" },
                { id: "threeEatOverlay", src: "assets/threeEatOverlay.png" },
                { id: "threeNoChopsticks", src: "assets/threeNoChopsticks.png" },
                { id: "threeStarving", src: "assets/threeStarving.png" },
                { id: "threeStarved", src: "assets/threeStarved.png" },
                { id: "fourThinking", src: "assets/fourThinking.png" },
                { id: "fourEating", src: "assets/fourEating.png" },
                { id: "fourThinkOverlay", src: "assets/fourThinkOverlay.png" },
                { id: "fourEatOverlay", src: "assets/fourEatOverlay.png" },
                { id: "fourNoChopsticks", src: "assets/fourNoChopsticks.png" },
                { id: "fourStarving", src: "assets/fourStarving.png" },
                { id: "fourStarved", src: "assets/fourStarved.png" },
                { id: "fiveThinking", src: "assets/fiveThinking.png" },
                { id: "fiveEating", src: "assets/fiveEating.png" },
                { id: "fiveThinkOverlay", src: "assets/fiveThinkOverlay.png" },
                { id: "fiveEatOverlay", src: "assets/fiveEatOverlay.png" },
                { id: "fiveNoChopsticks", src: "assets/fiveNoChopsticks.png" },
                { id: "fiveStarving", src: "assets/fiveStarving.png" },
                { id: "fiveStarved", src: "assets/fiveStarved.png" },
                { id: "retry", src: "assets/retry.png" },
                { id: "start", src: "assets/start.png" }
            ]);
        }

        function handleComplete() {
            if (retry == 0) {
                stage.removeChild(loadingText);
                //stage = new createjs.Stage("canvas");
                stage.enableMouseOver(20);

                //set the table
                table = new createjs.Shape();
                table.graphics.setStrokeStyle(1);
                table.graphics.beginStroke("black");
                table.graphics.beginFill("#5D1000 ");
                table.graphics.drawCircle(350, 325, 175);
                stage.addChild(table);

                plate1 = new createjs.Shape();
                plate1.graphics.setStrokeStyle(1);
                plate1.graphics.beginStroke("black");
                plate1.graphics.beginFill("white");
                plate1.graphics.drawCircle(230, 290, 40);
                stage.addChild(plate1);

                plate2 = new createjs.Shape();
                plate2.graphics.setStrokeStyle(1);
                plate2.graphics.beginStroke("black");
                plate2.graphics.beginFill("white");
                plate2.graphics.drawCircle(470, 290, 40);
                stage.addChild(plate2);

                plate3 = new createjs.Shape();
                plate3.graphics.setStrokeStyle(1);
                plate3.graphics.beginStroke("black");
                plate3.graphics.beginFill("white");
                plate3.graphics.drawCircle(350, 200, 40);
                stage.addChild(plate3);

                plate4 = new createjs.Shape();
                plate4.graphics.setStrokeStyle(1);
                plate4.graphics.beginStroke("black");
                plate4.graphics.beginFill("white");
                plate4.graphics.drawCircle(280, 430, 40);
                stage.addChild(plate4);

                plate5 = new createjs.Shape();
                plate5.graphics.setStrokeStyle(1);
                plate5.graphics.beginStroke("black");
                plate5.graphics.beginFill("white");
                plate5.graphics.drawCircle(420, 430, 40);
                stage.addChild(plate5);
            }

            score = 0;
            speed = 20000;
            gameOverFlag = 0;

            c1 = new createjs.Shape();
            c1.graphics.beginFill('gold');
            c1BarCommand = c1.graphics.drawRect(0, 0, 75, 3).command;
            c1.x = 250; c1.y = 205;
            c1.rotation = 45;
            stage.addChild(c1);

            c2 = new createjs.Shape();
            c2.graphics.beginFill('gold');
            c2BarCommand = c2.graphics.drawRect(0, 0, 75, 3).command;
            c2.x = 450; c2.y = 205;
            c2.rotation = 135;
            stage.addChild(c2);

            c3 = new createjs.Shape();
            c3.graphics.beginFill('gold');
            c3BarCommand = c3.graphics.drawRect(0, 0, 75, 3).command;
            c3.x = 420; c3.y = 350;
            c3.rotation = 15;
            stage.addChild(c3);

            c4 = new createjs.Shape();
            c4.graphics.beginFill('gold');
            c4BarCommand = c4.graphics.drawRect(0, 0, 75, 3).command;
            c4.x = 354; c4.y = 405;
            c4.rotation = 90;
            stage.addChild(c4);

            c5 = new createjs.Shape();
            c5.graphics.beginFill('gold');
            c5BarCommand = c5.graphics.drawRect(0, 0, 75, 3).command;
            c5.x = 280; c5.y = 350;
            c5.rotation = 160;
            stage.addChild(c5);

            //P1
            p1Bar = new createjs.Shape();
            p1Bar.graphics.beginFill('black');
            stage.addChild(p1Bar);
            p1BarCommand = p1Bar.graphics.drawRect(10, 200, 10, 130).command;
            p1 = new createjs.Shape()
            p1.num = 1; p1.state = 0; p1.starving = false;
            p1.graphics.beginBitmapFill(queue.getResult("oneThinking")).drawRect(0, 0, 130, 130)
            p1.x = 30; p1.y = 200;
            p1.name = "p1";
            p1.addEventListener("mouseover", function () { rollOver(p1, queue.getResult("oneEatOverlay"), queue.getResult("oneThinkOverlay")) });
            p1.addEventListener("mouseout", function () { rollOut(p1, p1BarCommand, queue.getResult("oneEating"), queue.getResult("oneThinking"), queue.getResult("oneStarving")) });
            p1.addEventListener("click", function () { onClick(p1, p1BarCommand, 200, 330, c1BarCommand, 50, 10, c5BarCommand, 65, -20, p2, p5, queue.getResult("oneNoChopsticks")) });
            stage.addChild(p1);

            //P2
            p2Bar = new createjs.Shape();
            p2Bar.graphics.beginFill('black');
            stage.addChild(p2Bar);
            p2BarCommand = p2Bar.graphics.drawRect(265, 10, 10, 130).command;
            p2 = new createjs.Shape()
            p2.num = 2; p2.state = 0; p2.starving = false;
            p2.graphics.beginBitmapFill(queue.getResult("twoThinking")).drawRect(0, 0, 130, 130)
            p2.x = 285; p2.y = 10;
            p2.name = "p2";
            p2.addEventListener("mouseover", function () { rollOver(p2, queue.getResult("twoEatOverlay"), queue.getResult("twoThinkOverlay")) });
            p2.addEventListener("mouseout", function () { rollOut(p2, p2BarCommand, queue.getResult("twoEating"), queue.getResult("twoThinking"), queue.getResult("twoStarving")) });
            p2.addEventListener("click", function () { onClick(p2, p2BarCommand, 10, 140, c1BarCommand, -55, 35, c2BarCommand, 55, 35, p3, p1, queue.getResult("twoNoChopsticks")) });
            stage.addChild(p2);

            //P3
            p3Bar = new createjs.Shape();
            p3Bar.graphics.beginFill('black');
            stage.addChild(p3Bar);
            p3BarCommand = p3Bar.graphics.drawRect(680, 200, 10, 130).command;
            p3 = new createjs.Shape()
            p3.num = 3; p3.state = 0; p3.starving = false;
            p3.graphics.beginBitmapFill(queue.getResult("threeThinking")).drawRect(0, 0, 130, 130)
            p3.x = 540; p3.y = 200;
            p3.name = "p3";
            p3.addEventListener("mouseover", function () { rollOver(p3, queue.getResult("threeEatOverlay"), queue.getResult("threeThinkOverlay")) });
            p3.addEventListener("mouseout", function () { rollOut(p3, p3BarCommand, queue.getResult("threeEating"), queue.getResult("threeThinking"), queue.getResult("threeStarving")) });
            p3.addEventListener("click", function () { onClick(p3, p3BarCommand, 200, 330, c2BarCommand, -65, -5, c3BarCommand, -75, 10, p2, p4, queue.getResult("threeNoChopsticks")) });
            stage.addChild(p3);

            //P4
            p4Bar = new createjs.Shape();
            p4Bar.graphics.beginFill('black');
            stage.addChild(p4Bar);
            p4BarCommand = p4Bar.graphics.drawRect(585, 485, 10, 130).command;
            p4 = new createjs.Shape()
            p4.num = 4; p4.state = 0; p4.starving = false;
            p4.graphics.beginBitmapFill(queue.getResult("fourThinking")).drawRect(0, 0, 130, 130)
            p4.x = 445; p4.y = 485;
            p4.name = "p4";
            p4.addEventListener("mouseover", function () { rollOver(p4, queue.getResult("fourEatOverlay"), queue.getResult("fourThinkOverlay")) });
            p4.addEventListener("mouseout", function () { rollOut(p4, p4BarCommand, queue.getResult("fourEating"), queue.getResult("fourThinking"), queue.getResult("fourStarving")) });
            p4.addEventListener("click", function () { onClick(p4, p4BarCommand, 485, 615, c3BarCommand, 55, -10, c4BarCommand, -55, -20, p3, p5, queue.getResult("fourNoChopsticks")) });
            stage.addChild(p4);

            //P5
            p5Bar = new createjs.Shape();
            p5Bar.graphics.beginFill('black');
            stage.addChild(p5Bar);
            p5BarCommand = p5Bar.graphics.drawRect(100, 485, 10, 130).command;
            p5 = new createjs.Shape()
            p5.state = 0; p5.starving = false;
            p5.graphics.beginBitmapFill(queue.getResult("fiveThinking")).drawRect(0, 0, 130, 130)
            p5.num = 5; p5.x = 120; p5.y = 485;
            p5.name = "p5";
            p5.addEventListener("mouseover", function () { rollOver(p5, queue.getResult("fiveEatOverlay"), queue.getResult("fiveThinkOverlay")) });
            p5.addEventListener("mouseout", function () { rollOut(p5, p5BarCommand, queue.getResult("fiveEating"), queue.getResult("fiveThinking"), queue.getResult("fiveStarving")) });
            p5.addEventListener("click", function () { onClick(p5, p5BarCommand, 485, 615, c4BarCommand, 65, -20, c5BarCommand, -65, -5, p4, p1, queue.getResult("fiveNoChopsticks")) });
            stage.addChild(p5);

            //Score Text
            scoreText = new createjs.Text("Score: ", "35px Arial", "white");
            scoreText.x = 3; scoreText.y = 613;
            stage.addChild(scoreText);

            //Score Total
            scoreTotal = new createjs.Text("0", "35px Arial", "white");
            scoreTotal.x = 108; scoreTotal.y = 613;
            stage.addChild(scoreTotal);

            if (retry == 0) {
                startScreen = new createjs.Shape();
                startScreen.graphics.beginFill('black').drawRect(0, 0, 701, 660);
                startScreen.alpha = .6;
                startScreen.addEventListener("click", function () { startGame() });
                stage.addChild(startScreen);

                startButton = new createjs.Shape();
                startButton.graphics.beginBitmapFill(queue.getResult("start")).drawRect(0, 0, 236, 236);
                startButton.x = 230; startButton.y = 200;
                startButton.addEventListener("click", function () { startGame() });
                stage.addChild(startButton);
                stage.update();
            }
            else {
                stage.update();
                startGame();
            }
        }

        function startGame() {
            if (retry == 0) {
                start = new moment();
                retry = 1;
            }


            stage.removeChild(startScreen);
            stage.removeChild(startButton);
            ticker = setInterval(tick, 20);
            scoreTimer = setInterval(speedIncrease, 1000);
            createjs.Tween.get(p1BarCommand, { loop: false, paused: false }).to({ h: 0, y: 330 }, speed);
            createjs.Tween.get(p2BarCommand, { loop: false, paused: false }).to({ h: 0, y: 140 }, speed);
            createjs.Tween.get(p3BarCommand, { loop: false, paused: false }).to({ h: 0, y: 330 }, speed);
            createjs.Tween.get(p4BarCommand, { loop: false, paused: false }).to({ h: 0, y: 615 }, speed);
            createjs.Tween.get(p5BarCommand, { loop: false, paused: false }).to({ h: 0, y: 615 }, speed);
        }

        function onClick(p, pBarCommand, y1, y2, c1BarCommand, c1y, c1x, c2BarCommand, c2y, c2x, pL, pR, noChopsticksImg) {
            //change to eating
            if (p.state == 0 && pL.state == 0 && pR.state == 0) {
                p.state = 1;
                run.push([p.num, p.state])
                duration = speed/2 * ((130 - pBarCommand.h) / 130);
                //up
                createjs.Tween.get(pBarCommand, { loop: false, override: true }).to({ h: 130, y: y1 }, duration);
                createjs.Tween.get(c1BarCommand, { loop: false, paused: false }).to({ y: c1y, x: c1x }, 200);
                createjs.Tween.get(c2BarCommand, { loop: false, paused: false }).to({ y: c2y, x: c2x }, 200);
            }
            else if (pL.state == 1 || pR.state == 1) {
                run.push([p.num, 'X'])
                p.graphics.clear().beginBitmapFill(noChopsticksImg).drawRect(0, 0, 130, 130)
            }
            else {
                p.state = 0;
                run.push([p.num, p.state])
                duration = speed * (pBarCommand.h / 130);
                //down
                createjs.Tween.get(pBarCommand, { loop: false, override: true }).to({ h: 0, y: y2 }, duration);
                createjs.Tween.get(c1BarCommand, { loop: false, paused: false }).to({ y: 0, x: 0 }, 200);
                createjs.Tween.get(c2BarCommand, { loop: false, paused: false }).to({ y: 0, x: 0 }, 200);
            }
        }

        function rollOver(p, eatImg, thinkImg) {
            if (p.state == 0) {
                p.graphics.clear().beginBitmapFill(eatImg).drawRect(0, 0, 130, 130)
            }
            else {
                p.graphics.clear().beginBitmapFill(thinkImg).drawRect(0, 0, 130, 130)
            }
        }

        function rollOut(p, pBarCommand, eatImg, thinkImg, starvingImg) {
            if (pBarCommand.h < 40 && p.state == 0) {
                p.graphics.clear().beginBitmapFill(starvingImg).drawRect(0, 0, 130, 130);
            }
            else {
                if (p.state == 0) {
                    p.graphics.clear().beginBitmapFill(thinkImg).drawRect(0, 0, 130, 130)
                }
                else {
                    p.graphics.clear().beginBitmapFill(eatImg).drawRect(0, 0, 130, 130)
                }
            }
        }

        function speedIncrease() {
            speed = speed - 125;
            console.log(speed)
            score = parseInt(score) + parseInt(p1BarCommand.h / 10) + parseInt(p2BarCommand.h / 10) + parseInt(p3BarCommand.h / 10) + parseInt(p4BarCommand.h / 10) + parseInt(p5BarCommand.h / 10);
            scoreTotal.text = score;
        }

        function gameOver() {
            diag.push(run);
            run = [];

            clearInterval(scoreTimer);
            clearInterval(ticker);

            p1.removeAllEventListeners();
            p2.removeAllEventListeners();
            p3.removeAllEventListeners();
            p4.removeAllEventListeners();
            p5.removeAllEventListeners();

            p1 = null;
            p2 = null;
            p3 = null;
            p4 = null;
            p5 = null;

            endScreen = new createjs.Shape();
            endScreen.graphics.beginFill('black').drawRect(0, 0, 701, 660);
            endScreen.alpha = .8;
            stage.addChild(endScreen);

            endScoreText = new createjs.Text('Your Score:', "50px Arial", "white");
            endScoreText.x = 230; endScoreText.y = 200;
            stage.addChild(endScoreText);

            endTotal = new createjs.Text(score, "50px Arial", "white");
            endTotal.x = 325; endTotal.y = 260;
            stage.addChild(endTotal);

            retryButton = new createjs.Shape()
            retryButton.graphics.beginBitmapFill(queue.getResult("retry")).drawRect(0, 0, 287, 103)
            retryButton.x = 215; retryButton.y = 375;
            retryButton.addEventListener("click", function () { resetGame() });
            stage.addChild(retryButton);

            stage.update();
        }

        function resetGame() {
            stage.removeChild(endScreen);
            stage.removeChild(endScoreText);
            stage.removeChild(endTotal);
            stage.removeChild(retryButton);

            stage.removeChild(scoreText);
            stage.removeChild(scoreTotal);

            stage.removeChild(p1);
            stage.removeChild(p2);
            stage.removeChild(p3);
            stage.removeChild(p4);
            stage.removeChild(p5);

            stage.removeChild(p1Bar);
            stage.removeChild(p2Bar);
            stage.removeChild(p3Bar);
            stage.removeChild(p4Bar);
            stage.removeChild(p5Bar);

            stage.removeChild(c1);
            stage.removeChild(c2);
            stage.removeChild(c3);
            stage.removeChild(c4);
            stage.removeChild(c5);

            handleComplete();
        }

        function tick(event) {
            stage.update(event);
            checkStarving(p1, p1BarCommand, queue.getResult("oneThinking"), queue.getResult("oneEating"), queue.getResult("oneStarving"), queue.getResult("oneStarved"));
            checkStarving(p2, p2BarCommand, queue.getResult("twoThinking"), queue.getResult("twoEating"), queue.getResult("twoStarving"), queue.getResult("twoStarved"));
            checkStarving(p3, p3BarCommand, queue.getResult("threeThinking"), queue.getResult("threeEating"), queue.getResult("threeStarving"), queue.getResult("threeStarved"));
            checkStarving(p4, p4BarCommand, queue.getResult("fourThinking"), queue.getResult("fourEating"), queue.getResult("fourStarving"), queue.getResult("fourStarved"));
            checkStarving(p5, p5BarCommand, queue.getResult("fiveThinking"), queue.getResult("fiveEating"), queue.getResult("fiveStarving"), queue.getResult("fiveStarved"));
            if ((p1BarCommand.h == 0 || p2BarCommand.h == 0 || p3BarCommand.h == 0 || p4BarCommand.h == 0 || p5BarCommand.h == 0) && gameOverFlag == 0) {
                //flag to run gameOver() only once
                gameOverFlag = 1;
                gameOver();
            }
        }

        function checkStarving(p, pBarCommand, thinkingImg, eatingImg, starvingImg, starvedImg) {
            if (pBarCommand.h < 40 && p.starving == false) {
                p.graphics.beginBitmapFill(starvingImg).drawRect(0, 0, 130, 130)
                p.starving = true;
            }
            if (pBarCommand.h > 40 && p.starving == true) {
                p.starving = false;
                if (p.state == 0) {
                    p.graphics.beginBitmapFill(thinkingImg).drawRect(0, 0, 130, 130)
                }
                else {
                    p.graphics.beginBitmapFill(eatingImg).drawRect(0, 0, 130, 130)
                }
            }
            if (pBarCommand.h == 0) {
                p.graphics.beginBitmapFill(starvedImg).drawRect(0, 0, 130, 130)
            }
        }


        function moveOn() {
            var end = new moment();
            difference = moment.duration(moment(end).diff(moment(start)));
            length = pad(difference.hours()) + ':' + pad(difference.minutes()) + ':' + pad(difference.seconds());
            function pad(n) {
                return (n < 10) ? ("0" + n) : n;
            }
            console.log(length)
            console.log(diag)
        }
    </script>



</body>

</html>
