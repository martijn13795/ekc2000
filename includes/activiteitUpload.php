<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();

if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('activityupload'))) {
    if (isset($_POST['activiteitName']) && !empty($_POST['activiteitName'])) {
        if (isset($_POST['editor1']) && !empty($_POST['editor1'])) {
            if (isset($_POST['activiteitDate']) && !empty($_POST['activiteitDate'])) {
                $name = $_POST['activiteitName'];
                if (preg_match("#^[a-zA-Z0-9 '!' '?' ',' '.' ' ' '(' ')' ':' '\-' '_' '=' '\'' '\"' '%']+$#", $name)) {
                    $name = rawurlencode($name);
                    $text = $_POST['editor1'];
                    $date = date("Y-m-d", strtotime(trim($_POST['activiteitDate'])));
                    if ($date) {
                        $db->insert('activities', array(
                            'name' => $name,
                            'user_id' => $user->data()->id,
                            'text' => $text,
                            'date' => date("Y-m-d H:i:s"),
                            'date_activity' => $date
                        ));
                        echo "<h3>De activiteit is geupload</h3>";
                        echo "Refresh de pagina<br><br>";
                    } else {
                        echo '<h3>Er is wat mis gegaan bij de datum</h3><br>';
                    }
                } else {
                    echo "<h3>Voer een geldig bericht in</h3><br>";
                    echo "Karakters die u kunt gebruiken zijn: a-z A-Z 0-9 . , ? ! ( ) : = - _ ' \" %<br><br>";
                }
            } else {
                echo "<h3>Vul een datum in</h3><br>";
            }
        } else {
            echo "<h3>Het tekst vlak is leeg</h3><br>";
        }
    } else {
        echo "<h3>Vul een naam in</h3><br>";
    }
}