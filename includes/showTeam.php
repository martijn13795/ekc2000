<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $db = DB::getInstance();
    $id = escape($_GET['id']);
    $team = $db->query("SELECT * FROM teams WHERE id = '$id'");
    if ($team->count()) {
        $team = $team->first();
        ?>
        <div class="col-md-6 col-xs-12">
            <img src="<?php echo escape($team->path); ?>" alt="<?php echo escape($team->name); ?>"
                 class="img-responsive"/><br>
        </div>
        <div class="col-md-6 col-xs-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="tableHeader">Trainers/Coaches</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $trainers = $db->query("SELECT user_id FROM trainers WHERE team_id = '$team->id'");
                if ($trainers->count()) {
                    foreach ($trainers->results() as $trainer) {
                        $user = $db->query("SELECT name FROM users WHERE id = '$trainer->user_id'");
                        if ($user->count()) {
                            echo "<tr><td>" . $user->first()->name . "</td></tr>";
                        }
                    }
                } else {
                    echo "<tr><td>Geen</td></tr>";
                }
                ?>
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="tableHeaderPlayers">Heren</th>
                    <th class="tableHeaderPlayers">Dames</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $players = $db->query("SELECT user_id FROM players WHERE team_id = '$team->id'");
                if ($players->count()) {
                    $playersTeam = array(array(), array());
                    foreach ($players->results() as $player) {
                        $user = $db->query("SELECT name, gender FROM users WHERE id = '$player->user_id'");
                        if ($user->count()) {
                            if($user->first()->gender === 'M'){
                                $playersTeam[0][] = escape($user->first()->name);
                            } elseif ($user->first()->gender === 'F'){
                                $playersTeam[1][] = escape($user->first()->name);
                            }
                        }
                    }
                    if(count($playersTeam[0]) === count($playersTeam[1])){
                        for($i = 0; $i < count($playersTeam[0]); $i++){
                            echo "<tr><td>" . escape($playersTeam[0][$i]) . "</td><td>" . escape($playersTeam[1][$i]) . "</td></tr>";
                        }
                    }
                    if(count($playersTeam[0]) > count($playersTeam[1])){
                        for($i = 0; $i < count($playersTeam[0]); $i++){
                            echo "<tr>";
                            echo "<tr><td>" . escape($playersTeam[0][$i]) . "</td>";
                            if(array_key_exists($i, $playersTeam[1])){
                                echo "<td>" . escape($playersTeam[1][$i]) . "</td>";
                            } else {
                                echo "<td></td>";
                            }
                            echo "</tr>";
                        }
                    }
                    if(count($playersTeam[0]) < count($playersTeam[1])){
                        for($i = 0; $i < count($playersTeam[1]); $i++){
                            echo "<tr>";
                            if(array_key_exists($i, $playersTeam[0])){
                                echo "<td>" . escape($playersTeam[0][$i]) . "</td>";
                            } else {
                                echo "<td></td>";
                            }
                            echo "<td>" . escape($playersTeam[1][$i]) . "</td>";
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td>Geen</td><td>Geen</td></tr>";
                }
                ?>
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="tableHeader" colspan="2">Trainingstijden</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Dinsdag</th>
                    <td>19:00 t/m 20:00</td>
                </tr>
                <tr>
                    <th>Vrijdag</th>
                    <td>19:00 t/m 20:00</td>
                </tr>
                </tbody>
            </table>
            <iframe style="width: 100%; height: 320px;" border="0" frameborder="0"
                    src="http://www.antilopen.nl/competitie/standen.asp?ci=54&clubstyle=EKC2000&t=<?php echo escape($team->name); ?>"></iframe>
        </div>

        <?php
    } else {
        echo "<p>Er is iets mis gegaan. Dit team bestaat niet.</p>";
    }
} else {
    echo "<p>Er is geen team gekozen.</p>";
}