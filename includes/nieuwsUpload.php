<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$text = $_POST['editor1'];
$date = date("Y-m-d H:i:s");
$db->query("INSERT INTO nieuws (text, date) VALUES ('$text', '$date')");
header("Location: /nieuws");