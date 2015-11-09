<?php include '../includes/html.php'; ?>
<div class="container">
    <div class="col-md-12 col-xs-12"><br>
        <?php
        $db = DB::getInstance();
        $name = $_GET['artikelName'];
        $newsdata = $db->query("SELECT text FROM news WHERE name = '" . $name . "'");
        if ($newsdata->count()) {
            foreach ($newsdata->results() as $news) {
                echo '
                    <div class="artikelDiv">
                        <span>'. $news->text .'</span>
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
<?php include '../includes/htmlUnder.php'; ?>