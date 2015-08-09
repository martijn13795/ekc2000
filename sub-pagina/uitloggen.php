<!--
Cas van Dinter
384755
-->
<?php
include '../includes/html.php';

$user = new User();
if($user->isLoggedIn()) {
    $user->logout();
}
Redirect::to('/home');