<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();

if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('reportupload'))) {
    if (!empty($_POST['name']) && isset($_POST['name'])) {
        if (isset($_POST['editor1']) && !empty($_POST['editor1'])) {
            if (!empty($_POST['team']) && is_numeric($_POST['team'])) {
                if (!empty($_POST['matchDate'])) {
                    $name = trim($_POST['name']);
                    if (preg_match("#^[a-zA-Z0-9 '!' '?' ',' '.' ' ' '(' ')' ':' '\-' '_' '=' '*' '\'' '\"' '%']+$#", $name)) {
                        $name = rawurlencode($name);
                        $text = trim($_POST['editor1']);
                        $team_id = trim($_POST['team']);
                        $date = date("Y-m-d", strtotime(trim($_POST['matchDate'])));
                        if ($date) {
                            $db->insert('reports', array(
                                'user_id' => $user->data()->id,
                                'name' => $name,
                                'text' => $text,
                                'team_id' => $team_id,
                                'date' => date("Y-m-d H:i:s"),
                                'date_match' => $date
                            ));
                            echo "<h3>Het verslag is geupload</h3>";
                            echo "Refresh de pagina<br><br>";

                            $emails = $db->query("SELECT mail, name FROM users WHERE reports = '1'");
                            if ($emails->count()) {
                                $name = rawurldecode($name);
                                $subject = "Nieuw wedstrijdverslag: " . $name;
                                $title = $name . ".";

                                foreach ($emails->results() as $email) {
                                    $userName = $email->name;
                                    $text = 'Hallo ' . $userName . ',<br><br>' . 'Er is een nieuw wedstrijdverslag geüpload: ' . $name . '.<br>'.'Bekijk hem nu: <a target="_blank" href="http://ekc2000.nl/verslag/' . rawurlencode($name) . '">http://ekc2000.nl/verslag/' . rawurlencode($name) . '</a><br>';
                                    $to = $email->mail;
                                    email($to, $subject, $title, $text);
                                }
                            }

                        } else {
                            echo '<h3>Er is wat mis gegaan bij de datum</h3><br>';
                        }
                    } else {
                        echo "<h3>Voer een geldig bericht in</h3><br>";
                        echo "Karakters die u kunt gebruiken zijn: a-z A-Z 0-9 . , ? ! ( ) : = - _ * ' \" %<br><br>";
                    }
                } else {
                    echo "<h3>Vul een wedstrijd datum in</h3><br>";
                }
            } else {
                echo "<h3>Selecteer een team</h3><br>";
            }
        } else {
            echo "<h3>Het tekst vlak is leeg</h3><br>";
        }
    } else {
        echo "<h3>Vul een naam in</h3><br>";
    }
}