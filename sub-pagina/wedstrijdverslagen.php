<?php include '../includes/html.php'; ?>
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <h1>Wedstrijdverslagen</h1>
        <hr>
        <?php if ($user->isLoggedIn()) { ?>
                <div class="hidden visible-lg">
                    <button class="btn btn-primary" id="upload" onclick="showUpload()">Upload</button><br><br>
                    <div id="uploadContainer" hidden>
                    <form method="post" name="myForm" class="myForm" action="../includes/wedstrijdverslagenUpload.php">
                        <label>Naam van het verslag:</label>
                        <input type="text" class="form-control" placeholder="Naam" id="name" name="name" REQUIRED/><br>
                        <label>Datum van de wedstrijd:</label><input type="text" class="form-control" name="matchDate"
                                                                     placeholder="YYYY-MM-DD" REQUIRED><br>
                        <label>Van welk team is het verslag:</label>
                        <select name="team" class="form-control" id="team" REQUIRED>
                            <option disabled selected value="">Selecteer een team</option>
                            <?php
                            $teams = $db->query("SELECT id, name FROM teams");
                            if ($teams->count()) {
                                $teamsArray = array();
                                foreach ($teams->results() as $team) {
                                    $teamsArray[escape($team->id)] = escape($team->name);
                                }
                                asort($teamsArray);
                                foreach ($teamsArray as $id => $name) {
                                    echo '<option value="' . escape($id) . '">' . escape($name) . '</option>';
                                }
                            } else {
                                echo '<option>Geen</option>';
                            }
                            ?>
                        </select><br>
                        <textarea class="ckeditor" id="editor1" name="editor1"></textarea></br>
                        <input type="submit" id="submit" class="btn btn-success">
                    </form>
                </div>
                <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button>

                <div id="error"></div>
            </div>
            <?php
        }
        ?>
        <h3 id="title">Team</h3>

        <div style="float: right; margin-top: -40px;">
            <form>
                <select class="form-control" id="teams">
                    <option value="0">Alles</option>
                    <?php
                    $teams = $db->query("SELECT id, name FROM teams");
                    if ($teams->count()) {
                        $teamsArray = array();
                        foreach ($teams->results() as $team) {
                            $teamsArray[escape($team->id)] = escape($team->name);
                        }
                        asort($teamsArray);
                        foreach ($teamsArray as $id => $name) {
                            echo '<option value="' . escape($id) . '">' . escape($name) . '</option>';
                        }
                    }
                    ?>
                </select>
            </form>
        </div>
        <br>

        <div class="row" id="teamData">
            <!-- Wordt ingeladen -->
        </div>
    </div>
    <script>
        $('#editor1').closest('form').submit(CKupdate);

        function CKupdate() {
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances[instance].updateElement();
            return true;
        }

        $(document).ready(function () {
            $('.myForm').ajaxForm({
                beforeSend: function () {
                    $("#submit").hide();
                    $("#error").show();
                    $("#error").html('<h3>Even geduld alstublieft</h3><p>Refresh de pagina niet</p>');
                },
                success: function (response) {
                    $("#refresh").show();
                    $("#error").show();
                    $("#error").html(response);
                    $("#name").val('');
                    $("#team").val('');
                    $("#editor1").val('');
                }
            });
            $("#refresh").hide();
            $("#error").hide();
        });

        $(document).ready(function () {
            var e = document.getElementById("teams");
            var value = e.options[e.selectedIndex].value;
            $('#teamData').load('../includes/showWedstrijdverslagen.php?id=' + value);
            $('#title').text('Team - ' + e.options[e.selectedIndex].innerHTML);
            $('#teams').change(function () {
                var e = document.getElementById("teams");
                var value = e.options[e.selectedIndex].value;
                $('#teamData').load('../includes/showWedstrijdverslagen.php?id=' + value);
                $('#title').text('Team - ' + e.options[e.selectedIndex].innerHTML);
            });
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

        function removeReport(id){
            if (!$(".alert").hasClass("on")) {
                $('.alerts').append('<div class="alert alert-danger alert-dismissable">' +
                    '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
                    'Weet u zeker dat u dit verslag wilt verwijderen?<br><br>' +
                    '<button class="btn btn-warning" onclick="removeTrue(' + id + ') & $(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Verwijderen</button>&#09;' +
                    '<button class="btn btn-success" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
                    '</div>');
                setTimeout(function () {
                    $('.alerts').children('.alert:last-child').addClass('on');
                }, 10);
            }
        }

        function removeTrue(id){
            $.get("includes/removeReport.php?id=" + id), function(data){
                $('#result').html(data);
            };
            location.reload();
        }
    </script>
<?php include '../includes/htmlUnder.php'; ?>