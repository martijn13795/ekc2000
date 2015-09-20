<?php include '../includes/html.php';?>
<?php
$user = new User();
if ($user->isLoggedIn()) {
?>
    <div class="container">
        <div class="col-md-12 col-xs-12"><h2>Welkom, gebruiker<button class="btn btn-primary logoutButton" onclick="location.href='/uitloggen';"><i class="fa fa-sign-out"></i>Uitloggen</button></h2><hr></div>
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <div class="col-md-12 col-xs-12">
                    <img class="img-responsive avatarDiv" src="../images/icons/default.jpg" alt="avatar"/>
                    <button class="btn btn-warning">Verander</button><br><br>
                </div>
            </div>
            <div class="col-md-offset-1 col-md-7 col-xs-12 well">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <h3>Gebruikersnaam:</h3>
                        <p>Gebruikersnaam</p>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <h3>Wachtwoord:</h3>
                        <p>Wachtwoord</p>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <h3>Voornaam:</h3>
                        <p>Voornaam</p>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <h3>Achternaam:</h3>
                        <p>Achternaam</p>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <h3>Email:</h3>
                        <p>Email</p>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <h3></h3>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>