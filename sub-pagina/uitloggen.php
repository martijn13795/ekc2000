<!--
Cas van Dinter
384755
-->
<?php
include '../includes/html.php';

$user = new User();
if($user->isLoggedIn()) {
    $user->logout();
    echo '<script>
                 var logedout = "ja";
                 localStorage.setItem("logedout", logedout);
                 history.go(-1);
          </script>';
}