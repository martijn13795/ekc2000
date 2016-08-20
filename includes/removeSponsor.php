<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    $userID = $user->data()->id;
    if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('sponsorremove'))) {
        if($query = $db->query("SELECT * FROM sponsoren WHERE id = '$id'")->first()){
            unlink($query->path);
            unlink($query->pathMobile);
            $db->query("DELETE FROM sponsoren WHERE id = '$id'");
        }
    } elseif($user->isLoggedIn()){
        if($query = $db->query("SELECT * FROM sponsoren WHERE id = '$id' AND user_id = '$userID'")->first()){
            unlink($query->path);
            unlink($query->pathMobile);
            $db->query("DELETE FROM sponsorsen WHERE id = '$id'");
        }
    }
}