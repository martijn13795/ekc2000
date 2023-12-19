<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();

if($user->isLoggedIn()) {
    if(Input::exists()){
        if(Token::check(Input::get('token'))){
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'old_password' => array(
                    'required' => true
                ),
                'new_password' => array(
                    'required' => true,
                    'min' => 6
                ),
                'new_password_repeat' => array(
                    'required' => true,
                    'min' => 6,
                    'matches' => 'new_password'
                )
            ));

            if($validation->passed()){
                //change pass
                if (!password_verify(trim(Input::get('old_password')), $user->data()->password)) {
                    echo 'Uw oude wachtwoord is verkeerd.';
                } else {
                    $salt = Hash::salt(32);
                    $db->update('users', $user->data()->id, array(
                        'password' => Hash::make(Input::get('new_password')),
                        'salt' => $salt
                    ));
                    ?>
                    <script>
                        $("#refresh").show();
                    </script>
                    <?php
                    echo "<h3>Uw wachtwoord is veranderd</h3>";
                    $to = $user->data()->mail;
                    $subject = "Uw wachtwoord is gewijzigd";
                    $title = "Hallo " . $user->data()->name . " " . $user->data()->surname . ",";
                    $text = '<h3>Uw wachtwoord is gewijzigd.</h3>
                                            <p>Uw gebruikersnaam is: '. $user->data()->username .'</p>
                                            <p>Uw wachtwoord is: '. $_POST['new_password'] .'</p><br>
                                            <p>log nu in op <a href="https://ekc2000.nl/inloggen">ekc2000.nl</a>.</p>';
                    email($to, $subject, $title, $text);
                }
            } else {
                ?>
                    <script>
                    $("#submit").show();
                    </script>
                <?php
                foreach($validation->errors() as $error){
                    echo '<p>' . $error . '</p>';
                }
            }

        }
    }
}