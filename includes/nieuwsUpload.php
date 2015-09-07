<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$name = $_POST['artikelName'];
$text = $_POST['editor1'];
$date = date("Y-m-d H:i:s");
$db->query("INSERT INTO nieuws (name, text, date) VALUES ('$name', '$text', '$date')");
header("Location: /nieuws");