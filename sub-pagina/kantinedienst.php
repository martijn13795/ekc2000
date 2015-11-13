<?php include '../includes/html.php';?>
    <div class="container">
        <h1>Zaal-/kantinedienst</h1>
        <div>
            <?php
            $url = "http://www.antilopen.nl/competitie/diensten.asp?ci=54&d=355&inschrijven=false&alles=true&clubstyle=EKC2000";

            $str = file_get_contents($url);

            function get_url_contents($url){
                $crl = curl_init();
                $timeout = 5;
                curl_setopt ($crl, CURLOPT_URL,$url);
                curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
                $ret = curl_exec($crl);
                curl_close($crl);
                return $ret;
            }

            echo get_url_contents($url);
            ?>
        </div>
    </div>
<?php include '../includes/htmlUnder.php'; ?>
<script>
    $('table').addClass("table table-striped");
</script>
