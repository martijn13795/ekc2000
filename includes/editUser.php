<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if($user->isLoggedIn() && $user->hasPermission('admin')) {
    if($_GET['id'] && $_GET['data'] && $_GET['colum']) {
        $id = $_GET['id'];
        $data = $_GET['data'];
        $colum = $_GET['colum'];
        if ($colum == "team"){
            $insert = $db->query("SELECT * FROM players where user_id='$id'");
            if ($insert->count()){$insert = $db->query("update players set team_id='$data' where user_id='$id'");}
            else {
                $db->insert('players', array(
                    'team_id' => $data,
                    'user_id' => $id
                ));
            };
        }else if ($colum == "trainer"){
            $insert = $db->query("SELECT * FROM trainers where user_id='$id'");
            if ($insert->count()){$insert = $db->query("update trainers set team_id='$data' where user_id='$id'");}
            else {
                $db->insert('players', array(
                    'team_id' => $data,
                    'user_id' => $id
                ));
            };
        }else if ($colum == "delete"){
            $delete = $db->query("DELETE FROM `users` WHERE `users`.`id` = '$id'");
        }else {
            $db->query("update users set `$colum`='$data' where id='$id'");
        }
    }
}