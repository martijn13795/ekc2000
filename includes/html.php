<!DOCTYPE html>
<html lang="nl">
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';?>
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
if($user->isLoggedIn()){
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

/*
* Getting MAC Address using PHP
* Md. Nazmul Basher
*/

ob_start(); // Turn on output buffering
system('ipconfig /all'); //Execute external program to display output
$mycom=ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean (erase) the output buffer

$findme = "Physical";
$pmac = strpos($mycom, $findme); // Find the position of Physical text
$mac=substr($mycom,($pmac+36),17); // Get Physical Address

echo $mac;

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