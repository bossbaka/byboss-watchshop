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
	
  $logoutGoTo = "index.php";
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

$MM_restrictGoTo = "index.php";
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
<?php require_once('../Connections/MyConnect.php'); ?>
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

$colname_tableforadmin = "-1";
if (isset($_GET['idregister'])) {
  $colname_tableforadmin = $_GET['idregister'];
}
mysql_select_db($database_MyConnect, $MyConnect);
$query_tableforadmin = sprintf("SELECT * FROM register WHERE idregister = %s", GetSQLValueString($colname_tableforadmin, "int"));
$tableforadmin = mysql_query($query_tableforadmin, $MyConnect) or die(mysql_error());
$row_tableforadmin = mysql_fetch_assoc($tableforadmin);
$totalRows_tableforadmin = mysql_num_rows($tableforadmin);

mysql_select_db($database_MyConnect, $MyConnect);
$query_Recordset1 = "SELECT * FROM register";
$Recordset1 = mysql_query($query_Recordset1, $MyConnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>:: Admin ::</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/half-slider.css" rel="stylesheet">
    <!-- WebFont CSS -->
    <link href="../webfonts/stylesheet.css" rel="stylesheet" type="text/css">
     <link href="../css/style.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
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
              <a href="../index.php" class="navbar-brand" style="font-family: 'rsu regular'; font-size: 24px; font-weight: bold; font-style: italic;">WATCH SHOP BY PHISEK</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" style="font-family: 'rsu regular'; font-size: 22px;">
                    <li>
                        <a href="for-admin.php">For Admin</a>
                    </li>
               </ul>
                            <div class="navbar-form navbar-right">
                              <a href="<?php echo $logoutAction ?>">
                              <button type="submit" class="btn btn-success">Log out</button>
                    </a></div>
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
            <div class="col-lg-12">
            <br>
                <center><h1 style="font-family: 'rsu regular'; font-size: 45px; font-weight: bold;">- Admin -</h1>
                <p>หน้าการจัดการ</p></center>
            </div>
   </div>
  <form action="search.php" method="post" id="form1">
   <div class="form-group"><input name="word" type="text" class="form-control" id="word" placeholder="Search" ></div>
           		 <button type="submit" id="search" class="btn btn-success" style="font-family: 'rsu regular'; font-size: 17px;">ค้นหา</button>
                </form>
            </div> 
            
<div class="container">
    <div class="row col-md-8 col-md-offset-2 custyle">
    <table align="center" class="table table-striped custab">
    <thead>
        <tr class="texttableadmin ">
            <th>ID</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Password</th>
            <th>Phone</th>
            <th class="text-center">การจัดการ</th>
        </tr>
    </thead>
         <?php do { ?>
       <tr>
         <td><?php echo $row_Recordset1['idregister']; ?></td>
         <td><?php echo $row_Recordset1['name']; ?></td>
         <td><?php echo $row_Recordset1['email']; ?></td>
         <td><?php echo $row_Recordset1['pass1']; ?></td>
         <td><?php echo $row_Recordset1['phone']; ?></td>
      <td class="text-center"><a href="update.php?idregister=<?php echo $row_Recordset1['idregister']; ?>" class='btn btn-info btn-xs'>Edit</a>
        <a class="btn btn-danger btn-xs" href="delete.php?idregister=<?php echo $row_Recordset1['idregister']; ?>">Del</a> <a href="insert.php" class="btn btn-warning btn-xs"> Add</a></td>
    </tr>
     <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </table>
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
<?php
mysql_free_result($tableforadmin);

mysql_free_result($Recordset1);
?>
