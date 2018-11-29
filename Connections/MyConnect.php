<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_MyConnect = "localhost";
$database_MyConnect = "phisek";
$username_MyConnect = "root";
$password_MyConnect = "";
$MyConnect = mysql_pconnect($hostname_MyConnect, $username_MyConnect, $password_MyConnect) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("Set Names UTF8");
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
?>