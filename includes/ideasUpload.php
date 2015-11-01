<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();

if($user->isLoggedIn()) {
    if (!empty($_POST['name']) && isset($_POST['name'])
        && !empty($_POST['idea']) && isset($_POST['idea'])
    ) {
        $name = trim($_POST['name']);
        $text = trim($_POST['idea']);
        $db->insert('ideas',array(
            'user_id' => $user->data()->id,
            'name' => $name,
            'text' => $text,
            'date' => date("Y-m-d H:i:s")));
        echo "Uw idee is verstuurd<br><br>";
    } else {
        echo "<h3>Er is wat mis gegaan. Probeer het opnieuw.</h3><br>";
    }
}