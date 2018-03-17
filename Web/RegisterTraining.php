<?php 
include ("connection.php");
include("jobseekerMenu.php");

$aa= "SELECT * FROM TrainingSession WHERE status = 'Available' ";
$bb = mysqli_query($con, $aa);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$username=$_SESSION['username'];
$inIDnotFound="";

$inID = $_POST['inID'];

$cc= "SELECT * FROM TrainingSession WHERE sessionID = '$inID' ";
$dd = mysqli_query($con, $cc);
$row2 = mysqli_fetch_array($dd);
	$sessionID = $row2["sessionID"];
	$trainingType = $row2["trainingType"];
	$date = $row2["date"];
	$time = $row2["time"];
	$title = $row2["title"];
	$participants = $row2["participants"] + 1;
	$status = $row2["status"];
	$maxParticipants = $row2["maxParticipants"];
	$rating = $row2["rating"];

$ee= "SELECT sessionID FROM joinSession WHERE username = '$username' ";
$ff = mysqli_query($con, $ee);

	if ($sessionID == $inID){
		if ($trainingType == 'Personal'){
			$joinSession = "INSERT INTO `JoinSession` (`sessionID`, `title`, `date`, `time`, `trainingType`, `username`, `rating`) VALUES ('$sessionID', '$title', '$date' ,'$time', 'Personal' , '$username' ,'$rating') ";
			if (mysqli_query($con, $joinSession)){
				$setStatus = "UPDATE `TrainingSession` SET `status` = 'Full' WHERE sessionID = '$inID' ";
				if (mysqli_query($con, $setStatus)){
				echo '<script language="javascript">';
				echo 'alert("Successfully register for session.")';
				echo '</script>';
				}
			}
		}

		else { if (mysqli_num_rows($ff) > 0) { echo '<script language="javascript">';
				echo 'alert("Already joined session.")';
				echo '</script>'; }
			else {
			$joinSession = "INSERT INTO `JoinSession` (`sessionID`, `title`, `date`, `time`, `trainingType` , `username`,`rating`) VALUES ('$sessionID', '$title' ,'$date', '$time',  'Group' ,'$username','rating') ";
				if (mysqli_query($con, $joinSession)) {
					if ($participants == $maxParticipants){
						$setStatus = "UPDATE `TrainingSession` SET `status` = 'Full' WHERE sessionID = '$inID' ";
						if (mysqli_query($con, $setStatus)) {
							echo '<script language="javascript">';
							echo 'alert("Successfully register for session.")';
							echo '</script>';
						}
					} 

					else {
						$setnewPar = "UPDATE `TrainingSession` SET `participants` = '".$participants."' WHERE sessionID = '$inID' ";
						if(mysqli_query($con, $setnewPar)){
							echo '<script language="javascript">';
							echo 'alert("Successfully register for session.")';
							echo '</script>';
						}
					}	
				}
			}
		}
		}
	else
		{$inIDnotFound = "Session ID does not exist.";}
}
?>

<!DOCTYPE html>
<head>
	<title>Register Training Session</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Bootstrap-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="TrainingSession.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<script src="showlist_Group.js"></script>
<script src="showlist_Personal.js"></script>
</head>


<body>
  <!--Include JQuery: necessary for Bootstrap plugins-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--Include bootstrap library as needed-->
  <script src="js/bootstrap.min.js"></script>

 

		<div class="content_center">
			<div class="content">
				<div class="container_12">
					<div class="grid_12">
						<h3 class = "h3_center">Training Sessions</h3>
						<div class="grid_12 ">
<?php if(mysqli_num_rows($bb) > 0) {      
  echo '<table class="table table-hover">';
    echo '<thead>
      <tr>
        <th>SessionID</th>
        <th>Title</th>
        <th>Date</th>
        <th>Time</th>
        <th>Fee</th>
        <th>Type</th>
        <th>Status</th>
        <th>Trainer</th>
        <th>Trainer Speciality</th>
        <th>Rating</th>
      </tr>
    </thead>';
    while($row = mysqli_fetch_array($bb)){
      echo '<form><tbody><tr>';
      echo '<td>'. $row["sessionID"]. '</td>';
      echo '<td>'. $row["title"] .'</td>';
      echo '<td>'. $row["date"] .'</td>';
      echo '<td>'. $row["time"] .'</td>';
      echo '<td>'. $row["fee"] .'</td>';
      echo '<td>'. $row["trainingType"] .'</td>';
      echo '<td>'. $row["status"] .'</td>';
      echo '<td>'. $row["trainername"] .'</td>';
      echo '<td>'. $row["trSpecial"] .'</td>';
      echo '<td>'. $row["rating"] .'</td>';

      echo '</tbody></form>';
    }
  echo '</table>';
  echo '</div>';
  echo '</div>';
  echo '<br>';
  echo '<br>';
} else {
  echo "No records matched";
} 
mysqli_close($con);
  ?>

						<br><br>
						<form action="RegisterTraining.php" method="POST">
						<h4>Enter the session ID of the session you want to join:</h4>
						<input type="textbox" name="inID" id="sessionID_join" size="40" placeholder="<?php if(isset($inIDnotFound)){echo $inIDnotFound;} ?>"><br><br>
						<input type="submit" class="btn btn-primary btn-lg" value="Register for Training Session">
						</form>
						
					<div class="clear"></div>
						
						</div>
						</div>
					</div>
					
				</div>
			</div>

		<footer>
		</footer>
	</body>
</html>