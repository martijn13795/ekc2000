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
    <link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/css/bootstrap-image-gallery.min.css">

    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="msapplication-TileImage" content="/images/favicon/mstile-144x144.png">
    <meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/fonts/font-awesome/css/font-awesome.min.css">
    <!-- Bootstrap -->
    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/css/style.css" rel="stylesheet">
    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery-2.2.2.min.js" type="text/javascript"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/js/my_script.js" type="text/javascript"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/js/bootstrap.min.js"></script>
</head>
<body>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-70316339-1', 'auto');
        ga('send', 'pageview');

        // The star of every good animation
        var requestAnimationFrame = window.requestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.msRequestAnimationFrame;

        var transforms = ["transform",
            "msTransform",
            "webkitTransform",
            "mozTransform",
            "oTransform"];

        var transformProperty = getSupportedPropertyName(transforms);

        // Array to store our Snowflake objects
        var snowflakes = [];

        // Global variables to store our browser's window size
        var browserWidth;
        var browserHeight;

        // Specify the number of snowflakes you want visible
        var numberOfSnowflakes = 50;

        // Flag to reset the position of the snowflakes
        var resetPosition = false;

        //
        // It all starts here...
        //
        function setup() {
            window.addEventListener("DOMContentLoaded", generateSnowflakes, false);
            window.addEventListener("resize", setResetFlag, false);
        }
        setup();

        //
        // Vendor prefix management
        //
        function getSupportedPropertyName(properties) {
            for (var i = 0; i < properties.length; i++) {
                if (typeof document.body.style[properties[i]] != "undefined") {
                    return properties[i];
                }
            }
            return null;
        }

        //
        // Constructor for our Snowflake object
        //
        function Snowflake(element, radius, speed, xPos, yPos) {

            // set initial snowflake properties
            this.element = element;
            this.radius = radius;
            this.speed = speed;
            this.xPos = xPos;
            this.yPos = yPos;

            // declare variables used for snowflake's motion
            this.counter = 0;
            this.sign = Math.random() < 0.5 ? 1 : -1;

            // setting an initial opacity and size for our snowflake
            this.element.style.opacity = .1 + Math.random();
            this.element.style.fontSize = 12 + Math.random() * 50 + "px";
        }

        //
        // The function responsible for actually moving our snowflake
        //
        Snowflake.prototype.update = function () {

            // using some trigonometry to determine our x and y position
            this.counter += this.speed / 5000;
            this.xPos += this.sign * this.speed * Math.cos(this.counter) / 40;
            this.yPos += Math.sin(this.counter) / 40 + this.speed / 30;

            // setting our snowflake's position
            setTranslate3DTransform(this.element, Math.round(this.xPos), Math.round(this.yPos));

            // if snowflake goes below the browser window, move it back to the top
            if (this.yPos > browserHeight) {
                this.yPos = -50;
            }
        }

        //
        // A performant way to set your snowflake's position
        //
        function setTranslate3DTransform(element, xPosition, yPosition) {
            var val = "translate3d(" + xPosition + "px, " + yPosition + "px" + ", 0)";
            element.style[transformProperty] = val;
        }

        //
        // The function responsible for creating the snowflake
        //
        function generateSnowflakes() {

            // get our snowflake element from the DOM and store it
            var originalSnowflake = document.querySelector(".snowflake");

            // access our snowflake element's parent container
            var snowflakeContainer = originalSnowflake.parentNode;

            // get our browser's size
            browserWidth = document.documentElement.clientWidth;
            browserHeight = document.documentElement.clientHeight;

            // create each individual snowflake
            for (var i = 0; i < numberOfSnowflakes; i++) {

                // clone our original snowflake and add it to snowflakeContainer
                var snowflakeCopy = originalSnowflake.cloneNode(true);
                snowflakeContainer.appendChild(snowflakeCopy);

                // set our snowflake's initial position and related properties
                var initialXPos = getPosition(50, browserWidth);
                var initialYPos = getPosition(50, browserHeight);
                var speed = 5+Math.random()*40;
                var radius = 4+Math.random()*10;

                // create our Snowflake object
                var snowflakeObject = new Snowflake(snowflakeCopy,
                    radius,
                    speed,
                    initialXPos,
                    initialYPos);
                snowflakes.push(snowflakeObject);
            }

            // remove the original snowflake because we no longer need it visible
            snowflakeContainer.removeChild(originalSnowflake);

            // call the moveSnowflakes function every 30 milliseconds
            moveSnowflakes();
        }

        //
        // Responsible for moving each snowflake by calling its update function
        //
        function moveSnowflakes() {
            for (var i = 0; i < snowflakes.length; i++) {
                var snowflake = snowflakes[i];
                snowflake.update();
            }

            // Reset the position of all the snowflakes to a new value
            if (resetPosition) {
                browserWidth = document.documentElement.clientWidth;
                browserHeight = document.documentElement.clientHeight;

                for (var i = 0; i < snowflakes.length; i++) {
                    var snowflake = snowflakes[i];

                    snowflake.xPos = getPosition(50, browserWidth);
                    snowflake.yPos = getPosition(50, browserHeight);
                }

                resetPosition = false;
            }

            requestAnimationFrame(moveSnowflakes);
        }

        //
        // This function returns a number between (maximum - offset) and (maximum + offset)
        //
        function getPosition(offset, size) {
            return Math.round(-1*offset + Math.random() * (size+2*offset));
        }

        //
        // Trigger a reset of all the snowflakes' positions
        //
        function setResetFlag(e) {
            resetPosition = true;
        }
    </script>
<div id="snowflakeContainer"><p class="snowflake">*</p></div>
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