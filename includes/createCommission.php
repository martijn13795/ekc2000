<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('commissioncreate'))) {
    if(!empty($_POST['name']) && isset($_POST['name'])
        && !empty($_POST['mail']) && isset($_POST['mail'])){
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        if(!empty($_POST['vacancy']) && isset($_POST['vacancy'])) {
            $vacancy = $_POST['vacancy'];
        } else {
            $vacancy = 0;
        }
        $vacancyText = isset($_POST['editor1']) ? $_POST['editor1'] : false;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : false;

        $commissions = $db->query("SELECT * FROM commissions WHERE name = '". escape($name) ."'");
        if(!$commissions->count()){
            if (strlen($vacancyText) <= 7900) {
                if ($name && $mail && $phone == false) {
                    $db->insert('commissions', array(
                        'name' => $name,
                        'mail' => $mail,
                        'vacancy' => $vacancy,
                        'vacancyText' => $vacancyText
                    ));
                    echo "<h3>Commissie aangemaakt</h3>";
                } else if ($name && $mail && $phone) {
                    if (is_numeric($phone)) {
                        $db->insert('commissions', array(
                            'name' => $name,
                            'mail' => $mail,
                            'phone' => $phone,
                            'vacancy' => $vacancy,
                            'vacancyText' => $vacancyText
                        ));
                        echo "<h3>Commissie aangemaakt</h3>";
                    } else {
                        echo "<h3>Gebruik alleen nummers bij het telefoonnummer</h3>";
                    }
                } else {
                    echo "<h3>Er is iets mis gegaan</h3>";
                }
            } else {
                echo "<h3>Gebruik maximaal 7900 karakters</h3>";
            }
        } else {
            echo "<h3>Deze commissie bestaat al</h3>";
        }
    } else {
        echo "<h3>Er is wat mis gegaan. Probeer het opnieuw.</h3><br>";
    }
}