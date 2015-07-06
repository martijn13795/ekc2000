<!DOCTYPE html>
<html lang="nl">
<head>
    <?php include 'head.php';?>
</head>
<body>
<?php include 'nav.php';?>
<?php include 'menu.php';?>
<div class="container">
    <div class="col-md-12 col-xs-12">
        <h1>Oeps! - De pagina is niet gevonden</h1>
    </div>
    <div class="col-md-12 col-xs-12">
        <img class="img-responsive errorImg" src="images/404Error.png" alt="404 Error"/>
        <a onclick="history.back()" class="btn btn-large btn-primary"><i class="icon-home icon-white"></i> Ga terug</a>
    </div>
</div>
<?php include 'footer.php';?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>