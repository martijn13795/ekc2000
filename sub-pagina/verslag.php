<?php include '../includes/html.php'; ?>
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <?php
            $db = DB::getInstance();
            $name = $_GET['report'];
            $reports = $db->query("SELECT * FROM reports WHERE name = '" . $name . "'");
            if ($reports->count()) {
                foreach ($reports->results() as $report) {
                    echo '
                    <h1>' . escape(str_replace('-', ' ', $report->name)) . '</h1><hr>
                    <div class="artikelDiv">
                        <span>'. $report->text .'</span>
                    </div>
                ';
                }
            }
            ?>
            <br>
        <button onclick="history.go(-1)" type="button" class="btn btn-primary">
            Ga terug
        </button>
        </div>
    </div>
    <script>
        $("img").addClass("img-responsive");
        $('.img-responsive').removeAttr("height").css({ height: "" });
    </script>
<?php include '../includes/htmlUnder.php'; ?>