<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('imageupload'))) {
    $size = 5242880;
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

    function image_fix_orientation($filename)
    {
        $exif = exif_read_data($filename);
        if (!empty($exif['Orientation'])) {
            $image = imagecreatefromjpeg($filename);
            switch ($exif['Orientation']) {
                case 3:
                    $image = imagerotate($image, 180, 0);
                    break;

                case 6:
                    $image = imagerotate($image, -90, 0);
                    break;

                case 8:
                    $image = imagerotate($image, 90, 0);
                    break;
            }

            imagejpeg($image, $filename, 90);
        }
    }

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    if (!empty(trim($_POST['name'])) && isset($_POST['name'])) {
        $album_name = $_POST['name'];
        if (preg_match("#^[a-zA-Z0-9 '!' '?' ',' '.' ' ' '(' ')' ':' '\-' '_' '=' '\'' '\"' '%']+$#", $album_name)) {
            if (count($_FILES['files']['name']) <= 50) {
                $album_name = rawurlencode($album_name);
                $album_name = str_replace("%", "XY", $album_name);
                if (!empty($_FILES['files']['name'][0])) {
                    $files = $_FILES['files'];
                    $allowed = array('jpg', 'JPG', 'jpeg', 'JPEG', 'pjpeg', 'PJPEG', 'png', 'PNG');
                    $count = 0;

                    foreach ($files['name'] as $position => $file_name) {
                        $file_tmp = $files['tmp_name'][$position];
                        $file_size = $files['size'][$position];
                        $file_error = $files['error'][$position];

                        image_fix_orientation($file_tmp);

                        $file_ext = pathinfo($files['name'][$position], PATHINFO_EXTENSION);
                        $file_name = basename($file_name, "." . $file_ext);
                        if (in_array($file_ext, $allowed)) {
                            if ($file_error === 0) {
                                if ($file_size <= $size) {
                                    $album_id = null;
                                    if ($db->query("SELECT * FROM albums WHERE name = '$album_name'")->count()) {
                                        $album_id = $db->query("SELECT * FROM albums WHERE name = '$album_name'")->first()->id;
                                        $db->update('albums', $album_id, array(
                                            'date' => date("Y-m-d H:i:s")
                                        ));
                                    } else {
                                        $db->insert('albums', array(
                                            'user_id' => $user->data()->id,
                                            'name' => $album_name,
                                            'date' => date("Y-m-d H:i:s")
                                        ));
                                        $album_id = $db->query("SELECT * FROM albums WHERE name = '$album_name'")->first()->id;
                                    }
                                    if (!is_dir("../images/gallerij/" . $album_name . "/") && !file_exists("../images/gallerij/" . $album_name . "/")) {
                                        mkdir("../images/gallerij/" . $album_name, 0777);
                                    }
                                    $file_name_new = str_replace(' ', '-', $file_name);
                                    $file_path = "../images/gallerij/" . $album_name . "/" . $file_name_new . "." . $file_ext;
                                    if (file_exists($file_path) || $db->query("SELECT * FROM pictures WHERE album_id = '$album_id' AND path = '$file_path'")->count()) {
                                        $i = 1;
                                        while (file_exists($file_path) || $db->query("SELECT * FROM pictures WHERE album_id = '$album_id' AND path = '$file_path'")->count()) {
                                            $file_path = "../images/gallerij/" . $album_name . "/" . $file_name_new . "_" . $i . "." . $file_ext;
                                            $i++;
                                        }
                                    }
                                    $file_path_mobile = "../images/gallerij/" . $album_name . "/mobile_" . $file_name_new . "." . $file_ext;
                                    if (file_exists($file_path_mobile) || $db->query("SELECT * FROM pictures WHERE album_id = '$album_id' AND pathMobile = '$file_path'")->count()) {
                                        $i = 1;
                                        while (file_exists($file_path_mobile) || $db->query("SELECT * FROM pictures WHERE album_id = '$album_id' AND pathMobile = '$file_path'")->count()) {
                                            $file_path_mobile = "../images/gallerij/" . $album_name . "/mobile_" . $file_name_new . "_" . $i . "." . $file_ext;
                                            $i++;
                                        }
                                    }
                                    if (move_uploaded_file($file_tmp, $file_path)) {
                                        $count++;
                                        $wmax = 1024;
                                        $hmax = 1080;
                                        imgResize($file_path, $file_path_mobile, $wmax, $hmax, $file_ext);
                                        $db->insert('pictures', array(
                                            'user_id' => $user->data()->id,
                                            'album_id' => $album_id,
                                            'name' => $file_name_new,
                                            'date' => date("Y-m-d H:i:s"),
                                            'path' => $file_path,
                                            'pathMobile' => $file_path_mobile
                                        ));
                                        $db->update('albums', $album_id, array(
                                            'date' => date("Y-m-d H:i:s")
                                        ));
                                        echo "<b>" . $file_name . "</b> <font color='green'>>Uploaden voltooid.</font><br>";

                                        if ($count <= 1) {
                                            $emails = $db->query("SELECT mail, name FROM users WHERE albums = '1'");
                                            if ($emails->count()) {
                                                $name = $_POST['name'];
                                                $subject = "Nieuw album: " . $name;
                                                $title = $name . ".";

                                                foreach ($emails->results() as $email) {
                                                    $userName = $email->name;
                                                    $text = 'Hallo ' . $userName . ',<br><br>' . 'Er is een nieuw album geüpload: ' . $name . '.<br>' . 'Bekijk hem nu: <a target="_blank" href="https://ekc2000.nl/album/' . $album_name . '">https://ekc2000.nl/album/' . $album_name . '</a><br>';
                                                    $to = $email->mail;
                                                    email($to, $subject, $title, $text);
                                                }
                                            }
                                        }

                                    } else {
                                        echo "<b>" . $file_name . "</b> <font color='red'>>Uploaden mislukt.</font><br>";
                                    }
                                } else {
                                    echo "<b>" . $file_name . "</b> <font color='red'>>Is te groot: </font>" . formatSizeUnits($file_size) . " / " . formatSizeUnits($size) . "<br>";
                                }
                            } else {
                                echo "<b>" . $file_name . "</b> <font color='red'>>Error: </font>" . $file_error . "<br>";
                            }
                        } else {
                            echo "<b>" . $file_name . "</b> <font color='red'>>Kies een ander bestand type dan: </font>" . $file_ext . "<br>";
                        }
                    }
                } else {
                    echo "Voer iets in";
                }
            } else {
                echo "<h3>Upload minder dan 50 afbeeldingen in 1 keer</h3><br>";
                echo "Dit vermindert fouten<br><br>";
            }
        } else {
            $album_name = null;
            echo "<h3>Voer een geldig bericht in</h3><br>";
            echo "Karakters die u kunt gebruiken zijn: a-z A-Z 0-9 . , ? ! ( ) : = - _ ' \" %<br><br>";
        }
    } else {
        echo "<h3>Voer een geldig bericht in</h3><br>";
    }
}