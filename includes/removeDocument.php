<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    $userID = $user->data()->id;
    if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('documentremove'))) {
        if($db->query("SELECT * FROM documents WHERE id = '$id'")->count()){
            $names = $db->query("SELECT path, id FROM documents WHERE id = '$id'");
            foreach ($names->results() as $name) {
                $path = $name->path;
                unlink($path);
            }
            $db->query("DELETE FROM documents WHERE id = '$id'");
        }
    } elseif($user->isLoggedIn()){
        if($db->query("SELECT * FROM documents WHERE id = '$id' AND user_id = '$userID'")->count()){
            $names = $db->query("SELECT path, id FROM documents WHERE id = '$id'");
            foreach ($names->results() as $name) {
                $path = $name->path;
                unlink($path);
            }
            $db->query("DELETE FROM documets WHERE id = '$id'");
        }
    }
}