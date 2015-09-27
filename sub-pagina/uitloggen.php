<?php
include '../includes/html.php';

$user = new User();
if($user->isLoggedIn()) {
    $user->logout();
    echo '<script>
                 var logedout = "ja";
                 localStorage.setItem("logedout", logedout);
                 window.location.href = "/home";
          </script>';
}