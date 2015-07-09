<?php include '../includes/html.php';?>
    <div class="container">
        <div class="row-fluid inloggenDiv">
            <div class="col-md-4 col-md-offset-4 well">
                <legend>Inloggen</legend>
                <div class="form-group">
                    <form method="POST" action="../sub-pagina/inloggen.php" accept-charset="UTF-8">
                        <input type="text" id="username" class="form-control" name="username" placeholder="Gebruikersnaam"><br />
                        <input type="password" id="password" class="form-control" name="password" placeholder="Wachtwoord"><br />
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Inloggen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>