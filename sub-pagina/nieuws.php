<?php include '../includes/html.php'; ?>
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <h1>Nieuws</h1>
        <hr>
        <?php
        $user = new User();
        if ($user->isLoggedIn() && $user->hasPermission('admin')) {
        ?>
        <div class="hidden visible-lg">
            <button class="btn btn-primary" id="upload" onclick="showUpload()">Upload</button><br><br>
            <div id="uploadContainer" hidden>
                <form action="../includes/nieuwsUpload.php" method="POST" class="myForm" name="myForm">
                    <label>Naam van artikel:</label><input type="text" id="artikelName" class="form-control" name="artikelName" placeholder="Naam" maxlength="60" REQUIRED><br>
                    <textarea class="ckeditor" id="editor1" name="editor1"></textarea><br>
                    <input type="submit" class="btn btn-primary" value="Upload"/>
                </form>
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
                $newsdata = $db->query("SELECT date, name, id, user_id FROM news ORDER BY date DESC");
                if ($newsdata->count()) {
                    foreach ($newsdata->results() as $news) {
                        echo '<div class="well nieuwsDiv">';
                        if ($user->isLoggedIn() && ($user->data()->id == $news->user_id || $user->hasPermission("admin"))) {
                            echo '<i class="fa fa-trash-o" style="float: right;" onclick="removeNews(' . escape($news->id) . ')"></i>';
                        }
                                    echo '<a href="/artikel/' . escape($news->name) . '">
                                        <h3>' . escape(str_replace('-', ' ', $news->name)) . '</h3>
                                    </a>
                                    <p>Upload datum: ' . escape(explode(" ", $news->date)[0]) . '</p>
                              </div>';
                    }
                } else {
                    echo '<div class="well nieuwsDiv"><br><h3>Er zijn nog geen artikelen beschikbaar.</h3></div>';
                }
                ?>
            </div>
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