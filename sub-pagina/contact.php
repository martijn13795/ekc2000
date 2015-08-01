<?php include '../includes/html.php';?>
    <div class="container">
        <h1>Contact</h1><hr>
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <form action="" method="post">
                    <label>Naam: </label><input type="text" class="form-control contactMargin" name="name" placeholder="Naam" REQUIRED><br>
                    <label>Email: </label><input type="email" class="form-control contactMargin" name="email" placeholder="Email" REQUIRED><br>
                    <label>Bericht: </label><textarea rows="6" class="form-control contactMargin" placeholder="Type hier uw bericht..." maxlength="2000" REQUIRED></textarea><br>
                    <input type="submit" name="submit" value="Verstuur" class="btn btn-primary pull-right"><br><br><br>
                </form>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="col-md-12 col-xs-12 well">
                    <h3>Contact informatie <strong>EKC 2000</strong></h3><hr>
                    <h3><strong>Veld</strong></h3>
                    <p class="lead">
                        Straat: zwanenveld 5<br>
                        Postcode: 7827 XA Emmen<br>
                        Telefoonnummer: 0591-617979
                    </p>
                    <h3><strong>Zaal</strong></h3>
                    <p class="lead">
                        Straat: Calthornerbrink<br>
                        Postcode: 7812 HS Emmen<br>
                        Telefoonnummer: 0591-618868
                    </p>
                </div>
            </div>
        </div>
    </div>