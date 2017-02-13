<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('commissionedit'))) {
    if($_GET['id'] && $_GET['colum']) {
        $id = $_GET['id'];
        $data = $_GET['data'];
        $colum = $_GET['colum'];
        if ($colum == "delete"){
            $query = $db->query("SELECT * FROM commissions WHERE id = '$id'")->first();
            $deleteCommission = $db->query("DELETE FROM `commissions` WHERE `id` = '$id'");
        }else {
            $db->query("update commissions set `$colum`='$data' where id='$id'");
        }
    }
}