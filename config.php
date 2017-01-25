<?php
$username = "sys"; //mysql username
$password = "f7rjkpbr"; //mysql password
$hostname = "localhost"; //hostname
$databasename = "sbstatic"; //databasename

$useDB = mysql_connect($hostname, $username, $password)or die('could not connect to database');
mysql_select_db($databasename,$useDB);
?>