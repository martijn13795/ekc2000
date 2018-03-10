<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/html.php';?>
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <h1>Oeps! - De pagina is niet gevonden</h1>
        </div>
        <div class="col-md-12 col-xs-12">
            <img class="img-responsive errorImg" src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/images/404Error.png" alt="404 Error"/>
            <a onclick="history.back()" class="btn btn-primary">Ga terug</a>
        </div>
    </div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/htmlUnder.php';?>