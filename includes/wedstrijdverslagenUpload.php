<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();

if($user->isLoggedIn()) {
    if (!empty($_POST['name']) && isset($_POST['name'])
        && isset($_POST['editor1']) && !empty($_POST['editor1'])
        && !empty($_POST['team']) && is_numeric($_POST['team'])
        && !empty($_POST['matchDate'])
    ) {
        $name = trim($_POST['name']);
        $name = str_replace(' ', '-', $name);
        $text = trim($_POST['editor1']);
        $team_id = trim($_POST['team']);
        $date = date("Y-m-d", strtotime(trim($_POST['matchDate'])));
        if($date) {
            $db->insert('reports', array(
                'user_id' => $user->data()->id,
                'name' => $name,
                'text' => $text,
                'team_id' => $team_id,
                'date' => date("Y-m-d H:i:s"),
                'date_match' => $date
            ));
            echo "<p>Het verslag is verstuurd</p><br>";
        } else {
            echo '<p>Er is wat mis gegaan bij de datum</p>';
        }
    } else {
        echo "<h3>Er is wat mis gegaan. Probeer het opnieuw.</h3><br>";
    }
}