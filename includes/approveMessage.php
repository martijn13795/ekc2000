<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('chatapprove'))) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        if ($db->query("SELECT * FROM messages WHERE id = '$id'")->count()) {
            $db->query("UPDATE messages SET approved=1 WHERE id = '$id'");
        }
    }
}