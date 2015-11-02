<?php
include '../includes/html.php';
if ($user->isLoggedIn()) {
    if ($user->hasPermission('dev')) {
        ?>
        <div class="container">
            <h1>Info</h1><hr>
            <table class="table table-bordered table-hover table_sort">
            <thead>
            <tr>
                <th class="tableHeader">ID</th>
                <th class="tableHeader">IP</th>
                <th class="tableHeader">Name</th>
                <th class="tableHeader">City</th>
                <th class="tableHeader">Region</th>
                <th class="tableHeader">Country</th>
                <th class="tableHeader">Date</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $visitors = $db->query("SELECT * FROM visitors WHERE country = 'Netherlands' ORDER BY id DESC");
            if ($visitors->count()) {
                foreach ($visitors->results() as $visitor) {
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
            }
            ?>
            </tbody>
            </table>
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
<script src="../js/jquery.table-sort.js"></script>
<script>
    $(function(){
        $("table.table_sort").sort_table({
            "action" : "init"
        });
    });
</script>