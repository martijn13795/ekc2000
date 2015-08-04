<?php
        $servername = "94.213.96.73";
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