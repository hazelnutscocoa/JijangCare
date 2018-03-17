<?php
  include ("connection.php");
  include("trainerMenu.php");
  $emailError = "New Email";
  $passwordError = "Your password";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $confirmPass = $_POST['confirmPass'];
    $username=$_SESSION['username'];
    $fullname=$_SESSION['fullname'];
    $email= $_SESSION['email'];
    $password= $_SESSION['password']; 
    $speciality= $_SESSION['speciality'];   
    

    $passwordError = ""; $emailError = "";
    
    if(!empty($_POST['speciality'])){
      $level = $_POST['speciality'];
    } 

    if(!empty($_POST['password'])){
      $password = $_POST['password'];
      if(empty($confirmPass) || $confirmPass != $password){
        $passwordError = "Both password must be same";
      }
    }
    

    if(!empty($_POST['fullname'])){
      $fullname = $_POST["fullname"];
    } 

if(!empty($_POST['email'])){
      $findMember = "SELECT `email` FROM `member` WHERE `email` = '".$_POST['email']."'";
      $findMemberEmail = mysqli_query($con, $findMember);
      $findTrainer = "SELECT `email` FROM `trainer` WHERE `email` = '".$_POST['email']."'";
      $findTrainerEmail = mysqli_query($con, $findTrainer);
        if(mysqli_num_rows($findMemberEmail) > 0 || mysqli_num_rows($findTrainerEmail) > 0){
          $emailError = "Someone have used this email already";
        }
        else {$email = $_POST['email'];
               $emailError = "";}
    }

    if($passwordError == "" && $emailError == "" ){
      if
    (mysqli_query($con, "UPDATE `Trainer` SET `password` = '$password', `email` = '$email', `fullname` = '$fullname', `speciality` = '$speciality' WHERE `username` = '".$username."'"));
        {
        echo '<script language="javascript">';
        echo 'alert("Session successfully created")';
        echo '</script>'; 
        }
      
    }

    if(empty($_POST['password'])){
      $passwordError = "New Password";
    }
    if(empty($_POST['email'])){
      $emailError = "New Email";
    }  
  }

?>

<!DOCTYPE html>
<head>
	<title>Profile</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Bootstrap-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="Profile.css" rel="stylesheet">
</head>

<body>
  <!--Include JQuery: necessary for Bootstrap plugins-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--Include bootstrap library as needed-->
  <script src="js/bootstrap.min.js"></script>


<div class="container">
   
    <h1>Edit Profile</h1>
    <hr>
  <div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="AssignmentImage/ava.png" class="avatar img-circle" alt="avatar" width="100" height="100">
          <h6>Upload a different photo...</h6>
          <input type="file" class="form-control">
        </div>
      </div>
      <br>
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          Please make sure you click <strong>.save changes.</strong> after edit.
        </div>
        <h3>Personal info</h3>
        
        <form action="modifyTrainer.php" method="POST" class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Full Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="fullname" placeholder="Your Full Name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="email" placeholder="<?php if(isset($emailError)){echo $emailError;} ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Password:</label>
            <div class="col-lg-8">
              <input class="form-control" type="password" name="password" placeholder="<?php if(isset($passwordError)){echo $passwordError;} ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Confirm password:</label>
            <div class="col-lg-8">
              <input class="form-control" type="password" name="confirmPass" placeholder="Confirm Password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Level:</label>
            <div class="col-lg-8">
              <select class="col-lg-3 control-label" id="level" name="speciality">
                <option value="">Choose your speciality</option>
                <option value="DANCE">DANCE</option>
                <option value="MMA">Advance</option>
                <option value="SPORT">Expert</option>              
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label"></label>
            <div class="col-lg-8">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<br><br><br><br><br><br><br><br><br><br>
</body>
<?php include("footer.php"); ?>
</html>