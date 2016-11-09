<?php include '../includes/html.php';?>
    <div class="container">
        <h1>Zaal-/kantinedienst</h1>
        <div>
            <?php
            $URL = "http://www.antilopen.nl/competitie/diensten.asp?h=f&ci=54&d=442&inschrijven=false&alles=true&clubstyle=EKC2000";
            $ch = curl_init( $URL );
            curl_exec( $ch );
            curl_close( $ch );
            ?>
        </div>
    </div>
<?php include '../includes/htmlUnder.php'; ?>
<script>
    $('table').addClass("table");
</script>
