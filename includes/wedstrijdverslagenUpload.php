<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();

if($user->isLoggedIn()) {
    if (!empty($_POST['name']) && isset($_POST['name'])
        && !empty($_POST['text']) && isset($_POST['text'])
        && !empty($_POST['team']) && is_numeric($_POST['team'])
    ) {
        $name = trim($_POST['name']);
        $text = trim($_POST['text']);
        $team_id = trim($_POST['team']);
        $db->insert('reports',array(
            'user_id' => $user->data()->id,
            'name' => $name,
            'text' => $text,
            'team_id' => $team_id,
            'date' => date("Y-m-d H:i:s")));
        echo "<p>Het verslag is verstuurd</p><br>";
    } else {
        echo "<h3>Er is wat mis gegaan. Probeer het opnieuw.</h3><br>";
    }
}