<?php include '../includes/html.php'; ?>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery.form.js"></script>
    <div class="container">
        <?php
        $user = new User();
        if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('sponsorupload'))) {
            ?>
            <div class="hidden visible-lg">
                <br>
                <button class="btn btn-primary" id="upload" onclick="showUpload()">Upload</button>
                <br>
                <div id="uploadContainer" hidden>
                    <h1>Upload sponsoren</h1><br>

                    <form action="../includes/sponsorUpload.php" method="post" class="myForm" name="myForm" enctype="multipart/form-data">
                        <div class="hidden">
                            <input type="text" id="name" class="form-control" name="name" value="Sponsoren" maxlength="60" REQUIRED>
                        </div>
                        <label>Titel van sponsor:</label><input type="text" id="title" class="form-control" name="title" placeholder="Title" maxlength="255" REQUIRED><br>
                        <label>Link van sponsor:</label><input type="text" id="link" class="form-control" name="link" placeholder="Link" maxlength="255" REQUIRED><br>
                        <input type="file" id="file" name="files[]" REQUIRED><br>
                        <input class="btn btn-success" id="submit" type="submit" value="Upload">
                    </form>
                    <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button>
                    <br>

                    <div id="error"></div>
                    <br>

                    <div class="progress progress-striped active">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        </div>
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
            if ($album->count()) {
                $sponsoren = $db->query("SELECT * FROM sponsoren WHERE album_id = '" . $album->first()->id . "'");
                if ($sponsoren->count()) {
                    foreach ($sponsoren->results() as $sponsor) {
                        echo '<div class="col-md-2 col-xs-2 sponsorenImg">';
                        if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('sponsorremove'))) {
                            echo '<div class="imageDel"><i class="fa fa-trash-o imageDelButton" onclick="imageDel(\'' . escape($sponsor->id) . '\', \'' . escape($sponsor->pathMobile) . '\');"></i></div>';
                        }
                        echo '<img onclick="window.open(\'' . escape($sponsor->link) . '\', \'_blank\');" title="' . escape($sponsor->title) . '" style="cursor: pointer;" class="img-responsive" src="' . escape($sponsor->path) . '" alt="' . escape($sponsor->name) . '"/>
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

        function imageDel(id, path) {
            if (!$(".alert").hasClass("on")) {
                $('.alerts').append('<div class="alert alert-danger alert-dismissable">' +
                    '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
                    'Weet u zeker dat u deze afbeelding wilt verwijderen?<br><br>' +
                    '<img src="' + path + '" class="img-responsive imageDelAlert"/><br><br>' +
                    '<button class="btn btn-warning" onclick="imageRemove(' + id + ')">Verwijderen</button>&#09;' +
                    '<button class="btn btn-success" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
                    '</div>');
                setTimeout(function () {
                    $('.alerts').children('.alert:last-child').addClass('on');
                }, 10);
            }
        }

        function imageRemove(id) {
            $.get("../includes/removeSponsor.php?id=" + id), function (data) {
                $('#result').html(data);
            };
            setTimeout(function () {
                location.reload();
            }, 20);
        }

        function showUpload() {
            $("#upload").attr("onclick", "hideUpload()");
            $("#upload").text("Verberg");

            $("#uploadContainer").show();
        }
        function hideUpload() {
            $("#upload").attr("onclick", "showUpload()");
            $("#upload").text("Upload");

            $("#uploadContainer").hide();
        }
    </script>
<?php include '../includes/htmlUnder.php'; ?>