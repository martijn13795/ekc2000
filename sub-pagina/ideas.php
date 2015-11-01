<?php include '../includes/html.php';?>
<script src="http://malsup.github.com/jquery.form.js"></script>
<div class="container">
    <h1>Idee&euml;nbus</h1><hr>
    <div class="col-md-12 col-xs-12">
        <form method="post" name="myForm" class="myForm" action="../includes/ideasUpload.php">
            <label>Naam van het idee:</label>
            <input type="text" class="form-control" placeholder="Naam" id="name" name="name" REQUIRED/><br>
            <label>Het idee:</label>
            <textarea class="form-control" rows="8" id="idea" placeholder="Type hier..." name="idea" REQUIRED></textarea></br>
            <input type="submit" id="submit" class="btn btn-success">
        </form>
        <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button><br><br>
        <div id="error"></div>
    </div>
    <div class="col-md-12 col-xs-12">
        <?php
        if ($user->isLoggedIn() && $user->hasPermission('dev')) {
            $db = DB::getInstance();
            $ideas = $db->query("SELECT * FROM ideas ORDER BY date DESC");
            if ($ideas->count()) {
                foreach ($ideas->results() as $idea) {
                    echo '<div class="well activiteitDiv"><h3>' . escape(str_replace('-', ' ', $idea->name)) . '</h3><p>' . escape($idea->text) . '</p><br><p>Upload datum: ' . escape(explode(" ", $idea->date)[0]) . '</p></div>';
                }
            } else {
                echo '<div class="well activiteitDiv"><br><h3>Er zijn nog geen idee&euml;n beschikbaar</h3></div>';
            }
        }
        ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.myForm').ajaxForm({
            beforeSend: function () {
                $("#submit").hide();
                $("#error").show();
                $("#error").html('<h3>Even geduld alstublieft</h3><p>Refresh de pagina niet</p>');
            },
            success: function (response) {
                $("#refresh").show();
                $("#error").show();
                $("#error").html(response);
                $("#name").val('');
                $("#idea").val('');
            }
        });
        $("#refresh").hide();
        $("#error").hide();
    });
</script>