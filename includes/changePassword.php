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
                if(Hash::make(Input::get('old_password'), $user->data()->salt) !== $user->data()->password){
                    echo 'Uw oude wachtwoord is verkeerd.';
                } else {
                    $salt = Hash::salt(32);
                    $db->update('users', $user->data()->id, array(
                        'password' => Hash::make(Input::get('new_password'), $salt),
                        'salt' => $salt
                    ));
                    Redirect::to('/profile');
                }
            } else {
                foreach($validation->errors() as $error){
                    echo '<p>' . $error . '</p>';
                }
            }

        }
    }
}