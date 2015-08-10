<?php
include_once('db.php');

    $albumName = $_POST['name'];
    $date = $mysql_date_now = date("Y-m-d");

if (!preg_match("#^[a-zA-Z0-9 '!' ',' '.' '(' ')' '_' '+' ' ' '*']+$#", $albumName)) {
    $albumName = null;
    echo "<h3>Voer een geldig bericht in</h3></br>";
    echo "Characters die u kunt gebruiken zijn: a-z A-Z 0-9 . , ! ( ) - _ + *";
}else {
    $albumName = str_replace(' ', '-', $albumName);
    if (!empty($_FILES['files']['name'][0])) {

        $files = $_FILES['files'];

        $uploaded = array();
        $failed = array();

        $allowed = array('jpg', 'jpeg', 'png');

        foreach ($files['name'] as $position => $file_name) {

            $file_tmp = $files['tmp_name'][$position];
            $file_size = $files['size'][$position];
            $file_error = $files['error'][$position];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            if (in_array($file_ext, $allowed)) {

                if ($file_error === 0) {

                    if ($file_size <= 4097152) {
                        $result = mysql_query("SELECT albumName FROM fotogalerij WHERE albumName='$albumName';");
                        if (mysql_num_rows($result) == 0) {
                            $sql = mysql_query("INSERT INTO fotogalerij (albumName, date) VALUES ('$albumName', '$date')");
                        }
                        $file_name_new = $file_name;
                        if (file_exists("../images/fotogalerij/" . $albumName . "/")) {
                        } else {
                            mkdir("../images/fotogalerij/" . $albumName, 0777);
                        }
                        $file_destination = '../images/fotogalerij/' . $albumName . "/" . $file_name_new;

                        $select = mysql_query('SELECT imgPath FROM fotogalerij');
                        while ($selecting = mysql_fetch_array($select)) {
                            $fileLocation = $selecting['imgPath'];
                        }

                        $sql = mysql_query("update fotogalerij set imgPath='$fileLocation $file_destination ' WHERE albumName='$albumName';");

                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            $uploaded[$position] = $file_destination;
                        } else {
                            $failed[$position] = $file_name . ", uploaden mislukt" . "<br>";
                        }

                    } else {
                        $failed[$position] = $file_name . " is te groot" . "<br>";
                    }

                } else {
                    $failed[$position] = $file_name . " error " . $file_error . "<br>";
                }

            } else {
                $failed[$position] = $file_name . "<br>Kies een ander bestand type dan " . $file_ext . "<br>";
            }
        }
    } else {
        echo "Voer iets in";
    }

    if (!$uploaded == 0) {
        echo "<h3>Deze bestanden zijn geupload</h3>";
        foreach ($uploaded as $upload) {
            echo $upload . "<br>";
        }
    }

    if (!$failed == 0) {
        echo "<h3>Deze bestanden zijn niet geupload</h3>";
        foreach ($failed as $fail) {
            echo $fail . "<br>";
        }
    }
}

mysql_close();