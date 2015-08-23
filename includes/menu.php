<div class="alert"></div>
<div id="menuHeader" class="hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/home"><img class="logo" src="/images/logo.png" alt="Logo"/></a>
                <a href="/home"><h3>Welkom bij <strong>EKC 2000</strong></h3></a>
            </div>
        </div>
    </div>
</div>
<div id="menu" class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header hidden-md hidden-sm hidden-lg"><a class="navbar-brand" href="/home">EKC 2000</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <li <?=activeClass("home"),activeClass("index"),activeClass("")?>><a href="/home">Home</a></li>

                <li <?=activeClass("over-de-club"),activeClass("sponsoren"),activeClass("bestuur"),activeClass("commissies"),activeClass("lid-worden"),activeClass("contact"),activeClass("documenten")?> class="closed">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Vereniging<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li <?=activeClass("over-de-club")?>><a href="/over-de-club">Over de club</a></li>
                        <li <?=activeClass("sponsoren")?>><a href="/sponsoren">Sponsoren</a></li>
                        <li <?=activeClass("bestuur")?>><a href="/bestuur">Bestuur</a></li>
                        <li <?=activeClass("commissies")?>><a href="/commissies">Commissies</a></li>
                        <li <?=activeClass("lid-worden")?>><a href="/lid-worden">Lid worden</a></li>
                        <li <?=activeClass("documenten")?>><a href="/documenten">Documenten</a></li>
                        <li <?=activeClass("contact")?>><a href="/contact">Contact</a></li>
                    </ul>
                </li>

                <li <?=activeClass("nieuws")?>><a href="/nieuws">Nieuws</a></li>

                <li <?=activeClass("activiteiten")?>><a href="/activiteiten">Activiteiten</a></li>

                <li <?php activeClass("fotogalerij"); if (empty($_GET)) {} else {activeClass($_GET['name']);}?>><a href="/fotogalerij">Fotogalerij</a></li>

                <li <?=activeClass("teams"),activeClass("wedstrijdschema"),activeClass("standen"),activeClass("uitslagen"),activeClass("wedstrijd-verslagen"),activeClass("trainingstijden"),activeClass("kantinedienst")?> class="closed">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Competitie<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li <?=activeClass("teams")?>><a href="/teams">Teams</a></li>
                        <li <?=activeClass("wedstrijdschema")?>><a href="/wedstrijdschema">Wedstrijdschema</a></li>
                        <li <?=activeClass("standen")?>><a href="/standen">Standen</a></li>
                        <li <?=activeClass("uitslagen")?>><a href="/uitslagen">Uitslagen</a></li>
                        <li <?=activeClass("wedstrijd-verslagen")?>><a href="/wedstrijd-verslagen">Wedstrijd verslagen</a></li>
                        <li <?=activeClass("trainingstijden")?>><a href="/trainingstijden">Trainingstijden</a></li>
                        <li <?=activeClass("kantinedienst")?>><a href="/kantinedienst">Kantinedienst</a></li>
                    </ul>
                </li>
                <?php
                    $user = new User();
                    if ($user->isLoggedIn()) {
                        if($user->hasPermission("dev")){
                            ?>
                            <li <?= activeClass("uitloggen") ?> onclick="logout()"><a><i class="fa fa-sign-in"></i>
                                    Uitloggen D</a></li>
                            <?php
                        } else {
                            ?>
                            <li <?= activeClass("uitloggen") ?> onclick="logout()"><a><i class="fa fa-sign-in"></i>
                                    Uitloggen</a></li>
                            <?php
                        }
                    } else {
                        ?>
                        <li <?=activeClass("inloggen")?>><a href="/inloggen"><i class="fa fa-sign-in"></i> Inloggen</a></li>
                        <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</div>
<div class="header-line"></div>