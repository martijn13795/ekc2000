<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('admin'))) {
        if ($_POST['name']) {
            $userName = $_POST['name'];
            $userNames = $db->query("SELECT * FROM users WHERE username='$userName'");
            if ($userNames->count() === 1) {
                $id = $userNames->first()->id;
                $email = $userNames->first()->mail;
                $surname_prefix = null;
                if ($userNames->first()->surname_prefix) {
                    $surname_prefix = $userNames->first()->surname_prefix;
                }
                $name = $userNames->first()->name;
                $surname = $userNames->first()->surname;
                $password = randomPassword();
                $salt = Hash::salt(32);
                $hash = Hash::make($password, $salt);
                $db->query("update users set password='$hash' where id='$id'");
                $db->query("update users set salt='$salt' where id='$id'");

                $to = $email;
                $subject = "Uw wachtwoord voor EKC 2000 is gewijzigd";
                $title = "Hallo " . $surname_prefix ? $name.' '.$surname_prefix.' '.$surname : $name.' '.$surname . ",";
                $text = '<h3>Uw wachtwoord voor de website van EKC 2000 is gewijzigd.</h3>
                            <p>Uw gebruikersnaam is: ' . $userName . '</p>
                            <p>Uw wachtwoord is: ' . $password . '</p><br>
                            <p>Log nu in op <a href="https://ekc2000.nl/inloggen">ekc2000.nl</a>.</p>';
                email($to, $subject, $title, $text);

                echo "Het wachtwoord van <b>" . $userName . "</b> is gereset<br>";
                echo "Het nieuwe wachtwoord is: " . $password . "<br>";
                echo "Dit wachtwoord kan gewijzigd worden op de profiel pagina<br><br>";
                echo "Er is een email met het nieuwe wachtwoord verstuurd naar deze gebruiker";
            } else {
                echo "Deze gebruikersnaam bestaad niet";
            }
        } else {
            echo "Er is een error opgetreden";
        }
}

function randomPassword(){
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}