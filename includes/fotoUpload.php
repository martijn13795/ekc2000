<?php
if(!empty($_FILES['files']['name'][0])) {

    $files = $_FILES['files'];

    $uploaded = array();
    $failed = array();

    $allowed = array('jpg', 'jpeg', 'png');

    foreach($files['name'] as $position => $file_name) {

        $file_tmp = $files['tmp_name'][$position];
        $file_size = $files['size'][$position];
        $file_error = $files['error'][$position];

        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        if(in_array($file_ext, $allowed)) {

            if($file_error === 0) {

                if($file_size <= 209715200) {

                    $file_name_new = $file_name;
                    $albumName = $_POST['name'];
                    if (file_exists("../images/fotogalerij/" . $albumName . "/")){}
                    else {
                        mkdir("../images/fotogalerij/" . $albumName, 0777);
                    }
                    $file_destination = '../images/fotogalerij/' . $albumName . "/" . $file_name_new;

                    if(move_uploaded_file($file_tmp, $file_destination)) {
                        $uploaded[$position] = $file_destination;
                    } else {
                        $failed[$position] = $file_name . ", uploaden mislukt";
                    }

                } else {
                    $failed[$position] = $file_name . "is te groot";
                }

            } else {
                $failed[$position] = $file_name . "error" . $file_error;
            }

        } else {
            $failed[$position] = $file_name . "kies een ander bestand type" . $file_ext;
        }
    }

    if(!empty($uploaded)) {
        print_r($uploaded);
    }

    if (!empty($failed)) {
        print_r($failed);
    }
}