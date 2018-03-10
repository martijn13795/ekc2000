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
                        $user = $db->query("SELECT name, surname_prefix, surname FROM users WHERE id = '$trainer->user_id'");
                        if ($user->count()) {
                            echo "<tr><td>";
                            echo escape($user->first()->name) . " ";
                            if($user->first()->surname_prefix){
                                echo escape($user->first()->surname_prefix) . " ";
                            }
                            echo escape($user->first()->surname);
                            echo "</td></tr>";
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
                        $user = $db->query("SELECT name, surname_prefix, surname, gender FROM users WHERE id = '$player->user_id'");
                        if ($user->count()) {
                            $name = null;
                            if($user->first()->gender === 'M'){
                                //$playersTeam[0][] = escape($user->first()->name);
                                $name = escape($user->first()->name) . " ";
                                if($user->first()->surname_prefix){
                                    $name .=  escape($user->first()->surname_prefix) . " ";
                                }
                                $name .= escape($user->first()->surname);
                                $playersTeam[0][] = $name;
                            } elseif ($user->first()->gender === 'F'){
                                $name = escape($user->first()->name) . " ";
                                if($user->first()->surname_prefix){
                                    $name .=  escape($user->first()->surname_prefix) . " ";
                                }
                                $name .= escape($user->first()->surname);
                                $playersTeam[1][] = $name;
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
                <?php
                $schedules = $db->query("SELECT * FROM schedules WHERE team_id = '$team->id' ORDER BY day_id");
                if ($schedules->count()) {
                    foreach ($schedules->results() as $schedule) {
                        $day = $db->query("SELECT name FROM days WHERE id = '$schedule->day_id'");
                        if($day->count()){
                            echo "<tr><th>" . escape($day->first()->name) . "</th><td>"
                                . escape(explode(":", $schedule->start)[0] . ":" . explode(":", $schedule->start)[1])
                                . " t/m "
                                . escape(explode(":", $schedule->end)[0] . ":" . explode(":", $schedule->end)[1])
                                . " " . $schedule->location
                                . "</td></tr>";
                        }
                    }
                } else {
                    echo "<tr><th>Geen trainingstijden beschikbaar</th></tr>";
                }
                ?>
                </tbody>
            </table>
            <?php
            $teamName = escape($team->name);
            if ($teamName == "1e") {
                $teamName = "1";
            }
            if ($teamName == "2e") {
                $teamName = "2";
            }
            if ($teamName == "3e") {
                $teamName = "3";
            }
            if ($teamName == "4e") {
                $teamName = "4";
            }
            ?>
            <iframe style="width: 100%; height: 320px;" border="0" frameborder="0" src="https://www.antilopen.nl/competitie/standen.asp?ci=54&clubstyle=EKC2000&t=<?php echo $teamName; ?>"></iframe>
        </div>

        <?php
    } else {
        echo "<p>Er is iets mis gegaan. Dit team bestaat niet.</p>";
    }
} else {
    echo "<p>Er is geen team gekozen.</p>";
}