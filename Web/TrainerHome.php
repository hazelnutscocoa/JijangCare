<?php
include("connection.php");
include("trainerMenu.php");
//if(!isset($_SESSION['username'])||(isset($_SESSION['username']) && $_SESSION['username'] == '')){
//    header("Location: Login.php"); exit;
//}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home</title>
<!--Bootstrap-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href ="Home.css" rel="stylesheet">
</head>

<body>
  
  <!--Include JQuery: necessary for Bootstrap plugins-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--Include bootstrap library as needed-->
  <script src="js/bootstrap.min.js"></script>

<br>
<!-- Welcome Message using jumbotron -->
<div class="container">
  <div class="jumbotron">
    <h1><?php include ("welcome.php"); ?></h1>      
    <p>We have some special offer for you!</p>
    <button type="button" class="btn btn-primary btn-lg">Learn more</button>
  </div>
 </div>
 <br>

<!-- Tips n trick using undordered and ordered list--> 
<div class="container">
  <h2>Tips on Living the Right Fitness</h2>
  <h3>Before fitness</h3>
  <ul>
    <li>Set goals (build muscle, beautify body, or other purpose)</li>
    <li>Choose a healthy and professional fitness center</li>
    <li>Choose the right and proper fitness instructor</li>
    <li>Consume nutritional supplements before going to fitness</li>
  </ul>
  <br>
  <h3>During Fitness</h3>
  <ol>
    <li>Warm up before starting 5-10 minutes</li>
    <li>Follow the instructor</li>
    <li>Do not play alone, try to be accompanied by a friend or instructor</li>
    <li>Do not overdo it (do it gradually)</li>
    <li>Customize the destination with the item you are playing</li>
    <li>Ask the instructor if you are confused about what to play</li>
  </ol>
  <br>
  <h3>After fitness</h3>
  <ul>
    <li>Keep your food intake, do not overeat</li>
    <li>Do not eat sweet after fitness</li>
    <li>Clean the body / shower after the sweat is lost to refresh the body.</li>
  </ul>
<br>
  <h4>Enjoy the benefits of fitness that you will get for health, keep it on and keep it on a regular basis.</h4>
</div>

<br><br><br><br>
 <!-- Thumbnail info -->
     <div class="container" id="tourpackages-carousel">
      
      <div class="row">
        
        <div class="col-xs-18 col-sm-6 col-md-3">
          <div class="thumbnail">
            <img src="AssignmentImage/Sport.jpg" width="500" height="300" alt="sport">
              <div class="caption">
                <h4>Sport Class</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, soluta, eligendi doloribus sunt minus amet sit debitis repellat. Consectetur, culpa itaque odio similique suscipit</p>
                <p><a href="#" class="btn btn-info btn-md" role="button">Join</a> <a href="#" class="btn btn-default btn-md" role="button">Question</a></p>
            </div>
          </div>
        </div>

        <div class="col-xs-18 col-sm-6 col-md-3">
          <div class="thumbnail">
            <img src="AssignmentImage/Dance.jpg" width="500" height="300" alt="dance">
              <div class="caption">
                <h4>Dance Class</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, soluta, eligendi doloribus sunt minus amet sit debitis repellat. Consectetur, culpa itaque odio similique suscipit</p>
                <p><a href="#" class="btn btn-info btn-md" role="button">Join</a> <a href="#" class="btn btn-default btn-md" role="button">Question</a></p>
            </div>
          </div>
        </div>

        <div class="col-xs-18 col-sm-6 col-md-3">
          <div class="thumbnail">
            <img src="AssignmentImage/MMA.jpg" width="500" height="300" alt="mma">
              <div class="caption">
                <h4>MMA Class</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, soluta, eligendi doloribus sunt minus amet sit debitis repellat. Consectetur, culpa itaque odio similique suscipit</p>
                <p><a href="#" class="btn btn-info btn-md" role="button">Join</a> <a href="#" class="btn btn-default btn-md" role="button">Question</a></p>
            </div>
          </div>
        </div>

        <div class="col-xs-18 col-sm-6 col-md-3">
          <div class="thumbnail">
            <img src="http://placehold.it/500x300" alt="">
              <div class="caption">
                <h4>Thumbnail label</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, soluta, eligendi doloribus sunt minus amet sit debitis repellat. Consectetur, culpa itaque odio similique suscipit</p>
                <p><a href="#" class="btn btn-info btn-md" role="button">Join</a> <a href="#" class="btn btn-default btn-md" role="button">Question</a></p>
            </div>
          </div>
        </div>
        
      </div><!-- End row -->
      
    </div><!-- End container -->
<br><br><br><br><br><br><br><br><br><br>
</body>
<?php include("footer.php"); ?>
</html>