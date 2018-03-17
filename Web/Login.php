<?php
include("connection.php");

if(isset($_POST['submit']))
{

 $username=$_POST['username'];
 $password=$_POST['password'];

 $usernameError="";
 $passwordError=""; 


 if($username!=''&&$password!=''){
   $findTrainer = "SELECT * FROM Trainer WHERE username='$username' and password='$password'";
   $findTrainerUsrnamePass = mysqli_query($con, $findTrainer);
   $findMember = "SELECT * FROM Member WHERE username='$username' and password='$password'";
   $findMemberUsrnamePass = mysqli_query($con, $findMember);

   if (mysqli_num_rows($findTrainerUsrnamePass) > 0){
    $resource=mysqli_fetch_array($findTrainerUsrnamePass);
    $_SESSION['username']=$username;
    $_SESSION['fullname']=$resource['fullname'];
    $_SESSION['email']=$resource['email'];
    $_SESSION['password']=$resource['password'];
    $_SESSION['speciality']=$resource['speciality'];
    $_SESSION['type']='trainer';
    header('location: TrainerHome.php');
    } 
    else if (mysqli_num_rows($findMemberUsrnamePass) > 0){
    $resource=mysqli_fetch_array($findMemberUsrnamePass);
    $_SESSION['username']=$username;
    $_SESSION['fullname']=$resource['fullname'];
    $_SESSION['email']=$resource['email'];
    $_SESSION['password']=$resource['password'];
    $_SESSION['level']=$resource['level'];
    $_SESSION['type']='member';
    header('location: MemberHome.php');
    } 
    else {
    echo '<div class="alert alert-danger">
    <strong>Oops!</strong> You entered incorrect username or password. Please try again.
    </div>';
    }
 }
 else { echo'Enter both username and password'; }
}

?>

<!DOCTYPE html>
<head>
  <title>Log In</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Bootstrap-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="Login.css" rel="stylesheet">
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
  <div class="container">    
     <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
           <div class="panel-heading">
                <div class="panel-title">Log In</div>
                   <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="https://mail.google.com/">Forgot password?</a></div>
                </div>     

                 <div style="padding-top:30px" class="panel-body" >

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                      <form id="loginform" class="form-horizontal" role="form" action="Login.php" method="post">
                                    
                        <div style="margin-bottom: 25px" class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                              <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username" required>                              
                        </div>
                                
                        <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                              <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required>
                        </div>
                                
                        <div class="input-group">
                            <div class="checkbox">
                                <label>
                                    <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                </label>
                            </div>
                        </div>
                      <div style="margin-top:10px" class="form-group">
                       <!-- Button -->
                      <div class="col-sm-12 controls"> 
                        <input type="submit" name="submit" value="Login" id="btn-login" class="btn btn-success"></a>
                        <a id="btn-fblogin" href="https://www.facebook.com/" class="btn btn-primary">Login with Facebook</a>
                      </div>
                      </div>
                     <div class="form-group">
                          <div class="col-md-12 control">
                              <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >Don't have an account?
                                 <a href="SignUp.php">Sign Up Here</a>
                              </div>
                          </div>
                     </div>    
            </form> 
          </div>                     
       </div>  
    </div>
 </div>
<br><br><br><br><br><br><br>
</body>
<?php include("footer.php"); ?>
</html>