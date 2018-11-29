<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!doctype html>
<html>
<head>

<title>:: หน้าแรก ::</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/half-slider.css" rel="stylesheet">
    <!-- WebFont CSS -->
    <link href="../webfonts/stylesheet.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              <a href="index.php" class="navbar-brand" style="font-family: 'rsu regular'; font-size: 24px; font-weight: bold; font-style: italic;">WATCH SHOP BY PHISEK</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" style="font-family: 'rsu regular'; font-size: 22px;">
                    <li>
                        <a href="product.php">Product</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                </ul>
				<div class="navbar-form navbar-right"><span style="font-family: csprajad; font-weight: bold; font-size: 20px; color: #FFF;">ยินดีต้อนรับคุณ <?php echo $_SESSION['MM_Username']; ?></span>
                   <a href="<?php echo $logoutAction ?>">
                   <button type="submit" class="btn btn-success">Log out</button>
              </a>                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Half Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('../img/1.jpg');"></div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('../img/2.jpg');"></div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('../img/3.jpg');"></div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
            <br>
                <center><h1 style="font-family: 'rsu regular'; font-size: 45px; font-weight: bold;">- แหล่งรวมนาฬิกาชั้นนำ -</h1>
                <p>พิเศษเพียงท่านสมัครสมาชิก สินค้าลดทันทีเหลือแค่ 30% เท่านั้น</p></center>
            </div>
        </div>
      
<!-- Portfolio Section -->
        <div class="row">
            <div class="col-lg-12">
               <h2 class="page-header" style="font-family: 'rsu regular'; font-weight: bold; font-size: 36px;">:: สินค้าตัวอย่าง ::</h2>
          </div>
      </div>
            <div class="jumbotron">
                  <div class="container">
            <center>
            <div class="col-md-4 col-sm-6">
                <a href="product.php">
                <img class="img-portfolio img-hover" src="../img/w1.png"> 
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
              <a href="product.php">
                <img class="img-portfolio img-hover" src="../img/w2.png"> 
              </a>
            </div>
            <div class="col-md-4 col-sm-6">
              <a href="product.php">
               <img class="img-portfolio img-hover" src="../img/w3.png">      
              </a>
            </div>
            <br>
            <div class="col-md-4 col-sm-6">
              <a href="product.php">
              <img class="img-portfolio img-hover" src="../img/w4.png"> 
              </a>
            </div>
            <div class="col-md-4 col-sm-6">
              <a href="product.php">
                <img class="img-portfolio img-hover" src="../img/w5.png"> 
              </a>
            </div>
            <div class="col-md-4 col-sm-6">
              <a href="product.php">
               <img class="img-portfolio img-hover" src="../img/w6.png">      
              </a>
            </div>
        </div></center>       
             </div>
    </div>
<hr>
 

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <center><p class="footcopyright">Copyright &copy; WATCH SHOP BY PHISEK 2015
                    <br>WEBSITE นี้รองรับการแสดงผลเฉพาะ Browser Google Chrome เท่านั้น
                                           <ul class="soc">
                                                <li><a class="soc-facebook" href="https://www.facebook.com/" target="_black"></a></li>
                                                <li><a class="soc-twitter" href="https://twitter.com/?lang=th" target="_black"></a></li>
                                                <li><a class="soc-google" href="https://plus.google.com/" target="_black"></a></li>
                                                <li><a class="soc-instagram" href="https://instagram.com/" target="	_black"></a></li>
                                                <li><a class="soc-email1" href="mailto:bybossza@msn.com" target="_black"></a></li>
                                                <li><a class="soc-rss soc-icon-last" href="https://www.rss.com/" target="	_black"></a></li>
                                        </ul></p></center>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <p id="back-to-top"><a href="#top"><span></span></a></p>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
    
     <script type="text/javascript">
	$(document).ready(function(){
	$("#back-to-top").hide();
	$(function () {
		$(window).scroll(function(){
		if ($(window).scrollTop()>100){
		$("#back-to-top").fadeIn(1500);
		}
		else
		{
		$("#back-to-top").fadeOut(1500);
		}
		});
		//back to top
		$("#back-to-top").click(function(){
		$('body,html').animate({scrollTop:0},1000);
		return false;
		});
		});
		});
  </script>
</body>
</html>