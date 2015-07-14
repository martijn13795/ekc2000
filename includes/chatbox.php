<?php
    include_once('db.php');

    $message = $_POST['message'];

if ($_POST['message'] == null || $_POST['message'] == ""){
    echo "voer een bericht in";
}else {

    if(mysql_query("INSERT INTO chatbox (message) VALUES ('$message')")) {
        echo "Successfully";
    }else {
        echo "insertion failed";
    }

//    $select = mysql_query('SELECT * FROM chatbox');
//
//    while ($selecting = mysql_fetch_array($select)) {
//        echo $selecting['message'];
//        echo "</br>";
//    }
}

mysql_close();
?>