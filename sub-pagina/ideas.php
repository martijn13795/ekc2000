<?php include '../includes/html.php';
if ($user->isLoggedIn()) {
?>
<script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <h1>Idee&euml;nbus</h1>
        <hr>
        <div class="col-md-12 col-xs-12">
            <form method="post" name="myForm" class="myForm" action="../includes/ideasUpload.php">
                <label>Naam van het idee:</label>
                <input type="text" class="form-control" placeholder="Naam" id="name" name="name" REQUIRED/><br>
                <label>Het idee:</label>
                <textarea class="form-control" rows="8" maxlength="512" id="idea" placeholder="Type hier..." name="idea"
                          REQUIRED></textarea></br>
                <input type="submit" id="submit" class="btn btn-success">
            </form>
            <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button>
            <br><br>

            <div id="error"></div>
        </div>
        <div class="col-md-12 col-xs-12">
            <?php
            if ($user->hasPermission('dev') || $user->hasPermission('ideas')) {
                $db = DB::getInstance();
                $ideas = $db->query("SELECT * FROM ideas ORDER BY date DESC");
                if ($ideas->count()) {
                    foreach ($ideas->results() as $idea) {
                        echo '<div class="well activiteitDiv"><h3>' . escape(str_replace('-', ' ', $idea->name)) . '</h3><p>' . escape($idea->text) . '</p><br><p>Upload datum: ' . escape(explode(" ", $idea->date)[0]) . '</p>';
                        if ($user->hasPermission("dev")) {
                            $names = $db->query("SELECT * FROM users WHERE id = '$idea->user_id'");
                            if ($names->count()) {
                                foreach ($names->results() as $name) {
                                    echo '<p>Ge&#252;pload door: ' . escape($name->name) . ' ' . escape($name->surname) . '</p></div>';
                                }
                            }
                        }
                    }
                } else {
                    echo '<div class="well activiteitDiv"><br><h3>Er zijn nog geen idee&euml;n beschikbaar</h3></div>';
                }
            } else {
                $db = DB::getInstance();
                $userID = $user->data()->id;
                $ideas = $db->query("SELECT * FROM ideas WHERE user_id = '$userID' ORDER BY date DESC");
                if ($ideas->count()) {
                    foreach ($ideas->results() as $idea) {
                        echo '<div class="well activiteitDiv"><h3>' . escape(str_replace('-', ' ', $idea->name)) . '</h3><p>' . escape($idea->text) . '</p><br><p>Upload datum: ' . escape(explode(" ", $idea->date)[0]) . '</p></div>';
                    }
                } else {
                    echo '<div class="well activiteitDiv"><br><h3>U heeft nog geen idee&euml;n geupload</h3></div>';
                }
            }
            ?>
        </div>
    </div>
    <?php
}else{
    include_once '403.php';
}
?>
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
                $('.alerts').append('<div class="alert alert-success alert-dismissable">' +
                    '<button class="close" data-dismiss="alert">&times;</button>' +
                    'Het idee is verstuurd' +
                    '</div>');
                setTimeout(function () {
                    $('.alerts').children('.alert:last-child').addClass('on');
                    setTimeout(function () {
                        $('.alerts').children('.alert:first-child').removeClass('on');
                        setTimeout(function () {
                            $('.alerts').children('.alert:first-child').remove();
                        }, 900);
                    }, 5000);
                }, 10);
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
<?php include '../includes/htmlUnder.php'; ?>