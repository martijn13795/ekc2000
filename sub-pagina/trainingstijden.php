<?php include '../includes/html.php';?>
    <div class="container">
        <h1>Trainingstijden</h1><hr>
        <div class="col-md-12 col-xs-12">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="row" class="tableHeader">Teams</th>
                    <th scope="row" class="tableHeader" colspan="5">Trainingstijden</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $teams = $db->query("SELECT id, name FROM teams");
                if ($teams->count()) {
                    $teamsArray = array();
                    foreach ($teams->results() as $team) {
                        $teamsArray[escape($team->id)] = escape($team->name);
                    }
                    $days = $db->query("SELECT name FROM days");
                    $dayscount = 0;
                    if($days->count()){
                        $dayscount = $days->count();
                        echo '<th scope="row" class="tableHeader"></th>';
                        foreach($days->results() as $day){
                            echo '<th scope="row" class="tableHeader">'. escape($day->name) .'</th>';
                        }
                    } else {
                        echo '<tr><th></th><td>Geen trainingstijden beschikbaar</td></tr>';
                        exit;
                    }
                    asort($teamsArray);
                    foreach ($teamsArray as $id => $name){
                        echo '<tr><th scope="row">'.escape($name).'</th>';
                        for($i = 1; $i <= $dayscount; $i++){
                            $schedule = $db->query("SELECT * FROM schedules WHERE team_id = '$id' AND day_id = '$i'");
                            if($schedule->count()){
                                echo "<td>"
                                    . escape(explode(":", $schedule->first()->start)[0] . ":" . explode(":", $schedule->first()->start)[1])
                                    . " t/m "
                                    . escape(explode(":", $schedule->first()->end)[0] . ":" . explode(":", $schedule->first()->end)[1])
                                    . " " . $schedule->first()->location
                                    . "</td>";
                            } else {
                                echo "<td></td>";
                            }
                        }
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><th>Geen teams beschikbaar</th><td></td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include '../includes/htmlUnder.php'; ?>