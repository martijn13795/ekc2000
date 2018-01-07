<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php'; ?>
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
        <link rel="stylesheet"
              href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/fonts/font-awesome/css/font-awesome.min.css">
        <!-- Bootstrap -->
        <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/css/<?php if (isset($_COOKIE["darkTheme"]) && $_COOKIE["darkTheme"] === "true") {
            echo "dark-";
        } ?>style.css" rel="stylesheet">
        <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery-2.2.2.min.js"
                type="text/javascript"></script>
        <script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/js/my_script.js" type="text/javascript"></script>
        <script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/js/bootstrap.min.js"></script>
    </head>
<body>
    <!--    firework begin -->
    <style>
        .pyro:hover {
            cursor: default;
        }

        .pyro > .before, .pyro > .after {
            -webkit-transform: translate3d(0, 0, 0);
            -webkit-transform-style: preserve-3d;
            -webkit-backface-visibility: hidden;
            -webkit-animation-fill-mode: forwards;
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            opacity: 1;
            visibility: visible;
            transition: opacity 1.25s, visibility 0s;
            box-shadow: 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff;
            -moz-animation: 1.25s bang ease-out infinite forwards, 1.25s gravity ease-in infinite forwards, 6.25s position linear infinite forwards;
            -webkit-animation: 1.25s bang ease-out infinite forwards, 1.25s gravity ease-in infinite forwards, 6.25s position linear infinite forwards;
            -o-animation: 1.25s bang ease-out infinite forwards, 1.25s gravity ease-in infinite forwards, 6.25s position linear infinite forwards;
            -ms-animation: 1.25s bang ease-out infinite forwards, 1.25s gravity ease-in infinite forwards, 6.25s position linear infinite forwards;
            animation: 1.25s bang ease-out infinite forwards, 1.25s gravity ease-in infinite forwards, 6.25s position linear infinite forwards;
        }

        .pyro > .after {
            -webkit-transform: translate3d(0, 0, 0);
            -webkit-transform-style: preserve-3d;
            -webkit-backface-visibility: hidden;
            -webkit-animation-fill-mode: forwards;
            -moz-animation-delay: 6s, 6s, 6s, 6s;
            -webkit-animation-delay: 6s, 6s, 6s, 6s;
            -o-animation-delay: 6s, 6s, 6s, 6s;
            -ms-animation-delay: 6s, 6s, 6s, 6s;
            animation-delay: 6s, 6s, 6s, 6s;
            -moz-animation-duration: 1.25s, 1.25s, 6.25s;
            -webkit-animation-duration: 1.25s, 1.25s, 6.25s;
            -o-animation-duration: 1.25s, 1.25s, 6.25s;
            -ms-animation-duration: 1.25s, 1.25s, 6.25s;
            animation-duration: 1.25s, 1.25s, 6.25s;
        }

        @-webkit-keyframes bang {
            to {
                box-shadow: 191px -20px #ff6a00, 0 -135px #9500ff, -133px -157px #0d00ff, -188px 27px #0900ff, -19px -122px #a600ff, -235px -267px #5500ff, -216px -283px #ff9d00, -88px -333px #ffc800, 236px -248px #00ff2f, -72px -151px #6a00ff, -190px -259px #09ff00, -15px 55px #0004ff, -184px -168px #ff0066, -141px -350px #00ffe6, 184px -324px #ffe100, 9px -290px #0033ff, 163px -77px #ff4000, -230px -281px #ffbf00, -194px -136px #ff00a6, 74px 9px #00ff80, -247px -316px #4d00ff, 55px -284px #8400ff, -60px -59px #3300ff, 147px -375px #ff0044, -123px -68px #fbff00, -19px -51px #001eff, -249px -304px #ff006f, -233px -185px #80ff00, 232px -143px cyan, -227px 68px #4000ff, -32px 67px #e6ff00, 230px -68px #fffb00, -157px -413px #ff9500, 5px -227px #ff5100, -6px -396px #00b7ff, -244px -242px #0091ff, 207px -256px #00aaff, 249px -142px red, 234px 51px #bb00ff, 12px -53px #7700ff, -158px -72px #ff0009, 193px -187px #0091ff, 140px 2px #ff005e, -215px -71px #bfff00, 200px -149px #00ff8c, -88px 3px #ff4d00, 38px -152px #ff9d00, 29px -174px #04ff00, 1px -117px #00a2ff, 99px -71px #00ff40, 230px -302px #0051ff;
            }
        }
        @-moz-keyframes bang {
            to {
                box-shadow: 191px -20px #ff6a00, 0 -135px #9500ff, -133px -157px #0d00ff, -188px 27px #0900ff, -19px -122px #a600ff, -235px -267px #5500ff, -216px -283px #ff9d00, -88px -333px #ffc800, 236px -248px #00ff2f, -72px -151px #6a00ff, -190px -259px #09ff00, -15px 55px #0004ff, -184px -168px #ff0066, -141px -350px #00ffe6, 184px -324px #ffe100, 9px -290px #0033ff, 163px -77px #ff4000, -230px -281px #ffbf00, -194px -136px #ff00a6, 74px 9px #00ff80, -247px -316px #4d00ff, 55px -284px #8400ff, -60px -59px #3300ff, 147px -375px #ff0044, -123px -68px #fbff00, -19px -51px #001eff, -249px -304px #ff006f, -233px -185px #80ff00, 232px -143px cyan, -227px 68px #4000ff, -32px 67px #e6ff00, 230px -68px #fffb00, -157px -413px #ff9500, 5px -227px #ff5100, -6px -396px #00b7ff, -244px -242px #0091ff, 207px -256px #00aaff, 249px -142px red, 234px 51px #bb00ff, 12px -53px #7700ff, -158px -72px #ff0009, 193px -187px #0091ff, 140px 2px #ff005e, -215px -71px #bfff00, 200px -149px #00ff8c, -88px 3px #ff4d00, 38px -152px #ff9d00, 29px -174px #04ff00, 1px -117px #00a2ff, 99px -71px #00ff40, 230px -302px #0051ff;
            }
        }
        @-o-keyframes bang {
            to {
                box-shadow: 191px -20px #ff6a00, 0 -135px #9500ff, -133px -157px #0d00ff, -188px 27px #0900ff, -19px -122px #a600ff, -235px -267px #5500ff, -216px -283px #ff9d00, -88px -333px #ffc800, 236px -248px #00ff2f, -72px -151px #6a00ff, -190px -259px #09ff00, -15px 55px #0004ff, -184px -168px #ff0066, -141px -350px #00ffe6, 184px -324px #ffe100, 9px -290px #0033ff, 163px -77px #ff4000, -230px -281px #ffbf00, -194px -136px #ff00a6, 74px 9px #00ff80, -247px -316px #4d00ff, 55px -284px #8400ff, -60px -59px #3300ff, 147px -375px #ff0044, -123px -68px #fbff00, -19px -51px #001eff, -249px -304px #ff006f, -233px -185px #80ff00, 232px -143px cyan, -227px 68px #4000ff, -32px 67px #e6ff00, 230px -68px #fffb00, -157px -413px #ff9500, 5px -227px #ff5100, -6px -396px #00b7ff, -244px -242px #0091ff, 207px -256px #00aaff, 249px -142px red, 234px 51px #bb00ff, 12px -53px #7700ff, -158px -72px #ff0009, 193px -187px #0091ff, 140px 2px #ff005e, -215px -71px #bfff00, 200px -149px #00ff8c, -88px 3px #ff4d00, 38px -152px #ff9d00, 29px -174px #04ff00, 1px -117px #00a2ff, 99px -71px #00ff40, 230px -302px #0051ff;
            }
        }
        @-ms-keyframes bang {
            to {
                box-shadow: 191px -20px #ff6a00, 0 -135px #9500ff, -133px -157px #0d00ff, -188px 27px #0900ff, -19px -122px #a600ff, -235px -267px #5500ff, -216px -283px #ff9d00, -88px -333px #ffc800, 236px -248px #00ff2f, -72px -151px #6a00ff, -190px -259px #09ff00, -15px 55px #0004ff, -184px -168px #ff0066, -141px -350px #00ffe6, 184px -324px #ffe100, 9px -290px #0033ff, 163px -77px #ff4000, -230px -281px #ffbf00, -194px -136px #ff00a6, 74px 9px #00ff80, -247px -316px #4d00ff, 55px -284px #8400ff, -60px -59px #3300ff, 147px -375px #ff0044, -123px -68px #fbff00, -19px -51px #001eff, -249px -304px #ff006f, -233px -185px #80ff00, 232px -143px cyan, -227px 68px #4000ff, -32px 67px #e6ff00, 230px -68px #fffb00, -157px -413px #ff9500, 5px -227px #ff5100, -6px -396px #00b7ff, -244px -242px #0091ff, 207px -256px #00aaff, 249px -142px red, 234px 51px #bb00ff, 12px -53px #7700ff, -158px -72px #ff0009, 193px -187px #0091ff, 140px 2px #ff005e, -215px -71px #bfff00, 200px -149px #00ff8c, -88px 3px #ff4d00, 38px -152px #ff9d00, 29px -174px #04ff00, 1px -117px #00a2ff, 99px -71px #00ff40, 230px -302px #0051ff;
            }
        }
        @keyframes bang {
            to {
                box-shadow: 191px -20px #ff6a00, 0 -135px #9500ff, -133px -157px #0d00ff, -188px 27px #0900ff, -19px -122px #a600ff, -235px -267px #5500ff, -216px -283px #ff9d00, -88px -333px #ffc800, 236px -248px #00ff2f, -72px -151px #6a00ff, -190px -259px #09ff00, -15px 55px #0004ff, -184px -168px #ff0066, -141px -350px #00ffe6, 184px -324px #ffe100, 9px -290px #0033ff, 163px -77px #ff4000, -230px -281px #ffbf00, -194px -136px #ff00a6, 74px 9px #00ff80, -247px -316px #4d00ff, 55px -284px #8400ff, -60px -59px #3300ff, 147px -375px #ff0044, -123px -68px #fbff00, -19px -51px #001eff, -249px -304px #ff006f, -233px -185px #80ff00, 232px -143px cyan, -227px 68px #4000ff, -32px 67px #e6ff00, 230px -68px #fffb00, -157px -413px #ff9500, 5px -227px #ff5100, -6px -396px #00b7ff, -244px -242px #0091ff, 207px -256px #00aaff, 249px -142px red, 234px 51px #bb00ff, 12px -53px #7700ff, -158px -72px #ff0009, 193px -187px #0091ff, 140px 2px #ff005e, -215px -71px #bfff00, 200px -149px #00ff8c, -88px 3px #ff4d00, 38px -152px #ff9d00, 29px -174px #04ff00, 1px -117px #00a2ff, 99px -71px #00ff40, 230px -302px #0051ff;
            }
        }
        @-webkit-keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
                visibility: hidden;
                transition: opacity 1.25s, visibility 0s 1.25s;
            }
        }
        @-moz-keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
                visibility: hidden;
                transition: opacity 1.25s, visibility 0s 1.25s;
            }
        }
        @-o-keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
                visibility: hidden;
                transition: opacity 1.25s, visibility 0s 1.25s;
            }
        }
        @-ms-keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
                visibility: hidden;
                transition: opacity 1.25s, visibility 0s 1.25s;
            }
        }
        @keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
                visibility: hidden;
                transition: opacity 1.25s, visibility 0s 1.25s;
            }
        }
        @-webkit-keyframes position {
            0%, 19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }
            20%, 39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }
            40%, 59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }
            60%, 79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }
            80%, 99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }
        @-moz-keyframes position {
            0%, 19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }
            20%, 39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }
            40%, 59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }
            60%, 79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }
            80%, 99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }
        @-o-keyframes position {
            0%, 19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }
            20%, 39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }
            40%, 59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }
            60%, 79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }
            80%, 99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }
        @-ms-keyframes position {
            0%, 19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }
            20%, 39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }
            40%, 59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }
            60%, 79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }
            80%, 99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }
        @keyframes position {
            0%, 19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }
            20%, 39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }
            40%, 59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }
            60%, 79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }
            80%, 99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }
    </style>
    <div style="position: absolute; width: 100%; height: 100%; padding-top: 100px; user-select: none; overflow: hidden; z-index: 100000!important; pointer-events: none;">
        <div class="pyro" style="padding-top: 100px;">
            <div class="before"></div>
            <div class="after"></div>
        </div>
        <div class="pyro" style="padding-top: 600px;">
            <div class="before"></div>
            <div class="after"></div>
        </div>
        <div class="pyro" style="padding-top: 1000px;">
            <div class="before"></div>
            <div class="after"></div>
        </div>
        <div class="pyro" style="padding-top: 1500px;">
            <div class="before"></div>
            <div class="after"></div>
        </div>
        <div class="pyro" style="padding-top: 2000px;">
            <div class="before"></div>
            <div class="after"></div>
        </div>
        <div class="pyro" style="padding-top: 2500px;">
            <div class="before"></div>
            <div class="after"></div>
        </div>
    </div>
    <!-- firework end -->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-70316339-1', 'auto');
        ga('send', 'pageview');

    </script>
<?php
$user_ip = getenv('REMOTE_ADDR');
$info = $_SERVER['HTTP_USER_AGENT'] . "\n\n";
$date = $mysql_date_now = date("Y-m-d H:i:s");

$db = DB::getInstance();
$user = new User();
if ($user->isLoggedIn() && !$user->hasPermission('dev')) {
    $name = $user->data()->name;
} else {
    $name = null;
}
if (!$db->query("SELECT ip FROM visitors WHERE date > NOW() - INTERVAL 1 HOUR AND ip='$user_ip' AND info='$info' AND name='$name'")->count()) {
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
<?php include 'nav.php'; ?>
<?php include 'menu.php'; ?>