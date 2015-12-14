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
                    <label>Naam van activiteit:</label><input type="text" id="activiteitName" class="form-control" name="activiteitName" placeholder="Naam" maxlength="60" REQUIRED><br>
                    <label>Datum van activiteit:</label><input type="text" class="form-control" name="activiteitDate" placeholder="YYYY-MM-DD" REQUIRED><br>
                    <textarea class="ckeditor" id="editor1" name="editor1"></textarea><br>
                    <input type="submit" class="btn btn-primary" value="Upload"/>
                </form>
                <br>

            </div>
            <div id="error"></div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-12 col-xs-12">
                <?php
                }
                $db = DB::getInstance();
                $activities = $db->query("SELECT date, date_activity, name, id, user_id FROM activities ORDER BY date DESC");
                if ($activities->count()) {
                    foreach ($activities->results() as $activity) {
                        echo '<div class="well activiteitDiv">';
                        if (($user->isLoggedIn() && $user->data()->id == $activity->user_id) || $user->hasPermission("admin")) {
                            echo '<i class="fa fa-trash-o" style="float: right;" onclick="removeActivity(' . escape($activity->id) . ')"></i>';
                        }
                        echo '<a href="/activiteit/' . escape($activity->name) . '"><h3>' . escape(str_replace('-', ' ', $activity->name)) . '</h3></a>
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

            function removeActivity(id){
                $.get("includes/removeactivity.php?id=" + id), function(data){
                    $('#result').html(data);
                };
                location.reload();
            }
        </script>
    </div>
<?php include '../includes/htmlUnder.php'; ?>