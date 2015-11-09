<?php include '../includes/html.php';
$db = DB::getInstance();
?>
    <div class="container">
        <h1 id="title">Team</h1>
        <div style="float: right; margin-top: -40px;">
            <form>
                <select class="form-control" id="teams">
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
                </select>
            </form>
        </div>
        <hr>
        <div class="row" id="teamData">
            <!-- Wordt ingeladen -->
        </div>
    </div>

<script>
    $(document).ready(function(){
        var e = document.getElementById("teams");
        var value = e.options[e.selectedIndex].value;
        $('#teamData').load('../includes/showTeam.php?id=' + value);
        $('#title').text('Team - ' + e.options[e.selectedIndex].innerHTML);
        $('#teams').change(function(){
            var e = document.getElementById("teams");
            var value = e.options[e.selectedIndex].value;
            $('#teamData').load('../includes/showTeam.php?id=' + value);
            $('#title').text('Team - ' + e.options[e.selectedIndex].innerHTML);
        });
    });
</script>
<?php include '../includes/htmlUnder.php'; ?>