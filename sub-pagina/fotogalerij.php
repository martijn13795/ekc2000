<?php include '../includes/html.php';
    if ($user->isLoggedIn()) { ?>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery.form.js"></script>
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <h1>Fotogalerij</h1>
            <hr>
            <?php
            $user = new User();
            if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('imageupload'))) {
                ?>
                <div class="hidden visible-lg">
                    <button class="btn btn-primary" id="upload" onclick="showUpload()">Upload</button>
                    <br><br>
                    <div id="uploadContainer" hidden>
                        <form action="../includes/fotoUpload.php" method="post" class="myForm" name="myForm"
                              enctype="multipart/form-data">
                            <label>Naam van album:</label><input type="text" id="name" class="form-control" name="name"
                                                                 placeholder="Naam" maxlength="256" REQUIRED><br>
                            <input type="file" id="file" name="files[]" multiple REQUIRED><br>
                            <input class="btn btn-success" id="submit" type="submit" value="Upload">
                        </form>
                        <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button>
                        <br>
                        <br>
                        <div id="error"></div>
                        <br>

                        <div class="progress progress-striped active">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                 aria-valuemax="100" style="width: 0%;"></div>
                        </div>
                    </div>
                </div>
                <br>
                <?php
            }
            ?>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <?php
                    $db = DB::getInstance();
                    $albums = $db->query("SELECT * FROM albums WHERE id > 1 ORDER BY date DESC");
                    if ($albums->count()) {
                        foreach ($albums->results() as $album) {
                            $userName = $db->query("SELECT name, surname FROM users WHERE id = $album->user_id")->first();
                            $album_data = $db->query("SELECT * FROM pictures WHERE album_id = '$album->id'");
                            if ($count = $album_data->count()) {
                                $album_name = str_replace("XY","%",$album->name);
                                $img_path = $album_data->first()->pathMobile;
                                echo '<div class="well albumsDiv">';
                                if ($user->isLoggedIn() && ($user->data()->id == $album->user_id || $user->hasPermission("dev") || $user->hasPermission("imageremove"))) {
                                    echo '<i title="Verijderen" class="fa fa-trash-o" style="float: right;" onclick="removeAlbum(' . escape($album->id) . ')"></i>';
                                    echo '<div class="hidden visible-lg"><i title="Toevoegen" class="fa fa-plus-square-o" style="float: right; color: green;" onclick="update(\''.escape(rawurldecode($album_name)).'\')"></i></div>';
                                }
                                echo '<a href="/album/' . $album->name . '"><img class="roundImg" src="' . $img_path . '"/><h3>'
                                    . escape(rawurldecode($album_name)) . '</h3></a><p>Laatste update: ' . escape(explode(" ", $album->date)[0]) . '</p>'
                                    . '<p>Aantal afbeeldingen: ' . escape($count) . '</p>'; if ($user->isLoggedIn() && $user->hasPermission("dev")) {echo '<p>'.$userName->name . ' ' . $userName->surname .'</p>';} echo'</div>';
                            } else {
                                $album_name = str_replace("XY","%",$album->name);
                                echo '<div class="well albumsDiv">';
                                if ($user->isLoggedIn() && ($user->data()->id == $album->user_id || $user->hasPermission("dev") || $user->hasPermission("imageremove"))) {
                                    echo '<i title="Verwijderen" class="fa fa-trash-o" style="float: right;" onclick="removeAlbum(' . escape($album->id) . ')"></i>';
                                    echo '<div class="hidden visible-lg"><i title="Toevoegen" class="fa fa-plus-square-o" style="float: right; color: green;" onclick="update(\''.escape(rawurldecode($album_name)).'\')"></i></div>';
                                }
                                echo '<a href="/album/' . $album->name . '"><h3>'
                                    . escape(rawurldecode($album_name)) . '</h3></a><p>Laatste update: ' . escape(explode(" ", $album->date)[0]) . '</p>'
                                    . '<p>Aantal afbeeldingen: ' . escape($count) . '</p>'; if ($user->isLoggedIn() && $user->hasPermission("dev")) {echo '<p>'.$userName->name . ' ' . $userName->surname .'</p>';} echo'</div>';
                            }
                        }
                    } else {
                        echo '<div class="well albumsDiv"><br><h3>Er zijn nog geen albums beschikbaar.</h3></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <script>
            function update(name) {
                document.getElementById('name').value = name;
                $("#upload").attr("onclick", "hideUpload()");
                $("#upload").text("Verberg");

                $("#uploadContainer").show();
            }

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
                        if (response.indexOf(">Uploaden voltooid.") >= 0) {
                            $(".progress-bar").addClass('progress-bar-success');
                            $(".progress-bar").html('<p onclick="history.go(0)">Uploaden voltooid</p>');
                            $('.alerts').append('<div class="alert alert-success alert-dismissable">' +
                                '<button class="close" data-dismiss="alert">&times;</button>' +
                                'Het album is geupload' +
                                '</div>');
                        } else {
                            $(".progress-bar").addClass('progress-bar-warning');
                            $(".progress-bar").html('<p onclick="history.go(0)">Uploaden mislukt</p>');
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

            function removeAlbum(id){
                if (!$(".alert").hasClass("on")) {
                    $('.alerts').append('<div class="alert alert-danger alert-dismissable">' +
                        '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
                        'Weet u zeker dat u dit album wilt verwijderen?<br><br>' +
                        '<button class="btn btn-warning" onclick="removeTrue(' + id + ') & $(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Verwijderen</button>&#09;' +
                        '<button class="btn btn-success" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
                        '</div>');
                    setTimeout(function () {
                        $('.alerts').children('.alert:last-child').addClass('on');
                    }, 10);
                }
            }

            function removeTrue(id){
                $.get("includes/removeAlbum.php?id=" + id), function(data){
                    $('#result').html(data);
                };
                location.reload();
            }
        </script>
    </div>
<?php
    }else{
        include_once '403.php';
    }
    include '../includes/htmlUnder.php';
?>