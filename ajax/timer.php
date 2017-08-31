<?php
include 'functions.php';

$to = '2017-11-20 12:00:00';

$day = date('d', strtotime($to) - time());

die($day);