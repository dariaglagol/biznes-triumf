<?php
include 'dbconnect.php';
include 'functions.php';
$id = (int)$_POST['id'];
$search = mysql_fetch_array(mysql_query("SELECT * FROM `lider__triumf` WHERE `id` = $id"));

$url = 'http://бизнестриумф70.рф/form_two.php?hash=' . $search['hash'];
mail_soon($search['email'],$url);
die('/');
