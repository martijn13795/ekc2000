<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
$size = 5242880;
if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('teamcreate'))) {
    if(!empty($_POST['name']) && isset($_POST['name'])
        && !empty($_POST['day1']) && isset($_POST['day1'])
        && !empty($_POST['begin1']) && isset($_POST['begin1'])
        && !empty($_POST['end1']) && isset($_POST['end1'])
        && !empty($_POST['location1']) && isset($_POST['location1'])
        && !empty($_FILES['icon']) && isset($_FILES['icon'])){
        $name = $_POST['name'];
        $icon = $_FILES['icon'];
        $day1 = $_POST['day1'];
        $begin1 = $_POST['begin1'];
        $end1 = $_POST['end1'];
        $location1 = $_POST['location1'];
        $day2 = isset($_POST['day2']) ? $_POST['day2'] : false;
        $begin2 = isset($_POST['begin2']) ? $_POST['begin2'] : false;
        $end2 = isset($_POST['end2']) ? $_POST['end2'] : false;
        $location2 = isset($_POST['location2']) ? $_POST['location2'] : false;
        $day3 = isset($_POST['day3']) ? $_POST['day3'] : false;
        $begin3 = isset($_POST['begin3']) ? $_POST['begin3'] : false;
        $end3 = isset($_POST['end3']) ? $_POST['end3'] : false;
        $location3 = isset($_POST['location3']) ? $_POST['location3'] : false;

        $teams = $db->query("SELECT * FROM teams WHERE name = '". escape($name) ."'");
        if(!$teams->count()){
            if ($begin1 < $end1 && ($begin2 < $end2 | ($begin2 == false && $end2 == false )) && ($begin3 < $end3 | ($begin3 == false && $end3 == false ))) {
                $allowed = array('jpg', 'jpeg', 'pjpeg', 'png');
                $file_tmp = $icon['tmp_name'];
                $file_size = $icon['size'];
                $file_error = $icon['error'];
                $file_ext = pathinfo($icon['name'], PATHINFO_EXTENSION);
                $file_name = basename($icon['name'], "." . $file_ext);
                if (in_array($file_ext, $allowed)) {
                    if ($file_error === 0) {
                        if ($file_size <= $size) {
                            if (!is_dir("../images/teams/") && !file_exists("../images/teams/")) {
                                mkdir("../images/teams", 0777);
                            }
                            $file_path = "../images/teams/" . $name . "." . $file_ext;
                            if (move_uploaded_file($file_tmp, $file_path)) {
                                $db->insert('teams', array(
                                    'name' => $name,
                                    'path' => $file_path
                                ));
                                if ($day1) {
                                    $team = $db->query("SELECT id FROM teams WHERE name = '" . escape($name) . "'")->first();
                                    $db->insert('schedules', array(
                                        'team_id' => $team->id,
                                        'day_id' => $day1,
                                        'start' => $begin1,
                                        'end' => $end1,
                                        'location' => $location1
                                    ));
                                }
                                if ($day2) {
                                    $team = $db->query("SELECT id FROM teams WHERE name = '" . escape($name) . "'")->first();
                                    $db->insert('schedules', array(
                                        'team_id' => $team->id,
                                        'day_id' => $day2,
                                        'start' => $begin2,
                                        'end' => $end2,
                                        'location' => $location2
                                    ));
                                }
                                if ($day3) {
                                    $team = $db->query("SELECT id FROM teams WHERE name = '" . escape($name) . "'")->first();
                                    $db->insert('schedules', array(
                                        'team_id' => $team->id,
                                        'day_id' => $day3,
                                        'start' => $begin3,
                                        'end' => $end3,
                                        'location' => $location3
                                    ));
                                }
                                echo "<h3>Team gemaakt</h3>";
                            } else {
                                echo "<b>" . $file_name . "</b> <font color='red'>>Uploaden mislukt.</font><br>";
                                echo "<p>Er is wat mis gegaan bij het uploaden. Probeer het opnieuw.</p><br>";
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
            } else {
                echo "<h3>Foutieve begintijd</h3>";
            }
        } else {
            echo "<h3>Er is wat mis gegaan. Dit team bestaat al</h3>";
        }
    } else {
        echo "<h3>Er is wat mis gegaan. Probeer het opnieuw.</h3><br>";
    }
}

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}