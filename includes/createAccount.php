<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
$size = 5242880;
if($user->isLoggedIn() && $user->hasPermission('admin')){
    if(!empty($_POST['name']) && isset($_POST['name'])
                            && !empty($_POST['surname']) && isset($_POST['surname'])
                            && !empty($_POST['email']) && isset($_POST['email'])
                            && isset($_POST['team']) && is_numeric($_POST['team'])
                            && isset($_POST['trainer']) && is_numeric($_POST['trainer'])
                            && !empty($_POST['gender']) && isset($_POST['gender'])
                            && !empty($_POST['birthday']) && isset($_POST['birthday'])
                            && !empty($_FILES['icon']) && isset($_FILES['icon'])){
        $name = str_replace(' ', '.', trim($_POST['name']));
        $surname_prefix = (!empty($_POST['surname_prefix']) && isset($_POST['surname_prefix'])) ? str_replace(' ', '.', trim($_POST['surname_prefix'])) : null;
        $surname = str_replace(' ', '.', trim($_POST['surname']));
        $email = trim($_POST['email']);
        $team = trim($_POST['team']);
        $trainer = trim($_POST['trainer']);
        $gender = trim($_POST['gender']);
        $birthday = date("Y-m-d", strtotime(trim($_POST['birthday'])));
        $icon = $_FILES['icon'];

        $username = $surname_prefix ? $name.'.'.$surname_prefix.'.'.$surname : $name.'.'.$surname;
        $username = strtolower($username);

        $users = $db->query("SELECT * FROM users WHERE username = '". escape($username) ."'");
        if(!$users->count()){
            if($gender === 'M' || $gender === 'F'){
                if($birthday){
                    $allowed = array('jpg', 'jpeg', 'pjpeg', 'png');
                    $file_tmp = $icon['tmp_name'];
                    $file_size = $icon['size'];
                    $file_error = $icon['error'];
                    $file_ext = pathinfo($icon['name'], PATHINFO_EXTENSION);
                    $file_name = basename($icon['name'], ".".$file_ext);
                    if(in_array($file_ext, $allowed)) {
                        if ($file_error === 0) {
                            if ($file_size <= $size) {
                                if(!is_dir("../images/icons/") && !file_exists("../images/icons/")){
                                    mkdir("../images/icons", 0777);
                                }
                                $file_path = "../images/icons/" . $username . "." . $file_ext;
                                if(move_uploaded_file($file_tmp, $file_path)){
                                    $salt = Hash::salt(32);
                                    $db->insert('users', array(
                                        'username' => $username,
                                        'password' => Hash::make($birthday, $salt),
                                        'mail' => $email,
                                        'salt' => $salt,
                                        'name' => $name,
                                        'surname_prefix' => $surname_prefix,
                                        'surname' => $surname,
                                        'joined' => date('Y-m-d H:i:s'),
                                        'IconPath' => $file_path,
                                        'gender' => $gender,
                                        'birthdate' => $birthday,
                                        'group_id' => 2
                                    ));
                                    if($team){
                                        $newuser = $db->query("SELECT id FROM users WHERE username = '". escape($username) ."'")->first();
                                        $db->insert('players', array(
                                            'team_id' => $team,
                                            'user_id' => $newuser->id
                                        ));
                                    }
                                    if($trainer){
                                        $newuser = $db->query("SELECT id FROM users WHERE username = '". escape($username) ."'")->first();
                                        $db->insert('trainers', array(
                                            'team_id' => $trainer,
                                            'user_id' => $newuser->id
                                        ));
                                    }
                                    echo "<h3>New account gemaakt:</h3>";
                                    echo "<p>Gebruikersnaam: " . $username . "</p>";
                                    echo "<p>Wachtwoord: " . $birthday . "</p>";
                                    $to = "martijn13795@hotmail.com";
                                    $subject = "Uw account voor EKC 2000 is aangemaakt";
                                    $title = "Hallo " . $name . " " . $surname . ",";
                                    $text = '<h3>Uw account voor de website van EKC 2000 is aangemaakt.</h3>
                                            <p>Uw gebruikersnaam is: '. $username .'</p>
                                            <p>Uw wachtwoord is: '. $birthday .'</p><br>
                                            <h3>Waarom heb ik een account?</h3>
                                            <p>Met het account voor de website van EKC 2000 kun je een aantal dingen doen.</p>
                                            <p><ul>
                                              <li>Chatten in de chatbox</li>
                                              <li>Idee&euml;n uploaden</li>
                                              <li>Documenten bekijken</li>
                                              <li>Uw profiel pagina bezoeken</li>
                                              <li>Uw wachtwoord veranderen</li>
                                            </ul></p>
                                            <p>Natuurlijk worden er nog meer dingen met de accounts gedaan, maar dat is vooral achter de schermen.</p>
                                            <p>log nu in op <a href="http://www.ekc2000.nl/inloggen">ekc2000.nl</a>.</p>';
                                    email($to, $subject, $title, $text);
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
                    echo "<h3>Er is wat mis gegaan bij de geboortedatum. Probeer het opnieuw.</h3><br>";
                }
            } else {
                echo "<h3>Er is wat mis gegaan bij het geslacht. Probeer het opnieuw.</h3><br>";
            }
        } else {
            echo "<h3>Er is wat mis gegaan. Dit account bestaat al:</h3>";
            echo "<p><b>Gebruikersnaam</b>: " . $users->first()->username . "</p>";
            echo "<p><b>Voornaam</b>: " . $users->first()->name . "</p>";
            if($users->first()->surname_prefix){
                echo "<p><b>Tussenvoegsel</b>: " . $users->first()->surname_prefix . "</p>";
            }
            echo "<p><b>Achternaam</b>: " . $users->first()->surname . "</p>";
            echo "<p><b>Geboortedatum</b>: " . $users->first()->birthdate . "</p>";
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