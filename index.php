<<<<<<< HEAD
<?php include 'includes/html.php';?>
  <div class="visible-xs"><img class="headerImage" src="images/banner.jpg" alt="club foto"/></div>
	    <div class="container">
            <div class="hidden-xs"><img class="headerImage" src="images/banner.jpg" alt="club foto"/></div>
            <div class="col-xs-12 col-md-12"><h1>Welkom bij <strong>EKC 2000</strong></h1><hr></div>
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
                                <p>07-03-15 Programma EKC 2000-dag<br><br>
                                07-03-15 EKC 2000 B2 is zaalkampioen!<br><br>
                                07-03-15 Paasspelen 2015!<br><br>
                                22-02-15 Word donateur en steun EKC 2000<br><br>
                                16-02-15 Interview met Riejander Deen<br><br>
                                19-05-15 Selectietrainingen jeugd.<br><br>
                                19-05-15 Oproep nieuwe senioren werven<br><br>
                                19-05-15 Sponsorkleding inleveren.<br><br>
                                14-05-15 Bekerwedstrijd halve finale S1 19 mei<br><br>
                                14-05-15 Geen training tijdens schoolkorfbal</p>
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
                                    include_once('includes/db.php');
                                    $select = mysql_query('SELECT albumID, date, albumName FROM fotogalerij ORDER BY albumID DESC') or die(mysql_error());
                                    while ($selecting = mysql_fetch_array($select)) {
                                        echo '<p class="fotoLink"><a href="/album/'.$selecting['albumName'].'">'  . $selecting['date'] . ' ' . $selecting['albumName'] = str_replace('-', ' ', $selecting['albumName']) . '</a></p>';
                                    }
                                    mysql_close();
                                    ?>
                                </p>
                    <div class="col-xs-12 col-md-4 well infoDiv">
                        <div class="col-md-4 col-xs-4">
                            <a href="/fotogalerij"><i class="icon major fa-camera link"></i></a>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            <a href="/fotogalerij"><h3>Laaste foto albums</h3></a>
                        </div>
                        <div class="col-md-12 col-xs-12">
                        <p>
                            <?php
                            $db = DB::getInstance();
                            $galleries = $db->query("SELECT id, date, name FROM galleries ORDER BY id DESC");
                            if($galleries->count()){
                                foreach($galleries->results() as $gallery){
                                    echo '<p class="fotoLink"><a href="/album/'.$gallery->name.'">'.$gallery->date.' '.$gallery->name = str_replace('-', ' ', $gallery->name).'</a></p>';
                                }
                            }else{
                                echo '<p class="fotoLink">Er zijn nog geen albums beschikbaar.</p>';
                            }
                            /*include_once('includes/db.php');
                            $select = mysql_query('SELECT albumID, date, albumName FROM fotogalerij ORDER BY albumID DESC') or die(mysql_error());
                            while ($selecting = mysql_fetch_array($select)) {
                                echo '<p class="fotoLink"><a href="/album/'.$selecting['albumName'].'">'  . $selecting['date'] . ' ' . $selecting['albumName'] = str_replace('-', ' ', $selecting['albumName']) . '</a></p>';
                            }
                            mysql_close();*/
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
                            <p>12-03-15 EKC 2000-dag<br><br>
                                12-03-15 EKC 2000-dag<br><br>
                                12-03-15 EKC 2000-dag<br><br>
                                12-03-15 EKC 2000-dag<br><br>
                                12-03-15 EKC 2000-dag<br><br>
                                12-03-15 EKC 2000-dag<br><br>
                                12-03-15 EKC 2000-dag<br><br>
                                12-03-15 EKC 2000-dag<br><br>
                                12-03-15 EKC 2000-dag<br><br>
                                12-03-15 EKC 2000-dag</p>
                                </div>
                        </div>
                    </div>
=======
<?php include 'includes/html.php'; ?>
<div class="visible-xs"><img class="headerImage" src="images/banner.jpg" alt="club foto"/></div>
<div class="container">
    <div class="hidden-xs"><img class="headerImage" src="images/banner.jpg" alt="club foto"/></div>
    <div class="col-xs-12 col-md-12"><h1>Welkom bij <strong>EKC 2000</strong></h1>
        <hr>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="col-xs-12 col-md-4 well infoDiv">
                <div class="col-md-4 col-xs-4">
                    <a href="/nieuws"><i class="icon major fa-newspaper-o link"></i></a>
                </div>
                <div class="col-md-8 col-xs-8">
                    <a href="/nieuws"><h3>Laatste nieuws</h3></a>
                </div>
                <div class="col-md-12 col-xs-12">
                    <p>07-03-15 Programma EKC 2000-dag<br><br>
                        07-03-15 EKC 2000 B2 is zaalkampioen!<br><br>
                        07-03-15 Paasspelen 2015!<br><br>
                        22-02-15 Word donateur en steun EKC 2000<br><br>
                        16-02-15 Interview met Riejander Deen<br><br>
                        19-05-15 Selectietrainingen jeugd.<br><br>
                        19-05-15 Oproep nieuwe senioren werven<br><br>
                        19-05-15 Sponsorkleding inleveren.<br><br>
                        14-05-15 Bekerwedstrijd halve finale S1 19 mei<br><br>
                        14-05-15 Geen training tijdens schoolkorfbal</p>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 well infoDiv">
                <div class="col-md-4 col-xs-4">
                    <a href="/fotogalerij"><i class="icon major fa-camera link"></i></a>
                </div>
                <div class="col-md-8 col-xs-8">
                    <a href="/fotogalerij"><h3>Laaste foto albums</h3></a>
                </div>
                <div class="col-md-12 col-xs-12">
                    <p>
                        <?php
                        $db = DB::getInstance();
                        $galleries = $db->query("SELECT id, date, name FROM galleries ORDER BY id DESC");
                        if ($galleries->count()) {
                            foreach ($galleries->results() as $gallery) {
                                echo '<p class="fotoLink"><a href="/album/' . $gallery->name . '">' . $gallery->date . ' ' . $gallery->name = str_replace('-', ' ', $gallery->name) . '</a></p>';
                            }
                        } else {
                            echo '<p class="fotoLink">Er zijn nog geen albums beschikbaar.</p>';
                        }
                        ?>
                    </p>
>>>>>>> origin/master
                </div>
            </div>
            <div class="col-xs-12 col-md-4 well infoDiv1">
                <div class="col-md-4 col-xs-4">
                    <a href="/activiteiten"><i class="icon major fa-users link"></i></a>
                </div>
                <div class="col-md-8 col-xs-8">
                    <a href="/activiteiten"><h3>Komende activiteiten</h3></a>
                </div>
                <div class="col-md-12 col-xs-12">
                    <p>12-03-15 EKC 2000-dag<br><br>
                        12-03-15 EKC 2000-dag<br><br>
                        12-03-15 EKC 2000-dag<br><br>
                        12-03-15 EKC 2000-dag<br><br>
                        12-03-15 EKC 2000-dag<br><br>
                        12-03-15 EKC 2000-dag<br><br>
                        12-03-15 EKC 2000-dag<br><br>
                        12-03-15 EKC 2000-dag<br><br>
                        12-03-15 EKC 2000-dag<br><br>
                        12-03-15 EKC 2000-dag</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="grayBar">
    <div class="container">
        <div class="sponsorenDiv col-md-12 col-xs-12">
            <h1>Onze sponsoren</h1><br>
            <img class="img-responsive" src="images/sponsorenGrayBar.png" alt="Onze sponsoren"/>
            <hr>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-7 col-xs-7"><span class="glyphicon glyphicon-comment"></span> Kom in contact
                            en deel wat je denkt in deze chatbox
                        </div>
                        <div class="col-md-5 col-xs-5"><span id="timer" class="glyphicon glyphicon-time"></span></div>
                    </div>
                </div>
                <div id="panel-body" class="panel-body">
                    <ul class="chat">
                        <li class="left clearfix">
                                                    <span class="chat-img pull-left">
                                                        <img src="/images/logoChat.png" alt="User Avatar"
                                                             class="img-circle avatar"/>
                                                    </span>

                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">EKC 2000</strong>
                                    <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>2015-07-10 13:13:00
                                    </small>
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
                                <input id="btn-input" type="text" class="form-control input-sm" maxlength="140"
                                       name="message" placeholder="Type je bericht hier..."/>
                                    <span class="input-group-btn">
                                        <button id="sub" type="button" class="btn btn-primary btn-sm">Verstuur</button>
                                    </span>
                            </div>
                        </form>
                        <?php
                    } else {
                        ?>
                        <div class="input-group">
                            <input id="btn-input" class="form-control input-sm" maxlength="140"
                                   placeholder="Type je bericht hier..." disabled/>
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
            <a class="twitter-timeline" href="https://twitter.com/EKC2000_Emmen" data-widget-id="618144740459065344">Tweets
                door @EKC2000_Emmen</a>
            <script type="text/javascript">!function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = p + "://platform.twitter.com/widgets.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, "script", "twitter-wjs")</script>
        </div>
    </div>
    <script src="js/chat_script.js"></script>
