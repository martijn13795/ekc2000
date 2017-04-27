<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('newsupload'))) {
    if (isset($_POST['artikelName']) && !empty($_POST['artikelName'])) {
        if (isset($_POST['editor1']) && !empty($_POST['editor1'])) {
            $name = $_POST['artikelName'];
            if (preg_match("#^[a-zA-Z0-9 '!' '?' ',' '.' ' ' '(' ')' ':' '\-' '_' '=' '\'' '\"' '%']+$#", $name)) {
                $name = rawurlencode($name);
                $text = $_POST['editor1'];
                $result = substr($text, 0, 4);
                if ($result == "<h1>") {
                    $db->insert('news', array(
                        'user_id' => $user->data()->id,
                        'name' => $name,
                        'text' => $text,
                        'date' => date("Y-m-d H:i:s")
                    ));
                    echo "<h3>Het artikel is geupload</h3>";
                    echo "Refresh de pagina<br><br>";

                    $emails = $db->query("SELECT mail FROM users WHERE news = '1'");
                    $emailString = "";
                    $i = 1;
                    if ($emails->count()) {
                        foreach ($emails->results() as $email) {
                            if ($i == 1) {
                                $emailString = $emailString . $email->mail;
                            } else {
                                $emailString = $emailString . ", " . $email->mail;
                            }
                            $i++;
                        }
                    }

                    $name = rawurldecode($name);
                    $to = $emailString;
                    $subject = "Nieuw artikel: " . $name;
                    $title = "Nieuwe artikel: ". $name;
                    $text = 'Er is een nieuw artikel geüpload: "' . $name . '".<br>';
                    email($to, $subject, $title, $text);
                } else {
                    echo "<h3>Begin de text met een 'Kop 1'</h3><br>";
                }
            } else {
                echo "<h3>Voer een geldig bericht in</h3><br>";
                echo "Karakters die u kunt gebruiken zijn: a-z A-Z 0-9 . , ? ! ( ) : = - _ ' \" %<br><br>";
            }
        } else {
            echo "<h3>Het tekst vlak is leeg</h3><br>";
        }
    } else {
        echo "<h3>Vul een naam in</h3><br>";
    }
}