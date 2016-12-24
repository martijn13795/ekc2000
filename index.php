<?php include 'includes/html.php';?>
    <!--    snowflakes begin -->
    <style>
        #snowflakeContainer {
                position: absolute !important;
                left: 0px !important;
                top: 0px !important;
        }
        .snowflake {
                padding-left: 15px;
                font-family: Cambria, Georgia, serif;
                font-size: 14px;
                line-height: 24px;
                position: fixed;
                color: #FFFFFF;
                user-select: none;
                z-index: 1000;
        }
        .snowflake:hover {
                cursor: default;
        }
    </style>
    <script>
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
    <div id="snowflakeContainer">
            <p class="snowflake">*</p>

    <!--snowflakes end -->
<script src="js/jquery.dotdotdot.min.js"></script>
  <div class="visible-xs"><img class="headerImage" src="images/banner.jpg" alt="club foto"/></div>
	    <div class="container">
            <div class="hidden-xs"><img class="headerImage" src="images/banner.jpg" alt="club foto"/></div>
            <div class="col-xs-12 col-md-12">
                <h1>Welkom bij <strong>EKC 2000</strong><?php
                    $user = new User();
                    if ($user->isLoggedIn()){
                        echo ", " . escape($user->data()->name) . " ";
                        if($user->data()->surname_prefix){
                            echo escape($user->data()->surname_prefix) . " ";
                        }
                        echo escape($user->data()->surname);
                    }
                ?></h1>
                <hr>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="col-md-4 col-xs-12 homeInfoDiv">
                        <div class="col-xs-12 col-md-12 well infoDiv">
                            <div class="col-md-4 col-xs-4">
                                <a href="/nieuws"><i class="icon major fa-newspaper-o link"></i></a>
                            </div>
                            <div class="col-md-8 col-xs-8">
                                <a href="/nieuws"><h3>Laatste nieuws</h3></a>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <p>
                                    <?php
                                    $start = new DateTimeImmutable();
                                    $datetime = $start->modify('-7 day');
                                    $newsdata = $db->query("SELECT * FROM news ORDER BY date DESC LIMIT 6");
                                    if ($newsdata->count()) {
                                        foreach ($newsdata->results() as $news) {
                                            $newsDate = new DateTime($news->date);
                                            if ($newsDate >= $datetime) {
                                                ?> <div class="fotoLink artikleDiv row" onclick="window.location='/artikel/<?php echo escape($news->name) ?>'"><div class="dateDiv"><p style="font-weight: bold; margin: 0px; padding: 0px;"><?php echo escape(explode(" ", $news->date)[0]) ?></p></div><div class="titleDiv col-md-8 col-xs-8"><p style="font-weight: bold; margin: 0px; padding: 0px;"><?php echo escape(rawurldecode($news->name)) ?></p></div></div> <?php
                                            } else {
                                                ?> <div class="fotoLink artikleDiv row" onclick="window.location='/artikel/<?php echo escape($news->name) ?>'"><div class="dateDiv"><p style="margin: 0px; padding: 0px;"><?php echo escape(explode(" ", $news->date)[0]) ?></p></div><div class="titleDiv col-md-8 col-xs-8"><p style="margin: 0px; padding: 0px;"><?php echo escape(rawurldecode($news->name)) ?></p></div></div> <?php
                                            }
                                        }
                                    } else {
                                        echo '<p class="fotoLink">Er is nog geen nieuws beschikbaar.</p>';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 homeInfoDiv">
                        <div class="col-xs-12 col-md-12 well infoDiv">
                            <div class="col-md-4 col-xs-4">
                                <a href="/fotogalerij"><i class="icon major fa-camera link"></i></a>
                            </div>
                            <div class="col-md-8 col-xs-8">
                                <a href="/fotogalerij"><h3>Laatste foto albums</h3></a>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <p>
                                    <?php
                                    $albums = $db->query("SELECT * FROM albums WHERE id > 1 ORDER BY date DESC LIMIT 6");
                                    if ($albums->count()) {
                                        foreach ($albums->results() as $album) {
                                            $album_name = str_replace("XY","%",$album->name);
                                            $albumDate = new DateTime($album->date);
                                            if ($albumDate >= $datetime) {
                                                ?> <div class="fotoLink artikleDiv row" onclick="window.location='/album/<?php echo escape($album->name) ?>'"><div class="dateDiv"><p style="font-weight: bold; margin: 0px; padding: 0px;"><?php echo escape(explode(" ", $album->date)[0]) ?></p></div><div class="titleDiv col-md-8 col-xs-8"><p style="font-weight: bold; margin: 0px; padding: 0px;"><?php echo escape(rawurldecode($album_name)) ?></p></div></div> <?php
                                            } else {
                                                ?> <div class="fotoLink artikleDiv row" onclick="window.location='/album/<?php echo escape($album->name) ?>'"><div class="dateDiv"><p style="margin: 0px; padding: 0px;"><?php echo escape(explode(" ", $album->date)[0]) ?></p></div><div class="titleDiv col-md-8 col-xs-8"><p style="margin: 0px; padding: 0px;"><?php echo escape(rawurldecode($album_name)) ?></p></div></div> <?php
                                            }
                                        }
                                    } else {
                                        echo '<p class="fotoLink">Er zijn nog geen albums beschikbaar.</p>';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 homeInfoDiv">
                        <div class="col-xs-12 col-md-12 well infoDiv">
                            <div class="col-md-4 col-xs-4">
                                <a href="/activiteiten"><i class="icon major fa-users link"></i></a>
                            </div>
                            <div class="col-md-8 col-xs-8">
                                <a href="/activiteiten"><h3>Komende activiteiten</h3></a>
                            </div>
                            <div class="col-md-12 col-xs-12">
                            <p>
                                <?php
                                $dateNow = new DateTimeImmutable();
                                $activities = $db->query("SELECT date, date_activity, name FROM activities ORDER BY date_activity DESC LIMIT 6");
                                if ($activities->count()) {
                                    foreach ($activities->results() as $activity) {
                                        $activityDate = new DateTime($activity->date_activity);
                                        if ($activityDate >= $dateNow) {
                                            ?> <div class="fotoLink artikleDiv row" onclick="window.location='/activiteit/<?php echo escape($activity->name) ?>'"><div class="dateDiv"><p style="font-weight: bold; margin: 0px; padding: 0px;"><?php echo escape($activity->date_activity) ?></p></div><div class="titleDiv col-md-8 col-xs-8"><p style="font-weight: bold; margin: 0px; padding: 0px;"><?php echo escape(rawurldecode($activity->name)) ?></p></div></div> <?php
                                        } else {
                                            ?> <div class="fotoLink artikleDiv row" onclick="window.location='/activiteit/<?php echo escape($activity->name) ?>'"><div class="dateDiv"><p style="margin: 0px; padding: 0px;"><?php echo escape($activity->date_activity) ?></p></div><div class="titleDiv col-md-8 col-xs-8"><p style="margin: 0px; padding: 0px;"><?php echo escape(rawurldecode($activity->name)) ?></p></div></div> <?php
                                        }
                                    }
                                } else {
                                    echo '<p class="fotoLink">Er zijn nog geen activiteiten beschikbaar.</p>';
                                }
                                ?>
                            </p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="grayBar">
                <div class="container">
                    <div class="sponsorenDiv">
                        <h1>Onze sponsoren</h1><br>
                        <?php
                        $album = $db->query("SELECT * FROM albums WHERE name ='Sponsoren'");
                        if($album->count()) {
                            $sponsoren = $db->query("SELECT * FROM sponsoren WHERE album_id = '".$album->first()->id."'");
                            if ($sponsoren->count()) {
                                foreach ($sponsoren->results() as $sponsor) {
                                    echo '
                                    <div class="col-md-2 col-xs-2 sponsorenImg">
                                            <img onclick="window.open(\'' . escape($sponsor->link) . '\', \'_blank\');" title="' . escape($sponsor->title) . '" style="cursor: pointer;" class="img-responsive" src="' . escape($sponsor->path) . '" alt="' . escape($sponsor->name) . '"/>
                                    </div>
                                    ';
                                }
                            } else {
                                echo '<p>Er zijn geen sponsoren beschikbaar</p>';
                            }
                        }
                        ?>
                    </div>
                </div><br>
            </div>
        <div class="container">
            <div class="row chatRow">
                <div class="col-md-8 col-xs-12 chatRow">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-7 col-xs-7"><span class="glyphicon glyphicon-comment"></span> Kom in contact en deel wat je denkt in deze chatbox</div>
                                <div class="col-md-5 col-xs-5"><span id="timer" class="glyphicon glyphicon-time"></span></div>
                            </div>
                        </div>
                        <div id="panel-body" class="panel-body">
                            <ul class="chat">
                                <li class="left clearfix">
                            <div class="col-md-12 col-xs-12" id="scroll" style="text-align: center;"><h4 style="margin-bottom: -20px;">Scroll naar boven voor extra berichten</h4><br><br></div>
                                    <div id="totalMessagesDB" hidden><?php echo $db->query("SELECT id FROM messages")->count(); ?></div>
                                </li>
                            </ul>
                            <ul class="chat">
                                <li class="left clearfix">
                                                    <span class="chat-img pull-left">
                                                        <img src="/images/logoChat.png" alt="User Avatar" class="img-circle avatar" />
                                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">EKC 2000</strong> <small class="pull-right text-muted">
                                                <span class="glyphicon glyphicon-time"></span>2015-07-10 13:13:00</small>
                                        </div>
                                        <h1>
                                            Welkom bij de chatbox van EKC 2000
                                        </h1>
                                    </div>
                                </li>
                            </ul>
                            <ul id="chatRefresh" class="chat">
                                <!--Wordt ingeladen-->
                            </ul>
                            <?php
                            $user = new User();
                            if ($user->isLoggedIn()) {
                            ?>
                            <span id="result"></span>
                                <?php
                            } else {
                            ?>
                            <span id="result"><h3>Login om te kunnen chatten</h3>Klik <a href='/inloggen'>hier</a> om in te loggen</span>
                                <?php
                            }
                            ?>
                            <span id="remaining"></span>
                        </div>
                        <div class="panel-footer">
                            <?php
                            $user = new User();
                            if ($user->isLoggedIn()) {
                                ?>
                                <form id="chat" action="/includes/chatbox.php" method="post">
                                    <div class="input-group">
                                        <input id="btn-input" type="text" class="form-control input-sm" maxlength="140" name="message" placeholder="Type je bericht hier..." />
                                    <span class="input-group-btn">
                                        <button id="sub" type="button" class="btn btn-primary btn-sm">Verstuur</button>
                                    </span>
                                    </div>
                                </form>
                                <?php
                            } else {
                                ?>
                                    <div class="input-group">
                                        <input id="btn-input" class="form-control input-sm" maxlength="140" placeholder="Type je bericht hier..." disabled/>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary btn-sm" disabled>Verstuur</button>
                                    </span>
                                    </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 chatRow">
                    <a href="http://www.sponsorkliks.com/winkels.php?club=3554" target="_blank"><img src="http://www.sponsorkliks.com/gfx/sk_lr_logos/licht_200_200.gif" class="img-responsive" style="margin: 0 auto;" alt="SponsorKliks, gratis sponsoren!" title="Sponsor EKC 2000 gratis!" Border="0"></a>
                    <h4>Bekijk de tweets van EKC 2000 live!</h4>
                    <a class="twitter-timeline" href="https://twitter.com/EKC2000_Emmen" data-widget-id="618144740459065344">Tweets door @EKC2000_Emmen</a>
                    <script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs")</script>
                </div>
            </div>
        </div>
<script src="js/chat_script.js"></script>
<script>
    $(document).ready(function() {
        $(".titleDiv p").dotdotdot({
            watch: "window"
        });
    });

    var totalMessagesDB = document.getElementById("totalMessagesDB").textContent;
    var val = 25;
    localStorage.setItem("val", val);
    setInterval(function(){
        if(totalMessages < totalMessagesDB) {
            var scrollHeight = $("#panel-body").scrollTop();
            if (scrollHeight >= 0 && scrollHeight < 10) {
                var totalHeight = $("#panel-body")[0].scrollHeight;
                val = val + 25;
                localStorage.setItem("val", val);
                more(val);
                setTimeout(function () {
                    var totalHeight2 = $("#panel-body")[0].scrollHeight;
                    var totalHeight3 = totalHeight2 - totalHeight;
                    document.getElementById("panel-body").scrollTop = totalHeight3;
                    var totalMessages = localStorage.getItem("totalMessages");
                    if (totalMessages <= totalMessagesDB) {
                        $('#scroll').hide();
                    }
                }, 1000);
            }
        }
    },1200);

    var totalMessages = localStorage.getItem("totalMessages");
    if (totalMessages <= totalMessagesDB) {
        $('#scroll').hide();
    }

    function more(more) {
            $.post('/includes/chatRefresh.php', {more: more},
                function (returnedData) {
                    $('#chatRefresh').html(returnedData);
                });
    }

    var logedin = localStorage.getItem("logedin");
    if(logedin == "ja"){
        logedin = "nee";
        localStorage.setItem("logedin", logedin);
            $('.alerts').append('<div class="alert alert-success alert-dismissable">' +
                '<button class="close" data-dismiss="alert">&times;</button>' +
                'Welkom <?php
                            if ($user->isLoggedIn()){
                                echo escape($user->data()->name) . " ";
                                if($user->data()->surname_prefix){
                                    echo escape($user->data()->surname_prefix) . " ";
                                }
                                echo escape($user->data()->surname);
                            }
                        ?> <br><br> U bent ingelogd' +
                '</div>');
        setTimeout(function () {
            $('.alerts').children('.alert:last-child').addClass('on');
            setTimeout(function () {
                $('.alerts').children('.alert:first-child').removeClass('on');
                setTimeout(function () {
                    $('.alerts').children('.alert:first-child').remove();
                }, 900);
            }, 5000);
        }, 10);
        }

    var logedout = localStorage.getItem("logedout");
    if (logedout == "ja") {
        logedout = "nee";
        localStorage.setItem("logedout", logedout);
        $('.alerts').append('<div class="alert alert-warning alert-dismissable">' +
            '<button class="close" data-dismiss="alert">&times;</button>' +
            'U bent succesvol uitgelogd' +
            '</div>');
        setTimeout(function () {
            $('.alerts').children('.alert:last-child').addClass('on');
            setTimeout(function () {
                $('.alerts').children('.alert:first-child').removeClass('on');
                setTimeout(function () {
                    $('.alerts').children('.alert:first-child').remove();
                }, 900);
            }, 5000);
        }, 10);
    }
</script>
    </div>
<?php include 'includes/htmlUnder.php';?>