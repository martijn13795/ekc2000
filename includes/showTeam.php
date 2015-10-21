<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
    $db = DB::getInstance();
    $id = escape($_GET['id']);
    $team = $db->query("SELECT * FROM teams WHERE id = '$id'");
    if($team->count()) {
        $team = $team->first();
        ?>
        <div class="col-md-6 col-xs-12">
            <img src="<?php echo escape($team->path); ?>" alt="<?php echo escape($team->name); ?>" class="img-responsive"/><br>
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
                $trainers = $db->query("SELECT * FROM trainers WHERE team_id = '$team->id'");
                if($trainers->count()){
                    foreach ($trainers->results() as $trainer){
                        $user = $db->query("SELECT name FROM users WHERE id = '$trainer->user_id'");
                        if($user->count()){
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
                    <th class="tableHeader">Heren</th>
                    <th class="tableHeader">Dames</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Martijn Posthuma</td>
                    <td>Nina Pauwels</td>
                </tr>
                <tr>
                    <td>Rens van der Ploeg</td>
                    <td>Sanne Schutrups</td>
                </tr>
                <tr>
                    <td>Simon Guichelaar</td>
                    <td>Nathalie ten Broeke</td>
                </tr>
                <tr>
                    <td>Hugo Okken</td>
                    <td>Thirza Venema</td>
                </tr>
                <tr>
                    <td>Mark Vemanen</td>
                    <td>Diede Gras</td>
                </tr>
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
                    src="http://www.antilopen.nl/competitie/standen.asp?ci=54&clubstyle=EKC2000&t=A1"></iframe>
        </div>

        <?php
    }
} else {

}