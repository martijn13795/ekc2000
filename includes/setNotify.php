<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if ($user->isLoggedIn()) {
    if($_GET['onoff'] && $_GET['colum']) {
        $id = $user->data()->id;
        $onOff = "";
        if ($_GET['onoff'] == "off") {
            $onOff = 0;
        } elseif ($_GET['onoff'] == "on") {
            $onOff = 1;
        }
        $colum = $_GET['colum'];
            $db->query("update users set `$colum`='$onOff' where id='$id'");
    }
}