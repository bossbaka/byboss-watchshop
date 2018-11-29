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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="register.php";
  $loginUsername = $_POST['name'];
  $LoginRS__query = sprintf("SELECT name FROM register WHERE name=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_MyConnect, $MyConnect);
  $LoginRS=mysql_query($LoginRS__query, $MyConnect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "login-form")) {
  $insertSQL = sprintf("INSERT INTO register (name, email, pass1, address, phone) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['phone'], "text"));

  mysql_select_db($database_MyConnect, $MyConnect);
  $Result1 = mysql_query($insertSQL, $MyConnect) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
<title>:: สมัครสมาชิก ::</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/half-slider.css" rel="stylesheet">
    <!-- WebFont CSS -->
    <link href="webfonts/stylesheet.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
    </script>
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

    <!-- Page Content -->
<br><br><br><br>
<div class="container">
  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">                        
        <h2>Registration</h2>
      </div>
  </div>
  <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xs-offset-4">
          <form name="login-form" id="login-form" class="form" action="<?php echo $editFormAction; ?>" method="POST" role="form">
							<div class="form-group">
                  <label class="form-label" for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name" tabindex="1" required>
              </div>
            <div class="form-group">
              <label class="form-label" for="email">Email</label>
              <input name="email" type="text" required class="form-control" id="email" placeholder="Email" tabindex="2" onBlur="MM_validateForm('email','','RisEmail');return document.MM_returnValue">
			   </div>                            
              <div class="form-group">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" class="form-control" id="passoword" name="password" placeholder="Password" tabindex="3" required>
              </div>
              <div class="form-group">
              <label class="form-label" for="address">Address</label>
              <textarea class="form-control" id="address" name="address" placeholder="Address" rows="5"></textarea>
              </div>
				<div class="form-group">
                  <label class="form-label" for="Phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" tabindex="2" required onKeyUp="if(isNaN(this.value)){ alert('กรอกได้เฉพาะตัวเลข'); this.value='';}"/>
              </div>            
              <div class="text-center">
                  <button type="submit" class="btn btn-start-order">Register</button>
              </div>
              <input type="hidden" name="MM_insert" value="login-form">
          </form>
      </div>
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
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
