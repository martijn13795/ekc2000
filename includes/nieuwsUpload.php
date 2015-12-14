<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if($user->isLoggedIn() && $user->hasPermission('admin')) {
    if (isset($_POST['artikelName']) && !empty($_POST['artikelName']) && isset($_POST['editor1']) && !empty($_POST['editor1'])) {
        $name = $_POST['artikelName'];
        $name = str_replace(' ', '-', $name);
        $name = str_replace('\'', '-', $name);
        $text = $_POST['editor1'];
        $db->insert('news',array(
            'user_id' => $user->data()->id,
            'name' => $name,
            'text' => $text,
            'date' => date("Y-m-d H:i:s")
        ));
    }
}
header("Location: /nieuws");