<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();

function imgResize($target, $newcopy, $w, $h, $ext)
{
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
        $w = $h * $scale_ratio;
    } else {
        $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "png") {
        $img = imagecreatefrompng($target);
    } else {
        $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 80);
}

$albumName = $_POST['name'];
$date = date("Y-m-d");

if (!preg_match("#^[a-zA-Z0-9 '!' ',' '.' '(' ')' '_' '+' ' ' '*']+$#", $albumName)) {
    $albumName = null;
    echo "<h3>Voer een geldig bericht in</h3></br>";
    echo "Characters die u kunt gebruiken zijn: a-z A-Z 0-9 . , ! ( ) - _ + *";
} else {
    $albumName = str_replace(' ', '-', $albumName);
    if (!empty($_FILES['files']['name'][0]) || !empty($albumName)) {

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

                    if ($file_size <= 5242880) {
                        if (!$db->query("SELECT name FROM galleries WHERE name = '$albumName'")->count()) {
                            $db->query("INSERT INTO galleries (name, date) VALUES ('$albumName', '$date')");
                        }

                        $file_name_new = $file_name;
                        $file_name_new = str_replace(' ', '-', $file_name_new);
                        if (!$db->query("SELECT path FROM galleries WHERE name='$albumName' AND path LIKE '%{$file_name_new}%'")->count()) {

                            if (file_exists("../images/fotogalerij/" . $albumName . "/")) {
                            } else {
                                mkdir("../images/fotogalerij/" . $albumName, 0777);
                            }

                            $file_destination = '../images/fotogalerij/' . $albumName . "/" . $file_name_new;

                            $selects = $db->query("SELECT path FROM galleries WHERE name='$albumName'");
                            foreach ($selects->results() as $select) {
                                $fileLocation = $select->path;
                            }

                            $db->query("update galleries set path='$fileLocation $file_destination ' WHERE name='$albumName';");

                            if (move_uploaded_file($file_tmp, $file_destination)) {
                                $uploaded[$position] = $file_destination;

                                $target_file = "../images/fotogalerij/" . $albumName . "/" . $file_name_new;
                                $resized_file = "../images/fotogalerij/" . $albumName . "/mobile_" . $file_name_new;
                                $wmax = 1024;
                                $hmax = 1080;
                                imgResize($target_file, $resized_file, $wmax, $hmax, $file_ext);

                                $selects = $db->query("SELECT pathMobile FROM galleries WHERE name='$albumName'");
                                foreach ($selects->results() as $select) {
                                    $fileLocation = $select->pathMobile;
                                }

                                $db->query("update galleries set pathMobile='$fileLocation $resized_file ' WHERE name='$albumName';");

                            } else {
                                $failed[$position] = $file_name . ", uploaden mislukt" . "<br>";
                            }
                        } else {
                            $failed[$position] = $file_name . " bestaat al" . "<br>";
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
}

if (!$uploaded == 0) {
    echo "<h3>Deze bestanden zijn geupload</h3>";
    foreach ($uploaded as $upload) {
        $upload = end(explode('/', $upload));
        echo $upload . "<br>";
    }
}

if (!$failed == 0) {
    echo "<h3>Deze bestanden zijn niet geupload</h3>";
    foreach ($failed as $fail) {
        echo $fail . "<br>";
    }
}