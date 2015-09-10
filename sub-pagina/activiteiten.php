<?php include '../includes/html.php';?>
<script src="../ckeditor/ckeditor.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<div class="container"><br>
    <?php
    $user = new User();
    if ($user->isLoggedIn()) {
        ?>
        <div class="hidden visible-lg">
            <div class="col-md-12 well">
                <h2>Legenda</h2>
                <h3>Zorg ervoor dat het er goed uitziet in de editor<br>
                    Zoals het daar staat komt het ook op de website te staan</h3><hr>
                <p>
                    Om een enter zonder wit regel te maken dient er op Shift + Enter te worden gedrukt.<br><br>
                    Om een afbeelding te uploaden klik je op onderstaand icoon
                <div style="background-image:url(http://ekc.dev/ckeditor/plugins/icons.png);background-position:0 -936px;background-size:auto; width: 16px; height: 15px;"></div><br>
                Vervolgens klik je op "Bladeren op server", als de afbeelding die je wilt gebruiken hier al tussen staat dan kun je er op klikken anders klik je bovenin op Upload en zoek je de afbeelding die je wilt uploaden
                </p>
            </div>
            <form action="../includes/activiteitUpload.php" method="POST" class="myForm" name="myForm">
                <label>Naam van activiteit:</label><input type="text" id="activiteitName" class="form-control" name="activiteitName" placeholder="Naam" maxlength="60" REQUIRED><br>
                <textarea class="ckeditor" id="editor1" name="editor1"></textarea><br>
                <input type="submit" value="Upload"/>
            </form><br>
            <div id="error"></div>
        </div>
        <?php
    }
    $db = DB::getInstance();
    $activiteiten = $db->query("SELECT date, name FROM activiteiten ORDER BY date DESC");
    if ($activiteiten->count()) {
        foreach ($activiteiten->results() as $activiteit) {
            echo '<div class="well activiteitDiv"><a href="/activiteit/' . $activiteit->name . '"><h3>' . escape($name = str_replace('-', ' ', $activiteit->name)) . '</h3></a><p>Upload datum: ' . escape($date = explode(" ", $activiteit->date)[0]) . '</p></div>';
        }
    } else {
        echo '<div class="well activiteitDiv"><br/><h3>Er zijn nog geen activiteiten beschikbaar.</h3></div>';
    }
    ?>
</div>
