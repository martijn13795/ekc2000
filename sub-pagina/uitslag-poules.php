<?php include '../includes/html.php';?>
<div class="container">
    <div><br>
        <?php
        $URL = "http://www.antilopen.nl/competitie/uitslagen.asp?h=f&cp=54&clubstyle=EKC2000&nolink=true";
        $ch = curl_init( $URL );
        curl_exec( $ch );
        curl_close( $ch );
        ?>
    </div>
</div>
<?php include '../includes/htmlUnder.php'; ?>

