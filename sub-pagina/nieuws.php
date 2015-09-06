<?php include '../includes/html.php';?>
<script src="../ckeditor/ckeditor.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container"><br>
        <form action="../includes/nieuwsUpload.php" method="POST" class="myForm" name="myForm">
            <textarea class="ckeditor" id="editor1" name="editor1"></textarea><br>
            <input type="submit" value="Upload"/>
        </form><br>
        <div id="error"></div>
<?php
$db = DB::getInstance();
$text = $db->query("SELECT id, date, text FROM nieuws ORDER BY date DESC");
if ($text->count()) {
    foreach ($text->results() as $tex) {
        echo '<div class="well albumsDiv"><p>Upload datum: ' . escape($date = explode(" ", $date)[0]) . '</p></div>';
    }
} else {
    echo '<div class="well albumsDiv"><br/><h3>Er zijn nog geen artikelen beschikbaar.</h3></div>';
}
?>
    </div>
