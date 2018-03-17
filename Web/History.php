<?php
include("connection.php");
include("menu.php");

//session_start();
if(!isset($_SESSION['username'])||(isset($_SESSION['username']) && $_SESSION['username'] == '')){
    header("Location: Login.php");
} //else {
  //header("Location: History.php");
//}

$username = $_SESSION['username'];

$history = "SELECT * FROM JoinSession WHERE username = '$username' ";
$training = "SELECT * FROM TrainingSession WHERE username = '$username'";
$result = mysqli_query($con,"SELECT `date`, `time` FROM TrainingSession");
$rows = mysqli_fetch_array($result);

$list = mysqli_query($con, $history);

?>

<!DOCTYPE html>
<head>
	<title>Training History</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Bootstrap-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="History.css" rel="stylesheet">
</head>

<body>
  <!--Include JQuery: necessary for Bootstrap plugins-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--Include bootstrap library as needed-->
  <script src="js/bootstrap.min.js"></script>

<br>
<div class="container">
<h3>Training History</h3>
<br>
<div class="table-responsive">
<?php if(mysqli_num_rows($list) > 0) {      
  echo '<table class="table table-hover">';
    echo '<thead>
      <tr>
        <th>SessionID</th>
        <th>Title</th>
        <th>Class Type</th>
        <th>Rating</th>
        <th>Training Session Time</th>
      </tr>
    </thead>';
    while($row = mysqli_fetch_array($list)){
      echo '<form action="History.php" method="post"><tbody><tr>';
      echo '<td>'. $row["sessionID"]. '</td>';
      echo '<td>'. $row["title"] .'</td>';
      echo '<td>'. $row["classType"] .'</td>';
      echo '<td>';
      if($_SESSION['rating'] == 0){
        echo '<span class="glyphicon glyphicon-star-empty"></span>';
		    echo '<span class="glyphicon glyphicon-star-empty"></span>';
		    echo '<span class="glyphicon glyphicon-star-empty"></span>';
		    echo '<span class="glyphicon glyphicon-star-empty"></span>';
		    echo '<span class="glyphicon glyphicon-star-empty"></span>';
      } else if($_SESSION['rating'] == 1){
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star-empty"></span>';
        echo '<span class="glyphicon glyphicon-star-empty"></span>';
        echo '<span class="glyphicon glyphicon-star-empty"></span>';
        echo '<span class="glyphicon glyphicon-star-empty"></span>';
      } elseif ($_SESSION['rating'] == 2) {
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star-empty"></span>';
        echo '<span class="glyphicon glyphicon-star-empty"></span>';
        echo '<span class="glyphicon glyphicon-star-empty"></span>';
      } elseif ($_SESSION['rating'] == 3) {
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star-empty"></span>';
        echo '<span class="glyphicon glyphicon-star-empty"></span>';
      } elseif ($_SESSION['rating'] == 4) {
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star-empty"></span>';
      } elseif ($_SESSION['rating'] == 5) {
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star"></span>';
        echo '<span class="glyphicon glyphicon-star"></span>';
      } else {
        echo '<td><form action="Review.php" method="post"';
        echo '<input type="submit" value="Rate here" class="btn btn-warning">';
        echo '</form></td>';
      }
		  echo '</td>';
      echo '<td>'; 
      echo date_format($date, 'g:ia \o\n l jS F Y'); 
      echo '</td></tr>';
      echo '<div class="container col-md-3">
      <label>Enter the SessionID to Review: </label>
      <input type="text">
      <button type="Submit" value="Search"></button>
      </div>';
      
      //<tr>
      //  <td>Jennifer</td>
      //  <td>C101</td>
      //  <td>Sport</td>
      //<td><button type="button" class="btn btn-warning"><a href="Review.php">Rate Here</a></button></td>
      //<td>2 Oct, 4:34 PM</td>
      //</tr>
      echo '</tbody></form>';
    }
  echo '</table>';
  echo '</div>';
  echo '</div>';
  echo '<br>';
  echo '<br>';
} else {
  echo "No Training Session recorded";
} 
mysqli_close($con);
  ?>

<?php include("footer.php"); ?>

</body>
</html>