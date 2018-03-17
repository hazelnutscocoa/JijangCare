<?php 
 include ("connection.php");
 include ("trainerMenu.php");

if(isset($_GET['sessionID'])){
    $sessionID = $_GET['sessionID'];
    $session = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `TrainingSession` WHERE `sessionID` = ".$_GET['sessionID'].""));
  }

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $fullname = $_SESSION['fullname'];
  $trSpecial = $_SESSION['speciality'];
  $trainingType = $_SESSION['trainingType'];

    $titleError="";
    $dateError=""; 
    $timeError=""; 
    $feeError=""; 

    if(empty($_POST['title'])){
      $titleError = "Please enter a title";
    } else {
      $title = $_POST['title'];
    }

  if(empty($_POST['date'])){
      $dateError = "Please choose a date and time";
    } else {
      if(time()>strtotime($_POST['date'])){
        $dateError="Should not be before today!";
      }else{
        $ddate = strtotime($_POST['date']);
        $date = date('Y-m-d',$ddate);}
    }
    

    if(empty($_POST['time'])){
      $timeError = "Please choose a time";
    } else {
        $time = $_POST['time'];
    }

  if(!empty($_POST['fee'])){
    if($_POST['fee'] < 0){
      $feeError = "Fee should not be negative";
    } else {
      if(is_numeric($_POST['fee'])){
        $fee = $_POST['fee'];
      } else {
        $feeError = "Fee must be numeric";
      }
    }
  } else {
    $feeError = "Please enter a fee";
  }

  if(empty($_POST['status']) || $_POST['status'] == ""){
      $statusError = "Please choose a status";
    } else {
      $status = $_POST['status'];
    }


  if($titleError =="" && $dateError =="" && $timeError =="" && $feeError =="" && $statusError == ""){
    $newSession = "UPDATE `TrainingSessions` SET `note` = '$note', `title` = '$name', `fee` = '$fee', `datetime` = '$time', `trainingType` = '$classType', `classType` = '$trainingType', `status` = '$status', `maxParticipants` = '$participant' WHERE `sessionID` = ".$_GET['sessionID']."";
    if (mysqli_query($con, $newSession)){
      header('Location: TrainerHome.php'); exit;
      }
    else 
      mysql_error(); 
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

            <h3 class = "h3_center">Update Training Session</h3>
            <form action="updateSession.php" method="POST">
            <table align="center">
            <tr>
            <th>Title:</th>
            <th><input type="textbox" name="title" id="title" size="40" required></th>
            <tr>
            <tr>
            <th>Date: </th>
            <th align="left"><input type="date" name="date" ></th>
            <tr>
            <tr>
            <th>Time:</th>
            <th align="left"><input type="time" name="time"></th>
            <tr>
            <tr>
            <th>Fee:</th>
            <th><input type="textbox" name="fee" id="fee" size="40" required></th>
            <tr>
              <th> Training Type: </th>
              <th><select id="" name="trainingType">
                  <option value="">Choose your Training Type</option>
                  <option value="Personal">Personal</option>
                  <option value="Group">Group</option>
            </select></th> 
            <tr>
            <?php 
            //if($_SESSION['trainingType'] == "Group"){
            echo '<th>Class Type:</th>
            <th><select id="speciality" name="classType">
                  <option value="">Choose your Speciality</option>
                  <option value="Dance">Dance</option>
                  <option value="MMA">MMA</option>
                  <option value="Sport">Sport</option>
            </select></th>';
          //} else {
          //echo 'Personal';
          //}
            ?>
            <tr>
            <th>Status: </th>
            <th><select id="status" name="status">
                  <option value="">Choose your Status</option>
                  <option value="Available">Available</option>
                  <option value="Completed">Completed</option>
                  <option value="Cancelled">Cancelled</option>
            </select></th>
            </table>
            <br><br>
            <div class="button">
            <input onclick="update();" type="submit" class="btn btn-primary btn-md" value="Update Training Session">
            <input type="reset" class="btn btn-primary btn-md">
            </div>
            </form><br>
          </div>

        </div>
      </div>
    </div>
<script type="text/javascript">
function update(){
  var ask = window.confirm("Your Training Session has been updated!");
}
</script>

<?php include("footer.php"); ?>
  </body>
</html>