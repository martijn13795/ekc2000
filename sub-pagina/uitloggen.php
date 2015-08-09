<!--
Cas van Dinter
384755
-->
<?php
include '../includes/html.php';

$user = new User();
$user->logout();

Redirect::to('/home');