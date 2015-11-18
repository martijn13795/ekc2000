<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if($user->isLoggedIn() && $user->hasPermission('admin')) {
    if (isset($_POST['activiteitName']) && !empty($_POST['activiteitName']) && isset($_POST['editor1']) && !empty($_POST['editor1']) && isset($_POST['activiteitDate']) && !empty($_POST['activiteitDate'])) {
        $name = $_POST['activiteitName'];
        $name = str_replace(' ', '-', $name);
        $text = $_POST['editor1'];
        $date = date("Y-m-d", strtotime(trim($_POST['activiteitDate'])));
        if($date){
            $db->insert('activities',array(
                'name' => $name,
                'user_id' => $user->data()->id,
                'text' => $text,
                'date' => date("Y-m-d H:i:s"),
                'date_activity' => $date
            ));
        } else {
            echo '<p>Er is wat mis gegaan bij de datum</p>';
        }
    }
}
header("Location: /activiteiten");