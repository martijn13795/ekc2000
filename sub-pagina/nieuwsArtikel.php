<?php include '../includes/html.php'; ?>
<div class="container">
    <div class="col-md-12 col-xs-12"><br>
        <?php
        $db = DB::getInstance();
        $name = $_GET['artikelName'];
        $nieuwsMessage = $db->query("SELECT text FROM nieuws WHERE name = '" . $name . "'");
        if ($nieuwsMessage->count()) {
            foreach ($nieuwsMessage->results() as $nieuws) {
                echo '
                    <div class="">
                        <span>'. $nieuws->text .'</span>
                    </div>
                ';
            }
        }
        ?>
    <br></div>
    <button onclick="history.go(-1)" type="button" class="btn btn-primary">
        Ga terug
    </button>
</div>