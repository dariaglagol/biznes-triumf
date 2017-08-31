<?php
include 'dbconnect.php';
include 'functions.php';
$name = mysql_real_escape_string($_POST['name']);
$email = mysql_real_escape_string($_POST['email']);
$phone = mysql_real_escape_string($_POST['phone']);

if(!$name){
	$data['name'] = true;
}

if(!$email){
	$data['email'] = true;
}

if(!$phone){
	$data['phone'] = true;
}

if($name && $phone && $email){
	mail_partner('molpredtomsk@gmail.com',$name,$phone,$email);
	mail_partner('klava@maybah.com',$name,$phone,$email);
	$data['msg'] = 'Спасибо! Ваша заявка отправлена. В ближайшее время мы свяжемся с вами!';
}

die(json_encode($data));
