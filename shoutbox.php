<?php

    $host = "ekc2000.party";
    $user = "ekc2000";
    $pass = "xH2b8C5PnajhnXJ5";
    $data = "ekc2000";

    mysql_connect($host, $user, $pass)or die('Database connectie kan niet worden gemaakt');
    mysql_select_db($data)or die('database kan niet worden gevonden');

    if($_POST){
        $shout = $_POST['user_shout'];
        if (!empty($shout) && $shout != ""){
            mysql_query("INSERT INTO shouts(shout) VALUES( '". $shout ."')");
        }
        echo "Gepost";
    }else{
        $query = mysql_query("SELECT id, shout FROM shouts ORDER BY id DESC");
        while( $fetch= mysql_fetch_assoc($query)){
            echo $fetch['shout'] . '</br>';
        }
    }