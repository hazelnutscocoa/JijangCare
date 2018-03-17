<?php
include("connection.php");
include("memberMenu.php");


if(!isset($_SESSION['username'])||(isset($_SESSION['username']) && $_SESSION['username'] == '')){
    header("Location: Login.php"); exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$rating = $_POST['rating'];
$raitngError = "";

if($ratingError == ""){
  $review = "INSERT INTO TrainingSession (`rating`) VALUES ('$rating')";
}
}
?>

<!DOCTYPE html>
<head>
	<title>Review</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Bootstrap-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="Review.css" rel="stylesheet">
</head>


<body>
  <!--Include JQuery: necessary for Bootstrap plugins-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--Include bootstrap library as needed-->
  <script src="js/bootstrap.min.js"></script>
<form action="Review.php" id="rateform" method="POST">
  <div class="container">
    <div class="row">
      <div class="form-group">
        <label class="col-xs-12 col-sm-3">Rate:</label>
        <fieldset class="rating">
    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Awesome!">5 stars</label>
    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Uhmm">3 stars</label>
    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Really?">1 star</label>
  </fieldset>
    <br><br>
    <label class="col-xs-12 col-sm-3">Comments:</label>
    <textarea rows="5" cols="50" name="comments" form="rateform" placeholder="Enter your comments here..."></textarea>
    <div class="col-xs-12">
        <button onclick="rated();" type="submit" value="Rate" class="btn btn-warning">Rate</button>
    </div>
    <br>
        </div>
        </div>

</div>
</form>
<script type="text/javascript">
function rated(){
  var ask = window.confirm("Thank you! Your rating has been submitted");
}
</script>
</body>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<?php include("footer.php") ?>
</html>