<?php
$servername = "192.168.1.145";
$username = "ekc2000";
$password = "xH2b8C5PnajhnXJ5";
$dbName = "ekc2000";

$conn = mysql_connect($servername, $username, $password);

if (!$conn) {
    die("connection failed: " .mysql_error());
}

$db_selected = mysql_select_db("ekc2000", $conn);

if (!$db_selected) {
    die('kan de database niet vinden' . mysql_error());
}

$value = $_POST['message'];

$sql = "INSERT INTO chatbox (message) VALUES ('$value')";

if (!mysql_query($sql)){
    die(mysql_error());
}

$select = mysql_query('SELECT * FROM chatbox');

while($selecting = mysql_fetch_array($select)){
    echo $selecting['message'];
}

mysql_close();
?>