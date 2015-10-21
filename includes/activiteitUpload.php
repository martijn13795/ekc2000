<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$name = $_POST['activiteitName'];
$name = str_replace(' ', '-', $name);
$text = $_POST['editor1'];
$date = date("Y-m-d H:i:s");
$db->query("INSERT INTO activities (name, text, date) VALUES ('$name', '$text', '$date')");
header("Location: /activiteiten");