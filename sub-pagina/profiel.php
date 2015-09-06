<?php include '../includes/html.php';?>
<div class="container">
    <?php
    $user = new User();
    if ($user->isLoggedIn()) {
        ?>
            <button class="btn btn-primary" onclick="location.href='/uitloggen';"><i class="fa fa-sign-out"></i>Uitloggen</button>
        <?php
    }
    ?>
</div>