<!--
Cas van Dinter
384755
-->
<?php

session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '94.213.96.73',
        'username' => 'ekc2000',
        'password' => 'xH2b8C5PnajhnXJ5',
        'db' => 'ekc'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

spl_autoload_register(function($class) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class . '.php';
});

require_once $_SERVER['DOCUMENT_ROOT'] .  '/functions/sanitize.php';

if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->query("SELECT * FROM users_session WHERE " . Config::get('remember/cookie_name') . " = '{$hash}'");
    
    if($hashCheck->count()) {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}