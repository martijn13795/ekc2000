<?php
include '../includes/html.php';

if ($user->isLoggedIn()) {
    if ($user->hasPermission('dev')) {
        ?>
        <div class="container">
            <h1>Info</h1><hr>
            <table class="table table-striped table-bordered myTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>IP</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Region</th>
                    <th>Country</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $visitors = $db->query("SELECT * FROM visitors WHERE country = 'Netherlands' ORDER BY id DESC");
                if ($visitors->count()) {
                    $totalNL = 0;
                    foreach ($visitors->results() as $visitor) {
                        $totalNL++;
                        echo '
                            <tr>
                                <td>' . escape($visitor->id) . '</td>
                                <td>' . escape($visitor->ip) . '</td>
                                <td>' . escape($visitor->name) . '</td>
                                <td>' . escape($visitor->city) . '</td>
                                <td>' . escape($visitor->region) . '</td>
                                <td>' . escape($visitor->country) . '</td>
                                <td>' . escape($visitor->date) . '</td>
                            </tr>
                             ';
                    }
                    echo "Aantal resultaten: " . $totalNL . "<br><br>";
                }
                ?>
                </tbody>
            </table><br><br><br><br>
        </div>
        <?php
    } else {
        ?>
        <div class="container">
            <div class="col-md-12 col-xs-12">
                <h1>Oeps! - U heeft niet het rechten om deze pagina te bezoeken</h1>
            </div>
            <div class="col-md-12 col-xs-12">
                <img class="img-responsive errorImg" src="../images/403Error.png" alt="403 Error"/>
                <a onclick="history.back()" class="btn btn-primary">Ga terug</a>
            </div>
        </div>
        <?php
    }
}else{
    ?>
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <h1>Oeps! - U heeft niet het rechten om deze pagina te bezoeken</h1>
        </div>
        <div class="col-md-12 col-xs-12">
            <img class="img-responsive errorImg" src="../images/403Error.png" alt="403 Error"/>
            <a onclick="history.back()" class="btn btn-primary">Ga terug</a>
        </div>
    </div>
<?php
}
?>
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css"/>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.myTable').DataTable();
    } );

    $('th').css('background', 'transparent');
</script>
<?php include '../includes/htmlUnder.php'; ?>