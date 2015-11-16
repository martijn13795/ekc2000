<?php include '../includes/html.php';?>
<script src="../ckeditor/ckeditor.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <h1>Wedstrijdverslagen</h1><hr>
        <?php if ($user->isLoggedIn()) { ?>
        <div class="col-md-12 col-xs-12">
            <div class="hidden visible-lg">
                <form method="post" name="myForm" class="myForm" action="../includes/wedstrijdverslagenUpload.php">
                    <label>Naam van het verslag:</label>
                    <input type="text" class="form-control" placeholder="Naam" id="name" name="name" REQUIRED/><br>
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
                            foreach ($teamsArray as $id => $name){
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
            <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button><br><br>
            <div id="error"></div>
        </div>
        <?php
        }
        ?>
        <div class="col-md-12 col-xs-12">
            <?php
                $db = DB::getInstance();
                $reports = $db->query("SELECT * FROM reports ORDER BY date DESC");
                if ($reports->count()) {
                    foreach ($reports->results() as $report) {
                        echo '<div class="well activiteitDiv"><a href="/verslag/' . escape($report->name) . '"><h3>' . escape(str_replace('-', ' ', $report->name)) . '</h3></a><p>Upload datum: ' . escape(explode(" ", $report->date)[0]) . '</p></div>';
                    }
                } else {
                    echo '<div class="well activiteitDiv"><br><h3>Er zijn nog geen verslagen beschikbaar</h3></div>';
                }
            ?>
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
</script>
<?php include '../includes/htmlUnder.php'; ?>