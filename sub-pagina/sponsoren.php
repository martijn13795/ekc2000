<?php include '../includes/html.php';?>
<script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <?php
        $user = new User();
        if ($user->isLoggedIn()) {
            ?>
            <div class="hidden visible-lg">
                <h1>Upload sponsoren</h1><br>
                <form action="../includes/fotoUpload.php" method="post" class="myForm" name="myForm"
                      enctype="multipart/form-data">
                    <div class="hidden"><input type="text" id="name" class="form-control" name="name" value="Sponsoren" maxlength="60" REQUIRED></div>
                    <input type="file" id="file" name="files[]" multiple REQUIRED><br>
                    <input class="btn btn-success" id="submit" type="submit" value="Upload">
                </form>
                <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button>
                <br>

                <div id="error"></div>
                <br>

                <div class="progress progress-striped active">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                         style="width: 0%">

                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="sponsorenDiv">
            <h1>Onze sponsoren</h1><br>
            <?php
            $album = $db->query("SELECT * FROM albums WHERE name ='Sponsoren'");
            if($album->count()) {
                $sponsoren = $db->query("SELECT * FROM pictures WHERE album_id = '".$album->first()->id."'");
                if ($sponsoren->count()) {
                    foreach ($sponsoren->results() as $sponsor) {
                        echo '<div class="col-md-2 col-xs-2 sponsorenImg">
                                <img class="img-responsive" src="' . escape($sponsor->path) . '" alt="' . escape($sponsor->name) . '"/>
                              </div>';
                    }
                } else {
                    echo '<p>Er zijn geen sponsoren beschikbaar</p>';
                }
            }
            ?>
        </div>
    </div>
<script>
    $(document).ready(function () {
        $('.myForm').ajaxForm({
            beforeSend: function () {
                $(".progress").show();
                $("#submit").hide();
                $("#error").show();
                $("#error").html('<h3>Even geduld alstublieft</h3><p>Refresh de pagina niet</p>');
            },
            uploadProgress: function (event, position, total, percentComplete) {
                $(".progress-bar").width(percentComplete + '%');
                $(".progress-bar").html('<p>' + percentComplete + ' %' + '</p>');
            },
            success: function (response) {
                $(".progress-bar").addClass('progress-bar-success');
                $(".progress-bar").html('<p onclick="history.go(0)">Uploaden voltooid</p>');
                    $('.alerts').append('<div class="alert alert-success alert-dismissable">' +
                        '<button class="close" data-dismiss="alert">&times;</button>' +
                        'De sponsoren zijn geupload' +
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
                $("#refresh").show();
                $("#error").show();
                $("#error").html(response);
                $("#name").val('');
                $("#file").val('');
            }
        });
        $(".progress").hide();
        $("#refresh").hide();
        $("#error").hide();
    });
</script>