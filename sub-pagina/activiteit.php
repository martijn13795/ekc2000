<?php include '../includes/html.php'; ?>
<div class="container">
    <div class="col-md-12 col-xs-12"><br>
        <?php
        $db = DB::getInstance();
        $name = $_GET['activiteitName'];
        $activiteiten = $db->query("SELECT text FROM activiteiten WHERE name = '" . $name . "'");
        if ($activiteiten->count()) {
            foreach ($activiteiten->results() as $activiteit) {
                echo '
                    <div class="artikelDiv">
                        <span>'. $activiteit->text .'</span>
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
<script>
    $("img").addClass("img-responsive");
    $('.img-responsive').removeAttr("height").css({ height: "" });
</script>