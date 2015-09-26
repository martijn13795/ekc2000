<?php include 'includes/html.php';?>
  <div class="visible-xs"><img class="headerImage" src="images/banner.jpg" alt="club foto"/></div>
	    <div class="container">
            <div class="hidden-xs"><img class="headerImage" src="images/banner.jpg" alt="club foto"/></div>
            <div class="col-xs-12 col-md-12"><h1>Welkom bij <strong>EKC 2000</strong><?php $user = new User(); if ($user->isLoggedIn()) { echo ', '.$user->data()->name; } ?></h1><hr></div>
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
                                    $nieuwsMessage = $db->query("SELECT date, name FROM nieuws ORDER BY date DESC");
                                    if ($nieuwsMessage->count()) {
                                        foreach ($nieuwsMessage->results() as $nieuws) {
                                            echo '<p class="fotoLink"><a href="/artikel/' . $nieuws->name . '">' . escape($date = explode(" ", $nieuws->date)[0]) . ' ' . escape($name = str_replace('-', ' ', $nieuws->name)) . '</a></p>';
                                        }
                                    } else {
                                        echo '<p class="fotoLink">Er zijn nog geen artikelen beschikbaar.</p>';
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
                                <a href="/fotogalerij"><h3>Laaste foto albums</h3></a>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <p>
                                    <?php
                                    $albums = $db->query("SELECT * FROM albums WHERE id > 1 ORDER BY date DESC");
                                    if ($albums->count()) {
                                        foreach ($albums->results() as $album) {
                                            echo '<p class="fotoLink"><a href="/album/' . escape($album->name) . '">' . escape(explode(" ", $album->date)[0]) . ' ' . escape(str_replace('-', ' ', $album->name)) . '</a></p>';
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
                                $activiteiten = $db->query("SELECT date, name FROM activiteiten ORDER BY date DESC");
                                if ($activiteiten->count()) {
                                    foreach ($activiteiten->results() as $activiteit) {
                                        echo '<p class="fotoLink"><a href="/activiteit/' . $activiteit->name . '">' . escape($date = explode(" ", $activiteit->date)[0]) . ' ' . escape($name = str_replace('-', ' ', $activiteit->name)) . '</a></p>';
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
                            $sponsoren = $db->query("SELECT * FROM pictures WHERE album_id = '".$album->first()->id."'");
                            if ($sponsoren->count()) {
                                foreach ($sponsoren->results() as $sponsor) {
                                    echo '
                                    <div class="col-md-2 col-xs-2 sponsorenImg">
                                            <img class="img-responsive" src="' . escape($sponsor->path) . '" alt="' . escape($sponsor->name) . '"/>
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
            <div class="row">
                <div class="col-md-8 col-xs-12">
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
                <div class="col-md-4 col-xs-12">
                    <h4>Bekijk de tweets van EKC 2000 live!</h4>
                    <a class="twitter-timeline" href="https://twitter.com/EKC2000_Emmen" data-widget-id="618144740459065344">Tweets door @EKC2000_Emmen</a>
                    <script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs")</script>
                </div>
        </div>
<script src="js/chat_script.js"></script>
<script>
    var logedin = localStorage.getItem("logedin");
    if(logedin == "ja"){
        logedin = "nee";
        localStorage.setItem("logedin", logedin);
        if (!$(".alert").hasClass("on")) {
            var message = '<div class="alert alert-success alert-dismissable">' +
                '<button class="close" data-dismiss="alert">&times;</button>' +
                'Welkom <?php echo escape($user->data()->name); ?> <br><br> U bent ingelogd' +
                '</div>';
            $('.alert').append(message);
            setTimeout(function () {
                $('.alert').addClass('on');
                setTimeout(function () {
                    $('.alert').removeClass('on');
                }, 5000);
            }, 10);
        }
    }
</script>