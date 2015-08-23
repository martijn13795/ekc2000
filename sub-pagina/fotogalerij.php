<?php include '../includes/html.php'; ?>
<script src="http://malsup.github.com/jquery.form.js"></script>
<div class="container">
    <div class="col-md-12 col-xs-12">
        <h1>Fotogalerij</h1>
        <hr>
        <?php
        $user = new User();
        if ($user->isLoggedIn()) {
            ?>
            <div class="hidden-xs">
                <form action="../includes/fotoUpload.php" method="post" class="myForm" name="myForm"
                      enctype="multipart/form-data">
                    <label>Naam van album:</label><input type="text" id="name" class="form-control" name="name"
                                                         placeholder="Naam" maxlength="60" REQUIRED><br>
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
        $db = DB::getInstance();
        $galleries = $db->query("SELECT id, date, name, pathMobile FROM galleries ORDER BY date DESC");
        if ($galleries->count()) {
            foreach ($galleries->results() as $gallery) {
                $imgPathsMobile = explode('  ', $gallery->pathMobile);
                echo '<div class="well albumsDiv"><a href="/album/' . $gallery->name . '"><img class="roundImg" src="' . $imgPathsMobile[0] . '"/><h3>'
                    . escape($name = str_replace('-', ' ', $gallery->name)) . '</h3></a><p>Upload datum: ' . escape($date = explode(" ", $gallery->date)[0]) . '</p></div>';
            }
        } else {
            //Bericht nog geen foto albums?
            echo '<div class="well albumsDiv"><br/><h3>Er zijn nog geen albums beschikbaar.</h3></div>';
        }
        ?>
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
                            'Het album is geupload' +
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
</div>