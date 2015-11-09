<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';?>
<!--
Martijn Posthuma
Cas van Dinter
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <?php include 'head.php';?>
</head>
<body>
<?php
$user_ip = getenv('REMOTE_ADDR');
$info = $_SERVER['HTTP_USER_AGENT'] . "\n\n";
$date = $mysql_date_now = date("Y-m-d H:i:s");

$db = DB::getInstance();
$user = new User();
if($user->isLoggedIn() && !$user->hasPermission('dev')){
    $name = $user->data()->name;
} else {
    $name = null;
}
if(!$db->query("SELECT ip FROM visitors WHERE date > NOW() - INTERVAL 1 HOUR AND ip='$user_ip' AND info='$info' AND name='$name'")->count()){
    if ($user_ip != '127.0.0.1') {
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
        $city = $geo["geoplugin_city"];
        $region = $geo["geoplugin_regionName"];
        $country = $geo["geoplugin_countryName"];
    } else {
        $city = "LocalHost";
        $region = "LocalHost";
        $country = "LocalHost";
    }
    $db->query("INSERT INTO visitors (ip, name, city, region, country, date, info) VALUES ('$user_ip', '$name',  '$city', '$region', '$country', '$date', '$info')");
}
?>
<?php include 'nav.php';?>
<?php include 'menu.php';?>
<?php include 'footer.php';?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>
</body>
</html>