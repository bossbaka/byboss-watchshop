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

<title>:: รายการสินค้า ::</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/half-slider.css" rel="stylesheet">
   	<link href="../css/3-col-portfolio" rel="stylesheet" type="text/css">
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
              </a>                 </div>
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
                    <small>รายการสินค้า หน้าที่ 1</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-4 portfolio-item">
                 <div class="thumbnail">
                    <img src="../img/w1.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1550-1B &nbsp;&nbsp;&nbsp;&nbsp;ราคา <strike>5500</strike> 3900 บาท</div>
            </div>
            <div class="col-md-4 portfolio-item">
                 <div class="thumbnail">
                    <img src="../img/w2.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา <strike>5500</strike> 3900 บาท</div>
            </div>
            <div class="col-md-4 portfolio-item">
                  <div class="thumbnail">
                    <img src="../img/w3.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา <strike>5500</strike> 3900 บาท</div>
            </div>
        </div>

        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-4 portfolio-item">
                  <div class="thumbnail">
                    <img src="../img/w4.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา <strike>6500</strike> 4500 บาท</div>
            </div>
            <div class="col-md-4 portfolio-item">
                  <div class="thumbnail">
                    <img src="../img/w5.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา <strike>6500</strike> 4500 บาท</div>
            </div>
            <div class="col-md-4 portfolio-item">
                  <div class="thumbnail">
                    <img src="../img/w6.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา <strike>6500</strike> 4500 บาท</div>
            </div>
        </div>

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-4 portfolio-item">
                  <div class="thumbnail">
                    <img src="../img/w7.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา <strike>6900</strike> 4800 บาท</div>
            </div>
            <div class="col-md-4 portfolio-item">
                  <div class="thumbnail">
                    <img src="../img/w8.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา <strike>6900</strike> 4800 บาท</div>
            </div>
            <div class="col-md-4 portfolio-item">
                 <div class="thumbnail">
                    <img src="../img/w9.png" class="img-responsive img-hover">
                </div>
                    <div class="thumbnail">GA-1000-4B &nbsp;&nbsp;&nbsp;&nbsp;ราคา <strike>6900</strike> 4800 บาท</div>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li class="active">
                        <a href="product.php">1</a>
                    </li>
                    <li>
                        <a href="product2.php">2</a>
                    </li>
                    <li>
                        <a href="product3.php">3</a>
                    </li>
                    <li>
                        <a href="product2.php">&raquo;</a>
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
    <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
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
