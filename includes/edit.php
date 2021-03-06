<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('newsedit') || $user->hasPermission('activityedit') || $user->hasPermission('reportedit'))) {
    $updateThing = $_GET['updateThing'];
    $updateId = $_GET['updateId'];
    if (isset($_POST['artikelName']) && !empty($_POST['artikelName'])) {
        if (isset($_POST['editor1']) && !empty($_POST['editor1'])) {
            $name = $_POST['artikelName'];
            if (preg_match("#^[a-zA-Z0-9 '!' '?' ',' '.' ' ' '(' ')' ':' '\-' '_' '=' '*' '\'' '\"' '%']+$#", $name)) {
                $name = rawurlencode($name);
                $text = $_POST['editor1'];
                if ($updateThing == "activities"){
                    if (isset($_POST['activiteitDate']) && !empty($_POST['activiteitDate'])) {
                        $date = $_POST['activiteitDate'];
                        $email = "";
                        if(isset($_POST['email']) && $_POST['email'] != ""){
                            $email = $_POST['email'];
                        }
                        $db->update($updateThing, $updateId, array(
                            'user_id' => $user->data()->id,
                            'name' => $name,
                            'text' => $text,
                            'date' => date("Y-m-d H:i:s"),
                            'date_activity' => $date,
                            'email' => $email
                        ));
                    } else {
                        echo "<h3>Vul een datum in</h3><br>";
                    }
                } else if ($updateThing == "reports"){
                    if (isset($_POST['reportsDate']) && !empty($_POST['reportsDate'])) {
                        $date = $_POST['reportsDate'];
                        $db->update($updateThing, $updateId, array(
                            'user_id' => $user->data()->id,
                            'name' => $name,
                            'text' => $text,
                            'date' => date("Y-m-d H:i:s"),
                            'date_match' => $date
                        ));
                    } else {
                        echo "<h3>Vul een datum in</h3><br>";
                    }
                } else {
                    $db->update($updateThing, $updateId, array(
                        'user_id' => $user->data()->id,
                        'name' => $name,
                        'text' => $text,
                        'date' => date("Y-m-d H:i:s")
                    ));
                }
                echo "<h3>Het bewerken is voltooid</h3>";
                echo "Ga terug naar de pagina<br><br>";
            } else {
                echo "<h3>Voer een geldig bericht in</h3><br>";
                echo "Karakters die u kunt gebruiken zijn: a-z A-Z 0-9 . , ? ! ( ) : = - _ * ' \" %<br><br>";
            }
        } else {
            echo "<h3>Het tekst vlak is leeg</h3><br>";
        }
    } else {
        echo "<h3>Vul een naam in</h3><br>";
    }
}