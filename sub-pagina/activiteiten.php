<?php include '../includes/html.php'; ?>
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <h1>Activiteiten</h1>
        <hr>
        <?php
        $user = new User();
        if ($user->isLoggedIn() && $user->hasPermission('admin')) {
        ?>
        <div class="hidden visible-lg">
            <button class="btn btn-primary" id="upload" onclick="showUpload()">Upload</button><br><br>
            <div id="uploadContainer" hidden>
                <form action="../includes/activiteitUpload.php" method="POST" class="myForm" name="myForm">
                    <label>Naam van activiteit:</label><input type="text" id="activiteitName" class="form-control" name="activiteitName" placeholder="Naam" maxlength="256" REQUIRED><br>
                    <label>Datum van activiteit:</label><input type="text" class="form-control" name="activiteitDate" placeholder="YYYY-MM-DD" REQUIRED><br>
                    <textarea class="ckeditor" id="editor1" name="editor1"></textarea><br>
                    <input type="submit" onClick="CKupdate()" id="submit" class="btn btn-primary" value="Upload"/>
                </form>
                <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button>
                <br>
                <div id="error"></div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-12 col-xs-12">
                <?php
                }
                $db = DB::getInstance();
                $activities = $db->query("SELECT date, date_activity, name, id, user_id FROM activities ORDER BY date_activity DESC");
                if ($activities->count()) {
                    foreach ($activities->results() as $activity) {
                        echo '<div class="well activiteitDiv">';
                        if ($user->isLoggedIn() && ($user->data()->id == $activity->user_id || $user->hasPermission("admin"))) {
                            echo '<i class="fa fa-trash-o" style="float: right;" onclick="removeActivity(' . escape($activity->id) . ')"></i>';
                        }
                        echo '<a href="/activiteit/' . escape($activity->name) . '"><h3>' . escape(rawurldecode($activity->name)) . '</h3></a>
                    <p>Activiteit datum: ' . escape($activity->date_activity) . '</p></div>';
                    }
                } else {
                    echo '<div class="well activiteitDiv"><br><h3>Er zijn nog geen activiteiten beschikbaar</h3></div>';
                }
                ?>
            </div>
        </div>
        <script>
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
                        if (response == "<h3>De activiteit is geupload</h3>Refresh de pagina<br><br>"){
                            $("#submit").hide();
                            $("#refresh").show();
                            $('.alerts').append('<div class="alert alert-success alert-dismissable">' +
                                '<button class="close" data-dismiss="alert">&times;</button>' +
                                'De activiteit is geupload' +
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

            function removeActivity(id){
                if (!$(".alert").hasClass("on")) {
                    $('.alerts').append('<div class="alert alert-danger alert-dismissable">' +
                        '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
                        'Weet u zeker dat u deze activiteit wilt verwijderen?<br><br>' +
                        '<button class="btn btn-warning" onclick="removeTrue(' + id + ') & $(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Verwijderen</button>&#09;' +
                        '<button class="btn btn-success" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
                        '</div>');
                    setTimeout(function () {
                        $('.alerts').children('.alert:last-child').addClass('on');
                    }, 10);
                }
            }

            function removeTrue(id){
                $.get("includes/removeActivity.php?id=" + id), function(data){
                    $('#result').html(data);
                };
                location.reload();
            }
        </script>
    </div>
<?php include '../includes/htmlUnder.php'; ?>