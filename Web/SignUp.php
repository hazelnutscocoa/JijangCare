<?php 
 include ("connection.php");
 $passwordError="Your Password"; 
 $emailError="Your Email"; 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $confirmPassword = $_POST['confirmPassword'];
    $level = $_POST['level'];
    $speciality = $_POST['speciality'];
    $username = $_POST['username'];
    $fullname = $_POST["fullname"];
    $password = $_POST['password'];
    $usrtel = $_POST['usrtel'];

    $emailError=""; 
    $passwordError=""; 
    $roleError = ""; 
    $selectError="";
    

      
    $findMember = "SELECT `email` FROM `member` WHERE `email` = '".$_POST['email']."'";
    $findMemberEmail = mysqli_query($con, $findMember);
    $findTrainer = "SELECT `email` FROM `trainer` WHERE `email` = '".$_POST['email']."'";
    $findTrainerEmail = mysqli_query($con, $findTrainer);
    if(mysqli_num_rows($findMemberEmail) > 0 || mysqli_num_rows($findTrainerEmail) > 0){
      $emailError = "Someone have used this email already";
    }   
    else {
    $email = $_POST['email'];
    }
      
    if($confirmPassword != $password){
      $passwordError = "Both password must be same";
    }

    if($level == "" && $speciality == ""){
      $roleError = "Please choose your role!";
    } else if ($level != "" && $speciality != ""){
      $selectError = "You cannot select both level and speciality at the same time!";
    }

    if($emailError == "" && $passwordError == "" &&  $roleError == ""  && $selectError == ""){
      if($level != "" && $speciality == ""){
        $signUp = "INSERT INTO member (`username`, `fullname`, `email`, `password`, `usrtel`, `level` ) VALUES ('$username', '$fullname', '$email', '$password', '$usrtel', '$level')";
      } else if ($speciality != "" && $level == ""){
        $signUp = "INSERT INTO trainer (`username`, `fullname`, `email`, `password`, `usrtel`, `speciality`,`role`) VALUES ('$username', '$fullname', '$email', '$password', '$usrtel', '$speciality','Trainer')";
      }
    mysqli_query($con, $signUp);
    echo '<script language="javascript">';
    echo 'alert("Thank for signing up");';
    echo 'window.location.href="Login.php";';
    echo '</script>';
    }
      
    }
  
?>
  

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Bootstrap-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="SignUp.css" rel="stylesheet">
<script src="show1.js"></script>
<script src="show2.js"></script>
</head>

<body>
  <!--Include JQuery: necessary for Bootstrap plugins-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--Include bootstrap library as needed-->
  <script src="js/bootstrap.min.js"></script>

    <header>
  <nav class="navbar navbar-pills">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="Start.html"><img src="AssignmentImage/HELPFit Logo.png" alt="logo" width="100" height="80">
      </a>
      </div>
      
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-left">
          <li class="active"><a href="Start.html">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="SignUp.php">Sign Up</a></li>
          <li><a href="Login.php">Login</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
</header>

  <form action="SignUp.php" method="POST">
      <div class="container">
        <h1> Sign Up </h1>
        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
        <br>
        <div class="row">
        	<div class="form-group">
              	<label class="col-xs-12 col-sm-3">User Name:</label>
              	<div class="col-xs-12 col-sm-9">
                  	<input type="text" name="username" class="form-control input-md" id="username" placeholder="Enter your Username" required>
      		    </div>
          	</div>
        </div>
        <br>
        <div class="row">
          	<div class="form-group">
              	<label class="col-xs-12 col-sm-3">Full Name:</label>
              	<div class="col-xs-12 col-sm-9">
                  	<input type="text" name="fullname" class="form-control input-md" id="fullname" placeholder="Enter your Full Name" required>
      		    </div>
          	</div>
        </div>
        <br>
        <div class="row">
          	<div class="form-group">
              	<label class="col-xs-12 col-sm-3">Email:</label>
              	<div class="col-xs-12 col-sm-9">
                  	<input type="email" name="email" class="form-control input-md" id="email" placeholder="<?php if(isset($emailError)){echo $emailError;} ?>" required>
              	</div>
          	</div>
        </div>
        <br>
        <div class="row">
            <div class="form-group">
                <label class="col-xs-12 col-sm-3">Password:</label>
                <div class="col-xs-12 col-sm-9">
                  <input name="password" type="password" placeholder="<?php if(isset($passwordError)){echo $passwordError;} ?>" class="form-control input-md" id="password" required >                
                  <br>
                  <input name="confirmPassword" type="password" placeholder="Confirm Password" class="form-control input-md" id="confirm_password" required>
                </div>
            </div>
        </div>
        
        <br>
        <div class="row">
            <div class="form-group">
                <label class="col-xs-12 col-sm-3">Contact Number:</label>
                <div class="col-xs-12 col-sm-9">
                    <input type="tel" name="usrtel" id="usrtel" class="form-control input-md" placeholder="Enter Your Contact Number" required>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
          <div class="form-group">
                <label class="col-xs-12 col-sm-3">Role:</label>
                <div class="col-xs-6 col-sm-3">
                    <input type="radio" value="Member" onclick="show1();">Member 
                    <div id="div1" style="display: none;">
                      <hr><p>Level:</p>
                      <select id="level" name="level">
                        <option value="">Choose your Level</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Advance">Advance</option>
                        <option value="Expert">Expert</option>
                      </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <input type="radio" value="Trainer" onclick="show2();">Trainer
                    <div id="div2" style="display: none;">
                      <hr><p>Speciality:</p>
                      <select id="speciality" name="speciality">
                        <option value="">Choose your Speciality</option>
                        <option value="Dance">Dance</option>
                        <option value="MMA">MMA</option>
                        <option value="Sport">Sport</option>
                      </select>
                    </div>
                </div>
          </div><?php if(isset($roleError)){echo $roleError;} ?><?php if(isset($selectError)){echo $selectError;} ?>
        </div>
        </div>
          <br>
        <br>
        <div class="col-xs-12">
        
        <button type="submit" value="Sign Up" class="btn btn-danger">Sign Up</button>
        </div>
        <br><br><br>
        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
        <label><h4>Alredy have an account?</h4></label>
        <br>
        <div class="container">
          <a href="Login.php" class="btn btn-info" role="button">Log In</a>
        </div>
        <br><br><br>
        </div>
      </div>
    </div>
</div>


<script type="text/javascript">
function signup(){
  var ask = window.confirm("Thank You for Signing Up!");
  if (ask) {
      window.location.href = "Login.php";
  }
}
</script>
</body>
<?php include("footer.php"); ?>
</html>