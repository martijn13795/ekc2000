<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';?>
<!--
Martijn Posthuma
Cas van Dinter
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>EKC 2000</title>
    <meta name="Korfbalvereniging EKC 2000" content="Informatie">
    <meta name="Martijn Posthuma" content="Programmer">
    <meta name="Cas van Dinter" content="Programmer">
    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/images/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/favicon/favicon-194x194.png" sizes="194x194">
    <link rel="icon" type="image/png" href="/images/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/images/favicon/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/images/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/images/favicon/manifest.json">
    <link rel="shortcut icon" href="/images/favicon/favicon.ico">

    <!--dit is voor de fotogalerij-->
    <link rel="stylesheet" href="../css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="../css/bootstrap-image-gallery.min.css">

    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="msapplication-TileImage" content="/images/favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="../js/my_script.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-70316339-1', 'auto');
        ga('send', 'pageview');

    </script>
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