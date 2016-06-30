<?php include '../includes/html.php'; ?>
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <?php
        $user = new User();
        $updateThing = $_GET['updateThing'];
        $updateId = $_GET['updateId'];
            $location = "";
            $datas = $db->query("SELECT * FROM `".$updateThing."` WHERE `id` = '".$updateId."'");
            if ($datas->count()) {
                foreach ($datas->results() as $data) {
                    $userId = $data->user_id;
                    $name = $data->name;
                    $text = $data->text;
                }
            }
        if ($user->isLoggedIn() && ($user->data()->id == $userId || $user->hasPermission("admin"))) {
                if ($updateThing == "news"){
                    $location = "/nieuws";
                } else if ($updateThing == "activities") {
                    $location = "/activiteiten";
                } else if ($updateThing == "reports") {
                    $location = "/wedstrijdverslagen";
                }
        ?>
            <h1>Update - <?php echo escape(rawurldecode($name)); ?></h1>
            <hr>
            <div class="hidden visible-lg">
                <div id="uploadContainer">
                    <form action="../includes/update.php?updateThing=<?php echo $updateThing; ?>&updateId=<?php echo $updateId; ?>" method="POST" class="myForm" name="myForm">
                        <label>Update naam:</label><input type="text" id="artikelName" class="form-control" name="artikelName" placeholder="Naam" value="<?php echo escape(rawurldecode($name)); ?>" maxlength="256" REQUIRED><br>
                        <textarea class="ckeditor" id="editor1" name="editor1"><?php echo $text; ?></textarea><br>
                        <input type="submit" onClick="CKupdate()" id="submit" class="btn btn-primary" value="Update"/>
                    </form>
                    <button class="btn btn-info" id="refresh" onclick="window.location.href = '<?php echo $location ?>';">Terug</button>
                    <br>
                    <div id="error"></div>
                </div>
            </div>
        <br>
        <?php
        }
        ?>
    </div>
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
                    if (response == "<h3>Het updaten is afgerond</h3>Ga terug naar de pagina<br><br>"){
                        $("#submit").hide();
                        $("#refresh").show();
                        $('.alerts').append('<div class="alert alert-success alert-dismissable">' +
                            '<button class="close" data-dismiss="alert">&times;</button>' +
                            'Het updaten is afgerond' +
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