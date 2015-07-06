<!DOCTYPE html>
<html lang="nl">
  <head>
      <?php include 'head.php';?>
  </head>
  <body>
  <?php include 'nav.php';?>
	 <?php include 'menu.php';?>
  <?php include 'shoutbox.php';?>
  <div class="visible-xs"><img class="headerImage" src="images/banner.jpg" alt="club foto"/></div>
	    <div class="container">
            <div class="hidden-xs"><img class="headerImage" src="images/banner.jpg" alt="club foto"/></div>
            <div class="col-xs-12 col-md-12"><h1>Welkom bij <strong>EKC 2000</strong></h1><hr></div>
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="col-xs-12 col-md-4 well infoDiv">
                        <div class="col-md-4 col-xs-4">
                            <i class="icon major fa-newspaper-o"></i>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            <h3>Laatste nieuws</h3>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <p>07-03-15 Programma EKC 2000-dag</br></br>
                            07-03-15 EKC 2000 B2 is zaalkampioen!</br></br>
                            07-03-15 Paasspelen 2015!</br></br>
                            22-02-15 Word donateur en steun EKC 2000</br></br>
                            16-02-15 Interview met Riejander Deen</br></br>
                            19-05-15 Selectietrainingen jeugd.</br></br>
                            19-05-15 Oproep nieuwe senioren werven</br></br>
                            19-05-15 Sponsorkleding inleveren.</br></br>
                            14-05-15 Bekerwedstrijd halve finale S1 19 mei</br></br>
                            14-05-15 Geen training tijdens schoolkorfbal</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 well infoDiv">
                        <div class="col-md-4 col-xs-4">
                            <i class="icon major fa-camera"></i>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            <h3>Laaste foto albums</h3>
                        </div>
                        <div class="col-md-12 col-xs-12">
                        <p>17-05-14 EKC 2000 1 - Elko 1</br></br>
                            17-05-14 EKC 2000 1 - Elko 1</br></br>
                            17-05-14 EKC 2000 2 - Elko 2</br></br>
                            10-05-14 Flamingo's 1 - EKC 2000 1</br></br>
                            19-04-14 EKC 2000 1 - Pallas'08 1</br></br>
                            19-04-14 EKC 2000 2 - Pallas'08 2</br></br>
                            12-04-14 Lintjo 1 EKC 2000 1</br></br>
                            12-04-14 Lintjo 2 - EKC 2000 2</br></br>
                            31-03-14 EKC 2000 1 - De Granaet 1</br></br>
                            31-03-14 EKC 2000 2 - De Granaet 2</p>
                            </div>
                    </div>
                    <div class="col-xs-12 col-md-4 well infoDiv1">
                        <div class="col-md-4 col-xs-4">
                            <i class="icon major fa-users"></i>
                        </div>
                        <div class="col-md-8 col-xs-8">
                            <h3>Komende activiteiten</h3>
                        </div>
                        <div class="col-md-12 col-xs-12">
                        <p>12-03-15 EKC 2000-dag</br></br>
                            12-03-15 EKC 2000-dag</br></br>
                            12-03-15 EKC 2000-dag</br></br>
                            12-03-15 EKC 2000-dag</br></br>
                            12-03-15 EKC 2000-dag</br></br>
                            12-03-15 EKC 2000-dag</br></br>
                            12-03-15 EKC 2000-dag</br></br>
                            12-03-15 EKC 2000-dag</br></br>
                            12-03-15 EKC 2000-dag</br></br>
                            12-03-15 EKC 2000-dag</p>
                            </div>
                    </div>
                </div>
            </div>
            <div class="sponsorenDiv col-md-12 col-xs-12">
                <h1>Onze sponsoren</h1><hr>
                <img class="img-responsive" src="images/sponsoren.png" alt="Onze sponsoren"/><hr>
            </div>
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <h1>Shoutbox</h1>
                    <form action="index.php" method="post">
                        <input type="text" name="user_shout" id="text" maxlength="140">
                        <input type="submit" value="Post shout">
                    </form>
                </div>
                <div class="col-md-4 col-xs-12">
                    <a class="twitter-timeline" href="https://twitter.com/EKC2000_Emmen" data-widget-id="618144740459065344">Tweets door @EKC2000_Emmen</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
            </div>
	    </div>
      <?php include 'footer.php';?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>