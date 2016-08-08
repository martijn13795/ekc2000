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
                $db->insert('trainers', array(
                    'team_id' => $data,
                    'user_id' => $id
                ));
            };
        }else if ($colum == "delete"){
            $query = $db->query("SELECT * FROM users WHERE id = '$id'")->first();
            unlink($query->IconPath);
            $deleteUser = $db->query("DELETE FROM `users` WHERE `users`.`id` = '$id'");
            $deleteTeam = $db->query("DELETE FROM `players` WHERE `players`.`user_id` = '$id'");
            $deleteTrainer = $db->query("DELETE FROM `trainers` WHERE `trainers`.`user_id` = '$id'");
            $deleteSession = $db->query("DELETE FROM `users_sessions` WHERE `users_sessions`.`user_id` = '$id'");
        }else if ($colum == "permissions"){
            $val = $_GET['val'];
            $tags = explode(',',$val);
            $i = 0;
            $count = count($tags);
            foreach($tags as $key) {
                if($count == 1) {
                    $val = "{\"" . $key . "\":1}";
                } else if($i<1) {
                    $val = "{\"" . $key . "\":1,";
                } else if ($i >= 1 && $i < ($count - 1)) {
                    $val = $val . "\"" . $key . "\":1,";
                } else {
                    $val = $val . "\"" . $key . "\":1}";
                }
                $i++;
            }
            $db->query("update permissions set `$colum`='$val' where user_id='$id'");
        }else {
            $db->query("update users set `$colum`='$data' where id='$id'");
        }
    }
}