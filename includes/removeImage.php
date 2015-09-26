<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if($user->isLoggedIn() && $user->hasPermission('admin')){
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        if($db->query("SELECT * FROM pictures WHERE id = '$id'")->count()){
            $db->query("DELETE FROM pictures WHERE id = '$id'");
        }
    }
}