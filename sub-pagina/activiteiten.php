<?php include '../includes/html.php';?>
<script src="../ckeditor/ckeditor.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<div class="container">
    <h1>Activiteiten</h1><hr>
    <?php
    $user = new User();
    if ($user->isLoggedIn() && $user->hasPermission('admin')) {
        ?>
        <div class="hidden visible-lg">
            <form action="../includes/activiteitUpload.php" method="POST" class="myForm" name="myForm">
                <label>Naam van activiteit:</label><input type="text" id="activiteitName" class="form-control" name="activiteitName" placeholder="Naam" maxlength="60" REQUIRED><br>
                <textarea class="ckeditor" id="editor1" name="editor1"></textarea><br>
                <input type="submit" class="btn btn-primary" value="Upload"/>
            </form><br>
            <div id="error"></div>
        </div>
        <?php
    }
    $db = DB::getInstance();
    $activities = $db->query("SELECT date, name FROM activities ORDER BY date DESC");
    if ($activities->count()) {
        foreach ($activities->results() as $activity) {
            echo '<div class="well activiteitDiv"><a href="/activiteit/' . escape($activity->name) . '"><h3>' . escape(str_replace('-', ' ', $activity->name)) . '</h3></a><p>Upload datum: ' . escape(explode(" ", $activity->date)[0]) . '</p></div>';
        }
    } else {
        echo '<div class="well activiteitDiv"><br><h3>Er zijn nog geen activiteiten beschikbaar</h3></div>';
    }
    ?>
</div>
