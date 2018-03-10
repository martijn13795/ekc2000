<?php include '../includes/html.php'; ?>
<script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery.form.js"></script>
<div class="container">
    <div class="col-md-12 col-xs-12"><br>
        <?php
        $db = DB::getInstance();
        $name = $_GET['activiteitName'];
        $name = rawurlencode($name);
        $activities = $db->query("SELECT text FROM activities WHERE name = '" . $name . "'");
        if ($activities->count()) {
            foreach ($activities->results() as $activity) {
                echo '
                    <div class="artikelDiv">
                        <span>'. $activity->text .'</span>
                    </div>
                ';
            }
        }
        ?>
        <br></div>
    <?php
    $email = $db->query("SELECT email FROM activities WHERE name = '" . $name . "'")->first();
    if ($email->email != ""){
        $user = new User();
        if ($user->isLoggedIn()) {
            ?>
            <button class="btn btn-success" id="registration" onclick="showRegistration()">Inschrijven</button><br><br>
            <div id="registrationContainer" hidden>
                <form action="../includes/activiteitRegistration.php" method="POST" class="myForm" name="myForm">
                    <label>Naam:</label><input type="text" id="name" class="form-control" name="name" placeholder="Naam" maxlength="256" REQUIRED><br>
                    <label>Eventuele toevoeging:</label><textarea id="optionalText" class="form-control" name="optionalText" maxlength="512"></textarea><br>
                    <input type="text" name="activiteitName" id="activiteitName" value="<?php echo $name; ?>" hidden>
                    <input type="text" name="userName" id="userName" value="<?php echo $user->data()->name . ' '; if ($user->data()->surname_prefix != ""){echo $user->data()->surname_prefix . ' ';}  echo $user->data()->surname; ?>" hidden>
                    <input type="text" name="userEmail" id="userEmail" value="<?php echo $user->data()->mail; ?>" hidden>
                    <input type="text" name="email" id="email" value="<?php echo $email->email; ?>" hidden>
                    <input type="submit" id="submit" class="btn btn-success" value="Inschrijven"/>
                </form>
                <br>
                <div id="error"></div>
            </div>
            <?php
        } else {
            ?><button onclick="window.location = '/inloggen';" type="button" class="btn btn-success">Inschrijven</button><br><br><?php
        }
    }
    ?>
    <br><button onclick="history.go(-1)" type="button" class="btn btn-primary">
        Ga terug
    </button>
</div>
<script>
    $("img").addClass("img-responsive");
    $('.img-responsive').removeAttr("height").css({ height: "" });

    function showRegistration() {
        $("#registration").hide();

        $("#registrationContainer").show();
    }

    $(document).ready(function () {
        $('.myForm').ajaxForm({
            beforeSend: function () {
                $("#error").show();
                $("#error").html('<h3>Even geduld alstublieft</h3><p>Refresh de pagina niet</p>');
            },
            success: function (response) {
                if (response == "<h3>De inschrijving is gelukt</h3><br>"){
                    $("#submit").hide();
                    $('.alerts').append('<div class="alert alert-success alert-dismissable">' +
                        '<button class="close" data-dismiss="alert">&times;</button>' +
                        'De inschrijving is gelukt' +
                        '</div>');
                }
                setTimeout(function () {
                    $('.alerts').children('.alert:last-child').addClass('on');
                    setTimeout(function () {
                        $('.alerts').children('.alert:first-child').removeClass('on');
                        setTimeout(function () {
                            $('.alerts').children('.alert:first-child').remove();
                            $("#registrationContainer").hide();
                        }, 900);
                    }, 5000);
                }, 10);
                $("#error").show();
                $("#error").html(response);
            }
        });
        $("#error").hide();
    });
</script>
<?php include '../includes/htmlUnder.php'; ?>