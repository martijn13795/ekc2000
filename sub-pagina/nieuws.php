<?php include '../includes/html.php';?>
<script src="../ckeditor/ckeditor.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <h1>Nieuws</h1><hr>
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
        <form action="../includes/nieuwsUpload.php" method="POST" class="myForm" name="myForm">
            <label>Naam van artikel:</label><input type="text" id="artikelName" class="form-control" name="artikelName" placeholder="Naam" maxlength="60" REQUIRED><br>
            <textarea class="ckeditor" id="editor1" name="editor1"></textarea><br>
            <input type="submit" value="Upload"/>
        </form><br>
        <div id="error"></div>
        </div>
<?php
        }
$db = DB::getInstance();
$nieuwsMessage = $db->query("SELECT date, name FROM nieuws ORDER BY date DESC");
if ($nieuwsMessage->count()) {
    foreach ($nieuwsMessage->results() as $nieuws) {
        echo '<div class="well nieuwsDiv"><a href="/artikel/' . $nieuws->name . '"><h3>' . escape($name = str_replace('-', ' ', $nieuws->name)) . '</h3></a><p>Upload datum: ' . escape($date = explode(" ", $nieuws->date)[0]) . '</p></div>';
    }
} else {
    echo '<div class="well nieuwsDiv"><br/><h3>Er zijn nog geen artikelen beschikbaar.</h3></div>';
}
?>
    </div>
