<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if($user->isLoggedIn() && $user->hasPermission('admin')) {
    if (isset($_POST['activiteitName']) && !empty($_POST['activiteitName']) && isset($_POST['editor1']) && !empty($_POST['editor1'])) {
        $name = $_POST['activiteitName'];
        $name = str_replace(' ', '-', $name);
        $text = $_POST['editor1'];
        $db->insert('activities',array(
            'name' => $name,
            'text' => $text,
            'date' => date("Y-m-d H:i:s")
        ));
    }
}
header("Location: /activiteiten");