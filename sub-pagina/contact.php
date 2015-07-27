<?php include '../includes/html.php';?>
    <div class="container">
        <h1>Contact</h1><hr>
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <form action="" method="post">
                    <label>Naam: </label><input type="text" class="form-control contactMargin" name="name" placeholder="Naam" REQUIRED><br>
                    <label>Email: </label><input type="email" class="form-control contactMargin" name="email" placeholder="Email" REQUIRED><br>
                    <label>Bericht: </label><textarea rows="6" class="form-control contactMargin" placeholder="Type hier uw bericht..." REQUIRED></textarea><br>
                    <input type="submit" name="submit" value="Verstuur" class="btn btn-primary pull-right">
                </form>
            </div>
            <div class="col-md-4 col-xs-12 well">
                <h3>Contact informatie <strong>EKC 2000</strong></h3><hr>
                <p class="lead">
                    Straat: zwanenveld 5<br>
                    Postcode: 7827 XA<br>
                    Plaats: Emmen<br>
                    Telefoonnummer: 0591-617979<br>
                    Email: ekc2000.emmen@knkv.nl</p>
            </div>
        </div>
    </div>