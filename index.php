<?php include 'includes/html.php';?>
<script src="js/jquery.dotdotdot.min.js"></script>
<?php
if(!isset($_COOKIE["darkTheme"]) || $_COOKIE["darkTheme"] === "false") {
    ?>
    <iframe src="https://score.ekc2000.nl/create-cookie?darkTheme=false" style="display: none;"></iframe>
    <?php
} else {
    ?>
    <iframe src="https://score.ekc2000.nl/create-cookie?darkTheme=true" style="display: none;"></iframe>
    <?php
}
?>
  <div class="visible-xs" style="position: relative;">
      <div class="hidden-md hidden-lg" style="position:absolute; top: 10px; left: 10px;">
          <div >
              <i class="fa fa-lightbulb-o fa-1 fa-lightbulb-o-mobile" aria-hidden="true"></i>
              <?php if(!isset($_COOKIE["darkTheme"]) || $_COOKIE["darkTheme"] === "false") { ?>
                  <label class="switch">
                      <input type="checkbox" onclick="setCookie(); location.reload();">
                      <span class="slider round"></span>
                  </label>
              <?php } else { ?>
                  <label class="switch">
                      <input type="checkbox" onclick="document.cookie = 'darkTheme=false; expires=-1'; location.reload();" checked>
                      <span class="slider round"></span>
                  </label>
              <?php } ?>
          </div>
      </div>
      <?php
      $scoreboard = $db->query("SELECT * FROM scoreboard WHERE id = 1");
      if ($scoreboard->count()) {
          foreach ($scoreboard->results() as $result) {
              if ($result->scoreboard == 1) {
                  ?><div style="position: relative;"><iframe src="https://score.ekc2000.nl/scoreboard-detail/<?php echo$result->scoreboardID;?>" scrolling="no" onload="resizeIframe(this)" style="border: none;" width="100%"></iframe><div class="overlay" style="top: 0; left: 0; width: 100%; height: 100%; position:absolute;"></div></div><?php
              } else {
                  ?><img class="headerImage" src="images/banner.jpg" alt="club foto"/><?php
              }
          }
      }
      ?>
  </div>
	    <div class="container">
            <?php
            $scoreboard = $db->query("SELECT * FROM scoreboard WHERE id = 1");
            if ($scoreboard->count()) {
                foreach ($scoreboard->results() as $result) {
                    if ($result->scoreboard == 1) {
                        ?>
                        <div class="hidden-xs" style="position: relative;  padding-top: 20px;"><iframe src="https://score.ekc2000.nl/scoreboard-detail/<?php echo$result->scoreboardID;?>" scrolling="no" onload="resizeIframe(this)" style="border: 1px solid <?php if(!isset($_COOKIE["darkTheme"]) || $_COOKIE["darkTheme"] === "false") { ?>#e3e3e3<?php } else { ?>#3D3D3D<?php } ?>; border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05); box-shadow: inset 0 1px 1px rgba(0,0,0,.05);" width="100%" height="320px"></iframe><div class="overlay" style="top: 0; left: 0; width: 100%; height: 100%; position:absolute;"></div></div><?php
                    } else {
                        ?><div class="hidden-xs"><img class="headerImage" src="images/banner.jpg" alt="club foto"/></div><?php
                    }
                }
            }
            ?>
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
                ?>
                <div class="hidden-xs" style="float: right;">
                    <i class="fa fa-lightbulb-o fa-1" aria-hidden="true"></i>
                    <?php if(!isset($_COOKIE["darkTheme"]) || $_COOKIE["darkTheme"] === "false") { ?>
                        <label class="switch">
                            <input type="checkbox" onclick="setCookie(); location.reload();">
                            <span class="slider round"></span>
                        </label>
                    <?php } else { ?>
                        <label class="switch">
                            <input type="checkbox" onclick="document.cookie = 'darkTheme=false; expires=-1'; location.reload();" checked>
                            <span class="slider round"></span>
                        </label>
                    <?php } ?>
                </div>
                </h1><hr>
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
                                <a href="/wedstrijdverslagen"><i class="icon major fa-futbol-o link"></i></a>
                            </div>
                            <div class="col-md-8 col-xs-8">
                                <a href="/wedstrijdverslagen"><h3 style="width: 200px;">Laatste wedstrijdverslagen</h3></a>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <p>
                                    <?php
                                    $reports = $db->query("SELECT * FROM reports ORDER BY date DESC LIMIT 3");
                                    if ($reports->count()) {
                                        foreach ($reports->results() as $report) {
                                            $report_name = str_replace("XY","%",$report->name);
                                            $reportDate = new DateTime($report->date);
                                            if ($reportDate >= $datetime) {
                                                ?> <div class="fotoLink artikleDiv row" onclick="window.location='/verslag/<?php echo escape($report->name) ?>'"><div class="dateDiv"><p style="font-weight: bold; margin: 0px; padding: 0px;"><?php echo escape(explode(" ", $report->date)[0]) ?></p></div><div class="titleDiv col-md-8 col-xs-8"><p style="font-weight: bold; margin: 0px; padding: 0px;"><?php echo escape(rawurldecode($report_name)) ?></p></div></div> <?php
                                            } else {
                                                ?> <div class="fotoLink artikleDiv row" onclick="window.location='/verslag/<?php echo escape($report->name) ?>'"><div class="dateDiv"><p style="margin: 0px; padding: 0px;"><?php echo escape(explode(" ", $report->date)[0]) ?></p></div><div class="titleDiv col-md-8 col-xs-8"><p style="margin: 0px; padding: 0px;"><?php echo escape(rawurldecode($report_name)) ?></p></div></div> <?php
                                            }
                                        }
                                    } else {
                                        echo '<p class="fotoLink">Er is geen wedstrijdverslag beschikbaar.</p>';
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="col-md-2 col-xs-2" style="margin-top: 5px;">
                                <a href="/fotogalerij"><i class="icon smallMajor fa-camera link"></i></a>
                            </div>
                            <div class="col-md-10 col-xs-10" style="margin-top: 5px;">
                                <a href="/fotogalerij"><h4>Laatste foto albums</h4></a>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <p>
                                    <?php
                                    $albums = $db->query("SELECT * FROM albums WHERE id > 1 ORDER BY date DESC LIMIT 2");
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
                                $dateNow = $dateNow->modify('-1 day');

                                $upcomingActivities = $db->query("SELECT date, date_activity, name FROM activities WHERE date_activity >= NOW() ORDER BY date_activity ASC LIMIT 6");
                                if ($upcomingActivities->count()) {
                                    foreach ($upcomingActivities->results() as $upcomingActivity) {
                                        $activityDate = new DateTime($upcomingActivity->date_activity);
                                        if ($activityDate >= $dateNow) {
                                            ?> <div class="fotoLink artikleDiv row" onclick="window.location='/activiteit/<?php echo escape($upcomingActivity->name) ?>'"><div class="dateDiv"><p style="font-weight: bold; margin: 0px; padding: 0px;"><?php echo escape($upcomingActivity->date_activity) ?></p></div><div class="titleDiv col-md-8 col-xs-8"><p style="font-weight: bold; margin: 0px; padding: 0px;"><?php echo escape(rawurldecode($upcomingActivity->name)) ?></p></div></div> <?php
                                        } else {
                                            ?> <div class="fotoLink artikleDiv row" onclick="window.location='/activiteit/<?php echo escape($upcomingActivity->name) ?>'"><div class="dateDiv"><p style="margin: 0px; padding: 0px;"><?php echo escape($upcomingActivity->date_activity) ?></p></div><div class="titleDiv col-md-8 col-xs-8"><p style="margin: 0px; padding: 0px;"><?php echo escape(rawurldecode($upcomingActivity->name)) ?></p></div></div> <?php
                                        }
                                    }
                                }

                                $limit = 6 - $upcomingActivities->count();
                                $activities = $db->query("SELECT date, date_activity, name FROM activities WHERE date_activity < NOW() ORDER BY date_activity DESC LIMIT $limit");
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
                    <a href="https://www.sponsorkliks.com/winkels.php?club=3554" target="_blank"><img src="https://www.sponsorkliks.com/gfx/sk_lr_logos/<?php if(isset($_COOKIE["darkTheme"]) && $_COOKIE["darkTheme"] === "true") { echo "donker"; } else { echo "licht"; } ?>_200_200.gif" class="img-responsive" style="margin: 0 auto;" alt="SponsorKliks, gratis sponsoren!" title="Sponsor EKC 2000 gratis!" Border="0"></a>
                    <h4>Bekijk de tweets van EKC 2000 live!</h4>
                    <a class="twitter-timeline" <?php if(isset($_COOKIE["darkTheme"]) && $_COOKIE["darkTheme"] === "true") { echo "data-theme='dark'"; }?> href="https://twitter.com/EKC2000_Emmen" data-widget-id="618144740459065344">Tweets door @EKC2000_Emmen</a>
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

    function setCookie() {
        var date = new Date();
        date.setTime(date.getTime() + 2678400000);
        expires = "; expires=" + date.toUTCString();
        document.cookie = "darkTheme=true" + expires + "; path=/";
    }

    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    }

    $('.overlay').click(function(){window.open('https://score.ekc2000.nl', '_blank');});

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
<?php include 'includes/htmlUnder.php';?>