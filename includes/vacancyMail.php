<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$user = new User(); if ($user->isLoggedIn()) {
    //$to = "vrijwilligers@ekc2000.nl";
    $to = "martijn13795@hotmail.com";
    $commissionName = $_GET['commissionName'];
    $name = $user->data()->name . " ";
    if($user->data()->surname_prefix){
        $name = $name . $user->data()->surname_prefix . " ";
    }
    $name = $name . $user->data()->surname;
    $subject =  $name ." heeft op extra info geklikt";
    $title = $name . " heeft op extra info geklikt";
    $text = 'Er is op extra info geklikt bij de commissie: ' . $commissionName . '.<br>
                 <h2>' . $name . '</h2>
                 <p>Gebruikersnaam: ' . $user->data()->username . '<br><br>Email: ' . $user->data()->mail . '</p>';
    email($to, $subject, $title, $text);
    echo "<h3>De inschrijving is gelukt</h3><br>";
}