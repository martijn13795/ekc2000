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
            $db = DB::getInstance();
            $name = 'Sponsoren';
            rawurldecode($name);
            $gallery = $db->query("SELECT path, pathMobile FROM galleries WHERE name = '" . $name . "'");
            if ($gallery->count()) {
                foreach ($gallery->results() as $images) {
                    $imgPaths = explode('  ', $images->path);
                    $imgPathsMobile = explode('  ', $images->pathMobile);
                    foreach (array_combine($imgPaths, $imgPathsMobile) as $imgPath => $imgPathMobile) {
                        echo '
                                    <div class="col-md-2 col-xs-2 sponsorenImg">
                                            <img class="img-responsive" src="' . $imgPath . '" alt="' . substr($imgPath, strrpos($imgPath, '/') + 1) . '"/>
                                    </div>
                                    ';
                    }
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
                if (!$(".alert").hasClass("on")) {
                    var message = '<div class="alert alert-success alert-dismissable">' +
                        '<button class="close" data-dismiss="alert">&times;</button>' +
                        'De sponsoren zijn geupload' +
                        '</div>';
                    $('.alert').append(message);
                    setTimeout(function () {
                        $('.alert').addClass('on');
                        setTimeout(function () {
                            $('.alert').removeClass('on');
                        }, 5000);
                    }, 10);
                }
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