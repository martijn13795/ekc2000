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
        <button class="btn btn-default" id="upload" onclick="showUpload()">Upload</button>
        <br>

        <div class="col-md-12 col-xs-12" id="uploadContainer" hidden><br>

            <div class="hidden visible-lg">
                <form action="../includes/nieuwsUpload.php" method="POST" class="myForm" name="myForm">
                    <label>Naam van artikel:</label><input type="text" id="artikelName" class="form-control"
                                                           name="artikelName" placeholder="Naam" maxlength="60"
                                                           REQUIRED><br>
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
                $newsdata = $db->query("SELECT date, name FROM news ORDER BY date DESC");
                if ($newsdata->count()) {
                    foreach ($newsdata->results() as $news) {
                        echo '<div class="well nieuwsDiv"><a href="/artikel/' . escape($news->name) . '"><h3>' . escape(str_replace('-', ' ', $news->name)) . '</h3></a><p>Upload datum: ' . escape(explode(" ", $news->date)[0]) . '</p></div>';
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
    </script>
<?php include '../includes/htmlUnder.php'; ?>