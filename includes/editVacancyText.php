<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if ($user->isLoggedIn()) {
    $id = $_GET['id'];
    if (isset($_POST['editor1']) && !empty($_POST['editor1'])) {
        $text = $_POST['editor1'];
        $db->update('commissions', $id, array(
            'vacancyText' => $text
        ));
        echo "<h3>Het bewerken is voltooid</h3>";
        echo "Ga terug naar de pagina<br><br>";
    } else {
        echo "<h3>Het tekst vlak is leeg</h3><br>";
    }
}