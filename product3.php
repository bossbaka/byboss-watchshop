<?php require_once('Connections/MyConnect.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['userber'])) {
  $loginUsername=$_POST['userber'];
  $password=$_POST['passw'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "member/index.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_MyConnect, $MyConnect);
  
  $LoginRS__query=sprintf("SELECT name, pass1 FROM register WHERE name=%s AND pass1=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $MyConnect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!doctype html>
<html>
<head>

<title>:: รายการสินค้า ::</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/half-slider.css" rel="stylesheet">
   	<link href="css/3-col-portfolio" rel="stylesheet" type="text/css">
    <!-- WebFont CSS -->
    <link href="webfonts/stylesheet.css" rel="stylesheet" type="text/css">
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
                        <a href="register.php">Register</a>
                    </li>
                    <li>
                        <a href="product.php">Product</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                </ul>
                 <form ACTION="<?php echo $loginFormAction; ?>" method="POST" class="navbar-form navbar-right" id="login">
                <div class="form-group"><input name="userber" type="text" class="form-control" id="userber" placeholder="Username" size="15"></div>
                <div class="form-group"><input name="passw" type="password" class="form-control" id="passw" placeholder="Password" size="15"></div>
           		 <button type="submit" class="btn btn-success">Sign in</button>
                </form>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    </header>

<br><br>
 <!-- Page Content -->
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="font-family: 'rsu regular'; font-size: 52px; font-weight: bold;">Product
                    <small>รายการสินค้า หน้าที่ 3</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-4 portfolio-item">
                 <div class="thumbnail">
                    <img src="img/w19.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา 7900 บาท</div>
            </div>
            <div class="col-md-4 portfolio-item">
                 <div class="thumbnail">
                    <img src="img/w20.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา 7900 บาท</div>
            </div>
            <div class="col-md-4 portfolio-item">
                  <div class="thumbnail">
                    <img src="img/w21.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา 7900 บาท</div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-4 portfolio-item">
                  <div class="thumbnail">
                    <img src="img/w22.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา 7900 บาท</div>
            </div>
            <div class="col-md-4 portfolio-item">
                  <div class="thumbnail">
                    <img src="img/w23.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา 7900 บาท</div>
            </div>
            <div class="col-md-4 portfolio-item">
                  <div class="thumbnail">
                    <img src="img/w24.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา 7900 บาท</div>
            </div>
        </div>

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-4 portfolio-item">
                  <div class="thumbnail">
                    <img src="img/w25.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา 7900 บาท</div>
            </div>
            <div class="col-md-4 portfolio-item">
                  <div class="thumbnail">
                    <img src="img/w26.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา 7900 บาท</div>
            </div>
            <div class="col-md-4 portfolio-item">
                 <div class="thumbnail">
                    <img src="img/w27.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา 7900 บาท</div>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="product2.php">&laquo;</a>
                    </li>
                    <li>
                        <a href="product.php">1</a>
                    </li>
                    <li>
                        <a href="product2.php">2</a>
                    </li>
                    <li  class="active">
                        <a href="product3.php">3</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

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
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

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
