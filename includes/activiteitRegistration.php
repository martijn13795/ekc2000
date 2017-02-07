<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$activiteitName = $_POST['activiteitName'];
$activiteitName = rawurldecode($activiteitName);
$name = $_POST['name'];
$userName = $_POST['userName'];
$userEmail = $_POST['userEmail'];
$optionalText = $_POST['optionalText'];
$to = $_POST['email'];
$subject = "Nieuwe opgave: " . $activiteitName;
$title = "Nieuwe opgave: ". $activiteitName;
$text = 'Er is een nieuwe opgave voor de activiteit: "' . $activiteitName . '".<br>
                 <h2>' . $name . '</h2>
                 <h4>Eventuele toevoegingen:</h4><p>- ' . $optionalText . '</p><br><sub>(' . $userName . ', ' . $userEmail . ')</sub>';
email($to, $subject, $title, $text);
echo "<h3>De inschrijving is gelukt</h3><br>";