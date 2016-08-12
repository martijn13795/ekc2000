<?php include '../includes/html.php'; ?>
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <h1>Wedstrijdverslagen</h1>
            <hr>
            <?php if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('reportupload'))) { ?>
                    <div class="hidden visible-lg">
                        <button class="btn btn-primary" id="upload" onclick="showUpload()">Upload</button><br><br>
                        <div id="uploadContainer" hidden>
                        <form method="post" name="myForm" class="myForm" action="../includes/wedstrijdverslagenUpload.php">
                            <label>Naam van het verslag:</label>
                            <input type="text" class="form-control" placeholder="Naam" id="name" name="name" maxlength="256" REQUIRED/><br>
                            <label>Datum van de wedstrijd:</label><input type="text" class="form-control" name="matchDate" placeholder="YYYY-MM-DD" REQUIRED><br>
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
                            <input type="submit" onClick="CKupdate()" id="submit" class="btn btn-success">
                        </form>
                        <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button>
                        <br>
                        <div id="error"></div>
                    </div>
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
    </div>
    <script>
        function update(updateThing, updateId){
            window.location = '/bewerk/' + updateThing + '/' + updateId;
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
                    if (response == "<h3>Het verslag is geupload</h3>Refresh de pagina<br><br>"){
                        $("#submit").hide();
                        $("#refresh").show();
                        $('.alerts').append('<div class="alert alert-success alert-dismissable">' +
                            '<button class="close" data-dismiss="alert">&times;</button>' +
                            'Het verslag is geupload' +
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