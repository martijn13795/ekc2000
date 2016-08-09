<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if($user->isLoggedIn() && $user->hasPermission('admin')){
    if(!empty($_POST['name']) && isset($_POST['name'])
        && !empty($_POST['mail']) && isset($_POST['mail'])){
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $phone = isset($_POST['phone']) ? $_POST['phone'] : false;

        $commissions = $db->query("SELECT * FROM commissions WHERE name = '". escape($name) ."'");
        if(!$commissions->count()){
            if ($name && $mail && $phone == false) {
                $db->insert('commissions', array(
                    'name' => $name,
                    'mail' => $mail
                ));
                echo "<h3>Commissie aangemaakt</h3>";
            } else if ($name && $mail && $phone) {
                if (is_numeric($phone)) {
                    $db->insert('commissions', array(
                        'name' => $name,
                        'mail' => $mail,
                        'phone' => $phone
                    ));
                    echo "<h3>Commissie aangemaakt</h3>";
                } else {
                    echo "<h3>Gebruik alleen nummers bij het telefoonnummer</h3>";
                }
            }
        } else {
            echo "<h3>Deze commissie bestaat al</h3>";
        }
    } else {
        echo "<h3>Er is wat mis gegaan. Probeer het opnieuw.</h3><br>";
    }
}