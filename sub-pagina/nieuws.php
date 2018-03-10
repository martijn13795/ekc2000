<?php include '../includes/html.php'; ?>
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery.form.js"></script>
    <div class="container">
        <h1>Nieuws</h1>
        <hr>
        <?php
        $user = new User();
        if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('newsupload'))) {
            ?>
            <div class="hidden visible-lg">
                <button class="btn btn-primary" id="upload" onclick="showUpload()">Upload</button>
                <br><br>
                <div id="uploadContainer" hidden>
                    <form action="../includes/nieuwsUpload.php" method="POST" class="myForm" name="myForm">
                        <label>Naam van artikel:</label><input type="text" id="artikelName" class="form-control" name="artikelName" placeholder="Naam" maxlength="256" REQUIRED><br>
                        <textarea class="ckeditor" id="editor1" name="editor1"></textarea><br>
                        <input type="submit" onClick="CKupdate()" id="submit" class="btn btn-primary" value="Upload"/>
                    </form>
                    <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button>
                    <br>
                    <div id="error"></div>
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
                $newsdata = $db->query("SELECT date, name, id, user_id FROM news ORDER BY date DESC");
                if ($newsdata->count()) {
                    foreach ($newsdata->results() as $news) {
                        $userName = $db->query("SELECT name, surname FROM users WHERE id = $news->user_id")->first();
                        echo '<div class="well nieuwsDiv">';
                        if ($user->isLoggedIn() && ($user->data()->id == $news->user_id || $user->hasPermission("dev") || $user->hasPermission("newsremove"))) {
                            echo '<i title="Verwijderen" class="fa fa-trash-o" style="float: right;" onclick="removeNews(' . escape($news->id) . ')"></i>';}
                        if ($user->isLoggedIn() && ($user->data()->id == $news->user_id || $user->hasPermission("dev") || $user->hasPermission("newsedit"))) {
                            echo '<div class="hidden visible-lg"><i title="Bewerken" class="fa fa-pencil-square-o" style="float: right; color: green;" onclick="update(`news`, ' . escape($news->id) . ')"></i></div>';
                        }
                        echo '<a href="/artikel/' . escape($news->name) . '">
                            <h3>' . escape(rawurldecode($news->name)) . '</h3>
                        </a>
                        <p>Upload datum: ' . escape(explode(" ", $news->date)[0]) . '</p>'; if ($user->isLoggedIn() && $user->hasPermission("dev")) {echo '<p>'.$userName->name . ' ' . $userName->surname .'</p>';} echo'</div>';
                    }
                } else {
                    echo '<div class="well nieuwsDiv"><br><h3>Er zijn nog geen artikelen beschikbaar.</h3></div>';
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        function update(updateThing, updateId){
            window.location = '/bewerk/' + updateThing + '/' + updateId;
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
                    if (response == "<h3>Het artikel is geupload</h3>Refresh de pagina<br><br>"){
                        $("#submit").hide();
                        $("#refresh").show();
                        $('.alerts').append('<div class="alert alert-success alert-dismissable">' +
                        '<button class="close" data-dismiss="alert">&times;</button>' +
                        'Het artikel is geupload' +
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

        function removeNews(id){
            if (!$(".alert").hasClass("on")) {
                $('.alerts').append('<div class="alert alert-danger alert-dismissable">' +
                    '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
                    'Weet u zeker dat u dit artikel wilt verwijderen?<br><br>' +
                    '<button class="btn btn-warning" onclick="removeTrue(' + id + ') & $(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Verwijderen</button>&#09;' +
                    '<button class="btn btn-success" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
                    '</div>');
                setTimeout(function () {
                    $('.alerts').children('.alert:last-child').addClass('on');
                }, 10);
            }
        }

        function removeTrue(id){
            $.get("includes/removeNews.php?id=" + id), function(data){
                $('#result').html(data);
            };
            location.reload();
        }
    </script>
<?php include '../includes/htmlUnder.php'; ?>