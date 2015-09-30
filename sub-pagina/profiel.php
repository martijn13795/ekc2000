<?php include '../includes/html.php';?>
<?php
$user = new User();
if ($user->isLoggedIn()) {
?>
    <div class="container">
        <div class="col-md-12 col-xs-12"><h2>Welkom, <?php echo $user->data()->name; ?><button class="btn btn-primary logoutButton hidden-xs" onclick="location.href='/uitloggen';"><i class="fa fa-sign-out"></i>Uitloggen</button></h2><hr></div>
        <div class="row">
            <div class="col-md-5 col-xs-12">
                <div class="col-md-12 col-xs-12">
                    <img class="img-responsive avatarDiv" src="../<?php echo $user->data()->IconPath; ?>" alt="avatar"/><br>
                    <button class="btn btn-primary col-xs-12 logoutButton hidden visible-xs" onclick="location.href='/uitloggen';"><i class="fa fa-sign-out"></i>Uitloggen</button><br><br><br>
                </div>
            </div>
            <div class="col-md-7 col-xs-12">
                <div class="col-md-12 col-xs-12 well">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <h3>Gebruikersnaam:</h3>
                            <p><?php echo $user->data()->username; ?></p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h3>Wachtwoord:</h3>
                            <p>&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;</p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h3>Voornaam:</h3>
                            <p><?php $name = $user->data()->name; $names = explode(" ", $name); echo $names[0]; ?></p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h3>Achternaam:</h3>
                            <p><?php $name = $user->data()->name; $names = explode(" ", $name, 2); echo $names[1]; ?></p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h3>Email:</h3>
                            <p><?php echo $user->data()->mail; ?></p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h3></h3>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>