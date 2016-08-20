<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    $userID = $user->data()->id;
    if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('imageremove'))) {
        if($db->query("SELECT * FROM albums WHERE id = '$id'")->count()){
            $names = $db->query("SELECT name, id FROM albums WHERE id = '$id'");
            foreach ($names->results() as $name) {
                $it = new RecursiveDirectoryIterator('../images/gallerij/' . $name->name . '/', RecursiveDirectoryIterator::SKIP_DOTS);
                $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
                foreach($files as $file) {
                    if ($file->isDir()){
                        rmdir($file->getRealPath());
                    } else {
                        unlink($file->getRealPath());
                    }
                }
                rmdir('../images/gallerij/' . $name->name . '/');
            }
            $db->query("DELETE FROM albums WHERE id = '$id'");
            $db->query("DELETE FROM pictures WHERE album_id = '$id'");
        }
    } elseif($user->isLoggedIn()){
        if($db->query("SELECT * FROM albums WHERE id = '$id' AND user_id = '$userID'")->count()){
            $names = $db->query("SELECT name, id FROM albums WHERE id = '$id'");
            foreach ($names->results() as $name) {
                $it = new RecursiveDirectoryIterator('../images/gallerij/' . $name->name . '/', RecursiveDirectoryIterator::SKIP_DOTS);
                $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
                foreach($files as $file) {
                    if ($file->isDir()){
                        rmdir($file->getRealPath());
                    } else {
                        unlink($file->getRealPath());
                    }
                }
                rmdir('../images/gallerij/' . $name->name . '/');
            }
            $db->query("DELETE FROM albums WHERE id = '$id'");
            $db->query("DELETE FROM pictures WHERE album_id = '$id'");
        }
    }
}