<?php 
 include ("connection.php");
 include ("trainerMenu.php");
    $feeError="Enter session fee"; 
    $parError="Enter session maximum participants";
 

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$fullname=$_SESSION['fullname'];
	$trSpecial=$_SESSION['speciality'];
	

    $dateError=""; 
    $feeError=""; 
    $parError="";
    $classError=""; 



    $title = $_POST['title'];

	if(time()>strtotime($_POST['date'])){
		$dateError="Cannot be before today !!";
	} else {
		$ddate = strtotime($_POST['date']);
		$date = date('Y-m-d',$ddate);}
		
	$time = $_POST['time'];

	if(!empty($_POST['fee'])){
		if($_POST['fee'] < 0){
			$feeError = "Fee cannot be negative";
		} else {
			if(is_numeric($_POST['fee'])){
				$fee = $_POST['fee'];
			} else {
				$feeError = "Fee must be numeric";
			}
		}
	}

	if(!empty($_POST['par'])){
		if($_POST['par'] < 0){
			$parError = "Participants cannot be negative.";
		} else {
			if(is_numeric($_POST['par'])){
				$par = $_POST['par'];
			} else {
				$parError = "Number of participants must be numeric";
			}
		}
	}


    if($_POST['classtype'] == ""){
			$classError = "Please choose a class";
		} else {
			$classType = $_POST['classtype'];
		}

	$sessionID = intval( rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );	


	if($dateError =="" && $feeError =="" && $parError =="" && $classError ==""){
		$newSession = "INSERT INTO `TrainingSession` (`sessionID`, `title`, `date`, `time`, `fee`, `status`, `classType`, `trainingType`, `maxParticipants`,`notes`, `rating`, `trainername`, `trSpecial`, `participants`) VALUES ('$sessionID', '$title', '$date' ,'$time', '$fee', 'Available', '$classType', 'Group', '$par', '', '0', '$fullname' , '$trSpecial' , '0') ";
		if (mysqli_query($con, $newSession)){
			echo '<script language="javascript">';
			echo 'alert("Session successfully created")';
			echo '</script>';
			}
		}
    }
  
?>

<!DOCTYPE html>
<head>
	<title>Training Session</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Bootstrap-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="TrainingSession.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
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

						<h3 class = "h3_center">Group Training Session</h3>
						<form action="RecordGroupTraining.php" method="POST">
						<table align="center">
						<tr>
						<th>Title:</th>
						<th><input type="textbox" name="title" id="title" size="40" required placeholder="Enter Sesion Title"></th>
						<tr>
						<tr>
						<th>Date:</th>
						<th align="left"><input type="date" name="date" required><?php if(isset($dateError)){echo $dateError;} ?></th>
						<tr>
						<tr>
						<th>Time:</th>
						<th align="left"><input type="time" name="time" required></th>
						<tr>	
						<tr>
						<th>Fee:</th>
						<th><input type="textbox" name="fee" id="fee" size="40" required placeholder="<?php if(isset($feeError)){echo $feeError;} ?>"></th>
						<tr>
						<tr>
						<th>Max no. of Participants:</th>
						<th><input type="textbox" name="par" id="fee" size="40" required placeholder="<?php if(isset($parError)){echo $parError;} ?>"></th>
						<tr>
						<tr>
						<th>Class Type:</th>
						<th align="left">
							<input type="radio" name="classtype" value="Sport">Sport 
							<input type="radio" name="classtype" value="Dance">Dance 
							<input type="radio" name="classtype" value="MMA">MMA <?php if(isset($classError)){echo $classError;} ?></th>
						<tr>
						</table>
						<br><br>
						<div class="button">
						<input  type="submit" class="btn btn-primary btn-md" value="Record Training Session">
						<input type="reset" class="btn btn-primary btn-md">
						</div>
						</form><br>
					</div>
				</div>
			</div>
		</div>

		<br><br>
<br><br>
	</body>
	<footer class="container text-center">
HELPFit &copy; Copyright 2017</footer>
</html>