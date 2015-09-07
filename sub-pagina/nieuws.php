<?php include '../includes/html.php';?>
<script src="../ckeditor/ckeditor.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container"><br>
        <form action="../includes/nieuwsUpload.php" method="POST" class="myForm" name="myForm">
            <label>Naam van artikel:</label><input type="text" id="name" class="form-control" name="name" placeholder="Naam" maxlength="60" REQUIRED><br>
            <textarea class="ckeditor" id="editor1" name="editor1"></textarea><br>
            <input type="submit" value="Upload"/>
        </form><br>
        <div id="error"></div>
<?php
$db = DB::getInstance();
$nieuwsMessage = $db->query("SELECT date, name FROM nieuws ORDER BY date DESC");
if ($nieuwsMessage->count()) {
    foreach ($nieuwsMessage->results() as $nieuws) {
        echo '<div class="well albumsDiv"><a href="/artikel/' . $nieuws->name . '"><h3>' . $nieuws->name . '</h3></a><p>Upload datum: ' . escape($date = explode(" ", $date)[0]) . '</p></div>';
    }
} else {
    echo '<div class="well albumsDiv"><br/><h3>Er zijn nog geen artikelen beschikbaar.</h3></div>';
}
?>
    </div>
