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
        echo "<h3>Bedankt voor het insturen van je idee</h3><p>We stellen het erg op prijs dat je de tijd hebt genomen om je idee in te sturen.</p><p>Alle ingezonden ideeën zullen bij de desbetreffende commissie terecht komen,</p><p>zij zullen vervolgens de haalbaarheid beoordelen.</p><br>";
    } else {
        echo "<h3>Er is wat mis gegaan. Probeer het opnieuw.</h3><br>";
    }
}