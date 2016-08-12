<?php include '../includes/html.php';
$user = new User();
if ($user->isLoggedIn() && ($user->data()->id == $userId || $user->hasPermission("dev") || $user->hasPermission("newsedit") || $user->hasPermission("activityedit") || $user->hasPermission("reportedit"))) {
?>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/ckeditor/ckeditor.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <?php

        $updateThing = $_GET['updateThing'];
        if ($updateThing == "news"){
            if(!$user->hasPermission("newsedit")){
                include_once '403.php';
                return;
            }
            $location = "/nieuws";
        } else if ($updateThing == "activities") {
            if(!$user->hasPermission("activityedit")){
                include_once '403.php';
                return;
            }
            $location = "/activiteiten";
        } else if ($updateThing == "reports") {
            if(!$user->hasPermission("reportedit")){
                include_once '403.php';
                return;
            }
            $location = "/wedstrijdverslagen";
        } else {
            include_once '404.php';
            return;
        }

        $updateId = $_GET['updateId'];
        $datas = $db->query("SELECT * FROM `".$updateThing."` WHERE `id` = '".$updateId."'");
        if ($datas->count()) {
            foreach ($datas->results() as $data) {
                $userId = $data->user_id;
                $name = $data->name;
                $text = $data->text;
            }
        }
        ?>
            <h1>Bewerk - <?php echo escape(rawurldecode($name)); ?></h1>
            <hr>
            <div class="hidden visible-lg">
                <div id="uploadContainer">
                    <form action="../../includes/edit.php?updateThing=<?php echo $updateThing; ?>&updateId=<?php echo $updateId; ?>" method="POST" class="myForm" name="myForm">
                        <label>Bewerk naam:</label><input type="text" id="artikelName" class="form-control" name="artikelName" placeholder="Naam" value="<?php echo escape(rawurldecode($name)); ?>" maxlength="256" REQUIRED><br>
                        <textarea class="ckeditor" id="editor1" name="editor1"><?php echo $text; ?></textarea><br>
                        <input type="submit" onClick="CKupdate()" id="submit" class="btn btn-primary" value="Bewerken"/>
                    </form>
                    <button class="btn btn-info" id="refresh" onclick="window.location.href = '<?php echo $location ?>';">Terug</button>
                    <br>
                    <div id="error"></div>
                </div>
            </div>
        <br>

    </div>
    <?php
    }
    ?>
    <script>
        function CKupdate(){
            for ( var instance in CKEDITOR.instances )
                CKEDITOR.instances[instance].updateElement();
        }

        $(document).ready(function () {
            $('.myForm').ajaxForm({
                beforeSend: function () {
                    $("#error").show();
                    $("#error").html('<h3>Even geduld alstublieft</h3><p>Refresh de pagina niet</p>');
                },
                success: function (response) {
                    if (response == "<h3>Het bewerken is voltooid</h3>Ga terug naar de pagina<br><br>"){
                        $("#submit").hide();
                        $("#refresh").show();
                        $('.alerts').append('<div class="alert alert-success alert-dismissable">' +
                            '<button class="close" data-dismiss="alert">&times;</button>' +
                            'Het bewerken is voltooid' +
                            '</div>');
                    }
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
                }
            });
            $("#error").hide();
            $("#refresh").hide();
        });
    </script>
<?php include '../includes/htmlUnder.php'; ?>