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
        $to = "martijn13795@hotmail.com"; // Dit email adres ontvangt het (stuur naar meerdere emails door e met een komma te schijden)
        $from = "website@ekc2000.nl"; // dit is de email die het verstuurd (kan nep zijn)
        $subject = "Er is een nieuw idee op de site geplaatst";
        $subject2 = "*Kopie* Er is een nieuw idee op de site geplaatst";
        $message = $name . "\n\n" . $text;
        $message2 = "*Kopie* " . $name . "\n\n" . $text;

        $headers = "From:" . $from;
        $headers2 = "From:" . $to;
        mail($to,$subject,$message,$headers);
        mail($from,$subject2,$message2,$headers2); // stuurd een kopie naar de verstuurder
    } else {
        echo "<h3>Er is wat mis gegaan. Probeer het opnieuw.</h3><br>";
    }
}