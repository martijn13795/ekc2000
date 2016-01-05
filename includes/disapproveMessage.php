<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    if($user->isLoggedIn() && $user->hasPermission('admin')){
        if($db->query("SELECT * FROM messages WHERE id = '$id'")->count()) {
            $db->query("UPDATE messages SET approved=FALSE WHERE id = '$id'");
        }
    }
}