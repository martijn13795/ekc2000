<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    $userID = $user->data()->id;
    if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('newsremove'))) {
        if($db->query("SELECT * FROM news WHERE id = '$id'")->count()){
            $db->query("DELETE FROM news WHERE id = '$id'");
        }
    } elseif($user->isLoggedIn()){
        if($db->query("SELECT * FROM news WHERE id = '$id' AND user_id = '$userID'")->count()){
            $db->query("DELETE FROM news WHERE id = '$id'");
        }
    }
}