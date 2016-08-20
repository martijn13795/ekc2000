<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('useredit'))) {
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
            if ($user->hasPermission('dev') || $user->hasPermission('userremove')) {
                $query = $db->query("SELECT * FROM users WHERE id = '$id'")->first();
                if ($query->IconPath != "../images/icons/default.jpg") {
                    unlink($query->IconPath);
                }
                $deleteTeam = $db->query("DELETE FROM `players` WHERE `user_id` = '$id'");
                $deleteTrainer = $db->query("DELETE FROM `trainers` WHERE `user_id` = '$id'");
                $deleteSession = $db->query("DELETE FROM `users_session` WHERE `user_id` = '$id'");
                $deletePermission = $db->query("DELETE FROM `permissions` WHERE `user_id` = '$id'");
                $deleteMessages = $db->query("DELETE FROM `messages` WHERE `user_id` = '$id'");
                $removeMembers = $db->query("SELECT * FROM commissions WHERE members LIKE '%,$id,%'");
                $deleteUser = $db->query("DELETE FROM `users` WHERE `id` = '$id'");
                foreach ($removeMembers->results() as $removeMember) {
                    $members = $removeMember->members;
                    $members = str_replace(",$id,", "", $members);
                    $db->query("update commissions set `members`='$members' WHERE members LIKE '%,$id,%' AND id = '$removeMember->id'");
                }
            }
        }else if ($colum == "permissions"){
            $val = $_GET['val'];
            $tags = explode(',',$val);
            $i = 0;
            $count = count($tags);
            foreach($tags as $key) {
                if ($key == "Geen") {
                    $db->query("DELETE FROM `permissions` where user_id='$id'");
                    return;
                } else {
                    if ($count == 1) {
                        $val = "{\"" . $key . "\":1}";
                    } else if ($i < 1) {
                        $val = "{\"" . $key . "\":1,";
                    } else if ($i >= 1 && $i < ($count - 1)) {
                        $val = $val . "\"" . $key . "\":1,";
                    } else {
                        $val = $val . "\"" . $key . "\":1}";
                    }
                    $i++;
                }
            }
            if ($db->query("update permissions set `$colum`='$val' where user_id='$id'")->count()){
                $db->query("update permissions set `$colum`='$val' where user_id='$id'");
            } else {
                $db->query("INSERT INTO `permissions`(`user_id`, `permissions`) VALUES ('$id','$val')");
            }
        }else if ($colum == "commissions"){
            $val = $_GET['val'];
            $resetMembers = $db->query("SELECT * FROM commissions");
            foreach ($resetMembers->results() as $resetMember) {
                $members = $resetMember->members;
                $members = str_replace(",$id,", "", $members);
                if ($db->query("update commissions set `members`='$members' WHERE id = '$resetMember->id'")->count()) {
                    $db->query("update commissions set `members`='$members' WHERE id = '$resetMember->id'");
                }
            }
            $tags = explode(',',$val);
            foreach($tags as $key) {
                if ($key != "Geen") {
                    $getMembers = $db->query("SELECT * FROM commissions WHERE name='$key'")->first();
                    if ($getMembers->members != "") {
                        $members = $getMembers->members . ',' . $id . ',';
                    } else {
                        $members = ',' . $id . ',';
                    }
                    if ($db->query("SELECT * FROM `commissions` WHERE members LIKE '%,$id,%' AND `name` = '$key'")->count()) {
                    } else {
                        $db->query("update commissions set `members`='$members' where `name`='$key'");
                    }
                } else if ($key == "Geen") {
                    $removeMembers = $db->query("SELECT * FROM commissions WHERE members LIKE '%,$id,%'");
                    foreach ($removeMembers->results() as $removeMember) {
                        $members = $removeMember->members;
                        $members = str_replace(",$id,", "", $members);
                        $db->query("update commissions set `members`='$members' WHERE members LIKE '%,$id,%' AND id = '$removeMember->id'");
                    }
                }
            }
        }else {
            $db->query("update users set `$colum`='$data' where id='$id'");
        }
    }
}