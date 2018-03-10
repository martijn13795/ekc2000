<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();

if($user->isLoggedIn()) {
    if (!empty($_POST['name']) && isset($_POST['name'])
        && !empty($_POST['idea']) && isset($_POST['idea'])
    ) {
        $name = trim($_POST['name']);
        $idea = trim($_POST['idea']);
        $db->insert('ideas',array(
            'user_id' => $user->data()->id,
            'name' => $name,
            'text' => $idea,
            'date' => date("Y-m-d H:i:s")));
        echo "<h3>Bedankt voor het insturen van je idee</h3>
            <p>We stellen het erg op prijs dat je de tijd hebt genomen om je idee in te sturen.</p>
            <p>Alle ingezonden ideeën zullen bij de desbetreffende commissie terecht komen,</p>
            <p>zij zullen vervolgens de haalbaarheid beoordelen.</p><br>";
        $to = "communicatie@ekc2000.nl, martijn13795@hotmail.com";
        $subject = "Er is een nieuw idee op de site geplaatst";
        $title = "Hallo,";
        $text = 'Er is een nieuw idee ingestuurd.<br><br>
                 <h3>'. $name .'</h3>
                 <p>'. $idea .'</p><br>
                 Bekijk direct het idee op <a href="https://ekc2000.nl/ideeenbus">ekc2000.nl</a>.';
        email($to, $subject, $title, $text);
    } else {
        echo "<h3>Er is wat mis gegaan. Probeer het opnieuw.</h3><br>";
    }
}