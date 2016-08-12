<?php include '../includes/html.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('teamedit'))) {
    ?>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <h1>Bewerk teams</h1>
        <hr>
        <label>Selecteer team:</label>
        <form>
            <select class="form-control" id="teams">
                <option disabled selected value="">Kies een team</option>
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
            </select>
        </form>
        <br>
        <div id="teamData">
            <!-- Wordt ingeladen -->
        </div>
        <?php
        } else {
            include_once '403.php';
        }
        ?>
    </div>
    <script>
        $(document).ready(function(){
            var e = document.getElementById("teams");
            var value = e.options[e.selectedIndex].value;
            $('#teamData').load('../includes/showEditTeam.php?id=' + value);
            $('#teams').change(function(){
                var e = document.getElementById("teams");
                var value = e.options[e.selectedIndex].value;
                $('#teamData').load('../includes/showEditTeam.php?id=' + value);
            });
        });

        function removeTeam(id){
            if (!$(".alert").hasClass("on")) {
                $('.alerts').append('<div class="alert alert-danger alert-dismissable">' +
                    '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
                    'Weet u zeker dat u dit team wilt verwijderen?<br><br>Alle leden en trainers die nog in het team zitten worden eruit gehaald<br><br>' +
                    '<button class="btn btn-warning" onclick="removeTrue(' + id + ') & $(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Verwijderen</button>&#09;' +
                    '<button class="btn btn-success" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
                    '</div>');
                setTimeout(function () {
                    $('.alerts').children('.alert:last-child').addClass('on');
                }, 10);
            }
        }

        function removeTrue(id){
            $.get('../includes/editTeam.php?id=' + id + '&data=delete&colum=delete'), function(data){
                $('#result').html(data);
            };
            location.reload();
        }
    </script>
<?php include '../includes/htmlUnder.php'; ?>