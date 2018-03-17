<?php
include("connection.php");

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
  <header class="">

  <nav class="navbar navbar-pills">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="Home.php"><img src="AssignmentImage/JinjangCare.jpg" alt="logo" width="700" height="500">
      </a>
      </div>
      
      <div id="navbar" class="navbar-collapse collapse">
        <header 
        <ul class="nav navbar-nav navbar-left">

          <li class="active"><a href="Home.php">Home</a></li>
          <li class="active"><a href="aboutAGN.php">About AGN</a></li>
          <li class="active"><a href="ourWork.php">Our Work</a></li>
          <li class="active"><a href="leteracy.php"> Literacy and Numeracy Programme</a></li>
          <li class="active"><a href="howtohelp.php"> How Can I Help</a></li>
          <li class="active"><a href="enews.php"> Enews/Events</a></li>
          <li class="active"><a href="">Update Training</a></li>
          <li class="active"><a href="History.php">History</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="Profile.php">Profile</a></li>
          <li><a href="Logout.php">Log Out</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
</header>
  <!--Include JQuery: necessary for Bootstrap plugins-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--Include bootstrap library as needed-->
  <script src="js/bootstrap.min.js"></script>

<br>
<!-- Welcome Message using jumbotron -->
<div class="container">
  <div class="jumbotron">
    <h1><?php include ("welcome.php"); ?></h1>      
    
  
  </div>
 </div>
 <br>

<!-- Tips n trick using undordered and ordered list--> 
<div class="container">
  <font size="6" color="black" face="Verdana"><b><p> THE JINJANG STORY</p></b></font>
  <font size="3" color="black" face="Verdana">
  <p>The entire housing was built on the city's landfilled rubbish dump. It is currently notorious for the high crime rate, drug abuse, gang fights and conflicts. A harbor for drug addicts, alcoholics, gangsters, prostitutes and petty criminals.</p>
  <p>Jinjang Utara is littered with dilapidated rumah transit (supposed to be temporary housing). Currently, housing more than 2000 people. These are forgotten people who became disillusioned and embittered. The inhabitants waited for 40 years to date, to be relocated to their new residence under Projek Perumahan (PPR) which has yet to happen. This is 38 years later than the promised duration by the government. Even if they are offered low cost housing tomorrow, they will not be able to afford it as they can hardly afford the RM40 per month rent even now. The average combined income per month for each family is less than RM1000.</p>
  <p>The integrity of the rumah transit is questionable because they were not built to last. This poses a health and safety hazard for the family staying under the roof of each unit. The occupants have grown over the years to include three generations with an average of ten people in each unit. Each unit is cramped in a 480-square-feet space for the entire family of over 10 pax each.</p>
  <p>The children in Jinjang Utara have been growing up in a poverty stricken environment. Some were abandoned by their parents or are neglected in an environment of abject poverty. Violence is rampant in this place. Teenagers are at risk of being recruited by gangs. With their home so broken and crowded, the teenagers have no place to turn to. The gangs offered financial and communal support/relief, including a sense of belonging.</p>
  <p>Jonathan Ambalagan and Mary Ramamoothy started the community work and have been reaching out to the children of Jinjang Utara for the past 17 years. It is their life mission to see the community transformed and changed through helping the children - one child at a time. The chief focus is on education and social concern activities. They conduct weekly outdoor activities to instill moral values in children. Over 100 children attend their session every week. Over the years, many of these children have progressed to complete their secondary education. Few are even completing their college education through the sponsorship of kind benefactors like HELP Education Group.</p>
  <p>Jonathan and Mary make home visits weekly to know each family's respective needs. In the process, they are supporting some of the families' need such as education (school bus), groceries, school supplies, etc. Because of the financial burden, many of these children are undernourished and some are even deprived of food for many days. They then have to survive on occasional leftovers offered by kind neighbors. </p>
  <p>The children are constantly subjected to danger of bad influence, perversion and exploitation daily under such conditions. Occasionally, Jonathan and Mary will be called for counselling, as the men are thrown in jail, taken into drug rehab, youths arrested for fights or drug possession, etc. The work is immense with never ending challenges.</p>
  <p>Update in 2018:</p>
  <p>The low cost housing flats built for this community has since been open for the families to move in. However, the families are still finding it difficult to afford the lease, as in comparison to the rental they used to pay for the Rumah Panjang, this is significantly more costly.</p>
</font>



  <!-- <h2>Tips on Living the Right Fitness</h2>
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

<br><br><br><br> -->

 <!-- 
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
        </div>-->
      </div><!-- End row --> 
    </div><!-- End container -->
<br><br><br><br><br><br><br><br><br><br>
</body>
<?php include("footer.php"); ?>
</html>