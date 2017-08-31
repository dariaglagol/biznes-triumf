<?php

$dblocation = 'localhost:3306';
$dbname = 'db_lider';
$dbuser = 'us_db_lider';
$dbpassword = 'r1E7rNK3';

$dbload = mysql_connect($dblocation, $dbuser, $dbpassword);
if (!$dbload) {
    die('ERROR! MySQL base connect');
}
if (!mysql_select_db($dbname, $dbload)) {
    die('ERROR! MySQL base select');
}
mysql_query("set names utf8");