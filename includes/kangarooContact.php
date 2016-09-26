<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
if (!empty($_POST['name']) && isset($_POST['name'])
    && !empty($_POST['phoneNumber']) && isset($_POST['phoneNumber'])
    && !empty($_POST['email']) && isset($_POST['email'])
) {
    $name = trim($_POST['name']);
    $phoneNumber = trim($_POST['phoneNumber']);
    $email = trim($_POST['email']);
    echo "<h3>We nemen zo spoedig mogelijk contact met u op</h3><br>";
    $to = "werving@ekc2000.nl";
    $subject = "Er moet contact opgenomen worden met iemand";
    $title = "Hallo,";
    $text = 'Er moet contact opgenomen worden met iemand.<br><br>
                 <h3>'. $name .'</h3>
                 <p>'. $phoneNumber .'</p><br>
                 <p>'. $email .'</p><br>
                 ';
    email($to, $subject, $title, $text);
} else {
    echo "<h3>Er is wat mis gegaan. Probeer het opnieuw.</h3><br>";
}