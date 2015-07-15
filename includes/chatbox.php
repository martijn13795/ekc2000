<?php
    include_once('db.php');

    $message = $_POST['message'];
    $date = $mysql_date_now = date("Y-m-d H:i:s");

if($_POST['message'] == null || $_POST['message'] == "" || $_POST['message'] == " ") {
    echo "<h3>Voer een bericht in</h3>";
}else {
    if (!preg_match("#^[a-zA-Z0-9 '!' '?' ',' '.' '@' ' ' '%' '&' '(' ')' '/' ':' '-' '_']+$#", $message)) {
        $message = null;
        echo "<h3>Voer een geldig bericht in</h3></br>";
        echo "Characters die u kunt gebruiken zijn: a-z A-Z 0-9 . , ? ! ( ) / : - _ @ % &";
    } else {

        if (mysql_query("INSERT INTO chatbox (message, dateTime) VALUES ('$message', '$date')")) {

        } else {
            echo "Er ging iets mis";
        }
    }
}
mysql_close();